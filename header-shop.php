<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />


	<?php if(have_posts() ): ?>
	<?php while(have_posts() ) : the_post();?>	
	    <title>	<?php if( rwmb_meta( "{$prefix}title") ) echo rwmb_meta( "{$prefix}title"); ?></title>
		<meta name="description" content='<?php if( rwmb_meta( "{$prefix}desc") ) echo rwmb_meta( "{$prefix}desc"); ?>' />
	    <meta name="keywords" content='<?php if( rwmb_meta( "{$prefix}keys") ) echo rwmb_meta( "{$prefix}keys"); ?>' />
	<?php endwhile;?>
	<?php endif;?>

	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/fonts.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/libs/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/libs/font-awesome/css/font-awesome.min.css" /> 
	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/libs/owl-carousel/owl.carousel.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/main-shop.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/media-shop.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/libs/grayscale2/css/grayscale.css" />

	<?php if( is_product_category()):?>
		<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/libs/owl-carousel/owl.theme.css">
	<?php endif;?>

	<!--[if gte IE 9]>
	  <style type="text/css">
	    .ie-gradient {
	       filter: none;
	    }
	  </style>
	<![endif]-->

<?php wp_head(); ?>

<link rel="icon" href="<?php echo get_template_directory_uri();?>/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="<?php echo get_template_directory_uri();?>/favicon.ico" type="image/x-icon">

</head>
<body>

<!-- <h1>header-shop.php</h1> -->

<?php

if( is_shop()) $wrap_page = 'shop-home-page'; 
if( is_product_category()) $wrap_page = 'shop-cat-page'; 
if( is_product()) $wrap_page = 'single-product'; 
if( is_cart()) $wrap_page = 'cart-page'; 

?>

<div class="alex-wrap <?php echo $wrap_page;?> ">	

	<nav class="top-menu hidden-xs hidden-sm">
		<img class="close-top-menu" src="<?php echo get_template_directory_uri();?>/img/close.jpg" alt="">
		<ul class="list-inline">
			<li> 
				 <span class="vert-line"></span>
				 <a href="index.html">home </a>
				 <span class="vert-line"></span>						 
			</li>
			<li>
				 <span class="vert-line"></span>						 					
				<a href="bio.html">bio</a>
				 <span class="vert-line"></span>						 
			</li>
			<li>
				 <span class="vert-line"></span>						 
				<a href="media.html">media</a>
				 <span class="vert-line"></span>						 
			</li>
			<li>
				 <span class="vert-line"></span>						 
				<a href="gallery.html">gallery</a>
				 <span class="vert-line"></span>						 
			</li>
			<li>
				 <span class="vert-line"></span>						 
				<a href="">blog</a>
				 <span class="vert-line"></span>						 
			</li>
			<li>
				 <span class="vert-line"></span>						 
				<a href="">contact</a>
				 <span class="vert-line"></span>						 
			</li>
		</ul>			                         
	</nav>	

	<nav class="mob-menu hidden-lg hidden-md">
		<img class="close-mob-menu" src="<?php echo get_template_directory_uri();?>/img/close.jpg" alt="">
		<ul class="list-unstyled">
			<li> 
				 <a href="index.html">home</a>
			</li>
			<li>
				<a href="bio.html">bio</a>
			</li>
			<li>
				<a href="media.html">media</a>
			</li>
			<li>
				<a href="gallery.html">gallery</a>
			</li>
			<li>
				<a href="">blog</a>
			</li>
			<li>
				<a href="">contact</a>
			</li>
		</ul>			                         
	</nav>

<header>

	<div class="header-top">

		<div class="col-md-1 col-sm-2 col-xs-2 shop-btn-mobile"><img class="hidden-lg" src="<?php echo get_template_directory_uri();?>/img/black-top-btn.png" alt=""></div>
		<div class="col-md-9 col-sm-8 col-xs-8 ">	<h1 class="main-name">Fernanda romero</h1></div>
		<div class="col-md-2 col-sm-2 col-xs-2 padding-left-del text-right">
			<div class="cart"><span>01</span></div>
			<div class="profile hidden-sm hidden-xs "></div>
		</div>
		<div class="clearfix"></div>

	</div>

</header>


