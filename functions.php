<?php

/**
 * Theme functions & definitations
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package highit
 */

/**
 * Define Theme Folder Path & URL Constant
 * @package highit
 * @since 2.0.1
 */

define('HIGHIT_THEME_ROOT', get_template_directory());
define('HIGHIT_THEME_ROOT_URL', get_template_directory_uri());
define('HIGHIT_INC', HIGHIT_THEME_ROOT . '/inc');
define('HIGHIT_THEME_SETTINGS', HIGHIT_INC . '/theme-settings');
define('HIGHIT_THEME_SETTINGS_IMAGES', HIGHIT_THEME_ROOT_URL . '/inc/theme-settings/images');
define('HIGHIT_TGMA', HIGHIT_INC . '/plugins/tgma');
define('HIGHIT_DYNAMIC_STYLESHEETS', HIGHIT_INC . '/theme-stylesheets');
define('HIGHIT_CSS', HIGHIT_THEME_ROOT_URL . '/assets/css');
define('HIGHIT_JS', HIGHIT_THEME_ROOT_URL . '/assets/js');
define('HIGHIT_ASSETS', HIGHIT_THEME_ROOT_URL . '/assets');
define('HIGHIT_DEV', true);


/**
 * Theme Initial File
 * @package highit
 * @since 1.0.0
 */
if (file_exists(HIGHIT_INC . '/theme-init.php')) {
	require_once HIGHIT_INC . '/theme-init.php';
}


/**
 * Codester Framework Functions
 * @package highit
 * @since 1.0.0
 */
if (file_exists(HIGHIT_INC . '/theme-cs-function.php')) {
	require_once HIGHIT_INC . '/theme-cs-function.php';
}


/**
 * Theme Helpers Functions
 * @package highit
 * @since 1.0.0
 */
if (file_exists(HIGHIT_INC . '/theme-helper-functions.php')) {
	require_once HIGHIT_INC . '/theme-helper-functions.php';

	if (!function_exists('highit')) {
		function highit()
		{
			return class_exists('Highit_Helper_Functions') ? Highit_Helper_Functions::getInstance() : false;
		}
	}
}
/**
 * Nav menu fallback function
 * @since 1.0.0
 */
if (is_user_logged_in()) {
	function highit_theme_fallback_menu()
	{
		get_template_part('template-parts/default', 'menu');
	}
}