<?php

/**
 * Theme functions & definitations
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package highlt
 */

/**
 * Define Theme Folder Path & URL Constant
 * @package highlt
 * @since 2.0.1
 */

define('HIGHLT_THEME_ROOT', get_template_directory());
define('HIGHLT_THEME_ROOT_URL', get_template_directory_uri());
define('HIGHLT_INC', HIGHLT_THEME_ROOT . '/inc');
define('HIGHLT_THEME_SETTINGS', HIGHLT_INC . '/theme-settings');
define('HIGHLT_THEME_SETTINGS_IMAGES', HIGHLT_THEME_ROOT_URL . '/inc/theme-settings/images');
define('HIGHLT_TGMA', HIGHLT_INC . '/plugins/tgma');
define('HIGHLT_DYNAMIC_STYLESHEETS', HIGHLT_INC . '/theme-stylesheets');
define('HIGHLT_CSS', HIGHLT_THEME_ROOT_URL . '/assets/css');
define('HIGHLT_JS', HIGHLT_THEME_ROOT_URL . '/assets/js');
define('HIGHLT_ASSETS', HIGHLT_THEME_ROOT_URL . '/assets');
define('HIGHLT_DEV', true);


/**
 * Theme Initial File
 * @package highlt
 * @since 1.0.0
 */
if (file_exists(HIGHLT_INC . '/theme-init.php')) {
	require_once HIGHLT_INC . '/theme-init.php';
}


/**
 * Codester Framework Functions
 * @package highlt
 * @since 1.0.0
 */
if (file_exists(HIGHLT_INC . '/theme-cs-function.php')) {
	require_once HIGHLT_INC . '/theme-cs-function.php';
}


/**
 * Theme Helpers Functions
 * @package highlt
 * @since 1.0.0
 */
if (file_exists(HIGHLT_INC . '/theme-helper-functions.php')) {
	require_once HIGHLT_INC . '/theme-helper-functions.php';

	if (!function_exists('highlt')) {
		function highlt()
		{
			return class_exists('Highlt_Helper_Functions') ? Highlt_Helper_Functions::getInstance() : false;
		}
	}
}
/**
 * Nav menu fallback function
 * @since 1.0.0
 */
if (is_user_logged_in()) {
	function highlt_theme_fallback_menu()
	{
		get_template_part('template-parts/default', 'menu');
	}
}