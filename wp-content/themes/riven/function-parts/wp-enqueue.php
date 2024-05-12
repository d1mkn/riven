<?php

/**
 * Enqueue scripts and styles.
 */

add_action('wp_enqueue_scripts', 'enqueue_styles_scripts');
function enqueue_styles_scripts()
{
    //    style
    wp_enqueue_style('main-css', get_template_directory_uri() . '/dist/css/main.css', [], _S_VERSION);
    wp_enqueue_style('components-css', get_template_directory_uri() . '/dist/css/components/components.css', [], _S_VERSION);
    wp_enqueue_style('form-css', get_template_directory_uri() . '/dist/css/components/separate/form.css', [], _S_VERSION);

    //    script
    wp_enqueue_script('main-js', get_template_directory_uri() . '/dist/js/main.js', [], _S_VERSION, true);
}

// ###############################################################################
