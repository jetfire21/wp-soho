<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
    <title>
    		<?php wp_title( '', true, 'right' );
			if($_SERVER["REQUEST_URI"]=="" OR $_SERVER["REQUEST_URI"]=="/") { bloginfo( 'name' ); } 
			?>	
    </title>
	<meta name="description" content="Профессиональные услуги по созданию сайтов" />
    <meta name="keywords" content="создание сайтов, веб-разработчик, разработка сайтов, заказать сайт, landing page" />
    <!--     
<meta name="description" content="<?php echo get_post_meta($post->ID, 'description', true); ?>" />
<meta name="keywords" content="<?php echo get_post_meta($post->ID, 'keywords', true); ?>" />
 -->

	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/fonts.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/libs/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/libs/font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/libs/owl-carousel/owl.carousel.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/main.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/media.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/libs/grayscale2/css/grayscale.css" />

	<?php if( is_single() ):?>
	<!-- <link rel="stylesheet" href="libs/owl-carousel/owl.theme.css"> -->
		<!-- for only movie single (нужно еще додумать) -->
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

