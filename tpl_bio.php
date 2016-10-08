<?php
/*
Template Name: Bio
*/
?>

<?php get_header(); ?>

<div class="alex-wrap bio_page">

	<img class="big-btn-bar hidden-md hidden-xs hidden-sm"  src="<?php echo get_template_directory_uri();?>/img/bar.png" alt="">
	<img class="btn-bar-top hidden-lg" src="<?php echo get_template_directory_uri();?>/img/bar.png" alt="">
	<?php get_template_part( 'menu','header' ); ?>

	<!-- <div class="bio_page"> -->

		<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 wrap_bio_cont">
			<div class="row img-overlay">
				<img src="<?php echo get_template_directory_uri();?>/img/bio-fern.jpg" alt="">
				<div class="btn-media">
					<img src="<?php echo get_template_directory_uri();?>/img/play.png" alt="">
					<a href="/movies">see media</a>
				</div>
			</div>
		</div>

		<div class="col-lg-8 col-md-7 col-sm-12 col-xs-12 bio_content">

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

<?php get_footer(); ?>