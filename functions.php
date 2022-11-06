<?php
/**
 * fitmencook functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package fitmencook
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '0.0.1' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function fmc_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on fitmencook, use a find and replace
		* to change 'fmc' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'fmc', get_template_directory() . '/languages' );

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
			'primary-left'  => __( 'Primary Left', 'fmc' ),
			'primary-right'  => __( 'Primary Right', 'fmc' ),
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
			'height'      => 160,
			'width'       => 210,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'fmc_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fmc_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'fmc_content_width', 640 );
}
add_action( 'after_setup_theme', 'fmc_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fmc_widgets_init() {


    /* -- Footer Widgets -- */

	register_sidebar( array(
        'name' => __( 'App Left', 'fmc' ),
        'id' => 'app-left',
        'description' => __( 'Displays in the footer', 'fmc' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

	register_sidebar( array(
        'name' => __( 'Footer Before 1', 'fmc' ),
        'id' => 'footer-before-1',
        'description' => __( 'Displays in the footer', 'fmc' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

	register_sidebar( array(
        'name' => __( 'Footer Before 2', 'fmc' ),
        'id' => 'footer-before-2',
        'description' => __( 'Displays in the footer', 'fmc' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Widget 1', 'fmc' ),
        'id' => 'footer-1',
        'description' => __( 'Displays in the footer', 'fmc' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Widget 2', 'fmc' ),
        'id' => 'footer-2',
        'description' => __( 'Displays in the footer', 'fmc' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Widget 3', 'fmc' ),
        'id' => 'footer-3',
        'description' => __( 'Displays in the footer', 'fmc' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Widget 4', 'fmc' ),
        'id' => 'footer-4',
        'description' => __( 'Displays in the footer', 'fmc' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

	register_sidebar( array(
        'name' => __( 'Copyright', 'fmc' ),
        'id' => 'copy',
        'description' => __( 'Displays in the footer', 'fmc' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
}
add_action( 'widgets_init', 'fmc_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function fmc_scripts() {
	wp_enqueue_style( 'fmc-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), _S_VERSION );

	wp_enqueue_script( 'flickity', get_template_directory_uri() . '/js/vendor/flickity.js',array('jquery'),_S_VERSION,true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'fmc_scripts' );

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
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

// Recipes custom post type function
function create_posttype() {

    register_post_type( 'recipes',
    // CPT Options
        array(
            'labels' => array(
                'name' => 'Recipes',
                'menu_name' => 'Recipes',
                'name_admin_bar' => 'Recipe',
                'add_new_item' => 'Add New Recipe',
                'view_item' => 'View Recipe',
                'edit_item' => 'Edit Recipe',
                'all_items' => 'All Recipes',
                'singular_name' => 'Recipe'
            ),
            'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions'),
            'taxonomies'  => array( 'category' ),
            'public' => true,
            'has_archive' => false,
            'rewrite' => array('slug' => 'recipes'),
            'show_in_rest' => false,
            'menu_icon' => 'dashicons-food'
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

// Remove URL from comments
add_filter('comment_form_default_fields', 'unset_url_field');
function unset_url_field($fields){
    if(isset($fields['url']))
       unset($fields['url']);
       return $fields;
}


// Set Up ACF Local JSON

add_filter('acf/settings/save_json', 'my_acf_json_save_point');

function my_acf_json_save_point( $path ) {

    // update path
    $path = get_stylesheet_directory() . '/acf-json';


    // return
    return $path;

}

add_filter('acf/settings/load_json', 'my_acf_json_load_point');

function my_acf_json_load_point( $paths ) {

    // remove original path (optional)
    unset($paths[0]);


    // append path
    $paths[] = get_stylesheet_directory() . '/acf-json';


    // return
    return $paths;

}
