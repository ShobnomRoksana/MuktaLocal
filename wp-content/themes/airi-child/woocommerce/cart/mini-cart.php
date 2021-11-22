<style>
.mini_cart_quantity_btn, .d-none {
	display: none !important;
}
.mini-cart-info .shop-bag-items-title {
	font-weight: 700;
	margin: 0;
}
.mini-cart-info .shortDescription {
	font-size: 12px;
	margin: 0;
}
.mini-cart-info dl dt, .mini-cart-info dl dd {
    float: left;
}
.mini-cart-info dl dt, .mini_cart_price_wrap {
    clear: both;
}
.mini-cart-info dl dt, .mini_cart_quantity_wrap .quantity {
	font-weight: 400;
	font-size: 12px !important;
	line-height: 1.2 !important;
}
.mini_cart_quantity_wrap .quantity {
	border: 1px solid #fed2c7;
	padding: 3px 5px;
	font-weight: 500;
}
.mini-cart-info .variation {
    display: inherit;
}
.mini-cart-info .variation dd {
    margin-left: 5px;
		font-weight: 500;
}
.mini-cart-info .variation p {
    line-height: 1.4;
}
.mini_cart_quantity_wrap, .mini_cart_row {
	display: flex;
	align-items: center;
}
.mini_cart_wishlist {
	width: 25px;
	height: 25px;
	margin-left: 10px;
}
.mini_cart_wishlist .yith-wcwl-icon, .mini_cart_wishlist .yith-wcwl-wishlistaddedbrowse a.custom-browse-icon {
	max-width: 100%;
	width: 23px;
	height: 23px;
}
.woocommerce-mini-cart-item:after {
	content: '';
	background: #fed2c7;
	height: 6px;
	width: 70%;
	border-radius: 10px;
	margin: 20px auto;
}

</style>

<?php
/**
 * Custom Mini-cart Template
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_single_product' );
$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
$description = apply_filters( 'woocommerce_product_description_heading', __( 'Description', 'woocommerce' ) );
global $woocommerce, $product, $post;
if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}

do_action( 'woocommerce_before_mini_cart' ); ?>
<?php
/**
 * woocommerce_before_single_product hook.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( ! WC()->cart->is_empty() ) : ?>

	<ul class="woocommerce-mini-cart cart_list product_list_widget custom-woocommerce-mini-cart <?php echo esc_attr( $args['list_class'] ); ?>">
		<?php
		do_action( 'woocommerce_before_mini_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
				$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				<li class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
				 <div class="row mini_cart_row">
					<?php if ( empty( $product_permalink ) ) : ?>
						<div class="col-xs-5">
							<?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
						<div class="col-xs-7 mini-cart-info">
							<?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' ); ?>
						</div>
					<?php else : ?>
							<div class="col-xs-5 custom-woo-product-img">
								<?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</div>
							<div class="col-xs-7 mini-cart-info">
								<?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s" class="shop-bag-items-title">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );?>
								<?php	echo wc_get_formatted_cart_item_data( $cart_item );?>
								<div class="mini_cart_price_wrap">
									<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity',
									'<span class="price" style="font-weight: 700; margin-top: 8px; margin-bottom: 8px;">'
									.sprintf( '%s', $product_price ) . '</span>', $cart_item, $cart_item_key );?>
								</div>
								<div class="mini_cart_quantity_wrap" style="margin: 5px 0px;">
									<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">'
									. sprintf( 'Total: %s', $cart_item['quantity']) . '</span>',
									 $cart_item, $cart_item_key ); ?>
									<?php echo '<div class="mini_cart_wishlist">
									' .do_shortcode("[yith_wcwl_add_to_wishlist product_id=" . $cart_item['product_id']."]"). '
									</div>'
									?>
								</div>
								<div class="mini_cart_quantity_btn" style="border: 1px solid black;display: flex;flex-direction: row;width: 130px;border-radius: 25px;height: 38px;">
									<div style="position: relative;"><?php echo '<a class="btnPlus"  style="font-size: 25px;padding: 3px 12px;display: block;width: 40px;height: 35px;cursor: pointer;text-align: center;left: 0;right: 0;top: 0;bottom: 0;" onClick="updateQty(\''.$cart_item_key.'\','.($cart_item['quantity']+1).')"> + </a>'; ?></div>
									<div style="position: relative;"><?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity" style="font-size: 16px;padding: 3px 8px;display: block;width: 50px;height: 35px;cursor: pointer;text-align: center;left: 0;right: 0;top: 0;bottom: 0;">' . sprintf( '%s', $cart_item['quantity'] ) . '</span>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
									<div style="position: relative;"><?php echo '<a class="btnMinus"  style="font-size: 25px;padding: 3px 12px;display: block;width: 40px;height: 35px;cursor: pointer;text-align: center;left: 0;right: 0;top: 0;bottom: 0;" onClick="updateQty(\''.$cart_item_key.'\','.($cart_item['quantity']-1).')"> - </a>'; ?></div>
								</div>
								<?php echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<div><a href="%s" class="remove remove_from_cart_button custom-woo-remove" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">Remove &times;</a></div>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										esc_attr__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $cart_item_key ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								);
								?>
							</div>
					<?php endif; ?>
					</div>
					<!-- <div class="row">
						<div class="col-xs-2"></div>
						<div class="col-xs-8" style="background: #fed2c7;height: 6px;width: 70%;border-radius: 10px;margin-top: 20px;"></div>
						<div class="col-xs-2"></div>
					</div> -->
				</li>
				<?php
			}
		}

		do_action( 'woocommerce_mini_cart_contents' );
		?>
	</ul>
	<div class="woocommerce-mini-cart__total total">
		<?php
		/**
		 * Hook: woocommerce_widget_shopping_cart_total.
		 *
		 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
		 */
		do_action( 'woocommerce_widget_shopping_cart_total' );
		?>
	</div>
	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

	<div class="woocommerce-mini-cart__buttons buttons custom-woo-button"><?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?></div>

	<?php do_action( 'woocommerce_widget_shopping_cart_after_buttons' ); ?>

<?php else : ?>

	<p class="woocommerce-mini-cart__empty-message"><?php esc_html_e( 'No products in the Bag.', 'woocommerce' ); ?></p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
