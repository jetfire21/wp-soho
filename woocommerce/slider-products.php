


	<div class="col-lg-1 hidden-md hidden-sm hidden-xs shop-big-menu-btn">
		<img src="<?php echo get_template_directory_uri();?>/img/shop/shop-big-menu-btn.png" alt="">
	</div>



<div class="col-lg-11 col-md-12">
	<div class="row">

		<?php 
		global $post, $product;	
		$cat = get_the_terms( $post->ID, 'product_cat' );  // info a category
		 if ( have_posts() ) : ?>

		<div id="owl-shop-products" class="owl-carousel owl-theme">
			<?php $i = 1; ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php if( $i == 1 || $i%4 == 0):?>
					<div class="item">	
				<?php endif;?>

				<div class="col-md-4 product">
					<div class="wrap_prod_img">
					<?php //echo the_post_thumbnail("full", array('class'=>'img-responsive'));?>
					<?php echo the_post_thumbnail("prod_cat", array('class'=>'img-responsive'));?>
					</div>
					<h2><?php the_title();?></h2>
					<a href="<?php the_permalink();?>">see</a>
				</div>

				<?php if( $i%3 == 0 || $i == $cat[0]->count):?>
					</div>
				<?php endif;?>

			<?php $i++; endwhile; // end of the loop. ?>
		</div> 
		<!-- end owl-shop-products -->

		<?php  else:?>

			<h1>not found</h1>

		<?php endif; ?>
	
	</div>
</div>

	<div class="clearfix"></div>
	<h2 class="title-category"><?php echo $cat[0]->name;?></h2>
