<?php 

add_action( 'admin_menu', 'alex_sp_register_menu_page' );
function alex_sp_register_menu_page(){
	wp_enqueue_style( 'alex-admin', get_template_directory_uri()."/css/alex_admin.css");
}


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

function my_mce_before_init_insert_formats( $init_array ) {  

// Define the style_formats array

  $style_formats = array(  
    // Each array child is a format with it's own settings
    array(  
      'title' => 'slider-slogan-font-light1',  
      'block' => 'span',  
      'classes' => 'slider-slogan-font-light',
      'wrapper' => true,
      
    ),  
  );  
  // Insert the array, JSON ENCODED, into 'style_formats'
  $init_array['style_formats'] = json_encode( $style_formats );  
  
  return $init_array;  
  
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); 

/* ************************ custom style in visual editor ***************************/ 

/* ******hide admin-bar******** */

add_filter('show_admin_bar', '__return_false');

add_theme_support('post-thumbnails'); // поддержка миниатюр

// add_theme_support( 'menus' );

register_nav_menus( array(
  'loc_menu' => 'hf-menu',
  'sys_gal' => 'gallery_menu_cat'
) );



//создание дополнительно пропоционального размера миниатюры
// add_image_size( 'cat-movies', 404 ); // by width crop
// add_image_size( 'cat-movies', 404,562, true); 
// add_image_size( 'cat-movies', 404,562, true); 
// add_image_size( 'cat-movies', 375,500, true); 
add_image_size( 'cat-movies', 400,553, true); 
add_image_size( 'cat-gallery', 9999, 662); 
// add_image_size( 'prod_cat', 332,263, true); 
// add_image_size( 'prod_cat', 332,9999); 
add_image_size( 'prod_cat', 380,9999); 
add_image_size( 'shop_slider', 1686,951,true); 

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

    $prefix = 'main_slider_';
    $meta_boxes[] = array(
        'title'      => __( 'Test Meta Box', 'slidertype' ),
        'post_types' => 'main_slider',
        'fields'     => array(
            array(
                'id'   => "{$prefix}slide",
                'name' => __( 'Slide image', 'slidertype' ),
                'type' => 'image',
            ),
            array(
                'id'   => "{$prefix}img_link",
                'name' => __( 'The image before link', 'slidertype' ),
                'type' => 'image',
            ),

            array(
                'id'   => "{$prefix}text_link",
                'name' => __( 'Text link', 'textdomain' ),
                'type' => 'text',
            ),
            array(
                'id'   => "{$prefix}url_link",
                'name' => __( 'Link url', 'textdomain' ),
                'type' => 'url',
            ),

          ),
    );

    $prefix = 'shop_slider_';
    $meta_boxes[] = array(
        'title'      => __( 'Fields', 'sslidertype' ),
        'post_types' => 'shop_slider',
        'fields'     => array(
            array(
                'id'   => "{$prefix}slide",
                'name' => __( 'Slide image', 'sslidertype' ),
                'type' => 'image',
            ),

            array(
                'id'   => "{$prefix}text_link",
                'name' => __( 'Text link', 'sslidertype' ),
                'type' => 'text',
            ),
            array(
                'id'   => "{$prefix}url_link",
                'name' => __( 'Link url', 'sslidertype' ),
                'type' => 'url',
            ),

          ),
    );

    $prefix = 'gallery_';
    $meta_boxes[] = array(
        'title'      => __( 'Test Meta Box', 'gallerytype' ),
        'post_types' => 'gallery',
        'fields'     => array(
            array(
                'id'   => "{$prefix}slides",
                'name' => __( 'Slide images', 'gallerytype' ),
                'type' => 'image',
                'desc' => 'Upload 2 images'
            ),
          ),
    );

    $prefix = 'page_';
    $meta_boxes[] = array(
        'title'      => __( 'Test Meta Box', 'pagetype' ),
        'post_types' => 'page',
        'fields'     => array(
            array(
                'id'   => "{$prefix}title",
                'name' => __( 'Title', 'pagetype' ),
                'type' => 'text',
            ),
            array(
                'id'   => "{$prefix}keys",
                'name' => __( 'Meta keywords', 'pagetype' ),
                'type' => 'textarea',
            ),
            array(
                'id'   => "{$prefix}desc",
                'name' => __( 'Meta description', 'pagetype' ),
                'type' => 'textarea',
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


function true_load_posts3(){

  global $wpdb;
  $wpdb->fer_table_name = $wpdb->prefix .  "spotify_api_music";

  $limit = 4;
  $offset = $_POST['current_offset'];
  $limit = $offset.",".$limit;
$i = $offset;
  $tracks_part = $wpdb->get_results("SELECT * FROM $wpdb->fer_table_name LIMIT {$limit}", ARRAY_A);
?>
        <?php foreach($tracks_part as $item):?>
         <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
           <div class="wrap-audio-img" data-index="<?php echo $i;?>">           
              <img class="img-responsive" src="<?php echo $item['img'];?>" alt="">
              <div class="play-music-img"></div>
           </div>
            <h3><?php echo $item['track_name'];?></h3>
            <p>buy</p>
         </div>
        <?php $i++; endforeach;?>
<?php
  // echo "<h1>d</h1>";
  // echo "<pre>";
  // print_r($tracks_part);
  //   echo "</pre>";

  wp_reset_postdata();
  die();
}

add_action('wp_ajax_loadmore_music', 'true_load_posts3');
add_action('wp_ajax_nopriv_loadmore_music', 'true_load_posts3');



function true_load_posts4(){
    $gal_cat = trim($_POST['gal_cat']);
    $args = array('post_type' => 'gallery','order'=>'ASC','posts_per_page' => -1, 'gal_cat' => $gal_cat); 
?>

    <?php $gallery = new WP_Query( $args ); ?>
    <?php if($gallery->have_posts() ): ?>
    <?php while($gallery->have_posts() ) : $gallery->the_post();?>    
        <?php the_title(); ?>
    <?php endwhile; ?>
    <?php endif;?>

<?php
  wp_reset_postdata();
  die();

}

add_action('wp_ajax_gallery_category', 'true_load_posts4');
add_action('wp_ajax_nopriv_gallery_category', 'true_load_posts4');






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
  'name' => 'Videos', // Основное название типа записи
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

/* **************** custom post type - main slider ************************ */

add_action('init', 'custom_type_main_slider');
function custom_type_main_slider()
{
  $labels = array(
  'name' => 'Slides', // Основное название типа записи
  'singular_name' => 'Slides', // отдельное название записи типа Book
  'add_new' => 'Add new',
  'add_new_item' => 'Add new slide',
  'edit_item' => 'Edit slide',
  'new_item' => 'New slide',
  'view_item' => 'View slide',
  'search_items' => 'Search slide',
  'not_found' =>  'Not found',
  'not_found_in_trash' => 'No found in trash',
  'parent_item_colon' => '',
  'menu_name' => 'Slider'

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
  register_post_type('main_slider',$args);
}

/* **************** custom post type - shop slider ************************ */

add_action('init', 'custom_type_shop_slider');
function custom_type_shop_slider()
{
  $labels = array(
  'name' => 'Slides', // Основное название типа записи
  'singular_name' => 'Slides', // отдельное название записи типа Book
  'add_new' => 'Add new',
  'add_new_item' => 'Add new slide',
  'edit_item' => 'Edit slide',
  'new_item' => 'New slide',
  'view_item' => 'View slide',
  'search_items' => 'Search slide',
  'not_found' =>  'Not found',
  'not_found_in_trash' => 'No found in trash',
  'parent_item_colon' => '',
  'menu_name' => 'Shop slider'

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
  register_post_type('shop_slider',$args);
}


/* **************** custom post type - gallery ************************ */

add_action('init', 'custom_type_alex_gallery');
function custom_type_alex_gallery()
{

    register_taxonomy('gal_cat', array('gallery'), array(
    'label'                 => 'Gallery Category', // определяется параметром $labels->name
    'labels'                => array(
      'name'              => 'Gallery Category',
      'singular_name'     => 'Gallery Category',
      'search_items'      => 'Find category',
      'all_items'         => 'All category',
      'parent_item'       => 'Edit category',
      'parent_item_colon' => 'Parent category:',
      'edit_item'         => 'Edit category',
      'update_item'       => 'Update category',
      'add_new_item'      => 'Add new category',
      'new_item_name'     => 'New category',
      'menu_name'         => 'Category',
    ),
    'description'           => 'Category for gallery', // описание таксономии
    'public'                => true,
    'show_in_nav_menus'     => false, // равен аргументу public
    'show_ui'               => true, // равен аргументу public
    'show_tagcloud'         => false, // равен аргументу show_ui
    'hierarchical'          => true,
    'rewrite'               => array('slug'=>'gal_cat', 'hierarchical'=>false, 'with_front'=>false, 'feed'=>false ),
    'show_admin_column'     => true, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
  ) );


    $labels = array(
    'name' => 'Slides', // Основное название типа записи
    'singular_name' => 'Slides', // отдельное название записи типа Book
    'add_new' => 'Add new',
    'add_new_item' => 'Add new slide',
    'edit_item' => 'Edit slide',
    'new_item' => 'New slide',
    'view_item' => 'View slide',
    'search_items' => 'Search slide',
    'not_found' =>  'Not found',
    'not_found_in_trash' => 'No found in trash',
    'parent_item_colon' => '',
    'menu_name' => 'Gallery'

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
    register_post_type('gallery',$args);
}

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

    <h1>Spotify music API </h1>

    <?php
    if($_POST['client_id']) $_SESSION['client_id'] = trim($_POST['client_id']);
    if($_POST['client_id']) $_SESSION['client_secret'] = trim($_POST['client_secret']);
    $redirect_uri = "http://".$_SERVER['HTTP_HOST']."/wp-admin/admin.php?page=slug_alex_spotify";

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
    global $wpdb;
    $wpdb->fer_table_name = $wpdb->prefix .  "spotify_api_music";

    function alex_sp_pagination_params(){
	global $wpdb;

	$perpage = 9;
	// кол-во записей
	// $table_name = $wpdb->prefix . "plg_simply_polls"; 
	$count = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->fer_table_name");
	// необходимое кол-во страниц
	$count_pages = ceil($count / $perpage);
	// минимум 1 страница
	if( !$count_pages ) $count_pages = 1;
	// получение текущей страницы
	if( isset($_GET['paged']) ){
		$page = (int)$_GET['paged'];
		if( $page < 1 ) $page = 1;
	}else{
		$page = 1;
	}
	// если запрошенная страница больше максимума
	if( $page > $count_pages ) $page = $count_pages;
	// начальная позиция для запроса
	$start_pos = ($page - 1) * $perpage;

	$pagination_params = array(
		'page' => $page,
		'count' => $count,
		'count_pages' => $count_pages,
		'perpage' => $perpage,
		'start_pos' => $start_pos
	);
	return $pagination_params;
}


function alex_sp_pagination($page, $count_pages){
	// << < 3 4 5 6 7 > >>
	$back = null; // ссылка НАЗАД
	$forward = null; // ссылка ВПЕРЕД
	$startpage = null; // ссылка В НАЧАЛО
	$endpage = null; // ссылка В КОНЕЦ
	$page2left = null; // вторая страница слева
	$page1left = null; // первая страница слева
	$page2right = null; // вторая страница справа
	$page1right = null; // первая страница справа

	$uri = "?";
	if( $_SERVER['QUERY_STRING'] ){
		foreach ($_GET as $key => $value) {
			if( $key != 'paged' ) $uri .= "{$key}=$value&amp;";
		}
	}

	if( $page > 1 ){
		$back = "<a class='nav-link' href='{$uri}paged=" .($page-1). "'>".__( 'back', 'simply_polls' )."</a>";
	}
	if( $page < $count_pages ){
		$forward = "<a class='nav-link' href='{$uri}paged=" .($page+1). "'>".__( 'next', 'simply_polls' )."</a>";
	}
	if( $page > 3 ){
		$startpage = "<a class='nav-link' href='{$uri}paged=1'>В начало</a>";
	}
	if( $page < ($count_pages - 2) ){
		$endpage = "<a class='nav-link' href='{$uri}paged={$count_pages}'>В конец</a>";
	}
	if( $page - 2 > 0 ){
		$page2left = "<a class='nav-link' href='{$uri}paged=" .($page-2). "'>" .($page-2). "</a>";
	}
	if( $page - 1 > 0 ){
		$page1left = "<a class='nav-link' href='{$uri}paged=" .($page-1). "'>" .($page-1). "</a>";
	}
	if( $page + 1 <= $count_pages ){
		$page1right = "<a class='nav-link' href='{$uri}paged=" .($page+1). "'>" .($page+1). "</a>";
	}
	if( $page + 2 <= $count_pages ){
		$page2right = "<a class='nav-link' href='{$uri}paged=" .($page+2). "'>" .($page+2). "</a>";
	}

	return $startpage.$back.$page2left.$page1left.'<a class="active-page">'.$page.'</a>'.$page1right.$page2right.$forward.$endpage;
}

$pagination_params = alex_sp_pagination_params();
// print_r($pagination_params);

    // echo "SELECT * FROM $wpdb->fer_table_name LIMIT {$tr_paged},5";
   $sel_tracks = $wpdb->get_results("SELECT * FROM $wpdb->fer_table_name LIMIT ".$pagination_params['start_pos'].",".$pagination_params['perpage'], ARRAY_A);
   // var_dump($sel_tracks);

   if($sel_tracks){
   		
   		echo '<form action="" method="post">
   		<table class="wp-list-table widefat fixed striped pages">
   					<tr>
   						<th> Name </th>
   						<th> Album </th>
   						<th> Buy link </th>
   					</tr>';
   		foreach ($sel_tracks as $item) {
   			echo "<tr><td>".$item['id'].". ".$item['track_name']."</td><td> ".$item['album']."</td><td><input class='music-input' type='text' name='tracks[".$item['id']."]' value='".$item['buy_link']."'/></td> 
   			</tr>";
   			
   		}




   		echo "<tr> <td></td><td></td>
   		<td> <input type='submit' name='add_buy' class='button button-primary' value='Save'> </td> 
   		</tr>
		</table>
		</form>";

?>

		<?php if( $pagination_params['count_pages'] > 1 ): ?>
		<div class="pagination">
			<?php echo alex_sp_pagination($pagination_params['page'], $pagination_params['count_pages']); ?>
		</div>
		<?php endif; ?>

<?php


		if( !empty($_POST['tracks']) ){

			$post_tracks = $_POST['tracks'];
			// print_r( $post_tracks);

			foreach ($post_tracks as $k => $v) {
				if( empty($v)) unset( $post_tracks[$k] );
			}
			// print_r( $post_tracks);

			if( $post_tracks ){

				foreach ($post_tracks as $k => $v) {
					$wpdb->query($wpdb->prepare("UPDATE $wpdb->fer_table_name SET buy_link = '%s' WHERE id ='%d'", $v, $k));
				}

			}
			echo '<div id="for_message" class="fade updated"><p>The data was successfully stored !</p></div>';

		}

   }


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

  // echo "<hr>";
  // echo "<pre>";
  // print_r($res4);
  // echo "</pre>";

  // echo "<hr>";

  global $wpdb;
  $wpdb->fer_table_name = $wpdb->prefix .  "spotify_api_music";
  $charset_collate = $wpdb->get_charset_collate();  //DEFAULT CHARACTER SET utf8mb4 COLLATE 

  $sql = "CREATE TABLE IF NOT EXISTS {$wpdb->fer_table_name} ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `track_name` VARCHAR(255) NOT NULL , `album` VARCHAR(255) NOT NULL , `artists` VARCHAR(255) NOT NULL , `track_url` VARCHAR(255) NOT NULL , `img` VARCHAR(255) NOT NULL , `buy_link` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE=InnoDB $charset_collate AUTO_INCREMENT=1";
  $wpdb->query($sql);


    $tracks = $wpdb->get_results("SELECT * FROM $wpdb->fer_table_name", ARRAY_A);
    // echo "type "; var_dump($tracks);

    if( empty( $tracks[0]['track_name'] )) {

      foreach ($res4->items as $items) {

         // echo "<pre>";
         // print_r($items->track);
         // echo "</pre>";

          $img_track = $items->track->album->images[1]->url; // 1- 300x300 2- 640x640
          $demo_track = $items->track->preview_url;

            $add_track = $wpdb->insert( 
            $wpdb->fer_table_name, 
            array( 
              'track_name' => $items->track->name, 
              'album' => $items->track->album->name,
              'artists' => $items->track->artists[0]->name,
              'track_url' =>  $demo_track,
              'img' =>   $img_track
            ), 
            array( 
              '%s', 
              '%s', 
              '%s', 
              '%s', 
              '%s' 
            ) 
          );
           // return $add_track;      
      }
  }
  echo '<div id="for_message" class="fade updated"><p>Music added successfully !</p></div>';
  // $tracks = $wpdb->get_results("SELECT * FROM $wpdb->fer_table_name", ARRAY_A);
   // var_dump($tracks);
   // print_r($tracks);
   // if( !empty( $tracks[0]['track_name'] )) echo "is tracks!";

}
    
    ?>

</div>

<?php
}

/* ********* add socigal networks in section Settings ****************** */

add_action('admin_menu', 'alex_upload_file');
add_action('admin_init', 'alex_setting');


function alex_upload_file(){
  add_options_page( 'Social networks', 'Social networks', 'manage_options', 'alex_upload_file_option', 'alex_f_make_page');
}


function alex_setting(){
  register_setting( 'alex_options_group', 'alex_upload_file_option', 'alex_option_sanitize');
  add_settings_section( 'alex_options_section_facebook', ' ', '', 'alex_upload_file_option');


  add_settings_field('alex_add_facebook_id', 'Facebook', 'alex_add_facebook_cb',  'alex_upload_file_option', 'alex_options_section_facebook', array('label_for' => 'alex_add_facebook_id') );
  add_settings_field('alex_add_twitter_id', 'Twitter', 'alex_add_twitter_cb',  'alex_upload_file_option', 'alex_options_section_facebook', array('label_for' => 'alex_add_twitter_id') );
  add_settings_field('alex_add_google_id', 'Google', 'alex_add_google_cb',  'alex_upload_file_option', 'alex_options_section_facebook', array('label_for' => 'alex_add_google_id') );
  add_settings_field('alex_add_pinterest_id', 'Pinterest', 'alex_add_pinterest_cb',  'alex_upload_file_option', 'alex_options_section_facebook', array('label_for' => 'alex_add_tpinterest_id') );
  add_settings_field('alex_add_linkedin_id', 'Linkedin', 'alex_add_linkedin_cb',  'alex_upload_file_option', 'alex_options_section_facebook', array('label_for' => 'alex_add_tlinkedin_id') );

}


function alex_add_facebook_cb(){
  $option = get_option('alex_upload_file_option' );
  // print_r($option);

  if(empty($option['facebook'])){
    ?>
     <input type="text" class="regular-text" id="alex_add_facebook_id" name="alex_upload_file_option[facebook]"> 
    <?php
  }else{
    ?>
    <input type="text" class="regular-text" id="alex_add_facebook_id" name="alex_upload_file_option[facebook]" value="<?php echo $option['facebook'];?>">
    <?php
  }
}


function alex_add_twitter_cb(){
  $option = get_option('alex_upload_file_option' );

  if(empty($option['twitter'])){
    ?>
     <input type="text" class="regular-text" id="alex_add_twitter_id" name="alex_upload_file_option[twitter]"> 
    <?php
  }else{
    ?>
    <input type="text" class="regular-text" id="alex_add_twitter_id" name="alex_upload_file_option[twitter]" value="<?php echo $option['twitter'];?>">
    <?php
  }
}

function alex_add_pinterest_cb(){
  $option = get_option('alex_upload_file_option' );

  if(empty($option['pinterest'])){
    ?>
     <input type="text" class="regular-text" id="alex_add_pinterest_id" name="alex_upload_file_option[pinterest]" > 
    <?php
  }else{
    ?>
    <input type="text" class="regular-text" id="alex_add_pinterest_id" name="alex_upload_file_option[pinterest]" value="<?php echo $option['pinterest'];?>">
    <?php
  }
}

function alex_add_linkedin_cb(){
  $option = get_option('alex_upload_file_option' );

  if(empty($option['linkedin'])){
    ?>
     <input type="text" class="regular-text" id="alex_add_linkedin_id" name="alex_upload_file_option[linkedin]" > 
    <?php
  }else{
    ?>
    <input type="text" class="regular-text" id="alex_add_linkedin_id" name="alex_upload_file_option[linkedin]" value="<?php echo $option['linkedin'];?>">
    <?php
  }

}

function alex_add_google_cb(){
  $option = get_option('alex_upload_file_option' );

  if(empty($option['google'])){
    ?>
     <input type="text" class="regular-text" id="alex_add_google_id" name="alex_upload_file_option[google]" > 
    <?php
  }else{
    ?>
    <input type="text" class="regular-text" id="alex_add_google_id" name="alex_upload_file_option[google]" value="<?php echo $option['google'];?>">
    <?php
  }

}


function alex_option_sanitize($option){

  if( !empty($_POST['facebook']) ) $option['facebook'] = $_POST['facebook'];
  if( !empty($_POST['google']) ) $option['google'] = $_POST['google'];
  if( !empty($_POST['twitter']) ) $option['twitter'] = $_POST['twitter'];
  if( !empty($_POST['pinterest']) ) $option['pinterest'] = $_POST['pinterest'];
  if( !empty($_POST['linkedin']) ) $option['linkedin'] = $_POST['linkedin'];

  return $option;
}

function alex_f_make_page(){
  ?>
  <div class="wrap">
    <h2>Social networks</h2>
    <form action="options.php" method="post" enctype="multipart/form-data">
      <?php settings_fields( 'alex_options_group' ); //выводит скрытые поля для проверки безопасности ?>
      <?php do_settings_sections( 'alex_upload_file_option' ); // вывод всех полей связанный с секцией ?>
      <?php submit_button(); ?>
    </form>
  </div>
  <?php
}

/* ********* add socigal networks in section Settings ****************** */


add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}




function woo_includes_tax_text_filter_1( $content ) {

  // set up regex match, replace regex with nothing
  $find     = '/\<span.*\"\>/Ui';
  $content  = preg_replace( $find, '', $content );
  $find     = '<strong>';
  $content  = str_replace( $find, '', $content );
  $find     = '</strong>';
  $content  = str_replace( $find, '', $content );
  $find     = '</span>';
  $content  = str_replace( $find, '', $content );

  return $content;
}
add_filter( 'woocommerce_cart_totals_order_total_html', 'woo_includes_tax_text_filter_1', 99, 1 );


add_filter( 'woocommerce_checkout_fields', 'custom_edit_checkout_fields' );

function custom_edit_checkout_fields( $fields ) {
  // Author: apppresser.com

  // Change placeholder
  $fields['billing']['billing_first_name']['placeholder'] = 'Denis';
  $fields['billing']['billing_last_name']['placeholder'] = 'Shepovalov';
  $fields['billing']['billing_email']['placeholder'] = 'yourname@youremail.com';
  $fields['billing']['billing_phone']['placeholder'] = '555 465 2175';
  $fields['billing']['billing_city']['placeholder'] = 'California';
  $fields['billing']['billing_state']['placeholder'] = 'California';
  $fields['billing']['billing_postcode']['placeholder'] = '123456';
  $fields['billing']['billing_email']['label'] = 'E-mail';
  $fields['billing']['billing_address_2']['label'] = '&nbsp;';
  $fields['billing']['billing_last_name']['clear'] = false;
  $fields['billing']['billing_first_name']['class'] = array('col-md-6 name-phone-email');
  $fields['billing']['billing_last_name']['class'] = array('col-md-6 name-phone-email');
  $fields['billing']['billing_email']['class'] = array('col-md-6 name-phone-email');
  $fields['billing']['billing_phone']['class'] = array('col-md-6 name-phone-email');

  $fields['billing']['billing_country']['class'] = array('col-md-4 country-city-zip');
  $fields['billing']['billing_postcode']['class'] = array('col-md-4 country-city-zip');
  $fields['billing']['billing_city']['class'] = array('col-md-4 country-city-zip billing_house_number_field');
  $fields['billing']['billing_state']['class'] = array('col-md-4 country-city-zip ');
  $fields['billing']['billing_address_1']['class'] = array('col-md-5 country-city-zip');
  $fields['billing']['billing_address_2']['class'] = array('col-md-3 country-city-zip');

  // $fields['billing']['billing_postcode']['required'] = false;

    // Move these around as necessary. You'll see we added email first.
  $billing_order = array(
    "billing_first_name", 
    "billing_last_name", 
    "billing_phone",
    "billing_email",
    "billing_country",
    "billing_city",
    "billing_postcode",
    "billing_state",
    "billing_address_1",
    "billing_address_2",
  );

  // This sets the billing fields in the order above
  foreach($billing_order as $billing_field) {
      $billing_fields[$billing_field] = $fields["billing"][$billing_field];
  }

  $fields["billing"] = $billing_fields;

   unset($fields['order']['order_comments']);

   return $fields;
}

add_filter( 'woocommerce_default_address_fields' , 'override_default_address_fields' );
function override_default_address_fields( $address_fields ) {


    $address_fields['city']['label'] = __('City', 'woocommerce');
    $address_fields['postcode']['label'] = __('Zip', 'woocommerce');
    $address_fields['state']['label'] = __('State', 'woocommerce');

    return $address_fields;
}



function vnmTheme_addressFieldsOverride() {
    if (is_wc_endpoint_url('edit-address') || is_checkout()) {
        ?>

        <script>
            jQuery(document).ready(function($) {

              $(".shop-wrap-padding").prepend( $(".woocommerce-error"));

                $(document.body).on('country_to_state_changing', function(event, country, wrapper) {

                    var $postcodeField = wrapper.find('#billing_postcode_field, #shipping_postcode_field');
                    var $housenoField = wrapper.find('.billing_house_number_field, #shipping_house_number_field' );

                    var fieldTimeout = setTimeout(function() {
                        $postcodeField.insertAfter($housenoField);
                    }, 50);
                });

                 $(".select2-arrow").css({"left":"45%"});
                 $(".select2-search").css({"margin-top":"5px"});

            });
        </script>

        <?php
    }
}

add_action('wp_footer', 'vnmTheme_addressFieldsOverride', 999);

function alex_js_overrife_wooccommerce() {
    if (is_cart()) {
        ?>

        <script>
            jQuery(document).ready(function($) {

                   $(".wrap_quantity .minus, .wrap_quantity .plus").on("click", function(){
               
                         $( '.shop_table.cart' ).closest( 'form' ).find( 'input[name="update_cart"]' ).prop( 'disabled', false );
                   });
                  

            });
        </script>

        <?php
    }
}
add_action('wp_footer', 'alex_js_overrife_wooccommerce', 998);