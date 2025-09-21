<?php
/* Template Name: Moje konto */

get_header();
the_post();

$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

$panelpvLoginErrorMessage = '';
$panelpvIsLockedOut = false;
$panelpvRedirectTarget = home_url('/');

if (isset($_GET['redirect_to'])) {
    $panelpvRedirectTarget = esc_url_raw($_GET['redirect_to']);
}

if (isset($_POST['panelpv_redirect_to'])) {
    $panelpvRedirectTarget = esc_url_raw($_POST['panelpv_redirect_to']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['panelpv_logout_nonce'])) {
    if (wp_verify_nonce($_POST['panelpv_logout_nonce'], 'panelpv_logout_action')) {
        wp_logout();
        wp_safe_redirect(get_permalink());
        exit;
    }
}

if (!is_user_logged_in() && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['panelpv_login_nonce'])) {
    $panelpvClientIp = isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field($_SERVER['REMOTE_ADDR']) : '0.0.0.0';
    $panelpvLoginRaw = isset($_POST['panelpv_login']) ? wp_unslash($_POST['panelpv_login']) : '';
    $panelpvPasswordRaw = isset($_POST['panelpv_password']) ? $_POST['panelpv_password'] : '';
    $panelpvLoginSanitized = sanitize_text_field($panelpvLoginRaw);
    $panelpvRateKey = 'panelpv_login_rate_' . md5($panelpvClientIp . '|' . strtolower($panelpvLoginSanitized));
    $panelpvRateData = get_transient($panelpvRateKey);
    $panelpvMaxAttempts = 5;
    $panelpvLockMinutes = 15;

    if (is_array($panelpvRateData) && isset($panelpvRateData['count']) && isset($panelpvRateData['locked'])) {
        if ($panelpvRateData['locked'] === true) {
            $panelpvIsLockedOut = true;
            $panelpvLoginErrorMessage = __('Too many failed attempts. Try again later.', 'panelpv');
        }
    }

    if ($panelpvIsLockedOut === false) {
        if (wp_verify_nonce($_POST['panelpv_login_nonce'], 'panelpv_login_action')) {
            $panelpvUserLoginToUse = $panelpvLoginSanitized;
            if (is_email($panelpvLoginSanitized)) {
                $panelpvUserByEmail = get_user_by('email', $panelpvLoginSanitized);
                if ($panelpvUserByEmail && isset($panelpvUserByEmail->user_login)) {
                    $panelpvUserLoginToUse = $panelpvUserByEmail->user_login;
                }
            }

            $panelpvCreds = array(
                'user_login' => $panelpvUserLoginToUse,
                'user_password' => $panelpvPasswordRaw,
                'remember' => true,
            );

            $panelpvUser = wp_signon($panelpvCreds, is_ssl());

            if (is_wp_error($panelpvUser)) {
                $panelpvCurrentCount = 0;
                if (is_array($panelpvRateData) && isset($panelpvRateData['count'])) {
                    $panelpvCurrentCount = intval($panelpvRateData['count']);
                }
                $panelpvCurrentCount = $panelpvCurrentCount + 1;
                $panelpvShouldLock = false;
                if ($panelpvCurrentCount >= $panelpvMaxAttempts) {
                    $panelpvShouldLock = true;
                }
                set_transient($panelpvRateKey, array('count' => $panelpvCurrentCount, 'locked' => $panelpvShouldLock), $panelpvLockMinutes * MINUTE_IN_SECONDS);
                if ($panelpvShouldLock === true) {
                    $panelpvIsLockedOut = true;
                    $panelpvLoginErrorMessage = __('Too many failed attempts. Try again later.', 'panelpv');
                } else {
                    $panelpvLoginErrorMessage = __('Invalid credentials.', 'panelpv');
                }
            } else {
                delete_transient($panelpvRateKey);
                $panelpvSafeRedirect = $panelpvRedirectTarget;
                if (empty($panelpvSafeRedirect)) {
                    $panelpvSafeRedirect = home_url('/');
                }
                wp_safe_redirect($panelpvSafeRedirect);
                exit;
            }
        } else {
            $panelpvLoginErrorMessage = __('Security check failed.', 'panelpv');
        }
    }
}
?>

<main id="main" class="main <?php if(!is_front_page()) { echo 'main--subpage'; }?> <?php if(strpos($url, 'polityka-prywatnosci') !== false || strpos($url, 'regulamin') !== false) { echo 'main--rules-page'; }?>">
    <div class="subpage-hero">
        <div class="subpage-hero__background subpage-hero__background--plain"></div>
        <div class="container">
            <div class="subpage-hero__wrapper">
                <h1 class="subpage-hero__title"><?php echo apply_filters('the_title', 'Moje konto');?></h1>
            </div>
        </div>
    </div>
    <div class="spacer" style="height: 90px"></div>

    <div class="panelpv-my-account">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
                    <div class="panelpv-my-account__wrapper">

                        <?php if (!is_user_logged_in()): ?>
                            <div class="panelpv-my-account__box panelpv-my-account__box--login">
                                <div class="panelpv-my-account__head">
                                    <h3 class="panelpv-my-account__title"><?php echo esc_html__('Zaloguj się', 'panelpv'); ?></h3>
                                </div>

                                <?php if (!empty($panelpvLoginErrorMessage)): ?>
                                    <div class="panelpv-my-account__notice panelpv-my-account__notice--error">
                                        <div class="panelpv-my-account__notice-text"><?php echo esc_html($panelpvLoginErrorMessage); ?></div>
                                    </div>
                                <?php endif; ?>

                                <?php if ($panelpvIsLockedOut === true): ?>
                                    <div class="panelpv-my-account__notice panelpv-my-account__notice--lock">
                                        <div class="panelpv-my-account__notice-text"><?php echo esc_html__('Logowanie tymczasowo zablokowane.', 'panelpv'); ?></div>
                                    </div>
                                <?php endif; ?>

                                <form class="panelpv-my-account__form panelpv-my-account__form--login" method="post" action="<?php echo esc_url(get_permalink()); ?>">
                                    <div class="panelpv-my-account__field">
                                        <label class="panelpv-my-account__label" for="panelpv_login"><?php echo esc_html__('Email lub nazwa użytkownika', 'panelpv'); ?></label>
                                        <input class="panelpv-my-account__input" type="text" id="panelpv_login" name="panelpv_login" autocomplete="username" required>
                                    </div>
                                    <div class="panelpv-my-account__field">
                                        <label class="panelpv-my-account__label" for="panelpv_password"><?php echo esc_html__('Hasło', 'panelpv'); ?></label>
                                        <input class="panelpv-my-account__input" type="password" id="panelpv_password" name="panelpv_password" autocomplete="current-password" required>
                                    </div>
                                    <input type="hidden" name="panelpv_redirect_to" value="<?php echo esc_attr($panelpvRedirectTarget); ?>">
                                    <?php wp_nonce_field('panelpv_login_action', 'panelpv_login_nonce'); ?>
                                    <div>
                                        <button class="panelpv-my-account__button panelpv-my-account__button--primary button mt-3" type="submit"><?php echo esc_html__('Zaloguj', 'panelpv'); ?></button>
                                        <a class="panelpv-my-account__link panelpv-my-account__link--muted" href="<?php echo esc_url(wp_lostpassword_url(get_permalink())); ?>"><?php echo esc_html__('Nie pamiętasz hasła?', 'panelpv'); ?></a>
                                    </div>
                                </form>
                            </div>
                        <?php else: ?>
                            <div class="panelpv-my-account__box panelpv-my-account__box--logged">
                                <div class="panelpv-my-account__body">
                                    <div class="panelpv-my-account__user">
                                        <h4 class="panelpv-my-account__user-label"><?php echo esc_html__('Zalogowano jako', 'panelpv'); ?>&nbsp;</h4>
                                        <h4 class="panelpv-my-account__user-name"><?php echo esc_html(wp_get_current_user()->display_name); ?></h4>
                                    </div>
                                    <div class="panelpv-my-account__actions panelpv-my-account__actions--row">
                                        <a class="panelpv-my-account__button panelpv-my-account__button--secondary button" href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html__('Materiały', 'panelpv'); ?></a>
                                        <form class="panelpv-my-account__form panelpv-my-account__form--logout" method="post" action="<?php echo esc_url(get_permalink()); ?>">
                                            <?php wp_nonce_field('panelpv_logout_action', 'panelpv_logout_nonce'); ?>
                                            <button class="panelpv-my-account__button panelpv-my-account__button--danger panelpv-my-account__logout button" type="submit"><?php echo esc_html__('Wyloguj', 'panelpv'); ?></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
<?php get_footer(); ?>
