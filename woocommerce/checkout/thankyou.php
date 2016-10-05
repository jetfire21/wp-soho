<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $order ) : ?>
<!-- echo "thankyou.php "; -->

	<?php if ( $order->has_status( 'failed' ) ) : ?>

		<p class="woocommerce-thankyou-order-failed"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

		<p class="woocommerce-thankyou-order-failed-actions">
			<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'woocommerce' ) ?></a>
			<?php if ( is_user_logged_in() ) : ?>
				<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My Account', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</p>

	<?php else : ?>

	<h2>Congrants! Your Order has been Accepted</h2>

	<?php endif; ?>

	<?php //do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
	<?php // do_action( 'woocommerce_thankyou', $order->id ); ?>

<?php else : ?>

	<!-- <p class="woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></p> -->


<div class="col-lg-1 hidden-md hidden-sm hidden-xs shop-big-menu-btn">
	<img src="http://wp-soho/wp-content/themes/fernanda/img/shop/shop-big-menu-btn.png" alt="">
</div>

<div class="col-lg-10 col-md-12 shop-wrap-padding">
	<div class="wrap-circle-check"><div class="circle-check">
	<!-- <i class="demo-icon icon-ok">&#xe801;</i> -->
	<img src="<?php  echo get_template_directory_uri();?>/img/shop/check.png" alt="">
	</div></div>
	<h2 class="checkout-receive">Congrants! Your Order has been Accepted</h2>
</div>
<div class="clearfix"></div>


<?php endif; ?>
