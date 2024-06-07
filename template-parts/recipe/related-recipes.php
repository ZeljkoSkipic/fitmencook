<?php
// Get the current post ID
$current_post_id = get_the_ID();

// Use Yoast's function to get the primary term for the current post
$primary_term_id = yoast_get_primary_term_id('recipe-category', $current_post_id);
$primary_term = get_term_by('id', $primary_term_id, 'recipe-category');
// Check if a primary category is set
if ($primary_term_id) {
    // Set up the custom query arguments
    $args = array(
        'post_type' => 'recipes', // Your custom post type
        'posts_per_page' => 3, // Number of posts to show
        'post__not_in' => array($current_post_id), // Exclude the current post
        'tax_query' => array(
            array(
                'taxonomy' => 'recipe-category', // Your custom taxonomy
                'field'    => 'term_id',
                'terms'    => $primary_term_id, // The primary category ID
            ),
        ),
        'meta_query' => array(
            array(
                'key'     => '_yoast_wpseo_primary_recipe-category',
                'value'   => $primary_term_id,
                'compare' => '='
            )
        )
    );

    // Create a new WP_Query instance
    $related_recipes_query = new WP_Query($args);
    // Check if the term exists

    // Check if the query returns any posts
    if ($related_recipes_query->have_posts()) { ?>

		<div class="fmc_want_more_recipes fmc_related_recipes spacing_1_0">
		<?php if ($primary_term !== false) {
			// Display the name of the primary category ?>
			<h2 class="fmc_title_2 title_spacing_1">Want more <?php echo esc_html($primary_term->name) ?> recipes?</h2>
		<?php } ?>

			<div class="fmc_rg_inner spacing_0_1">
        <?php // Loop through the posts
        while ($related_recipes_query->have_posts()) {
            $related_recipes_query->the_post(); ?>

            <?php get_template_part('template-parts/recipe/recipe-grid'); ?>
        <?php } ?>

		</div>
	</div>
    <?php }

    // Restore original Post Data
    wp_reset_postdata();
}
?>
