<?php
	/**
	 * The header for our theme
	 *
	 * This is the template that displays all of the <head> section and everything up until <div id="content">
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package Westerner_Park
	 */

	$social_media = get_field('social_media', 'option');
	$facebook = $social_media['facebook'];
	$instagram = $social_media['instagram'];
	$twitter = $social_media['twitter'];
	$linkedin = $social_media['linkedin'];

	$custom_scripts = get_field('custom_scripts', 'option');
	$in_head = $custom_scripts['in_head'];

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>

	<?php echo $in_head; ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<header id="masthead" class="site-header">
		<div class="navigation-container container-xl">
			<div class="site-branding">
				<?php if ( has_custom_logo() ) : 
						the_custom_logo();
					else : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>					
				<?php endif;?>				
			</div><!-- .site-branding -->
			<nav id="site-navigation" class="main-navigation">
				<div class="top-navigation social-media">
					<?php if($facebook): ?>
						<a target="_blank" href="<?php echo $facebook;?>"><?php echo file_get_contents( get_template_directory_uri() . '/images/facebook.svg' ); ?></a>
					<?php endif; ?>
					<?php if($instagram): ?>
						<a target="_blank" href="<?php echo $instagram;?>"><?php echo file_get_contents( get_template_directory_uri() . '/images/instagram.svg' ); ?></a>
					<?php endif; ?>
					<?php if($twitter): ?>
						<a target="_blank" href="<?php echo $twitter;?>"><?php echo file_get_contents( get_template_directory_uri() . '/images/twitter.svg' ); ?></a>
					<?php endif; ?>
					<?php if($linkedin): ?>
						<a target="_blank" href="<?php echo $linkedin;?>"><?php echo file_get_contents( get_template_directory_uri() . '/images/linkedin.svg' ); ?></a>
					<?php endif; ?>
				</div>
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
					<span class="bar"></span>
					<span class="bar"></span>
					<span class="bar"></span>
				</button>
				<?php
					wp_nav_menu(array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'walker' => new Image_Walker_Nav_Menu()
					));
				?>
			</nav><!-- #site-navigation -->
		</div>
	</header>

	<!-- Banners -->
	<?php
		if ($args){
			$title = $args['name'];
			$image = $args['image'];
		} else {
			$title = "";
			$image = "";
		}
		if ( is_front_page() ) : 
			get_template_part("components/banners/banner-home", null, array()); 
		else:
			get_template_part("components/banners/banner-inner", null, array('title'=> $title, 'image'=> $image)); 
		endif;

		// Side Buttons
		get_template_part("template-parts/floating-buttons", null, array()); 
	?> 