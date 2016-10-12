<?php
/*
Template Name: Contact
*/
?>

<?php get_header('Contact');  ?>


<div class="col-lg-1 hidden-md hidden-sm hidden-xs shop-big-menu-btn">
	<img src="<?php echo get_template_directory_uri();?>/img/bar.png" alt="">
</div>

<div class="col-lg-3 contact-info">
	<h2>Contact info</h2>

	<div class="company-info">
		<h3>Untitled Entertainment</h3>
		<p>Steven Salisbury</p>
		<span>steven@untitledent.com</span>
	</div>

	<div class="company-info">
		<h3> U.S  Platform PR</h3>
		<span>siri@platfrompr.net</span>
	</div>

	<div class="company-info">
		<h3> PR Metro Public Relations</h3>
		<span>patricia@metroprlatino.com</span>
	</div>

		<div class="soc-network">
	<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
	<a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
	<a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
	<a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
	<a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
	</div>


</div>

<div class="col-lg-offset-1 col-lg-6 col-md-12 shop-wrap-padding form-contact">

	<?php if(have_posts() ): ?>
	<?php while(have_posts() ) : the_post();?>

			<h2><?php echo the_title(); ?></h2>
	       	<?php the_content(); ?> 

	<?php endwhile; ?>
	<?php else: ?>
	   	<p>no content</p>
	<?php endif; ?>	 

</div>

<?php get_footer("Contact"); ?>