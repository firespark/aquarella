<?php
function custom_styles_js_files(){
       
        wp_enqueue_style('google_fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400|Source+Code+Pro:700,900&display=swap');
        wp_enqueue_style('bootstrap_css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css');
        wp_enqueue_style('font_awesome_css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css');
        wp_enqueue_style('slick_css', get_template_directory_uri().'/lib/slick/slick.css');
        wp_enqueue_style('slick_theme_css', get_template_directory_uri().'/lib/slick/slick-theme.css');
        wp_enqueue_style('style_css', get_template_directory_uri().'/css/style.css', [], '26');
        wp_enqueue_style('custom_css', get_template_directory_uri().'/css/custom.css', [], '26');

        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', 'https://code.jquery.com/jquery-3.4.1.min.js', [], 1, true);
        wp_enqueue_script( 'jquery' );

        wp_enqueue_script('bootstrap_bundle_min_js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js', [], 1, true);
        wp_enqueue_script('easing_min_js', get_template_directory_uri().'/lib/easing/easing.min.js', [], 1, true);
        wp_enqueue_script('slick_min_js', get_template_directory_uri().'/lib/slick/slick.min.js', [], 1, true);
        wp_enqueue_script('main_js', get_template_directory_uri().'/js/main.js', [], 1, true);
}