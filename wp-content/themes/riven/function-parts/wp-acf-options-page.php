<?php
// Global settings

if (is_plugin_active('advanced-custom-fields-pro/acf.php')) {
    if (function_exists('acf_add_options_page')) {

        acf_add_options_page(array(
            'page_title'     => 'Site Main Data',
            'menu_title'    => 'Main Data',
            'menu_slug'     => 'site-main-data',
            'capability'    => 'edit_posts',
            'redirect'        => false
        ));
    }
}
