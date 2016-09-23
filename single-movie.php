<!-- template : single-movie.php -->

<?php get_header(); ?>
<?php $prefix = "movie_"; ?>


	<div class="alex-wrap overlay block-media">

<!-- <div class="block-media"> -->
	
	<img class="big-btn-bar hidden-md hidden-xs hidden-sm"  src="<?php echo get_template_directory_uri();?>/img/black-menu-btn.png" alt="">
	<?php get_template_part( 'menu','header' ); ?>


	<div class="container">
		
		<img class="btn-bar-top hidden-lg" src="<?php echo get_template_directory_uri();?>/img/black-top-btn.png" alt="">
		<h1 class="main-name">Fernanda romero</h1>

		<div class="movie-title">
			<div class="col-md-5"><a href="/movies">movies</a></div>
			<div class="col-md-7">

				 <?php if(have_posts() ): ?>
				<?php while(have_posts() ) : the_post();?>
					 <h2><?php the_title();?></h2>
				<?php endwhile; ?>
				<?php else: ?>
				   	<p>no content</p>
				<?php endif; ?>	 
				<!-- <h2>El Hotel</h2> -->

				<p>xxxxxx</p></div>
		</div>

		<div class="movie-content">

			<div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">

				 <?php if(have_posts() ): ?>
				<?php while(have_posts() ) : the_post();?>
					 <?php the_post_thumbnail('full', array('class'=>'img-responsive'));?>
				<?php endwhile; ?>
				<?php else: ?>
				   	<p>no content</p>
				<?php endif; ?>	 

			</div>

			<div class="col-lg-8 col-md-7 col-sm-12 movie-cont-right feedback">

				<?php $arr_feedback = rwmb_meta("{$prefix}feedback");?>

				<?php if( !empty( $arr_feedback[0] ) ): ?>
				<h4>what people say</h4>
				<div id="owl-movie-feedback" class=" owl-carousel owl-theme">
					<?php foreach( $arr_feedback as $item):?>
					<div class="item">
							<p>“<?php echo $item;?>”.</p>
						<span>The Hollywood Reporter</span>
					</div>							
					<?php endforeach;?>	
				</div>
				<?php endif;?>

				<div class="movie-params">

					<div class="col-md-4 col-sm-4 col-xs-12">
						 <div class="row"> <p>release date</p> </div>
					</div>
					<div class="col-md-8 col-sm-8 col-xs-12">
						 <div class="row"> <span><?php echo rwmb_meta( "{$prefix}release_date"); ?></span></div>
					</div>
					<div class="clearfix"></div>

					<div class="col-md-4 col-sm-4 col-xs-12">
						 <div class="row"><p>director</p> </div>
					</div>
					<div class="col-md-8 col-sm-8 col-xs-12">
						<div class="row">
							<span><?php echo rwmb_meta( "{$prefix}director"); ?></span></div>
						</div>
					<div class="clearfix"></div>

					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="row"><p>cast</p> </div>
					</div>
					<div class="col-md-8 col-sm-8 col-xs-12">
						<div class="row"><span><?php echo rwmb_meta( "{$prefix}cast"); ?></span></div>
					</div>
					<div class="clearfix"></div>

					<div class="col-md-4 col-sm-4 col-sx-12">
						<div class="row"><p>genre</p> </div>
					</div>
					<div class="col-md-8 col-sm-8 col-sx-12">
						<div class="row"><span><?php echo rwmb_meta( "{$prefix}genre"); ?></span>	</div>	
					</div>				
					<div class="clearfix"></div>

					<div class="col-md-4 col-sm-4 col-sx-12">
						<div class="row"><p>contry</p> </div>
					</div>
					<div class="col-md-8 col-sm-8 col-sx-12">
						<div class="row"><span><?php echo rwmb_meta( "{$prefix}country"); ?></span></div>
					</div>

				</div>

			</div>

		</div>
		
		<div class="wrap-movie-video col-lg-12 col-md-12 col-sm-12 col-xs-12">
<!-- 
			<iframe src="https://player.vimeo.com/video/182786851?title=0&byline=0&portrait=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
 -->
 			<?php echo rwmb_meta( "{$prefix}video_url"); ?>

		</div>

		<div class="movie-desc col-md-offset-1 col-md-10">
			<h4>sinopse</h4>

			 <?php if(have_posts() ): ?>
			<?php while(have_posts() ) : the_post();?>
				 <?php the_content();?>
			<?php endwhile; ?>
			<?php else: ?>
			   	<p>no content</p>
			<?php endif; ?>	 

		</div>

	</div>

<?php get_template_part("movie","carousel");?>

<?php get_footer(); ?>

