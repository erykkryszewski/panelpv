<?php

// change sale to okazja
add_filter('woocommerce_sale_flash', 'ercodingtheme_change_sale_text');

function ercodingtheme_change_sale_text() {
  return '<span class="onsale">Okazja</span>';
}

// change number of products that are displayed per page (shop page)
add_filter('loop_shop_per_page', 'new_loop_shop_per_page', 20);

function new_loop_shop_per_page($cols) {
  // $cols contains the current number of products per page based on the value stored on Options –> Reading
  // Return the number of products you wanna show per page.
  $cols = 15;
  return $cols;
}

// change woocommerce thumbnail image size
add_filter( 'woocommerce_get_image_size_thumbnail', function( $size ) {
  return array(
    'width'  => 9999,
    'height' => 9999,
    'crop'   => false,
  );
});

add_filter( 'woocommerce_get_image_size_single', function( $size ) {
  return array(
    'width'  => 9999,
    'height' => 9999,
    'crop'   => false,
  );
});

add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
  return array(
    'width'  => 9999,
    'height' => 9999,
    'crop'   => false,
  );
});

// fix related products
add_filter( 'woocommerce_get_related_product_cat_terms', function ( $terms, $product_id ) {
  $product_terms = get_the_terms( $product_id, 'product_cat' );
  if ( ! empty ( $product_terms ) ) {
      $last_term = end( $product_terms );
      return (array) $last_term;
  }

  return $terms;
}, 20, 2 );

// disable all shipping methods when free shipping is available

add_filter('woocommerce_package_rates', function($rates) {
  $free = array();
  foreach ($rates as $rate_id => $rate) {
    if ('free_shipping' === $rate->method_id) {
      $free[$rate_id] = $rate;
      break;
    }
  }
  return !empty($free) ? $free : $rates;
}, 100);
