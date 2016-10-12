<?php
/*
Template Name: Contact
*/
?>

<?php get_header('contact');  ?>


<div class="col-lg-1 hidden-md hidden-sm hidden-xs shop-big-menu-btn">
	<img src="<?php echo get_template_directory_uri();?>/img/bar.png" alt="">
</div>

<div class="col-lg-4 col-md-4 contact-info">
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
		<?php $option = get_option('alex_upload_file_option'); ?>
		<?php if($option["facebook"]):?>
			<a href="<?php echo $option["facebook"];?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
		<?php endif;?>
		<?php if($option["twitter"]):?>
			<a href="<?php echo $option["twitter"];?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
		<?php endif;?>
		<?php if($option["google"]):?>
			<a href="<?php echo $option["google"];?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
		<?php endif;?>
		<?php if($option["pinterest"]):?>
			<a href="<?php echo $option["pinterest"];?> "><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
		<?php endif;?>
		<?php if($option["linkedin"]):?>
			<a href="<?php echo $option["linkedin"];?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
		<?php endif;?>
	</div>


</div>

<div class=" col-lg-6 col-md-8 shop-wrap-padding form-contact">

	<?php if(have_posts() ): ?>
	<?php while(have_posts() ) : the_post();?>

			<h2><?php echo the_title(); ?></h2>
	       	<?php the_content(); ?> 

	<?php endwhile; ?>
	<?php else: ?>
	   	<p>no content</p>
	<?php endif; ?>	 

</div>
<div class="clearfix"></div>

<?php get_footer("contact"); ?>