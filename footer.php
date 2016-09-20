	<footer>
		<div class="container">
			<div class="col-md-12">
				
				<div class="soc-network">
				<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
				<a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
				<a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
				<a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
				<a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
				</div>

				<!-- footer menu  -->

				<?php
					$args = array(
					  'theme_location'  => 'loc_menu',
					  'menu'            => 'hf-menu', 
					  'container'       => '', 
					  'container_class' => '', 
					  'container_id'    => '',
					  'menu_class'      => 'foot-menu list-inline', 
					  'menu_id'         => '',
					  'echo'            => true,
					  'fallback_cb'     => 'wp_page_menu',
					  'before'          => '',
					  'after'           => '',
					  'link_before'     => '',
					  'link_after'      => '',
					  'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
					  'depth'           => 0
					);

					 wp_nav_menu( $args );
				?>

			</div>
		</div>
	</footer>

</div>
<!-- end .alex-wrap внимательным быть !!! это главная обертка -->

<?php wp_footer(); ?>

</body>
</html>

