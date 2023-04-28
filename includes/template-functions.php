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
        'page_title'    => 'External Scripts - Tracking Codes',
        'menu_title'    => 'External Scripts',
        'parent_slug'   => 'theme-general-settings',
    ));

	acf_add_options_sub_page(array(
        'page_title'    => 'Meal Plans Archive',
        'menu_title'    => 'MP Archive',
        'parent_slug'   => 'edit.php?post_type=meal-plans',
    ));

	acf_add_options_sub_page(array(
        'page_title'    => 'Shop Archive',
        'menu_title'    => 'Shop Archive',
        'parent_slug'   => 'edit.php?post_type=product',
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

function get_avarage_rating($post_ID, $style, $return_just_rating = false)
{
  $comments = get_comments(array('post_id' => $post_ID, 'status' => 'approve', 'parent' => 0));
  $comments_total = count($comments);
  $rating = 0;
  $avg_rating = 0;

  if ($comments_total > 0) {
    foreach ($comments as $comment) {

      if($comment->comment_parent != 0) continue;

      $comment_rating = (float) get_comment_meta($comment->comment_ID, 'rating', true);
      $rating += $comment_rating;
    }

    $avg_rating = number_format($rating / $comments_total, 1);
  }

  if ($return_just_rating === true) {
    return $avg_rating;
  }

  get_template_part('template-parts/avg-rating', "", ['comments_number' => $comments_total, 'rating' => $avg_rating, 'style' => $style]);
}


// Meal Plan Customize Global Query

function meal_plans_global_query( $query ) {
	if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'meal-plans' ) ) {
	  $query->set( 'posts_per_page', 4 );
	  return;
	}
  }
  add_action( 'pre_get_posts', 'meal_plans_global_query', 1 );


// Meal Plan calculations

function meal_plan_calculations()
{
	$l_prep_time = get_field('l_prep_time', 'option');
	$l_cook_time = get_field('l_cook_time', 'option');
	$l_total_time = get_field('l_total_time', 'option');
	$minutes = get_field('minutes', 'option');
	$l_calories = get_field('l_calories', 'option');
	$l_protein = get_field('l_protein', 'option');
	$l_fat = get_field('l_fat', 'option');
	$l_carbs = get_field('l_carbs', 'option');
	$l_sodium = get_field('l_sodium', 'option');
	$l_fiber = get_field('l_fiber', 'option');
	$l_sugar = get_field('l_sugar', 'option');

	$total_calories = 0;
	$total_proteins = 0;
	$total_fat = 0;
	$total_carbs = 0;
	$total_sodium = 0;
	$total_fiber = 0;
	$total_sugar = 0;
	$total_time = 0;
	$total_prep_time = 0;
	$total_cook_time = 0;
	$total_prep_hours = 0;
	$total_cook_hours = 0;
	$hours_totals = 0;
	$totals = [];
	$total_times = [];

	$existing_recipes = get_field('existing_recipe', get_the_ID());
	$custom_recipes = get_field('custom_recipe', get_the_ID());

	if ($existing_recipes) {

		foreach ($existing_recipes as $existing_recipe) {
			$existing_recipe_ID =  $existing_recipe['recipe'][0]->ID;
			$total_time_recipe = (float) get_field('total_time', $existing_recipe_ID);
			$total_time_prep_recipe = (float) get_field('prep_time', $existing_recipe_ID);
			$total_time_cook_recipe = (float) get_field('cook_time', $existing_recipe_ID);
			$prep_hours = (float) get_field('prep_hours', $existing_recipe_ID);
			$cook_hours = (float) get_field('cook_hours', $existing_recipe_ID);
			$total_hours = (float) get_field('total_hours', $existing_recipe_ID);
			$calories = (float) get_field('calories', $existing_recipe_ID);
			$protein = (float) get_field('protein', $existing_recipe_ID);
			$fat = (float) get_field('fat', $existing_recipe_ID);
			$carbs = (float) get_field('carbs', $existing_recipe_ID);
			$sodium = (float) get_field('sodium', $existing_recipe_ID);
			$fiber = (float) get_field('fiber', $existing_recipe_ID);
			$sugar = (float) get_field('sugar', $existing_recipe_ID);

			$total_time += $total_time_recipe;
			$total_prep_time +=  $total_time_prep_recipe;
			$total_cook_time +=  $total_time_cook_recipe;
			$total_prep_hours += $prep_hours;
			$total_cook_hours += $cook_hours;
			$hours_totals += $total_hours;

			$total_calories += $calories;
			$total_proteins += $protein;
			$total_fat += $fat;
			$total_carbs += $carbs;
			$total_sodium += $sodium;
			$total_fiber += $fiber;
			$total_sugar += $sugar;
		}
	}



	if ($custom_recipes) {
		foreach ($custom_recipes as $custom_recipe) {
			$cr_total_time = (float) $custom_recipe['cr_total_time'];
			$cr_prep_time = (float) $custom_recipe['cr_prep_time'];
			$cr_cook_time = (float) $custom_recipe['cr_cook_time'];
			$cr_prep_hours = (float) $custom_recipe['cr_prep_hours'];
			$cr_cook_hours = (float) $custom_recipe['cr_cook_hours'];
			$cr_total_hours = (float) $custom_recipe['cr_total_hours'];
			$cr_calories = (float) $custom_recipe['cr_calories'];
			$cr_protein = (float) $custom_recipe['cr_protein'];
			$cr_fat = (float) $custom_recipe['cr_fat'];
			$cr_carbs = (float) $custom_recipe['cr_carbs'];
			$cr_sodium = (float) $custom_recipe['cr_sodium'];
			$cr_fiber = (float) $custom_recipe['cr_fiber'];
			$cr_sugar = (float) $custom_recipe['cr_sugar'];

			$total_time += $cr_total_time;
			$total_prep_time +=  $cr_prep_time;
			$total_cook_time +=  $cr_cook_time;
			$total_prep_hours += $cr_prep_hours;
			$total_cook_hours += $cr_cook_hours;
			$hours_totals += $cr_total_hours;

			$total_calories += $cr_calories;
			$total_proteins += $cr_protein;
			$total_fat += $cr_fat;
			$total_carbs += $cr_carbs;
			$total_sodium += $cr_sodium;
			$total_fiber += $cr_fiber;
			$total_sugar += $cr_sugar;
		}
	}


	// Macros
	$totals[$l_calories] = $total_calories ? $total_calories . __('cal', 'fitmencook') : 0;
	$totals[$l_protein] = $total_proteins ? $total_proteins . __('g', 'fitmencook') : 0;
	$totals[$l_fat] = $total_fat ?  $total_fat . __('g', 'fitmencook') : 0;
	$totals[$l_carbs] = $total_carbs ? $total_carbs . __('g', 'fitmencook') : 0;
	$totals[$l_sodium] = $total_sodium ?  $total_sodium . __('mg', 'fitmencook') : 0;
	$totals[$l_fiber] = $total_fiber ? $total_fiber . __('g', 'fitmencook') : 0;
	$totals[$l_sugar] = $total_sugar ? $total_sugar . __('g', 'fitmencook') : 0;


	// Time

	// Convert minutes to hours and leftover minutes join prep times

	$hours_prep = floor($total_prep_time / 60);
	$leftover_minutes_cook = ($total_prep_time -   floor($total_prep_time / 60) * 60);

	$total_times['prep_times'] = [
		'label' => $l_prep_time,
		'min'   => ($leftover_minutes_cook) ?  $leftover_minutes_cook . '' . $minutes : 0,
		'hours' => ($total_prep_hours + $hours_prep) ?  ($total_prep_hours + $hours_prep) . "h" : 0
	];

	// Convert minutes to hours and leftover minutes join cook times

	$hours_cook = floor($total_cook_time / 60);
	$leftover_minutes_cook = ($total_cook_time -   floor($total_cook_time / 60) * 60);


	$total_times['cook_times'] = [
		'label' => $l_cook_time,
		'min'   => $leftover_minutes_cook ? $leftover_minutes_cook . '' . $minutes : 0,
		'hours' => ($total_cook_hours + $hours_cook) ? ($total_cook_hours + $hours_cook) . "h" : 0
	];

	// Convert minutes to hours and leftover minutes join total times

	$hours_total = floor($total_time / 60);
	$leftover_minutes_total = ($total_time -   floor($total_time / 60) * 60);

	$total_times['totals'] = [
		'label' => $l_total_time,
		'min'   => $leftover_minutes_total ?  $leftover_minutes_total . '' . $minutes : 0,
		'hours' => ($hours_totals + $hours_total) ?  ($hours_totals + $hours_total) . "h" : 0
	];


	return [
		'total_times' => $total_times,
		'totals'      => $totals
	];
}


// Email when recipe is created

add_action('save_post_recipes', 'send_email_recipe_created', 10, 3);

function send_email_recipe_created($post_ID, $post, $update)
{
	$recipient_email = get_field('translator_email', 'option');

    if (wp_is_post_revision($post_ID)) return;

    $is_email_sent = get_post_meta($post_ID, 'email_sent', true);
    $post_status = get_post_status($post);

    if (!$is_email_sent && $post_status == 'publish') {
        $to = $recipient_email;
        $subject = $post->post_title;
        $headers[] = 'Content-Type: text/html; charset=UTF-8';

        ob_start();
        get_template_part('template-parts/email', 'template', ['post' => $post]);
        $message = ob_get_clean();
        $email = wp_mail($to, $subject, $message, $headers);

        if ($email) {
            add_post_meta($post_ID, 'email_sent', 1);
        }
    }
}
