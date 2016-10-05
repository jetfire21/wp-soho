<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.1.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/** @global WC_Checkout $checkout */

?>

<div class="col-md-8 woocommerce-billing-fields">


	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>


	<?php foreach ( $checkout->checkout_fields['billing'] as $key => $field ) : ?>

		<?php 
		// if($key == "billing_first_name" or $key == "billing_last_name"  or $key == "billing_phone"  or $key == "billing_email") {
		// 	$wrap_class = "name-phone-email";
		// 	$col = "col-md-6 ";
		// }
		// elseif($key == "billing_address_1"){
		// 	$wrap_class = "country-city-zip"; $col = "col-md-5 ";
		// } 
		// elseif($key == "billing_address_2"){
		// 	$wrap_class = "country-city-zip"; $col = "col-md-3 ";
		// } 
		// elseif($key == "billing_postcode"){
		// 	$wrap_class = "country-city-zip"; $col = "col-md-1 ";
		// } 
		// else{ $wrap_class = "country-city-zip"; $col = "col-md-4 ";}

		// if($key == "billing_state") { $wrap_class = "country-city-zip billing_house_number_field"; $col = "col-md-4 ";}

		?>

<!-- 	<div class="<?php echo $col.$wrap_class;?>">
		<div class="row"> -->

		<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

<!-- 	</div>
	</div> -->
	<?php if($key == "billing_postcode"):?>
		<div class="clearfix"></div>
	<?php endif;?>

	<?php endforeach; ?>
	<div class="clearfix"></div>


	<?php do_action('woocommerce_after_checkout_billing_form', $checkout ); ?>

	<?php if ( ! is_user_logged_in() && $checkout->enable_signup ) : ?>

		<?php if ( $checkout->enable_guest_checkout ) : ?>

			<p class="form-row form-row-wide create-account">
				<input class="input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true) ?> type="checkbox" name="createaccount" value="1" /> <label for="createaccount" class="checkbox"><?php _e( 'Create an account?', 'woocommerce' ); ?></label>
			</p>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( ! empty( $checkout->checkout_fields['account'] ) ) : ?>

			<div class="create-account">

				<!-- <p><?php //_e( 'Create an account by entering the information below. If you are a returning customer please login at the top of the page.', 'woocommerce' ); ?></p> -->

				<?php foreach ( $checkout->checkout_fields['account'] as $key => $field ) : ?>

					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

				<?php endforeach; ?>

				<div class="clear"></div>

			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>

	<?php endif; ?>
</div>