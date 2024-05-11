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
                'keywords'        => ['title', 'subtitle', 'benefits'],
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
 * ACF Gutenberg Block "ACF Block Services"
 */
if (!function_exists('services')) {

    function services()
    {

        acf_register_block_type(
            [
                'name'            => 'Services',
                'title'           => __('Services'),
                'render_callback' => 'theme_acf_blocks_render_callback',
                'category'        => 'common',
                'icon'            => 'grid-view',
                'keywords'        => ['title', 'subtitle', 'services'],
                'mode'            => 'edit',
                'enqueue_assets' => function () {
                    if (!is_admin()) :
                        wp_enqueue_style('services-css', get_template_directory_uri() . '/dist/css/gu-blocks/acf-block-services.css',  [], _S_VERSION);

                        wp_enqueue_script('services-js', get_template_directory_uri() . '/dist/js/gu-blocks/acf-block-services.js',  [], _S_VERSION);
                    endif;
                }
            ]
        );
    }
}

if (function_exists('services')) {
    add_action('acf/init', 'services');
}

// ###############################################################################################

/**
 * ACF Gutenberg Block "ACF Block About Us"
 */
if (!function_exists('about_us')) {

    function about_us()
    {

        acf_register_block_type(
            [
                'name'            => 'About Us',
                'title'           => __('About Us'),
                'render_callback' => 'theme_acf_blocks_render_callback',
                'category'        => 'common',
                'icon'            => 'grid-view',
                'keywords'        => ['title', 'subtitle', 'about', 'us', 'reviews', 'testimonials'],
                'mode'            => 'edit',
                'enqueue_assets' => function () {
                    if (!is_admin()) :
                        wp_enqueue_style('about-us-css', get_template_directory_uri() . '/dist/css/gu-blocks/acf-block-about-us.css',  ['splide-css'], _S_VERSION);
                        wp_enqueue_style('splide-css', get_template_directory_uri() . '/dist/css/libs/splide/index.css', [], _S_VERSION);

                        wp_enqueue_script('about-us-js', get_template_directory_uri() . '/dist/js/gu-blocks/acf-block-about-us.js',  ['splide-js'], _S_VERSION);
                        wp_enqueue_script('splide-js', get_template_directory_uri() . '/dist/js/libs/splide.min.js', [], _S_VERSION, true);
                    endif;
                }
            ]
        );
    }
}

if (function_exists('about_us')) {
    add_action('acf/init', 'about_us');
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