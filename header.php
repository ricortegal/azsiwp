<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package azsiwp
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<header id="menu-principal-header" class="site-header content" role="banner">
		<div id="titulo-header">
				<h1 class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</h1>
				<h2 class="site-description">
					<?php echo get_bloginfo( 'description', 'display' ) ?>
				</h2>
		</div>
		<div class="content">
			<div class="main-navigation">
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'azsiwp' ); ?></button>
						<?php wp_nav_menu( array( 
						'theme_location' => 'menu-1',
						'menu_class' => 'main-navigation content-margin',
						'menu_id' => 'primary-menu' ) ); ?>
					</nav><!-- #site-navigation -->
			</div>
		</div>
	</header><!-- #menu-principal-header -->

	<div id="content" class="site-content">
