<?php

$services_fields = get_fields();

if (!empty($services_fields)) :
    $title_services = $services_fields['title_services'] ?? '';
    $items_services = $services_fields['items_services'] ?? []; ?>

    <section class="services container" id="Послуги">
        <?php
        print_elem('h2', 'services__title h1-t', $title_services);

        if (!empty($items_services)) : ?>
            <ul class="services__list">
                <?php
                foreach ($items_services as $i => $item) :
                    echo '<li class="services__item" data-see-more="item">';
                    print_elem('figure', 'services__item-img', wp_get_attachment_image(
                        $item['img_services'],
                        'full',
                        false,
                        array(
                            'alt' => $item['img_alt_services'],
                            'loading' => 'lazy',
                            'decoding' => 'async',
                        )
                    )); ?>

                    <div class="services__item-text">
                        <?php
                        print_elem('p', 'services__item-caption h2-t', $item['caption_services']);
                        print_elem('p', 'services__item-descr h2-t', $item['descr_services']); ?>
                    </div>
                <?php
                    echo '</li>';
                endforeach; ?>
            </ul>

            <button class="services__button btn btn-green" data-see-more="trigger">
                <span class="services__button-text-more h2-t">Інші послуги</span>
                <i class="icon-arrow"></i>
                <span class="services__button-text-less h2-t">Згорнути</span>
            </button>
        <?php
        endif; ?>
    </section>

<?php
endif;
