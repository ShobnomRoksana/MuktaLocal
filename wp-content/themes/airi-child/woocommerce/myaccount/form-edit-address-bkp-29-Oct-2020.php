<?php
// get the user meta
$userMeta = get_user_meta(get_current_user_id());

// get the form fields
$countries = new WC_Countries();
$billing_fields = $countries->get_address_fields( '', 'billing_' );
$shipping_fields = $countries->get_address_fields( '', 'shipping_' );
?>

<div class="row edit_address_wrap">
	<div class="col-md-6 shipping_col">
		<!-- shipping form -->
		<?php
		$load_address = 'shipping';
		$page_title   = __( 'Shipping Address', 'woocommerce' );
		?>
		<form action="/mukta_v1/my-account/edit-address/shipping/" class="edit-account shipping_form" method="post">
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
		<form action="/mukta_v1/my-account/edit-address/billing/" class="edit-account billing_form" method="post">
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
