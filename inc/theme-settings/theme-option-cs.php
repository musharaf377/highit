<?php

/**
 * Theme Options
 * @package highlt
 * @since 1.0.0
 */

if (! defined('ABSPATH')) {
	exit(); // exit if access directly
}
// Control core classes for avoid errors
if (class_exists('CSF')) {

	$allowed_html = highlt()->kses_allowed_html(array('mark'));
	$prefix       = 'highlt';
	// Create options
	CSF::createOptions($prefix . '_theme_options', array(
		'menu_title'         => esc_html__('Theme Options', 'highlt'),
		'menu_slug'          => 'highlt_theme_options',
		'menu_parent'        => 'highlt_theme_options',
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
		'framework_title'    => highlt()->get_theme_info('name')
	));

	/*-------------------------------------------------------
		** General  Options
	--------------------------------------------------------*/
	CSF::createSection($prefix . '_theme_options', array(
		'title' => esc_html__('General', 'highlt'),
		'id'    => 'general_options',
		'icon'  => 'fas fa-cogs',
	));
	/* Preloader */
	CSF::createSection($prefix . '_theme_options', array(
		'title'  => esc_html__('Preloader & SVG Enable', 'highlt'),
		'id'     => 'theme_general_preloader_options',
		'icon'   => 'fa fa-spinner',
		'parent' => 'general_options',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => esc_html__('Preloader ON / OFF', 'highlt'),
			),
			array(
				'id'      => 'enable_preloader',
				'type'    => 'switcher',
				'title'   => esc_html__('Enable Preloader', 'highlt'),
				'desc'    => esc_html__('If you want to enable or disable preloader you can set ( YES / NO )', 'highlt'),
				'default' => true,
			),
			array(
				'id'         => 'enable_custom_preloader',
				'type'       => 'switcher',
				'title'      => esc_html__('Add Custom Preloader ?', 'highlt'),
				'desc'       => esc_html__('If you want to add custom image for preloader you can set ( YES / NO )', 'highlt'),
				'default'    => false,
				'dependency' => array('enable_preloader', '==', 'true'),
			),
			array(
				'id'         => 'add_preloader_image',
				'type'       => 'media',
				'title'      => esc_html__('Add Custom Image', 'highlt'),
				'desc'       => esc_html__('Add the custom image for preloader.', 'highlt'),
				'library'    => 'image',
				'dependency' => array('enable_preloader|enable_custom_preloader', '==|', 'true|true'),
			),
			array(
				'id'         => 'preloader_style',
				'type'       => 'image_select',
				'class'      => 'preloader_section',
				'title'      => esc_html__('Select Preloader Style', 'highlt'),
				'desc'       => esc_html__('You can set specific preloader style in every page form here.', 'highlt'),
				'options'    => array(
					'style_3'  => HIGHLT_THEME_SETTINGS_IMAGES . '/loader/loader_3.png',
					'style_4'  => HIGHLT_THEME_SETTINGS_IMAGES . '/loader/loader_horizontal.gif',
					'style_5'  => HIGHLT_THEME_SETTINGS_IMAGES . '/loader/loader_spinner.gif',
					'style_6'  => HIGHLT_THEME_SETTINGS_IMAGES . '/loader/loader_spinner.svg',
					'style_7'  => HIGHLT_THEME_SETTINGS_IMAGES . '/loader/loader_square_circle.gif',
					'style_8'  => HIGHLT_THEME_SETTINGS_IMAGES . '/loader/loader_wave.gif',
					'style_9'  => HIGHLT_THEME_SETTINGS_IMAGES . '/loader/loeader_square.gif',
					'style_10' => HIGHLT_THEME_SETTINGS_IMAGES . '/loader/wave_preloader.svg',
					'style_11' => HIGHLT_THEME_SETTINGS_IMAGES . '/loader/ajax_loader.svg',
					'style_12' => HIGHLT_THEME_SETTINGS_IMAGES . '/loader/audio.svg',
					'style_13' => HIGHLT_THEME_SETTINGS_IMAGES . '/loader/ball_triangle.svg',
					'style_14' => HIGHLT_THEME_SETTINGS_IMAGES . '/loader/bars.svg',
					'style_15' => HIGHLT_THEME_SETTINGS_IMAGES . '/loader/circle_pulse_rings.svg',
					'style_16' => HIGHLT_THEME_SETTINGS_IMAGES . '/loader/circle_tail_spin.svg',
					'style_17' => HIGHLT_THEME_SETTINGS_IMAGES . '/loader/circles.svg',
					'style_18' => HIGHLT_THEME_SETTINGS_IMAGES . '/loader/flip_circle.svg',
					'style_19' => HIGHLT_THEME_SETTINGS_IMAGES . '/loader/grid.svg',
					'style_20' => HIGHLT_THEME_SETTINGS_IMAGES . '/loader/heart.svg',
					'style_21' => HIGHLT_THEME_SETTINGS_IMAGES . '/loader/hearts_group.svg',
					'style_22' => HIGHLT_THEME_SETTINGS_IMAGES . '/loader/highlt.svg',
					'style_23' => HIGHLT_THEME_SETTINGS_IMAGES . '/loader/road_cross.svg',
					'style_24' => HIGHLT_THEME_SETTINGS_IMAGES . '/loader/round_circle.svg',
					'style_25' => HIGHLT_THEME_SETTINGS_IMAGES . '/loader/round_pulse.svg',
					'style_26' => HIGHLT_THEME_SETTINGS_IMAGES . '/loader/simple_spainer.svg',
					'style_27' => HIGHLT_THEME_SETTINGS_IMAGES . '/loader/spinner.svg',
					'style_28' => HIGHLT_THEME_SETTINGS_IMAGES . '/loader/spinning_circles.svg',
					'style_29' => HIGHLT_THEME_SETTINGS_IMAGES . '/loader/three_dots.svg',
				),
				'default'    => 'style_22',
				'dependency' => array('enable_preloader|enable_custom_preloader', '==|==', 'true|false'),
			),
			array(
				'type'       => 'subheading',
				'content'    => esc_html__('Preloader Background & Color', 'highlt'),
				'dependency' => array('enable_preloader', '==', 'true'),
			),
			array(
				'id'                    => 'preloader_bg',
				'type'                  => 'background',
				'title'                 => esc_html__('Preloader Background', 'highlt'),
				'subtitle'              => esc_html__('Set the preloader background.', 'highlt'),
				'desc'                  => esc_html__('Set the preloader background color, image, transparent image and gradient color. If you set only first color field it will be a simple solid color for background and if set 2nd color field too it will be set a gradient color and if you set a image it will be set a background image.', 'highlt'),
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
				'title'      => esc_html__('Preloader Text Color', 'highlt'),
				'desc'       => esc_html__('Set the preloader text color', 'highlt'),
				'default'    => '#438FF9',
				'output'     => array('.highlt-preeloader', '.preloader-spinner'),
				'dependency' => array('enable_preloader', '==', 'true'),
			),
			array(
				'id'      => 'enable_svg_upload',
				'type'    => 'switcher',
				'title'   => esc_html__('Enable Svg Upload ?', 'highlt'),
				'desc'    => esc_html__('If you want to enable or disable svg upload you can set ( YES / NO )', 'highlt'),
				'default' => false,
			),
		)
	));

	/*-------------------------------------------------------
		   ** Typography  Options
	--------------------------------------------------------*/
	CSF::createSection($prefix . '_theme_options', array(
		'id'     => 'typography',
		'title'  => esc_html__('Typography', 'highlt'),
		'icon'   => 'fas fa-text-height',
		'parent' => 'general_options',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Body Font Options', 'highlt') . '</h3>',
			),
			array(
				'type'           => 'typography',
				'title'          => esc_html__('Typography', 'highlt'),
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
				'desc'           => wp_kses(__('you can set <mark>font</mark> for all html tags (if not use different heading font)', 'highlt'), $allowed_html),
			),
			array(
				'id'       => 'body_font_variant',
				'type'     => 'select',
				'title'    => esc_html__('Load Font Variant', 'highlt'),
				'multiple' => true,
				'chosen'   => true,
				'options'  => array(
					'300' => esc_html__('Light 300', 'highlt'),
					'400' => esc_html__('Regular 400', 'highlt'),
					'500' => esc_html__('Medium 500', 'highlt'),
					'600' => esc_html__('Semi Bold 600', 'highlt'),
					'700' => esc_html__('Bold 700', 'highlt'),
					'800' => esc_html__('Extra Bold 800', 'highlt'),
				),
				'default'  => array('400', '500', '700')
			),
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Heading Font Options', 'highlt') . '</h3>',
			),
			array(
				'type'    => 'switcher',
				'id'      => 'heading_font_enable',
				'title'   => esc_html__('Heading Font', 'highlt'),
				'desc'    => wp_kses(__('you can set <mark>yes</mark> to select different heading font', 'highlt'), $allowed_html),
				'default' => true
			),
			array(
				'type'           => 'typography',
				'title'          => esc_html__('Typography', 'highlt'),
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
				'desc'           => wp_kses(__('you can set <mark>font</mark> for  for heading tag .eg: h1,h2mh3,h4,h5,h6', 'highlt'), $allowed_html),
				'dependency'     => array('heading_font_enable', '==', 'true')
			),
			array(
				'id'         => 'heading_font_variant',
				'type'       => 'select',
				'title'      => esc_html__('Load Font Variant', 'highlt'),
				'multiple'   => true,
				'chosen'     => true,
				'options'    => array(
					'300' => esc_html__('Light 300', 'highlt'),
					'400' => esc_html__('Regular 400', 'highlt'),
					'500' => esc_html__('Medium 500', 'highlt'),
					'600' => esc_html__('Semi Bold 600', 'highlt'),
					'700' => esc_html__('Bold 700', 'highlt'),
					'800' => esc_html__('Extra Bold 800', 'highlt'),
				),
				'default'    => array('400', '500', '600', '700', '800'),
				'dependency' => array('heading_font_enable', '==', 'true')
			),
		)
	));

	/* Preloader */
	CSF::createSection($prefix . '_theme_options', array(
		'title'  => esc_html__('Back To Top', 'highlt'),
		'id'     => 'theme_general_back_top_options',
		'icon'   => 'fa fa-arrow-up',
		'parent' => 'general_options',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Back Top Options', 'highlt') . '</h3>'
			),
			array(
				'id'      => 'back_top_enable',
				'title'   => esc_html__('Back Top', 'highlt'),
				'type'    => 'switcher',
				'desc'    => wp_kses(__('you can set <mark>Yes / No</mark> to show/hide back to top', 'highlt'), $allowed_html),
				'default' => true,
			),
			array(
				'id'         => 'back_top_icon',
				'title'      => esc_html__('Back Top Icon', 'highlt'),
				'type'       => 'icon',
				'default'    => 'fa fa-angle-up',
				'desc'       => wp_kses(__('you can set <mark>icon</mark> for back to top.', 'highlt'), $allowed_html),
				'dependency' => array('back_top_enable', '==', 'true')
			),
		)
	));

	/*----------------------------------
		Header & Footer Style
	-----------------------------------*/
	CSF::createSection($prefix . '_theme_options', array(
		'title'  => esc_html__('Set Header & Footer Type', 'highlt'),
		'id'     => 'header_footer_style_options',
		'icon'   => 'eicon-banner',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => esc_html__('Global Header Style', 'highlt'),
			),
			array(
				'id'      => 'navbar_type',
				'title'   => esc_html__('Navbar Type', 'highlt'),
				'type'    => 'image_select',
				'options' => array(
					'' => HIGHLT_THEME_SETTINGS_IMAGES . '/header/01.png'
				),
				'default' => '',
				'desc'    => wp_kses(__('you can set <mark>navbar type</mark> it will show in every page except you select specific navbar type form page settings.', 'highlt'), $allowed_html),
			),
			array(
				'type'    => 'subheading',
				'content' => esc_html__('Global Footer Style', 'highlt'),
			),
			array(
				'id'      => 'footer_type',
				'title'   => esc_html__('Footer Type', 'highlt'),
				'type'    => 'image_select',
				'options' => array(
					'' => HIGHLT_THEME_SETTINGS_IMAGES . '/footer/01.png'
				),
				'default' => '',
				'desc'    => wp_kses(__('you can set <mark>footer type</mark> it will show in every page except you select specific navbar type form page settings.', 'highlt'), $allowed_html),
			),
		)
	));

	/*-------------------------------------------------------
	   ** Entire Site Header  Options
   --------------------------------------------------------*/
	CSF::createSection($prefix . '_theme_options', array(
		'id'    => 'headers_settings',
		'title' => esc_html__('Headers', 'highlt'),
		'icon'  => 'fa fa-home'
	));
	/* Header Style 01 */
	CSF::createSection($prefix . '_theme_options', array(
		'title'  => esc_html__('Header One', 'highlt'),
		'id'     => 'theme_header_one_options',
		'icon'   => 'fa fa-image',
		'parent' => 'headers_settings',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Logo Options', 'highlt') . '</h3>'
			),
			array(
				'id'      => 'header_one_logo',
				'type'    => 'media',
				'title'   => esc_html__('Logo', 'highlt'),
				'library' => 'image',
				'desc'    => wp_kses(__('you can upload <mark> logo</mark> here it will overwrite customizer uploaded logo', 'highlt'), $allowed_html),
			)
		)
	));

	/* Breadcrumb */
	CSF::createSection($prefix . '_theme_options', array(
		'title'  => esc_html__('Breadcrumb', 'highlt'),
		'id'     => 'breadcrumb_options',
		'icon'   => ' eicon-product-breadcrumbs',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Breadcrumb Stock Title Options', 'highlt') . '</h3>'
			),
			array(
				'id'      => 'breadcrumb_stock_title',
				'type'    => 'text',
				'title'   => esc_html__('Chang Breadcrumb Stock Title', 'highlt'),
				'default' => esc_html__('HIGHLT', 'highlt'),
			),
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Breadcrumb Options', 'highlt') . '</h3>'
			),
			array(
				'id'      => 'breadcrumb_enable',
				'title'   => esc_html__('Breadcrumb', 'highlt'),
				'type'    => 'switcher',
				'desc'    => wp_kses(__('you can set <mark>Yes / No</mark> to show/hide breadcrumb', 'highlt'), $allowed_html),
				'default' => true,
			),
			array(
				'id'               => 'breadcrumb_bg',
				'title'            => esc_html__('Background Image', 'highlt'),
				'type'             => 'background',
				'desc'             => wp_kses(__('you can set <mark>background</mark> for breadcrumb', 'highlt'), $allowed_html),
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
				'title'      => esc_html__('Breadcrumb Background Color', 'highlt'),
				'type'       => 'color',
				'default'    => 'rgba(232,0,0, 0.6);',
				'desc'       => wp_kses(__('you can set <mark>overlay color</mark> for Breadcrumb background image', 'highlt'), $allowed_html),
				'dependency' => array('breadcrumb_enable', '==', 'true')
			),
		)
	));


	/*-------------------------------------------------------
		   ** Footer  Options
	--------------------------------------------------------*/
	CSF::createSection($prefix . '_theme_options', array(
		'title' => esc_html__('Footer', 'highlt'),
		'id'    => 'footer_options',
		'icon'  => ' eicon-footer',

	));

	CSF::createSection($prefix . '_theme_options', array(
		'parent' => 'footer_options',
		'id'     => 'footer_one_options',
		'title'  => esc_html__('Footer One', 'highlt'),
		'icon'   => 'fa fa-list-ul',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Footer Settings', 'highlt') . '</h3>'
			),
			array(
				'id'      => 'footer_one_logo',
				'type'    => 'media',
				'title'   => esc_html__('Logo', 'highlt'),
				'library' => 'image',
				'desc'    => wp_kses(__('you can upload <mark> logo</mark> here it will overwrite customizer uploaded logo', 'highlt'), $allowed_html),
			),
			array(
				'id'      => 'footer_short_description',
				'type'    => 'textarea',
				'title'   => esc_html__('Short Description', 'highlt'),
				'desc'    => wp_kses(__('you can add <mark> short description</mark> here', 'highlt'), $allowed_html),
			),

			// menu repeater
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Footer Menu', 'highlt') . '</h3>'
			),
			array(
				'id'      => 'footer_menu_column_title',
				'type'    => 'text',
				'title'   => esc_html__('Menu Column Title', 'highlt'),
				'default' => esc_html__('Menu Title', 'highlt'),
				'desc'    => wp_kses(__('you can set <mark> title</mark> for menu column', 'highlt'), $allowed_html),
			),
			array(
				'id'     => 'footer_menu',
				'type'   => 'repeater',
				'title'  => esc_html__('Footer Menu Repeater', 'highlt'),
				'fields' => array(
					array(
						'id'      => 'footer_menu_item_title',
						'type'    => 'text',
						'title'   => esc_html__('Footer Menu Title', 'highlt'),
						'default' => esc_html__('Home', 'highlt'),
					),
					array(
						'id'      => 'footer_menu_item_url',
						'type'    => 'text',
						'title'   => esc_html__('Menu URL', 'highlt'),
						'default' => '#'
					),
				)
			),

			// footer contact information
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Footer Contact Info', 'highlt') . '</h3>'
			),
			array(
				'id'      => 'footer_contact_column_title',
				'type'    => 'text',
				'title'   => esc_html__('Contact Column Title', 'highlt'),
				'default' => esc_html__('Contact Us', 'highlt'),
				'desc'    => wp_kses(__('you can set <mark> title</mark> for contact column', 'highlt'), $allowed_html),
			),
			array(
				'id'      => 'footer_contact_phone_number',
				'type'    => 'text',
				'title'   => esc_html__('Contact Phone Number', 'highlt'),
				'default' => esc_html__('(347) 268-4178', 'highlt'),
				'desc'    => wp_kses(__('you can set <mark> phone number</mark> for contact column', 'highlt'), $allowed_html),
			),
			array(
				'id'      => 'footer_contact_email',
				'type'    => 'text',
				'title'   => esc_html__('Contact Email', 'highlt'),
				'default' => esc_html__('info@yourdomain.com', 'highlt'),
				'desc'    => wp_kses(__('you can set <mark> email</mark> for contact column', 'highlt'), $allowed_html),
			),
			array(
				'id'      => 'footer_contact_location',
				'type'    => 'text',
				'title'   => esc_html__('Contact Location', 'highlt'),
				'default' => esc_html__('123 Main Street, City, State 12345', 'highlt'),
				'desc'    => wp_kses(__('you can set <mark> location</mark> for contact column', 'highlt'), $allowed_html),
			),

			// Download Resume

			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Footer Download Resume', 'highlt') . '</h3>'
			),
			array(
				'id'      => 'footer_download_resume_enable',
				'type'    => 'text',
				'title'   => esc_html__('Download Resume Text', 'highlt'),
				'desc'    => wp_kses(__('you can set <mark> download resume text</mark> for contact column', 'highlt'), $allowed_html),
				'default' => esc_html__('Download Resume', 'highlt'),
			),
			array(
				'id'      => 'footer_download_resume_link',
				'type'    => 'text',
				'title'   => esc_html__('Download Resume Link', 'highlt'),
				'desc'    => wp_kses(__('you can set <mark> download resume link</mark> for contact column', 'highlt'), $allowed_html),
				'default' => '#',
			),

			// Footer Social Icon
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Footer Social Item Settings', 'highlt') . '</h3>'
			),
	
			array(
				'id'         => 'footer_social_repeater',
				'type'       => 'repeater',
				'title'      => esc_html__('Social Item Repeater', 'highlt'),
				'fields'     => array(
					array(
						'id'      => 'footer_social_icon_item_icon',
						'type'    => 'media',
						'title'   => esc_html__('Logo', 'highlt'),
						'library' => 'image',
						'desc'    => wp_kses(__('you can upload <mark> logo</mark> here it will overwrite customizer uploaded logo', 'highlt'), $allowed_html),
					),
					array(
						'id'      => 'footer_social_icon_item_url',
						'type'    => 'text',
						'title'   => esc_html__('Social URL', 'highlt'),
						'default' => '#'
					),
				)
			),
			
			// Footer Copyright Area
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Footer Copyright Area', 'highlt') . '</h3>'
			),

			array(
				'id'    => 'copyright_text',
				'title' => esc_html__('Copyright Area Text', 'highlt'),
				'type'  => 'textarea',
				'desc'  => wp_kses(__('use  <mark>{copy}</mark> for copyright symbol, use <mark>{year}</mark> for current year, ', 'highlt'), $allowed_html)
			),


			// Footer Copyright Area
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Footer Bottom Menu', 'highlt') . '</h3>'
			),
			array(
				'id'     => 'footer_bottom_menu',
				'type'   => 'repeater',
				'title'  => esc_html__('Footer Bottom Menu', 'highlt'),
				'fields' => array(
					array(
						'id'      => 'footer_bottom_menu_item_title',
						'type'    => 'text',
						'title'   => esc_html__('Footer Bottom Menu Title', 'highlt'),
						'default' => esc_html__('Home', 'highlt'),
					),
					array(
						'id'      => 'footer_bottom_menu_item_url',
						'type'    => 'text',
						'title'   => esc_html__('Menu URL', 'highlt'),
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
		'title' => esc_html__('Blog Settings', 'highlt'),
		'icon'  => 'fa fa-book'
	));
	CSF::createSection($prefix . '_theme_options', array(
		'parent' => 'blog_settings',
		'id'     => 'blog_post_options',
		'title'  => esc_html__('Blog Post', 'highlt'),
		'icon'   => 'fa fa-list-ul',
		'fields' => Highlt_Group_Fields::post_meta('blog_post', esc_html__('Blog Page', 'highlt'))
	));
	CSF::createSection($prefix . '_theme_options', array(
		'parent' => 'blog_settings',
		'id'     => 'blog_single_post_options',
		'title'  => esc_html__('Single Post', 'highlt'),
		'icon'   => 'fa fa-list-alt',
		'fields' => Highlt_Group_Fields::post_meta('blog_single_post', esc_html__('Blog Single Page', 'highlt'))
	));


	/*-------------------------------------------------------
		  ** Pages & templates Options
   --------------------------------------------------------*/
	CSF::createSection($prefix . '_theme_options', array(
		'id'    => 'pages_and_template',
		'title' => esc_html__('Pages Settings', 'highlt'),
		'icon'  => 'fa fa-files-o'
	));
	/*  404 page options */
	CSF::createSection($prefix . '_theme_options', array(
		'id'     => '404_page',
		'title'  => esc_html__('404 Page', 'highlt'),
		'parent' => 'pages_and_template',
		'icon'   => 'fa fa-exclamation-triangle',
		'fields' => array(
			array(
				'id'      => 'error_bg_switch',
				'title'   => esc_html__('404 Image Enable', 'highlt'),
				'type'    => 'switcher',
				'desc'    => wp_kses(__('you can set <mark>Yes / No</mark> to show/hide breadcrumb', 'highlt'), $allowed_html),
				'default' => true,
			),
			array(
				'id'         => 'error_bg',
				'title'      => esc_html__('404 Image', 'highlt'),
				'type'       => 'media',
				'desc'       => wp_kses(__('you can set <mark>background</mark> for breadcrumb', 'highlt'), $allowed_html),
				'dependency' => array('error_bg_switch', '==', 'true')
			),
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('404 Page Options', 'highlt') . '</h3>',
			),
			array(
				'id'      => '404_bg_color',
				'type'    => 'color',
				'title'   => esc_html__('Page Background Color', 'highlt'),
				'default' => '#ffffff'
			),
			array(
				'id'         => '404_title',
				'title'      => esc_html__('Title', 'highlt'),
				'type'       => 'text',
				'info'       => wp_kses(__('you can change <mark>title</mark> of 404 page', 'highlt'), $allowed_html),
				'attributes' => array('placeholder' => esc_html__('Sorry! The Page Not Found', 'highlt'))
			),
			array(
				'id'         => '404_paragraph',
				'title'      => esc_html__('Paragraph', 'highlt'),
				'type'       => 'textarea',
				'info'       => wp_kses(__('you can change <mark>paragraph</mark> of 404 page', 'highlt'), $allowed_html),
				'attributes' => array('placeholder' => esc_html__('Oops! The page you are looking for does not exit. it might been moved or deleted.', 'highlt'))
			),
			array(
				'id'         => '404_button_text',
				'title'      => esc_html__('Button Text', 'highlt'),
				'type'       => 'text',
				'info'       => wp_kses(__('you can change <mark>button text</mark> of 404 page', 'highlt'), $allowed_html),
				'attributes' => array('placeholder' => esc_html__('back to home', 'highlt'))
			),
			array(
				'id'      => '404_spacing_top',
				'title'   => esc_html__('Page Spacing Top', 'highlt'),
				'type'    => 'slider',
				'desc'    => wp_kses(__('you can set <mark>Padding Top</mark> for page content area.', 'highlt'), $allowed_html),
				'min'     => 0,
				'max'     => 500,
				'step'    => 1,
				'unit'    => 'px',
				'default' => 120,
			),
			array(
				'id'      => '404_spacing_bottom',
				'title'   => esc_html__('Page Spacing Bottom', 'highlt'),
				'type'    => 'slider',
				'desc'    => wp_kses(__('you can set <mark>Padding Bottom</mark> for page content area.', 'highlt'), $allowed_html),
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
		'title'  => esc_html__('Blog Page', 'highlt'),
		'parent' => 'pages_and_template',
		'icon'   => 'fa fa-indent',
		'fields' => Highlt_Group_Fields::page_layout_options(esc_html__('Blog', 'highlt'), 'blog')
	));
	/*  blog single page options */
	CSF::createSection($prefix . '_theme_options', array(
		'id'     => 'blog_single_page',
		'title'  => esc_html__('Blog Single Page', 'highlt'),
		'parent' => 'pages_and_template',
		'icon'   => 'fa fa-indent',
		'fields' => Highlt_Group_Fields::page_layout_options(esc_html__('Blog Single', 'highlt'), 'blog_single')
	));
	/*  archive page options */
	CSF::createSection($prefix . '_theme_options', array(
		'id'     => 'archive_page',
		'title'  => esc_html__('Archive Page', 'highlt'),
		'parent' => 'pages_and_template',
		'icon'   => 'fa fa-archive',
		'fields' => Highlt_Group_Fields::page_layout_options(esc_html__('Archive', 'highlt'), 'archive')
	));
	/*  search page options */
	CSF::createSection($prefix . '_theme_options', array(
		'id'     => 'search_page',
		'title'  => esc_html__('Search Page', 'highlt'),
		'parent' => 'pages_and_template',
		'icon'   => 'fa fa-search',
		'fields' => Highlt_Group_Fields::page_layout_options(esc_html__('Search', 'highlt'), 'search')
	));

	/*-------------------------------------------------------
		   ** Backup  Options
	--------------------------------------------------------*/
	CSF::createSection($prefix . '_theme_options', array(
		'id'     => 'backup',
		'title'  => esc_html__('Import / Export', 'highlt'),
		'icon'   => 'eicon-export-kit',
		'fields' => array(
			array(
				'type'    => 'notice',
				'style'   => 'warning',
				'content' => esc_html__('You can save your current options. Download a Backup and Import.', 'highlt'),
			),
			array(
				'type'  => 'backup',
				'title' => esc_html__('Backup & Import', 'highlt')
			)
		)
	));
}
