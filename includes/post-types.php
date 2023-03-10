<?php

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
		'rewrite' => [
			'slug' => (!empty(get_option('fmc_recipe_cat_slug'))) ? get_option('fmc_recipe_cat_slug') : 'recipe-category',
			'with_front' => false
		],
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
            'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'permalink'),
            'taxonomies'  => array( 'recipe-category' ),
            'public' => true,
            'has_archive' => true,
			'rewrite' => [
				'slug' => (!empty(get_option('fmc_recipe_slug'))) ? get_option('fmc_recipe_slug') : 'recipes',
				'with_front' => false
			],
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
            'rewrite' => array('slug' => 'meal-plans', 'with_front' => false),
            'show_in_rest' => false,
            'menu_icon' => 'dashicons-food'
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );


// Add setting
add_action('admin_init', function() {
	add_settings_field('fmc_recipe_slug', __('Recipes base', 'txtdomain'), 'recipe_slug_output', 'permalink', 'optional');
	add_settings_field('fmc_recipe_cat_slug', __('Recipes Category base', 'txtdomain'), 'recipe_cat_slug_output', 'permalink', 'optional');
});

// Setting output
function recipe_slug_output() {	?>
	<input name="fmc_recipe_slug" type="text" class="regular-text code" value="<?php echo esc_attr(get_option('fmc_recipe_slug')); ?>" placeholder="<?php echo 'recipes'; ?>" />
<?php }

// Setting output
function recipe_cat_slug_output() {	?>
	<input name="fmc_recipe_cat_slug" type="text" class="regular-text code" value="<?php echo esc_attr(get_option('fmc_recipe_cat_slug')); ?>" placeholder="<?php echo 'recipe-category'; ?>" />
<?php }

// Save setting
add_action('admin_init', function() {
    if (isset($_POST['permalink_structure'])) {
        update_option('fmc_recipe_slug', trim($_POST['fmc_recipe_slug']));
		update_option('fmc_recipe_cat_slug', trim($_POST['fmc_recipe_cat_slug']));
    }
});
