<?php

/**
 * Отключаем принудительную проверку новых версий WP, плагинов и темы в админке,
 * чтобы она не тормозила, когда долго не заходил и зашел...
 * Все проверки будут происходить незаметно через крон или при заходе на страницу: "Консоль > Обновления".
 *
 * @see https://wp-kama.ru/filecode/wp-includes/update.php
 * @author Kama (https://wp-kama.ru)
 * @version 1.1
 */
if (is_admin()) {
	// отключим проверку обновлений при любом заходе в админку...
	remove_action('admin_init', '_maybe_update_core');
	remove_action('admin_init', '_maybe_update_plugins');
	remove_action('admin_init', '_maybe_update_themes');

	// отключим проверку обновлений при заходе на специальную страницу в админке...
	remove_action('load-plugins.php', 'wp_update_plugins');
	remove_action('load-themes.php', 'wp_update_themes');

	// оставим принудительную проверку при заходе на страницу обновлений...
	//remove_action( 'load-update-core.php', 'wp_update_plugins' );
	//remove_action( 'load-update-core.php', 'wp_update_themes' );

	// внутренняя страница админки "Update/Install Plugin" или "Update/Install Theme" - оставим не мешает...
	//remove_action( 'load-update.php', 'wp_update_plugins' );
	//remove_action( 'load-update.php', 'wp_update_themes' );

	// событие крона не трогаем, через него будет проверяться наличие обновлений - тут все отлично!
	//remove_action( 'wp_version_check', 'wp_version_check' );
	//remove_action( 'wp_update_plugins', 'wp_update_plugins' );
	//remove_action( 'wp_update_themes', 'wp_update_themes' );

	/**
	 * отключим проверку необходимости обновить браузер в консоли - мы всегда юзаем топовые браузеры!
	 * эта проверка происходит раз в неделю...
	 * @see https://wp-kama.ru/function/wp_check_browser_version
	 */
	add_filter('pre_site_transient_browser_' . md5($_SERVER['HTTP_USER_AGENT']), '__return_empty_array');
}

// Удаляем link rel="canonical" // Этот тег лучше выводить с помощью плагина Yoast SEO или All In One SEO Pack
remove_action('wp_head', 'rel_canonical');
// на предыдущую запись
remove_action('wp_head', 'parent_post_rel_link', 10);

// Удаляем ненужный css плагина WP-PageNavi
remove_action('wp_head', 'pagenavi_css');
remove_action('wp_head', 'feed_links_extra', 3); // убирает ссылки на rss категорий
remove_action('wp_head', 'feed_links', 2); // минус ссылки на основной rss и комментарии
remove_action('wp_head', 'rsd_link');  // сервис Really Simple Discovery
remove_action('wp_head', 'wlwmanifest_link'); // Windows Live Writer
remove_action('wp_head', 'wp_generator');  // скрыть версию wordpress
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('template_redirect', 'rest_output_link_header', 11, 0);

function disable_wp_emojicons()
{

	// all actions related to emojis
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');

	// filter to remove TinyMCE emojis
	add_filter('tiny_mce_plugins', 'disable_emojicons_tinymce');
}
add_action('init', 'disable_wp_emojicons');

function disable_emojicons_tinymce($plugins)
{
	if (is_array($plugins)) {
		return array_diff($plugins, array('wpemoji'));
	} else {
		return array();
	}
}

//Новый вордпресс добавляет в хед ненужные нашему сайту инлайновые стили, код ниже их убирает
add_action('wp_enqueue_scripts', function () {
	wp_dequeue_style('classic-theme-styles');
}, 20);

add_filter('emoji_svg_url', '__return_false');
remove_action('wp_head', 'wp_generator');

function empty_shortlink($shortlink, $id, $context, $allow_slugs)
{
	return NULL;
}
add_filter('get_shortlink', 'empty_shortlink', 10, 4);


add_action('widgets_init', 'unregister_basic_widgets');
function unregister_basic_widgets()
{
	unregister_widget('WP_Widget_Pages');            // Виджет страниц
	unregister_widget('WP_Widget_Calendar');         // Календарь
	unregister_widget('WP_Widget_Archives');         // Архивы
	unregister_widget('WP_Widget_Links');            // Ссылки
	unregister_widget('WP_Widget_Meta');             // Мета виджет
	unregister_widget('WP_Widget_Search');           // Поиск
	unregister_widget('WP_Widget_Text');             // Текст
	unregister_widget('WP_Widget_Categories');       // Категории
	unregister_widget('WP_Widget_Recent_Posts');     // Последние записи
	unregister_widget('WP_Widget_Recent_Comments');  // Последние комментарии
	unregister_widget('WP_Widget_RSS');              // RSS
	unregister_widget('WP_Widget_Tag_Cloud');        // Облако меток
	unregister_widget('WP_Nav_Menu_Widget');         // Меню
	unregister_widget('WP_Widget_Media_Audio');      // Audio
	unregister_widget('WP_Widget_Media_Video');      // Video
	unregister_widget('WP_Widget_Media_Gallery');    // Gallery
	unregister_widget('WP_Widget_Media_Image');      // Image
}


/* --------------------------------------------------------------------------
*  Отключаем wp-json
* -------------------------------------------------------------------------- */

// Отключаем сам REST API
add_filter('rest_enabled', '__return_false');

// // Отключаем фильтры REST API
remove_action('xmlrpc_rsd_apis',            'rest_output_rsd');
remove_action('wp_head',                    'rest_output_link_wp_head', 10, 0);
remove_action('template_redirect',          'rest_output_link_header', 11, 0);
remove_action('auth_cookie_malformed',      'rest_cookie_collect_status');
remove_action('auth_cookie_expired',        'rest_cookie_collect_status');
remove_action('auth_cookie_bad_username',   'rest_cookie_collect_status');
remove_action('auth_cookie_bad_hash',       'rest_cookie_collect_status');
remove_action('auth_cookie_valid',          'rest_cookie_collect_status');
remove_filter('rest_authentication_errors', 'rest_cookie_check_errors', 100);

// // Отключаем события REST API
// remove_action( 'init',          'rest_api_init' );
remove_action('rest_api_init', 'rest_api_default_filters', 10, 1);
// remove_action( 'parse_request', 'rest_api_loaded' );

// // Отключаем Embeds связанные с REST API
remove_action('rest_api_init',          'wp_oembed_register_route');
remove_filter('rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4);

// remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
// если собираетесь выводить вставки из других сайтов на своем, то закомментируйте след. строку.
remove_action('wp_head',                'wp_oembed_add_host_js');

// /* --------------------------------------------------------------------------
// *  Отключаем wp-json
// * -------------------------------------------------------------------------- */

/* --------------------------------------------------------------------------
*  Удаляем опасные методы работы XML-RPC Pingback
* -------------------------------------------------------------------------- */
add_filter('xmlrpc_methods', 'sheensay_block_xmlrpc_attacks');

function sheensay_block_xmlrpc_attacks($methods)
{
	unset($methods['pingback.ping']);
	unset($methods['pingback.extensions.getPingbacks']);
	return $methods;
}

add_filter('wp_headers', 'sheensay_remove_x_pingback_header');

function sheensay_remove_x_pingback_header($headers)
{
	unset($headers['X-Pingback']);
	return $headers;
}
/* --------------------------------------------------------------------------
*  Удаляем опасные методы работы XML-RPC Pingback
* -------------------------------------------------------------------------- */

/***********************************************************************
WordPress - Отключаем загрузку файла dashicons.min.css стилей, не для Админов
 ************************************************************************/
// remove dashicons
function wpdocs_dequeue_dashicon()
{
	if (current_user_can('update_core')) {
		return;
	}
	wp_deregister_style('dashicons');
}
add_action('wp_enqueue_scripts', 'wpdocs_dequeue_dashicon');
/***********************************************************************
 ************************************************************************/
//REMOVE GUTENBERG BLOCK LIBRARY CSS FROM LOADING ON FRONTEND
function remove_wp_block_library_css()
{
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('wp-block-library-theme');
	wp_dequeue_style('wc-block-style'); // REMOVE WOOCOMMERCE BLOCK CSS
	wp_dequeue_style('global-styles'); // REMOVE THEME.JSON
}
add_action('wp_enqueue_scripts', 'remove_wp_block_library_css', 100);

// Remove duotone filters in markup (Gutenberg plugin is deactivated/activated)
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
remove_action('wp_body_open', 'gutenberg_global_styles_render_svg_filters');

// Disabling theme and plugin editors
define('DISALLOW_FILE_EDIT', true);
################################################################################################

/** Disable the scrolling effect on field validation errors
 *
 *  @link   https://wpforms.com/developers/how-to-disable-the-scrolling-effect-on-field-validation/
 */
function wpf_dev_disable_scroll_to_error()
{

	// If scrollToError is disabled for at least one form on the page, it will be disabled for all the forms on the page.
?>

	<script type="text/javascript">
		wpforms.scrollToError = function() {};
	</script>

<?php
}
add_action('wpforms_wp_footer_end', 'wpf_dev_disable_scroll_to_error', 10);
################################################################################################
