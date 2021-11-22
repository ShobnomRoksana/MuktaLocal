<?php
/**
 * My Account page
 */

defined( 'ABSPATH' ) || exit;
?>

<style>
  /* Style tab links */
  .tablink {
    background-color: white;
    color: #fed2c7;
    letter-spacing: 1.2px;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 10px 20px;
    line-height: 20px;
    font-size: 14px;
    width: 20%;
    border: 1px solid #fed2c7;
    transition: all 0.4s ease;
    text-align: center;
  }

  .tablink:hover {
    background-color: rgb(255 219 210);
    color: white;
  }
  .tablink.active {
    background-color: #fed2c7;
    color: white;
  }

  /* Style the tab content (and add height:100% for full page content) */
  .tabcontent {
    color: black;
    display: none;
    padding: 25px;
    height: 100%;
    border: 1px solid #fed2c7;
    background-color: white;
  }
  .tabbtnwrap {
    height: 70px;
  }

  /* Wishlist Content */
  .profile_wishlist_wrap {
      width: 100%;
      margin: auto;
  }
  .profile_wl_title {
    font-style: italic;
    font-size: 35px;
    line-height: 1.2;
    margin: 0;
    font-weight: 600;
  }
  .profile_wishlist_wrap .cwl_product_col {
    width: 25%;
  }
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
  .shipping_form .select, .billing_form .select {
    background-image: none;
    cursor: pointer;
  }
  .shipping_form .shipping_select .woocommerce-input-wrapper,
  .billing_form .billing_select .woocommerce-input-wrapper {
    position: relative;
  }
  .shipping_form .shipping_select .woocommerce-input-wrapper::after,
  .billing_form .billing_select .woocommerce-input-wrapper::after {
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

  @media (min-width: 992px) {
    .shipping_col {
      padding-right: 10px;
    }
    .billing_col {
      padding-left: 10px;
    }
  }
@media screen and (max-width: 991px) and (min-width: 768px) {
  .tablink {
      padding: 8px 10px;
      line-height: 15px;
      font-size: 12px;
  }
}
@media screen and (max-width: 767px) {
  .tablink {
    padding: 8px 1px;
    line-height: 14px;
    font-size: 12px;
    letter-spacing: 0px;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 22%;
  }
  .mbl-resize {
    width: 12%;
  }
}
</style>

<?php
  echo '<div class="woocommerce-notices-wrapper">';
  wc_print_notices();
  echo '</div>';
?>

<div class="tabbtnwrap">
  <button class="tablink active" onclick="openPage('Profile', this)" id="defaultOpen">MY PROFILE</button>
  <button class="tablink" onclick="openPage('Orders', this)">MY ORDERS</button>
  <button class="tablink" onclick="openPage('Address', this)">MY ADDRESSES</button>
  <button class="tablink" onclick="openPage('Wishlist', this)">MY WISHLIST</button>
  <a class="tablink mbl-resize" href="<?php echo esc_url( wc_get_account_endpoint_url( 'customer-logout' ) ); ?>">LOG OUT</a>
</div>

<div class="tabcontentwrap">
  <div id="Profile" class="tabcontent">
    <!-- Shobnom: 23-10-2020 start -->
    <?php wc_get_template( 'myaccount/form-edit-account.php'); ?>
    <!-- Shobnom: 23-10-2020 end -->
  </div>
</div>
<div class="tabcontentwrap">
  <div id="Orders" class="tabcontent">
    <div class="row profile_wishlist_wrap">
      <div class="col-md-4">
        <img class="img-fluid" src="/mukta/wp-content/uploads/2020/10/my-orders.png" />
      </div>
      <div class="col-md-8">
        <!-- Update by Shobnom on 1/11 start -->
        <h3 class="profile_wl_title">My Order</h3>
        <p style="font-weight: 500;">Follow your purchases, check the delivery status of your orders, access the exchange information.</p>

        <?php
          wc_get_template( 'myaccount/my-orders.php');
        ?>
        <!-- Update by Shobnom on 1/11 end -->
      </div>
    </div>

  </div>
</div>
<div class="tabcontentwrap">
  <div id="Address" class="tabcontent">
    <div class="row text-center profile_address_wrap">
      <div class="col-md-12 profile_address_title_wrap">
        <h3 class="profile_wl_title">My Addresses</h3>
        <p>Safely store your address details to complete the order process quickly.</p>
        <p>Save your preferred address as default and you will no longer have to enter details for every order.</p>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <?php wc_get_template( 'myaccount/form-edit-address.php'); ?>
      </div>
      <div class="col-md-1"></div>
    </div>
  </div>
</div>
<div class="tabcontentwrap">
  <div id="Wishlist" class="tabcontent">
    <?php
    echo '<div class="row text-center profile_wishlist_wrap">
            <div class="col-md-12">
              <h3 class="profile_wl_title">My Wishlist</h3>
              <p style="font-weight: 500;">Create your whishlist: save up to 50 items and add them to your shopping bag as they become available.</p>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-10">'
              .do_shortcode('[yith_wcwl_wishlist]').'
            </div>
            <div class="col-md-1"></div>
      </div>';
    ?>
  </div>
</div>

<script>
  function openPage(pageName,elmnt,color) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    document.getElementById(pageName).style.display = "block";
    var btns = document.getElementsByClassName("tablink");
    for (var i = 0; i < btns.length; i++) {
      btns[i].addEventListener("click", function() {
      var current = document.getElementsByClassName("active");
      current[0].className = current[0].className.replace(" active", "");
      this.className += " active";
      });
    }
  }

  // Get the element with id="defaultOpen" and click on it
  document.getElementById("defaultOpen").click();

  if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
  }
</script>
