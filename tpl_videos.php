<?php
/*
Template Name: Videos
*/

 // page /videos 

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
			<?php //get_template_part( 'menu','media' ); ?>
			<div class="col-md-4 col-sm-4 col-xs-12 "><h2><a href="/movies">Movies</a></h2><p>xxxxxx</p></div>
			<div class="col-md-4 col-sm-4 col-xs-12"><h2><a href="/music">Music</a></h2><p>xxxxxx</p></div>
			<div class="col-md-4 col-sm-4 col-xs-12 cat-active"><h2><a href="/video-2">Video</a></h2><p>xxxxxx</p></div>
		</div>
		
		<!-- <div class="movies-catalog video-catalog"> -->
		<div class="video-catalog">

			<?php $args = array('post_type' => 'video','order'=>'DESC','posts_per_page' => 4); ?>

	 		<?php $video = new WP_Query( $args );?>
			<?php $i=1; if($video->have_posts() ): ?>
			<?php while($video->have_posts() ) : $video->the_post();?>
				 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				 	<?php $prefix = 'video_'; echo rwmb_meta( "{$prefix}url"); ?>
				 	 <h3><?php the_title(); ?></h3>
				 </div>
	          <?php if($i !=1 && $i%2==0):?>
	            <div class="clearfix"></div>
	         <?php endif;?>
			<?php $i++; endwhile; ?>
			<?php else: ?>
			   	<p>no videos</p>
			<?php endif; ?>	

		</div>
		
		<!-- <a class="loading-link" href="#">Loading ...</a> -->
		<div id="loading-text"></div>


	</div>
<!-- </div> end block media-->


<?php get_footer(); ?>

 <?php if (  $video->max_num_pages > 1 ) : ?>
	<script>
	var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
	var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
	var max_pages = '<?php echo $video->max_num_pages; ?>';
	</script>
<?php endif;?>


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
    		console.log( "cur page " + current_page );


		var data = {
			'action': 'loadmorevideo',
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
					$(".video-catalog").append(data); // вставляем новые посты
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
