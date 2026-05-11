<?php

$js_files = array(
    array(
        'handle' => 'bootstrap',
        'src' => HIGHIT_JS . '/bootstrap.min.js',
        'deps' => array('jquery'),
        'in_footer' => true // This ensures the script is loaded in the footer
    ),
    array(
        'handle' => 'preloader',
        'src' => HIGHIT_JS . '/preloader.js',
        'deps' => array('jquery'),
        'in_footer' => true
    ),
    array(
        'handle' => 'highit-jquery-ui',
        'src' => '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js',
        'deps' => array('jquery'),
        'in_footer' => true
    ),
    array(
        'handle' => 'highit-main-script',
        'src' => HIGHIT_JS . '/main' . $js_ext,
        'deps' => array('jquery'),
        'in_footer' => true
    ),
);

if (class_exists('WooCommerce')) {
    $js_files[] = array(
        'handle' => 'highit-woocommerce',
        'src' => HIGHIT_JS . '/woocommerce' . $js_ext,
        'deps' => array('jquery'),
        'in_footer' => true
    );
    $js_files[] = array(
        'handle' => 'highit-product-filter',
        'src' => HIGHIT_JS . '/product-filter' . $js_ext,
        'deps' => array('jquery'),
        'in_footer' => true
    );
}

return $js_files;
