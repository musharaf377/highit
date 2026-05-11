<?php

/**
 * Theme Shortcodes Generator
 * @package highit
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit(); //exit if access it directly
}

// Control core classes for avoid errors
if (class_exists('CSF')) {
	$prefix = 'highit';
	CSF::createShortcoder($prefix . '_shortcodes', array(
		'button_title'   => esc_html__('Add Shortcode', 'highit'),
		'select_title'   => esc_html__('Select a shortcode', 'highit'),
		'insert_title'   => esc_html__('Insert Shortcode', 'highit')
	));

	/*------------------------------------
		Social Icon Options
	-------------------------------------*/
	CSF::createSection($prefix . '_shortcodes', array(
		'title'     => esc_html__('Social Icons', 'highit'),
		'view'      => 'group',
		'shortcode' => 'highit_social_icon_wrap',
		'fields' => [
			array(
				'id'      => 'custom_class',
				'type'    => 'text',
				'title'   => esc_html__('Custom Class', 'highit'),
			)
		],
		'group_shortcode' => 'highit_social_icon',
		'group_fields'    => array(
			array(
				'id'    => 'social_icon',
				'type'  => 'icon',
				'title' => esc_html__('Icon', 'highit'),
			),
			array(
				'id'      => 'social_link',
				'type'    => 'text',
				'title'   => esc_html__('URL', 'highit'),
			)
		)
	));

	/*------------------------------------
		Top Menu Options
	-------------------------------------*/
	CSF::createSection($prefix . '_shortcodes', array(
		'title'     => esc_html__('Top Menu', 'highit'),
		'view'      => 'group',
		'shortcode' => 'highit_top_menu_wrap',
		'group_shortcode' => 'highit_top_menu',
		'group_fields'    => array(
			array(
				'id'    => 'top_menu_text',
				'type'  => 'text',
				'title' => esc_html__('Text', 'highit'),
			),
			array(
				'id'      => 'top_menu_link',
				'type'    => 'text',
				'title'   => esc_html__('URL', 'highit'),
			)
		)
	));

	/*------------------------------------
      Info Menu Options
    -------------------------------------*/
	CSF::createSection($prefix . '_shortcodes', array(
		'title'     => esc_html__('Info Menu', 'highit'),
		'view'      => 'group',
		'shortcode' => 'highit_top_menu_wrap_02',
		'group_shortcode' => 'highit_top_menu_02',
		'group_fields'    => array(
			array(
				'id'    => 'top_menu_title_text',
				'type'  => 'text',
				'title' => esc_html__('Text', 'highit'),
			),
			array(
				'id'    => 'top_menu_text',
				'type'  => 'text',
				'title' => esc_html__('Text', 'highit'),
			),
			array(
				'id'      => 'top_menu_link',
				'type'    => 'text',
				'title'   => esc_html__('URL', 'highit'),
			)
		)
	));

	/*------------------------------------
		Inline info link options
	-------------------------------------*/
	CSF::createSection($prefix . '_shortcodes', array(
		'title'     => esc_html__('Inline Info Link', 'highit'),
		'view'      => 'group',
		'shortcode' => 'highit_info_item_wrap',
		'group_shortcode' => 'highit_info_link',
		'group_fields'    => array(
			array(
				'id'    => 'icon',
				'type'  => 'icon',
				'title' => esc_html__('Icon', 'highit'),
			),
			array(
				'id'      => 'text',
				'type'    => 'text',
				'title'   => esc_html__('Text', 'highit'),
			),
			array(
				'id'      => 'url',
				'type'    => 'text',
				'title'   => esc_html__('URL', 'highit'),
			)
		)
	));
}
