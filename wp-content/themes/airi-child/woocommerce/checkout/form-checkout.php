<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$customer_id = get_current_user_id();
global $woocommerce;
do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<div id="checkoutTop" class="row">
    <div class="col-md-8" id="pp">
        <!-- Shopping Bag box and Proceed with Order box -->
        <div class="row easy-fix"  style="padding-left: 15px;padding-right: 15px;">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-md-6 text-center top-white-box"><a href="">Shopping Bag</a></div>
                    <div class="col-md-6 text-center top-pink-box"><a href="">Proceed with Order</a></div>
                </div>
            </div>
        </div>
        <div class="row easy-fix"  style="padding-left: 15px;padding-right: 15px;">
            <div class="col-sm-12">
                <div id="custom-login-content" class="row collapse-row">
                    <div class="col-sm-12 collapse-title <?php if ( !is_user_logged_in() ) {echo 'ab';}?>" <?php if ( is_user_logged_in() ) {echo 'style="display: none;"';}?>><a href="">LOGIN INFORMATION</a></div>
                    <div class="col-sm-12 collapse-container" <?php if ( is_user_logged_in() ) {echo 'style="display: flex;justify-content: space-between; background-color: #fed2c7;color: black;align-items: center; padding-top: 15px; padding-bottom: 15px;"';} else {echo 'style="display: block !important;"';}?>>

                        <?php do_action( 'woocommerce_before_customer_login_form' ); ?>

                        <?php global $current_user; wp_get_current_user(); ?>

                        <?php if ( is_user_logged_in() ) : ?>
                            <?php echo '<div>Hi <strong>' . $current_user->display_name . "</strong>\n"; echo ', you are ordering as <strong>' . $current_user->user_email .'</strong></div>'. "\n";  echo '<div><a href="'.wp_logout_url( get_permalink() ).'" class="custom-btn-default"  style="display: flex;">logout</a></div>'; ?>
                        <?php elseif ( !is_user_logged_in() ) : ?>
                                <form class="custom-login custom-display-flex woocommerce-form woocommerce-form-login login" method="post">

                                <?php do_action( 'woocommerce_login_form_start' ); ?>

                                <div class="custom-flex-col-50">
                                    <div class="text-right shop-small-text">REQUIRED FIELD*</div>
                                    <div class="">
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                                            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="Email*" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                                            <input class="woocommerce-Input woocommerce-Input--text input-text" placeholder="Password*" type="password" name="password" id="password" autocomplete="current-password" />
                                        </p>
                                    </div>
                                    <?php do_action( 'woocommerce_login_form' ); ?>
                                </div>
                                <div class="custom-flex-col-30">
                                    <p class="form-row" style="text-align: center;">
                                        <!-- <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                                            <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span>
                                                <?php
                                                // esc_html_e( 'Remember me', 'woocommerce' );
                                                ?>
                                            </span>
                                        </label> -->
                                        <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                                        <button type="submit" class="custom-btn-default woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'SUBMIT', 'woocommerce' ); ?></button>
                                    </p>
                                    <p class="text-center" style="text-align: center;margin: 0;color: black;font-weight: 600;">Forgotten your password?</p>
                                    <p class="woocommerce-LostPassword lost_password"  style="text-align: center;margin: 0;font-weight: 700;color: black;">
                                        <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'CLICK HERE?', 'woocommerce' ); ?></a>
                                    </p>
                                </div>

                                <?php do_action( 'woocommerce_login_form_end' ); ?>
                            </form>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="row">
    <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data" >
        <div class="col-md-8">
            <div class="row easy-fix"  style="padding-left: 15px;padding-right: 15px;">
                <div class="col-sm-12">
                    <div class="collapse-row row">
                        <div class="col-sm-12 collapse-title display-none-shipping"><a href="">SHIPPING METHOD</a></div>
                        <div class="col-sm-12 collapse-container display-none-shipping">
                            <?php if ( $checkout->get_checkout_fields() ) : ?>
                                <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
                                <div class="col2-set" id="customer_details">
                                    <div class="col-1">
                                        <?php
                                        do_action( 'woocommerce_checkout_billing' );
                                        ?>
                                    </div>
                                    <div class="col-2">
                                        <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                                        <a href="#" class="btn" id="submit-billing-shipping">SUBMIT</a>
                                    </div>

                                </div>
                                <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
                            <?php endif; ?>
                                <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
                        </div>
                        <div id="display-block" class="col-sm-12 collapse-container" style="display: none;background: #fed2c7;border-radius: 16px;padding: 25px 15px;">
                            <div class="row"><div class="col-sm-12"><a href="" class="custom-sub-title">SHIPPING METHOD</a></div></div>
                            <div class="row"><div class="col-sm-12"><a href="" style="color: black;font-size: 1.5rem;font-weight: 700;letter-spacing: 0.01rem;">The order will be deliver to :</a></div></div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div style="text-transform: uppercase;color: black;">Address</div>
                                    <div style="color: black; line-height: 1.6rem;">
                                        <div id="display_shipping_address_1"><?php echo get_user_meta( $customer_id, 'shipping_address_1', true ) ?></div>
                                        <div id="display_shipping_address_2"><?php echo get_user_meta( $customer_id, 'shipping_address_2', true ) ?></div>
                                        <div id="display_shipping_city"><?php echo get_user_meta( $customer_id, 'shipping_city', true ) ?></div>
                                        <div id="display_shipping_country"><?php echo get_user_meta( $customer_id, 'shipping_country', true ) ?></div>
                                        <!-- <div><script> $('#shipping_first_name').text(); $p = $('#shipping_first_name').val(); </script></div> -->
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div style="text-transform: uppercase;color: black;">Contact</div>
                                    <div style="color: black; line-height: 1.6rem;">
                                        <div id="display_billing_phone"><?php echo get_user_meta( $customer_id, 'billing_phone', true ) ?></div>
                                        <div id="display_billing_email"><?php echo get_user_meta( $customer_id, 'billing_email', true ) ?></div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div><a href="" class="custom-btn-default shipping-modify-btn" style="display: flex;justify-content: center;">MODIFY</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="responsive-payment" class="row easy-fix responsive-payment"  style="padding-left: 15px;padding-right: 15px;padding-bottom: 15px;">
                <div class="col-sm-12">
                    <div class="row collapse-row">
                        <div class="col-sm-12 collapse-title"><a href="">PAYMENT METHOD</a></div>
                        <!-- modifided on 23th oct 20 by sumaiya mim  -->
                        <div class="col-sm-12  modified-container">
                            <div id="pay" class="row" >
                                <div id="paymentTitle">
                                </div>
                                <div id="paymentMessage" class="col-sm-12">
                                </div>
                            </div>
                        </div>
                        <!-- modifided on 23th oct 20 by sumaiya mim  -->
                    </div>
                </div>
            </div>
        </div>
        <div id="gg" class="col-md-4 custom-shopping-bag-modify-box">
          <div style="top: 133px;">
            <div id="order_review_heading" class="row">
                <div class="col-sm-7">
                    <div class="custom-sub-title"><?php esc_html_e( 'SHOPPING BAG', 'woocommerce' );?></div>
                    <div class="shop-small-text"><a href="<?php echo wc_get_cart_url() ?>" class="custom-qty-change-in-ajax-cart shop-small-text "><?php echo $woocommerce->cart->cart_contents_count; ?></a></div>
                </div>
                <div class="col-sm-5 text-right">
                    <a href="<?php echo wc_get_cart_url() ?>" class="custom-btn-default">MODIFY</a>
                </div>
            </div>
            <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
            <div id="order_review" class="woocommerce-checkout-review-order">
                <?php do_action( 'woocommerce_checkout_order_review' ); ?>
            </div>
            <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
            </div>
        </div>
    </form>
</div>









<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
<style>
@media (min-width: 992px) {
    #gg > div {
        position: absolute;
        /* top: -158px;  */
    }
    .responsive-payment {
        /* min-height: 650px; */
        height: 100%;
    }
    .woocommerce-NoticeGroup.woocommerce-NoticeGroup-checkout {
    /* display: none; */
    }
}
@media (max-width: 991px) {
    #responsive-payment {
        min-height: unset !important;
    }
}
.display-none-shipping .woocommerce-account-fields {
    display: block;
}
#submit-billing-shipping {
	padding: 5px 0 !important;
	margin: 15px 0 0;
	min-width: 90px !important;
	font-family: "Raleway", sans-serif;
	font-weight: 600;
	font-size: 14px !important;
	text-transform: uppercase;
	background-color: black !important;
}
.row::before:disabled, .row::after {
  content: ' ';
  display: table;
  flex-basis: 0;
  order: 1;
}

.row::after {
  clear: both;
}
    .page-id-8.woocommerce-checkout #section_page_header {
        display: none;
    }
    .shop_table .product-remove .remove::before {
        content: "";
        font-family: 'dl-icon';
        direction: ltr;
        font-size: 16px;
        text-rendering: auto;
    }
		.shop_table .product-remove .remove {
			font-size: 14px;
			color: black;
		}
		.shop_table .product-remove .remove span{
			font-size: 24px;
			vertical-align: bottom;
		}
    .page-id-8.woocommerce-checkout .product-remove {
	    width: 110px;
    }
    .woocommerce-billing-fields {
        margin-top: 20px;
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
    .woocommerce #order_review_heading, .woocommerce #order_review {
        width: 100%;
    }
    .collapse-container {
        display: none;
        border-left: 2px solid #fed2c7;
        border-right: 2px solid #fed2c7;
        border-bottom: 2px solid #fed2c7;
    }
    .collapse-row {
        margin-top: 20px;
    }
    .collapse-title {
        font-size: 1.8rem;
        color: black;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1rem;
        padding: 15px;
        border: 2px solid #fed2c7;
    }
/* shipping information */
.page-id-8.woocommerce-checkout .woocommerce #customer_details {
    width: 70%;
}
.page-id-8.woocommerce-checkout .form-row.form-row-first, .form-row.form-row-last {
    width: 100%;
}
.page-id-8.woocommerce-checkout .woocommerce-shipping-fields__field-wrapper::before , .page-id-8.woocommerce-checkout .woocommerce-billing-fields::before {
    content: "REQUIRED FIELD *";
    font-size: 1.1rem;
    color: black;
}
.page-id-8.woocommerce-checkout .input-text , .state_select , #billing_title, #shipping_title {
    color: black;
    border: 2px solid #fed2c7;
    font-size: 1.5rem;
    font-weight: 600;
    text-transform: capitalize;
    letter-spacing: 0.1rem;
    width: 100%;
}
/* .easy-fix {
    margin-left: 0;
    margin-right: 0;
} */
.COD , .PWS {
    border: 0px;
}
/* subtotal */
.page-id-8.woocommerce-checkout .woocommerce #order_review ,.page-id-8.woocommerce-checkout .woocommerce #order_review_heading{
    padding-left: 0px;
    padding-right: 0px;
    border: 0px;
    position: relative;
    align-items: center;
    padding-top: 0px;
}
.page-id-8.woocommerce-checkout .woocommerce #order_review_heading {
    display: flex;
    border-left: 2px solid #fed2c7;
    border-right: 2px solid #fed2c7;
    border-top: 2px solid #fed2c7;
    padding-top: 20px;
}
.custom-shopping-bag-modify-box tbody {
    display: block;
    padding-right: 20px;
    padding-left: 20px;
    width: 100%;
    border: 2px solid #fed2c7;
    border-top: none;
		padding-bottom: 20px;
}
.custom-btn-default {
    background-color: black;
    color: #fff;
    border: 2px solid #fed2c7;
    padding: 15px 18px;
    cursor: pointer;
    font-weight: 600;
    text-transform: uppercase;
}
.page-id-8.woocommerce-checkout .woocommerce-checkout-review-order-table .d-none , .page-id-8.woocommerce-checkout label[for=shipping_email], .page-id-8.woocommerce-checkout label[for=shipping_phone], .page-id-8.woocommerce-checkout label[for=billing_email], .page-id-8.woocommerce-checkout label[for=billing_phone] , .page-id-8.woocommerce-checkout label[for=billing_country], .page-id-8.woocommerce-checkout label[for=shipping_country]{
    display: none;
}
.page-id-8.woocommerce-checkout .product-name , .custom-shopping-bag-modify-box tr {
    display: block;
    padding-left: 0;
    padding-right: 0;
}
.bg-pink  {
    display: block;
		background-color: #fed2c7 !important;
		color: black;
    padding: 20px !important;
    margin-top: 30px;
}
.bg-pink > .cart-subtotal , .bg-pink > .woocommerce-shipping-totals , .bg-pink > .order-total {
    display: flex;
    justify-content: space-between;
}
.bg-pink th,.bg-pink td {
    border: none;
}
.page-id-8.woocommerce-checkout .product-total {
    text-align: left;
}
.custom-product-title, .custom-product-short-description {
    font-weight: 600;
}
/* login */
.collapse-container .custom-login label {
    display: none;
}
/*payment button */
.page-id-8.woocommerce-checkout .woocommerce-checkout-payment {

    /* display: none; */
}
.page-id-8 #custom-login-content .woocommerce-notices-wrapper {
    display: none;
}
#place_order {
    border-top-left-radius: 2rem;
    border-bottom-right-radius: 2rem;
    letter-spacing: 0.1rem;
    max-width: 70%;
    margin: 0 auto !important;
    padding-top: 1.5rem !important;
    padding-bottom: 1.5rem !important;
    padding-left: 1.5rem !important;
    padding-right: 1.5rem !important;
    font-weight: 600 !important;
    border: 4px solid #fed2c7 !important;
    /* text-transform: uppercase; */
}
.page-id-8 .woocommerce-form-coupon-toggle {
    display: none;
}
#billing_first_name_field.woocommerce-invalid-required-field > label.screen-reader-text > span.error {
    color: #e2401c;
    display: block !important;
    font-weight: bold;
 }
/* Css for ssl commerze added by sumaiya on 23th october 20 */
#order_review .wc_payment_methods.payment_methods.methods , .payment_box.payment_method_cod , #pay ul.wc_payment_methods.payment_methods.methods > li > div ,#pay ul.wc_payment_methods.payment_methods.methods > li > input, label[for="payment_method_sslcommerz"] > img{
    display: none;
}
#pay ul.wc_payment_methods.payment_methods.methods, #pay ul.wc_payment_methods.payment_methods.methods > li {
    margin-bottom: 0px;
}
#paymentTitle label {
    display: block;
    cursor: pointer;
}
.modified-container {
    border-left: 0;
    border-right: 0;
    border-bottom: 2px solid #fed2c7;
}
#paymentTitle {
    border-left: 2px solid #fed2c7;
    border-right: 2px solid #fed2c7;
}
#paymentMessage {
    border-left: 2px solid #fed2c7;
    border-right: 2px solid #fed2c7;
    border-top: 2px solid #fed2c7;
    margin-top: 15px;
    display: none;
    color: black;
}
#paymentTitle ul > li > div.payment_box.payment_method_cod {
    display: block;
    font-size: 0px;
    padding: 0px;
}
#paymentTitle ul > li > div.payment_box.payment_method_cod > p {
    line-height: 0;
}
.wc_payment_methods .payment_box {
		margin-top: 10px;
		padding-bottom: 0;
}
.top-pink-box.PWS label {
    color: white;
}
.top-white-box.COD label {
    color: #fed2c7;
}
.font-semibold {
    font-weight: 600;
}
/* Css for ssl commerze added by sumaiya on 23th october 20 */
/* Update by shobnom on nov 2 */
.woocommerce-checkout .address-field.update_totals_on_change {
    border: 2px solid #FED2C5 !important;
    padding: 0px 15px;
    height: 50px !important;
    color: #4D4D4D;
    font-size: 16px;
    text-align: left;
    display: flex;
    align-items: center;
    background-color: rgba(239, 239, 239, 0.3);
}
/* Update by Shobnom on Dec 1 */
.shop_table .tax-rate th, .shop_table .tax-rate .woocommerce-Price-amount.amount {
	font-size: 1.3rem;
	font-weight: 600 !important;
	text-transform: uppercase;
	letter-spacing: 0.02rem;
	color: black;
}
.shop_table .tax-rate {
	display: flex;
	justify-content: space-between;
}
.custom-shopping-bag-modify-box .yith-wcwl-add-button,
.custom-shopping-bag-modify-box .yith-wcwl-wishlistaddedbrowse {
		position: relative;
		display: inline-block;
}
.custom-shopping-bag-modify-box .yith-wcwl-add-button span,
.custom-shopping-bag-modify-box .yith-wcwl-wishlistaddedbrowse .custom-browse-icon span {
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
.custom-shopping-bag-modify-box .yith-wcwl-add-button:hover span,
.custom-shopping-bag-modify-box .yith-wcwl-wishlistaddedbrowse:hover .custom-browse-icon > span {
    display: block;
}
.woocommerce-terms-and-conditions-link {
		color: #000!important;
		font-style: italic;
		text-transform: uppercase;
}
.woocommerce-terms-and-conditions-link:hover {
		color: #fed2c7 !important;
}
@media (max-width: 600px) {
	.woocommerce #customer_details {
	    width: auto !important;
	}
	.woocommerce #order_review_heading {
	    padding: 15px;
	    margin-bottom: 0px;
	}
}
</style>
<script>
$( document ).ready(function() {
    // accordion slide toggol
   $('.collapse-title').click(function() {
        $(this).next('.collapse-container').slideToggle();
        return false;
   });
    // accordion slide toggle end
    //checkout page height calculation
   $minheight = $("#order_review").height();
   $('#responsive-payment').css('min-height',$minheight);
   // checkout page height calculation
    // submit and modify button action
   $("a#submit-billing-shipping").click(function(event){
    $("#display-block").css("display","block");
    $(".display-none-shipping").css("display","none");
        event.preventDefault();
    });

    $("a.shipping-modify-btn").click(function(event){
    $(".display-none-shipping").css("display","block");
    $("#display-block").css("display","none");
        event.preventDefault();
    });
    // submit and modify button action
    $( "#ship-to-different-address-checkbox" ).prop( "checked", false );
    // for displaying the error message part on the top of the checkout page and binding
    $('form.checkout.woocommerce-checkout').bind('DOMSubtreeModified DOMAttrModified',function () {
    if ($('ul.woocommerce-error').length) {
        $('ul.woocommerce-error').insertBefore('#checkoutTop');//where you want to place
    }
  });
    // for displaying the error message part on the top of the checkout page and binding
// On change after Submitting Billing and shipping address
$('#shipping_address_1').on('input', function() {
  text_shipping_address_1 = $('#shipping_address_1').val();
  $('#display_shipping_address_1').html(text_shipping_address_1);
});
$('#shipping_address_2').on('input', function() {
  text_shipping_address_2 = $('#shipping_address_2').val();
  $('#display_shipping_address_2').html(text_shipping_address_2);
});
$('#shipping_city').on('input', function() {
  text_shipping_city = $('#shipping_city').val();
  $('#display_shipping_city').html(text_shipping_city );
});
$('#shipping_country').on('input', function() {
  text_shipping_country = $('#shipping_country').val();
  $('#display_shipping_country').html(text_shipping_country);
});
$('#billing_phone').on('input', function() {
  text_billing_phone = $('#billing_phone').val();
  $('#display_billing_phone').html(text_billing_phone);
});
$('#billing_email').on('input', function() {
  text_billing_email = $('#billing_email').val();
  $('#display_billing_email').html(text_billing_email);
});
// On change after Submitting Billing and shipping address
// SSL commerce payment button replacement (modifided on 23th oct 20 by sumaiya mim)
$(window).load(function() {
    $('label[for="payment_method_sslcommerz"]').html('PAY WITH SSLCOMMERZ');
    $( "#pay ul.wc_payment_methods.payment_methods.methods > li > div").css('display','none');
    $( "ul.wc_payment_methods.payment_methods.methods" ).addClass('row');
    $( "ul.wc_payment_methods.payment_methods.methods > li" ).addClass('col-sm-6 text-center');
    $( "#paymentTitle" ).append( $( "ul.wc_payment_methods.payment_methods.methods" ) );
    $("#paymentTitle li.payment_method_cod").addClass('top-pink-box PWS');
    $("#paymentTitle li.payment_method_sslcommerz").addClass('top-white-box COD');
    $("#paymentTitle li > div.payment_method_cod").css('display','none');
    $( "ul.wc_payment_methods.payment_methods.methods > li > input" ).change(function(){
        $( "ul.wc_payment_methods.payment_methods.methods > li" ).removeClass('top-pink-box PWS top-white-box COD');
        if(this.checked) {
            $( "#paymentMessage" ).append( $( "#pay ul.wc_payment_methods.payment_methods.methods > li > div" ) );
           // $(this).parent().removeClass('top-pink-box PWS');
            $(this).parent().addClass('top-pink-box PWS');
            $(this).parent().siblings().addClass('top-white-box COD');
            $("#paymentMessage").css('display','block');
            $("#paymentTitle").css('border-bottom','2px solid #fed2c7');
        }
        else {
            $(this).parent().removeClass('top-pink-box PWS');
            $(this).parent().siblings().removeClass('top-white-box COD');
        }
    });
    $( "ul.wc_payment_methods.payment_methods.methods > li > .payment_box.payment_method_sslcommerz" ).html ('<img class="img-fluid" src="/mukta/wp-content/uploads/2020/11/SSLCommerz-Pay-With-logo-All-Size.png" />');
});
// SSL commerce payment button replacement end (modifided on 23th oct 20 by sumaiya mim)
// height calculation with login and with out login
if($("#custom-login-content .collapse-container").css("display") == "block") {
    $('#gg > div').css('top','-350px');
}
else if($("#custom-login-content .collapse-container").css("display") == "none") {
    $('#gg > div').css('top','-133px');
    alert("hjadh");
}
else {
    $('#gg > div').css('top','-158px');
 }
});
// height calculation with login and with out login
</script>
