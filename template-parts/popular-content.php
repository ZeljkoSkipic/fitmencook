<?php

$current_post_id = get_the_ID(); // Get the current post ID

$args = array(
    'post_type'      => array('post', 'recipes'), // Target 'post' and 'recipes' post types
    'posts_per_page' => 4,                       // Retrieve all matching posts
    'post__not_in'   => array($current_post_id),
	'meta_query'     => array(
        array(
            'key'     => 'popular_content',          // ACF field to check
            'value'   => '1',                     // Value that indicates the switch is on
            'compare' => '='                      // Condition
        )
    )
);

$query = new WP_Query($args);

if ($query->have_posts()) { ?>
	<div class="fmc_popular_content fmc_container spacing_0_1">
	<h2 class="fmc_title_2 title_spacing_1 popular_content_title">Popular Content</h2>
	<div class="fmc_popular_content_inner">
    <?php while ($query->have_posts()) {
        $query->the_post(); ?>

		<div class="fmc_popular_post">
			<?php $content = get_the_content();
        	$content_no_images = preg_replace('/<img[^>]+\>/i', '', $content); ?>
			<figure>
				<?php the_post_thumbnail(); ?>
			</figure>
			<h2 class="fmc_grid_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
       		<p class="popular_content_text">
			   <?php echo wp_trim_words($content_no_images, 15, '...'); // Trimming to 10 words ?>
			</p>
			<span class="post_date"><?php the_date(); ?></span>
			</div>
    	<?php } ?>
	</div>
	</div>
<?php }

wp_reset_postdata(); // Reset the global post object

?>
