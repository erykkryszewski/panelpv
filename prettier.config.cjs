/** @type {import("prettier").Config} */
module.exports = {
    printWidth: 100,
    tabWidth: 4,
    useTabs: false,
    singleQuote: false,
    trailingComma: "es5",
    bracketSpacing: true,
    arrowParens: "always",

    // CRUCIAL for your HTML-first PHP templates:
    // We'll call Prettier with --parser html and disable embedded formatting,
    // so inline PHP stays exactly inline (no “echo” wrapping).
    htmlWhitespaceSensitivity: "ignore",
    embeddedLanguageFormatting: "off",
};
