<?php

define('THEME_VER', wp_get_theme()->get('Version'));


// Add custom Theme Functions here
include_once __DIR__ . '/includes/dd_file_upload/index.php';
include_once __DIR__ . '/includes/wcmp.php';
include_once __DIR__ . '/includes/my-account.php';
include_once __DIR__ . '/includes/before-after.php';




add_action( 'wp_enqueue_scripts', 'child_theme_enqueue_styles' );
function child_theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_uri(),
        array( 'parenthandle' ),
        THEME_VER // this only works if you have Version in the style header
    );
}

