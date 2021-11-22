<style>
.user_reg_title_wrap {
	position: relative;
}
.custom_user_reg_wrap select, .custom_user_reg_wrap .form-row .input-text {
		border-width: 2px;
    border-color: #fed2c7;
    padding: 0px 15px;
    height: 40px;
    color: #4D4D4D;
    font-family: "Raleway", sans-serif;
    font-weight: 600;
    font-size: 16px;
	  background-image: none;
}
.user_reg_title::after {
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
.round, .newsletter_round {
	display: inline-flex !important;
	justify-content: flex-end;
	align-items: center;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
.newsletter_round {
	padding-left: 0;
}

/* Hide the browser's default checkbox */
.round input, .newsletter_round input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
	position: relative;
	height: 30px;
	width: 30px;
	margin-right: 5px;
	background-color: #eee;
	border-radius: 15px;
}
.newsletter_round .checkmark {
	position: absolute;
	top: 0;
	right: 10%;
}
.newsletter-label {
	margin-right: 15%;
	font-size: smaller;
	display: block;
}

/* On mouse-over, add a grey background color */
.round:hover input ~ .checkmark, .newsletter_round:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.round input:checked ~ .checkmark, .newsletter_round input:checked ~ .checkmark {
  background-color: #000000;
}

/* Show the checkmark when checked */
.round input:checked ~ .checkmark:after, .newsletter_round input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.round .checkmark:after, .newsletter_round .checkmark:after {
	color: white;
	content: "x";
	position: absolute;
	display: none;
	top: 0px;
	left: 0px;
	text-align: center;
	height: 100%;
	width: 100%;
	font-size: 24px;
	line-height: 31px;
	font-weight: 600;
}
.newsletter_round .checkmark:after {
	left: 0px;
	font-size: 34px;
	line-height: 25px;
	font-weight: 400;
}
@media (max-width: 991px) {
	.col2-set .col-2, .col2-set .col-1 {
	    width: 100%;
	}
	.col2-set .col-1 {
		margin-bottom: 35px;
	}
}

@media (min-width: 1400px) {
	#customer_login .input-text {
			padding: 0 15px;
			height: 40px;
			line-height: 68px;
	}
}
@media (max-width: 600px) {
	.newsletter_round .checkmark {
	    right: 0;
	}
}

</style>

<?php
/**
 * Login Form
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

<div class="u-columns col2-set" id="customer_login">

	<div class="u-column1 col-1">

<?php endif; ?>

		<h2><?php esc_html_e( 'Login', 'woocommerce' ); ?></h2>

		<form class="woocommerce-form woocommerce-form-login login" method="post">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<div class='text-center sign_in_button-wrap user-signin-wrap'>
			  <div class='curved-top' target='_blank'>Sign in</div>
			</div>
			<p class="req-field text-right">Required Field *</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="Email *" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" placeholder="Password *" name="password" id="password" autocomplete="current-password" />
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-row text-right">
				<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Submit', 'woocommerce' ); ?></button>
			</p>
			<div class="woocommerce-LostPassword lost_password text-right">
				<p class="forget-text">Forgotten your password?</p>
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'CLICK HERE', 'woocommerce' ); ?></a>
			</div>
			<p class="form-row text-right remembermewrap">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme round">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
					<span class="checkmark"></span>Remember me
				</label>
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
			</p>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

	</div>

	<div class="u-column2 col-2">

		<h2><?php esc_html_e( 'Register', 'woocommerce' ); ?></h2>

		<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</p>

			<?php endif; ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="Email *" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
				<!-- Update by Shobnom on 1/11 start -->
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" placeholder="Password * (must contain letters and numbers)" id="reg_password" autocomplete="new-password" />
				</p>
				<!-- Update by Shobnom on 1/11 end -->
			<?php else : ?>

				<p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>

			<?php endif; ?>

			<?php do_action( 'woocommerce_register_form' ); ?>

			<p class="woocommerce-form-row form-row">
				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
				<button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Submit', 'woocommerce' ); ?></button>
			</p>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>

	</div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
