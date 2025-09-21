<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 5.2.0
 */
if (! defined('ABSPATH')) {
	exit;
}

$shop_page_id = get_option('woocommerce_shop_page_id');

do_action('woocommerce_before_mini_cart'); ?>
<div class="shop_table cart sidebar__cart">

<?php if (! WC()->cart->is_empty()) : ?>
	<form action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post" id="mini-cart-form">
		<ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr($args['list_class']); ?>">
			<?php
				do_action('woocommerce_before_mini_cart_contents');

				foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
					$_product     = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
					$product_id   = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

					if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {
						$product_name      = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
						$thumbnail         = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
						$product_price     = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
						$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
						?>
						<li class="woocommerce-mini-cart-item <?php echo esc_attr(apply_filters('woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key)); ?>">
							<div class="cart-image-wrapper">
								<?php
								echo apply_filters('woocommerce_cart_item_remove_link', sprintf(
									'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
									esc_url(wc_get_cart_remove_url($cart_item_key)),
									__('Usuń ten produkt', 'woocommerce'),
									esc_attr($product_id),
									esc_attr($cart_item_key),
									esc_attr($_product->get_sku())
								), $cart_item_key);
								?>
								<a href="<?php echo esc_url($product_permalink); ?>" class="cart-image">
									<?php echo str_replace(array('http:', 'https:'), '', $thumbnail); ?>
								</a>
							</div>
							<div class="cart-content-wrapper">
								<?php echo wc_get_formatted_cart_item_data($cart_item); ?>
								<p class="cart-product-name"><?php echo $product_name;?></p>
								<div>
									<?php
									if ($_product->is_sold_individually()) {
											 $product_quantity = sprintf('<input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
									 } else {
											$input_args = array(
													'input_name' => "cart[{$cart_item_key}][qty]",
													'input_value' => $cart_item['quantity'],
													'max_value' => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
													'min_value' => '0'
											);
		
											$product_quantity = woocommerce_quantity_input($input_args, $_product, false);
											}
											echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item);
											?>
									<div class="tidy-minicart-price"><?php echo $product_price;?></div>
								</div>
							</div>
						</li>
						<?php
					}
				}

				do_action('woocommerce_mini_cart_contents');
			?>
		</ul>



		<?php do_action('woocommerce_widget_shopping_cart_before_buttons'); ?>
	</form>
<?php else : ?>
	<div class="flying-cart-content empty">
		<p><?php _e('Your cart is empty', 'ercodingtheme'); ?></p>
		<p><?php _e('Go shopping', 'ercodingtheme'); ?></p>
		<div class="emoji  emoji--yay">
		  <div class="emoji__face">
		    <div class="emoji__eyebrows"></div>
		    <div class="emoji__mouth"></div>
		  </div>
		</div>
		<a href="<?php echo get_the_permalink($shop_page_id); ?>" class="button"><?php _e('Browse products', 'ercodingtheme'); ?></a>
	</div>
<?php endif; ?>
</div>
<?php do_action('woocommerce_after_mini_cart'); ?>
