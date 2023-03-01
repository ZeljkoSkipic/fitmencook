<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package fitmencook
 */

/**r
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function fmc_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'fmc_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function fmc_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'fmc_pingback_header' );


/* Pagination with numbers */

function fmc_pagination() {

    if( is_singular() )
        return;

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;

    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<div class="pagination"><ul>' . "\n";

    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li class="prev">%s</li>' . "\n", get_previous_posts_link() );

    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }

    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }

    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";

        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }

    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li class="next">%s</li>' . "\n", get_next_posts_link() );

    echo '</ul></div>' . "\n";

}


// Theme Options

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> 'Site General Settings',
		'menu_title'	=> 'Website Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
		'position' => '2.69',
		'icon_url' => 'dashicons-buddicons-topics'
	));
	acf_add_options_sub_page(array(
        'page_title'    => 'Header Settings',
        'menu_title'    => 'Header',
        'parent_slug'   => 'theme-general-settings',
    ));
    acf_add_options_sub_page(array(
        'page_title'    => 'Language Settings',
        'menu_title'    => 'Language',
        'parent_slug'   => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'App Banner and Badges Settings',
        'menu_title'    => 'App',
        'parent_slug'   => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Footer Settings',
        'menu_title'    => 'Footer',
        'parent_slug'   => 'theme-general-settings',
    ));

	acf_add_options_sub_page(array(
        'page_title'    => 'Meal Plans Archive',
        'menu_title'    => 'Archive',
        'parent_slug'   => 'edit.php?post_type=meal-plans',
    ));

}

// Load recipe-print template for printing option

add_filter( 'template_include', 'load_print_template', 99 );
function load_print_template( $template ) {
    if ( is_singular( 'recipes' ) && isset($_GET['print']) && $_GET['print'] ) {
        $new_template = locate_template( array( 'single-recipes-print.php' ) );
	if ( '' != $new_template ) {
	    return $new_template ;
	}
    }
    return $template;
}


// Image size

add_action( 'after_setup_theme', 'fmc_theme_setup' );
function fmc_theme_setup() {
	add_image_size( 'fmc-post-featured', 1210, 600, true );
}

// Get average rating

function get_avarage_rating ($post_ID, $style, $return_just_rating = false) {
    $comments = get_comments( array( 'post_id' => $post_ID ) );
    $comments_total = count($comments);
    $rating = 0;
    $avg_rating = 0;

    if($comments_total > 0) {
        foreach($comments as $comment) {

            $comment_rating = (float) get_comment_meta($comment->comment_ID, 'rating', true);
            $rating += $comment_rating;
        }

        $avg_rating = number_format($rating / $comments_total, 1);
    }

    if($return_just_rating === true) {
        return $avg_rating;

    }

    get_template_part('template-parts/avg-rating', "" , ['comments_number' => $comments_total, 'rating' => $avg_rating, 'style' => $style ]);

}
