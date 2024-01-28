<?php
$recipeID = isset($args['recipeID']) ? $args['recipeID'] : "";
$times_title = get_field('times_title', 'option');

$l_prep_time = get_field('l_prep_time', 'option');
$l_cook_time = get_field('l_cook_time', 'option');
$l_total_time = get_field('l_total_time', 'option');

$minutes = get_field('minutes', 'option');
$see_full = get_field('see_full', 'option');

$l_calories = get_field('l_calories', 'option');
$l_protein = get_field('l_protein', 'option');
$l_fat = get_field('l_fat', 'option');
$l_carbs = get_field('l_carbs', 'option');
$l_sodium = get_field('l_sodium', 'option');
$l_fiber = get_field('l_fiber', 'option');
$l_sugar = get_field('l_sugar', 'option');

$nosi = get_field('number_of_servings_ing', 'option');
$l_serving_size = get_field('l_serving_size', 'option');

$meal_counter = 1;
$calculations = meal_plan_calculations(false, $recipeID);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo get_the_title($recipeID); ?></title>
</head>

<body>
    <table>
        <tr>
            <td>
                <?php the_custom_logo(); ?>
            </td>
            <td>
                <h1><?php echo get_the_title($recipeID); ?></h1>
                <?php if ($calculations['total_times']) : ?>
                    <table>
                        <?php foreach ($calculations['total_times'] as $single_time) : ?>
                            <tr>
                                <td><strong><?php echo $single_time['label']; ?>:</strong></td>
                                <td>
                                    <?php if ($single_time['hours'] || $single_time['min']) : ?>

                                        <span><strong><?php echo $single_time['label']; ?>:</strong></span>

                                        <?php if ($single_time['hours']) : ?>

                                            <span><?php echo $single_time['hours']; ?></span>

                                        <?php endif; ?>

                                        <?php if ($single_time['min']) : ?>
                                            <span><?php echo $single_time['min']; ?></span>

                                        <?php endif; ?>

                                    <?php endif; ?>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </table>

                <?php endif; ?>

            </td>
        </tr>
    </table>

    <?php if (have_rows('existing_recipe', $recipeID)) : // Existing Recipes 
    ?>

        <table>
            <tr>
                <td>
                    <?php
                    while (have_rows('existing_recipe', $recipeID)) :
                        the_row();
                        $include_steps = get_sub_field('include_steps');
                        $recipes = get_sub_field('recipe');
                        if ($recipes) : ?>
                            <?php foreach ($recipes as $post) :
                                // Setup this post for WP functions (variable must be named $post).
                                setup_postdata($post);

                                $prep_hours = get_field('prep_hours');
                                $prep_time = get_field('prep_time');
                                $cook_hours = get_field('cook_hours');
                                $cook_time = get_field('cook_time');
                                $total_time = get_field('total_time');
                                $total_hours = get_field('total_hours');
                                $calories = get_field('calories');
                                $servings_number = get_field('number_of_servings');
                                $serving_size = get_field('serving_size');
                            ?>
                                <table>
                                    <tr>
                                        <td>
                                            <span><?php echo __('Recipe', 'fitmencook') . ' ' . $meal_counter; ?></span>
                                            <a href="<?php the_permalink(); ?>">
                                                <h2><?php the_title(); ?></h2>
                                            </a>

                                            <table>
                                                <tr>
                                                    <?php if ($prep_time) : ?>

                                                        <td><span><?php echo $l_prep_time ?></span></td>

                                                    <?php endif; ?>

                                                    <?php if ($cook_time) : ?>

                                                        <td><?php echo $l_cook_time ?></td>

                                                    <?php endif; ?>

                                                    <?php if ($total_time) : ?>

                                                        <td>
                                                            <?php echo $l_total_time ?>
                                                        </td>

                                                    <?php endif; ?>

                                                    <?php if ($calories) : ?>

                                                        <td>
                                                            <?php echo __('calories', 'fitmencook'); ?>
                                                        </td>

                                                    <?php endif; ?>

                                                </tr>
                                                <tr>
                                                    <?php if ($prep_time) : ?>

                                                        <td>
                                                            <?php if ($prep_hours) { ?>
                                                                <?php echo $prep_hours ?>h
                                                            <?php } ?>
                                                            <?php echo $prep_time ?><?php echo $minutes ?></span>
                                                        </td>

                                                    <?php endif; ?>

                                                    <?php if ($cook_time) : ?>

                                                        <td>
                                                            <?php if ($cook_hours) { ?>
                                                                <?php echo $cook_hours ?>h
                                                            <?php } ?>
                                                            <?php echo $cook_time ?><?php echo $minutes ?></span>
                                                        </td>

                                                    <?php endif; ?>

                                                    <?php if ($total_time) : ?>

                                                        <td>
                                                            <?php if ($total_hours) { ?>
                                                                <?php echo $total_hours ?>h
                                                            <?php } ?>
                                                            <?php echo $total_time ?><?php echo $minutes ?></span>
                                                        </td>

                                                    <?php endif; ?>

                                                    <?php if ($calories) : ?>

                                                        <td>
                                                            <?php echo $calories . __('cal', 'fitmencook'); ?>
                                                        </td>

                                                    <?php endif; ?>

                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php the_post_thumbnail(); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <?php
                                        $ingredients_title = get_field('ingredients_title');
                                        if ($ingredients_title) : ?>
                                            <td>
                                                <h4><?php echo $ingredients_title ?></h4>
                                                <table>
                                                    <tr>
                                                        <?php if ($servings_number) : ?>

                                                            <td>
                                                                <span><?php echo $servings_number ?> </span> <?php echo $nosi; ?>
                                                            </td>

                                                        <?php endif; ?>

                                                        <?php if ($serving_size) : ?>

                                                            <td>
                                                                <?php echo $l_serving_size; ?>:<span><?php echo $serving_size ?></span>
                                                            </td>

                                                        <?php endif; ?>

                                                    </tr>
                                                </table>
                                            </td>
                                        <?php endif; ?>
                                    </tr>

                                    <tr>
                                        <td>
                                            <?php // Instacart Ingredients

                                            if (get_field('ingredients_switch')) { ?>

                                                <?php get_template_part('template-parts/recipe/instacart-ingredients'); ?>

                                            <?php } else { ?>

                                                <?php the_field('ingredients'); ?>

                                            <?php } ?>
                                        </td>
                                    </tr>

                                    <?php if ($include_steps &&  have_rows('steps')) :  $item = 1; ?>

                                        <tr>
                                            <td>

                                                <?php
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

                                            </td>
                                        </tr>

                                    <?php endif; ?>

                                    <tr>
                                        <td>
                                            <?php get_template_part('template-parts/recipe/macros-mail'); ?>
                                            <a href="<?php the_permalink(); ?>"><?php echo $see_full; ?></a>
                                        </td>
                                    </tr>

                                </table>
                            <?php endforeach; ?>
                            <?php wp_reset_postdata(); ?>
                        <?php endif; ?>
                        <?php $meal_counter++; ?>
                    <?php endwhile; ?>
                </td>
            </tr>
        </table>

    <?php endif; ?>

    <table>
        <tr>
            <td>
                <?php dynamic_sidebar('ad7'); ?>
            </td>
        </tr>
    </table>


    <?php if (have_rows('custom_recipe', $recipeID)) : ?>

        <table>
            <tr>
                <td>
                    <?php
                    while (have_rows('custom_recipe', $recipeID)) :
                        the_row();
                        $recipe_title = get_sub_field('recipe_title');
                        $cr_prep_hours = get_sub_field('cr_prep_hours');
                        $cr_prep_time = get_sub_field('cr_prep_time');
                        $cr_cook_hours = get_sub_field('cr_cook_hours');
                        $cr_cook_time = get_sub_field('cr_cook_time');
                        $cr_total_hours = get_sub_field('cr_total_hours');
                        $cr_total_time = get_sub_field('cr_total_time');
                        $cr_calories = get_sub_field('cr_calories');
                        $cr_protein = get_sub_field('cr_protein');
                        $cr_fat = get_sub_field('cr_fat');
                        $cr_carbs = get_sub_field('cr_carbs');
                        $cr_sodium = get_sub_field('cr_sodium');
                        $cr_fiber = get_sub_field('cr_fiber');
                        $cr_sugar = get_sub_field('cr_sugar');

                    ?>

                        <table>

                            <tr>
                                <td>
                                    <span><?php echo __('Recipe', 'fitmencook') . ' ' . $meal_counter; ?></span>
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

                                            <?php if ($cr_calories) : ?>

                                                <td>
                                                    <?php echo __('caloeries', 'fitmencook'); ?>
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

                                            <?php if ($cr_calories) : ?>

                                                <td>
                                                    <?php echo $cr_calories ?>cal
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
                                    if ($custom_ingredients) : ?>
                                        <h4><?php the_sub_field('ingredients_title'); ?></h4>
                                        <table>
                                            <tr>
                                                <?php if ($custom_nos) : ?>

                                                    <td>
                                                        <span><?php echo $custom_nos ?> </span> <?php echo $nosi; ?>
                                                    </td>

                                                <?php endif; ?>

                                                <?php if ($custom_ss) ?>

                                                <td>
                                                    <?php echo $l_serving_size; ?>:<span><?php echo $custom_ss ?></span>
                                                </td>


                                            </tr>
                                        </table>

                                        <table>
                                            <tr>
                                                <td>
                                                    <?php
                                                    if (get_sub_field('ingredients_switch')) { ?>

                                                        <?php get_template_part('template-parts/recipe/instacart-ingredients'); ?>


                                                    <?php } else { ?>
                                                        <?php echo $custom_ingredients ?>
                                                    <?php }  ?>

                                                </td>
                                            </tr>
                                        </table>

                                    <?php endif; ?>


                                </td>
                            </tr>
                            <?php
                            $steps_title = get_sub_field('steps_title');
                            if (have_rows('cr_steps')) :
                                $item = 1;
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $steps_title; ?>
                                        <?php
                                        while (have_rows('cr_steps')) :
                                            the_row();
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

                                        <?php
                                            $step++;
                                        endwhile; ?>
                                    </td>
                                </tr>

                            <?php endif; ?>

                            <tr>
                                <td>
                                    <h4><?php echo $macros_title; ?></h4>
                                    <table>
                                        <tr>
                                            <h4><?php echo $macros_title; ?></h4>
                                        </tr>
                                        <tr>
                                            <?php if ($cr_calories) : ?>
                                                <td>
                                                    <?php echo $l_calories; ?>
                                                </td>

                                            <?php endif; ?>

                                            <?php if ($cr_protein) : ?>

                                                <td>
                                                    <?php echo $l_protein; ?>
                                                </td>

                                            <?php endif; ?>

                                            <?php if ($cr_fat) : ?>

                                                <td>
                                                    <?php echo $l_fat; ?>
                                                </td>

                                            <?php endif; ?>

                                            <?php if ($cr_carbs) : ?>

                                                <td>
                                                    <?php echo $l_carbs; ?>
                                                </td>

                                            <?php endif; ?>

                                            <?php if ($cr_sodium) : ?>

                                                <td>
                                                    <?php echo $l_sodium; ?>
                                                </td>

                                            <?php endif; ?>

                                            <?php if ($cr_fiber) : ?>

                                                <td>
                                                    <?php echo $l_fiber; ?>
                                                </td>

                                            <?php endif; ?>

                                            <?php if ($cr_sugar) : ?>

                                                <td>
                                                    <?php echo $l_sugar; ?>
                                                </td>

                                            <?php endif; ?>

                                        </tr>
                                        <tr>
                                            <?php if ($cr_calories) : ?>
                                                <td>
                                                    <?php echo $cr_calories; ?>cal
                                                </td>

                                            <?php endif; ?>

                                            <?php if ($cr_protein) : ?>

                                                <td>
                                                    <?php echo $cr_protein; ?>g
                                                </td>

                                            <?php endif; ?>

                                            <?php if ($cr_fat) : ?>

                                                <td>
                                                    <?php echo $cr_fat; ?>g
                                                </td>

                                            <?php endif; ?>

                                            <?php if ($cr_carbs) : ?>

                                                <td>
                                                    <?php echo $cr_carbs; ?>g
                                                </td>

                                            <?php endif; ?>

                                            <?php if ($cr_sodium) : ?>

                                                <td>
                                                    <?php echo $cr_sodium; ?>mg
                                                </td>

                                            <?php endif; ?>

                                            <?php if ($cr_fiber) : ?>

                                                <td>
                                                    <?php echo $cr_fiber; ?>g
                                                </td>

                                            <?php endif; ?>

                                            <?php if ($cr_sugar) : ?>

                                                <td>
                                                    <?php echo $cr_sugar; ?>g
                                                </td>

                                            <?php endif; ?>
                                        </tr>
                                    </table>
                                </td>

                            </tr>

                        </table>

                    <?php
                        $meal_counter++;
                    endwhile;
                    ?>

                </td>
            </tr>
        </table>

    <?php endif; ?>

</body>

</html>