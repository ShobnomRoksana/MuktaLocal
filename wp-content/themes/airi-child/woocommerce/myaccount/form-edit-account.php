<style>
  /* Profile Tab Section */
  .login_wrap {
    padding: 35px 30px;
    border: 1px solid grey;
    outline: 3px solid #fed2c7;
  }
  .login_infor_wrap {
    height: 50px;
    width: 200px;
  }
  .curved_bottom {
    border-radius: 0px 0px 15px 0px;
  }
  .login_infor {
    display: block;
    position: relative;
    text-transform: uppercase;
    font-weight: 500;
    font-size: 13px;
    line-height: 1.2;
    background-color: #000000;
    border: 5px solid #fed2c7;
    padding: 12px 8px;
    color: white;
  }
  .user_welcome_text, .newsletter_text, .terms_text {
    color: black;
    font-family: "Raleway", sans-serif;
    font-weight: 700;
    text-transform: capitalize;
    font-size: 16px;
    line-height: 1.2;
    letter-spacing: 1px;
    margin: 15px 0;
  }
  .login_edit_form label {
    display: block;
    margin-bottom: 0;
    color: black;
    font-family: "Raleway", sans-serif;
    font-weight: 600;
    font-size: 16px;
    line-height: 1.2;
  }
  .display_field {
    display: none;
  }
  input[type="date"] {
    position: relative;
  }

  input[type="date"]::-webkit-calendar-picker-indicator {
    color: transparent;
    background: none;
    z-index: 1;
  }

  input[type="date"]:before {
    background: none;
    display: block;
    font-family: 'FontAwesome';
    content: '\f073';
    width: 27px;
    padding: 0 5px;
    position: absolute;
    top: 0;
    bottom: 0;
    right: 5px;
    font-size: 18px;
    line-height: 36px;
    color: #4D4D4D;
  }
  fieldset {
      margin-bottom: 15px;
  }
  /* Update by Shobnom on 1/11 start */
  .woocommerce-edit-account .in_edit_address {
  	display: block;
  }
  .in_edit_address {
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
  .billing_title_wrap {
    position: relative;
  }
  .billing_title {
    background-image: none;
    cursor: pointer;
  }
  .billing_title_wrap .woocommerce-input-wrapper::after {
  	content: "\f078";
  	font-family: FontAwesome;
  	position: absolute;
  	color: #fff;
  	right: 10px;
    top: 50%;
    transform: translateY(-50%);
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
  /* Update by Shobnom on 1/11 end */
</style>

<?php
defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_edit_account_form' );
$user = wp_get_current_user(); ?>

<div class="in_edit_address">
  <div class='text-center back_to_button-wrap sign_in_button-wrap'>
    <p>Back to Profile ></p>
    <a href='/my-account/' class='curved-top'>My Account</a>
  </div>
</div>

<div class="login_wrap">
  <div class='text-center login_infor_wrap'>
     <p class="curved_bottom login_infor">Profile Detals</p>
  </div>
  <?php
    // $user = wp_get_current_user();
    // $user->user_login
    $user_id = get_current_user_id();
    $last_name = get_user_meta( $user_id, 'billing_last_name', true );

    echo '<p class="user_welcome_text">
        Welcome '.$last_name.'!
    </p>';
  ?>
  <p class="req_field_text"><span>*</span> Required Field</p>
  <form class="woocommerce-EditAccountForm edit-account login_edit_form" action="/mukta/my-account/edit-account/" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >

	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

  <!-- Update by Shobnom on 1/11 start -->
  <p class="form-row form-row-wide billing_title_wrap">
    <span class="woocommerce-input-wrapper">
      <select name="billing_title" id="billing_title" class="billing_title">
          <option disabled value> -- Select an option -- </option>
          <option value="Ms" <?php if (get_the_author_meta( 'billing_title', $user->ID ) == "Ms") echo 'selected="selected" '; ?>>Ms</option>
          <option value="Mr" <?php if (get_the_author_meta( 'billing_title', $user->ID ) == "Mr") echo 'selected="selected" '; ?>>Mr</option>
          <option value="Mrs" <?php if (get_the_author_meta( 'billing_title', $user->ID ) == "Mrs") echo 'selected="selected" '; ?>>Mrs</option>
      </select>
  </span>
  </p>
	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
		<label for="account_first_name"><?php esc_html_e( 'First name', 'woocommerce' ); ?> *</label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" autocomplete="first-name" value="<?php echo esc_attr( $user->billing_first_name ); ?>" />
	</p>
	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
		<label for="account_last_name"><?php esc_html_e( 'Last name', 'woocommerce' ); ?> *</label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" autocomplete="last-name" value="<?php echo esc_attr( $user->billing_last_name ); ?>" />
	</p>
  <!-- Update by Shobnom on 1/11 end -->
	<div class="clear"></div>

	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide display_field">
		<label for="account_display_name"><?php esc_html_e( 'Display name', 'woocommerce' ); ?> *</label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_display_name" id="account_display_name" value="<?php echo esc_attr( $user->display_name ); ?>" /> <span><em><?php esc_html_e( 'This will be how your name will be displayed in the account section and in reviews', 'woocommerce' ); ?></em></span>
	</p>
	<div class="clear"></div>

	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
		<label for="account_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?> *</label>
		<input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" />
	</p>

	<fieldset>
		<legend><?php esc_html_e( 'Password change', 'woocommerce' ); ?></legend>

		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="password_current"><?php esc_html_e( 'Current password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" autocomplete="off" />
		</p>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="password_1"><?php esc_html_e( 'New password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" autocomplete="off" />
		</p>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="password_2"><?php esc_html_e( 'Confirm new password', 'woocommerce' ); ?></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" autocomplete="off" />
		</p>
	</fieldset>
	<div class="clear"></div>

	<?php do_action( 'woocommerce_edit_account_form' ); ?>

	<p>
		<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
		<button type="submit" class="woocommerce-Button button save_btn" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Save', 'woocommerce' ); ?></button>
		<input type="hidden" name="action" value="save_account_details" />
	</p>

	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
</form>
</div>
<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
