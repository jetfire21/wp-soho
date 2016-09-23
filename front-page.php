<?php get_header(); ?>


<div class="alex-wrap page-home">

  <header>

	<?php get_template_part( 'menu','header' ); ?>
	
	<div id="owl-demo" class="owl-carousel owl-theme">
			
		<?php $prefix = 'main_slider_'; $args = array('post_type' => 'main_slider','order'=>'ASC'); ?>

		<?php $slider = new WP_Query( $args ); ?>
		<?php if($slider->have_posts() ): ?>
		<?php while($slider->have_posts() ) : $slider->the_post();?>
				 
		  	<div class="item">
			 	<?php $slide = rwmb_meta( "{$prefix}slide"); ?>
			 	<?php foreach($slide as $k=>$v):?>
			  		<img src="<?php echo get_template_directory_uri();?>/img/img-transp.png" alt=" " style="background-image:url('<?php echo $v['full_url']; ?>');">
				<?php endforeach;?>

				  		<div class="wrap-a">
							<div class="bg-color">
										<img class="btn-bar-top hidden-lg hidden-md" src="<?php echo get_template_directory_uri();?>/img/bar.png" alt="">
										<h3 class="main-name">Fernanda romero</h3>
										<img class="big-btn-bar hidden-xs hidden-sm"  src="<?php echo get_template_directory_uri();?>/img/bar.png" alt="">
										<div class="slogan">
										 	 <?php 
										 	 	 $slogan = explode(" ",get_the_title());
										 	 	 if( count($slogan) > 2){
										 	 	 	 $slogan[1] = "<span>".$slogan[1];
										 	 	 	 $slogan[2] = $slogan[2]."</span>";
										 	 	 	 $slogan[ count($slogan)-2 ] = "<span>".$slogan[ count($slogan)-2 ];
										 	 	 	 $slogan[ count($slogan)-1 ] = $slogan[ count($slogan)-1 ]."</span>";
										 	 	 }elseif( count($slogan) == 2){
										 	 	 	$slogan[1] = "<span>".$slogan[1]."</span>";
										 	 	 }
										 	 	 $slogan = implode(" ", $slogan);
										 	 	 // var_dump($slogan); 
										 	  ?>
											<h3><?php echo $slogan;?></h3>
											<div class="btn-media">
												<img src="<?php echo get_template_directory_uri();?>/img/btn-basket.png" alt="">
												<a href="<?php echo rwmb_meta( "{$prefix}url_link"); ?>"><?php echo rwmb_meta( "{$prefix}text_link"); ?></a>
											</div>
										</div>
							</div>
				  		</div>


			 	 <h3><a href="<?php the_permalink() ?>"><?php echo $subtitle; ?></a></h3>
			 	 <!-- <p>2015</p> -->
			 	 <!-- <?php echo rwmb_meta( $field_id, $args, $post_id ); ?> -->
			 	<?php $slide = rwmb_meta( "{$prefix}slide"); ?>
			 	<?php foreach($slide as $k=>$v):?>
			 	 <p><?php echo $v['full_url']; ?></p>
				<?php endforeach;?>
			 	 <p><?php echo rwmb_meta( "{$prefix}slogan"); ?></p>
			 	 <p></p>
			 	 <p></p>
			 </div>
		<?php endwhile; ?>
		<?php else: ?>
		   	<p>no sliders</p>
		<?php endif; ?>	

		
	</div>
	<!-- # end owl-demo -->


</header>

<section class="home-movies">
	<div class="container">

		<div class="block-movies-title">
	    	<h2>On set</h2>
	    	<p>xxxxxx</p>
	    	<h3><a href="media.html">All movies</a></h3>
		</div>

	 </div>

	<div class="wrap-carousel">
		<div id="owl-movies" class="owl-carousel">

			<div class="item"> <img src="<?php echo get_template_directory_uri();?>/img/hotel.jpg" alt=""> <h3><a href="movie-single.html"> El hotel </a></h3> <p>2016</p> </div>
			<div class="item"><img src="<?php echo get_template_directory_uri();?>/img/400days.jpg" alt=""> <h3><a href="movie-single.html"> 400 days </a></h3> <p>2015</p></div>
			<div class="item"><img src="<?php echo get_template_directory_uri();?>/img/sold.jpg" alt=""><h3><a href="movie-single.html"> Sold </a></h3> <p>2014</p></div>
			<div class="item"><img src="<?php echo get_template_directory_uri();?>/img/400days.jpg" alt=""> <h3><a href="movie-single.html"> 400 days</a> </h3> <p>2015</p></div>
			<div class="item"><img src="<?php echo get_template_directory_uri();?>/img/sold.jpg" alt=""><h3><a href="movie-single.html"> Sold </a></h3> <p>2014</p></div>
			<div class="item"> <img src="<?php echo get_template_directory_uri();?>/img/hotel.jpg" alt=""> <h3><a href="movie-single.html"> El hotel</a> </h3> <p>2016</p> </div>
			<div class="item"><img src="<?php echo get_template_directory_uri();?>/img/400days.jpg" alt=""> <h3><a href="movie-single.html"> 400 days </a></h3> <p>2015</p></div>

		</div>
	</div>

 </section>

	<section class="gallery">
		<div class="gallery-girl"></div>
		<div class="wrap-gallery ie-gradient ">
			<div class="gal-text">
			<h2>Gallery</h2>
			<a href="gallery.html">see more</a>
			</div>
		</div>	
	</section>

	<section class="blog">
		<div class="container">

			<div class="blog-main-text">
				<h2>Blog</h2>
		    	<p>xxxxxx</p>
			</div>

			<div class="col-lg-6 col-lg-6 col-md-12 col-sm-12  blog-left">
				<div class="row">

					<div class="blog-img">
						<div class="grayscale"><img class=" img-responsive" src="<?php echo get_template_directory_uri();?>/img/blog1.jpg" alt=""></div>
						<div class="blog-img-text col-lg-8 col-md-12 col-sm-12">
							<h3>Fernanda Romero and
							The White Cherries For 
							Rolling Stone Magazine
							</h3>
							<a class="monser-gray" href="#">more</a>			
						</div>
					</div>
					
					<div class="blog-img">
						<div class="grayscale"><img class=" img-responsive" src="<?php echo get_template_directory_uri();?>/img/blog2.jpg" alt=""></div>
						<div class="blog-img-text col-lg-8 col-md-12">
							<h3>Fernanda Romero on the
							cover Of Sexee Magazine
							</h3>
							<a class="monser-gray" href="#">more</a>			
						</div>
					</div>

				</div>
			</div>

			<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
				<div class="row">

					<div class="blog-img blog-right">
						<div class="grayscale"><img class="img-responsive" src="<?php echo get_template_directory_uri();?>/img/blog3.jpg" alt=""></div>
						<div class="blog-img-text col-lg-8 col-md-12">
							<h3>
							Fernanda Romero For Pasha
							</h3>
							<a class="monser-gray" href="#">more</a>			
						</div>
							<a class="exclusive-more" href="#">more from blog</a>
					</div>

				</div>
			</div>

		</div>
	</section>


<!-- </div> -->
<!-- end alex-wrap page-home...moved in footer-->


<?php get_footer(); ?>



