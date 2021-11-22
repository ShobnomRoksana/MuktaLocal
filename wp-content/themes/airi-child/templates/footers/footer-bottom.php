<div class="searchform-fly-overlay la-ajax-searchform">
    <a href="javascript:;" class="btn-close-search"><i class="dl-icon-close"></i></a>
    <div class="searchform-fly">
        <p><?php echo esc_html_x('Start typing and press Enter to search', 'front-view', 'airi')?></p>
        <?php
        if(function_exists('get_product_search_form')){
            get_product_search_form();
        }
        else{
            get_search_form();
        }
        ?>
        <div class="search-results">
            <div class="loading"><div class="la-loader spinner3"><div class="dot1"></div><div class="dot2"></div><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>
            <div class="results-container"></div>
            <div class="view-more-results text-center">
                <a href="#" class="button search-results-button"><?php echo esc_html_x('View more', 'front-end', 'airi') ?></a>
            </div>
        </div>
    </div>
</div>
<!-- .search-form -->

<div class="cart-flyout">
    <div class="cart-flyout--inner">

        <div class="cart-flyout__content" style="padding-top: 0px;">
            <div class="cart-flyout__heading row"><div style="font-family: 'Raleway', sans-serif;font-weight: 600;font-size: 25px;text-align: center;text-transform: uppercase;letter-spacing: 1.2px;padding-top: 20px;padding-bottom: 10px;border-bottom: 3px solid #f0f0f0;"><?php echo esc_html_x('Shopping Bag', 'front-view', 'airi') ?></div><div><a href="javascript:;" class="btn-close-cart"><i class="dl-icon-close"></i></a></div></div>
            <div class="cart-flyout__loading"><div class="la-loader spinner3"><div class="dot1"></div><div class="dot2"></div><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>
            <div class="widget_shopping_cart_content"><?php
                if(function_exists('woocommerce_mini_cart')){
                    woocommerce_mini_cart();
                }
            ?></div>
            <?php
            $aside_cart_widget = apply_filters('airi/filter/aside_cart_widget', 'aside-cart-widget');
            if(is_active_sidebar($aside_cart_widget)){
                echo '<div class="aside_cart_widget">';
                dynamic_sidebar($aside_cart_widget);
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>
<div class="la-overlay-global"></div>

<?php
$show_popup = Airi()->settings()->get('enable_newsletter_popup');
$only_home_page = Airi()->settings()->get('only_show_newsletter_popup_on_home_page');
$delay = Airi()->settings()->get('newsletter_popup_delay', 2000);
$popup_content = Airi()->settings()->get('newsletter_popup_content');
$show_checkbox = Airi()->settings()->get('show_checkbox_hide_newsletter_popup', false);
$back_display_time = Airi()->settings()->get('newsletter_popup_show_again', '1');
if($show_popup){
    if($only_home_page && !is_front_page()){
        $show_popup = false;
    }
}
if($show_popup && !empty($popup_content)):
    ?>
    <div data-la_component="NewsletterPopup" class="js-el la-newsletter-popup" data-waitfortrigger="0" data-back-time="<?php echo esc_attr( floatval($back_display_time) ); ?>" data-show-mobile="<?php echo Airi()->settings()->get('disable_popup_on_mobile') ? 1 : 0 ?>" id="la_newsletter_popup" data-delay="<?php echo esc_attr( absint($delay) ); ?>">
        <a href="#" class="btn-close-newsletter-popup"><i class="dl-icon-close"></i></a>
        <div class="newsletter-popup-content"><?php echo Airi_Helper::remove_js_autop($popup_content); ?></div>
        <?php if($show_checkbox): ?>
            <label class="lbl-dont-show-popup"><input type="checkbox" class="cbo-dont-show-popup" id="dont_show_popup"/><?php echo esc_html(Airi()->settings()->get('popup_dont_show_text')) ?></label>
        <?php endif;?>
    </div>
<?php endif; ?>
<!-- code cleaned on 23th oct 20 by sumaiya mim  -->
<script type="text/javascript">
var $j = jQuery;
$j(document).ready(function(){
    /**
    * Update 06 Start
    * 1) added postcode
    * 2) added thana
    * 3) modified some other fields
    * Added by Tanzim
    * Date 27-Oct-2020
    */
    //set initial state of checkbox to unchecked
    $j('#duplicate-billing-address').removeAttr('checked');
    $j( "#duplicate-billing-address" ).change(function() {
        if($j(this).is(":checked")) {
            //if checked then copy all values
            $j("select#shipping_title").val($j("select#billing_title").children("option:selected").val());
            $j("#shipping_first_name").val($j('#billing_first_name').val());
            $j("#shipping_last_name").val($j('#billing_last_name').val());
            $j("#shipping_company").val($j('#billing_company').val());
            $j("#shipping_address_1").val($j('#billing_address_1').val());
            $j("#shipping_address_2").val($j('#billing_address_2').val());
            $j("#shipping_city").val($j('#billing_city').val());
            $j("#shipping_postcode").val($j('#billing_postcode').val());
            $j("#shipping_state").val($j('#billing_state').val());
            $j("#shipping_country").val($j('#billing_country').val());
            $j("#shipping_phone").val($j("#billing_phone").val());
            $j("#shipping_email").val($j("#billing_email").val());
            $j("#shipping_recipient_thana").val($j('#billing_recipient_thana').val());
        } else {
            //Clear values when unchecked
            $j("select#shipping_title").attr("data-placeholder", "Ms");
            $j("select#shipping_title").children("option:selected").val("Ms");
            $j("#shipping_first_name").val('');
            $j("#shipping_last_name").val('');
            $j("#shipping_company").val('');
            $j("#shipping_address_1").val('');
            $j("#shipping_address_2").val('');
            $j("#shipping_city").val('');
            $j("#shipping_postcode").val('');
            $j("#shipping_state").val('');
            $j("#shipping_country").val($j('#billing_country').val());
            $j("#shipping_phone").val('');
            $j("#shipping_email").val('');
            $j("#shipping_recipient_thana").val('');
        }
    });
    $j('#ship-to-different-address-checkbox').removeAttr('checked');
    $j("#ship-to-different-address-checkbox").change(function() {
        if($j(this).is(":checked")) {
            //if checked then copy all values
            $j("select#shipping_title").attr("data-placeholder", "Ms");
            $j("select#shipping_title").children("option:selected").val("Ms");
            $j("#shipping_first_name").val('');
            $j("#shipping_last_name").val('');
            $j("#shipping_company").val('');
            $j("#shipping_address_1").val('');
            $j("#shipping_address_2").val('');
            $j("#shipping_city").val('');
            $j("#shipping_postcode").val('');
            $j("#shipping_state").val('');
            $j("#shipping_country").val($j('#billing_country').val());
            $j("#shipping_phone").val('');
            $j("#shipping_email").val('');
            $j("#shipping_recipient_thana").val('');
        }
    });
    /**
    * Update 06 End
    * 1) added postcode
    * 2) added thana
    * 3) modified some other fields
    * Added by Tanzim
    * Date 27-Oct-2020
    */
});

</script>
<!-- Newly added code -->
<script type="text/javascript">
    function updateQty(key, qty) {
        url = '/mukta/updatecart/';
        data = "cart_item_key=" + key + "&cart_item_qty=" + qty;

        jQuery.post(url, data).done(function (data) {
            //function updateCartFragment
            updateCartFragment();
        });
    }
    function supports_html5_storage() {
        try {
            return 'localStorage' in window && window['localStorage'] !== null;
        } catch (e) {
            return false;
        }
    }
    function updateCartFragment() {
        //$('#mini-loader').html('loading...');
        $fragment_refresh = {
            url: woocommerce_params.ajax_url,
            type: 'POST',
            data: {action: 'woocommerce_get_refreshed_fragments'},
            success: function (data) {
                if (data && data.fragments) {
                    jQuery.each(data.fragments, function (key, value) {
                        jQuery(key).replaceWith(value);
                    });

                    if (supports_html5_storage) {
                        sessionStorage.setItem("wc_fragments", JSON.stringify(
                            data.fragments));
                        sessionStorage.setItem("wc_cart_hash", data.cart_hash);
                    }
                    jQuery('body').trigger('wc_fragments_refreshed');
                }
            }
        };

        //Always perform fragment refresh
        jQuery.ajax($fragment_refresh);
    }
</script>
<!-- Newly added code end -->
