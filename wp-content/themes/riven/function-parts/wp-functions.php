<?php
/*Allow .svg in Media Uploader*/
add_filter('upload_mimes', 'svg_mime_types');
function svg_mime_types($mimes)
{
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg';
    $file_types = array_merge($mimes, $new_filetypes);

    return $file_types;
}
############################################################################

/* Fix fatal error when use wp function "is_plugin_active" */
if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
}
// ###############################################################################################