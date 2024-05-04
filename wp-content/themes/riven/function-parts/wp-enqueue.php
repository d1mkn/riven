<?php

/**
 * Enqueue scripts and styles.
 */

add_action('wp_enqueue_scripts', 'enqueue_styles_scripts');
function enqueue_styles_scripts()
{
    //    style
    wp_enqueue_style('main-css', get_template_directory_uri() . '/dist/css/main.css', [], _S_VERSION);
}

// ###############################################################################
