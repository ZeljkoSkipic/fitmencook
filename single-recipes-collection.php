<?php

/**
 * Template Name: Collection
 * Template Post Type: recipes
 */

get_header();


$categories = get_the_terms( $post->ID, 'recipe-category' );
$author_id = $post->post_author;

$see_full = get_field('see_full', 'option');
$meal_counter = 1;

?>

<div class="fmc_single_recipe fmc_container spacing_2">
	<div class="fmc_sr_main">
		<div class="fmc_recipe_hero spacing_0_3">
			<!-- Top Wrap -->
			<div class="fmc_recipe_top_wrap">
				<div class="fmc_recipe_top_left">
					<?php if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb( '<div class="fmc_breadcrumbs spacing_0_2">','</div>' );
					} ?>
					<div class="fmc_categories">
						<?php if ( ! empty( $categories ) ) {
							echo get_the_term_list( $post->ID, 'recipe-category', '<div class="fmc_grid_cat">', '', '</div>');
						} ?>
					</div>
				</div>
				<div class="fmc_top_author">
					<?php echo get_avatar( $author_id ); ?>
					<h5 class="fmc_autor_top_name">
						<span>Author:</span>
						<?php echo wpautop( get_the_author_meta( 'display_name', $author_id ) ); ?>
					</h5>
				</div>
			</div>
			<!-- Recipe Title -->
			<h1 class="fmc_title_1 title_spacing_3">
				<?php the_title(); ?>
			</h1>
			<?php get_template_part('template-parts/last-updated'); ?>

			<!-- WP Content -->
			<?php
			$content = apply_filters( 'the_content', get_the_content() );
			if( $content ) :
			?>
			<div class="spacing_0_2 fmc_recipe_the_content fmc_ad_container">
				<?php echo $content; ?>
			</div>
			<?php the_post_thumbnail(); ?>
			<?php endif; ?>
		</div>
		<div class="fmc_sr_recipe_content">
              <?php

            if (have_rows('existing_recipe')) : // Existing Recipes

                // Loop through rows.
                while (have_rows('existing_recipe')) : the_row();
                    $recipes = get_sub_field('recipe');
					$description = get_sub_field('description');
                    if ($recipes) : ?>
                        <?php foreach ($recipes as $post) :
                            // Setup this post for WP functions (variable must be named $post).
                            setup_postdata($post); ?>

                            <div class="fmc_mp_recipe">
                                <div class="fmc_mpr_top">
                                    <span class="recipe_no"><?php echo __('Recipe', 'fitmencook') . ' ' . $meal_counter; ?></span>
                                    <a href="<?php the_permalink(); ?>">
                                        <h2 class="fmc_mpr_title fmc_title_3"><?php the_title(); ?></h2>
                                    </a>
                                </div>
                                <?php the_post_thumbnail(); ?>
								<div class="fmc_cr_description">
									<?php echo $description; ?>
								</div>
                                <a class="fmc_mpr_rm" href="<?php the_permalink(); ?>"><?php echo $see_full; ?></a>
                            </div>
                        <?php endforeach; ?>
                        <?php
                        // Reset the global post object so that the rest of the page works correctly.
                        wp_reset_postdata(); ?>
            <?php endif;
                    $meal_counter++;
                endwhile;

            endif; ?>

            <?php if (have_rows('custom_recipe')) : // Custom Recipes

                // Loop through rows.
                while (have_rows('custom_recipe')) : the_row();

                    $recipe_title = get_sub_field('recipe_title');
					$recipe_image = get_sub_field('recipe_image');
					$recipe_description = get_sub_field('recipe_description');
					$recipe_link = get_sub_field('recipe_link');
					if( $recipe_link ):
						$link_url = $recipe_link['url'];
						$link_title = $recipe_link['title'];
						$link_target = $recipe_link['target'] ? $recipe_link['target'] : '_self';
					endif;

					?>

                    <div class="fmc_mp_recipe">
                        <div class="fmc_mpr_top">
                            <span class="recipe_no"><?php echo __('Recipe', 'fitmencook') . ' ' . $meal_counter; ?></span>
							<?php if( $recipe_link ): ?>
								<a href="<?php echo esc_url( $link_url ); ?>" ?>
								<?php endif; ?>
                            <h2 class="fmc_mpr_title fmc_title_3">
								<?php echo $recipe_title; ?>
							</h2>
							<?php if( $recipe_link ): ?>
								</a>
							<?php endif; ?>
                        </div>
						<?php
							$size = 'full'; // (thumbnail, medium, large, full or custom size)
							if( $recipe_image ) {
								echo wp_get_attachment_image( $recipe_image, $size, "", array ('class' => 'attachment-post-thumbnail' ) );
							} ?>
						<div class="fmc_cr_description spacing_3_0">
							<?php echo $recipe_description; ?>
						</div>
						<?php
						if( $recipe_link ):
							?>
							<a class="fmc_mpr_rm" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo $see_full; ?></a>
						<?php endif; ?>
                    </div>
            <?php
                    $meal_counter++;
                endwhile;

            endif; ?>
			<div class="fmc_conclusion spacing_0_2">
				<?php the_field('conclusion'); ?>
			</div>
            <!-- Comments -->
            <div class="fmc_comments spacing_3_1">
                <?php
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif; ?>
            </div>
        </div>
	</div>
</div>

<!-- Author -->
<?php get_template_part('template-parts/author'); ?>

<!-- Related Recipes -->
<?php get_template_part('template-parts/recipe/related-recipes'); ?>

<?php get_footer();
