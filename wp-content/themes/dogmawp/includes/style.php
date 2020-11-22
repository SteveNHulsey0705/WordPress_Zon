<?php
$wr_options = get_option('wr_wp');
function dogma_wp_style() {
//home
wp_enqueue_style('main', get_template_directory_uri() . '/style.css');
wp_enqueue_style('reset', get_template_directory_uri() . '/includes/css/reset.css');
wp_enqueue_style('plugins', get_template_directory_uri() . '/includes/css/plugins.css');
wp_enqueue_style('style', get_template_directory_uri() . '/includes/css/style.css');
wp_enqueue_style('yourstyle', get_template_directory_uri() . '/includes/css/yourstyle.css');
wp_enqueue_style('js_composer_front-css', get_template_directory_uri() . '/includes/css/js_composer.min.css');
}
add_action('wp_enqueue_scripts', 'dogma_wp_style');
function dogma_enqueue_custom_admin_style() {
wp_register_style( 'custom_wp_admin_css', get_template_directory_uri() . '/includes/css/admin-style.css', false, '1.0.0' );
wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'dogma_enqueue_custom_admin_style' );