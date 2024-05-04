<?php

/**
 * Enable ACF Blocks render function
 */
if (!function_exists('theme_acf_blocks_render_callback')) {

    function theme_acf_blocks_render_callback($block)
    {

        $slug = str_replace('acf/', '', $block['name']);
        $slug = str_replace('acf-block-', '', $slug);

        if (file_exists(get_theme_file_path("/gu-blocks/acf-block-{$slug}.php"))) {
            include(get_theme_file_path("/gu-blocks/acf-block-{$slug}.php"));
        }
    }
}
// ###############################################################################################