<?php
add_action('after_setup_theme', 'theme_setup');
if (!function_exists('theme_setup')) :
    function theme_setup()
    {

        add_theme_support('title-tag');

        add_theme_support('post-thumbnails');

        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        add_theme_support(
            'custom-logo',
            array(
                'flex-width'  => true,
                'flex-height' => true,
                'unlink-homepage-logo' => true,
            )
        );

        // Add img attr for custom-logo
        add_filter('get_custom_logo_image_attributes',  'filter_function_change_alt');
        function  filter_function_change_alt($custom_logo_attr)
        {
            $custom_logo_attr = array(
                'loading' => 'auto',
                'decoding' => 'async',
                'height'      => 51,
                'width'       => 170,
                'alt'       => '',
            );

            return $custom_logo_attr;
        }
        // ###############################################################################################

    }
endif;
