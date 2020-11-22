<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/docs/define-meta-boxes
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'rnr_';

global $meta_boxes;

$meta_boxes = array();

global $smof_data;


/* ----------------------------------------------------- */
// Page Sections Metaboxes
/* ----------------------------------------------------- */


/* ----------------------------------------------------- */
// Revolution Slider
/* ----------------------------------------------------- */

$revolutionslider = array();
$revolutionslider[0] = 'No Slider';

if(class_exists('RevSlider')){
    $slider = new RevSlider();
	$arrSliders = $slider->getArrSliders();
	foreach($arrSliders as $revSlider) { 
		$revolutionslider[$revSlider->getAlias()] = $revSlider->getTitle();
	}
}

/* Page Section Background Settings */

$grid_array = array('2 Columns','3 Columns','4 Columns');

$pagebg_type_array = array(
	'image' => 'Image',
	'gradient' => 'Gradient',
	'color' => 'Color'
);





/* ----------------------------------------------------- */
/* page Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'home_page_type',
	'title' => 'Home Page Template Function',
	'pages' => array( 'page' ),
	'context' => 'normal',	

	'fields' => array(
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Select', 'dogmawp' ),
			'id'   => $prefix . 'wr_home_pagetype',
			'desc'  => esc_attr__( '', 'dogmawp' ),
			'type'     => 'image_select',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => __( get_template_directory_uri().'/includes/metaboxes/img/wr-page-default.png', 'dogmawp' ),
				'st2' => __( get_template_directory_uri().'/includes/metaboxes/img/home-sin-slide.png', 'dogmawp' ),
				'st3' => __( get_template_directory_uri().'/includes/metaboxes/img/home-sin-m4.png', 'dogmawp' ),
				'st4' => __( get_template_directory_uri().'/includes/metaboxes/img/home-sin-m3.png', 'dogmawp' ),
				'st5' => __( get_template_directory_uri().'/includes/metaboxes/img/home-sin-vid.png', 'dogmawp' ),
				'st6' => __( get_template_directory_uri().'/includes/metaboxes/img/home-sin-img.png', 'dogmawp' ),
				'st7' => __( get_template_directory_uri().'/includes/metaboxes/img/home-sin-slider.png', 'dogmawp' ),
				'st8' => __( get_template_directory_uri().'/includes/metaboxes/img/home-sin-vmenu.png', 'dogmawp' ),
				
				
				
			),
			'desc'  => esc_attr__( '', 'dogmawp' ),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'dogmawp' ),
		),
		
		array(
			'name'		=> 'Content',
			'id'		=> $prefix . 'home_content',
			'clone'		=> false,
			'type'		=> 'textarea',
			'std'		=> '',
			'desc'		=> '',
		),
		
		array(
			'name'		=> 'Button Text',
			'id'		=> $prefix . 'home_bt_txt',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> '',
		),
		
		array(
			'name'		=> 'Button URL',
			'id'		=> $prefix . 'home_bt_url',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> '',
		),
		
		array(
			'name'     => esc_attr__( 'Link Option', 'dogmawp' ),
			'id'   => $prefix . 'intro-link-option1',
			'type'     => 'radio',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'ajax' => esc_attr__( 'Url From Own site', 'dogmawp' ),
				'noajax' => esc_attr__( 'Url From Other site', 'dogmawp' ),
			),
			// Select multiple values, optional. Default is false.
			'std'         => 'ajax',

		),	
		
		array(
			'name'		=> 'Button Text',
			'id'		=> $prefix . 'home_bt_txt2',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> '',
		),
		
		array(
			'name'		=> 'Button URL',
			'id'		=> $prefix . 'home_bt_url2',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> '',
		),
		
		array(
			'name'     => esc_attr__( 'Link Option', 'dogmawp' ),
			'id'   => $prefix . 'intro-link-option2',
			'type'     => 'radio',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'ajax' => esc_attr__( 'Url From Own site', 'dogmawp' ),
				'noajax' => esc_attr__( 'Url From Other site', 'dogmawp' ),
			),
			// Select multiple values, optional. Default is false.
			'std'         => 'ajax',

		),
		
	
		
	)
);


/* ----------------------------------------------------- */
/* page Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'home_page_layout_type',
	'title' => 'Home Page Template  Slide Show Option',
	'pages' => array( 'page' ),
	'context' => 'normal',	

	'fields' => array(
		
		array(
			'name'		=> 'Upload Image',
			'id'		=> $prefix . 'wr_slide_show',
			'clone'		=> false,
			'type'		=> 'image_advanced',
			'desc'		=> 'Select Home Page Template Function <b>Slide Show</b><br> Select Minimum two Images.',
		),	
		
	
		
	)
);


/* ----------------------------------------------------- */
/* page Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'home_page_layout_type2',
	'title' => 'Home Page Template Multi Slide Show 4 Option',
	'pages' => array( 'page' ),
	'context' => 'normal',
	

	'fields' => array(
		
		array(
			'name'		=> 'Upload Image For 1st Column',
			'id'		=> $prefix . 'wr_mu_slide_show1',
			'clone'		=> false,
			'type'		=> 'image_advanced',
			'desc'		=> '',
		),	
		array(
			'name'		=> 'Upload Image For 2nd Column',
			'id'		=> $prefix . 'wr_mu_slide_show2',
			'clone'		=> false,
			'type'		=> 'image_advanced',
			'desc'		=> '',
		),	
		
		array(
			'name'		=> 'Upload Image For 3rd Column',
			'id'		=> $prefix . 'wr_mu_slide_show3',
			'clone'		=> false,
			'type'		=> 'image_advanced',
			'desc'		=> '',
		),	
		array(
			'name'		=> 'Upload Image For 4th Column',
			'id'		=> $prefix . 'wr_mu_slide_show4',
			'clone'		=> false,
			'type'		=> 'image_advanced',
			'desc'		=> 'Select Home Page Template Function <b>Multi Slide Show 4</b><br> Select Minimum two Images in par column.',
		),	
		
	
		
	)
);


/* ----------------------------------------------------- */
/* page Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'home_page_layout_type3',
	'title' => 'Home Page Template Multi Slide Show 3 Option',
	'pages' => array( 'page' ),
	'context' => 'normal',
	

	'fields' => array(
		
		array(
			'name'		=> 'Upload Image For 1st Column',
			'id'		=> $prefix . 'wr_mu_slide_show3-1',
			'clone'		=> false,
			'type'		=> 'image_advanced',
			'desc'		=> '',
		),	
		array(
			'name'		=> 'Upload Image For 2nd Column',
			'id'		=> $prefix . 'wr_mu_slide_show3-2',
			'clone'		=> false,
			'type'		=> 'image_advanced',
			'desc'		=> '',
		),	
		
		array(
			'name'		=> 'Upload Image For 3rd Column',
			'id'		=> $prefix . 'wr_mu_slide_show3-3',
			'clone'		=> false,
			'type'		=> 'image_advanced',
			'desc'		=> 'Select Home Page Template Function <b>Multi Slide Show 3</b><br> Select Minimum two Images in par column.',
		),	
		
		
	
		
	)
);


/* ----------------------------------------------------- */
/* page Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'home_page_layout_type4',
	'title' => 'Home Page Template Video Option',
	'pages' => array( 'page' ),
	'context' => 'normal',
	

	'fields' => array(
		
		array(
			'name'		=> 'Youtube Video ID',
			'id'		=> $prefix . 'yid',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Select Home Page Template Function <b>Video</b>. Insert Youtube Video ID Ex: eZ70TaAUhQo<br>Video not suported on mobile. If you want to use Video option, then must add featured Image. That will be your site body background on mobile device. ',
		),

		array(
			'name'     => esc_attr__( 'Video Sound', 'dogmawp' ),
			'id'   => $prefix . 'intro-section-video-sound',
			'type'     => 'radio',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'0' => esc_attr__( 'Enable', 'dogmawp' ),
				'1' => esc_attr__( 'Disable', 'dogmawp' ),
			),
			// Select multiple values, optional. Default is false.
			'std'         => '0',

		),	
		
		
	
		
	)
);

/* ----------------------------------------------------- */
/* page Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'home_page_layout_type7',
	'title' => 'Home Page Template Slider & Visiable Menu Option',
	'pages' => array( 'page' ),
	'context' => 'normal',
	

	'fields' => array(
		
		
		array(
			'name'     => __( 'Post Formats', 'prtfrm' ),
			'id'   => $prefix . 'portfolio-post-formats',
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				
				'slider' => __( 'Dogma Slider', 'prtfrm' ),
				'portfolio' => __( 'Portfolio', 'prtfrm' ),
				'post' => __( 'Blog', 'prtfrm' ),
				
				
			),
			// Select multiple values, optional. Default is false.
			'std'         => 'image',

		),
		
		array(
			'name'		=> 'Slider/Slideshow Category',
			'id'		=> $prefix . 'intro-slider-post-cat',
			'desc'		=> 'Select "Slider & Visiable Menu Option" At Home Page Template Function &amp; Insert Dogma Slide Post Category Name Ex: Home',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),

		array(
				'name'       => esc_attr__( 'Number Of Post Show', 'blps' ),
				'id'         => $prefix . 'port-post-show',
				'desc'		=> '',
				'type'       => 'slider',
				// Text labels displayed before and after value
				'prefix'     => __( '', 'blps' ),
				'suffix'     => __( ' Posts', 'blps' ),
				'js_options' => array(
					'min'  => 1,
					'max'  => 100,
					'step' => 1,
				),
			),	
		
		
	
		
	)
);




/* ----------------------------------------------------- */
/* page Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'page_type',
	'title' => 'Default Page Function',
	'pages' => array( 'page' ),
	'context' => 'normal',	

	'fields' => array(
		
		// SELECT BOX
		array(
			'name'     => __( 'Select', 'dogmawp' ),
			'id'   => $prefix . 'wr-pagetype',
			'desc'  => __( '', 'dogmawp' ),
			'type'     => 'image_select',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => __( get_template_directory_uri().'/includes/metaboxes/img/wr-page-default.png', 'dogmawp' ),
				'st4' => __( get_template_directory_uri().'/includes/metaboxes/img/wrfixedpage.png', 'dogmawp' ),
				
				'st3' => __( get_template_directory_uri().'/includes/metaboxes/img/wr-page-full.png', 'dogmawp' ),
				
				
				
			),
			'desc'		=> 'Select <b>WR FIXED HEIGHT</b> option only for <b> WR Contact Form With Google Map</b> & <b>WR ABout</b> Element ',
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => '',
			'placeholder' => esc_attr__( 'Select an Option', 'dogmawp' ),
		),
		
		

		  array(
		   'name'     => esc_attr__( 'Page Comments', 'mountainwp' ),
		   'id'   => $prefix . 'page-comment',
		   'type'     => 'radio',
		   // Array of 'value' => 'Label' pairs for select box
		   'options'  => array(
			'yes' => esc_attr__( 'Enable', 'mountainwp' ),
			'no' => esc_attr__( 'Disable', 'mountainwp' ),
		   ),
		   // Select multiple values, optional. Default is false.
		   'std'         => 'yes',

		  ),
		
		
		
		
		
		
	)
);


/* ----------------------------------------------------- */
/* page Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'portfolio_page_types',
	'title' => 'Portfolio Page Template Function',
	'pages' => array( 'page' ),
	'context' => 'normal',	

	'fields' => array(
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Select', 'dogmawp' ),
			'id'   => $prefix . 'wr_portfolio_pagetype',
			'desc'  => esc_attr__( '', 'dogmawp' ),
			'type'     => 'image_select',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => __( get_template_directory_uri().'/includes/metaboxes/img/wr-page-default.png', 'dogmawp' ),
				'st2' => __( get_template_directory_uri().'/includes/metaboxes/img/wr-port-1.png', 'dogmawp' ),
				'st3' => __( get_template_directory_uri().'/includes/metaboxes/img/wr-port-2.png', 'dogmawp' ),
				'st4' => __( get_template_directory_uri().'/includes/metaboxes/img/wr-port-3.png', 'dogmawp' ),
				'st5' => __( get_template_directory_uri().'/includes/metaboxes/img/wr-port-4.png', 'dogmawp' ),
				'st6' => __( get_template_directory_uri().'/includes/metaboxes/img/wr-port-5.png', 'dogmawp' ),
				'st7' => __( get_template_directory_uri().'/includes/metaboxes/img/wr-port-6.png', 'dogmawp' ),
				
				
				
				
			),
			'desc'  => __( '', 'dogmawp' ),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'dogmawp' ),
		),
		
		array(
		   'name'     => esc_attr__( 'Portfolio Filter', 'mountainwp' ),
		   'id'   => $prefix . 'port-filter',
		   'desc' => 'Not working on Portfolio Style2, Style3 & Style 6',
		   'type'     => 'radio',
		   // Array of 'value' => 'Label' pairs for select box
		   'options'  => array(
			'yes' => esc_attr__( 'Enable', 'mountainwp' ),
			'no' => esc_attr__( 'Disable', 'mountainwp' ),
		   ),
		   // Select multiple values, optional. Default is false.
		   'std'         => 'yes',

		  ),
		  
		  array(
				'name'       => esc_attr__( 'Number Of Post Show', 'blps' ),
				'id'         => $prefix . 'portfolio-post-show',
				'desc'		=> 'Working Only If Filter Option Disable. <br> <br> Not working on Portfolio Style2, Style3 & Style 6',
				'type'       => 'slider',
				// Text labels displayed before and after value
				'prefix'     => __( '', 'blps' ),
				'suffix'     => __( ' Posts', 'blps' ),
				'js_options' => array(
					'min'  => 1,
					'max'  => 100,
					'step' => 1,
				),
			),	

			array(
			'name'		=> 'Exclude Category',
			'id'		=> $prefix . 'portfolio-post-cat',
			'desc'		=> 'Enter category name ex: web design, web development (Optional).<br>Working Only If Filter Option  Disable. <br> Not working on Portfolio Style2, Style3 & Style 6',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		
	
		
	)
);



/* ----------------------------------------------------- */
/* page Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'blog_page_type',
	'title' => 'Blog Page Template Function',
	'pages' => array( 'page' ),
	'context' => 'normal',	

	'fields' => array(
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Blog Layout', 'dogmawp' ),
			'id'   => $prefix . 'wrblog-pagetype',
			'desc'  => __( 'Working only Blog Page Template', 'dogmawp' ),
			'type'     => 'image_select',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st2' => esc_attr__( get_template_directory_uri().'/includes/metaboxes/img/wr-blog.png', 'dogmawp' ),
				'st1' => esc_attr__( get_template_directory_uri().'/includes/metaboxes/img/wr-page-left.png', 'dogmawp' ),
				'st3' => esc_attr__( get_template_directory_uri().'/includes/metaboxes/img/wr-blo4.png', 'dogmawp' ),
				
				
			),
			'desc'  => esc_attr__( '', 'dogmawp' ),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st3',
			'placeholder' => __( 'Select an Option', 'dogmawp' ),
		),
		
		array(
				'name'       => esc_attr__( 'Number Of Post Show', 'blps' ),
				'id'         => $prefix . 'blog-post-show',
				'desc'		=> '',
				'type'       => 'slider',
				// Text labels displayed before and after value
				'prefix'     => __( '', 'blps' ),
				'suffix'     => __( ' Posts', 'blps' ),
				'js_options' => array(
					'min'  => 1,
					'max'  => 100,
					'step' => 1,
				),
			),	

			array(
			'name'		=> 'Exclude Category',
			'id'		=> $prefix . 'blog-post-cat',
			'desc'		=> 'Enter category name ex: web design, web development (Optional).',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),

			
	)
);

// Blog Post Metaboxes
/* ----------------------------------------------------- */


$meta_boxes[] = array(
	'id' => 'rnr-blogmeta-video',
	'title' => 'Post Format Video Option',
	'pages' => array( 'post'),
	'context' => 'normal',

	// List of meta fields
	'fields' => array(

		array(
			'name'		=> 'Vimeo/ Youtube Video Link:',
			'id'		=> $prefix . 'bl-video',
			'desc'		=> 'Set Vimeo / Youtube Video Embed Link',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),

		
	)
);

/* ----------------------------------------------------- */
/* page Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'blog_postgaleery_type',
	'title' => 'Post Format Gallery Option',
	'pages' => array( 'post' ),
	'context' => 'normal',	

	'fields' => array(
		
		array(
			'name'		=> 'Upload Image',
			'id'		=> $prefix . 'wr_slide_show_blog',
			'clone'		=> false,
			'type'		=> 'image_advanced',
			'desc'		=> 'Select Post Format <b>Gallery</b>.<br> Select Minimum two Images.',
		),	
		
	
		
	)
);


/* ----------------------------------------------------- */
/* portfolio Post Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'portfolio_type',
	'title' => 'Portfolio Foramt',
	'pages' => array( 'portfolio' ),
	'context' => 'normal',	

	'fields' => array(
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Select', 'dogmawp' ),
			'id'   => $prefix . 'wr_portdt_pagetype',
			'desc'  => esc_attr__( '', 'dogmawp' ),
			'type'     => 'image_select',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => __( get_template_directory_uri().'/includes/metaboxes/img/wr-page-default.png', 'dogmawp' ),
				'st2' => __( get_template_directory_uri().'/includes/metaboxes/img/wr-port-1.png', 'dogmawp' ),
				'st3' => __( get_template_directory_uri().'/includes/metaboxes/img/wr-port-2.png', 'dogmawp' ),
				'st4' => __( get_template_directory_uri().'/includes/metaboxes/img/wr-port-3.png', 'dogmawp' ),
				'st5' => __( get_template_directory_uri().'/includes/metaboxes/img/wr-port-4.png', 'dogmawp' ),
				'st6' => __( get_template_directory_uri().'/includes/metaboxes/img/wr-port-5.png', 'dogmawp' ),
				'st7' => __( get_template_directory_uri().'/includes/metaboxes/img/wr-port-6.png', 'dogmawp' ),
				'st8' => __( get_template_directory_uri().'/includes/metaboxes/img/wr-port-7.png', 'dogmawp' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'portdefault',
			'placeholder' => esc_attr__( 'Select an Option', 'dogmawp' ),
		),

		
		
		
		
		
	)
);


/* ----------------------------------------------------- */
/* galeery Post Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'portfolio_width',
	'title' => 'Portfolio Post Width',
	'pages' => array( 'portfolio' ),
	'context' => 'normal',	

	'fields' => array(
		
		array(
			'name'     => __( 'Post Box Width', 'dogmawp' ),
			'id'   => $prefix . 'post-box-width',
			'type'     => 'radio',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'default-galley' => esc_attr__( 'Default', 'dogmawp' ),
				'gallery-item-second' => esc_attr__( 'Large', 'dogmawp' ),
			),
			// Select multiple values, optional. Default is false.
			'std'         => '0',

		),	
		
		
	)
);




/* portfolio Post Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'pt_video_link',
	'title' => 'Add Project Video',
	'pages' => array( 'portfolio' ),
	'context' => 'normal',	

	'fields' => array(
		
		array(
			'name'		=> 'Vimeo/ Youtube Video Embed Link',
			'desc'  => esc_attr__( '', 'dogmawp' ),
			'id'		=> $prefix . 'pt_vimeo',
			'clone'		=> true,
			'type' => 'url',
			// Value can be 0 or 1
			
		),
		
			
		
		
	)
);

/* portfolio Post Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'pt_slider_link',
	'title' => 'Image Gallery Option',
	'pages' => array( 'portfolio' ),
	'context' => 'normal',	

	'fields' => array(
		
		array(
			'name'		=> 'Image Gallery',
			'id'		=> $prefix . 'portfolio-image',
			'clone'		=> false,
			'type'		=> 'image_advanced',
			'desc'		=> 'Upload Images ',
		),	
		
		
		
			
		
		
	)
);

/* portfolio Post Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'pt_client_name',
	'title' => 'Custom Deatils',
	'pages' => array( 'portfolio' ),
	'context' => 'normal',	

	'fields' => array(
	
		
		array(
			'name'     => __( 'Enable/ Disable Date Section', 'dogmawp' ),
			'id'   => $prefix . 'wr-infor-date',
			'type'     => 'radio',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Enable', 'dogmawp' ),
				'st2' => esc_attr__( 'Disable', 'dogmawp' ),
			),
			// Select multiple values, optional. Default is false.
			'std'         => 'st1',

		),	
		
		array(
			'name'     => __( 'Enable/ Disable Info Section', 'dogmawp' ),
			'id'   => $prefix . 'wr-infor-dis',
			'type'     => 'radio',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Enable', 'dogmawp' ),
				'st2' => esc_attr__( 'Disable', 'dogmawp' ),
			),
			// Select multiple values, optional. Default is false.
			'std'         => 'st1',

		),	
		
		array(
			'name'		=> 'Custom Details',
			'desc'  => esc_attr__( 'ex:&lt;li&gt;&lt;span&gt;Client :&lt;/span&gt;  House Big &lt;/li&gt;', 'dogmawp' ),
			'id'		=> $prefix . 'pt_client',
			'type' => 'text',
			'clone'		=> true,
			// Value can be 0 or 1
			
		),
		
		
		
	)
);


/* portfolio Post Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'pt_project_url',
	'title' => 'Project URL Option',
	'pages' => array( 'portfolio' ),
	'context' => 'normal',	

	'fields' => array(
		
		array(
			'name'		=> 'Button Text',
			'desc'  => esc_attr__( '', 'dogmawp' ),
			'id'		=> $prefix . 'pt_button_text',
			'type' => 'text',
			// Value can be 0 or 1
			'desc'  => __( '', 'midtownwp' ),
		),
		
		array(
			'name'		=> 'Project URL',
			'desc'  => esc_attr__( '', 'dogmawp' ),
			'id'		=> $prefix . 'pt_button_url',
			'type' => 'text',
			// Value can be 0 or 1
			
		),
		
			
		
		
	)
);

/* ----------------------------------------------------- */
/* page Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'portfolio_layout_type4',
	'title' => 'Portfolio Details Video Background Option',
	'pages' => array( 'portfolio' ),
	'context' => 'normal',
	

	'fields' => array(
		
		array(
			'name'		=> 'Youtube Video ID',
			'id'		=> $prefix . 'yidp',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Select Portfolio Details STyle Function <b>Video Background</b>. Insert Youtube Video ID Ex: eZ70TaAUhQo<br>Video not suported on mobile. If you want to use Video option, then must add featured Image. That will be your site body background on mobile device. ',
		),

		array(
			'name'     => esc_attr__( 'Video Sound', 'dogmawp' ),
			'id'   => $prefix . 'intro-section-video-soundp',
			'type'     => 'radio',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'0' => esc_attr__( 'Enable', 'dogmawp' ),
				'1' => esc_attr__( 'Disable', 'dogmawp' ),
			),
			// Select multiple values, optional. Default is false.
			'std'         => '0',

		),	
		
		
	
		
	)
);

/* ----------------------------------------------------- */
/* page Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'slider_page_type',
	'title' => 'Slider Options',
	'pages' => array( 'slider' ),
	'context' => 'normal',	

	'fields' => array(
		
		
		
		
		array(
			'name'		=> 'Button Text',
			'id'		=> $prefix . 'slider_bt_txt',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> '',
		),
		
		array(
			'name'		=> 'Button URL',
			'id'		=> $prefix . 'slider_bt_url',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> '',
		),
		
	
		
	)
);



/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function rocknrolla_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}

// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'rocknrolla_register_meta_boxes' );