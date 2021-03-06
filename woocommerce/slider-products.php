


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
			<?php $i = 0; ?>
			<?php while (have_posts() ): the_post(); ?>


				<?php 
				$img = get_the_post_thumbnail($post->ID, "prod_cat", array('class'=>'img-responsive')); 
				if(empty($img)) $img = "<span>not loaded image</span>";
				  ?>

					
					<?php if( $i%3 == 0 && $i != 0):?>
						</div>
					<?php endif;?>

					<?php if( $i%3 == 0):?>
						<div class="item">	
					<?php endif;?>

						<div class="col-md-4 product">
							<div class="wrap_prod_img">
							<?php echo $img;?>
							</div>
							<h2><?php the_title();?></h2>
							<a href="<?php the_permalink();?>">see</a>
						</div>

					<?php if( $i == $cat[0]->count-1):?>
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



<section class="prod-no-slider hidden-md hidden-lg">


 <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>

		<?php $img = get_the_post_thumbnail($post->ID, "prod_cat", array('class'=>'img-responsive')); ?>
		<?php if( !empty($img) ):?>
    	<div class="col-sm-12 product">
			<div class="wrap_prod_img">		
				 <?php echo $img;?>
			</div>
			<h2> <?php the_title();?></h2>
			<a href=" <?php the_permalink();?>">see</a>
		</div>
		<?php endif;?>

<?php endwhile; // end of the loop. ?>
<?php  else:?>
    <h3 class="error">not found</h3>
<?php endif; ?>

</section>	