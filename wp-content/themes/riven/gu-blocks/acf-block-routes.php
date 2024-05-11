<?php

$routes_fields = get_fields();

if (!empty($routes_fields)) :
    $title_routes = $routes_fields['title_routes'] ?? '';
    $subtitle_routes = $routes_fields['subtitle_routes'] ?? '';
    $mob_image_routes = $routes_fields['mob_image_routes'] ?? '';
    $desk_image_routes = $routes_fields['desk_image_routes'] ?? '';
    $image_alt_routes = $routes_fields['image_alt_routes'] ?? ''; ?>

    <section class="routes container">
        <?php
        echo '<div class="routes__text-wrap">';
        print_elem('h2', 'routes__title h1-t', $title_routes);
        print_elem('p', 'routes__subtitle', $subtitle_routes);
        echo '</div>';

        print_picture(wp_get_attachment_image(
            $desk_image_routes,
            'full',
            false,
            array(
                'alt' => $image_alt_routes,
                'loading' => 'eager',
                'decoding' => 'async',
            )
        ), wp_get_attachment_image_url($mob_image_routes), 'routes__img'); ?>
    </section>

<?php
endif; ?>