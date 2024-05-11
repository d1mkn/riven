<?php

/**
 * ACF Gutenberg Block "ACF Block Promo"
 */
if (!function_exists('promo')) {

    function promo()
    {

        acf_register_block_type(
            [
                'name'            => 'Promo',
                'title'           => __('Promo'),
                'render_callback' => 'theme_acf_blocks_render_callback',
                'category'        => 'common',
                'icon'            => 'cover-image',
                'keywords'        => ['title', 'subtitle', 'phone', 'image', 'promo'],
                'mode'            => 'edit',
                'enqueue_assets' => function () {
                    if (!is_admin()) :
                        wp_enqueue_style('promo-css', get_template_directory_uri() . '/dist/css/gu-blocks/acf-block-promo.css',  ['popup-css'], _S_VERSION);

                        wp_enqueue_style('popup-css', get_template_directory_uri() . '/dist/css/components/separate/popup.css', [], _S_VERSION);
                        wp_enqueue_style('form-css', get_template_directory_uri() . '/dist/css/components/separate/form.css', [], _S_VERSION);
                    endif;
                }
            ]
        );
    }
}

if (function_exists('promo')) {
    add_action('acf/init', 'promo');
}

// ###############################################################################################

/**
 * ACF Gutenberg Block "ACF Block Benefits"
 */
if (!function_exists('benefits')) {

    function benefits()
    {

        acf_register_block_type(
            [
                'name'            => 'Benefits',
                'title'           => __('Benefits'),
                'render_callback' => 'theme_acf_blocks_render_callback',
                'category'        => 'common',
                'icon'            => 'editor-insertmore',
                'keywords'        => ['title', 'subtitle','benefits'],
                'mode'            => 'edit',
                'enqueue_assets' => function () {
                    if (!is_admin()) :
                        wp_enqueue_style('benefits-css', get_template_directory_uri() . '/dist/css/gu-blocks/acf-block-benefits.css',  [], _S_VERSION);
                    endif;
                }
            ]
        );
    }
}

if (function_exists('benefits')) {
    add_action('acf/init', 'benefits');
}

// ###############################################################################################

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