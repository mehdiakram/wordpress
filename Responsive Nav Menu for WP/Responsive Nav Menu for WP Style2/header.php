<!-- Start Responsive Menu JS & CSS-->
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/navmenu.css" />
		<script src="<?php echo get_template_directory_uri(); ?>/js/selectnav.min.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/ready.js"></script>
		<script type="text/javascript">
			domready(function(){
				selectnav('nav', {
					label: '--- Navigation --- '
				});
				prettyPrint()
			})
		</script>
<!-- End Responsive Menu JS & CSS-->


<!-- Add Responsive Menu to Header-->
<div class="mainmenu floatleft">
	<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'nav') ); ?>
</div>
<!-- End Code Responsive Menu to Header-->