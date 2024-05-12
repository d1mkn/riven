<?php

$blog_fields = get_fields();

if (!empty($blog_fields)) :
    $title_blog = $blog_fields['title_blog'] ?? '';
    $items_blog = $blog_fields['items_blog'] ?? [];

    if (!empty($items_blog)) : ?>

        <section class="blog container" id="Блог">
            <?php
            print_elem('h2', 'blog__title h1-t', $title_blog); ?>

            <div class="blog__platform splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php
                        foreach ($items_blog as $item) : ?>
                            <li class="blog__item splide__slide">
                                <?php
                                print_elem('h3', 'blog__item-title h2-t', $item['item_title_blog']); ?>

                                <div class="blog__item-content">
                                    <?php
                                    print_elem('div', 'blog__item-text', $item['item_text_blog']); ?>

                                    <button class="blog__item-button btn btn-green" data-see-more="trigger">
                                        <span class="blog__item-button-text-more h2-t">Читати більше</span>
                                        <span class="blog__item-button-text-less h2-t">Закрити</span>
                                    </button>
                                </div>
                            </li>
                        <?php
                        endforeach; ?>
                    </ul>
                </div>

                <div class="splide__arrows">
                    <button class="splide__arrow splide__arrow--prev" type="button"></button>
                    <button class="splide__arrow splide__arrow--next" type="button"></button>
                </div>
            </div>
        </section>

    <?php
    endif; ?>
<?php
endif; ?>