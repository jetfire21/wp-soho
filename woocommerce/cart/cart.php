<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
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
 * @version 2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
// get_header( 'shop' );
?>



<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">


<?php //do_action( 'woocommerce_before_cart_table' ); ?>

		<?php //do_action( 'woocommerce_before_cart_contents' ); ?>


   <div class="col-lg-1 hidden-md hidden-sm hidden-xs shop-big-menu-btn">
        <img src="<?php echo get_template_directory_uri();?>/img/shop/shop-big-menu-btn.png" alt="">
    </div>

    <div class="col-lg-10 col-md-12  wrap_cart">

    <?php do_action( 'woocommerce_before_cart' ); ?>


    <?php wc_print_notices(); ?>


		<div class="table-responsive table-desctop hidden-xs hidden-sm">
		  <table class="table shop_table cart">
		    <tr>
		    	<th>item</th>
		    	<th> </th>
		    	<th>price</th>
		    	<th>quantity</th>
		    	<th>total price</th>
		    </tr>
<?php //print_r(WC()->cart->get_cart() ); ?>

		<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			// print_r($cart_item);
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>



				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

					<td class="cart-img product-thumbnail">
						<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

							if ( ! $product_permalink ) {
								echo $thumbnail;
							} else {
								printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
							}
						?>
					</td>

					<td class="prod_title product-name" data-title="<?php _e( 'Product', 'woocommerce' ); ?>">
					<h2>
						<?php
							if ( ! $product_permalink ) {
								echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
							} else {
								echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_title() ), $cart_item, $cart_item_key );
							}

							// Meta data
							echo WC()->cart->get_item_data( $cart_item );

							// Backorder notification
							if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
								echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';
							}
						?>
					</h2>
					</td>

					<td class="price product-price" data-title="<?php _e( 'Price', 'woocommerce' ); ?>">
					<span>
						<?php
							$price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							echo $price = str_replace(",", " , ", $price);
						?>

						</span>
					</td>

					<td class="" data-title="<?php _e( 'Quantity', 'woocommerce' ); ?>">
				    		<div class="wrap_quantity" data-id="<?php echo $cart_item['product_id'];?>">
				    			<div class="minus">-</div>

						<?php
							if ( $_product->is_sold_individually() ) {
								$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
							} else {
								$product_quantity = woocommerce_quantity_input( array(
									'input_name'  => "cart[{$cart_item_key}][qty]",
									'input_value' => $cart_item['quantity'],
									'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
									'min_value'   => '0'
								), $_product, false );
							}

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
						?>
							<div class="plus">+</div>
						</div>
					</td>

					<td class="price" data-title="<?php _e( 'Total', 'woocommerce' ); ?>">
					<span>
						<?php
							$price = apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
							echo $price = str_replace(",", " , ", $price);
						?>
						</span>
						<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
								'<a href="%s" class="remove-prod" title="%s" data-product_id="%s" data-product_sku="%s"><img class="del-product" src="'.get_template_directory_uri().'/img/shop/close_icon.png" alt=""></a>',
								esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
								__( 'Remove this item', 'woocommerce' ),
								esc_attr( $product_id ),
								esc_attr( $_product->get_sku() )
							), $cart_item_key );
						?>
					</td>
				</tr>

				<?php
			}
			$sum = $sum + $cart_item['line_total'];
		}
		?>
						  </table>
				<input type="submit" class="upd_cart button hidden-xs hidden-sm" name="update_cart_alex" value="<?php esc_attr_e( 'Update Cart', 'woocommerce' ); ?>" />

		</div>


		<div class=" table-mobile hidden-lg hidden-md shop_table cart">
		  <table class="table">

		<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>



				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

		    		<td class="first-td">item</td>


					<td class="cart-img product-thumbnail">
						<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

							if ( ! $product_permalink ) {
								echo $thumbnail;
							} else {
								printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
							}
						?>
	

					</td>
					</tr><tr>
		    		<td class="first-td"> </td>

					<td class="prod_title product-name" data-title="<?php _e( 'Product', 'woocommerce' ); ?>">
					<h2>
						<?php
							if ( ! $product_permalink ) {
								echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
							} else {
								echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_title() ), $cart_item, $cart_item_key );
							}

							// Meta data
							echo WC()->cart->get_item_data( $cart_item );

							// Backorder notification
							if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
								echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';
							}
						?>
					</h2>
					</td>

					</tr><tr>
		    		<td class="first-td">price</td>
					<td class="price product-price" data-title="<?php _e( 'Price', 'woocommerce' ); ?>">
					<span>
						<?php
							$price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							echo $price = str_replace(",", " , ", $price);
						?>

						</span>
					</td>
					</tr><tr>

				    	<td class="first-td">quantity</td>
					<td class="" data-title="<?php _e( 'Quantity', 'woocommerce' ); ?>">
				    		<div class="wrap_quantity">
				    			<div class="minus">-</div>

						<?php
							if ( $_product->is_sold_individually() ) {
								$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
							} else {
								$product_quantity = woocommerce_quantity_input( array(
									'input_name'  => "cart[{$cart_item_key}][qty]",
									'input_value' => $cart_item['quantity'],
									'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
									'min_value'   => '0'
								), $_product, false );
							}

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
						?>
							<div class="plus">+</div>
						</div>
					</td>
					</tr><tr>
					
		    	<td class="first-td">total price</td>

					<td class="price" data-title="<?php _e( 'Total', 'woocommerce' ); ?>">
					<span>
						<?php
							$price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							echo $price = str_replace(",", " , ", $price);
						?>
						</span>
						<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
								'<a href="%s" class="remove-prod" title="%s" data-product_id="%s" data-product_sku="%s"><img class="del-product" src="'.get_template_directory_uri().'/img/shop/close_icon.png" alt=""></a>',
								esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
								__( 'Remove this item', 'woocommerce' ),
								esc_attr( $product_id ),
								esc_attr( $_product->get_sku() )
							), $cart_item_key );
						?>
					</td>
				</tr>

				<?php
			}
		}
		?>


	  </table>

	  				<input type="submit" class="upd_cart button hidden-xs hidden-sm" name="update_cart" value="<?php esc_attr_e( 'Update Cart', 'woocommerce' ); ?>" />

		</div>

	  						<div class="clearfix"></div>


		<div class="str-total-sum">total: <?php $total = WC()->cart->get_cart_total(); echo $total = str_replace(",", " , ", $total);?></div>
		<div class="clearfix"></div>
		<div class="str-cart-action"> <a href="/shop">continue shopping</a> <a class="proc-checkout" href="/checkout">procecced to checkout</a></div>

	</div>


				<?php 	//	do_action( 'woocommerce_cart_contents' );?>
				<?php do_action( 'woocommerce_cart_actions' ); ?>

				<?php wp_nonce_field( 'woocommerce-cart' ); ?>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>

<?php //do_action( 'woocommerce_after_cart_table' ); ?>

<?php do_action( 'woocommerce_after_cart' ); ?>

</form>

<div class="cart-collaterals">

	<?php do_action( 'woocommerce_cart_collaterals' ); ?>

</div>

<?php do_action( 'woocommerce_after_cart' ); ?>

<?php  $cart = WC()->cart->get_cart(); print_r($cart);
echo "============================================<hr>";
 $id = 177;
  
    // foreach ($cart as $cart_item_key => $cart_item) {
    // 	if($cart_item['product_id'] == 177){
    // 		$product = $cart_item['data'];
    // 		echo $price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $product ), $cart_item, 177 );
    // 	}

    // }

echo wc_price(2200);
echo "============================================<hr>";

// $a = WC()->cart->get_cart_item_quantities();

// $a = WC()->cart->get_product_price( $_product );
// print_r($a);
echo "--------------product-------";
print_r($_product);


$qty = 2;
$c_k = "cart[9766527f2b5d3e95d4a733fcfb77bd7e][qty]------";
    preg_match("#\[[0-9a-zA-Z]*\]#i", $c_k, $matches);
    $c_k = substr($matches[0], 0, -1);
    $c_k = substr($c_k, 1);
  
echo "--".$c_k;
print_r($matches);

echo "-------------cccc------";
// echo $ccc = WC()->cart->set_quantity($c_k, $qty,true);
     // global $woocommerce;
     // ob_start();
     // $woocommerce->cart->set_quantity($c_k,$qty); 
     // ob_get_clean();