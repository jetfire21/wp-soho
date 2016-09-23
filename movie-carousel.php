
<?php $args = array('post_type' => 'movie','order'=>'DESC','posts_per_page' => 6); ?>

<?php $movie = new WP_Query( $args ); ?>
<?php if($movie->have_posts() ): ?>

	<section class="home-movies">
		<div class="container">

			<div class="block-movies-title">
		    	<h2>Movies</h2>
		    	<p>xxxxxx</p>
		    	<h3><a href="/movies">All movies</a></h3>
			</div>

		 </div>

		<div class="wrap-carousel">
			<div id="owl-movies" class="owl-carousel">
				<?php while($movie->have_posts() ) : $movie->the_post();?>

					<div class="item"> 
						<?php the_post_thumbnail('cat-movies', array('class'=>''));?>
					 	 <?php 
					 	 	 $strlen = strlen( get_the_title() );
						 	 $subtitle = substr( get_the_title(),0,15 ); 
						 	 if( $strlen > 15) $subtitle = $subtitle .".."; 
					 	  ?>
					 	 <h3><a href="<?php the_permalink() ?>"><?php echo $subtitle; ?></a></h3>
					</div>

				<?php endwhile; ?>

			</div>
		</div>

	</section>

<?php else: ?>
   	<p>no movies</p>
<?php endif; ?>	

