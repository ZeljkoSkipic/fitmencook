<?php
$recipeID = isset($args['recipeID']) ? $args['recipeID'] : "";
$meal_counter = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo get_the_title($recipeID); ?></title>
    <style>
        img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        .site_logo {
            width: 80px;
        }
    </style>
</head>

<body>
    <table style="width:100%;">
        <tr>
            <td style="padding: 4px 16px; border-radius: 4px; text-align: center; background: #FF885C; width: 100%">
                <h1 style="font-size: 22px; letter-spacing: .5px; color: #fff; margin: 0;">Fitmencook: <?php echo get_the_title($recipeID) ?></h1>
            </td>
        </tr>
    </table>
    <table style="width: 100%;">
        <tr>
            <td style="display: block; max-width: 650px; margin-left: auto; margin-right:auto; padding: 24px; background-color: #fafafa; border-radius: 0 0 16px 16px;">
                <table>
                    <tr>
                        <td style="width: 150px; display: inline-flex;">
                            <img class="site_logo" width="80" src="<?php echo get_site_url() ?>/wp-content/uploads/2024/01/fitmencook-logo.png">
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
                                            $image_existing_recipe = get_the_post_thumbnail(get_the_ID(), 'large');
                                        ?>
                                            <table style="margin-bottom: 20px;">
                                                <tr>
                                                    <td>
                                                        <strong><?php echo __('Recipe', 'fitmencook') . ' ' . $meal_counter; ?></strong>
                                                        <a href="<?php the_permalink(); ?>">
                                                            <h2><?php the_title(); ?></h2>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php if ($image_existing_recipe) : ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $image_existing_recipe; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            </table>
                                        <?php endforeach; ?>
                                        <?php wp_reset_postdata(); ?>
                                    <?php endif; ?>
                                    <strong><?php $meal_counter++; ?></strong>
                                <?php endwhile; ?>
                            </td>
                        </tr>
                    </table>

                <?php endif; ?>

                <?php if (have_rows('custom_recipe', $recipeID)) : ?>

                    <table>
                        <tr>
                            <td>
                                <?php
                                while (have_rows('custom_recipe', $recipeID)) :
                                    the_row();
                                    $recipe_title = get_sub_field('recipe_title');
                                    $image_custom_recipe = get_sub_field('recipe_image');

                                ?>

                                    <table style="margin-bottom: 20px;">

                                        <tr>
                                            <td>
                                                <span><strong><?php echo __('Recipe', 'fitmencook') . ' ' . $meal_counter; ?></strong></span>
                                                <h2><?php echo $recipe_title; ?></h2>
                                            </td>
                                        </tr>

                                        <?php if ($image_custom_recipe) : ?>
                                            <tr>
                                                <td>
                                                    <?php echo wp_get_attachment_image($image_custom_recipe, 'large'); ?>
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
                    </table>

                <?php endif; ?>
            </td>
        </tr>
    </table>
    <table style="text-align:center; width: 100%; padding-top: 24px;">
        <tr>
            <td>
                <a style="margin-bottom: 8px; background: #FF885C; padding: 8px 24px; text-decoration: none; color: #fff;  border-radius: 4px; font-weight: 500; font-size: 18px; display: inline-flex; margin-right: 12px;" href="<?php echo get_site_url();  ?>/recipes">More Recipes</a>
            </td>
        </tr>
    </table>
</body>

</html>