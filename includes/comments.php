<?php
/* Customize Default WP Comments Section */

// Add rating select after textarea field

function get_rating_html()
{
    ob_start();
    if(!is_product()):
?>
    <div class="rating-checkbox-wrap">
		<input id="use-rating" name="use-rating" type="checkbox">
		<label style="display:block" for="use-rating"><?php esc_html_e('I have made this recipe', 'fitmmencook') ?></label>
	</div>

    <?php endif; ?>

    <select name="rateRecipe" id="recipe-rate">
        <option value="0">Rate it</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>
    <div class="recipe_rate-wrapper <?php if(!is_product()) echo "disabled" ?>">
        <p class="recipe-rate-label"><?php esc_html_e('Rate the recipe:', 'fitmenCook'); ?></p>
        <div class="rateit svg" data-rateit-starwidth="19" data-rateit-starheight="16" data-rateit-resetable="false" data-rateit-backingfld="#recipe-rate" data-rateit-min="0"></div>
    </div>

    <?php if(is_product()): ?>

    <input type="hidden" name="postType" value="single-product">

    <?php endif; ?>


<?php

return ob_get_clean();

}

// Save custom rating field

add_filter('comment_form_field_comment', 'render_stars', 99, 1);
function render_stars($comment_field)
{
    if (!is_singular('recipes') && !is_product() && !is_singular('meal-plans') ) {
        return $comment_field;
    }

    return $comment_field . get_rating_html();
}


add_action( 'comment_post', 'save_rating_value', 10, 3 );
function save_rating_value( $comment_id, $approved, $commentdata ) {

    if($commentdata['comment_parent'] == 0) {
        $recipe_rating = isset( $_POST['rateRecipe'] ) ? wp_strip_all_tags($_POST['rateRecipe']) : '';
        $use_rating = isset( $_POST['use-rating'] ) ? wp_strip_all_tags($_POST['use-rating']) : '';
        $is_product = isset( $_POST['postType'] ) ? wp_strip_all_tags($_POST['postType']) : '';

        if($use_rating) {
            update_comment_meta( $comment_id, 'rating', $recipe_rating );
        }

        elseif($is_product == 'single-product') {
            update_comment_meta( $comment_id, 'rating', $recipe_rating );
        }
    }

}

// Replace comment view

add_filter( 'comment_text', 'add_rating_to_review_text', 10, 1 );
function add_rating_to_review_text( $text ) {

	if ( is_admin() || (!is_singular('recipes') && !is_product() && !is_singular('meal-plans') ) ) {
		return $text;
	}

	$rating = get_comment_meta( get_comment_ID(), 'rating', true );
    $date = get_comment_date('M d Y');
    $comment = get_comment(get_comment_ID());



	$rating_html = '<div class="comment-items">
        <div class="rateit" data-rateit-starwidth="19" data-rateit-starheight="16" data-rateit-value="'.$rating.'" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
        <p class="comment-date"> '.$date.' </p></div>';

    if(!$rating) {
        $rating_html = "";
    }

    if($comment->comment_parent != 0) {
        $rating_html = "";
    }

	$updated_text = $rating_html. $text;


	return $updated_text;
}

// Comment default params

add_filter('comment_form_defaults', 'comment_default_params', 20);
function comment_default_params( $defaults ) {
 $defaults['title_reply'] = __('Reviews', 'fitmenCook');
 return $defaults;
}

// Woo comment title remove

add_filter('woocommerce_reviews_title', 'remove_woo_comments_title');

function remove_woo_comments_title () {
    return false;
}

// Woo Add avg rating after single product title

add_action('woocommerce_single_product_summary', function() {
    get_avarage_rating(get_the_ID(), "sidebar");
});

// Add avg rating before comment form
add_action('comment_form_before', function() {
   get_avarage_rating(get_the_ID(), "");
});
