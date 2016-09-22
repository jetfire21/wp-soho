<?php
/*
Template Name: Videos
*/

 // page /videos 

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
			<div class="col-md-4 col-sm-4 col-xs-12 "><h2><a  href="media.html">Movies</a></h2><p>xxxxxx</p></div>
			<div class="col-md-4 col-sm-4 col-xs-12"><h2><a href="music.php">Music</a></h2><p>xxxxxx</p></div>
			<div class="col-md-4 col-sm-4 col-xs-12 cat-active"><h2><a href="video.html">Video</a></h2><p>xxxxxx</p></div>
		</div>
		
		<!-- <div class="movies-catalog video-catalog"> -->
		<div class="video-catalog">

			<?php $args = array('post_type' => 'video','order'=>'ASC','posts_per_page' => 4); ?>

	 		<?php $video = new WP_Query( $args );?>
			<?php if($video->have_posts() ): ?>
			<?php while($video->have_posts() ) : $video->the_post();?>
				 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				 	<?php $prefix = 'video_'; echo rwmb_meta( "{$prefix}url"); ?>
				 	 <h3><?php the_title(); ?></h3>
				 </div>
			<?php endwhile; ?>
			<?php else: ?>
			   	<p>no movies</p>
			<?php endif; ?>	

		</div>
		
		<a class="loading-link" href="#">Loading ...</a>

	</div>
<!-- </div> end block media-->


<?php get_footer(); ?>
