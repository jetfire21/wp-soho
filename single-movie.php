template : single-movie.php

<?php $prefix = "movie_"; ?>

<p><?php print_r(rwmb_meta( "{$prefix}feedback")); ?></p>
<p><?php echo rwmb_meta( "{$prefix}year"); ?></p>
<p><?php echo rwmb_meta( "{$prefix}release_date"); ?></p>
<p><?php echo rwmb_meta( "{$prefix}director"); ?></p>
<p><?php echo rwmb_meta( "{$prefix}cast"); ?></p>
<p><?php echo rwmb_meta( "{$prefix}genre"); ?></p>
<p><?php echo rwmb_meta( "{$prefix}country"); ?></p>
<p><?php echo rwmb_meta( "{$prefix}video_url"); ?></p>
<p><?php echo rwmb_meta( "gender"); ?></p>

<?php if(have_posts() ): ?>
<?php while(have_posts() ) : the_post();?>

		<h2><?php echo the_title(); ?></h2>
       	<?php the_content(); ?> 

<?php endwhile; ?>
<?php else: ?>
   	<p>no content</p>
<?php endif; ?>	 
<hr>
<?php echo "{$prefix}video_url";?>