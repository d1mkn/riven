<?php

$about_us_fields = get_fields();

if (!empty($about_us_fields)) :
    $first_title_about_us = $about_us_fields['first_title_about_us'] ?? '';
    $first_items_about_us = $about_us_fields['first_items_about_us'] ?? '';

    $second_title_about_us = $about_us_fields['second_title_about_us'] ?? '';
    $second_items_about_us = $about_us_fields['second_items_about_us'] ?? ''; ?>

    <section class="about-us container">
        <?php
        if (!empty($first_title_about_us) && !empty($first_items_about_us)) : ?>
            <div class="about-us__left">
                <?php
                print_elem('h2', 'about-us__title h1-t', $first_title_about_us); ?>

                <div class="about-us__left-platform splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <?php
                            foreach ($first_items_about_us as $item) :
                                print_elem('li', 'about-us__item splide__slide', $item['item_about_us']);
                            endforeach; ?>
                        </ul>
                    </div>

                    <div class="splide__arrows">
                        <button class="splide__arrow splide__arrow--prev" type="button"></button>
                        <button class="splide__arrow splide__arrow--next" type="button"></button>
                    </div>
                </div>
            </div>
        <?php
        endif; ?>

        <?php
        if (!empty($second_title_about_us) && !empty($second_items_about_us)) : ?>
            <div class="about-us__right">
                <?php
                print_elem('h2', 'about-us__title h1-t', $second_title_about_us);
                ?>

                <div class="about-us__right-platform splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <?php
                            foreach ($second_items_about_us as $item) :
                                print_elem('li', 'about-us__item splide__slide', wp_get_attachment_image(
                                    $item['image_about_us'],
                                    'full',
                                    false,
                                    array(
                                        'alt' => $item['image_alt_about_us'] ?? 'Відгуки про RIVEN TRANS',
                                        'loading' => 'lazy',
                                        'decoding' => 'async',
                                    )
                                ));
                            endforeach; ?>
                        </ul>
                    </div>

                    <div class="splide__arrows">
                        <button class="splide__arrow splide__arrow--prev" type="button"></button>
                        <button class="splide__arrow splide__arrow--next" type="button"></button>
                    </div>
                </div>
            <?php
        endif; ?>
    </section>

<?php
endif;
