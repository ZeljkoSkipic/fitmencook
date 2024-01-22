<?php
add_action('wp_ajax_klaviyo_email_send', 'klaviyo_email_send');
add_action('wp_ajax_nopriv_klaviyo_email_send', 'klaviyo_email_send');

function klaviyo_email_send () {

    $user_email = isset($_POST['userEmail']) ? wp_strip_all_tags($_POST['userEmail']) : "";
    $post_url = isset($_POST['postUrl']) ? wp_strip_all_tags($_POST['postUrl']) : "";

    if($user_email && $post_url) {

        if(filter_var($user_email, FILTER_VALIDATE_EMAIL) && preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $post_url)) {

            $subject = __('Newsletter Post Url', 'fitmencook');
            ob_start();
                get_template_part('template-parts/newsletterEmail', null, [
                    'post_url' => $post_url
                ]);

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