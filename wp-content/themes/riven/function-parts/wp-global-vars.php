<?php
// Global vars

$main_data = '';
$phone_number_href = '';
$phone_number_content = '';
$email = '';
$facebook_href = '';
$instagram_href = '';
$tt_href = '';

add_action('wp_head', 'set_global_vars');
function set_global_vars()
{
    if (is_plugin_active('advanced-custom-fields-pro/acf.php')) :

        $GLOBALS['main_data'] = get_fields('options') ?? [];

        if (!empty($GLOBALS['main_data'])) :
            $GLOBALS['phone_number_href'] = $GLOBALS['main_data']['phone_number_href'] ?? '';
            $GLOBALS['phone_number_content'] = $GLOBALS['main_data']['phone_number_content'] ?? '';
            $GLOBALS['email'] = $GLOBALS['main_data']['email'] ?? '';
            $GLOBALS['facebook_href'] = $GLOBALS['main_data']['facebook_href'] ?? '';
            $GLOBALS['instagram_href'] = $GLOBALS['main_data']['instagram_href'] ?? '';
            $GLOBALS['tt_href'] = $GLOBALS['main_data']['tt_href'] ?? '';
        endif;

    endif;
}
