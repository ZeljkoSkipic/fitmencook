<?php

get_header();
$arch_title = get_field('mp_arch_title', 'option');
$arch_intro = get_field('mp_arch_intro', 'option');
?>
<div class="fmc_mp_archive_wrap fmc_container spacing_2">
    <div class="fmc_mp_archive_top">
        <?php if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<div class="fmc_breadcrumbs spacing_0_2">', '</div>');
        } ?>
        <h1 class="fmc_title_1 title_spacing_3"><?php echo $arch_title; ?></h1>
        <div class="fmc_arch_intro"><?php echo $arch_intro; ?></div>
        <div class="fmc_mp_grid fmc_archive_main">
            <div class="fmc_archive_inner">

                <?php
                while (have_posts()) :
                    the_post();
                    $recipe_images = [];
                    $existing_recipes = get_field('existing_recipe', get_the_ID());
                    $custom_recipes = get_field('custom_recipe', get_the_ID());
                    $total_recipes = ($existing_recipes ?  count($existing_recipes) : 0) + ($custom_recipes ? count($custom_recipes) : 0);

                    if ($custom_recipes && is_array($custom_recipes)) {

                        foreach ($custom_recipes as $custom_recipe) {
                            if (preg_match('/<img[^>]+>/i', $custom_recipe['custom_ingredients'], $img_tags)) {
                                $recipe_images[] = $img_tags[0];
                            }
                        }
                    }

                    if ($existing_recipes) {
                        foreach ($existing_recipes as $existing_recipe) {
                            $recipe_images[] = get_the_post_thumbnail($existing_recipe['recipe'][0], 'large');
                        }
                    }

                    // Add placeholders if array have less than 3 images

                    if(count($recipe_images) < 3) {

                        for($i = count($recipe_images); $i < 3; $i = count($recipe_images)) {
                            array_push($recipe_images, '<img src="'.get_template_directory_uri() . '/assets/images/meal-placeholder.jpg'.'" alt="Placeholder Image" loading="lazy">');
                        }
                    }

                ?>

                    <div class="fmc_plan">
                        <div class="fmc_plan_images">
                            <div class="left">
                                <figure>

                                    <?php
                                    if ($recipe_images) {
                                        $random_image = rand(0, (count($recipe_images) - 1));
                                        echo $recipe_images[$random_image];
                                        unset($recipe_images[$random_image]);
                                        $recipe_images = array_values($recipe_images);
                                    }
                                    ?>

                                </figure>
                            </div>
                            <div class="right">
                                <figure>
                                    <?php
                                   if ($recipe_images) {
                                    $random_image = rand(0, (count($recipe_images) - 1));
                                    echo $recipe_images[$random_image];
                                    unset($recipe_images[$random_image]);
                                    $recipe_images = array_values($recipe_images);
                                }
                                    ?>
                                </figure>
                                <figure>
                                    <?php
                                    if ($recipe_images) {
                                        $random_image = rand(0, (count($recipe_images) - 1));
                                        echo $recipe_images[$random_image];
                                        unset($recipe_images[$random_image]);
                                        $recipe_images = array_values($recipe_images);
                                    }
                                    ?>
                                </figure>
                            </div>
                        </div>
                        <a href="<?php the_permalink(); ?>">
                            <h3 class="fmc_plan_title fmc_title_4"><?php the_title(); ?></h3>
                        </a>
                        <div class="fmc_plan_bottom">
                            <span> <?php esc_html_e('Number of Meals', 'fitmencook'); ?></span>
                            <?php echo $total_recipes .' '. __('Meals', 'fitmencook'); ?>
                        </div>
                    </div>

                <?php endwhile;
                ?>

            </div>
            <div class="spacing_3_1">
                <?php fmc_pagination(); ?>
            </div>
        </div>
    </div>

    <div class="fmc_mp_archive_main">
        <div class="fmc_mp_archive_anchors">
            <?php
            // Check rows existexists.
            if (have_rows('mp_arch_content', 'option')) :

                // Loop through rows.
                while (have_rows('mp_arch_content', 'option')) : the_row();


                    // Load sub field value.
                    $mp_sec_anchor = get_sub_field('anchor_label');
                    // Do something...
                    if ($mp_sec_anchor) : ?>
                        <a href="#<?php echo str_replace(' ', '', $mp_sec_anchor); ?>">
                            <?php echo $mp_sec_anchor; ?>
                        </a>
            <?php endif;

                // End loop.
                endwhile;

            endif; ?>
        </div>
        <div class="fmc_mp_arch_main_inner spacing_2">
            <div class="fmc_mp_archive_left">
                <?php

                // Check rows existexists.
                if (have_rows('mp_arch_content', 'option')) :

                    // Loop through rows.
                    while (have_rows('mp_arch_content', 'option')) : the_row();


                        // Load sub field value.
                        $mp_sec_anchor = get_sub_field('anchor_label');
                        $mp_arch_sec_title = get_sub_field('mp_arch_sec_title');
                        $mp_arch_sec = get_sub_field('mp_arch_sec');

                        // Do something...
                ?>
                        <div class="fmc_mp_arch_sec" id="<?php echo str_replace(' ', '', $mp_sec_anchor); ?>">
                            <?php if ($mp_arch_sec_title) : ?>
                                <h2 class="fmc_title_3 spacing_0_3"><?php echo $mp_arch_sec_title; ?></h2>
                            <?php endif; ?>
                            <div><?php echo $mp_arch_sec; ?></div>
                        </div>
                <?php // End loop.
                    endwhile;

                endif; ?>
            </div>
            <div class="fmc_archive_sidebar">

                <?php dynamic_sidebar('ad5'); ?>

            </div>
        </div>
    </div>

</div>
<?php get_footer();
