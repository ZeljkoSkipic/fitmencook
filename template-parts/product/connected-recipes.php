<?php
$connections = get_posts([
    'post_type'         => 'connection',
    'posts_per_page'    => -1,
    'meta_query'        => [
        [
            'key' => 'connected_product',
            'value' => '"' . get_the_ID() . '"',
            'compare' => 'LIKE'
        ]
    ]
]);

// Get all recipes from connections

if ($connections) {
    $connection_recipes_all = [];
    foreach ($connections as $connection) {
        $connection_recipes = get_field('recipes', $connection->ID);
        if ($connection_recipes) {
            foreach ($connection_recipes as $connection_recipe) {
                $connection_recipes_all[$connection_recipe->ID] = $connection_recipe;

            }
        }
		$connection_url = get_permalink($connection->ID);

    }
}

// If there is more than 3, get 3 radnom recipes

if (isset($connection_recipes_all) && $connection_recipes_all && count($connection_recipes_all) > 3) {
    $radnom_indexes = array_rand($connection_recipes_all, 3);
    if ($radnom_indexes) {
        $random_recipes = [];
        foreach ($radnom_indexes as $index) {
            $random_recipes[] = $connection_recipes_all[$index];
        }
        $connection_recipes_all = $random_recipes;
    }
}


if (isset($connection_recipes_all) && $connection_recipes_all) :

?>

<div class="fmc_product_connected fmc_archive_wrap spacing_1_0 ">
<h2 class="fmc_title_2 title_spacing_2"><?php esc_html_e('Recipes Made Using This Product', 'fitmencook'); ?></h2>
	<div class="fmc_archive_inner fmc_product_connected">
		<?php
		foreach ($connection_recipes_all as $connected_recipe) :
			global $post;
			$post = $connected_recipe;
			setup_postdata($post);
			get_template_part('template-parts/recipe/recipe', 'item');
		endforeach;
		wp_reset_postdata();
		?>
	</div>
		<a href="<?php echo esc_url($connection_url); ?>" class="fmc_btn">See more recipes</a>
</div>

 <?php endif; ?>
