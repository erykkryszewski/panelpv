<?php


// Refresh cart in menu

add_filter( 'woocommerce_add_to_cart_fragments', 'wc_refresh_mini_cart_count');

function wc_refresh_mini_cart_count($fragments) {
  ob_start();
  $cart_items_number = WC()->cart->get_cart_contents_count();
  ?>
  <span class="<?php if($cart_items_number > 0) { echo 'active'; }?>" id="mini-cart-count"><?php echo esc_html($cart_items_number);?></span>
  <?php
      $fragments['#mini-cart-count'] = ob_get_clean();
  return $fragments;
}


// Add category class to cart items based on product category

add_filter( 'woocommerce_cart_item_class', 'add_category_class_to_cart_item', 10, 3 );
function add_category_class_to_cart_item( $class, $cart_item, $cart_item_key ) {
  // Get the product ID from the cart item
  $product_id = $cart_item['product_id'];
  // Get the product categories
  $categories = get_the_terms( $product_id, 'product_cat' );
  // Check if the product belongs to any categories
  if ( $categories && ! is_wp_error( $categories ) ) {
    // Add a category class for each category
    foreach ( $categories as $category ) {
        $class .= ' category-' . $category->slug;
    }
  }
  return $class;
}
