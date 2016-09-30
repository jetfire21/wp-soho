<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

<!-- <h1> archive-product.php for shop main and all pages</h1> -->

<?php if( is_shop() ):?>

	<div class="col-lg-1 hidden-md hidden-sm hidden-xs shop-big-menu-btn">
		<img src="<?php echo get_template_directory_uri();?>/img/shop/shop-big-menu-btn.png" alt="">
	</div>

	<div class="col-lg-11 col-md-12">
		<div class="row">

		<div id="owl-shop-slider" class="owl-carousel owl-theme">

			<div class="item">		
				 <div class="grayscale">
					 <img class="img-responsive" src="<?php echo get_template_directory_uri();?>/img/shop/shop-slider1.jpg" alt="">	
				</div>	
				<div class="col-xs-12 slider-text text-right">
					 <h2>Fer favorite</h2>
					 <a href="#">out now</a>
				</div>
			</div>

			<div class="item">			
				 <div class="grayscale">
					 <img class="img-responsive" src="<?php echo get_template_directory_uri();?>/img/slide1.jpg" alt="">	
				  </div>	
				<div class="col-xs-12 slider-text text-right">
					 <h2>Fer favorite add text</h2>
					 <a href="#">out now add text</a>
				</div>
			</div>
			<div class="item">		
				 <div class="grayscale">
					 <img class="img-responsive" src="<?php echo get_template_directory_uri();?>/img/shop/shop-slider1.jpg" alt="">	
				</div>	
				<div class="col-xs-12 slider-text text-right">
					 <h2>Fer favorite</h2>
					 <a href="#">out now</a>
				</div>
			</div>

			<div class="item">			
				 <div class="grayscale">
					 <img class="img-responsive" src="<?php echo get_template_directory_uri();?>/img/slide1.jpg" alt="">	
				  </div>	
				<div class="col-xs-12 slider-text text-right">
					 <h2>Fer favorite add text</h2>
					 <a href="#">out now add text</a>
				</div>
			</div>
			
		</div>
		<!-- # end owl-demo -->
		</div>
	</div>


	<div class="clearfix"></div>

	<?php
		$taxonomyName = "product_cat";
		$prod_categories = get_terms($taxonomyName, array(
		    'orderby'=> 'name',
		    'order' => 'ASC',
		    'hide_empty' => 0
		));  
		// print_r($prod_categories);
		$i = 0;
		foreach( $prod_categories as $prod_cat ) :
		    if ( $prod_cat->parent != 0 )
		        continue;;

		     $cat[ $prod_cat->slug ]['term_link'] = get_term_link( $prod_cat, 'product_cat' );
		   
		 endforeach; 
		wp_reset_query();
	?>

	<?php if($cat['shoes']):?>

	<section class="shop-categories">
	<div class="container">

		<div class="col-lg-6 col-md-6 col-sm-12 shop-cat-left">
			
			<div class="handbags-cat">
		    	<h2>Handbags</h2>
		    	<p>xxxxxx</p>
		    	<a href="<?php echo $cat['handbags']['term_link'];?>">see</a>
		    	<img src="<?php echo get_template_directory_uri();?>/img/shop/handbags-cat.png" alt="">    	
	    	</div>

			<div class="sunglasses-cat">
		    	<h2>Sunglasses</h2>
		    	<p>xxxxxx</p>
		    	<a href="<?php echo $cat['sunglasses']['term_link'];?>">see</a>
		    	<img src="<?php echo get_template_directory_uri();?>/img/shop/sunglasses-cat.png" alt="">
	    	</div>

		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 shop-cat-right">

			<div class="shoes-cat pull-right">
		    	<h2>Shoes</h2>
		    	<p>xxxxxx</p>
		    	<a href="<?php echo $cat['shoes']['term_link'];?>">see</a>
		    	<img src="<?php echo get_template_directory_uri();?>/img/shop/shoes-cat2.jpg" alt="">
	    	</div>
			<div class="perfume-cat pull-right">
		    	<h2>Perfume</h2>
		    	<p>xxxxxx</p>
		    	<a href="<?php echo $cat['perfume']['term_link'];?>">see</a>
		    	<img src="<?php echo get_template_directory_uri();?>/img/shop/parfum-cat.jpg" alt="">
	    	</div>

		</div>

		<div class="clearfix"></div>
		<a href="#" class="single-link">all products</a>

	</div>
	</section>


	<?php endif;?>

<?php endif;?>





	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		// do_action( 'woocommerce_before_main_content' );
	?>


		<?php
			/**
			 * woocommerce_archive_description hook.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			// do_action( 'woocommerce_archive_description' );
		?>

<?php if( !is_shop() ):?>

		<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook.
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				// do_action( 'woocommerce_before_shop_loop' );
			?>



<?php wc_get_template_part("slider","products");?>



			<?php
				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				// do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>
<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		// do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		// do_action( 'woocommerce_sidebar' );
	?>

<?php //get_footer( 'shop' ); ?>
<?php get_footer(); ?>

<!-- <h1> archive-product.php for shop main and all pages</h1> -->
