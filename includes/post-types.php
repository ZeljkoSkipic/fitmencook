<?php

// Recipe Category

function register_taxonomy_recipe_category() {
	$labels = array(
		'name' => 'Recipe Category',
		'singular_name' => 'Recipe Category',
		'menu_name' => 'Recipe Category',
		'all_items' => 'All Recipe Category',
		'edit_item' => 'Edit Recipe Category',
		'view_item' => 'View Recipe Category',
		'update_item' => 'Update Recipe Category',
		'add_new_item' => 'Add New Recipe Category',
		'new_item_name' => 'New Recipe Category Name',
		'parent_item' => 'Parent Recipe Category',
		'search_items' => 'Search Recipe Category',
		'popular_items' => 'Popular Recipe Category',
		'separate_items_with_commas' => 'Separate recipe category with commas',
		'add_or_remove_items' => 'Add or remove recipe category',
		'choose_from_most_used' => 'Choose from the most used recipe category',
		'not_found' => 'No recipe category found',
		'no_terms' => 'No recipe category',
		'filter_by_item' => 'Filter by recipe category',
		'items_list_navigation' => 'Recipe Category list navigation',
		'items_list' => 'Recipe Category list',
		'back_to_items' => '← Go to recipe category',
		'item_link' => 'Recipe Category Link',
		'item_link_description' => 'A link to a recipe category',
	);
	$args   = array(
		'hierarchical'      => true, // make it hierarchical (like categories)
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'default_term' => array(
			'name' => 'Uncategorized',
			'slug' => 'uncategorized',
		),
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
				'singular_name' => 'Recipe',
				'menu_name' => 'Recipes',
				'all_items' => 'All Recipes',
				'edit_item' => 'Edit Recipe',
				'view_item' => 'View Recipe',
				'view_items' => 'View Recipes',
				'add_new_item' => 'Add New Recipe',
				'add_new' => 'Add New Recipe',
				'new_item' => 'New Recipe',
				'parent_item_colon' => 'Parent Recipe:',
				'search_items' => 'Search Recipes',
				'not_found' => 'No recipes found',
				'not_found_in_trash' => 'No recipes found in Trash',
				'archives' => 'Recipe Archives',
				'attributes' => 'Recipe Attributes',
				'insert_into_item' => 'Insert into recipe',
				'uploaded_to_this_item' => 'Uploaded to this recipe',
				'filter_items_list' => 'Filter recipes list',
				'filter_by_date' => 'Filter recipes by date',
				'items_list_navigation' => 'Recipes list navigation',
				'items_list' => 'Recipes list',
				'item_published' => 'Recipe published',
				'item_published_privately' => 'Recipe published privately.',
				'item_reverted_to_draft' => 'Recipe reverted to draft.',
				'item_scheduled' => 'Recipe scheduled.',
				'item_updated' => 'Recipe updated.',
				'item_link' => 'Recipe Link',
				'item_link_description' => 'A link to a recipe.',
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
				'singular_name' => 'Meal Plan',
				'menu_name' => 'Meal Plans',
				'all_items' => 'All Meal Plans',
				'edit_item' => 'Edit Meal Plan',
				'view_item' => 'View Meal Plan',
				'view_items' => 'View Meal Plans',
				'add_new_item' => 'Add New Meal Plan',
				'new_item' => 'New Meal Plan',
				'parent_item_colon' => 'Parent Meal Plan:',
				'search_items' => 'Search Meal Plans',
				'not_found' => 'No meal plans found',
				'not_found_in_trash' => 'No meal plans found in Trash',
				'archives' => 'Meal Plan Archives',
				'attributes' => 'Meal Plan Attributes',
				'insert_into_item' => 'Insert into meal plan',
				'uploaded_to_this_item' => 'Uploaded to this meal plan',
				'filter_items_list' => 'Filter meal plans list',
				'filter_by_date' => 'Filter meal plans by date',
				'items_list_navigation' => 'Meal Plans list navigation',
				'items_list' => 'Meal Plans list',
				'item_published' => 'Meal Plan published',
				'item_published_privately' => 'Meal Plan published privately.',
				'item_reverted_to_draft' => 'Meal Plan reverted to draft.',
				'item_scheduled' => 'Meal Plan scheduled.',
				'item_updated' => 'Meal Plan updated.',
				'item_link' => 'Meal Plan Link',
				'item_link_description' => 'A link to a meal plan.',
            ),
            'supports' => array('title', 'editor', 'comments', 'author', 'thumbnail', 'revisions'),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'meal-plans', 'with_front' => false),
            'show_in_rest' => false,
            'menu_icon' => 'dashicons-food'
        )
    );

	register_post_type( 'tool', array(
		// Tools
		'labels' => array(
			'name' => 'Tools',
			'singular_name' => 'Tool',
			'menu_name' => 'Tools',
			'all_items' => 'Tools',
			'edit_item' => 'Edit Tool',
			'view_item' => 'View Tool',
			'view_items' => 'View Tools',
			'add_new_item' => 'Add New Tool',
			'new_item' => 'New Tool',
			'parent_item_colon' => 'Parent Tool:',
			'search_items' => 'Search Tools',
			'not_found' => 'No tools found',
			'not_found_in_trash' => 'No tools found in Trash',
			'archives' => 'Tool Archives',
			'attributes' => 'Tool Attributes',
			'insert_into_item' => 'Insert into tool',
			'uploaded_to_this_item' => 'Uploaded to this tool',
			'filter_items_list' => 'Filter tools list',
			'filter_by_date' => 'Filter tools by date',
			'items_list_navigation' => 'Tools list navigation',
			'items_list' => 'Tools list',
			'item_published' => 'Tool published.',
			'item_published_privately' => 'Tool published privately.',
			'item_reverted_to_draft' => 'Tool reverted to draft.',
			'item_scheduled' => 'Tool scheduled.',
			'item_updated' => 'Tool updated.',
			'item_link' => 'Tool Link',
			'item_link_description' => 'A link to a tool.',
		),
		'public' => true,
		'show_in_menu' => 'edit.php?post_type=recipes',
		'show_in_rest' => true,
		'supports' => array(
			0 => 'title',
		),
		'delete_with_user' => false,
	) );
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
