#!/usr/bin/env node
const fs = require("fs");
const path = require("path");

// ---------- helpers ----------
const normalizeLF = (s) => s.replace(/\r\n?/g, "\n");

// Collapse weird line breaks INSIDE any <?php ... ?> block (templates only)
function collapsePhpBlockNewlines(str) {
    return str.replace(/<\?php([\s\S]*?)\?>/g, (m, inner) => {
        let s = inner;
        s = s.replace(/-\>\s*\n\s*/g, "->").replace(/::\s*\n\s*/g, "::");
        s = s.replace(/([=!<>]=?=?)\s*\n\s*/g, "$1 ");
        s = s.replace(/(&&|\|\|)\s*\n\s*/g, "$1 ");
        s = s.replace(/\s*\n\s*/g, " ");
        s = s.replace(/\s{2,}/g, " ");
        s = s.replace(/\(\s+/g, "(").replace(/\s+\)/g, ")");
        s = s.replace(/\s+:/g, " :").replace(/\s+;/g, ";");
        return `<?php${s}?>`;
    });
}

// Collapse whitespace in attribute values that contain inline PHP
function collapseInlinePhpWhitespaceInAttrs(html) {
    return html.replace(/=(["'])([^"']*<\?php[\s\S]*?\?>[^"']*)\1/g, (m, q, inner) => {
        const collapsed = inner
            .replace(/-\>\s*\n\s*/g, "->")
            .replace(/::\s*\n\s*/g, "::")
            .replace(/\s*\n\s*/g, " ")
            .replace(/\s{2,}/g, " ");
        return `=${q}${collapsed}${q}`;
    });
}

// Prefer one-line attributes when not too long
function collapseMultilineAttributes(html, maxLen = 240) {
    return html.replace(/<([a-zA-Z][\w:-]*)(\s+[^>]*?)>/g, (m, tag, attrs) => {
        if (!/\n/.test(attrs)) return m;
        const oneLine = `<${tag}${attrs.replace(/\s*\n\s*/g, " ").replace(/\s{2,}/g, " ")}>`;
        return oneLine.length <= maxLen ? oneLine : m;
    });
}

/**
 * Encode `<tag <?php ... ?>>` into `<tag __phpattrs__="__TOKEN__">` so Prettier can parse,
 * then restore after formatting.
 */
function encodePhpRightAfterTagName(html) {
    const map = [];
    let idx = 0;
    const out = html.replace(/<([a-zA-Z][\w:-]*)\s*<\?php([\s\S]*?)\?>/g, (m, tag, php) => {
        const token = `__PHPATTR_${idx++}__`;
        map.push([token, `<?php${php}?>`]);
        return `<${tag} __phpattrs__="${token}"`;
    });
    return { html: out, map };
}
function restorePhpRightAfterTagName(html, map) {
    let out = html;
    for (const [token, php] of map) {
        out = out.replace(new RegExp(`\\s__phpattrs__="${token}"`, "g"), ` ${php}`);
    }
    return out;
}

/**
 * Add HTML shims for partial templates:
 * - If file has </body> but no <body ...>, prepend `<body data-wp-shim>`
 * - If file has </html> but no <html ...>, prepend `<html data-wp-shim>`
 * Return what we added so we can remove just those *openers* later.
 */
function addPartialShims(html) {
    const hasOpenBody = /<body\b/i.test(html);
    const hasCloseBody = /<\/body>/i.test(html);
    const hasOpenHtml = /<html\b/i.test(html);
    const hasCloseHtml = /<\/html>/i.test(html);

    let prefix = "";
    const added = { openHtml: false, openBody: false };

    if (hasCloseHtml && !hasOpenHtml) {
        prefix += "<html data-wp-shim>";
        added.openHtml = true;
    }
    if (hasCloseBody && !hasOpenBody) {
        prefix += "<body data-wp-shim>";
        added.openBody = true;
    }
    return { html: prefix ? prefix + html : html, added };
}
function removePartialShims(html, added) {
    let out = html;
    if (added.openBody) {
        out = out.replace(/<body\b[^>]*data-wp-shim[^>]*>/i, "");
    }
    if (added.openHtml) {
        out = out.replace(/<html\b[^>]*data-wp-shim[^>]*>/i, "");
    }
    return out;
}

async function loadPrettier() {
    // Prettier 3 is ESM; dynamic import from CJS
    // eslint-disable-next-line no-eval
    return (await eval("import('prettier')")).default;
}

// ---------- main ----------
(async () => {
    const file = process.argv[2];
    if (!file) {
        console.error("Missing file path");
        process.exit(2);
    }
    const abs = path.resolve(file);
    const raw = fs.readFileSync(abs, "utf8");
    const prettier = await loadPrettier();

    let preamble = "";
    let body = raw;

    // Split a leading PHP block (vars) from the rest (HTML + inline PHP)
    if (raw.startsWith("<?php")) {
        const end = raw.indexOf("?>");
        if (end !== -1) {
            preamble = raw.slice(0, end + 2);
            body = raw.slice(end + 2);
        }
    }

    let out = "";

    // Format preamble as PHP and add exactly one blank line
    if (preamble) {
        const fmtPhp = await prettier.format(normalizeLF(preamble), {
            parser: "php",
            plugins: [require.resolve("@prettier/plugin-php")],
            printWidth: 100,
            tabWidth: 4,
        });
        out += fmtPhp.trimEnd() + "\n\n";
    }

    if (body) {
        // normalize + enforce your oneliner style
        let html = normalizeLF(body).replace(/^\s+/, "");
        html = collapsePhpBlockNewlines(html);
        html = collapseInlinePhpWhitespaceInAttrs(html);
        html = collapseMultilineAttributes(html, 240);

        // Encode `<tag <?php ... ?>>` cases
        const { html: encoded, map } = encodePhpRightAfterTagName(html);

        // Add shims for partial templates (e.g., footer.php)
        const { html: shimmed, added } = addPartialShims(encoded);

        let formatted;
        try {
            formatted = await prettier.format(shimmed, {
                parser: "html",
                embeddedLanguageFormatting: "off",
                htmlWhitespaceSensitivity: "ignore",
                printWidth: 240,
                tabWidth: 4,
            });
        } catch (err) {
            // If HTML is actually broken, keep the shimmed content (still valid) so we can restore and continue
            console.error(String(err));
            formatted = shimmed;
        }

        // Restore placeholders and remove only the added shim *openers*
        let restored = restorePhpRightAfterTagName(formatted, map);
        restored = removePartialShims(restored, added);

        // Final safety pass for any PHP newlines that slipped through
        out += collapsePhpBlockNewlines(restored);
    }

    fs.writeFileSync(abs, out, "utf8");
})().catch((e) => {
    console.error(e?.message || e);
    process.exit(1);
});
