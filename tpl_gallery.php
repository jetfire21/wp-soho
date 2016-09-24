<?php
/*
Template Name: Gallery
*/

 // page /videos 

get_header(); 


?>

			                        
<div class="alex-wrap page-gallery">

	<img class="big-btn-bar hidden-xs hidden-sm"  src="<?php echo get_template_directory_uri();?>/img/bar.png" alt="">
	<img class="btn-bar-top hidden-lg hidden-md" src="<?php echo get_template_directory_uri();?>/img/bar.png" alt="">


	<?php get_template_part( 'menu','header' ); ?>


	<h1 class="main-name">Fernanda romero</h1>
	<a class="btn-small-media hidden-xs" href="media.html"></a>



	<div class="media-category">
		<div class="col-md-1 col-sm-1"></div>
<!-- 
		<div class="col-md-2 col-sm-2 col-xs-12 cat-active"><h2><a  href="media.html">On-Set</a></h2><p>xxxxxx</p></div>
		<div class="col-md-3 col-sm-3 col-xs-12"><h2><a href="music.php">Brands</a></h2><p>xxxxxx</p></div>
		<div class="col-md-3 col-sm-3 col-xs-12"><h2><a href="video.html">Collaboration</a></h2><p>xxxxxx</p></div>
		<div class="col-md-2 col-sm-2 col-xs-12 gal_category"><h2><a href="video.html">Press</a></h2><p>xxxxxx</p></div>
 -->	

 	<?php
		$args = array(
		  'theme_location'  => 'sys_gal',
		  'menu'            => 'gallery_menu_cat', 
		  'container'       => '', 
		  'container_class' => 'dfsdfdf', 
		  'container_id'    => '',
		  'menu_class'      => 'list-unstyled', 
		  'menu_id'         => '',
		  'echo'            => false,
		  'fallback_cb'     => 'wp_page_menu',
		  'before'          => '<h2>',
		  'after'           => '</h2><p>xxxxxx</p>',
		  'link_before'     => '',
		  'link_after'      => '',
		  'items_wrap'      => '%3$s',
		  'depth'           => 0
		);

		 $gal_text = wp_nav_menu( $args );

		 $gal_text = str_replace("li", "div", $gal_text);
		 $gal_text = preg_replace('/class="menu-item/i','class="col-md-2 col-sm-2 col-xs-12 ',$gal_text, 1);
 		 $gal_text = preg_replace('/class="menu-item/i','class="col-md-3 col-sm-3 col-xs-12 ',$gal_text, 2);
 		 echo $gal_text = str_replace('class="menu-item', 'class="col-md-2 col-sm-2 col-xs-12 ', $gal_text);
 	?>	
		<div class="col-md-1 sol-sm-1"></div>
	</div>


	<div id="owl-gallery" class="owl-carousel owl-theme gal-hide-slider">

		<?php

 		 $link_cat_gal = $_SERVER['REQUEST_URI'];
 		 if( preg_match("/brands/i", $link_cat_gal))  $gal_cat = 'brands';
 		 if( preg_match("/press/i", $link_cat_gal)) $gal_cat = 'press';
 		 if( preg_match("/on-set/i", $link_cat_gal)) $gal_cat = 'on-set';
 		 if( preg_match("/collaboration/i", $link_cat_gal))  $gal_cat = 'collaboration';
 		 if( !$gal_cat) $gal_cat = "on-set";

?>


		<?php
		 $prefix = 'gallery_';

		// $args = array('post_type' => 'gallery','order'=>'ASC','posts_per_page' => -1); 
		  $args = array('post_type' => 'gallery','order'=>'ASC','posts_per_page' => -1, 'gal_cat' => $gal_cat ); 
		?>

 		<?php $gallery = new WP_Query( $args ); ?>
		<?php if($gallery->have_posts() ): ?>
		<?php while($gallery->have_posts() ) : $gallery->the_post();?>		

			<?php
			
			 $slides = rwmb_meta( "{$prefix}slides"); 
			$count = ceil( (count($slides))/2);
			?>
			<?php $i = 0; foreach($slides as $k=>$v):?>
				<?php
				 $full_url[$i] = $v['full_url'];
				 if( preg_match("/png/i", $v['full_url']) ) $type = "png"; 
				 if( preg_match("/jpg/i", $v['full_url']) ) $type = "jpg"; 

				if( $v['sizes']['cat-gallery']){
					 $slides[$i]['file'] = $v['sizes']['cat-gallery']['file'];
					 $slides[$i]['size'] = $v['sizes']['cat-gallery']['width']."x".$v['sizes']['cat-gallery']['height'];
					 $size = $v['sizes']['cat-gallery']['width']."x".$v['sizes']['cat-gallery']['height'];
	 				 $full_url[$i] = substr($v['full_url'],0,-4)."-".$size.".".$type;
				}
				  ?>
			<?php $i++; endforeach;?>

		<?php $k=0; $j = 0; while( $k < $count  ):?>
		
		  <div class="item">
				
		  	  <div class="col-md-1 col-md-offset-10 col-sm-1 col-sm-offset-10 hidden-xs gal-link-top text-right">
			  </div>
		  	  <div class="clearfix"></div>
			  <div class="col-md-12">
						

					<div class="col-md-1 col-sm-1"> </div>
						<?php $j = (count($a)-1)+1; $a[ count($a)-1] = $j; ?>

						<?php if($full_url[$j]): ?>
						<div class="col-md-5 col-sm-5 col-xs-10 gal-img  grayscale"> 
							<!-- <img src="<?php echo $slides[$k]['file'];?>" alt="<?php echo $slides[$k]['size'];?>">  -->
							<img src="<?php echo $full_url[$j];?>" alt=""> 
						</div>
						<?php endif;?>

						<?php $j = (count($a)-1)+1; $a[ count($a)-1] = $j; ?>

						<?php if($full_url[$j]): ?>
						<div class="col-md-5 col-sm-5 col-xs-10 gal-img text-right grayscale">
							<!-- <img src="<?php echo $slides[$k+1]['file'];?>" alt="<?php echo $slides[$k]['size'];?>">  -->
							<img src="<?php echo $full_url[$j];?>" alt="">  
						 </div>
						<?php endif;?>




					<div class="col-md-1 col-sm-1 "></div>

		  	</div>
		 	<div class="clearfix"></div>
		  	<div class="col-md-1 col-md-offset-1 col-sm-1 col-sm-offset-1 hidden-xs gal-link-bot">
		  	</div>

		 </div>
		<?php   $k++; endwhile; ?>

		<?php endwhile; ?>
		<?php else: ?>
			<p>no gallerys</p>
		<?php endif; ?>	

	</div>
	<!-- end #owl-gallery -->


	<div id="gallery-static-img" class="hidden-lg hidden-md hidden-sm ">


		<?php if($gallery->have_posts() ): ?>
		<?php while($gallery->have_posts() ) : $gallery->the_post();?>	

						<?php $i = 0; foreach($slides as $k=>$v):?>
				<?php
				 $full_url[$i] = $v['full_url'];
				 if( preg_match("/png/i", $v['full_url']) ) $type = "png"; 
				 if( preg_match("/jpg/i", $v['full_url']) ) $type = "jpg"; 

				if( $v['sizes']['cat-gallery']){
					 $slides[$i]['file'] = $v['sizes']['cat-gallery']['file'];
					 $slides[$i]['size'] = $v['sizes']['cat-gallery']['width']."x".$v['sizes']['cat-gallery']['height'];
					 $size = $v['sizes']['cat-gallery']['width']."x".$v['sizes']['cat-gallery']['height'];
	 				 $full_url[$i] = substr($v['full_url'],0,-4)."-".$size.".".$type;
				}
				  ?>
			<?php $i++; endforeach;  ?>


		<?php  unset($a); $k=0; $j = 0; while( $k < $count  ):?>

		  <div class="item">

				<?php $j = (count($a)-1)+1; $a[ count($a)-1] = $j; ?>

				<?php if($full_url[$j]): ?>
				<div class="col-md-5 col-sm-5 col-xs-10 gal-img  grayscale"> 
					<img src="<?php echo $full_url[$j];?>" alt=""> 
				</div>
				<?php endif;?>

			<?php $j = (count($a)-1)+1; $a[ count($a)-1] = $j; ?>

			<?php if($full_url[$j]): ?>
				<div class="col-md-5 col-sm-5 col-xs-10 gal-img text-right grayscale">
					<img src="<?php echo $full_url[$j];?>" alt=""> 
				 </div>
				<?php endif;?>
		  	</div>
			<?php   $k++; endwhile; ?>

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


