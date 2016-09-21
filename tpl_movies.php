<?php
/*
Template Name: Movies
*/
?>

<?php get_header(); ?>

<div class="alex-wrap block-media">

<!-- <div class="block-media"> -->
	
	<img class="big-btn-bar hidden-md hidden-xs hidden-sm"  src="<?php echo get_template_directory_uri();?>/img/black-menu-btn.png" alt="">

	<?php get_template_part( 'menu','header' ); ?>
	
	<div class="container">
		
		<img class="btn-bar-top hidden-lg" src="<?php echo get_template_directory_uri();?>/img/black-top-btn.png" alt="">
		<h1 class="main-name">Fernanda romero</h1>

		<div class="media-category">
			<div class="col-md-4 col-sm-4 col-xs-12 cat-active"><h2><a  href="media.html">Movies</a></h2><p>xxxxxx</p></div>
			<div class="col-md-4 col-sm-4 col-xs-12"><h2><a href="music.php">Music</a></h2><p>xxxxxx</p></div>
			<div class="col-md-4 col-sm-4 col-xs-12"><h2><a href="video.html">Video</a></h2><p>xxxxxx</p></div>
		</div>
		
		<div class="movies-catalog">

	 		<?php $slider = new WP_Query( array('post_type' => 'movie','order'=>'ASC','posts_per_page' => -1) ); ?>
			<?php if($slider->have_posts() ): ?>
			<?php while($slider->have_posts() ) : $slider->the_post();?>
				 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
				 	 <!-- <img class="img-responsive" src="img/movie-1.jpg" alt=""> -->
				 	 <?php the_post_thumbnail('full', array('class'=>'img-responsive'));?>
				 	 <h3><a href="<?php the_permalink() ?>"><?php echo the_title(); ?></a></h3>
				 	 <!-- <p>2015</p> -->
				 	 <!-- <?php echo rwmb_meta( $field_id, $args, $post_id ); ?> -->
				 	 <p><?php echo rwmb_meta( 'year'); ?></p>
				 </div>
			<?php endwhile; ?>
			<?php else: ?>
			   	<p>Cлайдер еще не добавлен!</p>
			<?php endif; ?>	

		</div>

		<a class="loading-link" href="#">Loading ...</a>

	</div>

<!-- </div> -->
<!-- end block-media -->


<?php get_footer(); ?>