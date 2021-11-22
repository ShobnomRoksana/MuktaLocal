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
 * @package WooCommerce/Templates
 * @version 3.7.0
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
				$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
				$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
				$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				<li class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
				 <div class="row">
					<?php if ( empty( $product_permalink ) ) : ?>
						<div class="col-xs-5">
							<?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
						<div class="col-xs-7">
							<?php echo $product_name; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							
							<div itemprop="description" class="custom-product-short-description" style="font-size: 1.1rem;letter-spacing: 0.04rem;text-transform: uppercase;margin-top: 5px;margin-bottom: 5px;line-height: 1.8rem;">
								<?php echo apply_filters( 'woocommerce_short_description', $_product->post->post_excerpt ) ?>
							</div>
						</div>
					<?php else : ?>
						<a href="<?php echo esc_url( $product_permalink ); ?>" class="custom-product-title">
							
							<div class="col-xs-5 custom-woo-product-img">
								<?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</div>
							<div class="col-xs-7">
								<strong><?php echo $product_name; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
								
								<div itemprop="description" class="custom-product-short-description" style="font-size: 1.1rem;letter-spacing: 0.04rem;text-transform: uppercase;margin-top: 5px;margin-bottom: 5px;line-height: 1.8rem;">
									<?php echo apply_filters( 'woocommerce_short_description', $_product->post->post_excerpt ) ?>
								</div>
								<div>
								<div>
								<?php 
								//echo do_shortcode( "[yith_wcwl_add_to_wishlist product_id=".$cart_item['product_id']."]");
								 ?></div>
														<?php   
						// do_action( 'woocommerce_single_product_summary' );

						// 		 // test if product is variable
						// 		 if ($product->is_type( 'variable' )) 
						// 		 {
						// 			 $available_variations = $product->get_available_variations();
						// 			 foreach ($available_variations as $key => $value) 
						// 			 { 
						// 				 //get values HERE  
						// 				echo $available_variations[$key];

						// 			 }
						// 		 }
						echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<div style="border: 1px solid black;display: flex;flex-direction: row;width: 130px;border-radius: 25px;height: 38px;">
								<div style="position: relative;"><?php echo '<a class="btnPlus"  style="font-size: 25px;padding: 3px 12px;display: block;width: 40px;height: 35px;cursor: pointer;text-align: center;left: 0;right: 0;top: 0;bottom: 0;" onClick="updateQty(\''.$cart_item_key.'\','.($cart_item['quantity']+1).')"> + </a>'; ?></div>
								<div style="position: relative;"><?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity" style="font-size: 16px;padding: 3px 8px;display: block;width: 50px;height: 35px;cursor: pointer;text-align: center;left: 0;right: 0;top: 0;bottom: 0;">' . sprintf( '%s', $cart_item['quantity'] ) . '</span>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
								<div style="position: relative;"><?php echo '<a class="btnMinus"  style="font-size: 25px;padding: 3px 12px;display: block;width: 40px;height: 35px;cursor: pointer;text-align: center;left: 0;right: 0;top: 0;bottom: 0;" onClick="updateQty(\''.$cart_item_key.'\','.($cart_item['quantity']-1).')"> - </a>'; ?></div>
							</div>
							
						</div>	
						<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity" style="font-weight: 700; margin-top: 8px; margin-bottom: 8px;">' . sprintf( '%s', $product_price ) . '</span>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>					

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
						</a>
					<?php endif; ?>
					</div>
					<div class="row">
						<div class="col-xs-2"></div>
						<div class="col-xs-8" style="background: #fed2c7;height: 6px;width: 70%;border-radius: 10px;margin-top: 20px;"></div>
						<div class="col-xs-2"></div>
					</div>
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

	<p class="woocommerce-mini-cart__empty-message"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
