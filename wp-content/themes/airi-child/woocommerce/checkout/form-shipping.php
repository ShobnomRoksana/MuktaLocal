<style>
.shipping_option {
	font-weight: 500;
  color: black;
}
.round_different, .round_same {
	display: inline-flex !important;
	justify-content: flex-end;
	align-items: center;
  position: relative;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
/* Hide the browser's default checkbox */
.round_different input, .round_same input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
	position: relative;
	height: 20px;
	width: 20px;
	margin-right: 5px;
	background-color: #eee;
	border-radius: 15px;
}


/* On mouse-over, add a grey background color */
.round_different:hover input ~ .checkmark, .round_same:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.round_different input:checked ~ .checkmark, .round_same input:checked ~ .checkmark {
  background-color: #000000;
}

/* Show the checkmark when checked */
.round_different input:checked ~ .checkmark:after, .round_same input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.round_different .checkmark:after, .round_same .checkmark:after {
	color: white;
	content: "x";
	position: absolute;
	display: none;
	top: 0px;
	left: 0.5px;
	text-align: center;
	height: 100%;
	width: 100%;
	font-size: 23px;
	line-height: 16px;
	font-weight: 600;
}
</style>

<?php
/**
 * Checkout shipping information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="woocommerce-shipping-fields">
	<?php if ( true === WC()->cart->needs_shipping_address() ) : ?>

		<h3 id="ship-to-different-address">
			<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox round_different">
				<input id="ship-to-different-address-checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox shipping-checkbox" <?php checked( apply_filters( 'woocommerce_ship_to_different_address_checked', 'shipping' === get_option( 'woocommerce_ship_to_destination' ) ? 1 : 0 ), 1 ); ?> type="checkbox" name="ship_to_different_address" value="1" />
				<span class="checkmark"></span><span class="shipping_option"><?php esc_html_e( 'Ship to a different address?', 'woocommerce' ); ?></span>
			</label>
		</h3>
		<h3 id="ship-to-different-address">
			<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox round_same">
				<input id="duplicate-billing-address" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox shipping-checkbox" type="checkbox" name="duplicate-billing-address" value="1" />
				<span class="checkmark"></span><span class="shipping_option"><?php esc_html_e( 'Shipping address same as billing address', 'woocommerce' ); ?></span>
			</label>
		</h3>
		<div class="shipping_address">

			<?php do_action( 'woocommerce_before_checkout_shipping_form', $checkout ); ?>

			<div class="woocommerce-shipping-fields__field-wrapper">
				<?php
				$fields = $checkout->get_checkout_fields( 'shipping' );

				foreach ( $fields as $key => $field ) {
					woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
				}
				?>
			</div>

			<?php do_action( 'woocommerce_after_checkout_shipping_form', $checkout ); ?>

		</div>

	<?php endif; ?>
</div>
<div class="woocommerce-additional-fields">
	<?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>

	<?php if ( apply_filters( 'woocommerce_enable_order_notes_field', 'yes' === get_option( 'woocommerce_enable_order_comments', 'yes' ) ) ) : ?>

		<?php if ( ! WC()->cart->needs_shipping() || wc_ship_to_billing_address_only() ) : ?>

			<h3><?php esc_html_e( 'Additional information', 'woocommerce' ); ?></h3>

		<?php endif; ?>

		<div class="woocommerce-additional-fields__field-wrapper">
			<?php foreach ( $checkout->get_checkout_fields( 'order' ) as $key => $field ) : ?>
				<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
			<?php endforeach; ?>
		</div>

	<?php endif; ?>

	<?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>
</div>
<script>
$(document).ready(function(){
    $('.shipping-checkbox').click(function() {
        $('.shipping-checkbox').not(this).prop('checked', false);
    });
});
</script>
