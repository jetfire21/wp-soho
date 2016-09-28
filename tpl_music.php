<?php
/*
Template Name: Music
*/

 // page /music/ 

get_header(); 

?>


<div class="alex-wrap block-media">
	
	<img class="big-btn-bar hidden-md hidden-xs hidden-sm"  src="<?php echo get_template_directory_uri();?>/img/black-menu-btn.png" alt="">
	
		<?php get_template_part( 'menu','header' ); ?>


	<div class="container">
		
		<img class="btn-bar-top hidden-lg" src="<?php echo get_template_directory_uri();?>/img/black-top-btn.png" alt="">
		<h1 class="main-name">Fernanda romero</h1>

		<div class="media-category">
			<div class="col-md-4 col-sm-4 col-xs-12 "><h2><a  href="/movies">Movies</a></h2><p>xxxxxx</p></div>
			<div class="col-md-4 col-sm-4 col-xs-12 cat-active"><h2><a href="/music">Music</a></h2><p>xxxxxx</p></div>
			<div class="col-md-4 col-sm-4 col-xs-12"><h2><a href="/video-2">Video</a></h2><p>xxxxxx</p></div>
		</div>
		
		<div class="movies-catalog">

		<?php
			global $wpdb;
			$wpdb->fer_table_name = $wpdb->prefix .  "spotify_api_music";

			$tracks = $wpdb->get_results("SELECT * FROM $wpdb->fer_table_name LIMIT 0,8", ARRAY_A);
			// var_dump($tracks);
			// print_r($tracks);
			if( !empty( $tracks[0]['track_name'] )) {

				 // echo "is tracks!";
				 $i = 1;
		?>
				<?php foreach($tracks as $item):?>
 				 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
	 				 <div class="wrap-audio-img" data-index="<?php echo $i;?>">			 	  	
	 				 	  <img class="img-responsive" src="<?php echo $item['img'];?>" alt="">
	 				 	  <div class="play-music-img"></div>
	 				 </div>
 				 	  <h3><?php echo $item['track_name'];?></h3>

 				 	 	<p> <a class="buy-music" href="<?php echo $item['buy_link'];?>"> buy</a></p>
 				 	 <!-- <p> buy</p> -->
 				 </div>
				<?php $i++; endforeach;?>

		<?php	}

			 else echo "<p>no music</p>";


		?>

		</div>

		<!-- <a class="loading-link" href="#">Loading ...</a> -->
		<div id="loading-text" class="music-autoload"></div>

	</div>

 </div>


<div class="clearfix"></div>

<div id="jquery_jplayer_1" class="jp-jplayer"></div>
<div id="jp_container_1" class="jp-audio" role="application" aria-label="media player">
	<div class="jp-type-playlist">
		<div class="jp-gui jp-interface">
			<div class="jp-controls-holder">

				<div class="jp-progress">
					<div class="jp-seek-bar">
						<div class="jp-play-bar"></div>
					</div>
				</div>

				<div class="jp-controls">
					<button class="jp-previous" role="button" tabindex="0">previous</button>
					<button class="jp-play" role="button" tabindex="0">play</button>
					<button class="jp-stop" role="button" tabindex="0">stop</button>
					<button class="jp-next" role="button" tabindex="0">next</button>
				</div>

				<div class="jp-volume-controls">
					<button class="jp-mute" role="button" tabindex="0">mute</button>
					<button class="jp-volume-max" role="button" tabindex="0">max volume</button>
					<div class="jp-volume-bar">
						<div class="jp-volume-bar-value"></div>
					</div>
				</div>

				<div class="jp-playlist">
				<ul>
				<li>&nbsp;</li>
				</ul>
				</div>

				<div class="jpa-time-toogles">

					<div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
					<div class="jpa-slash"> &nbsp;/&nbsp;</div>
					<div class="jp-duration" role="timer" aria-label="duration">&nbsp;<p>d</p> /ddd</div>

					<div class="jp-toggles">
						<button class="jp-repeat" role="button" tabindex="0">repeat</button>
						<button class="jp-shuffle" role="button" tabindex="0">shuffle</button>
					</div>

				</div>

			</div>

		</div>

		<div class="jp-no-solution">
			<span>Update Required</span>
			To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
		</div>
	</div>
</div>


<?php
$count = mysql_query("SELECT COUNT(1) FROM $wpdb->fer_table_name");
if($count){
	$count = mysql_fetch_array( $count );
	$count = $count[0]; 
}
?>
<script>
var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
var count_row = '<?php echo $count; ?>';
var current_offset = 8;
</script>

 <!-- <script src="libs/jquery/jquery1.11.0.min.js"></script> -->
<script type='text/javascript' src="<?php echo get_template_directory_uri();?>/libs/jquery/jquery_1.8.3.min.js"></script>
<script src="<?php echo get_template_directory_uri();?>/libs/owl-carousel/owl.carousel.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/libs/jplayer/jplayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/libs/jplayer/add-on/jplayer.playlist.min.js"></script>
<script src="<?php echo get_template_directory_uri();?>/js/common.js"></script>	

<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){



	var my_playlist = new jPlayerPlaylist({
		jPlayer: "#jquery_jplayer_1",
		cssSelectorAncestor: "#jp_container_1"
	}, [
		<?php if( !empty( $tracks[0]['track_name'] )): ?>
			<?php foreach($tracks as $item):?>
			{
				title: "<?php echo $item['track_name'];?> / <?php echo $item['album'];?>",
				mp3: "<?php echo $item['track_url'];?>",
				oga: "<?php echo $item['track_url'];?>"
			},
			<?php endforeach;?>
		<?php else:?>
			{
				title:"Runaway / Stranger Lovers",
				mp3:"https://p.scdn.co/mp3-preview/bb19b42c2020c59a337efd368cc86396a7d017b7",
				oga:"https://p.scdn.co/mp3-preview/bb19b42c2020c59a337efd368cc86396a7d017b7"
			},
		<?php endif;?>
	], {
		swfPath: "libs/jplayer/jplayer",
		supplied: "oga, mp3",
		wmode: "window",
		useStateClassSkin: true,
		autoBlur: false,
		smoothPlayBar: true,
		keyEnabled: true,
		loop: true,
	   playlistOptions: {
		    // autoPlay: true,
		     loopOnPrevious: true,
  			 shuffleOnLoop: true,
		  },
	});

	// playlistOptions: {
	//   autoPlay: true,
	//   loopOnPrevious: true,
	//   shuffleOnLoop: true
	// };

	$('.jp-volume-bar').css('display','none');

	$(".wrap-audio-img").click(function(){
		// $("#jquery_jplayer_1").jPlayer("stop");

		var title = $(this).attr("data-title");
		var href = $(this).attr("data-href");
		var ind_track = $(this).attr("data-index") - 1;
		console.log("ind-track "+ind_track);

		// my_playlist.add({
		//   title: title,
		//   mp3: href,
		//   oga: href,
		// },[ {playNow: true} ]);	
		// $(".jp-playlist ul li:nth-child(" + ind_track + ")").css({"display":"block"});

		my_playlist.play(ind_track);

		$("#jquery_jplayer_1").jPlayer("play");
		$(".jp-play").css('background-position',' 0 -61px');

	});

	$(".jp-play").click(function(){
		$(this).css('background-position',' 0 0');
	});


	$(".jp-next, .jp-previous").click(function(){
		$(".jp-play").css('background-position',' 0 -61px');
	});


 $(".jp-volume-max").toggle(function(){
      $('.jp-volume-bar').css('display','block');
   },function(){
       $('.jp-volume-bar').css('display','none');
   });

 	$(".jp-playlist li").removeClass("show-playlist-title");

 	 $(".jp-repeat").toggle(function(){
      $(this).css('background-position','0 -30px');
   },function(){
       $(this).css('background-position','0 0');
   });


	// auto load content

    var offset = current_offset;
    $(window).scroll(function(){
    	if( offset < count_row ){
            if ( $(window).scrollTop() == $(document).height() - $(window).height() ){
               loadArticle(offset);
               offset = offset + 4;
               console.log( offset + "yes" );
            }
         }
  //       console.log("count " + count);
  //   	console.log( "scroll " + $(window).scrollTop() );
		// console.log( "doc window " + h );
    }); 

    function loadArticle(){

		var data = {
			'action': 'loadmore_music',
			// 'query': true_posts,
			'current_offset' : current_offset,
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
					current_offset = current_offset + 4; // увеличиваем номер страницы на единицу
					if (current_offset >= count_row) $("#true_loadmore").remove(); // если последняя страница, удаляем кнопку
				} else {
					$('#true_loadmore').remove(); // если мы дошли до последней страницы постов, скроем кнопку
				}
			},
			beforeSend: function(){
				$("#loading-text").html('<a class="loading-link" href="#">Loading ...</a>');
			}

			 });
	}

	// auto load content

});
//]]>
</script>

</body>
</html>
