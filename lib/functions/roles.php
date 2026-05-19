<?php
add_action('after_setup_theme', function () {
    add_role('czlonek_zwyczajny', 'Członek zwyczajny', ['read' => true]);
    add_role('czlonek_wspierajacy', 'Członek wspierający', ['read' => true]);
});

function panelpv_get_member_content_rules()
{
    return [
        [
            'post_type' => 'czlonkostwo-zwycz',
            'url_parts' => ['czlonkostwo-zwycz'],
            'allowed_roles' => ['czlonek_zwyczajny', 'czlonek_wspierajacy'],
        ],
        [
            'post_type' => 'czlonkostwo-wspier',
            'url_parts' => ['czlonkostwo-wspier'],
            'allowed_roles' => ['czlonek_wspierajacy'],
        ],
        [
            'post_type' => 'materialy-zwycz',
            'url_parts' => ['materialy-zwycz'],
            'allowed_roles' => ['czlonek_zwyczajny', 'czlonek_wspierajacy'],
        ],
        [
            'post_type' => 'materialy-wspier',
            'url_parts' => ['materialy-wspier'],
            'allowed_roles' => ['czlonek_wspierajacy'],
        ],
    ];
}

function panelpv_get_member_content_rule_for_request($requestUri)
{
    foreach (panelpv_get_member_content_rules() as $rule) {
        foreach ($rule['url_parts'] as $urlPart) {
            if (strpos($requestUri, $urlPart) !== false) {
                return $rule;
            }
        }
    }

    return null;
}

function panelpv_admin_go_home_handler()
{
    wp_safe_redirect(home_url('/'));
    exit();
}

add_action(
    'admin_menu',
    function () {
        if (!is_user_logged_in()) {
            return;
        }
        $currentUser = wp_get_current_user();
        $currentRoles = is_array($currentUser->roles) ? $currentUser->roles : [];
        $isMemberRole =
            in_array('czlonek_zwyczajny', $currentRoles, true) || in_array('czlonek_wspierajacy', $currentRoles, true);
        if (!$isMemberRole) {
            return;
        }
        add_menu_page(
            __('Wróć do strony głównej', 'panelpv'),
            __('Wróć do strony głównej', 'panelpv'),
            'read',
            'panelpv-go-home',
            'panelpv_admin_go_home_handler',
            'dashicons-admin-home',
            2,
        );
    },
    9,
);

add_action(
    'admin_menu',
    function () {
        if (!is_user_logged_in()) {
            return;
        }
        $currentUser = wp_get_current_user();
        $currentRoles = is_array($currentUser->roles) ? $currentUser->roles : [];
        $isRoleZwyczajny = in_array('czlonek_zwyczajny', $currentRoles, true);
        $isRoleWspierajacy = in_array('czlonek_wspierajacy', $currentRoles, true);
        if (!$isRoleZwyczajny && !$isRoleWspierajacy) {
            return;
        }
        remove_menu_page('index.php');
        remove_menu_page('edit.php');
        remove_menu_page('upload.php');
        remove_menu_page('edit-comments.php');
        remove_menu_page('themes.php');
        remove_menu_page('plugins.php');
        remove_menu_page('tools.php');
        remove_menu_page('options-general.php');
        remove_menu_page('link-manager.php');
        remove_menu_page('edit.php?post_type=page');
        remove_menu_page('edit.php?post_type=czlonkostwo-wspier');
        remove_menu_page('edit.php?post_type=czlonkostwo-zwycz');
        remove_menu_page('edit.php?post_type=materialy-wspier');
        remove_menu_page('edit.php?post_type=materialy-zwycz');
        remove_submenu_page('users.php', 'user-new.php');
        remove_submenu_page('users.php', 'users.php');
    },
    99,
);

add_action('admin_init', function () {
    if (!is_user_logged_in()) {
        return;
    }
    $currentUser = wp_get_current_user();
    $currentRoles = is_array($currentUser->roles) ? $currentUser->roles : [];
    $isRoleZwyczajny = in_array('czlonek_zwyczajny', $currentRoles, true);
    $isRoleWspierajacy = in_array('czlonek_wspierajacy', $currentRoles, true);
    if (!$isRoleZwyczajny && !$isRoleWspierajacy) {
        return;
    }
    global $pagenow;
    $isProfileScreen = $pagenow === 'profile.php';
    $isGoHomeScreen = $pagenow === 'admin.php' && isset($_GET['page']) && $_GET['page'] === 'panelpv-go-home';
    if ($pagenow === 'index.php') {
        wp_safe_redirect(admin_url('profile.php'));
        exit();
    }
    if (!$isProfileScreen && !$isGoHomeScreen) {
        wp_safe_redirect(admin_url('profile.php'));
        exit();
    }
});

add_filter(
    'login_redirect',
    function ($redirectTo, $requestedRedirectTo, $user) {
        $targetPage = get_page_by_path('moje-konto', OBJECT, 'page');
        $targetUrl = $targetPage ? get_permalink($targetPage) : home_url('/');
        if ($user instanceof WP_User) {
            $userRoles = is_array($user->roles) ? $user->roles : [];
            if (in_array('czlonek_zwyczajny', $userRoles, true) || in_array('czlonek_wspierajacy', $userRoles, true)) {
                return $targetUrl;
            }
        }
        if (!empty($requestedRedirectTo)) {
            return $requestedRedirectTo;
        }
        if (!empty($redirectTo)) {
            return $redirectTo;
        }
        return $targetUrl;
    },
    10,
    3,
);

add_filter('show_admin_bar', function ($show) {
    if (!is_user_logged_in()) {
        return $show;
    }
    $currentUser = wp_get_current_user();
    $currentRoles = is_array($currentUser->roles) ? $currentUser->roles : [];
    if (in_array('czlonek_zwyczajny', $currentRoles, true) || in_array('czlonek_wspierajacy', $currentRoles, true)) {
        return false;
    }
    return $show;
});

// logic of access and links

add_filter(
    'wp_nav_menu_objects',
    function ($panelpvMenuItems, $panelpvArgs) {
        $panelpvUser = wp_get_current_user();
        $panelpvUserRoles = is_user_logged_in() && is_array($panelpvUser->roles) ? $panelpvUser->roles : [];

        $panelpvIsRoleZwyczajny = in_array('czlonek_zwyczajny', $panelpvUserRoles, true);
        $panelpvIsRoleWspierajacy = in_array('czlonek_wspierajacy', $panelpvUserRoles, true);

        $panelpvKeepIdsForGuests = [4487, 4491];
        $panelpvRemoveForZwyczajny = [4539];
        $panelpvRemoveForWspierajacy = [4540];

        $panelpvFiltered = [];

        if (!$panelpvIsRoleZwyczajny && !$panelpvIsRoleWspierajacy) {
            foreach ($panelpvMenuItems as $panelpvItem) {
                $panelpvId = isset($panelpvItem->ID) ? intval($panelpvItem->ID) : 0;
                if (in_array($panelpvId, $panelpvKeepIdsForGuests, true)) {
                    $panelpvFiltered[] = $panelpvItem;
                }
            }
            return $panelpvFiltered;
        }

        if ($panelpvIsRoleZwyczajny) {
            foreach ($panelpvMenuItems as $panelpvItem) {
                $panelpvId = isset($panelpvItem->ID) ? intval($panelpvItem->ID) : 0;
                if (!in_array($panelpvId, $panelpvRemoveForZwyczajny, true)) {
                    $panelpvFiltered[] = $panelpvItem;
                }
            }
            return $panelpvFiltered;
        }

        if ($panelpvIsRoleWspierajacy) {
            foreach ($panelpvMenuItems as $panelpvItem) {
                $panelpvId = isset($panelpvItem->ID) ? intval($panelpvItem->ID) : 0;
                if (!in_array($panelpvId, $panelpvRemoveForWspierajacy, true)) {
                    $panelpvFiltered[] = $panelpvItem;
                }
            }
            return $panelpvFiltered;
        }

        return $panelpvMenuItems;
    },
    10,
    2,
);

add_action('template_redirect', function () {
    $panelpvRequestUri = isset($_SERVER['REQUEST_URI']) ? sanitize_text_field(wp_unslash($_SERVER['REQUEST_URI'])) : '';
    if ($panelpvRequestUri === '') {
        return;
    }

    $panelpvContentRule = panelpv_get_member_content_rule_for_request($panelpvRequestUri);

    if (empty($panelpvContentRule)) {
        return;
    }

    $panelpvCurrentUrl = (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $panelpvRequestUri;
    $panelpvRedirectUrl = add_query_arg('redirect_to', rawurlencode($panelpvCurrentUrl), home_url('/moje-konto/'));

    if (!is_user_logged_in()) {
        wp_safe_redirect($panelpvRedirectUrl);
        exit();
    }

    $panelpvUser = wp_get_current_user();
    $panelpvRoles = is_array($panelpvUser->roles) ? $panelpvUser->roles : [];
    $panelpvIsAdmin = in_array('administrator', $panelpvRoles, true);

    if ($panelpvIsAdmin) {
        return;
    }

    if (empty(array_intersect($panelpvContentRule['allowed_roles'], $panelpvRoles))) {
        wp_safe_redirect($panelpvRedirectUrl);
        exit();
    }
});

add_action('pre_get_posts', function ($query) {
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    if ($query->is_post_type_archive('czlonkostwo-wspier')) {
        $query->set('post_type', ['czlonkostwo-wspier', 'czlonkostwo-zwycz']);
    }
});
