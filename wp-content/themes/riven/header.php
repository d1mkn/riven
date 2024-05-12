<?php

/**
 * The header for our theme
 *
 * @package riven
 */
?>

<!doctype html>
<html lang="uk-UA">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header class="header container">
        <?= get_custom_logo(); ?>

        <nav class="header__nav">
            <ul class="header__nav-list">
                <?php
                printNavEls(get_queried_object_id(), 'header__nav-item h2-t'); ?>
            </ul>
        </nav>

        <button class="header__burger">
            <i class="icon-burger"></i>
            <i class="icon-close"></i>
        </button>
    </header>