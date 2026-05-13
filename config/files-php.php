<?php

$php_files = array(
    array(
        'file-name' => 'activation',
        'file-path' => HIGHLT_TGMA
    ),
    array(
        'file-name' => 'singletone',
        'file-path' => HIGHLT_INC .  '/traits/'
    ),
    array(
        'file-name' => 'functions',
        'file-path' => HIGHLT_INC .  '/traits/'
    ),
    array(
        'file-name' => 'theme-breadcrumb',
        'file-path' => HIGHLT_INC
    ),
    array(
        'file-name' => 'theme-excerpt',
        'file-path' => HIGHLT_INC
    ),
    array(
        'file-name' => 'theme-hook-customize',
        'file-path' => HIGHLT_INC
    ),
    array(
        'file-name' => 'theme-comments-modifications',
        'file-path' => HIGHLT_INC
    ),
    array(
        'file-name' => 'customizer',
        'file-path' => HIGHLT_INC
    ),
    array(
        'file-name' => 'svg-icon',
        'file-path' => HIGHLT_INC . '/svg-icon/',
    ),

    array(
        'file-name' => 'theme-group-fields-cs',
        'file-path' => HIGHLT_THEME_SETTINGS
    ),
    array(
        'file-name' => 'theme-group-fields-value-cs',
        'file-path' => HIGHLT_THEME_SETTINGS
    ),
    array(
        'file-name' => 'theme-metabox-cs',
        'file-path' => HIGHLT_THEME_SETTINGS
    ),
    array(
        'file-name' => 'theme-userprofile-cs',
        'file-path' => HIGHLT_THEME_SETTINGS
    ),
    array(
        'file-name' => 'theme-shortcode-option-cs',
        'file-path' => HIGHLT_THEME_SETTINGS
    ),
    array(
        'file-name' => 'theme-customizer-cs',
        'file-path' => HIGHLT_THEME_SETTINGS
    ),
    array(
        'file-name' => 'theme-option-cs',
        'file-path' => HIGHLT_THEME_SETTINGS
    ),
);

if (class_exists('WooCommerce')) {
    $php_files[] = array(
        'file-name' => 'theme-woocommerce-customize',
        'file-path' => HIGHLT_INC
    );
}

return $php_files;
