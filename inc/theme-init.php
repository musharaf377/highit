<?php

/**
 * Theme Init Functions
 * @package highit
 * @since 1.0.0
 */

if (!defined("ABSPATH")) {
    exit(); //exit if access directly
}

if (!class_exists('Highit_Init')) {

    class Highit_Init
    {
        /**
         * $instance
         * @since 1.0.0
         */
        protected static $instance;

        public function __construct()
        {
            /*
             * theme setup
             */
            add_action('after_setup_theme', array($this, 'theme_setup'));
            /**
             * Widget Init
             */
            add_action('widgets_init', array($this, 'theme_widgets_init'));
            /**
             * Theme Assets
             */
            add_action('wp_enqueue_scripts', array($this, 'theme_assets'));
            /**
             * Registers an editor stylesheet for the theme.
             */
            add_action('admin_init', array($this, 'add_editor_styles'));
            /**
             * enqueue an editor stylesheet for the gutenbarg.
             */
            add_action('enqueue_block_editor_assets', array($this, 'load_gutenberg_script'));
        }

        /**
         * getInstance()
         */
        public static function getInstance()
        {
            if (null == self::$instance) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        /**
         * Theme Setup
         * @since 1.0.0
         */
        public function theme_setup()
        {
            /*
             * Make theme available for translation.
             * Translations can be filed in the /languages/ directory.
             */
            load_theme_textdomain('highit', get_template_directory() . '/languages');

            // Add default posts and comments RSS feed links to head.
            add_theme_support('automatic-feed-links');

            /*
             * Let WordPress manage the document title.
             */
            add_theme_support('title-tag');

            /*
             * Enable support for Post Thumbnails on posts and pages.
             *
             * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
             */
            add_theme_support('post-thumbnails');

            // This theme uses wp_nav_menu() in one location.
            register_nav_menus(array(
                'main-menu' => esc_html__('Primary Menu', 'highit'),
                'main-menu-02' => esc_html__('Primary Menu Two', 'highit'),
            ));

            /*
             * Switch default core markup for search form, comment form, and comments
             * to output valid HTML5.
             */
            add_theme_support('html5', array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            ));

            // Add theme support for selective wp block styles
            add_theme_support("wp-block-styles");
            // Add theme support for selective align wide
            add_theme_support("align-wide");
            // Add theme support for selective responsive embeds
            add_theme_support("responsive-embeds");

            // Add theme support for selective refresh for widgets.
            add_theme_support('customize-selective-refresh-widgets');

            /**
             * Add support for core custom logo.
             *
             * @link https://codex.wordpress.org/Theme_Logo
             */
            add_theme_support('custom-logo', array(
                'height' => 250,
                'width' => 250,
                'flex-width' => true,
                'flex-height' => true,
            ));

            //woocommerce support
            add_theme_support('woocommerce');
            add_theme_support('wc-product-gallery-zoom');
            add_theme_support('wc-product-gallery-lightbox');
            add_theme_support('wc-product-gallery-slider');
            //add theme support for post format
            add_theme_support('post-formats', array('image', 'video', 'gallery', 'link', 'quote'));

            // This variable is intended to be overruled from themes.
            $GLOBALS['content_width'] = apply_filters('highit_content_width', 740);

            //add image sizes
            add_image_size('highit_classic', 750, 400, true);
            add_image_size('highit_grid', 370, 270, true);
            add_image_size('highit_medium', 550, 380, true);

            self::load_theme_dependency_files();
        }

        /**
         * Theme Widget Init
         * @since 1.0.0
         * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
         */
        public function theme_widgets_init()
        {
            $sidebars = require_once HIGHIT_THEME_ROOT . '/config/sidebars.php';

            if (!empty($sidebars)) {
                foreach ($sidebars as $key => $sidebar) {
                    register_sidebar($sidebar);
                }
            }
        }

        /**
         * Theme Assets
         * @since 1.0.0
         */
        public function theme_assets()
        {
            self::load_theme_css();
            self::load_theme_js();
        }

        /*
         * Load theme options google fonts css
         * @since 1.0.0
         */
        public static function load_google_fonts()
        {

            $enqueue_fonts = array();
            //body font enqueue
            $body_font = cs_get_option('_body_font') ? cs_get_option('_body_font') : false;
            $body_font_variant = cs_get_option('body_font_variant') ? cs_get_option('body_font_variant') : false;
            $body_font['family'] = (isset($body_font['font-family']) && !empty($body_font['font-family'])) ? $body_font['font-family'] : 'Inter';
            $body_font['font'] = (isset($body_font['type']) && !empty($body_font['type'])) ? $body_font['type'] : 'google';
            $body_font_variant = !empty($body_font_variant) ? $body_font_variant : array(400, 700, 600, 500);
            $google_fonts = array();

            if (!empty($body_font_variant)) {
                foreach ($body_font_variant as $variant) {
                    $google_fonts[] = array(
                        'family' => $body_font['family'],
                        'variant' => $variant,
                        'font' => $body_font['font']
                    );
                }
            }
            //heading font enqueue
            $heading_font_enable = false;
            if (null == cs_get_option('heading_font_enable')) {
                $heading_font_enable = false;
            } elseif ('0' == cs_get_option('heading_font_enable')) {
                $heading_font_enable = true;
            } elseif ('1' == cs_get_option('heading_font_enable')) {
                $heading_font_enable = false;
            }
            $heading_font = cs_get_option('heading_font') ? cs_get_option('heading_font') : false;
            $heading_font_variant = cs_get_option('heading_font_variant') ? cs_get_option('heading_font_variant') : false;
            $heading_font['family'] = (isset($heading_font['font-family']) && !empty($heading_font['font-family'])) ? $heading_font['font-family'] : 'Inter';
            $heading_font['font'] = (isset($heading_font['type']) && !empty($heading_font['type'])) ? $heading_font['type'] : 'google';
            $heading_font_variant = !empty($heading_font_variant) ? $heading_font_variant : array(400, 500, 600, 700, 800);
            if (!empty($heading_font_variant) && !$heading_font_enable) {
                foreach ($heading_font_variant as $variant) {
                    $google_fonts[] = array(
                        'family' => $heading_font['family'],
                        'variant' => $variant,
                        'font' => $heading_font['font']
                    );
                }
            }

            if (!empty($google_fonts)) {
                foreach ($google_fonts as $font) {
                    if (!empty($font['font']) && $font['font'] == 'google') {
                        $variant = (!empty($font['variant']) && $font['variant'] !== 'regular') ? ':' . $font['variant'] : '';
                        if (!empty($font['family'])) {
                            $enqueue_fonts[] = $font['family'] . $variant;
                        }
                    }
                }
            }

            $enqueue_fonts = array_unique($enqueue_fonts);
            return $enqueue_fonts;
        }

        /**
         * Load Theme Css
         * @since 1.0.0
         */
        public function load_theme_css()
        {
            $theme_version = HIGHIT_DEV ? time() : highit()->get_theme_info('version');
            $css_ext = '.css';
            //load google fonts
            $enqueue_google_fonts = self::load_google_fonts();
            if (!empty($enqueue_google_fonts)) {
                wp_enqueue_style('highit-google-fonts', esc_url(add_query_arg('family', urlencode(implode('|', $enqueue_google_fonts)), '//fonts.googleapis.com/css')), array(), null);
            }

            $css_files = require_once HIGHIT_THEME_ROOT . '/config/files-css.php';

            $css_files = apply_filters('highit_theme_enqueue_style', $css_files);

            if (is_array($css_files) && !empty($css_files)) {
                foreach ($css_files as $css) {
                    
                    $css['ver'] = $theme_version;
                    $css['media'] = 'all';

                    call_user_func_array('wp_enqueue_style', $css);
                }
            }

            wp_enqueue_style('highit-style', get_stylesheet_uri());

            if (highit()->is_highit_core_active()) {
                if (file_exists(HIGHIT_DYNAMIC_STYLESHEETS . '/theme-inline-css-style.php')) {
                    require_once HIGHIT_DYNAMIC_STYLESHEETS . '/theme-inline-css-style.php';
                    require_once HIGHIT_DYNAMIC_STYLESHEETS . '/theme-option-css-style.php';
                    wp_add_inline_style('highit-style', highit()->minify_css_lines($GLOBALS['highit_inline_css']));
                    wp_add_inline_style('highit-style', highit()->minify_css_lines($GLOBALS['theme_customize_css']));
                }
            }
        }

        /**
         * Load Theme js
         * @since 1.0.0
         */
        public function load_theme_js()
        {
            $theme_version = highit()->get_theme_info('version');
            $js_ext = HIGHIT_DEV ? '.js' : '.min.js';

            $js_files = require_once HIGHIT_THEME_ROOT . '/config/files-js.php';

            $js_files = apply_filters('highit_theme_enqueue_script', $js_files);

            if (is_array($js_files) && !empty($js_files)) {
                foreach ($js_files as $js) {
                    wp_enqueue_script(
                        $js['handle'],
                        $js['src'],
                        $js['deps'],
                        $theme_version,
                        $js['in_footer'] // Ensure this is passed to load the script in the footer
                    );
                }
            }

            if (is_singular() && comments_open() && get_option('thread_comments')) {
                wp_enqueue_script('comment-reply');
            }
        }


        /**
         * Load THeme Dependency Files
         * @since 1.0.0
         */
        public function load_theme_dependency_files()
        {
            $includes_files = require_once HIGHIT_THEME_ROOT . '/config/files-php.php';

            if (is_array($includes_files) && !empty($includes_files)) {
                foreach ($includes_files as $file) {
                    if (file_exists($file['file-path'] . '/' . $file['file-name'] . '.php')) {
                        require_once $file['file-path'] . '/' . $file['file-name'] . '.php';
                    }
                }
            }
        }

        /**
         * Add editor style
         * @since 1.0.0
         */
        public function add_editor_styles()
        {
            add_editor_style(get_template_directory_uri() . '/assets/css/editor-style.css');
        }

        /**
         * Add gutenberg editor script
         * @hook enqueue_block_editor_assets
         */
        public function load_gutenberg_script()
        {
            $theme_version = HIGHIT_DEV ? time() : highit()->get_theme_info('version');
            $css_ext = '.css';

            //load google fonts
            $enqueue_google_fonts = self::load_google_fonts();
            if (!empty($enqueue_google_fonts)) {
                wp_enqueue_style('highit-google-fonts', esc_url(add_query_arg('family', urlencode(implode('|', $enqueue_google_fonts)), '//fonts.googleapis.com/css')), array(), null);
            }

            wp_enqueue_style('flaticon', HIGHIT_CSS . '/flaticon.css', [], $theme_version, 'all');
            wp_enqueue_style('flynext-gutenbarg', HIGHIT_CSS . '/gutenberg.css', [], $theme_version, 'all');
        }
    } //end class

    if (class_exists('Highit_Init')) {
        Highit_Init::getInstance();
    }
}
