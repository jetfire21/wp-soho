<?php
/*
Template Name: Movies
*/
?>

<?php get_header(); ?>

		<?php $slider = new WP_Query( array('post_type' => 'movie','order'=>'ASC','posts_per_page' => -1) ); ?>
		<?php if($slider->have_posts() ): ?>
		<?php while($slider->have_posts() ) : $slider->the_post();?>
		<?php the_post_thumbnail('full');?>
			<h2><?php echo the_title(); ?></h2>
	       	<?php the_content(); ?> 
	       		<a href="<?php the_permalink() ?>"><?php echo the_title(); ?></a>

		<?php endwhile; ?>
		<?php else: ?>
		   	<p>Cлайдер еще не добавлен!</p>
		<?php endif; ?>	


<?php get_footer(); ?>