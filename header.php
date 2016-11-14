<?php acf_form_head(); ?>
<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Nu Themes
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<title><?php wp_title( '-', true, 'right' ); ?></title>

		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<link href="https://fonts.googleapis.com/css?family=Bitter:400,400i,700" rel="stylesheet">
	    <link href='//api.tiles.mapbox.com/mapbox.js/v1.6.1/mapbox.css' rel='stylesheet' />
	    <script src='//api.tiles.mapbox.com/mapbox.js/v1.6.1/mapbox.js'></script>

	    <link href='//api.tiles.mapbox.com/mapbox-gl-js/v0.25.1/mapbox-gl.css' rel='stylesheet' />

	    
<!-- BORDR APP -->
	    
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/arrayToTable.js"></script>
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/d3.js"></script>
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/nv.d3.min.js"></script>
		
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" type="text/css">
				
		<!-- Custom CSS -->
		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/nv.d3.css">
		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/bordr.css">


<!-- END BORDR APP -->

		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<header id="site-header" class="site-header headroom" role="banner">
			<div class="container">
				<div class="site-branding">
					<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
					<<?php echo $heading_tag; ?> class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
							<img src="/wp-content/themes/bordr/img/egc_logo_350x200.jpg">
						</a>
					</<?php echo $heading_tag; ?>>
					<div class="site-description"><?php bloginfo( 'description' ); ?></div>
				<!-- .site-branding --></div>

				<div class="navbar navbar-default site-navigation" role="navigation">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>

					<?php
						if (is_user_logged_in()) :
							wp_nav_menu( array(
								'theme_location'	=> 'primary',
								'depth'				=> 2,
								'menu_class'		=> 'nav navbar-nav',
								'container_class'	=> 'navbar-collapse collapse main-navigation',
								'fallback_cb'		=> 'nuthemes_bootstrap_navwalker::fallback',
								'walker'			=> new nuthemes_bootstrap_navwalker()
							) );
						else :
							wp_nav_menu( array(
								'menu'				=> 3,
								'depth'				=> 2,
								'menu_class'		=> 'nav navbar-nav',
								'container_class'	=> 'navbar-collapse collapse main-navigation',
								'fallback_cb'		=> 'nuthemes_bootstrap_navwalker::fallback',
								'walker'			=> new nuthemes_bootstrap_navwalker()
							) );						
						endif;
					?>
				<!-- .site-navigation --></div>
			</div>
		<!-- #site-header --></header>

		<div id="main" class="site-main">
			<div class="container">