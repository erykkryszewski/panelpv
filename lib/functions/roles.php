<?php
add_action('after_setup_theme', function () {
    add_role('czlonek_zwyczajny', 'Członek zwyczajny', array('read' => true));
    add_role('czlonek_wspierajacy', 'Członek wspierający', array('read' => true));
});

function panelpv_admin_go_home_handler() {
    wp_safe_redirect(home_url('/'));
    exit;
}

add_action('admin_menu', function () {
    if (!is_user_logged_in()) {
        return;
    }
    $currentUser = wp_get_current_user();
    $currentRoles = is_array($currentUser->roles) ? $currentUser->roles : array();
    $isMemberRole = in_array('czlonek_zwyczajny', $currentRoles, true) || in_array('czlonek_wspierajacy', $currentRoles, true);
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
        2
    );
}, 9);

add_action('admin_menu', function () {
    if (!is_user_logged_in()) {
        return;
    }
    $currentUser = wp_get_current_user();
    $currentRoles = is_array($currentUser->roles) ? $currentUser->roles : array();
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
    remove_submenu_page('users.php', 'user-new.php');
    remove_submenu_page('users.php', 'users.php');
}, 99);

add_action('admin_init', function () {
    if (!is_user_logged_in()) {
        return;
    }
    $currentUser = wp_get_current_user();
    $currentRoles = is_array($currentUser->roles) ? $currentUser->roles : array();
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
        exit;
    }
    if (!$isProfileScreen && !$isGoHomeScreen) {
        wp_safe_redirect(admin_url('profile.php'));
        exit;
    }
});

add_filter('login_redirect', function ($redirectTo, $requestedRedirectTo, $user) {
    $targetPage = get_page_by_path('moje-konto', OBJECT, 'page');
    $targetUrl = $targetPage ? get_permalink($targetPage) : home_url('/');
    if ($user instanceof WP_User) {
        $userRoles = is_array($user->roles) ? $user->roles : array();
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
}, 10, 3);

add_filter('show_admin_bar', function ($show) {
    if (!is_user_logged_in()) {
        return $show;
    }
    $currentUser = wp_get_current_user();
    $currentRoles = is_array($currentUser->roles) ? $currentUser->roles : array();
    if (in_array('czlonek_zwyczajny', $currentRoles, true) || in_array('czlonek_wspierajacy', $currentRoles, true)) {
        return false;
    }
    return $show;
});




// logic of access and links

add_filter('wp_nav_menu_objects', function ($panelpvMenuItems, $panelpvArgs) {
    $panelpvUser = wp_get_current_user();
    $panelpvUserRoles = is_user_logged_in() && is_array($panelpvUser->roles) ? $panelpvUser->roles : array();

    $panelpvIsRoleZwyczajny = in_array('czlonek_zwyczajny', $panelpvUserRoles, true);
    $panelpvIsRoleWspierajacy = in_array('czlonek_wspierajacy', $panelpvUserRoles, true);

    $panelpvKeepIdsForGuests = array(4487, 4491);
    $panelpvRemoveForZwyczajny = array(4539);
    $panelpvRemoveForWspierajacy = array(4540);

    $panelpvFiltered = array();

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
}, 10, 2);
