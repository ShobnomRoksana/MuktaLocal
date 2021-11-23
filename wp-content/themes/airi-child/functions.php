<?php

/**
 * Child Theme Function
 *
 */

add_action('after_setup_theme', 'airi_child_theme_setup');
if (!function_exists('airi_child_theme_setup')) {
    function airi_child_theme_setup()
    {
        load_child_theme_textdomain('airi-child', get_stylesheet_directory() . '/languages');
    }
}

function add_theme_scripts() {
    wp_enqueue_style( 'bootstrap-4', get_stylesheet_directory_uri() . '/css/lightgallery.css' );
    wp_enqueue_style('airi-child-style', get_stylesheet_directory_uri() . '/style.css', array('airi-theme'), wp_get_theme()->get('Version'));
    wp_enqueue_script('script', get_stylesheet_directory_uri() . '/js/lightgallery-all.min.js', array('jquery'), null, true);
    wp_enqueue_script( 'custom-script', get_stylesheet_directory_uri() . '/js/customzoom.js', array ( 'jquery' ), null, true );
}
add_action('wp_enqueue_scripts', 'add_theme_scripts');

// On single product pages
add_action('init', 'remove_theme_upsells_related_products');

function remove_theme_upsells_related_products()
{
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
}

// Update by Shobnom on 6/11 start
// New Tab contents
function woocommerce_upsell_display($limit = 5, $columns = 5, $orderby = 'rand', $order = 'desc') {
    global $product;

    if (!$product) {
        return "<p>No Product Available</p>";
    }

    // Get visible upsells then sort them at random, then limit result set.
    $upsells = wc_products_array_orderby(array_filter(array_map('wc_get_product', $product->get_upsell_ids()), 'wc_products_array_filter_visible'), $orderby, $order);
    // $upsells = $limit > 0 ? array_slice($upsells, 0, $limit) : $upsells;

    if ($upsells) : ?>
        <div class="up-sells upsells_products">
            <?php foreach ($upsells as $upsell) : ?>

                <?php
                $post_object = get_post($upsell->get_id());
                setup_postdata($GLOBALS['post'] = &$post_object);
                global $product;
                $attachment_ids = $product->get_gallery_image_ids();
                $image_link = wp_get_attachment_url($attachment_ids[0]);

                echo '<div class="grid-item product_item">
            <div class="product_item--inner">
              <div class="product_item--thumbnail recently_viewed_hover">
                <div class="product_item--thumbnail-holder">
                  <a href="' . get_permalink() . '">
                    <div class="recently_viewed_img" style="background-image: url(' . get_the_post_thumbnail_url() . ');"></div>
                    <div class="wp_alt_image" style="background-image: url(' . $image_link . ');"></div>
                  </a>
                </div>

                <div class="product_item--info text-center recently_viewed_on_hover">
                  <div class="product_item--info-inner">
                    <h3 class="product_item--title">
                      <a href="' . get_permalink() . '">
                        ' . get_the_title() . '
                      </a>
                    </h3>
                    <div class="custom-product-short-description">
                      <p>
                        ' . get_the_excerpt() . '
                      </p>
                    </div>
                    <span class="price">
                      <span class="woocommerce-Price-amount amount">
                        <span class="woocommerce-Price-currencySymbol">
                        ' . $product->get_price_html() . '
                        </span>
                      </span>
                    </span>
                    <div class="product_wl_qv_btn">
                      <a class="quick_view" href="' . get_permalink() . '">
                        <img src="/mukta/wp-content/uploads/2020/10/eye-icon.png"/>
                      </a>
                      ' . do_shortcode('[yith_wcwl_add_to_wishlist]') . '
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>';
                ?>

            <?php endforeach; ?>
        </div>

    <?php else :
        echo "<p>No Matching Product Available</p>";
    ?>
    <?php
    endif;

    wp_reset_postdata();
}

function woocommerce_cross_sell_display($limit = 5, $columns = 5, $orderby = 'rand', $order = 'desc') {
    global $product;

    if (!$product) {
        return;
    }

    // Get visible upsells then sort them at random, then limit result set.
    $cross_sells = wc_products_array_orderby(array_filter(array_map('wc_get_product', $product->get_cross_sells()), 'wc_products_array_filter_visible'), $orderby, $order);
    // $cross_sells = $limit > 0 ? array_slice($cross_sells, 0, $limit) : $cross_sells;

    if ($cross_sells) : ?>
        <div class="cross-sells cross-sells-products">
            <?php foreach ($cross_sells as $cross_sell) : ?>
                <?php
                $post_object = get_post($cross_sell->get_id());
                setup_postdata($GLOBALS['post'] = &$post_object);
                global $product;
                $attachment_ids = $product->get_gallery_image_ids();
                $image_link = wp_get_attachment_url($attachment_ids[0]);

                echo '<div class="grid-item product_item">
              <div class="product_item--inner">
                <div class="product_item--thumbnail recently_viewed_hover">
                  <div class="product_item--thumbnail-holder">
                    <a href="' . get_permalink() . '">
                      <div class="recently_viewed_img" style="background-image: url(' . get_the_post_thumbnail_url() . ');"></div>
                      <div class="wp_alt_image" style="background-image: url(' . $image_link . ');"></div>
                    </a>
                  </div>

                  <div class="product_item--info text-center recently_viewed_on_hover">
                    <div class="product_item--info-inner">
                      <h3 class="product_item--title">
                        <a href="' . get_permalink() . '">
                          ' . get_the_title() . '
                        </a>
                      </h3>
                      <div class="custom-product-short-description">
                        <p>
                          ' . get_the_excerpt() . '
                        </p>
                      </div>
                      <span class="price">
                        <span class="woocommerce-Price-amount amount">
                          <span class="woocommerce-Price-currencySymbol">
                          ' . $product->get_price_html() . '
                          </span>
                        </span>
                      </span>
                      <div class="product_wl_qv_btn">
                        <a class="quick_view" href="' . get_permalink() . '">
                          <img src="/mukta/wp-content/uploads/2020/10/eye-icon.png"/>
                        </a>
                        ' . do_shortcode('[yith_wcwl_add_to_wishlist]') . '
                      </div>
                    </div>
                  </div>
                </div>
              </div>
      			</div>';
                ?>
            <?php endforeach; ?>
        </div>

    <?php else :
        echo "<p>No Matching Product Available</p>";
    ?>

    <?php endif;
    wp_reset_postdata();
}

function rc_woocommerce_recently_viewed_products($atts, $content = null) {
    extract(shortcode_atts(array(
        "per_page" => '5'
    ), $atts));

    global $woocommerce;

    $viewed_products = !empty($_COOKIE['woocommerce_recently_viewed']) ? (array) explode('|', $_COOKIE['woocommerce_recently_viewed']) : array();
    $viewed_products = array_filter(array_map('absint', $viewed_products));

    if (empty($viewed_products))
        return __('You have not viewed any product yet!', 'rc_wc_rvp');

    ob_start();

    if (!isset($per_page) ? $number = 5 : $number = $per_page)

        $query_args = array(
            'posts_per_page' => $number,
            'no_found_rows'  => 1,
            'post_status'    => 'publish',
            'post_type'      => 'product',
            'post__in'       => $viewed_products,
            'orderby'        => 'rand'
        );

    $query_args['meta_query'] = array();
    $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();

    $r = new WP_Query($query_args);
    if ($r->have_posts()) {
        $content = '<div class="row recently_viewed_products_wrap">
        <div class="col-xs-12">
      <ul class="rc_wc_rvp_product_list_widget products products-grid grid-space-default products-grid-1 grid-items xxl-block-grid-4
      xl-block-grid-3 lg-block-grid-3 md-block-grid-2 sm-block-grid-1 block-grid-1 recently_viewed_products">';
        while ($r->have_posts()) {
            $r->the_post();
            global $product;
            $attachment_ids = $product->get_gallery_image_ids();
            $image_link = wp_get_attachment_url($attachment_ids[0]);

            $content .= '<li class="grid-item product_item">
          <div class="product_item--inner">
            <div class="product_item--thumbnail recently_viewed_hover">
              <div class="product_item--thumbnail-holder">
                <a href="' . get_permalink() . '">
                  <div class="recently_viewed_img" style="background-image: url(' . get_the_post_thumbnail_url() . ');"></div>
                  <div class="wp_alt_image" style="background-image: url(' . $image_link . ');"></div>
                </a>
              </div>

              <div class="product_item--info text-center recently_viewed_on_hover">
                <div class="product_item--info-inner">
                  <h3 class="product_item--title">
                    <a href="' . get_permalink() . '">
                      ' . get_the_title() . '
                    </a>
                  </h3>
                  <div class="custom-product-short-description">
                    ' . apply_filters('the_excerpt', $product->post->post_excerpt) . '
                  </div>
                  <span class="price">
                    <span class="woocommerce-Price-amount amount">
                      <span class="woocommerce-Price-currencySymbol">
                      ' . $product->get_price_html() . '
                      </span>
                    </span>
                  </span>
                  <div class="product_wl_qv_btn">
                    <a class="quick_view" href="' . get_permalink() . '">
                      <img src="/mukta/wp-content/uploads/2020/10/eye-icon.png"/>
                    </a>
                    ' . do_shortcode('[yith_wcwl_add_to_wishlist]') . '
                  </div>
                </div>
              </div>
            </div>
          </div>
  			</li>';
        }
        $content .= '</ul></div></div>';
    }

    $content .= ob_get_clean();
    return $content;
}

// Register the shortcode
add_shortcode("woocommerce_recently_viewed_products", "rc_woocommerce_recently_viewed_products");

function woo_custom_product_tab_content() {
    woocommerce_cross_sell_display();
}

function upsell_tab_content() {
    woocommerce_upsell_display();
}
function woo_other_products_tab_content() {
    echo do_shortcode("[woocommerce_recently_viewed_products]");
}

// add_filter('woocommerce_product_tabs', 'woo_custom_product_tabs');

// To change add to cart text on single product page
add_filter('woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text');
function woocommerce_custom_single_add_to_cart_text() {
    return __('ADD TO BAG', 'woocommerce');
}

// Update by Shobnom on 6/11 start
// Show custom product code above Add to Cart
add_action('woocommerce_after_add_to_cart_quantity', 'custom_product_code', 9);
function custom_product_code() {
    global $product;
    if ($product->get_sku()) {
        echo '<div class="product_code"><p>' . $product->get_sku() . '</p></div>';
    }
}
add_action("woocommerce_before_add_to_cart_quantity", "custom_size_guide", 9);
function custom_size_guide() {
    echo '<div class="popup-wrap">
      <div class="popup-overlay">
        <div class="popup-content">
          <a class="modal_close_btn close"><i class="dl-icon-close"></i></a>
          <div class="size_content">
            <img src="/mukta/wp-content/uploads/2020/11/MUKTA-SIZE-GUIDE.jpg"/>
          </div>
        </div>
      </div>
    </div>
    <a class="modal_btn open">Size Guide</a>';

    echo '<div class="quantity_wrap">';
}
// Update by Shobnom on 6/11 end

add_action("woocommerce_after_add_to_cart_quantity", "custom_single_product_quantity", 10);
function custom_single_product_quantity() {
    echo "</div>";
}

// Show custom sharing button after Add to Cart
add_action('woocommerce_after_add_to_cart_button', 'custom_sharing_button', 9);
function custom_sharing_button() {
    echo '<div class="share_section">' .
        do_shortcode('[yith_wcwl_add_to_wishlist]') .
        '<div class="share_wrap">
			<a class="custom_sharing" href="#"><i class="fa fa-share-alt" aria-hidden="true"></i></a>
		</div>' . woocommerce_template_single_sharing() . '
	</div>';
}


// add short description
function woocommerce_after_shop_loop_item_title_short_description() {
    global $product;

    if (!$product->post->post_excerpt) return;
    ?>
    <div itemprop="description" class="custom-product-short-description">
        <?php echo apply_filters('woocommerce_short_description', $product->post->post_excerpt) ?>
    </div>
<?php
}
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_after_shop_loop_item_title_short_description', 5);

// Search Form placeholder text change
function rlv_search_form($form) {
    $form = str_replace('Search here&hellip;', 'Enter Location', $form);
    return $form;
}
add_filter('get_search_form', 'rlv_search_form');

function mytheme_add_woocommerce_support() {
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'mytheme_add_woocommerce_support');

if (!function_exists('woocommerce_widget_shopping_cart_button_view_cart')) {

    /**
     * Output the view cart button.
     */
    function woocommerce_widget_shopping_cart_button_view_cart() {
        echo '<a href="' . esc_url(wc_get_cart_url()) . '" class="button wc-forward custom-woo-shopping-bag">' . esc_html__('VIEW SHOPPING BAG', 'woocommerce') . '</a>';
    }
}

add_filter( 'woocommerce_product_variation_title_include_attributes', '__return_false' );
function excerpt_in_cart($cart_item_html, $product_data) {
  global $_product;

  $excerpt = get_the_excerpt($product_data['product_id']);
  // $excerpt = substr($excerpt, 0, 80);
  echo '<p class="order_item_name">' . $cart_item_html . '</p><p class="shortDescription">' . $excerpt .'</p>';
}

add_filter('woocommerce_cart_item_name', 'excerpt_in_cart', 40, 2);

add_filter( 'woocommerce_order_item_get_name', 'filter_order_item_get_name_include_description', 10, 2 );
function filter_order_item_get_name_include_description( $item_name, $order_item ) {
    if (is_admin()) {
        $product = $order_item->get_product();
        $excerpt = get_the_excerpt($order_item['product_id']);

        if( $description = $product->get_name() . " - " .$excerpt ) {
            $item_name = $description;
        }
    }
    return $item_name;
}

// if (!function_exists('yith_woocommerce_add_wishlist_button_name')) {
//     function yith_woocommerce_add_wishlist_button_name($product_name, $cart_item, $cart_item_key)
//     {
//         return $product_name . ' ' . do_shortcode("[yith_wcwl_add_to_wishlist product_id=" . $cart_item['product_id'] . "]");
//     }
//     add_filter('woocommerce_cart_item_name', 'yith_woocommerce_add_wishlist_button_name', 10, 3);
// }

add_filter('woocommerce_add_to_cart_fragments', 'qty_change_in_ajax_add_to_cart_fragment');
/* Quantity cHange in ajax */
function qty_change_in_ajax_add_to_cart_fragment($fragments) {

    global $woocommerce;

    $fragments['.custom-qty-change-in-ajax-cart'] = '<a href="' . wc_get_cart_url() . '" class="custom-qty-change-in-ajax-cart">You have ' . $woocommerce->cart->cart_contents_count . " " . (($woocommerce->cart->cart_contents_count > "1") ? 'items' : 'item') . ' in your shopping bag</a>';

    return $fragments;
}


// WooCommerce Custom Registration Form
add_filter('woocommerce_registration_errors', 'registration_errors_validation', 10, 3);
function registration_errors_validation($reg_errors, $sanitized_user_login, $user_email) {
    global $woocommerce;
    extract($_POST);
    if (strcmp($password, $confirm_password) !== 0) {
        return new WP_Error('registration-error', __('Passwords do not match.', 'woocommerce'));
    }
    return $reg_errors;
}

add_action('woocommerce_register_form', 'wc_register_form_password_repeat');
function wc_register_form_password_repeat() {
?>
    <p class="form-row form-row-wide addtafterpassword">
        <label for="confirm_password"><?php _e('Confirm Password', 'woocommerce'); ?> <span class="required">*</span></label>
        <input type="password" class="input-text" name="confirm_password" placeholder="Confirmed Password *" id="confirm_password" value="<?php if (!empty($_POST['confirm_password'])) echo esc_attr($_POST['confirm_password']); ?>" />
    </p>
    <!-- <p class="form-row form-row-wide">
      <label for="dob"><?php _e('Date of Birth.', 'woocommerce'); ?> *</label>
      <input type="date" class="input-text dob" name="dob" id="dob" value="<?php esc_attr_e($_POST['dob']); ?>" />
    </p> -->
    <!-- Update by Shobnom on 1/11 start -->
    <p class="form-row form-row-wide">
        <label for="reg_billing_country"><?php _e('Country', 'woocommerce'); ?> <span class="required">*</span></label>
        <input type="text" class="input-text" name="billing_country" id="reg_billing_country" placeholder="Country *" value="<?php esc_attr_e($_POST['billing_country']); ?>" />
    </p>
    <!-- Update by Shobnom on 1/11 end -->
    <p class="form-row form-row-wide">
        <label for="billing_phone"><?php _e('Phone', 'woocommerce'); ?> <span class="required">*</span></label>
        <input type="text" class="input-text" name="billing_phone" id="billing_phone" placeholder="Mobile Number *" value="<?php esc_attr_e($_POST['billing_phone']); ?>" />
    </p>
    <p class="form-row form-row-wide">
        <label for="billing_nid"><?php _e('NID/Passport', 'woocommerce'); ?> *</label>
        <input type="text" class="input-text" name="billing_nid" id="billing_nid" placeholder="NID/Passport Number *" value="<?php echo esc_attr($user_nid); ?>" />
    </p>
<?php
}

function wooc_extra_register_fields() { ?>
    <div class='text-center sign_in_button-wrap user-button-wrap'>
        <!-- Update by Shobnom on 1/11 start -->
        <p class='curved-bottom'>Create an account</p>
        <!-- <a href='#' class='curved-bottom' target='_blank'>Create an account</a> -->
        <!-- Update by Shobnom on 1/11 end -->
      </div>
      <p class="req-field">* Required Field</p>
      <p class="form-row form-row-wide user_reg_title_wrap">
        <!-- Update by Shobnom on 1/11 start -->
        <label for="billing_title"><?php _e( 'Title', 'woocommerce' ); ?>  <span class="required">*</span></label>
        <span class="woocommerce-input-wrapper user_reg_title">
          <select name="billing_title" id="billing_title" >
              <option disabled value> -- Select an option -- </option>
              <option value="Ms" <?php if (get_the_author_meta( 'billing_title', $user->ID ) == "Ms") echo 'selected="selected" '; ?>>Ms</option>
              <option value="Mr" <?php if (get_the_author_meta( 'billing_title', $user->ID ) == "Mr") echo 'selected="selected" '; ?>>Mr</option>
              <option value="Mrs" <?php if (get_the_author_meta( 'billing_title', $user->ID ) == "Mrs") echo 'selected="selected" '; ?>>Mrs</option>
          </select>
      </span>
      </p>
       <p class="form-row form-row-wide">
         <label for="billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?><span class="required">*</span></label>
         <input type="text" class="input-text" name="billing_first_name" id="billing_first_name"
         placeholder="First Name *" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
       </p>
       <p class="form-row form-row-wide">
         <label for="billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?><span class="required">*</span></label>
         <input type="text" class="input-text" name="billing_last_name" id="billing_last_name"
         placeholder="Last Name *" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
       </p>
       <!-- Update by Shobnom on 1/11 end -->
       <?php
 }

 add_action( 'woocommerce_register_form_start', 'wooc_extra_register_fields' );
 add_action( 'woocommerce_register_form_end', 'wooc_extra_register_fields_after_form' );
 //add_action( 'woocommerce_billing_fields', 'wooc_extra_billing_fields' );

 function wooc_extra_register_fields_after_form() {?>
   <div class="user-reg-after-section">
    <div class="woocommerce-privacy-policy-text">
      <p>By clicking 'Create An Account' you agree to our <br><a href="/terms-and-conditions/#privacy-policy"
        class="woocommerce-privacy-policy-link" target="_blank">Privacy Policy</a> and our
        <a href="/terms-and-conditions/" class="woocommerce-terms-and-conditions-link" target="_blank">
        Terms and Conditions</a>
      </p>
    </div>
     <div class="form-row form-row-wide">
        <label for="newsletter_checked" class="col-md-12 newsletter_round" style="padding-left: 0;">
          <span class="newsletter-label">I would also like to recieve information about <b>MUKTA</b> products or services using any of the contact details
      that I have provided, and consent to the processing of my personal data by <b>MUKTA</b> for customer satisfaction
      purposes and for customising my user experience to my interests or my shopping habits.<span>
        <input type="checkbox" id="newsletter_checked" name="newsletter_checked" value="newsletter_checked" />
        <span class="checkmark"></span>
        </label>
      </div>
    </div>
<?php
}

// Conditional Field validation
add_action('woocommerce_register_post', 'conditional_fields_validation', 10, 3);
function conditional_fields_validation($username, $email, $validation_errors) {

    if (isset($_POST['billing_first_name']) && empty($_POST['billing_first_name'])) {
        $validation_errors->add('billing_first_name_error', __('First name is required!', 'woocommerce'));
    }
    if (isset($_POST['billing_last_name']) && empty($_POST['billing_last_name'])) {
        $validation_errors->add('billing_last_name_error', __('Last name is required!', 'woocommerce'));
    }
    if (isset($_POST['billing_country']) && empty($_POST['billing_country'])) {
        $validation_errors->add('billing_country_error', __('Country is required!', 'woocommerce'));
    }
    if (isset($_POST['billing_phone']) && empty($_POST['billing_phone'])) {
        $validation_errors->add('billing_phone_error', __('Mobile Number is required!', 'woocommerce'));
    }
    if (isset($_POST['billing_nid']) && empty($_POST['billing_nid'])) {
        $validation_errors->add('billing_nid_error', __('NID/Passport number is required!', 'woocommerce'));
    }
    // Shobnom: 23-10-2020 -> deleted unnecessary code
    return $validation_errors;
}

// Save field on Customer Created action
// Shobnom: 23-10-2020 start
function custom_airi_save_extra_register_select_field($customer_id) {
    if (isset($_POST['billing_title'])) {
        update_user_meta($customer_id, 'billing_title', $_POST['billing_title']);
    }
    // Shobnom: 23-10-2020 end
    if (isset($_POST['billing_first_name'])) {
        update_user_meta($customer_id, 'billing_first_name', sanitize_text_field($_POST['billing_first_name']));
        //update_user_meta( $customer_id, 'first_name', sanitize_text_field($_POST['billing_first_name']) );
    }
    if (isset($_POST['billing_last_name'])) {
        update_user_meta($customer_id, 'billing_last_name', sanitize_text_field($_POST['billing_last_name']));
        //update_user_meta( $customer_id, 'last_name', sanitize_text_field($_POST['billing_last_name']) );
    }
    if (isset($_POST['billing_country'])) {
        update_user_meta($customer_id, 'billing_country', $_POST['billing_country']);
    }
    if (isset($_POST['billing_phone'])) {
        update_user_meta($customer_id, 'billing_phone', $_POST['billing_phone']);
    }
    if (isset($_POST['billing_nid'])) {
        update_user_meta($customer_id, 'billing_nid', $_POST['billing_nid']);
    }
    // Shobnom: 23-10-2020 -> deleted unnecessary code
}
add_action('woocommerce_created_customer', 'custom_airi_save_extra_register_select_field');

// Quantity Button Modification
add_filter('qib_quantity_template_path', 'qib_replace_template');
function qib_replace_template($template_path) {
    $template_path = get_stylesheet_directory() . '/custom templates/quantity-input.php';
    return $template_path;
}

/**
 * Update 01 Start
 * 1) added postcode
 * 2) added thana
 * Added by Tanzim
 * Date 27-Oct-2020
 */
// Update by Shobnom on 2/11 start
// Checkout page billing and shipping address placeholder change
add_filter('woocommerce_default_address_fields', 'custom_override_default_checkout_fields', 10, 1);
function custom_override_default_checkout_fields($address_fields)
{
    // Remove labels for "address 2" shipping fields
    unset($address_fields['address_1']['placeholder']);
    unset($address_fields['address_2']['placeholder']);

    return $address_fields;
}
// Update by Shobnom on 2/11 end
// Hook in
add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');
// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields($fields)
{
    unset($fields['billing']['billing_first_name']['label']);
    $fields['billing']['billing_first_name']['placeholder'] = 'First Name*';
    $fields['billing']['billing_first_name']['priority'] = 20;
    $fields['billing']['billing_last_name'] = array(
        'placeholder'   => _x('Last Name*', 'placeholder', 'woocommerce'),
        'required'  => true,
        'class'     => array('form-row-wide'),
        'priority'  => 30,
        'clear'     => false
    );

    $fields['billing']['billing_address_1'] = array(
        'placeholder'   => _x('Street Address 1*', 'placeholder', 'woocommerce'),
        'required'  => true,
        'class'     => array('form-row-wide'),
        'priority'  => 40,
        'clear'     => false
    );
    $fields['billing']['billing_address_2'] = array(
        'placeholder'   => _x('Street Address 2', 'placeholder', 'woocommerce'),
        'required'  => false,
        'class'     => array('form-row-wide'),
        'priority'  => 50,
        'clear'     => false
    );

    $fields['billing']['billing_postcode'] = array(
        'required' => true,
        'class' => array('form-row-wide'),
        'priority' => 60,
        'placeholder' => _x('Postcode*', 'placeholder', 'woocommerce'),
        'clear'     => false
    );
    //unset($fields['billing']['billing_postcode']);

    $fields['billing']['billing_recipient_thana'] = array(
        'required' => true,
        'class' => array('form-row-wide'),
        'priority' => 70,
        'placeholder' => _x('Thana*', 'placeholder', 'woocommerce'),
        'clear'     => false
    );
    //$fields['billing']['billing_state']['placeholder'] = 'District*';
    //$fields['billing']['billing_state']['priority'] = 80;
    $fields['billing']['billing_city'] = array(
        'placeholder'   => _x('City*', 'placeholder', 'woocommerce'),
        'required'  => true,
        'class'     => array('form-row-wide'),
        'priority'  => 80,
        'clear'     => false
    );
    $fields['billing']['billing_state'] = array(
        'placeholder'   => _x('District*', 'placeholder', 'woocommerce'),
        'required'  => true,
        'class'     => array('form-row-wide'),
        'priority'  => 90,
        'clear'     => false
    );
    $fields['billing']['billing_country']['priority'] = 100;
    $fields['billing']['billing_phone']['priority'] = 110;
    unset($fields['billing']['billing_phone']['label']);
    $fields['billing']['billing_email']['priority'] = 120;
    $fields['billing']['billing_phone']['placeholder'] = 'Mobile Number*';
    unset($fields['billing']['billing_email']['label']);
    $fields['billing']['billing_email']['placeholder'] = 'Email*';
    unset($fields['billing']['billing_company']);


    unset($fields['shipping']['shipping_first_name']['label']);
    $fields['shipping']['shipping_first_name']['placeholder'] = 'First Name*';
    $fields['shipping']['shipping_first_name']['priority'] = 20;
    $fields['shipping']['shipping_last_name'] = array(
        'placeholder'   => _x('Last Name*', 'placeholder', 'woocommerce'),
        'required'  => true,
        'class'     => array('form-row-wide'),
        'priority'  => 30,
        'clear'     => false
    );
    $fields['shipping']['shipping_address_1'] = array(
        'placeholder'   => _x('Street Address 1*', 'placeholder', 'woocommerce'),
        'required'  => true,
        'class'     => array('form-row-wide'),
        'priority'  => 40,
        'clear'     => false
    );
    $fields['shipping']['shipping_address_2'] = array(
        'placeholder'   => _x('Street Address 2', 'placeholder', 'woocommerce'),
        'required'  => false,
        'class'     => array('form-row-wide'),
        'priority'  => 50,
        'clear'     => false
    );
    ## updated by tanzim start -> 10-Oct-2020
    $fields['shipping']['shipping_postcode'] = array(
        'required' => true,
        'class' => array('form-row-wide'),
        'priority' => 60,
        'placeholder' => _x('Postcode*', 'placeholder', 'woocommerce'),
    );
    ## updated by tanzim end -> 10-Oct-2020
    $fields['shipping']['shipping_recipient_thana'] = array(
        'required' => true,
        'class' => array('form-row-wide'),
        'priority' => 70,
        'placeholder' => _x('Thana*', 'placeholder', 'woocommerce'),
    );
    $fields['shipping']['shipping_city'] = array(
        'placeholder'   => _x('City*', 'placeholder', 'woocommerce'),
        'required'  => true,
        'class'     => array('form-row-wide'),
        'priority'  => 80,
        'clear'     => false
    );
    $fields['shipping']['shipping_state']['placeholder'] = 'District*';
    $fields['shipping']['shipping_state']['priority'] = 90;
    unset($fields['shipping']['shipping_state']['label']);
    unset($fields['shipping']['shipping_company']);
    unset($fields['order']['order_comments']);
    /* Update by shobnom on nov 2 */
    $fields['shipping']['shipping_country']['priority'] = 100;
    $fields['shipping']['shipping_phone'] = array(
        'required' => true,
        'class' => array('form-row-wide'),
        'priority' => 110,
        'placeholder' => 'Mobile Number*'
    );
    $fields['shipping']['shipping_email'] = array(
        'required' => true,
        'class' => array('form-row-wide'),
        'priority' => 120,
        'placeholder' => 'Email*'
    );
    return $fields;
}
/**
 * Update 01 End
 * 1) added postcode
 * 2) added thana
 * Added by Tanzim
 * Date 27-Oct-2020
 */

// remove Order Notes from checkout field in Woocommerce
// add_filter( 'woocommerce_checkout_fields' , 'alter_woocommerce_checkout_fields' );
// function alter_woocommerce_checkout_fields( $fields ) {
//      unset($fields['order']['order_comments']);
//      return $fields;
// }


/**
 * Changes the redirect URL and buttone text for the Return To Shop button in the cart.
 */
function wc_empty_cart_redirect_url() {
  return site_url();
}
add_filter( 'woocommerce_return_to_shop_redirect', 'wc_empty_cart_redirect_url', 10 );

add_filter( 'gettext', 'change_woocommerce_return_to_shop_text', 20, 3 );
function change_woocommerce_return_to_shop_text( $translated_text, $text, $domain ) {
        switch ( $translated_text ) {
            case 'Return to shop' :
                $translated_text = __( 'Return to Home', 'woocommerce' );
                break;
        }
    return $translated_text;
}
/**
 * Process the checkout
 */
// add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');

// function my_custom_checkout_field_process() {
//     // Check if set, if its not set add an error.
//     // if ( ! $_POST['billing_prename'] )
//     //     wc_add_notice( __( 'Please enter name title.' ), 'error' );
//
//     // if ( ! $_POST['billing']['billing_first_name'] )
//     // wc_add_notice( __( 'Please enter billing first name.' ), 'error' );
//
//     // if ( ! $_POST['billing']['billing_last_name'] )
//     // wc_add_notice( __( 'Please enter last name.' ), 'error' );
//
//     // if ( ! $_POST['billing']['billing_address_1'] )
//     // wc_add_notice( __( 'Please enter billing address 1.' ), 'error' );
//
//     // if ( ! $_POST['billing']['billing_address_2'] )
//     // wc_add_notice( __( 'Please enter billing address 2.' ), 'error' );
//
//     // if ( ! $_POST['billing']['billing_country'] )
//     // wc_add_notice( __( 'Please enter billing country.' ), 'error' );
//
//     // if ( ! $_POST['billing']['billing_city'] )
//     // wc_add_notice( __( 'Please enter billing city.' ), 'error' );
//
//     // if ( ! $_POST['billing']['billing_state'] )
//     // wc_add_notice( __( 'Please enter billing state.' ), 'error' );
//
//     // if ( ! $_POST['billing']['billing_phone'] )
//     // wc_add_notice( __( 'Please enter billing phone.' ), 'error' );
//
//     // if ( ! $_POST['billing']['billing_email'] )
//     // wc_add_notice( __( 'Please enter billing email.' ), 'error' );
//
// }


/**
 * Update 02 Start
 * 1) added postcode
 * 2) added thana
 * Added by Tanzim
 * Date 27-Oct-2020
 */

/**
 * Update the order meta with field value
 */
add_action('woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta');

function my_custom_checkout_field_update_order_meta($order_id)
{
    if (!empty($_POST['billing_prename'])) {
        update_post_meta($order_id, '', sanitize_text_field($_POST['billing_prename']));
    }
    if (!empty($_POST['billing_first_name'])) {
        update_post_meta($order_id, '', sanitize_text_field($_POST['billing_first_name']));
    }
    if (!empty($_POST['billing_last_name'])) {
        update_post_meta($order_id, '', sanitize_text_field($_POST['billing_last_name']));
    }
    if (!empty($_POST['billing_address_1'])) {
        update_post_meta($order_id, '', sanitize_text_field($_POST['billing_address_1']));
    }
    if (!empty($_POST['billing_address_2'])) {
        update_post_meta($order_id, '', sanitize_text_field($_POST['billing_address_2']));
    }
    if (!empty($_POST['billing_country'])) {
        update_post_meta($order_id, '', sanitize_text_field($_POST['billing_country']));
    }
    if (!empty($_POST['billing_city'])) {
        update_post_meta($order_id, '', sanitize_text_field($_POST['billing_city']));
    }
    if (!empty($_POST['billing_state'])) {
        update_post_meta($order_id, '', sanitize_text_field($_POST['billing_state']));
    }
    if (!empty($_POST['billing_phone'])) {
        update_post_meta($order_id, '', sanitize_text_field($_POST['billing_phone']));
    }
    if (!empty($_POST['billing_email'])) {
        update_post_meta($order_id, '', sanitize_text_field($_POST['billing_email']));
    }
    if (!empty($_POST['billing_postcode'])) {
        update_post_meta($order_id, '', sanitize_text_field($_POST['billing_postcode']));
    }
    if (!empty($_POST['billing_recipient_thana'])) {
        update_post_meta($order_id, '', sanitize_text_field($_POST['billing_recipient_thana']));
    }
}

/**
 * Display field value on the order edit page
 */

add_action('woocommerce_admin_order_data_before_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 30);

function my_custom_checkout_field_display_admin_order_meta($order)
{
    echo '<p><strong>' . __('Phone From Checkout Form') . ':</strong> ' . get_post_meta($order->get_id(), '_billing_prename', true) . '</p>';
    echo '<p><b>Thana:</b> ' . get_post_meta($order->get_id(), '_billing_recipient_thana', true) . '</p>';
    //echo '<p><b>Postcode:</b> ' . get_post_meta( $order->get_id(), '_billing_recipient_postcode', true ) . '</p>';
}

/**
 * Update 02 End
 * 1) added postcode
 * 2) added thana
 * Added by Tanzim
 * Date 27-Oct-2020
 */

// function my_custom_checkout_field_display($order){
//   echo '<p><strong>'.__('My Address').':</strong> ' . get_post_meta( $order->id, '_billing_address_1', true ) . '</p>';
// }
//$address_fields = apply_filters('woocommerce_billing_fields', $address_fields);
//$this->checkout_fields['billing'] = $woocommerce->countries->get_address_fields( $this->get_value('billing_country'), 'billing_' );
//$this->checkout_fields = apply_filters('woocommerce_checkout_fields', $this->checkout_fields);

// function mode_theme_update_mini_cart() {
//   echo wc_get_template( 'cart/mini-cart.php' );
//   die();
// }
// add_filter( 'wp_ajax_nopriv_mode_theme_update_mini_cart', 'mode_theme_update_mini_cart' );
// add_filter( 'wp_ajax_mode_theme_update_mini_cart', 'mode_theme_update_mini_cart' );

add_filter('widget_text', 'do_shortcode');
add_filter('woocommerce_form_field', 'custom_airi_checkout_fields_in_label_error', 10, 4);

function custom_airi_checkout_fields_in_label_error($field, $key, $args, $value)
{
    if (strpos($field, '</label>') !== false && $args['required']) {
        $error = '<span class="error" style="display:none">';
        $error .= sprintf(__('%s is a required field.', 'woocommerce'), $args['label']);
        $error .= '</span>';
        $field = substr_replace($field, $error, strpos($field, '</label>'), 0);
    }
    return $field;
}


//* Add Title select field to the checkout page
// add_action('woocommerce_before_checkout_billing_form', 'wps_add_prename_select_checkout_field');
// function wps_add_prename_select_checkout_field( $checkout ) {
//
// 	woocommerce_form_field( 'billing_prename', array(
//     'placeholder'   => _x('Ms', 'placeholder', 'woocommerce'),
//     'required'  => true,
//     'class'     => array('form-row-wide'),
//     'clear'     => true,
//     'type'      => 'select',
//     'priority'  => 100,
//     'options'       => array(
//       'blank'		=> __( 'Select a name title', 'wps' ),
//       'Ms' => __('Ms', 'woocommerce' ),
//       'Mr' => __('Mr', 'woocommerce' ),
//       'Mrs' => __('Mrs', 'woocommerce' )
//     )
//  ),
//
// 	$checkout->get_value( 'billing_prename' ));
//
// }
//* Process the checkout
// add_action('woocommerce_checkout_process', 'wps_select_checkout_field_process');
// function wps_select_checkout_field_process() {
//    global $woocommerce;

// Check if set, if its not set add an error.
//    if ($_POST['billing_prename'] == "blank")
//     wc_add_notice( '<strong>Please select a Name title</strong>', 'error' );
//
// }
//* Update the order meta with field value
// add_action('woocommerce_checkout_update_order_meta', 'wps_select_checkout_field_update_order_meta');
// function wps_select_checkout_field_update_order_meta( $order_id ) {
//
//   if ($_POST['billing_prename']) update_post_meta( $order_id, 'billing_prename', esc_attr($_POST['billing_prename']));
//
// }
//* Display field value on the order edition page
// add_action( 'woocommerce_admin_order_data_after_billing_address', 'wps_select_checkout_field_display_admin_order_meta', 10, 1 );
// function wps_select_checkout_field_display_admin_order_meta($order){
//
// 	echo '<p>' . get_post_meta( $order->id, 'billing_prename', true ) . '</p>';
//
// }

//* Add selection field value to emails
// add_filter('woocommerce_email_order_meta_keys', 'wps_select_order_meta_keys');
// function wps_select_order_meta_keys( $keys ) {
//
// 	$keys['billing_prename:'] = 'billing_prename';
// 	return $keys;
//
// }

// add_filter( 'woocommerce_form_field', 'checkout_fields_in_label_error', 10, 4 );

// function checkout_fields_in_label_error( $field, $key, $args, $value ) {
//    if ( strpos( $field, '</span>' ) !== false && $args['required'] ) {
//       $error = '<span class="error" style="display: none;">';
//       $error .= sprintf( __( '%s is a required field.', 'woocommerce' ), $args['input'] );
//       $error .= '</span>';
//       $field = substr_replace( $field, $error, strpos( $field, '</span>' ), 0);
//    }
//    return $field;
// }

/**
 * Update 03 Start
 * 1) added postcode
 * 2) added thana
 * 3) modified some other fields
 * Added by Tanzim
 * Date 27-Oct-2020
 */

// Shipping fields on my account edit-addresses
add_filter('woocommerce_shipping_fields', 'custom_shipping_fields');
function custom_shipping_fields($fields)
{
    // Shipping Fields
    // Update by Shobnom on 1/11 start
    $fields['shipping_title'] = array(
        // Shobnom: 23-10-2020 end
        'placeholder'   => _x('Ms', 'placeholder', 'woocommerce'),
        'required'  => false,
        'class'     => array('form-row-wide shipping_select'),
        'clear'     => true,
        'type'      => 'select',
        'priority'  => 10,
        'options'     => array(
            'Ms' => __('Ms', 'woocommerce'),
            'Mr' => __('Mr', 'woocommerce'),
            'Mrs' => __('Mrs', 'woocommerce'),
        ) //end of options
    );
    $fields['shipping_first_name']['placeholder'] = 'First name*';
    $fields['shipping_first_name']['class'] = array('form-row-wide');
    $fields['shipping_first_name']['priority'] = 20;
    $fields['shipping_first_name']['required'] = true;
    $fields['shipping_last_name']['placeholder'] = 'Last name*';
    $fields['shipping_last_name']['class'] = array('form-row-wide');
    $fields['shipping_last_name']['priority'] = 30;
    $fields['shipping_last_name']['required'] = true;
    $fields['shipping_address_1']['placeholder'] = 'Street address 1*';
    $fields['shipping_address_1']['priority'] = 40;
    $fields['shipping_address_1']['required'] = true;
    $fields['shipping_address_2']['placeholder'] = 'Street address 2';
    $fields['shipping_address_2']['priority'] = 50;
    ## updated by tanzim start -> 10-Oct-2020
    $fields['shipping_postcode'] = array(
        'required' => true,
        'class' => array('form-row-wide'),
        'label' => 'Postcode',
        'priority' => 60,
        'placeholder' => _x('Postcode*', 'placeholder', 'woocommerce'),
    );
    ## updated by tanzim end -> 10-Oct-2020
    $fields['shipping_recipient_thana'] = array(
        'required' => true,
        'class' => array('form-row-wide'),
        'label' => 'Thana',
        'priority' => 70,
        'placeholder' => _x('Thana*', 'placeholder', 'woocommerce'),
    );
    // $fields['shipping_state'] = array(
    //   'placeholder'   => _x('District*', 'placeholder', 'woocommerce'),
    //   'required'  => true,
    //   'priority'  => 80,
    //   'class'     => array('form-row-wide')
    // );
    $fields['shipping_city']['placeholder'] = 'City*';
    // Update by Shobnom on 2/11 start
    $fields['shipping_city']['priority'] = 80;
    $fields['shipping_city']['required'] = true;
    $fields['shipping_state']['priority'] = 90;
    $fields['shipping_country']['priority'] = 100;
    // $fields['shipping_country'] = array(
    //   'placeholder'   => _x('Country*', 'placeholder', 'woocommerce'),
    //   'required'  => true,
    //   'priority'  => 100,
    //   'class'     => array('form-row-wide')
    // );
    // Update by Shobnom on 2/11 end
    $fields['shipping_phone']['placeholder'] = 'Mobile Number*';
    $fields['shipping_phone']['priority'] = 110;
    $fields['shipping_phone']['required'] = true;
    $fields['shipping_phone']['label'] = 'Mobile Number';
    $fields['shipping_email']['placeholder'] = 'Email*';
    $fields['shipping_email']['priority'] = 120;
    $fields['shipping_email']['required'] = true;
    $fields['shipping_email']['label'] = 'Email';

    unset($fields['shipping_company']);

    return $fields;
}

// Billing fields on my account edit-addresses
add_filter('woocommerce_billing_fields', 'custom_billing_fields');
function custom_billing_fields($fields)
{

    // billing Fields
    $fields['billing_title'] = array(
        'placeholder'   => _x('Ms', 'placeholder', 'woocommerce'),
        'required'  => false,
        'class'     => array('form-row-wide billing_select'),
        'clear'     => true,
        'type'      => 'select',
        'priority'  => 10,
        'options'     => array(
            'Ms' => __('Ms', 'woocommerce'),
            'Mr' => __('Mr', 'woocommerce'),
            'Mrs' => __('Mrs', 'woocommerce'),
        ) //end of options
    );
    $fields['billing_first_name']['placeholder'] = 'First name*';
    $fields['billing_first_name']['class'] = array('form-row-wide');
    $fields['billing_first_name']['priority'] = 20;
    $fields['billing_first_name']['required'] = true;
    $fields['billing_last_name']['placeholder'] = 'Last name*';
    $fields['billing_last_name']['class'] = array('form-row-wide');
    $fields['billing_last_name']['priority'] = 30;
    $fields['billing_last_name']['required'] = true;
    $fields['billing_address_1']['placeholder'] = 'Street address 1*';
    $fields['billing_address_1']['priority'] = 40;
    $fields['billing_address_1']['required'] = true;
    $fields['billing_address_2']['placeholder'] = 'Street address 2';
    $fields['billing_address_2']['priority'] = 50;


    $fields['billing_postcode'] = array(
        'required' => true,
        'class' => array('form-row-wide'),
        'label' => 'Postcode',
        'priority' => 60,
        'placeholder' => _x('Postcode*', 'placeholder', 'woocommerce'),
    );
    //unset($fields['billing_postcode']);
    $fields['billing_recipient_thana'] = array(
        'required' => true,
        'class' => array('form-row-wide'),
        'label' => 'Thana',
        'priority' => 70,
        'placeholder' => _x('Thana*', 'placeholder', 'woocommerce'),
    );
    // $fields['billing_state'] = array(
    //   'placeholder'   => _x('District*', 'placeholder', 'woocommerce'),
    //   'required'  => true,
    //   'priority'  => 80,
    //   'class'     => array('form-row-wide')
    // );
    $fields['billing_city']['placeholder'] = 'City*';
    // Update by Shobnom on 2/11 start
    $fields['billing_city']['priority'] = 80;
    $fields['billing_city']['required'] = true;
    $fields['billing_state']['priority'] = 90;
    $fields['billing_country']['priority'] = 100;
    // $fields['billing_country'] = array(
    //   'placeholder'   => _x('Country*', 'placeholder', 'woocommerce'),
    //   'required'  => true,
    //   'priority'  => 100,
    //   'class'     => array('form-row-wide')
    // );

    $user = wp_get_current_user();
    $fields['billing_phone']['placeholder'] = 'Mobile Number*';
    $fields['billing_phone']['priority'] = 110;
    $fields['billing_phone']['required'] = true;
    $fields['billing_phone']['label'] = 'Mobile Number';
    $fields['billing_email']['placeholder'] = 'Email*';
    $fields['billing_email']['priority'] = 120;
    $fields['billing_email']['required'] = true;
    $fields['billing_email']['label'] = 'Email';
    $fields['billing_email']['default'] =  $user->user_email;
    // Update by Shobnom on 2/11 end

    unset($fields['billing_company']);

    return $fields;
}
// Update by Shobnom on 1/11 end

/**
 * Update 03 End
 * 1) added postcode
 * 2) added thana
 * 3) modified some other fields
 * Added by Tanzim
 * Date 27-Oct-2020
 */

// Add the custom field to edit account form
add_action('woocommerce_edit_account_form', 'add_custom_fields_to_edit_account_form');
function add_custom_fields_to_edit_account_form()
{
    $user_id = get_current_user_id();
    $user_country = get_user_meta($user_id, 'billing_country', true);
    $user_phone = get_user_meta($user_id, 'billing_phone', true);
    $user_nid = get_user_meta($user_id, 'billing_nid', true);
    $user_dob = get_user_meta($user_id, 'dob', true);
    // First Field
?>
    <p class="form-row form-row-wide">
        <label for="dob"><?php _e('Date of Birth', 'woocommerce'); ?> *</label>
        <input type="date" class="input-text" name="dob" id="dob" value="<?php echo esc_attr($user_dob); ?>" />
    </p>
    <?php
    // Second Field
    ?>
    <p class="form-row form-row-wide">
        <!-- Update by Shobnom on 1/11 start -->
        <label for="reg_billing_country"><?php _e('Country', 'woocommerce'); ?> *</label>
        <!-- Update by Shobnom on 1/11 end -->
        <input type="text" class="input-text" name="billing_country" id="reg_billing_country" placeholder="Country *" value="<?php echo esc_attr($user_country); ?>" />
    </p>
    <?php
    // Third Field
    ?>
    <p class="form-row form-row-wide">
        <label for="billing_phone"><?php _e('Phone', 'woocommerce'); ?> *</label>
        <input type="text" class="input-text" name="billing_phone" id="billing_phone" placeholder="Mobile Number *" value="<?php echo esc_attr($user_phone); ?>" />
    </p>
    <?php
    // Forth Field
    ?>
    <p class="form-row form-row-wide">
        <label for="billing_nid"><?php _e('NID/Passport', 'woocommerce'); ?> *</label>
        <input type="text" class="input-text" name="billing_nid" id="billing_nid" placeholder="NID/Passport Number *" value="<?php echo esc_attr($user_nid); ?>" />
    </p>
    <div class="clear"></div>
<?php
}

// Save the custom field of account form
// Update by Shobnom on 1/11 start
add_action('woocommerce_save_account_details', 'custom_save_account_details');
function custom_save_account_details($user_id)
{
    // Shobnom: 23-10-2020 start
    update_user_meta($user_id, 'billing_title', sanitize_text_field($_POST['billing_title']));
    // Shobnom: 23-10-2020 end
    update_user_meta($user_id, 'billing_phone', sanitize_text_field($_POST['billing_phone']));
    update_user_meta($user_id, 'billing_country', sanitize_text_field($_POST['billing_country']));
    update_user_meta($user_id, 'dob', sanitize_text_field($_POST['dob']));
    if (isset($_POST['account_email']) && $_POST['account_email'] != '') {
        update_user_meta($user_id, 'billing_email', sanitize_text_field($_POST['account_email']));
    }
}
// Update by Shobnom on 1/11 end

// Make the custom field of account form Required
add_filter('woocommerce_save_account_details_required_fields', 'account_custom_field_make_required');
function account_custom_field_make_required($required_fields)
{

    $required_fields['billing_phone'] = 'Mobile Number';
    $required_fields['billing_country'] = 'Country';
    $required_fields['dob'] = 'Date Of Birth';
    $required_fields['billing_nid'] = 'NID/Passport Number';
    return $required_fields;
}

//set post excerpt length
function wpdocs_custom_excerpt_length($length)
{
    return 20;
}
add_filter('excerpt_length', 'wpdocs_custom_excerpt_length', 999);


/**
 * Update 04 Start
 * 1) added custom field in admin billing
 * 2) added custom field in admin shipping
 * Added by Tanzim
 * Date 27-Oct-2020
 */

add_action('woocommerce_admin_order_data_after_billing_address', 'mukta_billing_editable_order_meta_general');
function mukta_billing_editable_order_meta_general($order)
{  ?>
    <?php
    $billing_recipient_thana = get_post_meta($order->get_id(), '_billing_recipient_thana', true);
    //$billing_recipient_postcode = get_post_meta( $order->get_id(), '_billing_recipient_postcode', true );
    ?>
    <div class="address">
        <?php if ($billing_recipient_thana) { ?> <p><strong>Thana: </strong> <?php echo $billing_recipient_thana ?></p><?php } ?>
        <?php //if( $billing_recipient_postcode ) {
        ?>
        <!-- <p><strong>Postcode: </strong>   -->
        <?php //echo $billing_recipient_postcode
        ?>
        <!-- </p> -->
        <?php //}
        ?>
    </div>
    <div class="edit_address">
        <?php
        woocommerce_wp_text_input(array(
            'id' => '_billing_recipient_thana',
            'label' => 'Thana',
            'value' => $billing_recipient_thana,
            'wrapper_class' => 'form-field-wide'
        ));

        //   woocommerce_wp_text_input( array(
        //     'id' => '_billing_recipient_postcode',
        //     'label' => 'Postcode',
        //     'value' => $billing_recipient_postcode,
        //     'wrapper_class' => 'form-field-wide'
        //   ) );

        ?>
    </div>
<?php }

add_action('woocommerce_process_shop_order_meta', 'mukta_billing_save_general_details');
function mukta_billing_save_general_details($order_id)
{
    update_post_meta($order_id, '_billing_recipient_thana', wc_clean($_POST['_billing_recipient_thana']));
    //update_post_meta( $order_id, '_billing_recipient_postcode', wc_clean( $_POST[ '_billing_recipient_postcode' ] ) );
}


add_action('woocommerce_admin_order_data_after_shipping_address', 'mukta_shipping_editable_order_meta_general');
function mukta_shipping_editable_order_meta_general($order)
{  ?>
    <?php
    $shipping_email = get_post_meta($order->get_id(), 'shipping_email', true);
    $shipping_phone = get_post_meta($order->get_id(), 'shipping_phone', true);
    $shipping_recipient_thana = get_post_meta($order->get_id(), '_shipping_recipient_thana', true);
    ## updated by tanzim start -> 10-Oct-2020
    $shipping_postcode = get_post_meta($order->get_id(), 'shipping_postcode', true);
    ## updated by tanzim end -> 10-Oct-2020
    ?>
    <div class="address">
        <?php if ($shipping_email) { ?> <p><strong>Email: </strong> <a href="mailto:<?php echo $shipping_email ?>"><?php echo $shipping_email ?></a></p><?php } ?>
        <?php if ($shipping_phone) { ?> <p><strong>Phone: </strong> <a href="tel:<?php echo $shipping_phone ?>"> <?php echo $shipping_phone ?></a></p><?php } ?>
        <?php if ($shipping_recipient_thana) { ?> <p><strong>Thana: </strong> <?php echo $shipping_recipient_thana ?></p><?php } ?>
        <!-- ## updated by tanzim start -> 10-Oct-2020 -->
        <?php if ($shipping_postcode) { ?> <p><strong>Postcode: </strong> <?php echo $shipping_postcode ?> </p> <?php } ?>
        <!-- ## updated by tanzim end -> 10-Oct-2020 -->
    </div>
    <div class="edit_address">
        <?php
        woocommerce_wp_text_input(array(
            'id' => 'shipping_email',
            'label' => 'Email',
            'value' => $shipping_email,
            'wrapper_class' => 'form-field-wide'
        ));

        woocommerce_wp_text_input(array(
            'id' => 'shipping_phone',
            'label' => 'Phone',
            'value' => $shipping_phone,
            'wrapper_class' => 'form-field-wide'
        ));

        woocommerce_wp_text_input(array(
            'id' => '_shipping_recipient_thana',
            'label' => 'Thana',
            'value' => $shipping_recipient_thana,
            'wrapper_class' => 'form-field-wide'
        ));
        ## updated by tanzim start -> 10-Oct-2020
        woocommerce_wp_text_input(array(
            'id' => 'shipping_postcode',
            'label' => 'Postcode',
            'value' => $shipping_postcode,
            'wrapper_class' => 'form-field-wide'
        ));
        ## updated by tanzim end -> 10-Oct-2020

        ?>
    </div>
<?php }

add_action('woocommerce_process_shop_order_meta', 'mukta_shipping_save_general_details');
function mukta_shipping_save_general_details($order_id)
{
    update_post_meta($order_id, 'shipping_email', wc_clean($_POST['shipping_email']));
    update_post_meta($order_id, 'shipping_phone', wc_clean($_POST['shipping_phone']));
    update_post_meta($order_id, '_shipping_recipient_thana', wc_clean($_POST['_shipping_recipient_thana']));
    ## updated by tanzim start -> 10-Oct-2020
    update_post_meta($order_id, 'shipping_postcode', wc_clean($_POST['shipping_postcode']));
    ## updated by tanzim end -> 10-Oct-2020
}

/**
 * Update 04 End
 * 1) added custom field in admin billing
 * 2) added custom field in admin shipping
 * Added by Tanzim
 * Date 27-Oct-2020
 */


/**
 * Update 05 Start
 * 1) added SSLCommerz
 * 2) added eCourier
 * 3) added new order status
 * Added by Tanzim
 * Date 04-Jan-2021
 */
add_action( 'woocommerce_order_status_changed', 'mukta_order_status_change_to_completed', 99, 3 );
function mukta_order_status_change_to_completed( $order_get_id, $old_status, $new_status){

    $order = wc_get_order($order_get_id);

    if ($new_status == "completed") {
        $message = '';
        $message .= 'Order ID = ' . $order_get_id . "\n";
        $message .= 'Current Status = ' . $new_status . "\n";
        $message .= 'Old Status = ' . $old_status . "\n";
        $order->add_order_note($message);
        $order->save();
    }

    if ($new_status == "shipped") {
        $message = '';
        $message .= 'Order ID = ' . $order_get_id . "\n";
        $message .= 'Current Status = ' . $new_status . "\n";
        $message .= 'Old Status = ' . $old_status . "\n";
        $order->add_order_note($message);
        $order->save();
    }

    if ($new_status == "packed") {
        $order_data = $order->get_data();

        $order_id = $order_data['id'];
        $order_payment_method = $order_data['payment_method'];
        $order_total = $order_data['total'];
        $order_billing_address_2 = '';
        $order_shipping_address_2 = '';

        ## BILLING INFORMATION:
        $order_billing_first_name = $order_data['billing']['first_name'];
        $order_billing_last_name = $order_data['billing']['last_name'];
        $order_billing_address_1 = $order_data['billing']['address_1'];
        $order_billing_address_2 = $order_data['billing']['address_2'];
        $order_billing_postcode = $order_data['billing']['postcode'];
        $order_billing_city = $order_data['billing']['city'];
        $order_billing_state = $order_data['billing']['state'];
        $order_billing_phone = $order_data['billing']['phone'];
        $order_billing_recipient_thana = get_post_meta($order_id, '_billing_recipient_thana', true);

        ## SHIPPING INFORMATION:
        $order_shipping_first_name = $order_data['shipping']['first_name'];
        $order_shipping_last_name = $order_data['shipping']['last_name'];
        $order_shipping_address_1 = $order_data['shipping']['address_1'];
        $order_shipping_address_2 = $order_data['shipping']['address_2'];
        $order_shipping_postcode = $order_data['shipping']['postcode'];
        $order_shipping_city = $order_data['shipping']['city'];
        $order_shipping_state = $order_data['shipping']['state'];
        $order_shipping_phone = $order_data['shipping']['phone'];
        $order_shipping_phone1 = get_post_meta($order_id, '_shipping_phone', true);
        $order_shipping_recipient_thana = get_post_meta($order_id, '_shipping_recipient_thana', true);

        if ($order_shipping_phone == '') {
            $order_shipping_phone = $order_shipping_phone1;
        }

        if (($order_billing_first_name != ''
                && $order_billing_last_name != ''
                && $order_billing_address_1 != ''
                && $order_billing_city != ''
                && $order_billing_state != ''
                && $order_billing_phone != ''
                && $order_billing_recipient_thana != ''
                && $order_billing_postcode != '') ||
            ($order_shipping_first_name != ''
                && $order_shipping_last_name != ''
                && $order_shipping_address_1 != ''
                && $order_shipping_city != ''
                && $order_shipping_state != ''
                && $order_shipping_phone != ''
                && $order_shipping_recipient_thana != ''
                && $order_shipping_postcode != '')
        ) {
            ## for eCourrier Start
            $package_code = "#3712"; // Outside_Dhaka_STD(Metro)_2_3kg_200tk
            $product_price = $order_total;
            $payment_method = "";
            $order_billing_address_2 = "";
            $order_shipping_address_2 = "";
            if ($order_payment_method == "cod") {
                $payment_method = "COD";
            } else if ($order_payment_method == "sslcommerz") {
                ## for SSLCommerz Start
                $wc_gateways      = new WC_Payment_Gateways();
                $payment_gateways = $wc_gateways->get_available_payment_gateways();
                $payment_type = "";

                foreach ($payment_gateways as $gateway_id => $gateway) {
                    if ($gateway_id == "sslcommerz") {
                        $store_id = urlencode($gateway->store_id);
                        $store_passwd = urlencode($gateway->store_password);
                        if ('yes' == $gateway->testmode) {
                            $requested_url = ("https://sandbox.sslcommerz.com/validator/api/merchantTransIDvalidationAPI.php?tran_id=" . $order_id . "&store_id=" . $store_id . "&store_passwd=" . $store_passwd . "&v=1&format=json");
                        } else {
                            $requested_url = ("https://securepay.sslcommerz.com/validator/api/merchantTransIDvalidationAPI.php?tran_id=" . $order_id . "&store_id=" . $store_id . "&store_passwd=" . $store_passwd . "&v=1&format=json");
                        }

                        $result = wp_remote_post(
                            $requested_url,
                            array(
                                'method'      => 'GET',
                                'timeout'     => 30,
                                'redirection' => 10,
                                'httpversion' => '1.1',
                                'blocking'    => true,
                                'headers'     => array(),
                                'body'        => array(),
                                'cookies'     => array(),
                            )
                        );

                        if ($result['response']['code'] == 200) {
                            $result = json_decode($result['body']);
                            foreach ($result->element as $key => $value) {
                                $payment_type = $value->card_brand;
                            }
                        }
                    }
                }

                if ($payment_type == "MOBILEBANKING") {
                    $payment_method = "MPAY";
                } else {
                    $payment_method = "CCRD";
                }
                ## for SSLCommerz End
            }

            if (!empty($order_data['shipping'])) {
                $recipient_name = $order_shipping_first_name . " " . $order_shipping_last_name;
                $recipient_mobile = $order_shipping_phone;
                $recipient_city = $order_shipping_city;
                $recipient_area = $order_shipping_state;
                $recipient_address = $order_shipping_address_1 . " " . $order_shipping_address_2;
                $recipient_thana = $order_shipping_recipient_thana;
                $recipient_postcode = $order_shipping_postcode;
            } else {
                $recipient_name = $order_billing_first_name . " " . $order_billing_last_name;
                $recipient_mobile = $order_billing_phone;
                $recipient_city = $order_billing_city;
                $recipient_area = $order_billing_state;
                $recipient_address = $order_billing_address_1 . " " . $order_billing_address_2;
                $recipient_thana = $order_billing_recipient_thana;
                $recipient_postcode = $order_billing_postcode;
            }

            $endpoint = 'https://backoffice.ecourier.com.bd/api/order-place';

            $body = [
                'recipient_name'  => $recipient_name,
                'recipient_mobile' => $recipient_mobile,
                'recipient_city' => $recipient_city,
                'recipient_area' => $recipient_area,
                'recipient_address' => $recipient_address,
                'package_code' => $package_code,
                'product_price' => $product_price,
                'payment_method' => $payment_method,
                'recipient_thana' => $recipient_thana,
                'recipient_zip' => $recipient_postcode
            ];

            $body = wp_json_encode($body);

            $options = [
                'body'        => $body,
                'headers'     => [
                    'API-SECRET' => 'GBwuR',
                    'API-KEY' => 'qQgq',
                    'USER-ID' => 'L1845',
                    'Content-Type' => 'application/json',
                ],
                'timeout'     => 60,
                'redirection' => 5,
                'blocking'    => true,
                'httpversion' => '1.0',
                'sslverify'   => true,
                'data_format' => 'body',
            ];

            $response = wp_remote_post( $endpoint, $options );

            if (is_wp_error($response)) {
                $response->get_error_message();
                $message = '';
                $message .= 'Order Status = Error' . "\n";
                $message .= 'Message = Shipping order not submitted' . $response->get_error_message() . "\n";
                $order->update_status('on-hold');
                $order->add_order_note($message);
                $order->save();
            } else {
                $obj = json_decode($response['body']);
                $vars = get_object_vars($obj);
                if ($vars['success'] == true && $vars['response_code'] == 200) {
                    $message = '';
                    $message .= 'Order Status = Success' . "\n";
                    $message .= 'Message = Shipping order submitted successfully' . "\n";
                    $message .= 'ID = ' . $vars['ID'] . "\n";
                    $order->update_status('packed');
                    $order->add_order_note($message);
                    $order->save();
                } else {
                    $vars['errors'][0];
                    $message = '';
                    $message .= 'Order Status = Error' . "\n";
                    $message .= 'Message = Shipping order not submitted ' . $vars['errors'][0] . "\n";
                    $order->update_status('on-hold');
                    $order->add_order_note($message);
                    $order->save();
                }
            }

            ## for eCourier Stop
        } else {
            $order->update_status('on-hold');
            $message = '';
            $message .= 'Order Status = Error' . "\n";
            $message .= 'Message = Shipping order not submitted ' . "\n";
            $message .= 'Please update all required information ' . "\n";
            $order->add_order_note($message);
            $order->save();
        }
    }
}
/**
 * Update 05 End
 * 1) added SSLCommerz
 * 2) added eCourier
 * 3) added new order status
 * Added by Tanzim
 * Date 04-Jan-2021
 */

// Update by Shobnom on 1/11 start
// Save/Update billing email with User email
add_action('woocommerce_customer_save_address', 'save_billing_email_to_user_email', 12, 1);
function save_billing_email_to_user_email($user_id) {
    if (isset($_POST['billing_email']) && $_POST['billing_email'] != '') {
        $args = array(
            'ID'         => $user_id,
            'user_email' => sanitize_text_field(esc_attr($_POST['billing_email']))
        );
        wp_update_user($args);
    }
}

// Update by Shobnom -> start
//function for makeing coming soon category products not purchasable
add_filter('woocommerce_is_purchasable', 'hide_add_to_cart_function', 10, 2);

function hide_add_to_cart_function($return_value, $product) {
    if (has_term('coming-soon', 'product_cat')) {
        return false;
    }

    return $return_value;
}

function CustomQuickViewButton() {
    global $product;
    echo '<a class="custom_quickview_btn button" href="' . $product->get_permalink() . '">
  Quick Shop</a>';
}

function EndCustomQuickViewButton() {
    echo '</a>';
}

add_action('airi/action/shop_loop_item_action_top', 'CustomQuickViewButton');

// Change the breadcrumb separator to dot
add_filter('woocommerce_breadcrumb_defaults', 'mukta_breadcrumb_delimiter');
function mukta_breadcrumb_delimiter($defaults) {
    $defaults['delimiter'] = '<span class="sep"></span>';
    return $defaults;
}

add_filter('woocommerce_catalog_orderby', 'mukta_customize_product_sorting');
function mukta_customize_product_sorting($sorting_options) {
    $sorting_options = array(
        'date'       => __('Sort by Date', 'woocommerce'),
        'title'      => __('Sorting Alphabetically', 'woocommerce'),
        'popularity' => __('Sort by popularity', 'woocommerce'),
        'rating'     => __('Sort by average rating', 'woocommerce'),
        'price'      => __('Sort by price: low to high', 'woocommerce'),
        'price-desc' => __('Sort by price: high to low', 'woocommerce'),
    );

    return $sorting_options;
}

add_filter('woocommerce_get_catalog_ordering_args', 'custom_catalog_ordering_args');
function custom_catalog_ordering_args($args) {
    // Sort alphabetically
    if (!isset($_GET['orderby'])) {
        $args['orderby'] = 'title';
        $args['order'] = 'asc';
    }

    //Sort by date: old to new
    if (!isset($_GET['orderby'])) {
        $args['orderby'] = 'date';
        $args['order'] = 'asc';
    }
    return $args;
}

add_filter('woocommerce_default_catalog_orderby', 'mukta_default_catalog_orderby');
function mukta_default_catalog_orderby() {
    return 'date';
}

// Replace Cart word from empty cart
remove_action( 'woocommerce_cart_is_empty', 'wc_empty_cart_message', 10 );
add_action( 'woocommerce_cart_is_empty', 'custom_empty_cart_message', 10 );

function custom_empty_cart_message() {
    $html  = '<p class="cart-empty woocommerce-info">';
    $html .= wp_kses_post( apply_filters( 'wc_empty_cart_message', __( 'Your bag is currently empty.', 'woocommerce' ) ) );
    echo $html . '</p>';
}

// Terms & Conditions toggle issue fix
function disable_wc_terms_toggle() {
	wp_add_inline_script( 'wc-checkout', "jQuery( document ).ready( function() { jQuery( document.body ).off( 'click', 'a.woocommerce-terms-and-conditions-link' ); } );" );
}

add_action( 'wp_enqueue_scripts', 'disable_wc_terms_toggle');

add_filter( 'woocommerce_cart_shipping_method_full_label', 'custom_remove_shipping_label', 9999, 2 );
function custom_remove_shipping_label( $label, $method ) {
    $new_label = preg_replace( '/^.+:/', '', $label );
    return $new_label;
}

// Mukta Logo add in Log in page
function mukta_login_logo() { ?>
<style type="text/css">
  #login h1 a, .login h1 a {
    background-image: url(<?php echo get_site_url(); ?>/wp-content/uploads/2020/07/MUKTA-logo.png);
    width: 100%;
    height: auto;
    background-repeat: no-repeat;
    padding-bottom: 30px;
    background-size: contain;
  }
</style>
<?php }
add_action( 'login_enqueue_scripts', 'mukta_login_logo' );
 // Update by Shobnom -> end

// Sarah Start
 function wpblog_wc_register_post_statuses() {
   //custom order status variable - pos-sale

  register_post_status( 'wc-pos-sale', array(
  'label' => _x( 'POS sale', 'WooCommerce Order status', 'text_domain' ),
  'public' => true,
  'exclude_from_search' => false,
  'show_in_admin_all_list' => true,
  'show_in_admin_status_list' => true,
  'label_count' => _n_noop( 'Approved (%s)', 'Approved (%s)', 'text_domain' )
  ) );
//custom order status variable - pos-cancelled
  register_post_status( 'wc-pos-cancelled', array(
    'label' => _x( 'cancelled-pos', 'WooCommerce Order status', 'text_domain' ),
    'public' => true,
    'exclude_from_search' => false,
    'show_in_admin_all_list' => true,
    'show_in_admin_status_list' => true,
    'label_count' => _n_noop( 'Approved (%s)', 'Approved (%s)', 'text_domain' )
    ) );

    //pick and packed
    register_post_status( 'wc-packed', array(
      'label' => _x( 'packed', 'WooCommerce Order status', 'text_domain' ),
      'public' => true,
      'exclude_from_search' => false,
      'show_in_admin_all_list' => true,
      'show_in_admin_status_list' => true,
      'label_count' => _n_noop( 'Approved (%s)', 'Approved (%s)', 'text_domain' )
      ) );



    //shipped
    register_post_status( 'wc-shipped', array(
      'label' => _x( 'shipped', 'WooCommerce Order status', 'text_domain' ),
      'public' => true,
      'exclude_from_search' => false,
      'show_in_admin_all_list' => true,
      'show_in_admin_status_list' => true,
      'label_count' => _n_noop( 'Approved (%s)', 'Approved (%s)', 'text_domain' )
      ) );


    //shipped
    register_post_status( 'wc-cancellationreq', array(
      'label' => _x( 'cancellationreq', 'WooCommerce Order status', 'text_domain' ),
      'public' => true,
      'exclude_from_search' => false,
      'show_in_admin_all_list' => true,
      'show_in_admin_status_list' => true,
      'label_count' => _n_noop( 'Approved (%s)', 'Approved (%s)', 'text_domain' )
      ) );


  // $reduce_stock = true;
  }
  add_filter( 'init', 'wpblog_wc_register_post_statuses' );


  function wpblog_wc_add_order_statuses( $order_statuses ){
    $order_statuses['wc-pos-sale'] = _x( 'POS sale', 'WooCommerce Order status', 'text_domain' );
    $order_statuses['wc-pos-cancelled'] = _x( 'Pos sale Cancelled', 'WooCommerce Order status', 'text_domain' );
    $order_statuses['wc-packed'] = _x( 'Packed', 'WooCommerce Order status', 'text_domain' );
    $order_statuses['wc-shipped'] = _x( 'Shipped', 'WooCommerce Order status', 'text_domain' );
    $order_statuses['wc-cancellationreq'] = _x( 'Cancellation Request', 'WooCommerce Order status', 'text_domain' );

    return $order_statuses;
    }
    add_filter( 'wc_order_statuses', 'wpblog_wc_add_order_statuses' );
  //POS-sale reduce stock level
    add_action( 'woocommerce_order_status_pos-sale', 'wc_maybe_reduce_stock_levels');
      //POS-sale increase stock level

    add_action( 'woocommerce_order_status_pos-cancelled', 'wc_maybe_increase_stock_levels');


add_filter( 'bulk_actions-edit-shop_order', 'custom_dropdown_bulk_actions_shop_order', 20, 1 );
function custom_dropdown_bulk_actions_shop_order( $actions ) {
    $actions['mark_pos-sale'] = __( 'POS sale', 'woocommerce' );
    $actions['mark_packed'] = __( 'Packed', 'woocommerce' );
    return $actions;
}

//Tracking page custom endpoint
add_action('init', function() {
	add_rewrite_endpoint('my-tracking-order',   EP_PAGES);
});
add_filter('woocommerce_my_account_my_orders_actions', function($actions, $order) {
		$actions['view-my-tracking-keys'] = [
			'url' => wc_get_endpoint_url('my-tracking-order', $order->get_id()),
			'name' => __('Show Track', 'txtdomain')
		];
	return $actions;
}, 10, 2);


add_action('woocommerce_account_my-tracking-order_endpoint', function() {
  $order =[];
	$order_id = get_query_var('my-tracking-order');
  $order =wc_get_order( $order_id );
  $current_user_id = get_current_user_id();
  $user_id = $order->user_id;

  if($current_user_id!=$user_id){
    $order =[];
    wc_print_notice( __( 'Invalid order.', 'woocommerce' ), 'error' );

  }
	wc_get_template('myaccount/my-tracking-order.php', [
		'order' => $order
	]);
});



// Order calcellation request function
add_action('wp_ajax_nopriv_sayhello', 'say_hello_function', 10, 1);
add_action('wp_ajax_sayhello', 'say_hello_function', 10, 1);
function say_hello_function(){
$order_id = $_GET['order_id'];
  $order =wc_get_order( $order_id );
  $current_user_id = get_current_user_id();
  $user_id = $order->user_id;
  $msg ="Your order cancellation request has been sent";
   $to= "shop@muktaofficial.com";

  $subject="Order cancellation request";
  $message="Order Cancellation request for #".$order_id.";


  Order cancellation Date ".date('Y/m/d h:i:sa');
  $headers="Order cancellation request";
  $attachments = [];

  if($current_user_id!=$user_id){

    $msg ="Your order cancellation is invalid";
  }
  else{
    $order->update_status('cancellationreq', 'The customer requested it to be cancelled'); // order note is optional, if you want to  add a note to order
    wp_mail( $to, $subject, $message, $headers, $attachments );

  }

  echo $msg;

exit();
}

add_action('woocommerce_order_status_changed', 'send_custom_email_notifications', 10, 4 );
function send_custom_email_notifications( $order_id, $old_status, $new_status, $order ){
    if ( $new_status == 'cancelled' || $new_status == 'failed' || $new_status == 'pos-sale' ){
        $wc_emails = WC()->mailer()->get_emails(); // Get all WC_emails objects instances
        $customer_email = $order->get_billing_email(); // The customer email
    }

    if ( $new_status == 'cancelled' ) {
        // change the recipient of this instance
        $wc_emails['WC_Email_Cancelled_Order']->recipient = $customer_email;
        // Sending the email from this instance
        $wc_emails['WC_Email_Cancelled_Order']->trigger( $order_id );
    }
    elseif ( $new_status == 'failed' ) {
        // change the recipient of this instance
        $wc_emails['WC_Email_Failed_Order']->recipient = $customer_email;
        // Sending the email from this instance
        $wc_emails['WC_Email_Failed_Order']->trigger( $order_id );
    }
    elseif ( $new_status == 'pos-sale' ) {
        // change the recipient of this instance
        $wc_emails['WC_Email_New_Order']->recipient = $customer_email;
        // Sending the email from this instance
        $wc_emails['WC_Email_New_Order']->trigger( $order_id );
        $order->set_date_paid( current_time( 'timestamp', true ) );
        $order->save();
    }

    if ( in_array( $old_status, array('on-hold', 'processing', 'completed','pos-sale') ) && 'pending' === $new_status ) {
        $order->set_date_paid(null);
        $order->update_meta_data( '_reseted_paid_date', true ); // Add a custom meta data flag
        $order->save();
    }
    // Set paid date back when the paid date has been nulled on 'processing' and 'completed' status change
    if( $order->get_meta('_reseted_paid_date' ) && in_array( $new_status, array('pending', 'on-hold') )
        && in_array( $new_status, array('processing', 'completed','pos-sale') ) )
    {
        $order->set_date_paid( current_time( 'timestamp', true ) );
        $order->delete_meta_data( '_reseted_paid_date' ); // Remove the custom meta data flag

        $order->save();
    }
}

//Sarah End

/**
 * Default payment gateway set to sslcommerz
 * Added by Tanzim
 * Dec 17,2020
 */
add_action( 'template_redirect', 'define_default_payment_gateway' );
function define_default_payment_gateway(){
    if( is_checkout() && ! is_wc_endpoint_url() ) {
        $default_payment_id = 'sslcommerz';
        WC()->session->set( 'chosen_payment_method', $default_payment_id );
    }
}

//Added By Sarah for adding short description on line item
function get_product_short_description( $response, $object, $request ) {

    if( empty( $response->data ) )
        return $response;


    $pa_color = "";
    $pa_size = "";

    foreach($response->data['line_items'] as $key => $productItems){
        $productID = $productItems['product_id'];
            $variation = new WC_Product( $productID );
            $image = $variation->get_short_description();
            $name = $variation->get_name();
            $iterate = $productItems['meta_data'];

            foreach($iterate as $key1 => $metaItem){

                if(($metaItem->key==="pa_colour")){
                    $pa_color =$metaItem->value;
                }

                if(($metaItem->key==="pa_size")){
                    $pa_size =$metaItem->value ;
                }
            }

           $response->data['line_items'][$key]['short_description'] = $image;
           $response->data['line_items'][$key]['name'] = $name;
           $response->data['line_items'][$key]['color'] = ucfirst($pa_color) ;
           $response->data['line_items'][$key]['size'] = ucfirst($pa_size);


    }

    return $response;
}

add_filter( "woocommerce_rest_prepare_shop_order_object", "get_product_short_description", 10, 3 );


// Facebook configuration in head tag
function custom_facebook_pixel() { ?>
  <meta name="facebook-domain-verification" content="ipo8nswtuly761oturxuon30bagedz" />

  <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1286579171724475');
    fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=1286579171724475&ev=PageView&noscript=1"
  /></noscript>
<?php }
add_action( 'wp_head', 'custom_facebook_pixel' );

// CMS Logo setup_postdata
function wpb_custom_logo() {
	$upload_dir = wp_upload_dir();
  echo '<style type="text/css">
  		#adminmenuwrap:before {
      	content: "";
        background-image: url("'.$upload_dir['baseurl'].'/2020/07/MUKTA-logo.png");
        display: block;
        width: 100%;
        height: 45px;
        background-color: white;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
      }
      table.wp-list-table td.column-thumb img {
        width: 100%;
        height: auto;
        max-height: initial;
      }
  	</style>';
}
add_action('admin_head', 'wpb_custom_logo');

/* Sale Discount Feature */
// Generating dynamically the product "regular price"
add_filter( 'woocommerce_product_get_regular_price', 'mukta_custom_dynamic_regular_price', 10, 2 );
add_filter( 'woocommerce_product_variation_get_regular_price', 'mukta_custom_dynamic_regular_price', 10, 2 );
function mukta_custom_dynamic_regular_price( $regular_price, $product ) {
    if( ( empty($regular_price) || $regular_price == 0 ) )
        return $product->get_price();
    else
        return $regular_price;
}


// Generating dynamically the product "sale price"
// add_filter( 'woocommerce_product_get_sale_price', 'mukta_custom_dynamic_sale_price', 10, 2 );
// add_filter( 'woocommerce_product_variation_get_sale_price', 'mukta_custom_dynamic_sale_price', 10, 2 );
// function mukta_custom_dynamic_sale_price( $sale_price, $product ) {
//     $rate = 0.85;
//
//     if( ( empty($sale_price) || $sale_price === 0 ) ){
//       return $product->get_regular_price() * $rate;
//     }
//     else {
//       return $sale_price;
//     }
// };

// Displayed formatted regular price + sale price
add_filter( 'woocommerce_get_price_html', 'mukta_custom_dynamic_sale_price_html', 20, 2 );
function mukta_custom_dynamic_sale_price_html( $price_html, $product ) {

    if ( '' === $product->get_price() || 0 == $product->get_price() ) {
        $price_html = '<span class="no_price">Price Not Available</span>';
    }
    else {
      // $price_html = wc_format_sale_price( wc_get_price_to_display( $product, array( 'price' => $product->get_regular_price() ) ), wc_get_price_to_display(  $product, array( 'price' => $product->get_sale_price() ) ) ) . $product->get_price_suffix();
      $price_html .= '<span class="vat"> + VAT</span>';
    }
    return $price_html;
}

// add_action( 'woocommerce_before_calculate_totals', 'mukta_custom_alter_price_cart', 9999 );
// function mukta_custom_alter_price_cart( $cart ) {
//   if (!empty(WC()->cart->get_applied_coupons())) {
//     // Apply coupon with regular price
//     foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
//       $product = $cart_item['data'];
//       $price = $product->get_price();
//       $cart_item['data']->set_price( $price);
//     }
//   }
//   elseif (empty(WC()->cart->get_applied_coupons())) {
//     // Apply Discount on regular price
//     foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
//       $product = $cart_item['data'];
//       $price = $product->get_price();
//       $cart_item['data']->set_price( $price * 0.85 );
//     }
//   }
// }

/** Show sale prices in the cart. */
function mukta_custom_show_sale_price_at_cart( $old_display, $cart_item, $cart_item_key ) {
	$product = $cart_item['data'];
	if ( $product ) {
		return $product->get_price_html();
	}
	return $old_display;
}
add_filter( 'woocommerce_cart_item_price', 'mukta_custom_show_sale_price_at_cart', 10, 3 );
