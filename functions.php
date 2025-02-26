<?php
/**
 * Westerner Days functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Westerner_Park
 */


//Set up Custom Fields specific to theme
require_once dirname( __FILE__ ) . '/inc/custom-content/post-types.php';
require_once dirname( __FILE__ ) . '/inc/custom-content/custom-fields.php';

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function westerner_days_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Westerner Days, use a find and replace
		* to change 'westerner-days' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'westerner-days', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'westerner-days' ),
			'footer' => esc_html__( 'Footer', 'westerner-days' ),
			'inner-menu-1' => esc_html__( 'Inner Menu 1', 'westerner-days' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'westerner_days_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'westerner_days_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function westerner_days_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'westerner_days_content_width', 640 );
}
add_action( 'after_setup_theme', 'westerner_days_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function westerner_days_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'westerner-days' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'westerner-days' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'westerner_days_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function westerner_days_scripts() {
	wp_enqueue_style( 'westerner-days-style', get_stylesheet_directory_uri() . '/css/style.css', array(), date('H:i') );
	wp_style_add_data( 'westerner-days-style', 'rtl', 'replace' );
    wp_enqueue_style( 'westerner-days-style' );

	//google font script    
	wp_enqueue_style('google-fonts','https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Open+Sans:wght@400;500;600;700&family=Roboto+Slab:wght@300;400;500;600;700&display=swap');
	
	//Swiper (slider) css file
	wp_enqueue_style( 'swiper-style', get_stylesheet_directory_uri() . '/css/swiper-bundle.min.css', array() );

	//swiper local JS file
	wp_enqueue_script( 'swiper-scripts', get_stylesheet_directory_uri() . '/js/swiper-bundle.min.js', array('jquery') );

	//bootstrap local JS file
	wp_enqueue_script( 'bootstrap-scripts', get_stylesheet_directory_uri() . '/js/bootstrap.bundle.min.js', array('jquery') );
	
	//main js
	wp_enqueue_script( 'westerner-days-mainjs', get_stylesheet_directory_uri() . '/js/main.js', array('jquery'), _S_VERSION, true );
	
	//navigation
	wp_enqueue_script( 'westerner-days-navigation', get_stylesheet_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	//Map
	wp_register_script( 'leaflet_script', get_stylesheet_directory_uri() . '/js/leaflet/leaflet.js', null, null, true );
	wp_enqueue_script('leaflet_script');

	wp_register_style( 'leaflet_style', get_stylesheet_directory_uri() . '/css/leaflet/leaflet.css' );
	wp_enqueue_style('leaflet_style'); 
	
	wp_enqueue_script( 'westerner-days-map', get_stylesheet_directory_uri() . '/js/map.js', array(), _S_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'westerner_days_scripts' );

// Allow SVG and
function upload_new_files( $allowed ) {
    if ( !current_user_can( 'manage_options' ) )
        return $allowed;
    $allowed['svg'] = 'image/svg+xml';
	$allowed['json'] = 'application/json';
	
    return $allowed;
}
add_filter( 'upload_mimes', 'upload_new_files');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

add_filter( 'wpseo_metabox_prio', 'lower_yoast_metabox_priority' );

/**
 * Lowers the metabox priority to 'core' for Yoast SEO's metabox.
 *
 * @param string $priority The current priority.
 *
 * @return string $priority The potentially altered priority.
 */
function lower_yoast_metabox_priority( $priority ) {
  return 'core';
}

class Image_Walker_Nav_Menu extends Walker_Nav_Menu {

    function start_lvl(&$output, $depth = 0, $args = array()) {
        // Start the submenu level
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu sub-menu-level-$depth\">\n";
    }

    function end_lvl(&$output, $depth = 0, $args = array()) {
        // End the submenu level
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        // Custom HTML for menu item start
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . ' item-level-'. $depth . '"' : '';

        $output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $class_names . '>';

        // Check if is not the top-level item
		if ($depth > 0) {
            // Get the page or post ID associated with the menu item
            $post_id = $item->object_id;

            // Check if the post ID is valid
            if ($post_id) {
                // Get the featured image URL
                $featured_image_url = get_the_post_thumbnail_url($post_id, 'large'); // 'thumbnail' is the image size, you can change it as needed

                // Output the image if available
                if ($featured_image_url) {
                    $output .= '<img id="image-' . $item->ID . '" src="' . esc_url($featured_image_url) . '" alt="' . esc_attr($item->title) . '" class="menu-item-image target-image">';
                } else {
                    // $output .= '<span>No Image ID=' . $post_id  . '</span>';
				}
            }  
        }

        // Output the menu item's link
        // $title = apply_filters('the_title', $item->title, $item->ID);
        // $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        // $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
		// $attributes .= ' id="link-' . $item->ID . '"';
		// $attributes .= ' class="navigation-link"';
        // $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        // $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

        // $item_output = $args->before;
        // $item_output .= '<a' . $attributes . '>';
        // $item_output .= $args->link_before . $title . $args->link_after;
		// if ($depth == 0 && $this->has_children) {
		// 	$item_output .= '<span class="dropdown-arrow"><svg width="10" height="14" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.146433 0.133132C-0.0488004 0.310617 -0.0488338 0.598434 0.146466 0.77595L4.7929 4.99989L0.146433 9.22405C-0.0488 9.40153 -0.0488334 9.68935 0.146467 9.86686C0.341733 10.0444 0.6583 10.0444 0.853567 9.86686L5.85357 5.32129C5.94733 5.23604 6 5.12044 6 4.99989C6 4.87935 5.9473 4.76371 5.85353 4.6785L0.853533 0.133162C0.6583 -0.0443831 0.3417 -0.0443831 0.146433 0.133132Z" fill="currentColor"/></svg></span>';
		// }
        // $item_output .= '</a>';
        // $item_output .= $args->after;

        // $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);

		$title = apply_filters('the_title', $item->title ?? '', $item->ID ?? 0);

		$attributes = '';
		$attributes .= !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
		$attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
		$attributes .= ' id="link-' . ($item->ID ?? '') . '"';
		$attributes .= ' class="navigation-link"';
		$attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
		$attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

		$item_output = $args->before ?? '';
		$item_output .= '<a' . $attributes . '>';
		$item_output .= ($args->link_before ?? '') . $title . ($args->link_after ?? '');

		if ($depth === 0 && !empty($this->has_children)) {
			$item_output .= '<span class="dropdown-arrow">
				<svg width="10" height="14" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M0.146433 0.133132C-0.0488004 0.310617 -0.0488338 0.598434 0.146466 0.77595L4.7929 4.99989L0.146433 9.22405C-0.0488 9.40153 -0.0488334 9.68935 0.146467 9.86686C0.341733 10.0444 0.6583 10.0444 0.853567 9.86686L5.85357 5.32129C5.94733 5.23604 6 5.12044 6 4.99989C6 4.87935 5.9473 4.76371 5.85353 4.6785L0.853533 0.133162C0.6583 -0.0443831 0.3417 -0.0443831 0.146433 0.133132Z" fill="currentColor"/>
				</svg>
			</span>';
		}

		$item_output .= '</a>';
		$item_output .= $args->after ?? '';

		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}