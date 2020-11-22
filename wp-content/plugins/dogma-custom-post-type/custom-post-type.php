<?php
/*
Plugin Name: Dogma Custom Post Type
Plugin URI: http://webrdox.net/
Description: Declares a plugin that will create a custom post type
Version: 1.0
Author: WebRedox
Author URI: http://webrdox.net/
License: GPLv2
*/

global $wr_options;


if( ! function_exists( 'portfolio_post_types' ) ) {
    function portfolio_post_types() {

        register_post_type(
            'portfolio',
            array(
                'labels' => array(
                    'name'          => __( 'Portfolio Post', 'portfolio' ),
                    'singular_name' => __( 'Portfolio', 'portfolio' ),
                    'add_new'       => __( 'Add New', 'portfolio' ),
                    'add_new_item'  => __( 'Add New Portfolio', 'portfolio' ),
                    'edit'          => __( 'Edit', 'portfolio' ),
                    'edit_item'     => __( 'Edit Portfolio', 'portfolio' ),
                    'new_item'      => __( 'New Portfolio', 'portfolio' ),
                    'view'          => __( 'View Portfolio', 'portfolio' ),
                    'view_item'     => __( 'View Portfolio', 'portfolio' ),
                    'search_items'  => __( 'Search Portfolio', 'portfolio' ),
                    'not_found'     => __( 'No Portfolio item found', 'portfolio' ),
                    'not_found_in_trash' => __( 'No portfolio item found in Trash', 'portfolio' ),
                    'parent'        => __( 'Parent Portfolio', 'portfolio' ),
                ),
                
                'description'       => __( 'Create a Portfolio.', 'portfolio' ),
                'public'            => true,
                'show_ui'           => true,
                'show_in_menu'          => true,
                'publicly_queryable'    => true,
                'exclude_from_search'   => true,
                'menu_position'         => 6,
                'hierarchical'      => true,
                'query_var'         => true,
				'menu_icon' => 'dashicons-portfolio',
                'supports'  => array (
                    'title', //Text input field to create a post title.
                    'editor',
                    'thumbnail',
                    
                )
            )
        );
register_taxonomy('portfolio_category', 'portfolio', array('hierarchical' => true, 'label' => 'Portfolio Categories', 'singular_name' => 'Category', "rewrite" => true, "query_var" => true));
        
        

    }
}

add_action( 'init', 'portfolio_post_types' ); // register post type

register_taxonomy_for_object_type('category', 'custom-type');



if( ! function_exists( 'slider_post_types' ) ) {
    function slider_post_types() {

        register_post_type(
            'slider',
            array(
                'labels' => array(
                    'name'          => __( 'Dogma Slider', 'slider' ),
                    'singular_name' => __( 'Slider', 'slider' ),
                    'add_new'       => __( 'Add New', 'slider' ),
                    'add_new_item'  => __( 'Add New Slide', 'slider' ),
                    'edit'          => __( 'Edit', 'slider' ),
                    'edit_item'     => __( 'Edit Slide', 'slider' ),
                    'new_item'      => __( 'New Slide', 'slider' ),
                    'view'          => __( 'View Slide', 'slider' ),
                    'view_item'     => __( 'View Slide', 'slider' ),
                    'search_items'  => __( 'Search Slide', 'slider' ),
                    'not_found'     => __( 'No slide item found', 'slider' ),
                    'not_found_in_trash' => __( 'No slide item found in Trash', 'slider' ),
                    'parent'        => __( 'Parent Slider', 'slider' ),
                ),
                
                'description'       => __( 'Create a Slide.', 'slider' ),
                'public'            => true,
                'show_ui'           => true,
                'show_in_menu'          => true,
                'publicly_queryable'    => true,
                'exclude_from_search'   => true,
                'menu_position'         => 6,
                'hierarchical'      => true,
                'query_var'         => true,
				'menu_icon' => 'dashicons-slides',
                'supports'  => array (
                    'title', //Text input field to create a post title.
                    'editor',
                    'thumbnail',
                    
                )
            )
        );
register_taxonomy('slider_category', 'slider', array('hierarchical' => true, 'label' => 'Slider Categories', 'singular_name' => 'Category', "rewrite" => true, "query_var" => true));
        
        

    }
}

add_action( 'init', 'slider_post_types' ); // register post type

register_taxonomy_for_object_type('category', 'custom-type');


?>