<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
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
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>


 <?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>


	<div class="col-md-6 col-sm-12 block-left">
		<div class="row">

			<div class="col-md-2 col-lg-2 hidden-md hidden-sm hidden-xs shop-big-menu-btn">
				<img src="<?php echo get_template_directory_uri();?>/img/shop/shop-big-menu-btn.png" alt="">
			</div>

			<!-- <div class="col-md-11 shop-single-imgs"> -->
			<div class="col-md-10 col-sm-12">
				<div class="row shop-single-imgs">
					
					<div class="single-main-img">
						<?php the_post_thumbnail('full',array('class'=>'img-responsive'));?>
					</div>

					<div class="thumbs">
					<?php
					global $product;
					 $attachment_ids = $product->get_gallery_attachment_ids();
					 if($attachment_ids): ?>

						<?php foreach( $attachment_ids as $attachment_id ):?>
						<?php $image_link = wp_get_attachment_url( $attachment_id );?>
							<div><img src="<?php echo $image_link;?>" data-img="<?php echo $image_link;?>" alt=""></div>
						<?php endforeach;?>

					<?php endif;?>
					</div>


				</div>
			</div>

		</div>		
	</div>

	<div class="col-md-6 col-sm-12 block-right">

			<div class="dop-info hidden-xs hidden-sm">
				<a href="#">info</a>
				<a href="#">share</a>
			</div>
			<div class="wrap-cat-cart">	
				<div class="cat-and-title">
					<h3>handbags</h3>
					<h2><?php the_title();?></h2>
				</div>
				<div class="wrap-price-cart">
					<!-- <p>$ 3,300</p> -->
					<p><?php echo wc_price($product->get_price());?></p>
					<!-- <p>$ <?php //echo get_woocommerce_price_format();?></p> -->
					<!-- <a href="cart.html">add to cart</a> -->
					<?php woocommerce_template_loop_add_to_cart(); ?>
				</div>
			</div>
			<div class="dop-info hidden-lg hidden-md">
				<a href="#">info</a>
				<a href="#">share</a>
			</div>
	
	</div>


<?php endwhile; // end of the loop. ?>
<?php  else:?>
	<h3 class="error">not found</h3>
<?php endif; ?>


<?php get_footer( 'shop' ); ?>




