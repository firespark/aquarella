<?php

require_once(__DIR__ . '/functions/common_functions.php');
require_once(__DIR__ . '/functions/styles_js_files.php');
require_once(__DIR__ . '/functions/posts_functions.php');
require_once(__DIR__ . '/functions/theme_functions.php');
require_once(__DIR__ . '/functions/ajax_functions.php');
require_once(__DIR__ . '/functions/tgm_plugin_functions.php');

add_action( 'after_setup_theme', 'custom_theme_setup');

// Main settings
$optionsArr = get_fields('options');

// Styles and js files
add_action('wp_enqueue_scripts','custom_styles_js_files');


add_action( 'init', 'custom_new_taxonomies_for_pages' );

if ( ! is_admin() ) {
    add_action( 'pre_get_posts', 'custom_tag_cat_archives' );
}

// Tgm Plugin (List of required plugins for this theme)
add_action( 'tgmpa_register', 'custom_register_required_plugins' );

