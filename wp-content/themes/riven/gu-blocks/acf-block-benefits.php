<?php

$benefits_fields = get_fields();

if (!empty($benefits_fields)) :
    $title_benefits = $benefits_fields['title_benefits'] ?? '';
    $subtitle_benefits = $benefits_fields['subtitle_benefits'] ?? '';
    $items_benefits = $benefits_fields['items_benefits'] ?? []; ?>

    <section class="benefits container" id="Переваги">
        <?php
        print_elem('h2', 'benefits__title h1-t', $title_benefits);
        print_elem('p', 'benefits__subtitle s1-t', $subtitle_benefits);

        if (!empty($items_benefits)) : ?>
            <ul class="benefits__list">
                <?php
                foreach ($items_benefits as $i => $item) :
                    echo '<li class="benefits__item">';
                    print_elem('figure', 'benefits__item-icon', wp_get_attachment_image(
                        $item['icon_benefits'],
                        'full',
                        false,
                        array(
                            'alt' => $item['icon_alt_benefits'],
                            'loading' => 'lazy',
                            'decoding' => 'async',
                        )
                    ));
                    print_elem('p', 'benefits__item-descr h2-t', $item['descr_benefits']);
                    echo '</li>';
                endforeach; ?>
            </ul>
        <?php
        endif; ?>
    </section>
<?php
endif; ?>