<?php
/*
Template Name: Home
*/

 // page /videos 

get_header(); 


?>


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
												<!-- <img src="<?php echo get_template_directory_uri();?>/img/btn-basket.png" alt=""> -->
											 	<?php $img_link = rwmb_meta( "{$prefix}img_link"); ?>
											 	<?php if($img_link):?>
											 	<?php foreach($img_link as $k=>$v):?>
											  		<img src="<?php echo $v['full_url']; ?>" alt="">
												<?php endforeach;?>
												<?php endif;?>
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

<?php get_template_part("movie","carousel");?>

 </section>

	<section class="gallery">
		<div class="gallery-girl"></div>
		<div class="wrap-gallery ie-gradient ">
			<div class="gal-text">
			<h2>Gallery</h2>
			<a href="/gallery-2">see more</a>
			</div>
		</div>	
	</section>

	<section class="blog">
		<div class="container">

			<div class="blog-main-text">
				<h2>Blog</h2>
		    	<p>xxxxxx</p>
			</div>

			<?php 
			$instagram = get_option("sb_instagram_settings");
			$access_token = $instagram['sb_instagram_at'];
		 // $access_token="3314516008.af32c42.0941fe21333b4879a8011270fed16994";


			if($access_token){

				$count = 3;

				$url = "https://api.instagram.com/v1/users/self/media/recent/?";
				// $url.= "access_token={$access_token}&count={$photo_count}";
				$url.= "access_token={$access_token}&count={$count}";

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL,            $url );
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
				$res = curl_exec($ch);
				$res = json_decode($res);  // обьект

				// echo "<pre>";
				// print_r($res->data);
				// echo "</pre>";
				// echo "<hr>";
			}
			?>


			<?php $count = count($res->data); $i = 0; if( !empty($res->data)):?>
				<?php foreach($res->data as $item):?>
				<?php      
				$img_url = $item->images->standard_resolution->url;
				$width = $item->images->standard_resolution->width;
				$height = $item->images->standard_resolution->height;

				// $img_url = $item->images->low_resolution->url;
				// $width = $item->images->low_resolution->width;
				// $height = $item->images->low_resolution->height;
				// $img_url = preg_replace("#\/s640x640#i","", $img_url);
				// $img_url = preg_replace("#\/sh0.08#i","", $img_url);
         		 ?>

				<?php if($i == 0):?>
				<div class="col-lg-6 col-lg-6 col-md-12 col-sm-12  blog-left">
				<div class="row">
		    	<?php endif;?>

					<?php if($i < 2):?>
					<div class="blog-img">
						<div class="grayscale">
						<!-- <img class=" img-responsive" src="<?php echo get_template_directory_uri();?>/img/blog1.jpg" alt=""> -->
						<img class="img-responsive <?php if($width > 553) echo 'img-max-widht553';?>" src="<?php echo $img_url;?>" alt="" >
						</div>
						<div class="blog-img-text col-lg-8 col-md-12 col-sm-12">
							<h3><?php echo $item->caption->text;?></h3>
							<a class="monser-gray" href="<?php echo $item->link;?>">more</a>			
						</div>
					</div>
				    <?php endif;?>
				

				<?php if($i == 1):?>
					</div>
				</div>						
			    <?php endif;?>


				<?php if($i > 1):?>
			<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
				<div class="row">
		    	<?php endif;?>

					<?php if($i > 1):?>
					<div class="blog-img blog-right">

						<div class="grayscale">
						<!-- <img class=" img-responsive" src="<?php echo get_template_directory_uri();?>/img/blog1.jpg" alt=""> -->
						<img class=" img-responsive" src="<?php echo $img_url;?>" alt="">
						</div>
						<div class="blog-img-text col-lg-8 col-md-12 col-sm-12">
							<h3><?php echo $item->caption->text;?></h3>
							<a class="monser-gray" href="<?php echo $item->link;?>">more</a>			
						</div>
						<?php if($i == $count-1):?>
						<a class="exclusive-more" href="/blog">more from blog</a>
					    <?php endif;?>

					</div>
				    <?php endif;?>
				

				<?php if($i > 1):?>
					</div>
				</div>						
			    <?php endif;?>



			<?php $i++; endforeach;?>
			<?php endif;?>

<!-- 			<div class="col-lg-6 col-lg-6 col-md-12 col-sm-12  blog-left">
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
			</div> -->

<!-- 			<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
				<div class="row">

					<div class="blog-img blog-right">
						<div class="grayscale"><img class="img-responsive" src="<?php echo get_template_directory_uri();?>/img/blog3.jpg" alt=""></div>
						<div class="blog-img-text col-lg-8 col-md-12">
							<h3>
							Fernanda Romero For Pasha
							</h3>
							<a class="monser-gray" href="#">more</a>			
						</div>
							<a class="exclusive-more" href="/blog">more from blog</a>
					</div>

				</div>
			</div> -->

		</div>
	</section>


<!-- </div> -->
<!-- end alex-wrap page-home...moved in footer-->


<?php get_footer(); ?>

