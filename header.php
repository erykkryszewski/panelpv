<?php

if (is_woocommerce_activated()) {
  global $woocommerce;
  $cart_items_number = $woocommerce->cart->get_cart_contents_count();
}

$global_phone_number = get_field('global_phone_number', 'options');
$global_logo = get_field('global_logo', 'options');
$theme_sign = get_field('theme_sign', 'options');
$global_email = get_field('global_email', 'options');
$global_terms_and_conditions = get_field('global_terms_and_conditions', 'options');
$global_privacy_policy = get_field('global_privacy_policy', 'options');
$global_social_media = get_field('global_social_media', 'options');
$header_button = get_field('header_button', 'options');
$header_second_button = get_field('header_second_button', 'options');

$body_classes = get_body_class();
?>

<!DOCTYPE html>
<html lang="<?php bloginfo('language'); ?>">

<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1" />
  <link
    href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap"
    rel="stylesheet">
  <?php wp_head(); ?>
</head>

<body <?php if (!is_front_page()) {
  body_class('theme-subpage');
} else {
  body_class('theme-frontpage');
} ?>>
  <div class="preloader">
    <div class="preloader__logo">
      <?php if (!empty($theme_sign)) {
        echo wp_get_attachment_image($theme_sign, 'full', '', ['class' => '']);
      } else {
        echo '';
      } ?>
    </div>
  </div>
  <header class="header <?php if (!is_front_page()) {
    echo 'header--subpage';
  } ?>">
    <div class="top-bar">
      <div class="container">
        <div class="top-bar__wrapper">
          <div class="top-bar__content top-bar__content--left">
            <a href="tel:<?php echo esc_html($global_phone_number); ?>"
              class="top-bar__phone ercodingtheme-phone-number"><?php echo esc_html($global_phone_number); ?></a>
            <a href="mailto:<?php echo esc_html($global_email); ?>"
              class="top-bar__email"><?php echo esc_html($global_email); ?></a>
          </div>

<div class="top-bar__content top-bar__content--right">
    <?php if (is_user_logged_in()) { ?>
        <a href="<?php echo esc_url(wp_logout_url(home_url('/'))); ?>" class="top-bar__panel">Wyloguj</a>
    <?php } else { ?>
        <a href="/moje-konto/" class="top-bar__panel">Logowanie</a>
    <?php } ?>
</div>


        </div>
      </div>
    </div>
    <div class="container">
      <nav class="nav <?php if (!is_front_page()) {
        echo 'nav--subpage';
      } ?>">
        <a href="/" class="nav__logo <?php if (!is_front_page()) {
          echo 'nav__logo--subpage';
        } ?>">
          <?php if (!empty($global_logo)) {
            echo wp_get_attachment_image($global_logo, 'full', '', ['class' => '']);
          } else {
            echo 'Logo';
          } ?>
        </a>
        <div class="nav__content <?php if (!is_front_page()) {
          echo 'nav__content--subpage';
        } ?>">
          <?php
          $menu_class = is_front_page() ? 'nav__menu' : 'nav__menu nav__menu--subpage';
          echo wp_nav_menu(['theme_location' => 'Navigation', 'container' => 'ul', 'menu_class' => $menu_class]);
          ?>
          <?php if (!empty($header_button) || !empty($header_second_button)): ?>
          <div class="nav__buttons">
            <?php if (!empty($header_button)): ?>
            <a href="<?php echo esc_url($header_button['url']); ?>"
              target="<?php echo !empty($header_button['target']) ? esc_attr($header_button['target']) : '_self'; ?>"
              class="button nav__button nav__button--first <?php if (!is_front_page()) {
                echo 'nav__button--subpage';
              } ?>">
              <?php echo esc_html($header_button['title']); ?>
            </a>
            <?php endif; ?>

            <?php if (!empty($header_second_button)): ?>
            <a href="<?php echo esc_url($header_second_button['url']); ?>" target="<?php echo !empty(
  $header_second_button['target']
)
  ? esc_attr($header_second_button['target'])
  : '_self'; ?>" class="button nav__button nav__button--second <?php if (!is_front_page()) {
  echo 'nav__button--subpage';
} ?>">
              <?php echo esc_html($header_second_button['title']); ?>
            </a>
            <?php endif; ?>
          </div>
          <?php endif; ?>

          <div class="hamburger nav__hamburger <?php if (!is_front_page()) {
            echo 'nav__hamburger--subpage';
          } ?>">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>
      </nav>
    </div>
  </header>