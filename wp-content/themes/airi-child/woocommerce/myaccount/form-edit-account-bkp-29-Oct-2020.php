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
</style>

<?php
defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_edit_account_form' );
$user = wp_get_current_user(); ?>

<div class="login_wrap">
  <div class='text-center login_infor_wrap'>
     <p class="curved_bottom login_infor">Profile Detals</p>
  </div>
  <?php
    $user = wp_get_current_user();
    echo '<p class="user_welcome_text">
        Welcome '.$user->user_login.'!
    </p>';
  ?>
  <p class="req_field_text"><span>*</span> Required Field</p>
  <form class="woocommerce-EditAccountForm edit-account login_edit_form" action="/mukta_v1/my-account/edit-account/" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >

	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

  <p class="form-row form-row-wide">
    <select name="title" id="title" />
        <option disabled value> -- Select an option -- </option>
        <option value="Ms" <?php if (get_the_author_meta( 'title', $user->ID ) == "Ms") echo 'selected="selected" '; ?>>Ms</option>
        <option value="Mr" <?php if (get_the_author_meta( 'title', $user->ID ) == "Mr") echo 'selected="selected" '; ?>>Mr</option>
        <option value="Mrs" <?php if (get_the_author_meta( 'title', $user->ID ) == "Mrs") echo 'selected="selected" '; ?>>Mrs</option>
    </select>
  </p>
	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
		<label for="account_first_name"><?php esc_html_e( 'First name', 'woocommerce' ); ?> *</label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr( $user->first_name ); ?>" />
	</p>
	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
		<label for="account_last_name"><?php esc_html_e( 'Last name', 'woocommerce' ); ?> *</label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>" />
	</p>
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
