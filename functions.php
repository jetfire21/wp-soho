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
                'name' => __( 'Video url', 'textdomain' ),
                'type' => 'textarea',
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
                'name' => __( 'Video code', 'videopage' ),
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



/* **************** Добаление нового пункта меню Главные опции в Настройки ************************* */

add_action('admin_menu', 'alex_upload_file');
add_action('admin_init', 'alex_setting');

//добавляем страницу для опции (внешнее оформление)
function alex_upload_file(){
  add_options_page( 'Главные опции', 'Главные опции', 'manage_options', 'alex_upload_file_option', 'alex_f_make_page');
}

// регистрация опций и генерация полей для ввода
function alex_setting(){
  register_setting( 'alex_options_group', 'alex_upload_file_option', 'alex_option_sanitize');
  add_settings_section( 'alex_options_section', 'Шапка', '', 'alex_upload_file_option');
  add_settings_section( 'alex_options_section_phone', 'На всех страницах сайта', '', 'alex_upload_file_option');
  // add_settings_field('alex_color_bg_id', 'Цвет фона', 'alex_color_bg_cb',  'alex_upload_file_option', 'alex_options_section', array('label_for' => 'alex_color_bg_id') );

  add_settings_field('alex_header_logo_id', 'Добавить логотип', 'alex_header_logo_cb',  'alex_upload_file_option', 'alex_options_section', array('label_for' => 'alex_header_logo_id') );
  add_settings_field('alex_del_header_logo_id', 'Удалить логотип', 'alex_del_header_logo_cb',  'alex_upload_file_option', 'alex_options_section', array('label_for' => 'alex_del_header_logo_id') );
  add_settings_field('alex_add_phone_id', 'Моб. телефон (будет выводится в шапке и подвале сайта)', 'alex_add_phone_cb',  'alex_upload_file_option', 'alex_options_section_phone', array('label_for' => 'alex_add_phone_id') );
  add_settings_field('alex_add_email_id', 'Email (будет выводится в шапке и подвале сайта)', 'alex_add_email_cb',  'alex_upload_file_option', 'alex_options_section_phone', array('label_for' => 'alex_add_email_id') );
  add_settings_field('alex_add_timework_id', 'Время работы (будет выводится в шапке и подвале сайта)', 'alex_add_timework_cb',  'alex_upload_file_option', 'alex_options_section_phone', array('label_for' => 'alex_add_timework_id') );
}


function alex_add_phone_cb(){
  $option = get_option('alex_upload_file_option' );
  // print_r($option);

  if(empty($option['phone'])){
    ?>
     <input type="text" class="regular-text" id="alex_add_phone_id" name="alex_upload_file_option[phone]" value="<?php echo esc_attr($option['alex']); ?>"> 
    <?php
  }else{
    ?>
    <input type="text" class="regular-text" id="alex_add_phone_id" name="alex_upload_file_option[phone]" value="<?php echo $option['phone'];?>">
    <?php
  }

}

function alex_add_email_cb(){
  $option = get_option('alex_upload_file_option' );
  // print_r($option);

  if(empty($option['email'])){
    ?>
     <input type="text" class="regular-text" id="alex_add_email_id" name="alex_upload_file_option[email]" value="<?php echo esc_attr($option['alex']); ?>"> 
    <?php
  }else{
    ?>
    <input type="text" class="regular-text" id="alex_add_email_id" name="alex_upload_file_option[email]" value="<?php echo $option['email'];?>">
    <?php
  }

}

function alex_add_timework_cb(){
  $option = get_option('alex_upload_file_option' );
  // print_r($option);

  if(empty($option['timework'])){
    ?>
     <input type="text" class="regular-text" id="alex_add_timework_id" name="alex_upload_file_option[timework]" value="<?php echo esc_attr($option['alex']); ?>"> 
    <?php
  }else{
    ?>
    <input type="text" class="regular-text" id="alex_add_timework_id" name="alex_upload_file_option[timework]" value="<?php echo $option['timework'];?>">
    <?php
  }

}



function alex_header_logo_cb(){
  $option = get_option('alex_upload_file_option' );
  ?>
   <input type="file" id="alex_header_logo_id" name="uploadfile_logo"> 
  <?php
  if(!empty($option['url_file_logo'])){
    echo "<p><img src='{$option['url_file_logo']}' alt='logo' width='200'></p>";
  }
  else echo "<p><img src='" . get_template_directory_uri() ."/img/logo2.jpg' style='max-width: 200px;
    max-height: 70px;'></p>";
}


function alex_del_header_logo_cb(){
  ?>
   <input type="checkbox" name="del_header_logo"> 
  <?php
}


function alex_option_sanitize($option){


  if( !empty($_FILES['uploadfile_logo']['tmp_name'])  ){
    $overrides = array('test_form' => false);
    $file = wp_handle_upload( $_FILES['uploadfile_logo'], $overrides );
    $option['url_file_logo'] = $file['url'];
    //print_r($file);
  }
  else{
    $old_option = get_option('alex_upload_file_option' );
    $option['url_file_logo'] = $old_option['url_file_logo'];
  }


  if($_POST['del_header_logo'] == 'on'){
    unset($option['url_file_logo']);
  }

  if( !empty($_POST['phone']) ) $option['phone'] = $_POST['phone'];

  if( !empty($_POST['email']) ) $option['email'] = $_POST['email'];
  if( !empty($_POST['timework']) ) $option['timework'] = $_POST['timework'];

   return $option;
}

function alex_f_make_page(){
  ?>
  <div class="wrap">
    <h2>Главные опции</h2>
    <form action="options.php" method="post" enctype="multipart/form-data">
      <?php settings_fields( 'alex_options_group' ); //выводит скрытые поля для проверки безопасности ?>
      <?php do_settings_sections( 'alex_upload_file_option' ); // вывод всех полей связанный с секцией ?>
      <?php submit_button(); ?>
    </form>
  </div>
  <?php
}

// вывод на сайте $option = get_option('alex_upload_file_option');

/* **************** Добаление нового пункта меню Главные опции в Настройки ************************* */

function the_breadcrumb() {
    if (!is_front_page()) {
        echo '<li>';
        // echo '<a href="';
        // echo get_option('home');
        echo 'Главная';
        echo "</li> &nbsp;&gt;&nbsp; ";
        // echo "</a> &nbsp;&gt;&nbsp; ";
        if (is_category() || is_single()) {
          echo "<li>";
            the_category(' ');
           echo "</li>";
            if (is_single()) {
                // echo " &nbsp;&gt;&nbsp; ";
                // the_title();
            }
        } elseif (is_page()) {
            echo "<li>";
            echo the_title();
            echo "</li>";
        }
    }
    else {
        echo '<li>Главная</li>';
    }
}


/* ************************ custom style in visual editor ***************************/ 

function wpb_mce_buttons_2($buttons) {
  array_unshift($buttons, 'styleselect');
  return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');

/*
* Callback function to filter the MCE settings
*/

function my_mce_before_init_insert_formats( $init_array ) {  

// Define the style_formats array

  $style_formats = array(  
    // Each array child is a format with it's own settings
    array(  
      'title' => 'Content Block',  
      'block' => 'span',  
      'classes' => 'content-block',
      'wrapper' => true,
      
    ),  
    array(  
      'title' => 'Red Button',  
      'block' => 'span',  
      'classes' => 'red-button',
      'wrapper' => true,
    ),
    array(  
      'title' => 'Ramka s tenyami',  
      'block' => 'div',  
      'classes' => 'ramka',
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