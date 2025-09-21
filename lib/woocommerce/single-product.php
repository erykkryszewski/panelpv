<?php

// change order of elements on single product page
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);

add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 20);

// change gallery image size

add_filter( 'woocommerce_gallery_thumbnail_size', function() {
  return 'medium';
} );
