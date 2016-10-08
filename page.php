<?php
// global $pagenow;
// print_r($pagenow);
		
 $link_cat_gal = $_SERVER['REQUEST_URI'];
if( preg_match("/lost-password/i", $link_cat_gal) or preg_match("/my-account/i", $link_cat_gal) or preg_match("/order-received/i", $link_cat_gal) ) {

	 get_header('shop'); 
?>

<div class="col-lg-1 hidden-md hidden-sm hidden-xs shop-big-menu-btn">
	<img src="<?php echo get_template_directory_uri();?>/img/shop/shop-big-menu-btn.png" alt="">
</div>

<div class="col-lg-10 col-md-12 shop-wrap-padding">
	<?php if(have_posts() ): ?>
	<?php while(have_posts() ) : the_post();?>
		<?php the_content();?>
	<?php endwhile; ?>
	<?php else: ?>
	   	<p>no content</p>
	<?php endif; ?>	

</div>
<div class="clearfix"></div>
<?php
	 get_footer(); 
}
else{
	get_header(); 
?>

<div class="alex-wrap block-media">

<!-- <div class="block-media"> -->
	
	<img class="big-btn-bar hidden-md hidden-xs hidden-sm"  src="<?php echo get_template_directory_uri();?>/img/black-menu-btn.png" alt="">

	<?php get_template_part( 'menu','header' ); ?>
	
	<div class="container">
		
		<img class="btn-bar-top hidden-lg" src="<?php echo get_template_directory_uri();?>/img/black-top-btn.png" alt="">
		<h1 class="main-name">Fernanda romero</h1>

		<div class="media-category">
		</div>
		
		<div class="movies-catalog">

			<?php if(have_posts() ): ?>
			<?php while(have_posts() ) : the_post();?>
				<?php the_content();?>
			<?php endwhile; ?>
			<?php else: ?>
			   	<p>no content</p>
			<?php endif; ?>	

		</div>

		<!-- <div id="loading-text"><a class="loading-link" href="#">Loading ...</a></div> -->
		<!-- <div id="loading-text"></div> -->

	</div>

<!-- </div> -->
<!-- end block-media -->

<!-- <div id="true_loadmore">Загрузить ещё</div> -->

<?php get_footer(); ?>

<? } ?>
