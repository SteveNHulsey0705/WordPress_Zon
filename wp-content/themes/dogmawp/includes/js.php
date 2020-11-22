<?php

if( !function_exists ('dogma_enqueue_scripts') ) :
	function dogma_enqueue_scripts() {
	global $map_array, $map2_array, $mapmarker, $userdata;
		
	$wr_options = get_option('wr_wp');
			if(!empty($wr_options['maploc'])){
			$protocol = is_ssl() ? 'https' : 'http';
			
			wp_enqueue_script('googlemap', "$protocol://maps.google.com/maps/api/js", array('jquery'), '1.0',true);
			}
			
		//wp_enqueue_script('hl-min', get_template_directory_uri() . '/includes/js/jquery.min.js', array('jquery'), '1.0',true);
		wp_enqueue_script('dg-plugin', get_template_directory_uri() . '/includes/js/plugins.js', array('jquery'), '1.0',true);
		wp_enqueue_script('dg-core', get_template_directory_uri() . '/includes/js/core.js', array('jquery'), '1.0',true);
		wp_enqueue_script('dg-scripts2', get_template_directory_uri() . '/includes/js/js_composer_front.min.js', array('jquery'), '1.0',true);
		wp_enqueue_script('dg-scripts', get_template_directory_uri() . '/includes/js/scripts.js', array('jquery'), '1.0',true);
		if ($wr_options['enableajax']=="no") {
		wp_enqueue_script('dg-ajax', get_template_directory_uri() . '/includes/js/disableajx.js', array('jquery'), '1.0',true);
		}
		else{
		
		wp_enqueue_script('dg-ajax', get_template_directory_uri() . '/includes/js/enableajax.js', array('jquery'), '1.0',true);
		
		}
		
		if(!empty($wr_options['maploc'])){
		if(isset($wr_options['maploc'])){ $map_array = array( 'some_string1' => ( $wr_options['maploc'] ), 'a_value' => '30' ); }
		if(isset($wr_options['maploc2'])){ $map2_array = array( 'some_string2' => ( $wr_options['maploc2'] ), 'a_value' => '30' ); }
		if(isset($wr_options['mapmarker'])){ $mapmarker = array( 'some_string3' => ( $wr_options['mapmarker'] ), 'a_value' => '30' ); }
		if(isset($wr_options['userdata'])){ $userdata = array( 'some_string4' => ( $wr_options['userdata'] ), 'a_value' => '30' ); }
		
		wp_enqueue_script('dg-map', get_template_directory_uri() . '/includes/js/map.js', array('jquery'), '1.0',true);
		
		wp_localize_script( 'dg-map', 'object_name1', $map_array );
		wp_localize_script( 'dg-map', 'object_name2', $map2_array );
		wp_localize_script( 'dg-map', 'object_name3', $mapmarker );
		wp_localize_script( 'dg-map', 'object_name4', $userdata );
		
		}
		
		
		
}
	add_action('wp_enqueue_scripts', 'dogma_enqueue_scripts');
endif;