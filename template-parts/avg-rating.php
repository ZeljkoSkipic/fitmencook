<?php

/**
 * Template part for displaying avg rating from comments
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fitmencook
 */

?>

<?php
$comments_number = isset($args['comments_number']) ? $args['comments_number'] : "";
$rating = isset($args['rating']) ? $args['rating'] : "";
$style = isset($args['style']) ? $args['style'] : "";
?>

<?php if ($style === 'sidebar') : ?>

    <div class="fmc_sidebar_rating <?php echo $style; ?>">
        <div class="rateit" data-rateit-starwidth="19" data-rateit-starheight="16" data-rateit-value="<?php echo $rating; ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
        <span class="rating"><?php echo $rating; ?></span>
        <span class="reviews-number">(<?php echo $comments_number . " " . __('reviews', 'fitmenCook'); ?>)</span>
    </div>

<?php else : ?>

    <div class="fmc_sidebar_rating <?php echo $style; ?>">
        <span class="rating"><?php echo $rating; ?></span>
        <div class="fmc_sidebar_rating-wrapper">
            <div class="rateit" data-rateit-starwidth="19" data-rateit-starheight="16" data-rateit-value="<?php echo $rating; ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
            <span class="reviews-number">(<?php echo __('Based on', 'fitmenCook'). " ".  $comments_number . " " . __('reviews', 'fitmenCook'); ?>)</span>
        </div>
    </div>

<?php endif; ?>