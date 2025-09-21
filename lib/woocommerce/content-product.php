<?php

remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');

add_action( 'woocommerce_after_shop_loop_item_title', 'addButtonToShop', 10 );

function addButtonToShop(){
  get_template_part('template-parts/content-product-button') ;
}
