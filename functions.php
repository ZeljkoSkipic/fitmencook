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
	define( '_S_VERSION', '1.5.0' );
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
			'primary'  => __( 'Primary', 'fmc' ),
			'menu_404'  => __( '404 Page', 'fmc' ),
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
/**
 * Enqueue scripts and styles.
 */
function fmc_scripts() {
	$css_cache_buster = date("YmdHi", filemtime( get_stylesheet_directory() . '/main.css'));
	$js_cache_buster = date("YmdHi", filemtime( get_stylesheet_directory() . '/js/custom.js'));

	wp_enqueue_style( 'fmc-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/main.css', array(), $css_cache_buster, 'all' );
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), $js_cache_buster );

	$theme_vars = [
		"ajaxUrl" => admin_url('admin-ajax.php'),
		"formID"  => 'UNLNpK',
		"cartUrl" => wc_get_cart_url(),
  		"nonce"  => wp_create_nonce('nonce-security')
	];

	if(is_singular('recipes')) {
		$theme_vars['recipeID'] = get_the_ID();
	}

	wp_localize_script('custom', 'theme' , $theme_vars);

	wp_enqueue_script( 'flickity', get_template_directory_uri() . '/js/vendor/flickity.js',array('jquery'),_S_VERSION,true);
	wp_enqueue_script( 'smart-banner', get_template_directory_uri() . '/js/vendor/smartbanner.js',array('jquery'),_S_VERSION,true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	};
	if(is_singular('recipes') || is_singular('product') || is_singular('meal-plans') || is_post_type_archive('recipes')) {
		wp_enqueue_script( 'rateit-script', get_template_directory_uri() . '/js/vendor/rateit.min.js', array('jquery'), _S_VERSION, true );
	}
	if(is_singular('recipes') || is_singular('meal-plans') || is_singular('product')) {
        wp_enqueue_script( 'validate', get_template_directory_uri() . '/js/vendor/jquery.validate.min.js', array('jquery'), _S_VERSION, true );
    }
}
add_action( 'wp_enqueue_scripts', 'fmc_scripts' );

require_once( get_template_directory(). '/includes/woo-minicart-ajax.php');

function fmc_admin_styles() {
	wp_enqueue_style( 'backend-styles', get_template_directory_uri() . '/admin.css' );
}
add_action( 'admin_enqueue_scripts', 'fmc_admin_styles' );

// Login Styles
function stier_login_styles() {
    wp_enqueue_style( 'login-style', get_template_directory_uri() . '/wp-login.css' );
}
add_action('login_head', 'stier_login_styles');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/includes/template-functions.php';

// Include Widgets

require get_template_directory() . '/includes/widgets-ads.php';


/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/customizer.php';

require get_template_directory() . '/includes/comments.php';

require get_template_directory() . '/includes/yoast/yoast.php';

require_once( get_template_directory(). '/includes/post-types.php' );

require_once( get_template_directory(). '/includes/klaviyoEmailSendAjax.php');

if(is_admin()) {
	require get_template_directory() . '/includes/admin-time-modified.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/includes/woocommerce.php';
}

// Remove URL from comments
add_filter('comment_form_default_fields', 'unset_url_field');
function unset_url_field($fields){
    if(isset($fields['url']))
       unset($fields['url']);
       return $fields;
}


// Blocks

add_action( 'init', 'register_acf_blocks' );
function register_acf_blocks() {
	register_block_type( __DIR__ . '/blocks/hero' );
	register_block_type( __DIR__ . '/blocks/counters' );
	register_block_type( __DIR__ . '/blocks/philosophy' );
	register_block_type( __DIR__ . '/blocks/app-cta' );
	register_block_type( __DIR__ . '/blocks/blurbs' );
    register_block_type( __DIR__ . '/blocks/order' );
	register_block_type( __DIR__ . '/blocks/button' );
	register_block_type( __DIR__ . '/blocks/section' );
	register_block_type( __DIR__ . '/blocks/logo-slide' );
	register_block_type( __DIR__ . '/blocks/fmc-media' );
	register_block_type( __DIR__ . '/blocks/cta-banner' );
	register_block_type( __DIR__ . '/blocks/pi-intro' );
}

/**
 * Comment Form Placeholder Author, Email, URL
 */
function placeholder_author_email_url_form_fields( $fields ) {
	foreach( $fields as &$field ) {
	  $field = str_replace( 'id="author"', 'id="author" placeholder="Your Name*"', $field );
	  $field = str_replace( 'id="email"', 'id="email" placeholder="Your Email*"', $field );
	  $field = str_replace( 'id="url"', 'id="url" placeholder="website"', $field );
	}
	return $fields;
  }
  add_filter( 'comment_form_default_fields', 'placeholder_author_email_url_form_fields' );
/**
 * Comment Form Placeholder Comment Field
 */
function placeholder_comment_form_field($fields) {
    $replace_comment = __("Share your thoughts on the recipe here! Rate below if you've made it", 'fmc');

    $fields['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) .
    '</label><textarea id="comment" name="comment" cols="45" rows="8" placeholder="'.$replace_comment.'" aria-required="true"></textarea></p>';

    return $fields;
 }
add_filter( 'comment_form_defaults', 'placeholder_comment_form_field' );

add_filter( 'comment_form_fields', 'move_comment_field' );
function move_comment_field( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}

// Remove Zoom and Lightbox from WooCommerce produt
add_filter( 'woocommerce_single_product_zoom_enabled', '__return_false' );

add_action( 'after_setup_theme', 'remove_wc_gallery_lightbox', 100 );
function remove_wc_gallery_lightbox() {
remove_theme_support( 'wc-product-gallery-lightbox' );
}


add_filter ('woocommerce_add_to_cart_redirect', 'redirect_to_checkout');

function redirect_to_checkout() {
    global $woocommerce;
    $checkout_url = wc_get_checkout_url();
    return $checkout_url;
}

// Allow iFrames

function allow_iframes( $allowedposttags ){

	$allowedposttags['iframe'] = array(
		'align' => true,
		'allow' => true,
		'allowfullscreen' => true,
		'class' => true,
		'frameborder' => true,
		'height' => true,
		'id' => true,
		'marginheight' => true,
		'marginwidth' => true,
		'name' => true,
		'scrolling' => true,
		'src' => true,
		'style' => true,
		'width' => true,
		'allowFullScreen' => true,
		'class' => true,
		'frameborder' => true,
		'height' => true,
		'mozallowfullscreen' => true,
		'src' => true,
		'title' => true,
		'webkitAllowFullScreen' => true,
		'width' => true
	);

	return $allowedposttags;
}

add_filter( 'wp_kses_allowed_html', 'allow_iframes', 1 );



// Add TinyMCE editor button to Highlight the text
add_action( 'after_setup_theme', 'fitmencook_theme_setup' );

if ( ! function_exists( 'fitmencook_theme_setup' ) ) {
	function fitmencook_theme_setup(){
		/********* Registers an editor stylesheet for the theme ***********/
		add_action( 'admin_init', 'fitmencook_theme_add_editor_styles' );
		/********* TinyMCE Buttons ***********/
		add_action( 'init', 'fitmencook_buttons' );
	}
}

/********* Registers an editor stylesheet for the theme ***********/
if ( ! function_exists( 'fitmencook_theme_add_editor_styles' ) ) {
	function fitmencook_theme_add_editor_styles() {
	    add_editor_style( 'admin.css' );
	}
}

/********* TinyMCE Buttons ***********/
if ( ! function_exists( 'fitmencook_buttons' ) ) {
	function fitmencook_buttons() {
		if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
	        return;
	    }

	    if ( get_user_option( 'rich_editing' ) !== 'true' ) {
	        return;
	    }

	    add_filter( 'mce_external_plugins', 'fitmencook_add_buttons' );
	    add_filter( 'mce_buttons', 'fitmencook_register_buttons' );
	}
}

if ( ! function_exists( 'fitmencook_add_buttons' ) ) {
	function fitmencook_add_buttons( $plugin_array ) {
	    $plugin_array['highlight'] = get_template_directory_uri().'/js/tinymce_buttons.js';
	    return $plugin_array;
	}
}

if ( ! function_exists( 'fitmencook_register_buttons' ) ) {
	function fitmencook_register_buttons( $buttons ) {
	    array_push( $buttons, 'highlight' );
	    return $buttons;
	}
}
