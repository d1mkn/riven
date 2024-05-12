<?php

$promo_fields = get_fields();

if (!empty($promo_fields)) :
    $image_promo = $promo_fields['image_promo'] ?? '';
    $image_alt_promo = $promo_fields['image_alt_promo'] ?? '';
    $logo_promo = $promo_fields['logo_promo'] ?? '';
    $logo_alt_promo = $promo_fields['logo_promo'] ?? '';
    $first_line_promo = $promo_fields['first_line_promo'] ?? '';
    $second_line_promo = $promo_fields['second_line_promo'] ?? '';
    $third_line_promo = $promo_fields['third_line_promo'] ?? ''; ?>

    <section class="promo container" id="Головна">
        <?php
        print_elem('figure', 'promo__img', wp_get_attachment_image(
            $image_promo,
            'full',
            false,
            array(
                'alt' => $image_alt_promo,
                'loading' => 'eager',
                'decoding' => 'async',
            )
        )); ?>

        <?php
        print_elem('figure', 'promo__logo', wp_get_attachment_image(
            $logo_promo,
            'full',
            false,
            array(
                'alt' => $logo_alt_promo,
                'loading' => 'eager',
                'decoding' => 'async',
            )
        ));

        print_elem('h1', 'promo__title s1-t', $first_line_promo);
        print_elem('p', 'promo__text h3-t', $second_line_promo);
        print_elem('p', 'promo__action h3-t', $third_line_promo);
        print_elem('button', 'promo__button h1-t btn btn-red', 'Замовити', 'data-popup-trigger="popup-callback"');
        print_link($GLOBALS['phone_number_href'], 'promo__phone h1-t', $GLOBALS['phone_number_content'], null, false, true); ?>

        <dialog class="popup__overlay" data-popup-name="popup-callback">
            <div class="popup__content promo__popup">
                <button class="popup__close icon-close icomoon btn" aria-label="Закрити попап" data-popup-close="popup-callback"></button>

                <p class="popup__title h1-t">Зворотній зв’язок</p>
                <?= do_shortcode('[wpforms id="31"]') ?>
            </div>
        </dialog>
    </section>

<?php
endif;
