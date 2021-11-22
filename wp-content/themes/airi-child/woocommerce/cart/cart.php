<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;
global $woocommerce;
$count = $woocommerce->cart->cart_contents_count;
do_action( 'woocommerce_before_cart' ); ?>
<div class="row">
	<div class="col-md-8">
		<div class="row" style="padding-left: 15px; padding-right: 15px; padding-bottom: 15px;">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-md-6 text-center top-pink-box"><a href="">Shopping Bag</a></div>
					<div class="col-md-6 text-center top-white-box"><a href="">Proceed with Order</a></div>
				</div>
			</div>
			<div class="col-sm-12 shop-bag-title-box">
				<div class="row">
					<div class="col-xs-6 shop-bag-title-box-title">Shopping Bag</div>
					<div class="col-xs-6 text-right shop-bag-title-box-p"><a href="<?php echo wc_get_cart_url() ?>" class="custom-qty-change-in-ajax-cart"><?php echo $woocommerce->cart->cart_contents_count; ?></a></div>
				</div>
			</div>
		  <div class="col-sm-12 shop-bag-items-container">
		<form class="woocommerce-cart-form display-flex" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
		<?php do_action( 'woocommerce_before_cart_table' ); ?>
		<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
			<thead style="display:none;">
				<tr>
					<th class="product-remove">&nbsp;</th>
					<th class="product-thumbnail">&nbsp;</th>
					<th class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
					<th class="product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
					<th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
					<th class="product-subtotal"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php do_action( 'woocommerce_before_cart_contents' ); ?>

				<?php
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
						?>
						<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
							<td class="product-thumbnail">
							<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

							if ( ! $product_permalink ) {
								echo $thumbnail; // PHPCS: XSS ok.
							} else {
								printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
							}
							?>
							</td>

							<td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
							<?php
							if ( ! $product_permalink ) {
								echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
							} else {
								echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s" class="shop-bag-items-title">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );

							} ?>
							<?php do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

							// Meta data.
							echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

							// Backorder notification.
							if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
								echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
							}
							?>
							<div class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
							<?php
							if ( $_product->is_sold_individually() ) {
								$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
							} else {
								$product_quantity = woocommerce_quantity_input(
									array(
										'input_name'   => "cart[{$cart_item_key}][qty]",
										'input_value'  => $cart_item['quantity'],
										'max_value'    => $_product->get_max_purchase_quantity(),
										'min_value'    => '0',
										'product_name' => $_product->get_name(),
									),
									$_product,
									false
								);
							}

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
							?>
							</div>
							<?php echo '<div class="product_wl_btn">
							' .do_shortcode("[yith_wcwl_add_to_wishlist product_id=" . $cart_item['product_id']."]"). '
							</div>'
							?>
							<dl class="product-remove">
								<?php
									echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										'woocommerce_cart_item_remove_link',
										sprintf(
											'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">Remove <span class="cross-shop">&times;</span></a>',
											esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
											esc_html__( 'Remove this item', 'woocommerce' ),
											esc_attr( $product_id ),
											esc_attr( $_product->get_sku() )
										),
										$cart_item_key
									);
								?>
							</dl>
							</td>

							<td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
								<?php
									echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
								?>
							</td>
						</tr>
						<?php
					}
				}
				?>

				<?php do_action( 'woocommerce_cart_contents' ); ?>

				<tr class="coupon_wrap">
					<td colspan="6" class="actions">

						<?php if ( wc_coupons_enabled() ) { ?>
							<div class="coupon cart-coupon">
								<label for="coupon_code"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'DISCOUNT CODE', 'woocommerce' ); ?>" style="border: 1px solid black;text-align: center;font-weight: 600;min-width: 56%;height: 50px;" /> <button type="submit" class="button custom-btn-default" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply', 'woocommerce' ); ?></button>
								<?php do_action( 'woocommerce_cart_coupon' ); ?>
							</div>
						<?php } ?>

						<button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

						<?php do_action( 'woocommerce_cart_actions' ); ?>

						<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
					</td>
				</tr>

				<?php do_action( 'woocommerce_after_cart_contents' ); ?>
			</tbody>
		</table>
	</form>
	<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
	</div>
	</div>
	</div>
	<div class="col-md-4">

		<div class="cart-collaterals bg-pink">
			<?php
				/**
				 * Cart collaterals hook.
				 *
				 * @hooked woocommerce_cross_sell_display
				 * @hooked woocommerce_cart_totals - 10
				 */
				do_action( 'woocommerce_cart_collaterals' );
			?>
		</div>
		<?php do_action( 'woocommerce_after_cart' ); ?>
	</div>
</div>
<style>
.cart-collaterals.bg-pink .shop_table.shop_table_responsive {
	background: #fed2c7;
}
.btn-clear-cart, [name='update_cart'] {
	display: none!important;
}
.cart-coupon {
	width: 100%!important;
	border: 0px!important;
}
/* Shopping bag */
.display-flex {
	display: flex!important;
}
.page-id-7.woocommerce-cart #section_page_header {
	display: none;
}
.top-pink-box {
	background: #fed2c7;
	padding: 10px;
	color: white;
	border: 2px solid #fed2c7;
	font-size: 1.5rem;
	font-weight: 600;
	text-transform: uppercase;
	letter-spacing: 0.1rem;
}
.top-white-box {
	background: #fff;
	padding: 10px;
	color: #fed2c7;
	border: 2px solid #fed2c7;
	font-size: 1.5rem;
	font-weight: 600;
	text-transform: uppercase;
	letter-spacing: 0.1rem;
}
.shop-bag-title-box {
	padding: 15px;
	border: 2px solid #fed2c7;
	margin-top: 20px;
}
.shop-bag-title-box-title {
	font-size: 1.8rem;
	color: black;
	font-weight: 600;
	text-transform: uppercase;
	letter-spacing: 0.1rem;
}
.shop-bag-items-title {
	font-size: 1.5rem;
	color: black;
	font-weight: 700;
	text-transform: uppercase;
	letter-spacing: 0.05rem;
}
.shop-bag-title-box-p {
	color: black;
	line-height: 3rem;
}
.shop-bag-items-container {
	border-left: 2px solid #fed2c7;
	border-right: 2px solid #fed2c7;
	border-bottom: 2px solid #fed2c7;
}
.shop-bag-items-container .woocommerce-cart-form .display-flex {
	padding-right: 0px;
}
.shop-bag-title-box-subtitle > p , .shop-bag-total , .shop-bag-total  .woocommerce-Price-amount,
.shop_table .tax-rate th, .shop_table .tax-rate .woocommerce-Price-amount.amount {
	font-size: 1.3rem;
	font-weight: 600 !important;
	text-transform: uppercase;
	letter-spacing: 0.02rem;
	color: black;
}
.order-total > .shop-bag-total .woocommerce-Price-amount {
	font-size: 2rem;
}
.page-id-7.woocommerce-cart .shop_table .product-remove {
	width: 110px;
	display: block;
	line-height: 0.6;
}
.shop_table .product-remove .remove::before {
    content: "";
    font-family: 'dl-icon';
    direction: ltr;
    font-size: 16px;
    text-rendering: auto;
}
.shop_table .product-remove .remove {
	font-size: 12px;
	color: black;
	display: inline-block;
	text-transform: uppercase;
}
.shop_table .product-remove .remove span{
	font-size: 25px;
	vertical-align: sub;
}
.bg-pink > .cart_totals {
	background-color: #fed2c7 !important;
	color: black;
	padding: 20px !important;
}
.shop-bag-items-container .shop_table .product-thumbnail img {
	/* max-width: 130px; */
	max-width: 100%;
	height: auto;
}
.shop-bag-items-container .product-quantity {
	width: auto;
	float: left;
  margin: 10px 15px 10px 0;
}
.cart_totals .custom-woo-shopping-bag {
    border-top-left-radius: 2rem;
    border-bottom-right-radius: 2rem;
    letter-spacing: 0.1rem;
    max-width: 70%;
    margin: 0 auto !important;
    padding-top: 1.3rem !important;
    padding-bottom: 1.3rem !important;
    padding-left: 1rem !important;
    padding-right: 1rem !important;
    font-weight: 600 !important;
    border: 4px solid #fff !important;
}
.page-id-7.woocommerce-cart .cart_totals h2 , .page-id-7.woocommerce-cart .woocommerce-shipping-destination,
.page-id-7.woocommerce-cart .woocommerce-shipping-calculator {
	display: none;
}
.page-id-7.woocommerce-cart .shipping label {
	text-align: right;
}
.page-id-7.woocommerce-cart .shipping li {
	text-align: right;
}
.page-id-7.woocommerce-cart .order-total td {
	text-align: right;
}
.page-id-7.woocommerce-cart .order-total {
	border-top: 2px solid white !important;
}
.woocommerce-cart .not-active-fullpage > .woocommerce td.actions .coupon .custom-btn-default {
	background-color: black!important;
	color: #fff!important;
	border: 2px solid #fed2c7!important;
	padding: 10px 18px!important;
	cursor: pointer!important;
	font-weight: 600!important;
	text-transform: uppercase!important;
	height: 50px !important;
	display: flex;
	justify-content: center;
	align-items: center;
}
/* modifided on 23th oct 20 by sumaiya mim  */
label[for="shipping_method_0_flat_rate1"] {
	font-size: 0px;
}
.text-capitalize {
	text-transform: capitalize;
}
/* modifided on 23th oct 20 by sumaiya mim */
/* Update by shobnom on 1 dec */
.shop_table .tax-rate td {
	text-align: right;
}
.shop-bag-items-container .yith-wcwl-add-button,
.shop-bag-items-container .yith-wcwl-wishlistaddedbrowse {
		position: relative;
		display: inline-block;
}
.shop-bag-items-container .yith-wcwl-add-button span,
.shop-bag-items-container .yith-wcwl-wishlistaddedbrowse .custom-browse-icon span {
    display: none;
    background: #eee;
    color: black;
    position: absolute;
    padding: 0.1em 0.3em;
    font-size: smaller !important;
    font-weight: 500;
    pointer-events: none;
    white-space: nowrap;
    top: 30px;
}
.shop-bag-items-container .yith-wcwl-add-button:hover span,
.shop-bag-items-container .yith-wcwl-wishlistaddedbrowse:hover .custom-browse-icon > span {
    display: block;
}
.shop-bag-items-container .shop .woocommerce-Price-amount.amount {
	font-weight: 700;
}
.shop-bag-items-container .qib-container {
	width: max-content;
	margin-right: 0;
	border: 1px solid #fed2c7;
}
.shop-bag-items-container .qib-container .qib-button, .shop-bag-items-container .qib-container .quantity .text {
	background-color: transparent !important;
	border: 1px solid transparent;
	border-color: transparent !important;
}
.shop-bag-items-container .variation {
	display: inherit;
	color: black;
	font-weight: 500;
}
.shop-bag-items-container .variation dd {
	margin-left: 5px;
}
.product-name .product_wl_btn {
	padding-top: 15px;
}
.product-name .product_wl_btn img {
	max-width: 80%;
}
.shortDescription {
	color: black;
	font-weight: 500;
	margin-bottom: 10px;
}
/* .shop-bag-items-container .variation dt {
	display: none;
} */
.woocommerce-cart .not-active-fullpage > .woocommerce .shop_table.woocommerce-cart-form__contents {
	margin-top: 5px;
}
.shop_table .product-thumbnail, .shop_table .product-subtotal {
	width: 20%;
}
.shop_table .product-name {
	width: 60%;
}
.product_wl_btn .yith-wcwl-wishlistaddedbrowse a.custom-browse-icon {
	  background-image: url(/mukta/wp-content/uploads/2020/07/shell-icon.png);
    height: 26px;
    width: 26px;
}

/* Coupon visibility fix */
@media (max-width: 991px) {
	.woocommerce-cart .not-active-fullpage > .woocommerce .coupon_wrap td.actions .coupon {
	    display: inline-block;
	    border-bottom: 1px solid #D8D8D8;
	    width: 50%;
	}
	.woocommerce-cart .not-active-fullpage > .woocommerce .coupon_wrap td.actions .coupon label,
	.woocommerce-cart .not-active-fullpage > .woocommerce .coupon_wrap a {
		display: none;
	}
}
@media (min-width: 601px) {
	.shop-bag-items-container .product-name {
		padding: 20px !important;
	}
}
@media (max-width: 600px) {
	.shop_table.woocommerce-cart-form__contents .product-subtotal {
		text-align: inherit;
	}
}
</style>
