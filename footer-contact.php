
	<footer class="hidden-lg hidden-md">
		<div class="container">
			<div class="col-md-12">
				
				<div class="soc-network">
					<?php $option = get_option('alex_upload_file_option'); ?>
					<?php if($option["facebook"]):?>
						<a href="<?php echo $option["facebook"];?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
					<?php endif;?>
					<?php if($option["twitter"]):?>
						<a href="<?php echo $option["twitter"];?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
					<?php endif;?>
					<?php if($option["google"]):?>
						<a href="<?php echo $option["google"];?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
					<?php endif;?>
					<?php if($option["pinterest"]):?>
						<a href="<?php echo $option["pinterest"];?> "><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
					<?php endif;?>
					<?php if($option["linkedin"]):?>
						<a href="<?php echo $option["linkedin"];?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
					<?php endif;?>
				</div>


			</div>
		</div>
	</footer>

</div>
<!-- end .alex-wrap внимательным быть !!! это главная обертка -->

<?php wp_footer(); ?>

</body>
</html>

