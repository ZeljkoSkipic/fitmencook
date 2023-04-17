<?php

// Load Admin JS

function admin_scripts($hook)
{
    if ($hook === 'post.php') {
        $post_ID = isset($_GET['post']) ? wp_strip_all_tags($_GET['post']) : "";
        if ($post_ID) {
            $post_type = get_post_type($post_ID);
            wp_enqueue_script('admin-global-js', get_template_directory_uri() . '/js/admin.min.js');
        }
    }


    $localize_object = [
        'ajax_url'  => admin_url('admin-ajax.php')
    ];

    wp_localize_script('admin-global-js', 'globalAdminObject', $localize_object);
}

add_action('admin_enqueue_scripts', 'admin_scripts');

// Add Custom Column

add_filter('manage_posts_columns', 'add_custom_columns_recipes');
function add_custom_columns_recipes($columns)
{
    $columns['last_modified'] = 'Last modified';
    return $columns;
}

// Add data to column

add_action('manage_posts_custom_column', 'custom_columns_content', 10, 2);
function custom_columns_content($column_id, $post_id)
{
    switch ($column_id) {
        case 'last_modified':
            $date = new DateTime(get_post_field('post_modified', $post_id));
            $date_formated = $date->format('Y/m/d g:i a');
            echo $date_formated;
            break;
    }
}

// Make column sortable

add_filter('manage_edit-recipes_sortable_columns', 'sortable_mycpt_posts_columns');
add_filter('manage_edit-product_sortable_columns', 'sortable_mycpt_posts_columns');
add_filter('manage_edit-post_sortable_columns', 'sortable_mycpt_posts_columns');
add_filter('manage_edit-meal-plans_sortable_columns', 'sortable_mycpt_posts_columns');
function sortable_mycpt_posts_columns($columns)
{
    $columns['last_modified'] = 'Last modified';
    return $columns;
}

// Add option to change recipe modify time on single recipe

add_action('post_submitbox_misc_actions', 'change_modify_time_form', 1);

function change_modify_time_form($post)
{
    global $wp_locale;
    $datemodified = $post->post_modified;
    $stop_update = get_post_meta($post->ID, '_lmt_disableupdate', true);

    $jj = mysql2date('d', $datemodified, false);
    $mm = mysql2date('m', $datemodified, false);
    $aa = mysql2date('Y', $datemodified, false);
    $hh = mysql2date('H', $datemodified, false);
    $mn = mysql2date('i', $datemodified, false);
    $ss = mysql2date('s', $datemodified, false);
?>

    <div class="misc-pub-section curtime misc-pub-last-updated">
        <span id="wplmi-timestamp"> <?php esc_html_e('Updated on:', 'wp-last-modified-info') ?> <strong><?php echo get_the_modified_time('M j, Y \a\t H:i'); ?></strong></span>
        <a href="#edit_timestampmodified" class="edit-timestampmodified hide-if-no-js" role="button"><span aria-hidden="true"><?php esc_html_e('Edit', 'wp-last-modified-info'); ?></span> <span class="screen-reader-text"><?php esc_html_e('Edit modified date and time', 'wp-last-modified-info'); ?></span></a>
        <fieldset id="timestampmodifieddiv" class="hide-if-js" data-prefix="<?php esc_attr_e('Updated on:', 'wp-last-modified-info'); ?>" data-separator="<?php esc_attr_e('at', 'wp-last-modified-info'); ?>" style="padding-top: 5px;line-height: 1.76923076;">
            <legend class="screen-reader-text"><?php esc_html_e('Last modified date and time', 'wp-last-modified-info'); ?></legend>
            <div class="timestamp-wrap">
                <label>
                    <span class="screen-reader-text"><?php esc_html_e('Month', 'wp-last-modified-info'); ?></span>
                    <select id="mmm" name="mmm" class="time-modified">
                        <?php
                        for ($i = 1; $i < 13; $i++) {
                            $monthnum = zeroise($i, 2);
                            $monthtext = $wp_locale->get_month_abbrev($wp_locale->get_month($i));
                            echo '<option value="' . $monthnum . '" data-text="' . $monthtext . '" ' . selected($monthnum, $mm, false) . '>' . sprintf(__('%1$s-%2$s'), $monthnum, $monthtext) . '</option>';
                        }
                        ?>
                    </select>
                </label>
                <label>
                    <span class="screen-reader-text"><?php esc_html_e('Day', 'wp-last-modified-info'); ?></span>
                    <input type="text" id="jjm" class="time-modified jjm-edit" name="jjm" value="<?php echo $jj; ?>" size="2" maxlength="2" autocomplete="off" />
                </label>, <label>
                    <span class="screen-reader-text"><?php esc_html_e('Year', 'wp-last-modified-info'); ?></span>
                    <input type="text" id="aam" class="time-modified aam-edit" name="aam" value="<?php echo $aa; ?>" size="4" maxlength="4" autocomplete="off" />
                </label> <?php esc_html_e('at', 'wp-last-modified-info'); ?><label>
                    <span class="screen-reader-text"><?php esc_html_e('Hour', 'wp-last-modified-info'); ?></span>
                    <input type="text" id="hhm" class="time-modified hhm-edit" name="hhm" value="<?php echo $hh; ?>" size="2" maxlength="2" autocomplete="off" />
                </label><?php esc_html_e(':', 'wp-last-modified-info'); ?><label>
                    <span class="screen-reader-text"><?php esc_html_e('Minute', 'wp-last-modified-info'); ?></span>
                    <input type="text" id="mnm" class="time-modified mnm-edit" name="mnm" value="<?php echo $mn; ?>" size="2" maxlength="2" autocomplete="off" />
                </label>
            </div>
            <?php

            $currentlocal = current_time('timestamp', 0);
            $mm_current = gmdate('m', $currentlocal);
            $jj_current = gmdate('d', $currentlocal);
            $aa_current = gmdate('Y', $currentlocal);
            $hh_current = gmdate('H', $currentlocal);
            $mn_current = gmdate('i', $currentlocal);
            // Apr 23, 2024 at 15:39
            $vals = [
                'mmm' => [$mm, $mm_current],
                'jjm' => [$jj, $jj_current],
                'aam' => [$aa, $aa_current],
                'hhm' => [$hh, $hh_current],
                'mnm' => [$mn, $mn_current],
            ];

            foreach ($vals as $key => $val) {
                echo '<input type="hidden" id="hidden_' . $key . '" name="hidden_' . $key . '" value="' . $val[0] . '">';
                echo '<input type="hidden" id="cur_' . $key . '" name="cur_' . $key . '" value="' . $val[1] . '">';
            } ?>

            <input type="hidden" id="ssm" name="ssm" value="<?php echo $ss; ?>">
            <input type="hidden" id="wplmi-change-modified" name="wplmi_change" value="no">
            <input type="hidden" id="wplmi-disable-hidden" name="wplmi_disable" value="<?php echo ($stop_update) ? $stop_update : 'no'; ?>">
            <input type="hidden" id="wplmi-post-modified" name="wplmi_modified" value="<?php echo $datemodified; ?>">

            <p id="wplmi-meta" class="wplmi-meta-options">
                <a href="#edit_timestampmodified" class="save-timestamp hide-if-no-js button"><?php esc_html_e('OK', 'wp-last-modified-info '); ?></a>
                <a href="#edit_timestampmodified" class="cancel-timestamp hide-if-no-js button-cancel"><?php esc_html_e('Cancel', 'wp-last-modified-info'); ?></a>&nbsp;&nbsp;&nbsp;
                <label for="wplmi_disable" class="wplmi-disable-update" title="Keep this checked, if you do not want to change modified date and time">
                    <input type="checkbox" id="wplmi_disable" name="disableupdate" <?php if ($stop_update == 'yes') {
                                                                                        echo 'checked';
                                                                                    } ?>><?php esc_html_e('Lock Modified Date', 'wp-last-modified-info'); ?>
                </label>
            </p>
        </fieldset>
    </div>

<?php

}

// Save date in Db after updated button is clicked

add_action('save_post', 'save_modify_time_update_button', 10, 2);

function save_modify_time_update_button($post_ID, $post)
{

    $month = isset($_POST['mmm']) && $_POST['mmm']  ? wp_strip_all_tags($_POST['mmm']) : "";
    $day = isset($_POST['jjm']) && $_POST['jjm']  ? wp_strip_all_tags($_POST['jjm']) : "";
    $year = isset($_POST['aam']) && $_POST['aam']  ? wp_strip_all_tags($_POST['aam']) : "";
    $hours = isset($_POST['hhm']) && $_POST['hhm']  ? wp_strip_all_tags($_POST['hhm']) : "";
    $minutes = isset($_POST['mnm']) && $_POST['mnm']  ? wp_strip_all_tags($_POST['mnm']) : "";

    $current_month = isset($_POST['cur_mmm']) && $_POST['cur_mmm']  ? wp_strip_all_tags($_POST['cur_mmm']) : "";
    $current_day = isset($_POST['cur_jjm']) && $_POST['cur_jjm']  ? wp_strip_all_tags($_POST['cur_jjm']) : "";
    $current_year = isset($_POST['cur_aam']) && $_POST['cur_aam']  ? wp_strip_all_tags($_POST['cur_aam']) : "";
    $current_hours = isset($_POST['cur_hhm']) && $_POST['cur_hhm']  ? wp_strip_all_tags($_POST['cur_hhm']) : "";
    $current_minutes = isset($_POST['cur_mnm']) && $_POST['cur_mnm']  ? wp_strip_all_tags($_POST['cur_mnm']) : "";

    $old_month = isset($_POST['hidden_mmm']) && $_POST['hidden_mmm']  ? wp_strip_all_tags($_POST['hidden_mmm']) : "";
    $old_day = isset($_POST['hidden_jjm']) && $_POST['hidden_jjm']  ? wp_strip_all_tags($_POST['hidden_jjm']) : "";
    $old_year = isset($_POST['hidden_aam']) && $_POST['hidden_aam']  ? wp_strip_all_tags($_POST['hidden_aam']) : "";
    $old_hours = isset($_POST['hidden_hhm']) && $_POST['hidden_hhm']  ? wp_strip_all_tags($_POST['hidden_hhm']) : "";
    $old_minutes = isset($_POST['hidden_mnm']) && $_POST['hidden_mnm']  ? wp_strip_all_tags($_POST['hidden_mnm']) : "";


    $lock_time = isset($_POST['disableupdate']) ? wp_strip_all_tags($_POST['disableupdate']) : "no";

    if (
        $month &&  $day && $year && $hours && $minutes &&
        $current_month &&  $current_day && $current_year && $current_hours &&  $current_minutes
        && $old_month &&  $old_day && $old_year &&  $old_hours && $old_minutes
    ) {


        // Save lock time to meta for the post

        $stop_update = get_post_meta($post->ID, '_lmt_disableupdate', true);


        $modify_date = [
            'month'             => $month,
            'day'               => $day,
            'year'              => $year,
            'hours'             => $hours,
            'minutes'           => $minutes,
            'current_month'     => $current_month,
            'current_day'       => $current_day,
            'current_year'      => $current_year,
            'current_hours'     => $current_hours,
            'current_minutes'   => $current_minutes,
            'old_month'         => $old_month,
            'old_day'           => $old_day,
            'old_year'          => $old_year,
            'old_hours'         => $old_hours,
            'old_minutes'       => $old_minutes,
            'lock'              => $stop_update
        ];

        if ($lock_time !== 'no') {
            update_post_meta($post_ID, '_lmt_disableupdate', 'yes');
        } else {
            update_post_meta($post_ID, '_lmt_disableupdate', 'no');
        }

        query_formated_date($modify_date, $post_ID);
    }
}

// Format Date, Wp Query

function query_formated_date($modify_date, $post_ID)
{
    $modify_date_string = $modify_date['month'] . "/" . $modify_date['day'] . "/" . $modify_date['year'] . " " . $modify_date['hours'] . ":" . $modify_date['minutes'];
    $modify_current_day_string = $modify_date['current_month'] . "/" . $modify_date['current_day'] . "/" . $modify_date['current_year'] . " " . $modify_date['current_hours'] . ":" . $modify_date['current_minutes'];
    $modify_old_day_string = $modify_date['old_month'] . "/" . $modify_date['old_day'] . "/" . $modify_date['old_year'] . " " . $modify_date['old_hours'] . ":" . $modify_date['old_minutes'];
    $date_formated = new DateTime($modify_date_string);
    $date_formated = $date_formated->format('Y-m-d H:i:s');
    $current_date_formated = new DateTime($modify_current_day_string);
    $current_date_formated = $current_date_formated->format('Y-m-d H:i:s');
    $old_date_formated = new DateTime($modify_old_day_string);
    $old_date_formated = $old_date_formated->format('Y-m-d H:i:s');
    global $wpdb;
    $prefix = $wpdb->prefix;


    if ($modify_date['lock'] === 'yes') {
        $wpdb->update($prefix . 'posts', ['post_modified' => $date_formated, 'post_modified_gmt' => get_gmt_from_date($date_formated)], ['id' => $post_ID]);
    } else {
        if ($date_formated != $old_date_formated) {
            $wpdb->update($prefix . 'posts', ['post_modified' => $date_formated, 'post_modified_gmt' => get_gmt_from_date($date_formated)], ['id' => $post_ID]);
        } else {
            $wpdb->update($prefix . 'posts', ['post_modified' => $current_date_formated, 'post_modified_gmt' => get_gmt_from_date($current_date_formated)], ['id' => $post_ID]);
        }
    }
}
