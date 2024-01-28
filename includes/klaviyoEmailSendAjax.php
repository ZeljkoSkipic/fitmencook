<?php
add_action('wp_ajax_klaviyo_email_send', 'klaviyo_email_send');
add_action('wp_ajax_nopriv_klaviyo_email_send', 'klaviyo_email_send');

function klaviyo_email_send () {

    $user_email = isset($_POST['userEmail']) ? wp_strip_all_tags($_POST['userEmail']) : "";
    $post_url = isset($_POST['postUrl']) ? wp_strip_all_tags($_POST['postUrl']) : "";
    $recipeID = isset($_POST['recipeID']) ? wp_strip_all_tags($_POST['recipeID']) : "";

    if($user_email && $post_url && $recipeID) {

        if(filter_var($user_email, FILTER_VALIDATE_EMAIL) && preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $post_url)) {

            $subject = get_the_title($recipeID);

            // Get recipe template

            $recipe_template =  get_page_template_slug($recipeID);

            ob_start();

            if($recipe_template == 'single-recipes-multiple.php') {
                get_template_part('template-parts/recipe/newsletter-email-multiple-template', null, [
                    'recipeID' => $recipeID
                ]);
            }

            else {
                get_template_part('template-parts/recipe/newsletter-email-default-template', null, [
                    'recipeID' => $recipeID
                ]);
            }

            $mess = ob_get_clean();

            $headers = array('Content-Type: text/html; charset=UTF-8');

            $email_send = wp_mail($user_email, $subject, $mess, $headers);

            if($email_send) {
                wp_send_json_success();
            }
        }

        else {
            wp_send_json_error(null, 400);
        }
    }

    else {
        wp_send_json_error(null, 400);
    }

    die();
}