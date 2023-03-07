<?php

function fmc_widgets_init() {

	// Blog Sidebar

	register_sidebar( array(
        'name' => __( 'Blog AD 1', 'fmc' ),
        'id' => 'blog_ad_1',
        'description' => __( 'Displays in the sidebar of Single Post', 'fmc' ),
        'before_widget' => '<div class="fmc_ps_widget">',
		'after_widget' => '</div>',
    ) );

	register_sidebar( array(
        'name' => __( 'Blog AD 2', 'fmc' ),
        'id' => 'blog_ad_2',
        'description' => __( 'Displays in the sidebar of Single Post', 'fmc' ),
        'before_widget' => '<div class="fmc_ps_widget">',
		'after_widget' => '</div>',
    ) );

    /* -- Footer Widgets -- */

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

	// ADS

	register_sidebar( array(
        'name' => __( 'Home Ad 1', 'fmc' ),
        'id' => 'ad1',
        'description' => __( 'Displayed at Homepage below Featured Recipes', 'fmc' ),
		'before_widget' => '<div class="fmc_container fmc_page_ad home_ad_1">',
        'after_widget' => '</div>',
		) );

    register_sidebar( array(
        'name' => __( 'Home Ad 2', 'fmc' ),
        'id' => 'ad2',
        'description' => __( 'Displayed at Homepage below Home Products', 'fmc' ),
        'before_widget' => '<div class="fmc_container fmc_page_ad home_ad_2 spacing_0_1">',
        'after_widget' => '</div>',
        ) );

	register_sidebar( array(
		'name' => __( 'Recipe Ad 1', 'fmc' ),
		'id' => 'ad3',
		'description' => __( 'Displayed at Single Recipe after the Ingredients', 'fmc' ),
		'before_widget' => '<div class="fmc_recipe_ad recipe_ad_1 spacing_0_1">',
		'after_widget' => '</div>',
	) );
	register_sidebar( array(
		'name' => __( 'Recipe Ad 2', 'fmc' ),
		'id' => 'ad4',
		'description' => __( 'Displayed at Single Recipe after the Ingredients', 'fmc' ),
		'before_widget' => '<div class="fmc_recipe_ad recipe_ad_2">',
		'after_widget' => '</div>',
	) );

	register_sidebar( array(
		'name' => __( 'Recipe & Meal Plan Ad Sidebar', 'fmc' ),
		'id' => 'ad5',
		'description' => __( 'Displayed at Archive, Category, Recipes and Meal Plan in the Sidebar', 'fmc' ),
		'before_widget' => '<div class="fmc_recipe_ad recipe_ad_sidebar spacing_2_0">',
		'after_widget' => '</div>',
	) );

	register_sidebar( array(
		'name' => __( 'Recipe Ad After Featured', 'fmc' ),
		'id' => 'ad6',
		'description' => __( 'Displayed at Archive, after Featured Recipe', 'fmc' ),
		'before_widget' => '<div class="fmc_recipe_ad recipe_ad_after_featured">',
		'after_widget' => '</div>',
	) );

	register_sidebar( array(
		'name' => __( 'Meal Plan Ad After Existing Recipe', 'fmc' ),
		'id' => 'ad7',
		'description' => __( 'Displayed at Meal Plan, after Existing Recipes', 'fmc' ),
		'before_widget' => '<div class="fmc_mp_ad mp_ad_after_existing">',
		'after_widget' => '</div>',
	) );

	register_sidebar( array(
		'name' => __( 'Meal Plan Ad After Custom Recipe', 'fmc' ),
		'id' => 'ad8',
		'description' => __( 'Displayed at Meal Plan, after Custom Recipes', 'fmc' ),
		'before_widget' => '<div class="fmc_mp_ad mp_ad_after_custom">',
		'after_widget' => '</div>',
	) );

}
add_action( 'widgets_init', 'fmc_widgets_init' );
