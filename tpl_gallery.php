<?php
/*
Template Name: Gallery
*/

 // page /videos 

get_header(); 


?>

			                        
<div class="alex-wrap page-gallery">

	<img class="big-btn-bar hidden-md hidden-xs hidden-sm"  src="<?php echo get_template_directory_uri();?>/img/bar.png" alt="">
	<img class="btn-bar-top hidden-lg hidden-md" src="<?php echo get_template_directory_uri();?>/img/bar.png" alt="">


	<?php get_template_part( 'menu','header' ); ?>


	<h1 class="main-name">Fernanda romero</h1>
	<a class="btn-small-media hidden-xs" href="media.html"></a>

	<div id="owl-gallery" class="owl-carousel owl-theme gal-hide-slider">

		<?php
		 $prefix = 'gallery_';
		$args = array('post_type' => 'gallery','order'=>'ASC','posts_per_page' => 4); 
		?>

 		<?php $gallery = new WP_Query( $args ); ?>
		<?php if($gallery->have_posts() ): ?>
		<?php while($gallery->have_posts() ) : $gallery->the_post();?>		

		  <div class="item">
				
		  	  <div class="col-md-1 col-md-offset-10 col-sm-1 col-sm-offset-10 hidden-xs gal-link-top text-right">
			  </div>
		  	  <div class="clearfix"></div>
			  <div class="col-md-12">

					<div class="col-md-1 col-sm-1"> </div>

						<?php $slides = rwmb_meta( "{$prefix}slides"); ?>
						<?php $i = 0; foreach($slides as $k=>$v):?>
							<?php $slides[$i] = $v['full_url']; ?>
						<?php $i++; endforeach;?>


						<?php if($slides[0]): ?>
						<div class="col-md-5 col-sm-5 col-xs-10 gal-img  grayscale"> 
							<img src="<?php echo $slides[0];?>" alt=""> 
						</div>
						<?php endif;?>
						<?php if($slides[1]): ?>
						<div class="col-md-5 col-sm-5 col-xs-10 gal-img text-right grayscale">
							<img src="<?php echo $slides[1];?>" alt=""> 
						 </div>
						<?php endif;?>


					<div class="col-md-1 col-sm-1 "></div>

		  	</div>
		 	<div class="clearfix"></div>
		  	<div class="col-md-1 col-md-offset-1 col-sm-1 col-sm-offset-1 hidden-xs gal-link-bot">
		  	</div>

		 </div>

		<?php endwhile; ?>
		<?php else: ?>
			<p>no gallerys</p>
		<?php endif; ?>	

	</div>
	<!-- end #owl-gallery -->


	<div id="gallery-static-img" class="hidden-lg hidden-md hidden-sm ">


		<?php if($gallery->have_posts() ): ?>
		<?php while($gallery->have_posts() ) : $gallery->the_post();?>		

		  <div class="item">

				<?php $slides = rwmb_meta( "{$prefix}slides"); ?>
				<?php $i = 0; foreach($slides as $k=>$v):?>
					<?php $slides[$i] = $v['full_url']; ?>
				<?php $i++; endforeach;?>

				<?php if($slides[0]): ?>
				<div class="col-md-5 col-sm-5 col-xs-10 gal-img  grayscale"> 
					<img src="<?php echo $slides[0];?>" alt=""> 
				</div>
				<?php endif;?>
				<?php if($slides[1]): ?>
				<div class="col-md-5 col-sm-5 col-xs-10 gal-img text-right grayscale">
					<img src="<?php echo $slides[1];?>" alt=""> 
				 </div>
				<?php endif;?>
						
		  	</div>


		<?php endwhile; ?>
		<?php else: ?>
			<p>no gallerys</p>
		<?php endif; ?>	


	</div>
	<!-- end #gallery static img -->

</div>
<!-- end .alex-wrap -->




 <!-- <script src="libs/jquery/jquery1.11.0.min.js"></script> -->
<script type='text/javascript' src="<?php echo get_template_directory_uri();?>/libs/jquery/jquery_1.8.3.min.js"></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri();?>/libs/grayscale2/js/modernizr.custom.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri();?>/libs/grayscale2/js/imagesloaded.pkgd.min.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri();?>/libs/grayscale2/js/grayscale.js'></script>
<script type='text/javascript' src="<?php echo get_template_directory_uri();?>/libs/grayscale2/js/functions.js"></script>

<script src="<?php echo get_template_directory_uri();?>/libs/owl-carousel/owl.carousel.js"></script>
<script src="<?php echo get_template_directory_uri();?>/libs/magnific-popup/jquery.magnific-popup.min.js"></script>

 <script src="<?php echo get_template_directory_uri();?>/js/common.js"></script>	

</body>
</html>

