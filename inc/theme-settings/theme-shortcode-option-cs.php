<?php

/**
 * Theme Shortcodes Generator
 * @package highlt
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit(); //exit if access it directly
}

// Control core classes for avoid errors
if (class_exists('CSF')) {
	$prefix = 'highlt';
	CSF::createShortcoder($prefix . '_shortcodes', array(
		'button_title'   => esc_html__('Add Shortcode', 'highlt'),
		'select_title'   => esc_html__('Select a shortcode', 'highlt'),
		'insert_title'   => esc_html__('Insert Shortcode', 'highlt')
	));

	/*------------------------------------
		Social Icon Options
	-------------------------------------*/
	CSF::createSection($prefix . '_shortcodes', array(
		'title'     => esc_html__('Social Icons', 'highlt'),
		'view'      => 'group',
		'shortcode' => 'highlt_social_icon_wrap',
		'fields' => [
			array(
				'id'      => 'custom_class',
				'type'    => 'text',
				'title'   => esc_html__('Custom Class', 'highlt'),
			)
		],
		'group_shortcode' => 'highlt_social_icon',
		'group_fields'    => array(
			array(
				'id'    => 'social_icon',
				'type'  => 'icon',
				'title' => esc_html__('Icon', 'highlt'),
			),
			array(
				'id'      => 'social_link',
				'type'    => 'text',
				'title'   => esc_html__('URL', 'highlt'),
			)
		)
	));

	/*------------------------------------
		Top Menu Options
	-------------------------------------*/
	CSF::createSection($prefix . '_shortcodes', array(
		'title'     => esc_html__('Top Menu', 'highlt'),
		'view'      => 'group',
		'shortcode' => 'highlt_top_menu_wrap',
		'group_shortcode' => 'highlt_top_menu',
		'group_fields'    => array(
			array(
				'id'    => 'top_menu_text',
				'type'  => 'text',
				'title' => esc_html__('Text', 'highlt'),
			),
			array(
				'id'      => 'top_menu_link',
				'type'    => 'text',
				'title'   => esc_html__('URL', 'highlt'),
			)
		)
	));

	/*------------------------------------
      Info Menu Options
    -------------------------------------*/
	CSF::createSection($prefix . '_shortcodes', array(
		'title'     => esc_html__('Info Menu', 'highlt'),
		'view'      => 'group',
		'shortcode' => 'highlt_top_menu_wrap_02',
		'group_shortcode' => 'highlt_top_menu_02',
		'group_fields'    => array(
			array(
				'id'    => 'top_menu_title_text',
				'type'  => 'text',
				'title' => esc_html__('Text', 'highlt'),
			),
			array(
				'id'    => 'top_menu_text',
				'type'  => 'text',
				'title' => esc_html__('Text', 'highlt'),
			),
			array(
				'id'      => 'top_menu_link',
				'type'    => 'text',
				'title'   => esc_html__('URL', 'highlt'),
			)
		)
	));

	/*------------------------------------
		Inline info link options
	-------------------------------------*/
	CSF::createSection($prefix . '_shortcodes', array(
		'title'     => esc_html__('Inline Info Link', 'highlt'),
		'view'      => 'group',
		'shortcode' => 'highlt_info_item_wrap',
		'group_shortcode' => 'highlt_info_link',
		'group_fields'    => array(
			array(
				'id'    => 'icon',
				'type'  => 'icon',
				'title' => esc_html__('Icon', 'highlt'),
			),
			array(
				'id'      => 'text',
				'type'    => 'text',
				'title'   => esc_html__('Text', 'highlt'),
			),
			array(
				'id'      => 'url',
				'type'    => 'text',
				'title'   => esc_html__('URL', 'highlt'),
			)
		)
	));
}
