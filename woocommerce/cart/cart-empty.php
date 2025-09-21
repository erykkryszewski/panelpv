<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined('ABSPATH') || exit;

if (wc_get_page_id('shop') > 0) :

?>
	<div class="empty-cart">
		<div class="container-fluid">
			<div class="empty-cart__content">
				<h2 class="empty-cart__title"><?php _e('Twój koszyk jest pusty', 'woocommerce'); ?></h2>
				<a href="/sklep" class="empty-cart__button button">Sklep</a>
			</div>
		</div>
	</div>
<?php endif; ?>
