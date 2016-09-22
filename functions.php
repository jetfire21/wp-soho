<?php 


/* ************* include css and js files ******** */

add_action( 'wp_enqueue_scripts', 'css_js_for_theme' );

function css_js_for_theme(){

  wp_deregister_script( 'jquery' );
   wp_enqueue_script('jquery', get_template_directory_uri()."/libs/jquery/jquery_1.8.3.min.js",'','',true);
   wp_enqueue_script('owl-carousel', get_template_directory_uri()."/libs/owl-carousel/owl.carousel.js",array('jquery'),'',true);
   wp_enqueue_script('common-alex', get_template_directory_uri()."/js/common.js",array('jquery'),'',true);

   if( is_front_page()){ 
       wp_enqueue_script('modernizer-a', get_template_directory_uri()."/libs/grayscale2/js/modernizr.custom.js",array('jquery'),'',true);
       wp_enqueue_script('imgloaded-a', get_template_directory_uri()."/libs/grayscale2/js/imagesloaded.pkgd.min.js",array('jquery'),'',true);
       wp_enqueue_script('grayscale-a', get_template_directory_uri()."/libs/grayscale2/js/grayscale.js",array('jquery'),'',true);
       wp_enqueue_script('grayscale-func-a', get_template_directory_uri()."/libs/grayscale2/js/functions.js",array('jquery'),'',true);
    }
    // if( is_single() ){  
    //    wp_register_style('owl-theme',  get_template_directory_uri()."/libs/owl-carousel/owl.theme.css");
    //    wp_enqueue_style( 'owl-theme');
    // }
}

add_editor_style('editor-style.css');

/* ******hide admin-bar******** */

add_filter('show_admin_bar', '__return_false');

add_theme_support('post-thumbnails'); // поддержка миниатюр

// add_theme_support( 'menus' );

register_nav_menus( array(
  'loc_menu' => 'hf-menu',
) );


//создание дополнительно пропоционального размера миниатюры
// add_image_size( 'cat-movies', 404 ); // by width crop
// add_image_size( 'cat-movies', 404,562, true); 
// add_image_size( 'cat-movies', 404,562, true); 
// add_image_size( 'cat-movies', 375,500, true); 
add_image_size( 'cat-movies', 400,553, true); 

// cleaning trash
remove_action( 'wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_generator');
remove_action( 'wp_head', 'feed_links_extra', 3 ); 
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); 
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
remove_action('wp_head', 'wp_shortlink_wp_head');

add_filter('xmlrpc_enabled', '__return_false');


// Disable Embeds WordPres scripts

function disable_embeds_init() {

    // Remove the REST API endpoint.
    remove_action('rest_api_init', 'wp_oembed_register_route');

    // Turn off oEmbed auto discovery.
    // Don't filter oEmbed results.
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

    // Remove oEmbed discovery links.
    remove_action('wp_head', 'wp_oembed_add_discovery_links');

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action('wp_head', 'wp_oembed_add_host_js');
}

add_action('init', 'disable_embeds_init', 9999);

// Disable Embeds WordPres scripts



// for metabox plugin

add_filter( 'rwmb_meta_boxes', 'movie_meta_boxes' );
function movie_meta_boxes( $meta_boxes ) {

    $prefix = 'movie_';
    $meta_boxes[] = array(
        'title'      => __( 'Test Meta Box', 'textdomain' ),
        'post_types' => 'movie',
        'fields'     => array(
            array(
                'id'   => "{$prefix}feedback",
                'name' => __( 'What people say', 'textdomain' ),
                'type' => 'textarea',
                'clone' => true,
            ),
            array(
                'id'   => "{$prefix}video_url",
                'name' => __( 'Video code', 'textdomain' ),
                'type' => 'textarea',
                'desc' => 'Example: &lt;iframe src="https://player.vimeo.com/video/182784437?title=0&byline=0&portrait=0" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen &gt; &lt;/iframe &gt;'
            ),
            array(
                'id'   => "{$prefix}year",
                'name' => __( 'Year', 'textdomain' ),
                'type' => 'text',
            ),
            array(
                'id'   => "{$prefix}release_date",
                'name' => __( 'Release date', 'textdomain' ),
                'type' => 'text',
            ),
            array(
                'id'   => "{$prefix}director",
                'name' => __( 'Director', 'textdomain' ),
                'type' => 'text',
            ),
            array(
                'id'   => "{$prefix}cast",
                'name' => __( 'Cast', 'textdomain' ),
                'type' => 'text',
            ),
            array(
                'id'   => "{$prefix}genre",
                'name' => __( 'Genre', 'textdomain' ),
                'type' => 'text',
            ),
            array(
                'id'   => "{$prefix}country",
                'name' => __( 'Country', 'textdomain' ),
                'type' => 'text',
            ),
        ),
    );

    $prefix = 'video_';
    $meta_boxes[] = array(
        'title'      => __( 'Test Meta Box', 'videopage' ),
        'post_types' => 'video',
        'fields'     => array(
            array(
                'id'   => "{$prefix}url",
                'name' => __( 'Video url', 'videopage' ),
                'type' => 'oembed',
            ),
          ),
    );

    return $meta_boxes;
}



// Auto load content on scroll down - movies

function true_load_posts(){

      $prefix = "movie_";
     $paged = $_POST['page'] + 1; // следующая страница
?>
      <?php $args = array( 'post_type' => 'movie','order'=>'ASC','posts_per_page' => 4, 'paged' => $paged,'post_status' => 'publish'); ?>
      <?php $movie = new WP_Query( $args ); ?>
      <?php if($movie->have_posts() ): ?>
      <?php while($movie->have_posts() ) : $movie->the_post();?>
         <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
           <?php the_post_thumbnail('cat-movies', array('class'=>'img-responsive'));?>
           <?php 
             $strlen = strlen( get_the_title() );
             $subtitle = substr( get_the_title(),0,15 ); 
             if( $strlen > 15) $subtitle = $subtitle .".."; 
            ?>
           <h3><a href="<?php the_permalink() ?>"><?php echo $subtitle; ?></a></h3>
           <p><?php echo rwmb_meta( "{$prefix}year"); ?></p>
         </div>
      <?php endwhile; ?>
      <?php else: ?>
          <p>no movies</p>
      <?php endif; ?> 

<?php
  wp_reset_postdata();
  die();
}

add_action('wp_ajax_loadmore', 'true_load_posts');
add_action('wp_ajax_nopriv_loadmore', 'true_load_posts');



function true_load_posts2(){

      $prefix = "video_";
     $paged = $_POST['page'] + 1; // следующая страница
?>
      <?php $args = array('post_type' => 'video','order'=>'ASC','posts_per_page' => 4, 'paged' => $paged,'post_status' => 'publish'); ?>

      <?php $video = new WP_Query( $args );?>
      <?php if($video->have_posts() ): ?>
      <?php while($video->have_posts() ) : $video->the_post();?>
         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <?php $prefix = 'video_'; echo rwmb_meta( "{$prefix}url"); ?>
           <h3><?php the_title(); ?></h3>
         </div>
      <?php endwhile; ?>
      <?php else: ?>
          <p>no videos</p>
      <?php endif; ?> 

<?php
  wp_reset_postdata();
  die();
}

add_action('wp_ajax_loadmorevideo', 'true_load_posts2');
add_action('wp_ajax_nopriv_loadmorevideo', 'true_load_posts2');






/* **************** custom post type - movies ************************ */

add_action('init', 'custom_type_movie');
function custom_type_movie()
{
  $labels = array(
  'name' => 'Movies', // Основное название типа записи
  'singular_name' => 'Movie', // отдельное название записи типа Book
  'add_new' => 'Add new',
  'add_new_item' => 'Add new movie',
  'edit_item' => 'Edit movie',
  'new_item' => 'New movie',
  'view_item' => 'View movie',
  'search_items' => 'Search movie',
  'not_found' =>  'Not found',
  'not_found_in_trash' => 'No found in trash',
  'parent_item_colon' => '',
  'menu_name' => 'Movies'

  );
  $args = array(
  'labels' => $labels,
  'public' => true,
  'publicly_queryable' => true,
  'show_ui' => true,
  'show_in_menu' => true,
  'query_var' => true,
  'rewrite' => true,
  'capability_type' => 'post',
  'has_archive' => true,
  'hierarchical' => false,
  'menu_position' => null,
  'supports' => array('title','editor','thumbnail')
  );
  register_post_type('movie',$args);
}

/* **************** пользовательский тип записей - слайдер (на главной) ************************* */

/* **************** пользовательский тип записей - услуги (на главной) ************************* */

add_action('init', 'custom_type_video');
function custom_type_video()
{
  $labels = array(
  'name' => 'Vodeos', // Основное название типа записи
  'singular_name' => 'Vodeo', // отдельное название записи типа Book
  'add_new' => 'Add new',
  'add_new_item' => 'Add new video',
  'edit_item' => 'Edit video',
  'new_item' => 'New Video',
  'view_item' => 'View Video',
  'search_items' => 'Search Video',
  'not_found' =>  'Not found',
  'not_found_in_trash' => 'No found in trash',
  'parent_item_colon' => '',
  'menu_name' => 'Videos'

  );
  $args = array(
  'labels' => $labels,
  'public' => true,
  'publicly_queryable' => true,
  'show_ui' => true,
  'show_in_menu' => true,
  'query_var' => true,
  'rewrite' => true,
  'capability_type' => 'post',
  'has_archive' => true,
  'hierarchical' => false,
  'menu_position' => null,
  'supports' => array('title')
  );
  register_post_type('video',$args);
}

/* **************** пользовательский тип записей - услуги (на главной) ************************* */


    add_action('init', 'my_insert_post_hook');

    function my_insert_post_hook(){
         //  wp_redirect("http://ya.ru");
         // exit;
      session_start();
    }


function alex_fern_reg_menu_page(){
  add_menu_page(  'spotify','Spotify API', 'manage_options', 'slug_alex_spotify','alex_fern_cb_options','
dashicons-editor-alignleft' );

}

add_action( 'admin_menu', 'alex_fern_reg_menu_page' );

function alex_fern_cb_options(){
?>

<div class='wrap'>

    <h1>Spotify API (now at the stage of integration WP)</h1>

    <?php
    if($_POST['client_id']) $_SESSION['client_id'] = trim($_POST['client_id']);
    if($_POST['client_id']) $_SESSION['client_secret'] = trim($_POST['client_secret']);
    $redirect_uri = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

    $client_id = $_SESSION['client_id'];
    $client_secret = $_SESSION['client_secret'];
    
    // echo "ses"; print_r($_SESSION);
    ?>

   <form method="post" action="">

   <?php //wp_nonce_field('sp_add_poll'); ?>

    <table class="form-table table1">
    <tr>
      <th scope="row"><label for="client_id">Client id: </label></th>
      <td><input maxlength="200" name="client_id" type="text" id="client_id" class="regular-text" value="<?php echo $_SESSION['client_id'];?>"/></td>
      <td></td>
    </tr>
    <tr>
      <th scope="row"><label for="client_secret">Client secret: </label></th>
      <td><input maxlength="200" name="client_secret" type="text" id="client_secret" class="regular-text" value="<?php echo $_SESSION['client_secret'];?>" /></td>
      <td></td>
    </tr>
    <tr>
      <th scope="row"><label for="client_secret">Redirect uri </label></th>
      <td><?php echo $redirect_uri ;?></td>
      <td></td>
    </tr>

    </table>
    
    <p class="submit">
      <input type="submit" name="add" id="submit" class="button button-primary" value="Send" />
    </p>
    </form> 

      <?php

$query = "https://accounts.spotify.com/authorize/?client_id=".$client_id."&response_type=code&redirect_uri=".$redirect_uri."&state=34fFs29kd09";

 if( !empty($client_id) && !empty($client_secret) ) echo "<a href='".$query."'>Now click here</a>";


if( !empty($_GET['code'])) $code = $_GET['code'];

if(!empty($code)){

  // get access token

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,            'https://accounts.spotify.com/api/token' );
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
  curl_setopt($ch, CURLOPT_POST,           1 );
  curl_setopt($ch, CURLOPT_POSTFIELDS,     'grant_type=authorization_code&code='.$code.'&redirect_uri='.$redirect_uri ); 
  curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Authorization: Basic '.base64_encode($client_id.':'.$client_secret))); 


  // $ch = curl_init();
  // curl_setopt($ch, CURLOPT_URL,            'https://accounts.spotify.com/api/token' );
  // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
  // curl_setopt($ch, CURLOPT_POST,           1 );
  // curl_setopt($ch, CURLOPT_POSTFIELDS,     'grant_type=client_credentials' ); 
  // curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Authorization: Basic '.base64_encode($client_id.':'.$client_secret))); 

  $res = curl_exec($ch);
  $res = json_decode($res);  // обьект

  // echo "<pre>";
  // print_r($res);
  // echo "</pre>";

  // echo "<br><br>";

  // echo $access_token = $res->access_token;
  $access_token = $res->access_token;

  // echo "<br><br>";

  // echo base64_encode($access_token);
  // echo $access_token = "BQCkQxlSKqrGNFATXSnqKq0DKy8pFBIjoq3i5J6W6rUu0TsZ4butToSkrK8aLdTUUyfvBf06jfH9op1MqxZt-v5LhD4BZn3fwWFbxCR6f-nvVaTgRvTu9IiKEar5UoSuh_uq8vKG33JCwBvIC8gzqFDuW22cdyHTLsh7rdZGR9pCDJGT9O7mUnk";

  // get user_info

  $ch2 = curl_init();
  curl_setopt($ch2, CURLOPT_URL,            'https://api.spotify.com/v1/me' );
  curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1 );
  curl_setopt($ch2, CURLOPT_HTTPHEADER,   array("Authorization: Bearer ".$access_token )); 
  $res2 = curl_exec($ch2);
  $res2 = json_decode($res2);  // обьект

  // echo "<pre>";
  // print_r($res2);
  // echo "</pre>";

  // echo $user_id = $res2->id;
  $user_id = $res2->id;

  // curl -X GET "https://api.spotify.com/v1/me" -H "Authorization: Bearer {your access token}"


  // get user playlists

  $ch3 = curl_init();
  curl_setopt($ch3, CURLOPT_URL,            'https://api.spotify.com/v1/users/'.$user_id.'/playlists' );
  curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1 );
  curl_setopt($ch3, CURLOPT_HTTPHEADER,   array("Authorization: Bearer ".$access_token )); 
  $res3 = curl_exec($ch3);
  $res3 = json_decode($res3);  // обьект

  // echo "<pre>";
  // print_r($res3);
  // echo "</pre>";

  // echo "<hr>";

  // echo $playlist_id = $res3->items[0]->id;
  // echo $link_tracks = $res3->items[0]->tracks->href;
  $playlist_id = $res3->items[0]->id;
  $link_tracks = $res3->items[0]->tracks->href;


  // get all tracks


  $ch4 = curl_init();
  curl_setopt($ch4, CURLOPT_URL,            $link_tracks );
  curl_setopt($ch4, CURLOPT_RETURNTRANSFER, 1 );
  curl_setopt($ch4, CURLOPT_HTTPHEADER,   array("Authorization: Bearer ".$access_token )); 
  $res4 = curl_exec($ch4);
  $res4 = json_decode($res4);  // обьект

  echo "<hr>";
  echo "<pre>";
  print_r($res4);
  echo "</pre>";

  // echo "<hr>";

  // foreach ($res4->items as $items) {

  //  // echo "<pre>";
  //  // print_r($items->track);
  //  // echo "</pre>";

  //   echo "<br>";   
  //   $img_track = $items->track->album->images[1]->url; // 1- 300x300 2- 640x640
  //   echo "<img src='{$img_track}' alt='' />";
  //   echo "<br>";   
  //   echo "Album: ".$items->track->album->name;
  //   echo "<br>";
  //   echo "Artists: ".$items->track->artists[0]->name;
  //   echo "<br>";
  //   echo "Track: ".$items->track->name;
  //   echo "<br>";
  //   $demo_track = $items->track->preview_url;
  //   echo ' <audio controls="" name="media"><source src="'.$demo_track.'" type="audio/mpeg"></audio>';
    
  // }
}
    
    ?>

</div>

<?php
}