<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package riven
 */

?>
<footer class="footer container" id="Контакти">
    <nav class="footer__nav">
        <ul class="footer__nav-list">
            <?php
            printNavEls(get_queried_object_id(), 'footer__nav-item h2-t'); ?>
        </ul>
    </nav>

    <div class="footer__form-wrap">
        <p class="footer__form-title h1-t">Зворотній зв’язок</p>
        <?= do_shortcode('[wpforms id="156"]') ?>
    </div>

    <div class="footer__contacts">
        <span class="footer__contacts-title h1-t">Контакти</span>

        <address class="footer__contacts-address">
            <span class="s1-t">Телефон:</span>
            <?= print_link($GLOBALS['phone_number_href'], 'footer__contacts-phone h2-t', $GLOBALS['phone_number_content'], null, false, true); ?>

            <span class="s1-t">Пошта:</span>
            <?= print_link($GLOBALS['email'], 'footer__contacts-email h2-t', $GLOBALS['email'], null, true); ?>
        </address>

        <div class="footer__socials">
            <span class="footer__socials-title s1-t">Соціальні мережі:</span>
            <div class="footer__socials-icons">
                <?php
                print_link($GLOBALS['facebook_href'], 'footer__socials-facebook', '<i class="icon-facebook"></i>', 'target="_blank"');
                print_link($GLOBALS['instagram_href'], 'footer__socials-instagram', '<i class="icon-instagram"></i>', 'target="_blank"');
                print_link($GLOBALS['tt_href'], 'footer__socials-tiktok', '<i class="icon-tiktok"></i>', 'target="_blank"'); ?>
            </div>
        </div>
    </div>

</footer>

<?php wp_footer(); ?>
</body>


</html>