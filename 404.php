<?php

get_header(); 

?>

<div class="alex-wrap block-media">

<!-- <div class="block-media"> -->
	
	<img class="big-btn-bar hidden-md hidden-xs hidden-sm"  src="<?php echo get_template_directory_uri();?>/img/black-menu-btn.png" alt="">

	<?php get_template_part( 'menu','header' ); ?>
	
	<div class="container">
		
		<img class="btn-bar-top hidden-lg" src="<?php echo get_template_directory_uri();?>/img/black-top-btn.png" alt="">
		<h1 class="main-name">Fernanda romero</h1>

		<div class="media-category">
		</div>
		
		<div class="movies-catalog">

			<h2 class="error_404 text-center">Error 404: page not found</h2>

		</div>

		<!-- <div id="loading-text"><a class="loading-link" href="#">Loading ...</a></div> -->
		<!-- <div id="loading-text"></div> -->

	</div>

<!-- </div> -->
<!-- end block-media -->

<!-- <div id="true_loadmore">Загрузить ещё</div> -->

<?php get_footer(); ?>

