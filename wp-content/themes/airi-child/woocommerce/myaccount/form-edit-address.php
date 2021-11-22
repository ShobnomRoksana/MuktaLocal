<!-- Update by Shobnom on 1/11 start -->
<style>
.profile_address_title_wrap p {
	margin-bottom: 0;
	line-height: 1.2;
	font-weight: 500;
}
.profile_address_title_wrap {
	padding-bottom: 25px;
}
.shipping_form, .billing_form {
	border: 2px solid #fed2c7;
	padding: 0 15px 25px;
}
.shipping_form h4, .billing_form h4 {
	text-align: left;
	border-bottom: 2px solid #fed2c7;
	padding: 15px 15px;
	margin: 0 -15px 15px;
	font-family: 'Raleway', sans-serif;
	font-weight: 700;
	text-transform: uppercase;
	color: black;
	letter-spacing: 1px;
}
.req_field_text {
	margin: 0;
	color: black;
	font-family: "Raleway", sans-serif;
	font-weight: 600;
	text-transform: uppercase;
	font-size: 12px;
}
.req_field_text span {
	font-size: 25px;
	line-height: 0;
	vertical-align: -webkit-baseline-middle;
	vertical-align: -moz-middle-with-baseline;
}
.shipping_form .select, .billing_form .select, .state_select {
	background-image: none;
	cursor: pointer;
}
.shipping_form .shipping_select .woocommerce-input-wrapper,
.billing_form .billing_select .woocommerce-input-wrapper,
.shipping_form #shipping_state_field, .billing_form #billing_state_field {
	position: relative;
}
.select2-selection {
	border-width: 2px !important;
	border-color: #fed2c7 !important;
	padding: 0px 15px;
	height: 40px !important;
	color: #4D4D4D;
	font-family: "Raleway", sans-serif;
	font-weight: 600;
	font-size: 16px;
}
.select2-selection__rendered {
	margin: 0 !important;
	padding: 4px 0 !important;
}
.select2-selection__placeholder {
	 color: #524d4d !important;
}
.shipping_form .shipping_select .woocommerce-input-wrapper::after,
.billing_form .billing_select .woocommerce-input-wrapper::after,
.shipping_form #shipping_state_field .woocommerce-input-wrapper::after,
.billing_form #billing_state_field .woocommerce-input-wrapper::after {
	content: "\f078";
	font-family: FontAwesome;
	position: absolute;
	color: #fff;
	right: 10px;
	bottom: 0;
	background: #000000;
	text-align: center;
	width: 18px;
	height: 18px;
	line-height: 18px;
	pointer-events: none;
	box-sizing: border-box;
	border-radius: 50%;
	-webkit-text-stroke: 1px black;
}
.shipping_form #shipping_state_field .woocommerce-input-wrapper::after,
.billing_form #billing_state_field .woocommerce-input-wrapper::after {
	top: 50%;
	transform: translateY(-50%);
}
.woocommerce-edit-address .in_edit_address {
	display: block;
}
.in_edit_address, .select2 .select2-selection__arrow {
	display: none;
}
.back_to_button-wrap{
	display: flex;
	width: auto;
	margin: 15px;
	align-items: center;
}
.back_to_button-wrap p {
	margin: 0 15px 0 0;
	font-weight: 600;
	color: black;
}
.back_to_button-wrap a {
	width: 200px;
}
.edit_address_wrap .address-field.update_totals_on_change {
	border: 2px solid #FED2C5 !important;
	padding: 0px 15px;
	height: 40px !important;
	color: #4D4D4D;
	font-size: 16px;
	text-align: left;
	display: flex;
	align-items: center;
	background-color: rgba(239, 239, 239, 0.3);
}
@media (min-width: 992px) {
	.shipping_col {
		padding-right: 10px;
	}
	.billing_col {
		padding-left: 10px;
	}
}

</style>
<!-- Update by Shobnom on 1/11 end -->

<?php
// get the user meta
$userMeta = get_user_meta(get_current_user_id());

// get the form fields
$countries = new WC_Countries();
$billing_fields = $countries->get_address_fields( '', 'billing_' );
$shipping_fields = $countries->get_address_fields( '', 'shipping_' );
?>

<div class="row edit_address_wrap">
	<div class="in_edit_address">
		<div class='text-center back_to_button-wrap sign_in_button-wrap'>
			<p>Back to Profile ></p>
			<a href='/my-account/' class='curved-top'>My Account</a>
		</div>
	</div>
	<div class="col-md-6 shipping_col">
		<!-- shipping form -->
		<?php
		$load_address = 'shipping';
		$page_title   = __( 'Shipping Address', 'woocommerce' );
		?>
		<form action="/my-account/edit-address/shipping/" class="edit-account shipping_form" method="post">
		    <h4><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title ); ?></h4>
				<p class="req_field_text text-left"><span>*</span> Required Field</p>
		    <?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>

		    <?php foreach ( $shipping_fields as $key => $field ) : ?>

		        <?php woocommerce_form_field( $key, $field, $userMeta[$key][0] ); ?>

		    <?php endforeach; ?>

		    <?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>

		    <p class="text-right">
		        <input type="submit" class="button save_btn" name="save_address" value="<?php esc_attr_e( 'Save', 'woocommerce' ); ?>" />
		        <?php wp_nonce_field( 'woocommerce-edit_address' ); ?>
		        <input type="hidden" name="action" value="edit_address" />
		    </p>

		</form>
	</div>
	<div class="col-md-6 billing_col">
		<!-- billing form -->
		<?php
		$load_address = 'billing';
		$page_title   = __( 'Billing Address', 'woocommerce' );
		?>
		<form action="/my-account/edit-address/billing/" class="edit-account billing_form" method="post">
		    <h4><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title ); ?></h4>
				<p class="req_field_text text-left"><span>*</span> Required Field</p>
		    <?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>

		    <?php foreach ( $billing_fields as $key => $field ) : ?>

		        <?php woocommerce_form_field( $key, $field, $userMeta[$key][0] ); ?>

		    <?php endforeach; ?>

		    <?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>

		    <p class="text-right">
		        <input type="submit" class="button save_btn" name="save_address" value="<?php esc_attr_e( 'Save', 'woocommerce' ); ?>" />
		        <?php wp_nonce_field( 'woocommerce-edit_address' ); ?>
		        <input type="hidden" name="action" value="edit_address" />
		    </p>
		</form>
	</div>
</div>
