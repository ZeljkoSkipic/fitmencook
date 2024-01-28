<?php
$recipeID = isset($args['recipeID']) ? $args['recipeID'] : "";
$prep_hours = get_field('prep_hours', $recipeID);
$prep_time = get_field('prep_time', $recipeID);
$cook_hours = get_field('cook_hours', $recipeID);
$cook_time = get_field('cook_time', $recipeID);
$total_time = get_field('total_time', $recipeID);
$total_hours = get_field('total_hours', $recipeID);
$l_prep_time = get_field('l_prep_time', 'option');
$l_cook_time = get_field('l_cook_time', 'option');
$l_total_time = get_field('l_total_time', 'option');
$minutes = get_field('minutes', 'option');
$ingredients = get_field('ingredients', $recipeID);
$calories = get_field('calories', $recipeID);
$protein = get_field('protein', $recipeID);
$fat = get_field('fat', $recipeID);
$carbs = get_field('carbs', $recipeID);
$sodium = get_field('sodium', $recipeID);
$fiber = get_field('fiber', $recipeID);
$sugar = get_field('sugar', $recipeID);
$l_calories = get_field('l_calories', 'option');
$l_protein = get_field('l_protein', 'option');
$l_fat = get_field('l_fat', 'option');
$l_carbs = get_field('l_carbs', 'option');
$l_sodium = get_field('l_sodium', 'option');
$l_fiber = get_field('l_fiber', 'option');
$l_sugar = get_field('l_sugar', 'option');
$feature_image = get_the_post_thumbnail( $recipeID, 'large');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo get_the_title($recipeID); ?></title>
</head>

<body>

    <table>

        <?php if($feature_image): ?>

        <tr>
            <?php echo $feature_image; ?>
        </tr>

        <?php endif; ?>

        <tr>
            <td><?php the_custom_logo(); ?></td>
            <td>
                <?php the_title($recipeID) ?>
                <table>
                    <?php if ($prep_time) : ?>

                        <tr>
                            <td>
                                <strong><?php echo $l_prep_time ?>: </strong>
                            </td>
                            <td>
                                <?php if ($prep_hours) { ?>
                                    <span>
                                        <?php echo $prep_hours ?>h
                                    </span>
                                <?php } ?>
                                <span><?php echo $prep_time ?> <?php echo $minutes ?></span>
                            </td>
                        </tr>

                    <?php endif; ?>

                    <?php if ($cook_time) : ?>

                        <tr>
                            <td>
                                <strong><?php echo $l_cook_time ?>: </strong>
                            </td>
                            <td>
                                <?php if ($cook_hours) { ?>
                                    <span>
                                        <?php echo $cook_hours ?>h
                                    </span>
                                <?php } ?>
                                <span><?php echo $cook_time ?> <?php echo $minutes ?></span>

                            </td>
                        </tr>

                    <?php endif; ?>

                    <?php if ($total_time) : ?>

                        <tr>
                            <td>
                                <strong><?php echo $l_total_time ?>: </strong>
                            </td>
                            <td>
                                <?php if ($total_hours) { ?>
                                    <span>
                                        <?php echo $total_hours ?>h
                                    </span>
                                <?php } ?>
                                <span><?php echo $total_time ?> <?php echo $minutes ?></span>
                            </td>
                        </tr>

                    <?php endif; ?>

                </table>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td>

                <?php // Instacart Ingredients

                if (get_field('ingredients_switch', $recipeID)) { ?>
                    <h4><?php the_field('ingredients_title', $recipeID); ?></h4>
                    <?php get_template_part('template-parts/recipe/instacart-ingredients-mail', null, [
                        'recipeID' => $recipeID
                    ]); ?>

                    <?php } else {

                    if ($ingredients) { ?>
                        <h4><?php the_field('ingredients_title', $recipeID); ?></h4>
                        <table>
                            <tr>
                                <td>
                                    <?php echo $ingredients; ?>
                                </td>
                            </tr>
                        </table>
                <?php }
                } ?>

            </td>
        </tr>

        <tr>
            <td>
                <?php
                // Check rows existexists.
                if (have_rows('steps', $recipeID)) : ?>
                    <h4><?php the_field('steps_title', $recipeID); ?></h4>
                    <?php $item = 1;
                    // Loop through rows.
                    while (have_rows('steps', $recipeID)) : the_row();

                        // Load sub field value.
                        $step = get_sub_field('step'); ?>
                        <table>
                            <tr>
                                <td>
                                    <h5>
                                        Step <?php echo $item; ?>
                                    </h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo $step; ?>
                                </td>
                            </tr>
                        </table>

                <?php // End loop.
                        $item++;
                    endwhile;
                endif; ?>
            </td>
        </tr>
    </table>

    <!-- Multiple -->

    <?php
    $meal_counter = 1;
    $noss = get_field('number_of_servings_sidebar', 'option');
    $servings_number = get_field('number_of_servings', $recipeID);
    $serving_size = get_field('serving_size', $recipeID);
    $l_serving_size = get_field('l_serving_size', 'option');
    $nos_single = get_field('number_of_servings_ing_single', 'option');
    $nosi = get_field('number_of_servings_ing', 'option');
    ?>

    <table>
        <tr>
            <td>
                <?php
                if (have_rows('existing_recipe', $recipeID)) :
                    while (have_rows('existing_recipe', $recipeID)) : the_row();
                        $include_steps = get_sub_field('include_steps');
                        $recipes = get_sub_field('recipe');

                        if ($recipes) : ?>
                            <?php foreach ($recipes as $post) :
                                setup_postdata($post);

                                $prep_hours = get_field('prep_hours');
                                $prep_time = get_field('prep_time');
                                $cook_hours = get_field('cook_hours');
                                $cook_time = get_field('cook_time');
                                $total_time = get_field('total_time');
                                $total_hours = get_field('total_hours');
                                $servings_number = get_field('number_of_servings');
                                $serving_size = get_field('serving_size');
                            ?>

                                <table>
                                    <tr>
                                        <td>
                                            <p><?php echo __('Recipe', 'fitmencook') . ' ' . $meal_counter; ?></p>
                                            <h2><?php the_title(); ?></h2>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table>
                                                <tr>
                                                    <?php if ($prep_time) : ?>

                                                        <td>
                                                            <?php echo $l_prep_time ?>
                                                        </td>

                                                    <?php endif; ?>

                                                    <?php if ($cook_time) : ?>

                                                        <td>
                                                            <?php echo $l_cook_time ?>
                                                        </td>

                                                    <?php endif; ?>

                                                    <?php if ($total_time) : ?>

                                                        <td>
                                                            <?php echo $l_total_time ?>
                                                        </td>

                                                    <?php endif; ?>
                                                </tr>
                                                <tr>
                                                    <?php if ($prep_time) : ?>

                                                        <td>
                                                            <span>
                                                                <?php if ($prep_hours) { ?>
                                                                    <?php echo $prep_hours ?>h
                                                                <?php } ?>
                                                                <?php echo $prep_time ?><?php echo $minutes ?> </span>
                                                        </td>

                                                    <?php endif; ?>

                                                    <?php if ($cook_time) : ?>

                                                        <td>
                                                            <span>
                                                                <?php if ($cook_hours) { ?>
                                                                    <?php echo $cook_hours ?>h
                                                                <?php } ?>
                                                                <?php echo $cook_time ?><?php echo $minutes ?></span>
                                                        </td>

                                                    <?php endif; ?>

                                                    <?php if ($total_time) : ?>

                                                        <td>
                                                            <span>
                                                                <?php if ($total_hours) { ?>
                                                                    <?php echo $total_hours ?>h
                                                                <?php } ?>
                                                                <?php echo $total_time ?><?php echo $minutes ?></span>
                                                        </td>

                                                    <?php endif; ?>

                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php
                                            $ingredients_title = get_field('ingredients_title');
                                            if ($ingredients_title) : ?>
                                                <h4><?php echo $ingredients_title ?></h4>
                                            <?php endif; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <?php if ($servings_number) : ?>
                                            <td>

                                                <span><?php echo $servings_number ?> </span>
                                                <?php if ($servings_number == 1) {
                                                    echo $nos_single;
                                                } else {
                                                    echo $nosi;
                                                } ?>
                                            </td>

                                        <?php endif; ?>

                                        <?php if ($serving_size) : ?>

                                            <td>
                                                <?php echo $l_serving_size; ?>:<span><?php echo $serving_size ?></span>
                                            </td>

                                        <?php endif; ?>

                                    </tr>

                                    <tr>
                                        <td>
                                            <!-- Ingredients -->

                                            <?php // Instacart Ingredients

                                            if (get_field('ingredients_switch')) { ?>

                                                <?php get_template_part('template-parts/recipe/instacart-ingredients'); ?>

                                            <?php } else { ?>

                                                <?php the_field('ingredients'); ?>

                                            <?php } ?>
                                        </td>
                                    </tr>

                                    <?php if ($include_steps) : ?>

                                        <tr>
                                            <td>
                                                <h4><?php the_field('steps_title'); ?></h4>
                                                <?php if (have_rows('steps')) : ?>
                                                    <?php
                                                    $item = 1;
                                                    // Loop through rows.
                                                    while (have_rows('steps')) : the_row();
                                                        // Load sub field value.
                                                        $step = get_sub_field('step'); ?>

                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <h5>
                                                                        Step <?php echo $item; ?>
                                                                    </h5>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <?php echo $step; ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    <?php $item++;

                                                    endwhile; ?>

                                                <?php endif; ?>
                                            </td>
                                        </tr>

                                    <?php endif; ?>
                                </table>
                            <?php endforeach; ?>
                            <?php
                            // Reset the global post object so that the rest of the page works correctly.
                            wp_reset_postdata(); ?>
                <?php endif;
                        $meal_counter++;
                    endwhile;

                endif; ?>

            </td>
        </tr>

        <?php if (have_rows('custom_recipe')) : // Custom Recipes 
        ?>

            <tr>
                <td>
                    <?php
                    while (have_rows('custom_recipe')) : the_row();
                        $recipe_title = get_sub_field('recipe_title');
                        $cr_prep_hours = get_sub_field('cr_prep_hours');
                        $cr_prep_time = get_sub_field('cr_prep_time');
                        $cr_cook_hours = get_sub_field('cr_cook_hours');
                        $cr_cook_time = get_sub_field('cr_cook_time');
                        $cr_total_hours = get_sub_field('cr_total_hours');
                        $cr_total_time = get_sub_field('cr_total_time');
                    ?>

                        <table>
                            <tr>
                                <td>
                                    <p><?php echo __('Recipe', 'fitmencook') . ' ' . $meal_counter; ?></p>
                                    <h2><?php echo $recipe_title; ?></h2>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table>
                                        <tr>
                                            <?php if (!empty($cr_prep_time || $cr_prep_hours)) : ?>

                                                <td>
                                                    <?php echo $l_prep_time; ?>
                                                </td>

                                            <?php endif; ?>

                                            <?php if (!empty($cr_cook_time || $cr_cook_hours)) : ?>

                                                <td>
                                                    <?php echo $l_cook_time; ?>
                                                </td>

                                            <?php endif; ?>

                                            <?php if (!empty($cr_total_time || $cr_total_hours)) : ?>

                                                <td>
                                                    <?php echo $l_total_time; ?>
                                                </td>

                                            <?php endif; ?>

                                        </tr>
                                        <tr>
                                            <?php if (!empty($cr_prep_time || $cr_prep_hours)) : ?>

                                                <td>
                                                    <span>
                                                        <?php if ($cr_prep_hours) { ?>
                                                            <?php echo $cr_prep_hours ?>h
                                                        <?php } ?>
                                                        <?php echo $cr_prep_time; ?><?php echo $minutes ?>
                                                    </span>
                                                </td>

                                            <?php endif; ?>

                                            <?php if (!empty($cr_cook_time || $cr_cook_hours)) : ?>

                                                <td>
                                                    <span>
                                                        <?php if ($cr_cook_hours) { ?>
                                                            <?php echo $cr_cook_hours ?>h
                                                        <?php } ?>
                                                        <?php echo $cr_cook_time; ?><?php echo $minutes ?>
                                                    </span>
                                                </td>

                                            <?php endif; ?>

                                            <?php if (!empty($cr_total_time || $cr_total_hours)) : ?>

                                                <td>
                                                    <span>
                                                        <?php if ($cr_total_hours) { ?>
                                                            <?php echo $cr_total_hours ?>h
                                                        <?php } ?>
                                                        <?php echo $cr_total_time; ?><?php echo $minutes ?>
                                                    </span>
                                                </td>

                                            <?php endif; ?>
                                        </tr>
                                    </table>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                    $custom_ingredients = get_sub_field('custom_ingredients');
                                    $custom_nos = get_sub_field('number_of_servings');
                                    $custom_ss = get_sub_field('serving_size');
                                    ?>
                                    <h4><?php the_sub_field('ingredients_title'); ?></h4>
                                </td>

                            </tr>

                            <tr>
                                <?php if ($custom_nos) : ?>
                                    <td>

                                        <span><?php echo $custom_nos ?> </span>
                                        <?php if ($custom_nos == 1) {
                                            echo $nos_single;
                                        } else {
                                            echo $nosi;
                                        } ?>
                                    </td>

                                <?php endif; ?>

                                <?php if ($custom_ss) : ?>

                                    <td>
                                        <?php echo $l_serving_size; ?>:<span><?php echo $custom_ss ?></span>
                                    </td>

                                <?php endif; ?>

                            </tr>

                            <tr>
                                <td>
                                    <?php // Instacart Ingredients

                                    if (get_sub_field('ingredients_switch')) { ?>

                                        <?php get_template_part('template-parts/recipe/instacart-ingredients'); ?>


                                    <?php } // End Instacart ingredients
                                    else { ?>
                                        <?php echo $custom_ingredients ?>
                                    <?php }  ?>
                                </td>
                            </tr>
                            <?php if (have_rows('cr_steps')) : ?>
                                <tr>
                                    <td>
                                        <?php $steps_title = get_sub_field('steps_title'); ?>
                                        <?php $item = 1; ?>
                                        <?php
                                        while (have_rows('cr_steps')) : the_row();
                                            $step = get_sub_field('cr_step'); ?>
                                            <table>
                                                <tr>
                                                    <td>
                                                        <h5>
                                                            Step <?php echo $item; ?>
                                                        </h5>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <?php echo $step; ?>
                                                    </td>
                                                </tr>
                                            </table>

                                        <?php endwhile; ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    <?php
                        $meal_counter++;
                    endwhile;
                    ?>
                </td>
            </tr>
        <?php endif;  ?>
    </table>
</body>
</html>













<?php if (have_rows('custom_recipe')) : // Custom Recipes



endif; ?>