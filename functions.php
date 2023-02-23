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
	define( '_S_VERSION', '0.1.0' );
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
	wp_enqueue_style( 'fmc-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), _S_VERSION );

	wp_enqueue_script( 'flickity', get_template_directory_uri() . '/js/vendor/flickity.js',array('jquery'),_S_VERSION,true);
	wp_enqueue_script( 'smart-banner', get_template_directory_uri() . '/js/vendor/smartbanner.js',array('jquery'),_S_VERSION,true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	};
	if(is_singular('recipes')) {
		wp_enqueue_script( 'rateit-script', get_template_directory_uri() . '/js/vendor/rateit.min.js', array('jquery'), _S_VERSION, true );
	}
	if(is_singular('recipes') || is_singular('product')) {
        wp_enqueue_script( 'validate', get_template_directory_uri() . '/js/vendor/jquery.validate.min.js', array('jquery'), _S_VERSION, true );
    }
}
add_action( 'wp_enqueue_scripts', 'fmc_scripts' );

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

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/includes/woocommerce.php';
}

// Recipe Category

function register_taxonomy_recipe_category() {
	$labels = array(
		'name'              => _x( 'Recipe Category', 'taxonomy general name' ),
		'singular_name'     => _x( 'Recipe Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Categories' ),
		'all_items'         => __( 'All Categories' ),
		'parent_item'       => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item'         => __( 'Edit Category' ),
		'update_item'       => __( 'Update Category' ),
		'add_new_item'      => __( 'Add New Category' ),
		'new_item_name'     => __( 'New Category Name' ),
		'menu_name'         => __( 'Recipe Category' ),
	);
	$args   = array(
		'hierarchical'      => true, // make it hierarchical (like categories)
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => [ 'slug' => 'recipe-category' ],
	);
	register_taxonomy( 'recipe-category', [ 'recipes' ], $args );
}
add_action( 'init', 'register_taxonomy_recipe_category' );

// Recipes custom post type function
function create_posttype() {

    register_post_type( 'recipes',
    // Recipes
        array(
            'labels' => array(
                'name' => 'Recipes',
                'menu_name' => 'Recipes',
                'name_admin_bar' => 'Recipe',
                'add_new_item' => 'Add New Recipe',
                'view_item' => 'View Recipe',
                'edit_item' => 'Edit Recipe',
                'all_items' => 'All Recipes',
                'singular_name' => 'Recipe',
            ),
            'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions'),
            'taxonomies'  => array( 'recipe-category', 'category' ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'recipes'),
            'show_in_rest' => false,
            'menu_icon' => 'dashicons-drumstick'
        )
    );

	register_post_type( 'meal-plans',
    // Meal Plans
        array(
            'labels' => array(
                'name' => 'Meal Plans',
                'menu_name' => 'Meal Plans',
                'name_admin_bar' => 'Meal Plan',
                'add_new_item' => 'Add New Plan',
                'view_item' => 'View Meal Plan',
                'edit_item' => 'Edit Meal Plan',
                'all_items' => 'All Meal Plan',
                'singular_name' => 'Meal Plan',
            ),
            'supports' => array('title', 'editor', 'comments', 'author', 'thumbnail', 'revisions'),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'meal-plans'),
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
}

/**
 * Comment Form Placeholder Author, Email, URL
 */
function placeholder_author_email_url_form_fields($fields) {
    $replace_author = __('Your Name*', 'fmc');
    $replace_email = __('Your Email*', 'fmc');

    $fields['author'] = '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'fmc' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
                    '<input id="author" name="author" type="text" placeholder="'.$replace_author.'" value="' . esc_attr( $commenter['comment_author'] ) . '" size="20"' . $aria_req . ' /></p>';

    $fields['email'] = '<p class="comment-form-email"><label for="email">' . __( 'Email', 'fmc' ) . '</label> ' .
    ( $req ? '<span class="required">*</span>' : '' ) .
    '<input id="email" name="email" type="text" placeholder="'.$replace_email.'" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' /></p>';

    return $fields;
}

add_filter('comment_form_default_fields','placeholder_author_email_url_form_fields');

/**
 * Comment Form Placeholder Comment Field
 */
function placeholder_comment_form_field($fields) {
    $replace_comment = __('Your Comment', 'fmc');

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

// Admin styles - move to individual file

add_action('admin_head', 'admin_styles');

function admin_styles() {
  echo '<style>
	.wp-admin .wp-block {
		max-width: 90%;
	}
	.wp-admin .postbox.acf-postbox div.acf-field-tab, .acf-settings-wrap div.acf-field-tab {
		display: block!important;
		font-size: 0;
		height: 0;
		padding: 0!important;
		opacity: 0;
		pointer-events: none;

	  }
	  .wp-admin .postbox.acf-postbox div.acf-field-tab *, .acf-settings-wrap div.acf-field-tab * {
		pointer-events: none!important;
	  }

/* ACF Chrome bug Fix */

.interface-interface-skeleton__content div.acf-field-tab, .acf-settings-wrap div.acf-field-tab {
	display: block!important;
	font-size: 0;
	height: 0;
	padding: 0!important;
	opacity: 0;
	pointer-events: none;

  }
  .interface-interface-skeleton__content div.acf-field-tab, .acf-settings-wrap div.acf-field-tab * {
	pointer-events: none!important;
  }
  </style>';
}


// Remove Zoom and Lightbox from WooCommerce produt
add_filter( 'woocommerce_single_product_zoom_enabled', '__return_false' );

add_action( 'after_setup_theme', 'remove_wc_gallery_lightbox', 100 );
function remove_wc_gallery_lightbox() {
remove_theme_support( 'wc-product-gallery-lightbox' );
}


add_filter ('add_to_cart_redirect', 'redirect_to_checkout');

function redirect_to_checkout() {
    global $woocommerce;
    $checkout_url = $woocommerce->cart->get_checkout_url();
    return $checkout_url;
}
