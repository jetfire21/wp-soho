
  	<!-- desctop-menu -->

	<?php
		$args = array(
		  'theme_location'  => 'loc_menu',
		  'menu'            => 'hf-menu', 
		  'container'       => 'nav', 
		  'container_class' => 'top-menu hidden-xs hidden-sm', 
		  'container_id'    => '',
		  'menu_class'      => 'list-inline', 
		  'menu_id'         => '',
		  'echo'            => true,
		  'fallback_cb'     => 'wp_page_menu',
		  'before'          => '<span class="vert-line"></span>',
		  'after'           => '<span class="vert-line"></span>',
		  'link_before'     => '',
		  'link_after'      => '',
		  'items_wrap'      => '
			  <img class="close-top-menu" src="'.get_template_directory_uri().'/img/close.jpg" alt="">
				<ul class="%2$s">%3$s</ul>',
		  'depth'           => 0
		);

		 wp_nav_menu( $args );

	?>

	<!-- mobile-menu -->

	<?php
		$args = array(
		  'theme_location'  => 'loc_menu',
		  'menu'            => 'hf-menu', 
		  'container'       => 'nav', 
		  'container_class' => 'mob-menu hidden-lg hidden-md', 
		  'container_id'    => '',
		  'menu_class'      => 'list-unstyled', 
		  'menu_id'         => '',
		  'echo'            => true,
		  'fallback_cb'     => 'wp_page_menu',
		  'before'          => '',
		  'after'           => '',
		  'link_before'     => '',
		  'link_after'      => '',
		  'items_wrap'      => '
			  	<img class="close-mob-menu" src="'.get_template_directory_uri().'/img/close.jpg" alt="">
				<ul class="%2$s">%3$s</ul>',
		  'depth'           => 0
		);

		 wp_nav_menu( $args );
	?>
