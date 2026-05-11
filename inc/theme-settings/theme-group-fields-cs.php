<?php

/**
 *Theme Group Fields
 * @package highit
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); // exit if access directly
}


if (!class_exists('Highit_Group_Fields')) {

    class Highit_Group_Fields
    {

        /**
         * $instance
         * @since 1.0.0
         */
        private static $instance;


        /**
         * construct()
         * @since 1.0.0
         */
        public function __construct() {}

        /**
         * getInstance()
         * @since 1.0.0
         */
        public static function getInstance()
        {
            if (null == self::$instance) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        /**
         * Page layout options
         * @since 1.0.0
         */
        public static function page_layout()
        {
            $fields = array(
                array(
                    'type' => 'subheading',
                    'content' => esc_html__('Page Layouts & Colors Options', 'highit'),
                ),
                array(
                    'id' => 'page_layout',
                    'type' => 'image_select',
                    'title' => esc_html__('Select Page Layout', 'highit'),
                    'options' => array(
                        'default' => HIGHIT_THEME_SETTINGS_IMAGES . '/page/default.png',
                        'left-sidebar' => HIGHIT_THEME_SETTINGS_IMAGES . '/page/left-sidebar.png',
                        'right-sidebar' => HIGHIT_THEME_SETTINGS_IMAGES . '/page/right-sidebar.png',
                        'blank' => HIGHIT_THEME_SETTINGS_IMAGES . '/page/blank.png',
                    ),
                    'default' => 'default'
                ),
                array(
                    'id' => 'page_bg_color',
                    'type' => 'color',
                    'title' => esc_html__('Page Background Color', 'highit'),
                    'default' => '#ffffff'
                ),
                array(
                    'id' => 'page_content_bg_color',
                    'type' => 'color',
                    'title' => esc_html__('Page Content Background Color', 'highit'),
                    'default' => '#ffffff'
                ),
                array(
                    'id' => 'page_content_text_color',
                    'type' => 'color',
                    'title' => esc_html__('Page Content Text Color', 'highit'),
                    'default' => '#5f5f5f'
                )

            );

            return $fields;
        }

        /**
         * Page container options
         * @since 1.0.0
         */
        public static function Page_Container_Options($type)
        {
            $fields = array();
            $allowed_html = highit()->kses_allowed_html(array('mark'));
            if ('header_options' == $type) {
                $fields = array(
                    array(
                        'type' => 'subheading',
                        'content' => esc_html__('Page Header, Footer & Breadcrumb Options', 'highit'),
                    ),
                    array(
                        'id' => 'page_title',
                        'type' => 'switcher',
                        'title' => esc_html__('Page Title', 'highit'),
                        'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show/hide page title.', 'highit'), $allowed_html),
                        'text_on' => esc_html__('Yes', 'highit'),
                        'text_off' => esc_html__('No', 'highit'),
                        'default' => true
                    ),
                    array(
                        'id' => 'page_breadcrumb',
                        'type' => 'switcher',
                        'title' => esc_html__('Page Breadcrumb', 'highit'),
                        'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show/hide page breadcrumb.', 'highit'), $allowed_html),
                        'text_on' => esc_html__('Yes', 'highit'),
                        'text_off' => esc_html__('No', 'highit'),
                        'default' => true
                    ),
                    array(
                        'id' => 'navbar_type',
                        'title' => esc_html__('Navbar Type', 'highit'),
                        'type' => 'image_select',
                        'options' => array(
                            '' => HIGHIT_THEME_SETTINGS_IMAGES . '/header/01.png'
                        ),
                        'default' => '',
                        'desc' => wp_kses(__('you can set <mark>navbar type</mark> transparent type or solid background.', 'highit'), $allowed_html),
                    ),
                    array(
                        'id' => 'footer_type',
                        'title' => esc_html__('Footer Type', 'highit'),
                        'type' => 'image_select',
                        'options' => array(
                            '' => HIGHIT_THEME_SETTINGS_IMAGES . '/footer/01.png'
                        ),
                        'default' => '',
                        'desc' => wp_kses(__('you can set <mark>footer type</mark> transparent type or solid background.', 'highit'), $allowed_html),
                    ),

                );
            } elseif ('container_options' == $type) {
                $fields = array(
                    array(
                        'type' => 'subheading',
                        'content' => esc_html__('Page Width & Padding Options', 'highit'),
                    ),
                    array(
                        'id' => 'page_container',
                        'type' => 'switcher',
                        'title' => esc_html__('Page Full Width', 'highit'),
                        'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to set page container full width.', 'highit'), $allowed_html),
                        'text_on' => esc_html__('Yes', 'highit'),
                        'text_off' => esc_html__('No', 'highit'),
                        'default' => false
                    ),
                    array(
                        'type' => 'subheading',
                        'content' => esc_html__('Page Spacing Options', 'highit'),
                    ),
                    array(
                        'id' => 'page_spacing_top',
                        'title' => esc_html__('Page Spacing Top', 'highit'),
                        'type' => 'slider',
                        'desc' => wp_kses(__('you can set <mark>Padding Top</mark> for page container.', 'highit'), $allowed_html),
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                        'unit' => 'px',
                        'default' => 120,
                    ),
                    array(
                        'id' => 'page_spacing_bottom',
                        'title' => esc_html__('Page Spacing Bottom', 'highit'),
                        'type' => 'slider',
                        'desc' => wp_kses(__('you can set <mark>Padding Bottom</mark> for page container.', 'highit'), $allowed_html),
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                        'unit' => 'px',
                        'default' => 120,
                    ),
                    array(
                        'type' => 'subheading',
                        'content' => esc_html__('Page Content Spacing Options', 'highit'),
                    ),
                    array(
                        'id' => 'page_content_spacing',
                        'type' => 'switcher',
                        'title' => esc_html__('Page Content Spacing', 'highit'),
                        'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to set page content spacing.', 'highit'), $allowed_html),
                        'text_on' => esc_html__('Yes', 'highit'),
                        'text_off' => esc_html__('No', 'highit'),
                        'default' => false
                    ),
                    array(
                        'id' => 'page_content_spacing_top',
                        'title' => esc_html__('Page Spacing Bottom', 'highit'),
                        'type' => 'slider',
                        'desc' => wp_kses(__('you can set <mark>Padding Top</mark> for page content area.', 'highit'), $allowed_html),
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                        'unit' => 'px',
                        'default' => 0,
                        'dependency' => array('page_content_spacing', '==', 'true')
                    ),
                    array(
                        'id' => 'page_content_spacing_bottom',
                        'title' => esc_html__('Page Spacing Bottom', 'highit'),
                        'type' => 'slider',
                        'desc' => wp_kses(__('you can set <mark>Padding Bottom</mark> for page content area.', 'highit'), $allowed_html),
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                        'unit' => 'px',
                        'default' => 0,
                        'dependency' => array('page_content_spacing', '==', 'true')
                    ),
                    array(
                        'id' => 'page_content_spacing_left',
                        'title' => esc_html__('Page Spacing Left', 'highit'),
                        'type' => 'slider',
                        'desc' => wp_kses(__('you can set <mark>Padding Left</mark> for page content area.', 'highit'), $allowed_html),
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                        'unit' => 'px',
                        'default' => 0,
                        'dependency' => array('page_content_spacing', '==', 'true')
                    ),
                    array(
                        'id' => 'page_content_spacing_right',
                        'title' => esc_html__('Page Spacing Right', 'highit'),
                        'type' => 'slider',
                        'desc' => wp_kses(__('you can set <mark>Padding Right</mark> for page content area.', 'highit'), $allowed_html),
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                        'unit' => 'px',
                        'default' => 0,
                        'dependency' => array('page_content_spacing', '==', 'true')
                    ),
                );
            }

            return $fields;
        }


        /**
         * Page layout options
         * @since 1.0.0
         */
        public static function page_layout_options($title, $prefix)
        {
            $allowed_html = highit()->kses_allowed_html(array('mark'));
            $fields = array(
                array(
                    'type' => 'subheading',
                    'content' => '<h3>' . $title . esc_html__(' Page Options', 'highit') . '</h3>',
                ),
                array(
                    'id' => $prefix . '_layout',
                    'type' => 'image_select',
                    'title' => esc_html__('Select Page Layout', 'highit'),
                    'options' => array(
                        'right-sidebar' => HIGHIT_THEME_SETTINGS_IMAGES . '/page/right-sidebar.png',
                        'left-sidebar' => HIGHIT_THEME_SETTINGS_IMAGES . '/page/left-sidebar.png',
                        'no-sidebar' => HIGHIT_THEME_SETTINGS_IMAGES . '/page/no-sidebar.png',
                    ),
                    'default' => 'right-sidebar'
                ),
                array(
                    'id' => $prefix . '_bg_color',
                    'type' => 'color',
                    'title' => esc_html__('Page Background Color', 'highit'),
                    'default' => '#fff'
                ),
                array(
                    'id' => $prefix . '_spacing_top',
                    'title' => esc_html__('Page Spacing Top', 'highit'),
                    'type' => 'slider',
                    'desc' => wp_kses(__('you can set <mark>Padding Top</mark> for page content area.', 'highit'), $allowed_html),
                    'min' => 0,
                    'max' => 500,
                    'step' => 1,
                    'unit' => 'px',
                    'default' => 120,
                ),
                array(
                    'id' => $prefix . '_spacing_bottom',
                    'title' => esc_html__('Page Spacing Bottom', 'highit'),
                    'type' => 'slider',
                    'desc' => wp_kses(__('you can set <mark>Padding Bottom</mark> for page content area.', 'highit'), $allowed_html),
                    'min' => 0,
                    'max' => 500,
                    'step' => 1,
                    'unit' => 'px',
                    'default' => 120,
                ),
            );

            return $fields;
        }

        /**
         * Post meta
         * @since 1.0.0
         */
        public static function post_meta($prefix, $title)
        {
            $allowed_html = highit()->kses_allowed_html(array('mark'));
            $fields = array(
                array(
                    'type' => 'subheading',
                    'content' => '<h3>' . $title . esc_html__(' Post Options', 'highit') . '</h3>',
                ),
                array(
                    'id' => $prefix . '_posted_by',
                    'type' => 'switcher',
                    'title' => esc_html__('Posted By', 'highit'),
                    'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide posted by.', 'highit'), $allowed_html),
                    'text_on' => esc_html__('Yes', 'highit'),
                    'text_off' => esc_html__('No', 'highit'),
                    'default' => true
                )
            );

            if ('blog_post' == $prefix) {
                $fields[] = array(
                    'id' => $prefix . '_posted_cat',
                    'type' => 'switcher',
                    'title' => esc_html__('Posted Category', 'highit'),
                    'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide posted category.', 'highit'), $allowed_html),
                    'text_on' => esc_html__('Yes', 'highit'),
                    'text_off' => esc_html__('No', 'highit'),
                    'default' => true
                );
                $fields[] = array(
                    'id' => $prefix . '_readmore_btn',
                    'type' => 'switcher',
                    'title' => esc_html__('Read More Button', 'highit'),
                    'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide read more button.', 'highit'), $allowed_html),
                    'text_on' => esc_html__('Yes', 'highit'),
                    'text_off' => esc_html__('No', 'highit'),
                    'default' => true
                );
                $fields[] = array(
                    'id' => $prefix . '_readmore_btn_text',
                    'type' => 'text',
                    'title' => esc_html__('Read More Text', 'highit'),
                    'desc' => wp_kses(__('you can set read more <mark>button text</mark> to button text.', 'highit'), $allowed_html),
                    'default' => esc_html__('Read More', 'highit'),
                    'dependency' => array($prefix . '_readmore_btn', '==', 'true')
                );
                $fields[] = array(
                    'id' => $prefix . '_excerpt_more',
                    'type' => 'text',
                    'title' => esc_html__('Excerpt More', 'highit'),
                    'desc' => wp_kses(__('you can set read more <mark>button text</mark> to button text.', 'highit'), $allowed_html),
                    'attributes' => array(
                        'placeholder' => esc_html__('....', 'highit')
                    )
                );
                $fields[] = array(
                    'id' => $prefix . '_excerpt_length',
                    'type' => 'select',
                    'options' => array(
                        '25' => esc_html__('Short', 'highit'),
                        '55' => esc_html__('Regular', 'highit'),
                        '100' => esc_html__('Long', 'highit'),
                    ),
                    'title' => esc_html__('Excerpt Length', 'highit'),
                    'desc' => wp_kses(__('you can set <mark> excerpt length</mark> for post.', 'highit'), $allowed_html),
                );
            } elseif ('blog_single_post' == $prefix) {

                $fields[] = array(
                    'id' => $prefix . '_posted_category',
                    'type' => 'switcher',
                    'title' => esc_html__('Posted Category', 'highit'),
                    'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide posted category.', 'highit'), $allowed_html),
                    'text_on' => esc_html__('Yes', 'highit'),
                    'text_off' => esc_html__('No', 'highit'),
                    'default' => true
                );
                $fields[] = array(
                    'id' => $prefix . '_posted_tag',
                    'type' => 'switcher',
                    'title' => esc_html__('Posted Tags', 'highit'),
                    'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide post tags.', 'highit'), $allowed_html),
                    'text_on' => esc_html__('Yes', 'highit'),
                    'text_off' => esc_html__('No', 'highit'),
                    'default' => true
                );
                $fields[] = array(
                    'id' => $prefix . '_posted_share',
                    'type' => 'switcher',
                    'title' => esc_html__('Post Share', 'highit'),
                    'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide post share.', 'highit'), $allowed_html),
                    'text_on' => esc_html__('Yes', 'highit'),
                    'text_off' => esc_html__('No', 'highit'),
                    'default' => true
                );
                $fields[] = array(
                    'id' => $prefix . '_post_navigation',
                    'type' => 'switcher',
                    'title' => esc_html__('Post Navigation', 'highit'),
                    'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide post navigation.', 'highit'), $allowed_html),
                    'text_on' => esc_html__('Yes', 'highit'),
                    'text_off' => esc_html__('No', 'highit'),
                    'default' => true
                );
                $fields[] = array(
                    'id' => $prefix . '_next_post_nav_btn',
                    'type' => 'switcher',
                    'title' => esc_html__('Post Navigation With Image', 'highit'),
                    'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide post navigation button.', 'highit'), $allowed_html),
                    'text_on' => esc_html__('Yes', 'highit'),
                    'text_off' => esc_html__('No', 'highit'),
                    'default' => true
                );
                $fields[] = array(
                    'id' => $prefix . '_get_related_post',
                    'type' => 'switcher',
                    'title' => esc_html__('Get Related Post', 'highit'),
                    'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide get related post button.', 'highit'), $allowed_html),
                    'text_on' => esc_html__('Yes', 'highit'),
                    'text_off' => esc_html__('No', 'highit'),
                    'default' => true
                );
                $fields[] = array(
                    'id' => $prefix . '_author_bio',
                    'type' => 'switcher',
                    'title' => esc_html__('Author Bio', 'highit'),
                    'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide author bio button.', 'highit'), $allowed_html),
                    'text_on' => esc_html__('Yes', 'highit'),
                    'text_off' => esc_html__('No', 'highit'),
                    'default' => true
                );
            }

            return $fields;
        }
    } //end class

}//end if
