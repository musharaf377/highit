<?php

$css_files = array(
    array(
        'handle' => 'bootstrap',
        'src' => HIGHIT_CSS . '/bootstrap.min.css',
        'deps' => array(),
    ),
    array(
        'handle' => 'jquery-ui',
        'src' => '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css',
        'deps' => array('bootstrap'),
    ),
    array(
        'handle' => 'highit-main-style',
        'src' => HIGHIT_CSS . '/main-style' . $css_ext,
        'deps' => array(),
    ),
    array(
        'handle' => 'highit-responsive',
        'src' => HIGHIT_CSS . '/responsive' . $css_ext,
        'deps' => array(),
    ),
);

return $css_files;
