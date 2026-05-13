<?php

/**
 * Theme Options
 * @package highit
 * @since 1.0.0
 */

if (! defined('ABSPATH')) {
	exit(); // exit if access directly
}
// Control core classes for avoid errors
if (class_exists('CSF')) {

	$allowed_html = highit()->kses_allowed_html(array('mark'));
	$prefix       = 'highit';
	// Create options
	CSF::createOptions($prefix . '_theme_options', array(
		'menu_title'         => esc_html__('Theme Options', 'highit'),
		'menu_slug'          => 'highit_theme_options',
		'menu_parent'        => 'highit_theme_options',
		'menu_type'          => 'submenu',
		'footer_credit'      => ' ',
		'menu_icon'          => 'fa fa-filter',
		'show_footer'        => false,
		'enqueue_webfont'    => false,
		'show_search'        => true,
		'show_reset_all'     => true,
		'show_reset_section' => true,
		'show_all_options'   => false,
		'theme'              => 'dark',
		'framework_title'    => highit()->get_theme_info('name')
	));

	/*-------------------------------------------------------
		** General  Options
	--------------------------------------------------------*/
	CSF::createSection($prefix . '_theme_options', array(
		'title' => esc_html__('General', 'highit'),
		'id'    => 'general_options',
		'icon'  => 'fas fa-cogs',
	));
	/* Preloader */
	CSF::createSection($prefix . '_theme_options', array(
		'title'  => esc_html__('Preloader & SVG Enable', 'highit'),
		'id'     => 'theme_general_preloader_options',
		'icon'   => 'fa fa-spinner',
		'parent' => 'general_options',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => esc_html__('Preloader ON / OFF', 'highit'),
			),
			array(
				'id'      => 'enable_preloader',
				'type'    => 'switcher',
				'title'   => esc_html__('Enable Preloader', 'highit'),
				'desc'    => esc_html__('If you want to enable or disable preloader you can set ( YES / NO )', 'highit'),
				'default' => true,
			),
			array(
				'id'         => 'enable_custom_preloader',
				'type'       => 'switcher',
				'title'      => esc_html__('Add Custom Preloader ?', 'highit'),
				'desc'       => esc_html__('If you want to add custom image for preloader you can set ( YES / NO )', 'highit'),
				'default'    => false,
				'dependency' => array('enable_preloader', '==', 'true'),
			),
			array(
				'id'         => 'add_preloader_image',
				'type'       => 'media',
				'title'      => esc_html__('Add Custom Image', 'highit'),
				'desc'       => esc_html__('Add the custom image for preloader.', 'highit'),
				'library'    => 'image',
				'dependency' => array('enable_preloader|enable_custom_preloader', '==|', 'true|true'),
			),
			array(
				'id'         => 'preloader_style',
				'type'       => 'image_select',
				'class'      => 'preloader_section',
				'title'      => esc_html__('Select Preloader Style', 'highit'),
				'desc'       => esc_html__('You can set specific preloader style in every page form here.', 'highit'),
				'options'    => array(
					'style_3'  => HIGHIT_THEME_SETTINGS_IMAGES . '/loader/loader_3.png',
					'style_4'  => HIGHIT_THEME_SETTINGS_IMAGES . '/loader/loader_horizontal.gif',
					'style_5'  => HIGHIT_THEME_SETTINGS_IMAGES . '/loader/loader_spinner.gif',
					'style_6'  => HIGHIT_THEME_SETTINGS_IMAGES . '/loader/loader_spinner.svg',
					'style_7'  => HIGHIT_THEME_SETTINGS_IMAGES . '/loader/loader_square_circle.gif',
					'style_8'  => HIGHIT_THEME_SETTINGS_IMAGES . '/loader/loader_wave.gif',
					'style_9'  => HIGHIT_THEME_SETTINGS_IMAGES . '/loader/loeader_square.gif',
					'style_10' => HIGHIT_THEME_SETTINGS_IMAGES . '/loader/wave_preloader.svg',
					'style_11' => HIGHIT_THEME_SETTINGS_IMAGES . '/loader/ajax_loader.svg',
					'style_12' => HIGHIT_THEME_SETTINGS_IMAGES . '/loader/audio.svg',
					'style_13' => HIGHIT_THEME_SETTINGS_IMAGES . '/loader/ball_triangle.svg',
					'style_14' => HIGHIT_THEME_SETTINGS_IMAGES . '/loader/bars.svg',
					'style_15' => HIGHIT_THEME_SETTINGS_IMAGES . '/loader/circle_pulse_rings.svg',
					'style_16' => HIGHIT_THEME_SETTINGS_IMAGES . '/loader/circle_tail_spin.svg',
					'style_17' => HIGHIT_THEME_SETTINGS_IMAGES . '/loader/circles.svg',
					'style_18' => HIGHIT_THEME_SETTINGS_IMAGES . '/loader/flip_circle.svg',
					'style_19' => HIGHIT_THEME_SETTINGS_IMAGES . '/loader/grid.svg',
					'style_20' => HIGHIT_THEME_SETTINGS_IMAGES . '/loader/heart.svg',
					'style_21' => HIGHIT_THEME_SETTINGS_IMAGES . '/loader/hearts_group.svg',
					'style_22' => HIGHIT_THEME_SETTINGS_IMAGES . '/loader/highit.svg',
					'style_23' => HIGHIT_THEME_SETTINGS_IMAGES . '/loader/road_cross.svg',
					'style_24' => HIGHIT_THEME_SETTINGS_IMAGES . '/loader/round_circle.svg',
					'style_25' => HIGHIT_THEME_SETTINGS_IMAGES . '/loader/round_pulse.svg',
					'style_26' => HIGHIT_THEME_SETTINGS_IMAGES . '/loader/simple_spainer.svg',
					'style_27' => HIGHIT_THEME_SETTINGS_IMAGES . '/loader/spinner.svg',
					'style_28' => HIGHIT_THEME_SETTINGS_IMAGES . '/loader/spinning_circles.svg',
					'style_29' => HIGHIT_THEME_SETTINGS_IMAGES . '/loader/three_dots.svg',
				),
				'default'    => 'style_22',
				'dependency' => array('enable_preloader|enable_custom_preloader', '==|==', 'true|false'),
			),
			array(
				'type'       => 'subheading',
				'content'    => esc_html__('Preloader Background & Color', 'highit'),
				'dependency' => array('enable_preloader', '==', 'true'),
			),
			array(
				'id'                    => 'preloader_bg',
				'type'                  => 'background',
				'title'                 => esc_html__('Preloader Background', 'highit'),
				'subtitle'              => esc_html__('Set the preloader background.', 'highit'),
				'desc'                  => esc_html__('Set the preloader background color, image, transparent image and gradient color. If you set only first color field it will be a simple solid color for background and if set 2nd color field too it will be set a gradient color and if you set a image it will be set a background image.', 'highit'),
				'background_image'      => true,
				'background_position'   => true,
				'background_repeat'     => true,
				'background_attachment' => true,
				'background_size'       => true,
				'background_gradient'   => true,
				'background_origin'     => true,
				'background_clip'       => true,
				'background_blend_mode' => true,
				'output'                => '.preloader',
				'default'               => array(
					'background-color'    => '#ffffff',
					'background-size'     => 'cover',
					'background-position' => 'center center',
					'background-repeat'   => 'repeat',
				),
				'dependency'            => array('enable_preloader', '==', 'true'),
			),
			array(
				'id'         => 'preloader_text_color',
				'type'       => 'color',
				'title'      => esc_html__('Preloader Text Color', 'highit'),
				'desc'       => esc_html__('Set the preloader text color', 'highit'),
				'default'    => '#438FF9',
				'output'     => array('.highit-preeloader', '.preloader-spinner'),
				'dependency' => array('enable_preloader', '==', 'true'),
			),
			array(
				'id'      => 'enable_svg_upload',
				'type'    => 'switcher',
				'title'   => esc_html__('Enable Svg Upload ?', 'highit'),
				'desc'    => esc_html__('If you want to enable or disable svg upload you can set ( YES / NO )', 'highit'),
				'default' => false,
			),
		)
	));

	/*-------------------------------------------------------
		   ** Typography  Options
	--------------------------------------------------------*/
	CSF::createSection($prefix . '_theme_options', array(
		'id'     => 'typography',
		'title'  => esc_html__('Typography', 'highit'),
		'icon'   => 'fas fa-text-height',
		'parent' => 'general_options',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Body Font Options', 'highit') . '</h3>',
			),
			array(
				'type'           => 'typography',
				'title'          => esc_html__('Typography', 'highit'),
				'id'             => '_body_font',
				'default'        => array(
					'font-family' => 'inter',
					'font-size'   => '16',
					'line-height' => '26',
					'unit'        => 'px',
					'type'        => 'google',
				),
				'color'          => false,
				'subset'         => false,
				'text_align'     => false,
				'text_transform' => false,
				'letter_spacing' => false,
				'line_height'    => false,
				'desc'           => wp_kses(__('you can set <mark>font</mark> for all html tags (if not use different heading font)', 'highit'), $allowed_html),
			),
			array(
				'id'       => 'body_font_variant',
				'type'     => 'select',
				'title'    => esc_html__('Load Font Variant', 'highit'),
				'multiple' => true,
				'chosen'   => true,
				'options'  => array(
					'300' => esc_html__('Light 300', 'highit'),
					'400' => esc_html__('Regular 400', 'highit'),
					'500' => esc_html__('Medium 500', 'highit'),
					'600' => esc_html__('Semi Bold 600', 'highit'),
					'700' => esc_html__('Bold 700', 'highit'),
					'800' => esc_html__('Extra Bold 800', 'highit'),
				),
				'default'  => array('400', '500', '700')
			),
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Heading Font Options', 'highit') . '</h3>',
			),
			array(
				'type'    => 'switcher',
				'id'      => 'heading_font_enable',
				'title'   => esc_html__('Heading Font', 'highit'),
				'desc'    => wp_kses(__('you can set <mark>yes</mark> to select different heading font', 'highit'), $allowed_html),
				'default' => true
			),
			array(
				'type'           => 'typography',
				'title'          => esc_html__('Typography', 'highit'),
				'id'             => 'heading_font',
				'default'        => array(
					'font-family' => 'inter',
					'type'        => 'google',
				),
				'color'          => false,
				'subset'         => false,
				'text_align'     => false,
				'text_transform' => false,
				'letter_spacing' => false,
				'font_size'      => false,
				'line_height'    => false,
				'desc'           => wp_kses(__('you can set <mark>font</mark> for  for heading tag .eg: h1,h2mh3,h4,h5,h6', 'highit'), $allowed_html),
				'dependency'     => array('heading_font_enable', '==', 'true')
			),
			array(
				'id'         => 'heading_font_variant',
				'type'       => 'select',
				'title'      => esc_html__('Load Font Variant', 'highit'),
				'multiple'   => true,
				'chosen'     => true,
				'options'    => array(
					'300' => esc_html__('Light 300', 'highit'),
					'400' => esc_html__('Regular 400', 'highit'),
					'500' => esc_html__('Medium 500', 'highit'),
					'600' => esc_html__('Semi Bold 600', 'highit'),
					'700' => esc_html__('Bold 700', 'highit'),
					'800' => esc_html__('Extra Bold 800', 'highit'),
				),
				'default'    => array('400', '500', '600', '700', '800'),
				'dependency' => array('heading_font_enable', '==', 'true')
			),
		)
	));

	/* Preloader */
	CSF::createSection($prefix . '_theme_options', array(
		'title'  => esc_html__('Back To Top', 'highit'),
		'id'     => 'theme_general_back_top_options',
		'icon'   => 'fa fa-arrow-up',
		'parent' => 'general_options',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Back Top Options', 'highit') . '</h3>'
			),
			array(
				'id'      => 'back_top_enable',
				'title'   => esc_html__('Back Top', 'highit'),
				'type'    => 'switcher',
				'desc'    => wp_kses(__('you can set <mark>Yes / No</mark> to show/hide back to top', 'highit'), $allowed_html),
				'default' => true,
			),
			array(
				'id'         => 'back_top_icon',
				'title'      => esc_html__('Back Top Icon', 'highit'),
				'type'       => 'icon',
				'default'    => 'fa fa-angle-up',
				'desc'       => wp_kses(__('you can set <mark>icon</mark> for back to top.', 'highit'), $allowed_html),
				'dependency' => array('back_top_enable', '==', 'true')
			),
		)
	));

	/*----------------------------------
		Header & Footer Style
	-----------------------------------*/
	CSF::createSection($prefix . '_theme_options', array(
		'title'  => esc_html__('Set Header & Footer Type', 'highit'),
		'id'     => 'header_footer_style_options',
		'icon'   => 'eicon-banner',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => esc_html__('Global Header Style', 'highit'),
			),
			array(
				'id'      => 'navbar_type',
				'title'   => esc_html__('Navbar Type', 'highit'),
				'type'    => 'image_select',
				'options' => array(
					'' => HIGHIT_THEME_SETTINGS_IMAGES . '/header/01.png'
				),
				'default' => '',
				'desc'    => wp_kses(__('you can set <mark>navbar type</mark> it will show in every page except you select specific navbar type form page settings.', 'highit'), $allowed_html),
			),
			array(
				'type'    => 'subheading',
				'content' => esc_html__('Global Footer Style', 'highit'),
			),
			array(
				'id'      => 'footer_type',
				'title'   => esc_html__('Footer Type', 'highit'),
				'type'    => 'image_select',
				'options' => array(
					'' => HIGHIT_THEME_SETTINGS_IMAGES . '/footer/01.png'
				),
				'default' => '',
				'desc'    => wp_kses(__('you can set <mark>footer type</mark> it will show in every page except you select specific navbar type form page settings.', 'highit'), $allowed_html),
			),
		)
	));

	/*-------------------------------------------------------
	   ** Entire Site Header  Options
   --------------------------------------------------------*/
	CSF::createSection($prefix . '_theme_options', array(
		'id'    => 'headers_settings',
		'title' => esc_html__('Headers', 'highit'),
		'icon'  => 'fa fa-home'
	));
	/* Header Style 01 */
	CSF::createSection($prefix . '_theme_options', array(
		'title'  => esc_html__('Header One', 'highit'),
		'id'     => 'theme_header_one_options',
		'icon'   => 'fa fa-image',
		'parent' => 'headers_settings',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Logo Options', 'highit') . '</h3>'
			),
			array(
				'id'      => 'header_one_logo',
				'type'    => 'media',
				'title'   => esc_html__('Logo', 'highit'),
				'library' => 'image',
				'desc'    => wp_kses(__('you can upload <mark> logo</mark> here it will overwrite customizer uploaded logo', 'highit'), $allowed_html),
			)
		)
	));

	/* Breadcrumb */
	CSF::createSection($prefix . '_theme_options', array(
		'title'  => esc_html__('Breadcrumb', 'highit'),
		'id'     => 'breadcrumb_options',
		'icon'   => ' eicon-product-breadcrumbs',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Breadcrumb Stock Title Options', 'highit') . '</h3>'
			),
			array(
				'id'      => 'breadcrumb_stock_title',
				'type'    => 'text',
				'title'   => esc_html__('Chang Breadcrumb Stock Title', 'highit'),
				'default' => esc_html__('HIGHIT', 'highit'),
			),
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Breadcrumb Options', 'highit') . '</h3>'
			),
			array(
				'id'      => 'breadcrumb_enable',
				'title'   => esc_html__('Breadcrumb', 'highit'),
				'type'    => 'switcher',
				'desc'    => wp_kses(__('you can set <mark>Yes / No</mark> to show/hide breadcrumb', 'highit'), $allowed_html),
				'default' => true,
			),
			array(
				'id'               => 'breadcrumb_bg',
				'title'            => esc_html__('Background Image', 'highit'),
				'type'             => 'background',
				'desc'             => wp_kses(__('you can set <mark>background</mark> for breadcrumb', 'highit'), $allowed_html),
				'default'          => array(
					'background-size'     => 'cover',
					'background-position' => 'center bottom',
					'background-repeat'   => 'no-repeat',
				),
				'background_color' => false,
				'dependency'       => array('breadcrumb_enable', '==', 'true')
			),
			array(
				'id'         => 'breadcrumb_bg_color',
				'title'      => esc_html__('Breadcrumb Background Color', 'highit'),
				'type'       => 'color',
				'default'    => 'rgba(232,0,0, 0.6);',
				'desc'       => wp_kses(__('you can set <mark>overlay color</mark> for Breadcrumb background image', 'highit'), $allowed_html),
				'dependency' => array('breadcrumb_enable', '==', 'true')
			),
		)
	));


	/*-------------------------------------------------------
		   ** Footer  Options
	--------------------------------------------------------*/
	CSF::createSection($prefix . '_theme_options', array(
		'title' => esc_html__('Footer', 'highit'),
		'id'    => 'footer_options',
		'icon'  => ' eicon-footer',

	));

	CSF::createSection($prefix . '_theme_options', array(
		'parent' => 'footer_options',
		'id'     => 'footer_one_options',
		'title'  => esc_html__('Footer One', 'highit'),
		'icon'   => 'fa fa-list-ul',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Footer Settings', 'highit') . '</h3>'
			),
			array(
				'id'      => 'footer_one_logo',
				'type'    => 'media',
				'title'   => esc_html__('Logo', 'highit'),
				'library' => 'image',
				'desc'    => wp_kses(__('you can upload <mark> logo</mark> here it will overwrite customizer uploaded logo', 'highit'), $allowed_html),
			),
			array(
				'id'      => 'footer_short_description',
				'type'    => 'textarea',
				'title'   => esc_html__('Short Description', 'highit'),
				'desc'    => wp_kses(__('you can add <mark> short description</mark> here', 'highit'), $allowed_html),
			),

			// menu repeater
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Footer Menu', 'highit') . '</h3>'
			),
			array(
				'id'      => 'footer_menu_column_title',
				'type'    => 'text',
				'title'   => esc_html__('Menu Column Title', 'highit'),
				'default' => esc_html__('Menu Title', 'highit'),
				'desc'    => wp_kses(__('you can set <mark> title</mark> for menu column', 'highit'), $allowed_html),
			),
			array(
				'id'     => 'footer_menu',
				'type'   => 'repeater',
				'title'  => esc_html__('Footer Menu Repeater', 'highit'),
				'fields' => array(
					array(
						'id'      => 'footer_menu_item_title',
						'type'    => 'text',
						'title'   => esc_html__('Footer Menu Title', 'highit'),
						'default' => esc_html__('Home', 'highit'),
					),
					array(
						'id'      => 'footer_menu_item_url',
						'type'    => 'text',
						'title'   => esc_html__('Menu URL', 'highit'),
						'default' => '#'
					),
				)
			),

			// footer contact information
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Footer Contact Info', 'highit') . '</h3>'
			),
			array(
				'id'      => 'footer_contact_column_title',
				'type'    => 'text',
				'title'   => esc_html__('Contact Column Title', 'highit'),
				'default' => esc_html__('Contact Us', 'highit'),
				'desc'    => wp_kses(__('you can set <mark> title</mark> for contact column', 'highit'), $allowed_html),
			),
			array(
				'id'      => 'footer_contact_phone_number',
				'type'    => 'text',
				'title'   => esc_html__('Contact Phone Number', 'highit'),
				'default' => esc_html__('(347) 268-4178', 'highit'),
				'desc'    => wp_kses(__('you can set <mark> phone number</mark> for contact column', 'highit'), $allowed_html),
			),
			array(
				'id'      => 'footer_contact_email',
				'type'    => 'text',
				'title'   => esc_html__('Contact Email', 'highit'),
				'default' => esc_html__('info@yourdomain.com', 'highit'),
				'desc'    => wp_kses(__('you can set <mark> email</mark> for contact column', 'highit'), $allowed_html),
			),
			array(
				'id'      => 'footer_contact_location',
				'type'    => 'text',
				'title'   => esc_html__('Contact Location', 'highit'),
				'default' => esc_html__('123 Main Street, City, State 12345', 'highit'),
				'desc'    => wp_kses(__('you can set <mark> location</mark> for contact column', 'highit'), $allowed_html),
			),

			// Download Resume

			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Footer Download Resume', 'highit') . '</h3>'
			),
			array(
				'id'      => 'footer_download_resume_enable',
				'type'    => 'text',
				'title'   => esc_html__('Download Resume Text', 'highit'),
				'desc'    => wp_kses(__('you can set <mark> download resume text</mark> for contact column', 'highit'), $allowed_html),
				'default' => esc_html__('Download Resume', 'highit'),
			),
			array(
				'id'      => 'footer_download_resume_link',
				'type'    => 'text',
				'title'   => esc_html__('Download Resume Link', 'highit'),
				'desc'    => wp_kses(__('you can set <mark> download resume link</mark> for contact column', 'highit'), $allowed_html),
				'default' => '#',
			),

			// Footer Social Icon
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Footer Social Item Settings', 'highit') . '</h3>'
			),
	
			array(
				'id'         => 'footer_social_repeater',
				'type'       => 'repeater',
				'title'      => esc_html__('Social Item Repeater', 'highit'),
				'fields'     => array(
					array(
						'id'      => 'footer_social_icon_item_icon',
						'type'    => 'media',
						'title'   => esc_html__('Logo', 'highit'),
						'library' => 'image',
						'desc'    => wp_kses(__('you can upload <mark> logo</mark> here it will overwrite customizer uploaded logo', 'highit'), $allowed_html),
					),
					array(
						'id'      => 'footer_social_icon_item_url',
						'type'    => 'text',
						'title'   => esc_html__('Social URL', 'highit'),
						'default' => '#'
					),
				)
			),
			
			// Footer Copyright Area
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Footer Copyright Area', 'highit') . '</h3>'
			),

			array(
				'id'    => 'copyright_text',
				'title' => esc_html__('Copyright Area Text', 'highit'),
				'type'  => 'textarea',
				'desc'  => wp_kses(__('use  <mark>{copy}</mark> for copyright symbol, use <mark>{year}</mark> for current year, ', 'highit'), $allowed_html)
			),


			// Footer Copyright Area
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Footer Bottom Menu', 'highit') . '</h3>'
			),
			array(
				'id'     => 'footer_bottom_menu',
				'type'   => 'repeater',
				'title'  => esc_html__('Footer Bottom Menu', 'highit'),
				'fields' => array(
					array(
						'id'      => 'footer_bottom_menu_item_title',
						'type'    => 'text',
						'title'   => esc_html__('Footer Bottom Menu Title', 'highit'),
						'default' => esc_html__('Home', 'highit'),
					),
					array(
						'id'      => 'footer_bottom_menu_item_url',
						'type'    => 'text',
						'title'   => esc_html__('Menu URL', 'highit'),
						'default' => '#'
					),
				)
			),
			
		)
	));


	/*-------------------------------------------------------
		  ** Blog  Options
	--------------------------------------------------------*/
	CSF::createSection($prefix . '_theme_options', array(
		'id'    => 'blog_settings',
		'title' => esc_html__('Blog Settings', 'highit'),
		'icon'  => 'fa fa-book'
	));
	CSF::createSection($prefix . '_theme_options', array(
		'parent' => 'blog_settings',
		'id'     => 'blog_post_options',
		'title'  => esc_html__('Blog Post', 'highit'),
		'icon'   => 'fa fa-list-ul',
		'fields' => Highit_Group_Fields::post_meta('blog_post', esc_html__('Blog Page', 'highit'))
	));
	CSF::createSection($prefix . '_theme_options', array(
		'parent' => 'blog_settings',
		'id'     => 'blog_single_post_options',
		'title'  => esc_html__('Single Post', 'highit'),
		'icon'   => 'fa fa-list-alt',
		'fields' => Highit_Group_Fields::post_meta('blog_single_post', esc_html__('Blog Single Page', 'highit'))
	));


	/*-------------------------------------------------------
		  ** Pages & templates Options
   --------------------------------------------------------*/
	CSF::createSection($prefix . '_theme_options', array(
		'id'    => 'pages_and_template',
		'title' => esc_html__('Pages Settings', 'highit'),
		'icon'  => 'fa fa-files-o'
	));
	/*  404 page options */
	CSF::createSection($prefix . '_theme_options', array(
		'id'     => '404_page',
		'title'  => esc_html__('404 Page', 'highit'),
		'parent' => 'pages_and_template',
		'icon'   => 'fa fa-exclamation-triangle',
		'fields' => array(
			array(
				'id'      => 'error_bg_switch',
				'title'   => esc_html__('404 Image Enable', 'highit'),
				'type'    => 'switcher',
				'desc'    => wp_kses(__('you can set <mark>Yes / No</mark> to show/hide breadcrumb', 'highit'), $allowed_html),
				'default' => true,
			),
			array(
				'id'         => 'error_bg',
				'title'      => esc_html__('404 Image', 'highit'),
				'type'       => 'media',
				'desc'       => wp_kses(__('you can set <mark>background</mark> for breadcrumb', 'highit'), $allowed_html),
				'dependency' => array('error_bg_switch', '==', 'true')
			),
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('404 Page Options', 'highit') . '</h3>',
			),
			array(
				'id'      => '404_bg_color',
				'type'    => 'color',
				'title'   => esc_html__('Page Background Color', 'highit'),
				'default' => '#ffffff'
			),
			array(
				'id'         => '404_title',
				'title'      => esc_html__('Title', 'highit'),
				'type'       => 'text',
				'info'       => wp_kses(__('you can change <mark>title</mark> of 404 page', 'highit'), $allowed_html),
				'attributes' => array('placeholder' => esc_html__('Sorry! The Page Not Found', 'highit'))
			),
			array(
				'id'         => '404_paragraph',
				'title'      => esc_html__('Paragraph', 'highit'),
				'type'       => 'textarea',
				'info'       => wp_kses(__('you can change <mark>paragraph</mark> of 404 page', 'highit'), $allowed_html),
				'attributes' => array('placeholder' => esc_html__('Oops! The page you are looking for does not exit. it might been moved or deleted.', 'highit'))
			),
			array(
				'id'         => '404_button_text',
				'title'      => esc_html__('Button Text', 'highit'),
				'type'       => 'text',
				'info'       => wp_kses(__('you can change <mark>button text</mark> of 404 page', 'highit'), $allowed_html),
				'attributes' => array('placeholder' => esc_html__('back to home', 'highit'))
			),
			array(
				'id'      => '404_spacing_top',
				'title'   => esc_html__('Page Spacing Top', 'highit'),
				'type'    => 'slider',
				'desc'    => wp_kses(__('you can set <mark>Padding Top</mark> for page content area.', 'highit'), $allowed_html),
				'min'     => 0,
				'max'     => 500,
				'step'    => 1,
				'unit'    => 'px',
				'default' => 120,
			),
			array(
				'id'      => '404_spacing_bottom',
				'title'   => esc_html__('Page Spacing Bottom', 'highit'),
				'type'    => 'slider',
				'desc'    => wp_kses(__('you can set <mark>Padding Bottom</mark> for page content area.', 'highit'), $allowed_html),
				'min'     => 0,
				'max'     => 500,
				'step'    => 1,
				'unit'    => 'px',
				'default' => 120,
			),
		)
	));

	/*  blog page options */
	CSF::createSection($prefix . '_theme_options', array(
		'id'     => 'blog_page',
		'title'  => esc_html__('Blog Page', 'highit'),
		'parent' => 'pages_and_template',
		'icon'   => 'fa fa-indent',
		'fields' => Highit_Group_Fields::page_layout_options(esc_html__('Blog', 'highit'), 'blog')
	));
	/*  blog single page options */
	CSF::createSection($prefix . '_theme_options', array(
		'id'     => 'blog_single_page',
		'title'  => esc_html__('Blog Single Page', 'highit'),
		'parent' => 'pages_and_template',
		'icon'   => 'fa fa-indent',
		'fields' => Highit_Group_Fields::page_layout_options(esc_html__('Blog Single', 'highit'), 'blog_single')
	));
	/*  archive page options */
	CSF::createSection($prefix . '_theme_options', array(
		'id'     => 'archive_page',
		'title'  => esc_html__('Archive Page', 'highit'),
		'parent' => 'pages_and_template',
		'icon'   => 'fa fa-archive',
		'fields' => Highit_Group_Fields::page_layout_options(esc_html__('Archive', 'highit'), 'archive')
	));
	/*  search page options */
	CSF::createSection($prefix . '_theme_options', array(
		'id'     => 'search_page',
		'title'  => esc_html__('Search Page', 'highit'),
		'parent' => 'pages_and_template',
		'icon'   => 'fa fa-search',
		'fields' => Highit_Group_Fields::page_layout_options(esc_html__('Search', 'highit'), 'search')
	));

	/*-------------------------------------------------------
		   ** Backup  Options
	--------------------------------------------------------*/
	CSF::createSection($prefix . '_theme_options', array(
		'id'     => 'backup',
		'title'  => esc_html__('Import / Export', 'highit'),
		'icon'   => 'eicon-export-kit',
		'fields' => array(
			array(
				'type'    => 'notice',
				'style'   => 'warning',
				'content' => esc_html__('You can save your current options. Download a Backup and Import.', 'highit'),
			),
			array(
				'type'  => 'backup',
				'title' => esc_html__('Backup & Import', 'highit')
			)
		)
	));
}
