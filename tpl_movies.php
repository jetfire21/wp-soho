<?php
/*
Template Name: Movies
*/

 // page /movies/ 

get_header(); 

$prefix = "movie_";

?>

<div class="alex-wrap block-media">

<!-- <div class="block-media"> -->
	
	<img class="big-btn-bar hidden-md hidden-xs hidden-sm"  src="<?php echo get_template_directory_uri();?>/img/black-menu-btn.png" alt="">

	<?php get_template_part( 'menu','header' ); ?>
	
	<div class="container">
		
		<img class="btn-bar-top hidden-lg" src="<?php echo get_template_directory_uri();?>/img/black-top-btn.png" alt="">
		<h1 class="main-name">Fernanda romero</h1>

		<div class="media-category">
			<?php //get_template_part( 'menu','media' ); ?>
			<div class="col-md-4 col-sm-4 col-xs-12 cat-active"><h2><a href="/movies">Movies</a></h2><p>xxxxxx</p></div>
			<div class="col-md-4 col-sm-4 col-xs-12"><h2><a href="/music">Music</a></h2><p>xxxxxx</p></div>
			<div class="col-md-4 col-sm-4 col-xs-12 "><h2><a href="/video-2">Video</a></h2><p>xxxxxx</p></div>
		</div>
		
		<div class="movies-catalog">

			<?php $args = array('post_type' => 'movie','order'=>'ASC','posts_per_page' => 4); ?>

	 		<?php $movie = new WP_Query( $args ); ?>
			<?php if($movie->have_posts() ): ?>
			<?php while($movie->have_posts() ) : $movie->the_post();?>
				 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
				 	 <!-- <img class="img-responsive" src="img/movie-1.jpg" alt=""> -->
				 	 <?php the_post_thumbnail('cat-movies', array('class'=>'img-responsive'));?>
				 	 <?php 
				 	 	 $strlen = strlen( get_the_title() );
					 	 $subtitle = substr( get_the_title(),0,15 ); 
					 	 if( $strlen > 15) $subtitle = $subtitle .".."; 
				 	  ?>
				 	 <h3><a href="<?php the_permalink() ?>"><?php echo $subtitle; ?></a></h3>
				 	 <!-- <p>2015</p> -->
				 	 <!-- <?php echo rwmb_meta( $field_id, $args, $post_id ); ?> -->
				 	 <p><?php echo rwmb_meta( "{$prefix}year"); ?></p>
				 </div>
			<?php endwhile; ?>
			<?php else: ?>
			   	<p>no movies</p>
			<?php endif; ?>	

		</div>

		<!-- <div id="loading-text"><a class="loading-link" href="#">Loading ...</a></div> -->
		<div id="loading-text"></div>

	</div>

<!-- </div> -->
<!-- end block-media -->

<!-- <div id="true_loadmore">Загрузить ещё</div> -->

<?php get_footer(); ?>

<?php // Auto load content on scroll down - movies ?>

 <?php if (  $movie->max_num_pages > 1 ) : ?>
	<script>
	var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
	var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
	var max_pages = '<?php echo $movie->max_num_pages; ?>';
	</script>
<?php endif;?>


<?php // Auto load content on scroll down - movies ?>

<script type="text/javascript">

jQuery(function($){

	
	// var h = $(document).height() - $(window).height();
	// console.log( "scroll " + $(window).scrollTop() );
	// console.log( "doc window " + h );

    var count = 1;
    $(window).scroll(function(){
    	if( count < max_pages ){
            if ( $(window).scrollTop() == $(document).height() - $(window).height()){
               loadArticle(count);
               count++;
               console.log( "yes" );
            }
         }
  //       console.log("count " + count);
  //   	console.log( "scroll " + $(window).scrollTop() );
		// console.log( "doc window " + h );
    }); 

    function loadArticle(){

		var data = {
			'action': 'loadmore',
			// 'query': true_posts,
			'page' : current_page
		};

		$.ajax({
			url:ajaxurl, // обработчик
			data:data, // данные
			type:'POST', // тип запроса
			success:function(data){
				console.log("ajax yes!");
				if( data ) { 
					$("#loading-text").html('');
					$('#true_loadmore').text('Загрузить ещё');
					$(".movies-catalog").append(data); // вставляем новые посты
					current_page++; // увеличиваем номер страницы на единицу
					if (current_page == max_pages) $("#true_loadmore").remove(); // если последняя страница, удаляем кнопку
				} else {
					$('#true_loadmore').remove(); // если мы дошли до последней страницы постов, скроем кнопку
				}
			},
			beforeSend: function(){
				$("#loading-text").html('<a class="loading-link" href="#">Loading ...</a>');
			}

			 });
	}

});

</script> 