<?php
if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '202405042235');
}
define('THEME_PATH', __DIR__);

require 'function-parts/wp-functions.php';
require 'function-parts/wp-theme-clean.php';
require 'function-parts/wp-enqueue.php';
require 'function-parts/wp-register-nav-menu.php';
require 'function-parts/wp-acf-options-page.php';
require 'function-parts/wp-theme-support.php';
require 'function-parts/wp-global-vars.php';
require 'gu-blocks/acf_blocks_enable.php';
