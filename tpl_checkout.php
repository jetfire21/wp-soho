<?php
/*
Template Name: Checkout
*/

?>

<?php get_header( 'shop' ); ?>


<?php if(have_posts() ): ?>
<?php while(have_posts() ) : the_post();?>
    <?php the_content();?>
<?php endwhile; ?>
<?php else: ?>
    <p>no content</p>
<?php endif; ?> 

<div class="clearfix"></div>
<?php get_footer(); ?>
