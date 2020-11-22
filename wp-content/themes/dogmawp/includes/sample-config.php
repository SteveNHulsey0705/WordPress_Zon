<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "wr_wp";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'wr_wp/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();

    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_attr__( 'Dogma Options', 'dogmawp' ),
        'page_title'           => esc_attr__( 'Dogma Options', 'dogmawp' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the dogmawp. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'dogmawp'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'dogmawp'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    
    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( esc_attr__( '', 'dogmawp' ), $v );
    } else {
        $args['intro_text'] = esc_attr__( '', 'dogmawp' );
    }

    // Add content after the form.
    $args['footer_text'] = esc_attr__( '', 'dogmawp' );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => esc_attr__( 'Theme Information 1', 'dogmawp' ),
            'content' => esc_attr__( '<p>This is the tab content, HTML is allowed.</p>', 'dogmawp' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_attr__( 'Theme Information 2', 'dogmawp' ),
            'content' => esc_attr__( '<p>This is the tab content, HTML is allowed.</p>', 'dogmawp' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = esc_attr__( '<p>This is the sidebar content, HTML is allowed.</p>', 'dogmawp' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */

    // ACTUAL DECLARATION OF SECTIONS
                Redux::setSection( $opt_name, array(
                    'title'  => esc_attr__( 'General Settings', 'dogmawp' ),
                    'desc'   => esc_attr__( '', 'dogmawp' ),
                    'icon'   => 'el-icon-home-alt',
                    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                    'fields' => array(

                     
					 array(
							'id' => 'enableajax',
							'type' => 'button_set',
							'title' => esc_attr__('Enable Ajax Loading', 'dogmawp'),
							'subtitle' => esc_attr__('If you Want to use visual comoser by default element and Addons then you need to disable ajax loading', 'dogmawp'),
							'desc' => '',
							'options' => array(
									'yes'=> esc_attr__('Enable', 'dogmawp'),
									'no' => esc_attr__('Disable', 'dogmawp'),
									
							),
							'default'  => 'yes'
					),
					
					array(
							'id' => 'textlogo',
							'type' => 'button_set',
							'title' => esc_attr__('Select Logo Format', 'dogmawp'),
							'subtitle' => esc_attr__('', 'dogmawp'),
							'desc' => '',
							'options' => array(
									'st1'=> esc_attr__('Text Logo', 'dogmawp'),
									'st2' => esc_attr__('Image Logo', 'dogmawp'),
									
							),
							'default'  => 'st2'
					),
					 
					 array(
							'id' => 'logopic',
							'type' => 'media',
							'compiler' => 'true',
							'title' => esc_attr__('Upload Logo', 'dogmawp'),
							'subtitle' => esc_attr__('', 'dogmawp'),
							'required' => array('textlogo', '=' , 'st2')
					),
					
					array(
							'id' => 'logotext',
							'type' => 'text',
							'title' => esc_attr__('Logo Text ', 'dogmawp'),
							'subtitle' => esc_attr__('', 'dogmawp'),
							'required' => array('textlogo', '=' , 'st1')
					
					),
					
					$fields = array(
					'id'       => 'opt_logo_dimensions',
					'type'     => 'dimensions',
					'units'    => array('em','px','%'),
					'output' => array('.logo-holder img'),
					'title'    => esc_attr__('Logo Size', 'dogmawp'),
					'subtitle' => esc_attr__('You must write Logo width & height', 'dogmawp'),
					'desc'     => esc_attr__('', 'dogmawp'),
					'default'  => array(
						'Width'   => '', 
						'Height'  => ''
					),
				),
					
					
					
					array(
							'id' => 'favicon',
							'type' => 'media',
							'title' => esc_attr__('Favicon Upload', 'dogmawp'),
							'subtitle' => esc_attr__('Upload a 16px x 16px .png or .gif image that will be your favicon.', 'dogmawp'),
							'compiler' => 'true'
					),
					
				array(
							'id' => 'showshare',
							'type' => 'button_set',
							'title' => esc_attr__('Enable Share Option', 'dogmawp'),
							'subtitle' => esc_attr__('Enable or disable Share Option.', 'dogmawp'),
							'desc' => '',
							'options' => array(
									'yes'=> esc_attr__('Yes', 'dogmawp'),
									'no' => esc_attr__('No', 'dogmawp'),
									
							),
							'default'  => 'no'
					),	
				
				  )
               ) );

				
				Redux::setSection( $opt_name, array(
                    'icon'   => 'el-icon-bullhorn',
                    'title'  => esc_attr__( 'Blog Options', 'dogmawp' ),
                    'fields' => array(
					
					
					

					
					array(
							'id' => 'wr-blog-opt',
							'type' => 'info',
		                    'notice' => true,
		                    'style' => 'info',
							'title' => esc_attr__('Blog Options', 'dogmawp'),
							'desc' => esc_attr__(' ', 'dogmawp')
							
					  ),

					array(
							'id' => 'blogtitle',
							'type' => 'text',
							'title' => esc_attr__('Index Title ', 'dogmawp'),
							'subtitle' => esc_attr__('', 'dogmawp'),
							
							
					),
					
					array(
							'id' => 'bloglink',
							'type' => 'text',
							'title' => esc_attr__('Blog Page URL ', 'dogmawp'),
							'subtitle' => esc_attr__('', 'dogmawp'),
							
							
							
					),
					
					
					array(
							'id' => 'blog-sidebar',
							'type' => 'button_set',
							'title' => esc_attr__('Standard Index Page Layout', 'dogmawp'),
							'subtitle' => esc_attr__('Select Index Page Layout.', 'dogmawp'),
							'desc' => '',
							'options' => array(
									'st1'=> esc_attr__('Three Column', 'dogmawp'),
									'st2' => esc_attr__('Four Column', 'dogmawp'),
									'st3' => esc_attr__('Left Sidebar', 'dogmawp'),
									
							),
							'default'  => 'st3'
					),
					
					
                    )
                ) );
				
				Redux::setSection( $opt_name, array(
                    'icon'   => 'el-icon-briefcase',
                    'title'  => esc_attr__( 'Portfolio Options', 'dogmawp' ),
                    'fields' => array(
					
					
					array(
							'id' => 'portfoliolink',
							'type' => 'text',
							'title' => esc_attr__('Portfoilio Page URL ', 'dogmawp'),
							'subtitle' => esc_attr__('', 'dogmawp'),
							
							
					),

					
					
					
					
                    )
                ) );
				
		Redux::setSection( $opt_name, array(
                    'icon'   => 'el-icon-map-marker',
                    'title'  => esc_attr__( 'Google Map Options', 'dogmawp' ),
                    'fields' => array(
					
					
					

					
					array(
							'id' => 'wr-map-opt',
							'type' => 'info',
		                    'notice' => true,
		                    'style' => 'info',
							'title' => esc_attr__('Map Options', 'dogmawp'),
							'desc' => esc_attr__(' ', 'dogmawp')
							
					  ),

					array(
							'id' => 'maploc',
							'type' => 'text',
							'title' => esc_attr__('Map Location ', 'dogmawp'),
							'subtitle' => esc_attr__('', 'dogmawp'),
							'desc' => esc_attr__('e.x: 40.7060895 ', 'dogmawp')
							
							
					),
					
					array(
							'id' => 'maploc2',
							'type' => 'text',
							'title' => esc_attr__('Map Location ', 'dogmawp'),
							'subtitle' => esc_attr__('', 'dogmawp'),
							'desc' => esc_attr__('e.x: -73.999053 ', 'dogmawp')
							
							
					),
					
					array(
							'id' => 'userdata',
							'type' => 'text',
							'title' => esc_attr__('User Data ', 'dogmawp'),
							'subtitle' => esc_attr__('', 'dogmawp'),
							
							
					),
					
					array(
							'id' => 'mapmarker',
							'type' => 'media',
							'compiler' => 'true',
							'title' => esc_attr__('Map Marker', 'dogmawp'),
							'subtitle' => esc_attr__('', 'dogmawp')
					),
					
					
					
					
					
					
					
                    )
                ) );
				
				
		Redux::setSection( $opt_name, array(
                    'icon'   => 'el-icon-leaf',
                    'title'  => esc_attr__( 'Social Options', 'dogmawp' ),
                    'fields' => array(
					
					
					array(
							'id' => 'wr-hd-social-menu',
							'type' => 'info',
		                    'notice' => true,
		                    'style' => 'info',
							'title' => esc_attr__('Select Footer Options', 'dogmawp'),
							'desc' => esc_attr__('This option for footer social area. ', 'dogmawp')
							
					  ),
					
					array(
							'id' => 'social-menu',
							'type' => 'button_set',
							'title' => esc_attr__('Select', 'dogmawp'),
							'subtitle' => esc_attr__('Enable Social Option or Footer Menu.', 'dogmawp'),
							'desc' => '',
							'options' => array(
									'st1'=> esc_attr__('Social Area', 'dogmawp'),
									'st2' => esc_attr__('Footer Menu Area', 'dogmawp'),
									
									
							),
							'default'  => 'st1'
					),
					array(
							'id' => 'wr-hd-social-message',
							'type' => 'info',
		                    'notice' => true,
		                    'style' => 'info',
							'title' => esc_attr__('Footer Social Options', 'dogmawp'),
							'desc' => esc_attr__('This option for footer social area. ', 'dogmawp')
							
					  ),
					  
					  
					
					array(
							'id' => 'behance',
							'type' => 'text',
							'title' => esc_attr__('Behance URL ', 'dogmawp'),
							'subtitle' => esc_attr__('Write Social URL', 'dogmawp'),
							
							
					),
					
					array(
							'id' => 'pinterest',
							'type' => 'text',
							'title' => esc_attr__('Pinterest URL ', 'dogmawp'),
							'subtitle' => esc_attr__('Write Social URL', 'dogmawp'),
							
							
					),
					
					array(
							'id' => 'twitter',
							'type' => 'text',
							'title' => esc_attr__('Twitter URL ', 'dogmawp'),
							'subtitle' => esc_attr__('Write Social URL', 'dogmawp'),
							
							
					),
					
					array(
							'id' => 'gplus',
							'type' => 'text',
							'title' => esc_attr__('Google URL ', 'dogmawp'),
							'subtitle' => esc_attr__('Write Social URL', 'dogmawp'),
							
							
					),
					
					array(
							'id' => 'facebook',
							'type' => 'text',
							'title' => esc_attr__('Facebook URL ', 'dogmawp'),
							'subtitle' => esc_attr__('Write Social URL', 'dogmawp'),
							
							
					),
					
					array(
							'id' => 'linkedin',
							'type' => 'text',
							'title' => esc_attr__('Linkedin URL ', 'dogmawp'),
							'subtitle' => esc_attr__('Write Social URL', 'dogmawp'),
							
							
					),
					
					array(
							'id' => 'youtube',
							'type' => 'text',
							'title' => esc_attr__('Youtube URL ', 'dogmawp'),
							'subtitle' => esc_attr__('Write Social URL', 'dogmawp'),
							
							
					),
					
					array(
							'id' => 'vimeo',
							'type' => 'text',
							'title' => esc_attr__('Vimeo URL ', 'dogmawp'),
							'subtitle' => esc_attr__('Write Social URL', 'dogmawp'),
							
							
					),
					
					
					
					array(
							'id' => 'slack',
							'type' => 'text',
							'title' => esc_attr__('Slack ', 'dogmawp'),
							'subtitle' => esc_attr__('Write Social URL', 'dogmawp'),
							
							
					),
					
					
					array(
							'id' => 'instagram',
							'type' => 'text',
							'title' => esc_attr__('Instagram URL ', 'dogmawp'),
							'subtitle' => esc_attr__('Write Social URL', 'dogmawp'),
							
							
					),
					
					array(
							'id' => 'tumblr',
							'type' => 'text',
							'title' => esc_attr__('Tumblr URL ', 'dogmawp'),
							'subtitle' => esc_attr__('Write Social URL', 'dogmawp'),
							
							
					),
					
					
					
                    )
                ) );
				
				
				Redux::setSection( $opt_name, array(
                    'icon'   => 'el-icon-text-width',
                    'title'  => esc_attr__( 'Typography', 'dogmawp' ),
                    'fields' => array(     

						array(
			                'id' => 'notice_critical11',
			                'type' => 'info',
			                'notice' => true,
			                'style' => 'success',
			                'title' => esc_attr__('Entry Headings', 'dogmawp'),
			                'desc' => esc_attr__('Entry Headings in posts/pages', 'dogmawp')
			            ),

						array(
                            'id'          => 'logotextwr1',
                            'type'        => 'typography', 
                            'title'       => __('Text Logo', 'dogmawp'),
                            'google'      => true, 
                            'font-backup' => false,
                            'output'      => array('.logotextwr'),
                            'units'       =>'px',
                            'subtitle'    => esc_attr__('Specify the Logo Text font properties.', 'dogmawp'),
                            'default'     => array(
                            'color'       => false,
                            'font-style'  => false,
                            'font-family' => false,
                            'google'      => true,
                            'font-size'   => false,
                            'line-height' => false,
                            ),
						),
                        array(
                            'id'          => 'typography-h1',
                            'type'        => 'typography', 
                            'title'       => __('H1', 'dogmawp'),
                            'google'      => true, 
                            'font-backup' => false,
                            'output'      => array('h1'),
                            'units'       =>'px',
                            'subtitle'    => esc_attr__('Specify the Heading font properties.', 'dogmawp'),
                            'default'     => array(
                            'color'       => false,
                            'font-style'  => false,
                            'font-family' => false,
                            'google'      => true,
                            'font-size'   => false,
                            'line-height' => false,
                            ),
						),	
                        array(
                            'id'          => 'typography-h2',
                            'type'        => 'typography', 
                            'title'       => esc_attr__('H2', 'dogmawp'),
                            'google'      => true, 
                            'font-backup' => false,
                            'output'      => array('h2, .sinnle-post h2'),
                            'units'       =>'px',
                            'subtitle'    => esc_attr__('Specify the Heading font properties.', 'dogmawp'),
                            'default'     => array(
                            'color'       => false,
                            'font-style'  => false,
                            'font-family' => false,
                            'google'      => true,
                            'font-size'   => false,
                            'line-height' => false,
                            ),      
                        ),
                        array(
                            'id'          => 'typography-h3',
                            'type'        => 'typography', 
                            'title'       => esc_attr__('H3', 'dogmawp'),
                            'google'      => true, 
                            'font-backup' => false,
                            'output'      => array('h3, .blog-text h3, .comment-form-holder h3, .comments-holder h3, .project-details h3, .blog-text h3 a, .comment-form-holder h3 a, .comments-holder h3 a, .project-details h3 a, .enter-wrap h3, .fixed-info-container h3, .fw-info-container h3'),
                            'units'       =>'px',
                            'subtitle'    => __('Specify the Heading font properties.', 'dogmawp'),
                            'default'     => array(
                            'color'       => false,
                            'font-style'  => false,
                            'font-family' => false,
                            'google'      => true,
                            'font-size'   => false,
                            'line-height' => false,
                            ),
						),	
                        array(
                            'id'          => 'typography-h4',
                            'type'        => 'typography', 
                            'title'       => esc_attr__('H4', 'dogmawp'),
                            'google'      => true, 
                            'font-backup' => false,
                            'output'      => array('h4, .fw-info-container h4, .fixed-info-container h4, .services-box-info h4'),
                            'units'       =>'px',
                            'subtitle'    => esc_attr__('Specify the Heading font properties.', 'dogmawp'),
                            'default'     => array(
                            'color'       => false,
                            'font-style'  => false,
                            'font-family' => false,
                            'google'      => true,
                            'font-size'   => false,
                            'line-height' => false,
                            ),	
						),	
                        array(
                            'id'          => 'typography-h5',
                            'type'        => 'typography', 
                            'title'       => esc_attr__('H5', 'dogmawp'),
                            'google'      => true, 
                            'font-backup' => false,
                            'output'      => array('h5'),
                            'units'       =>'px',
                            'subtitle'    => esc_attr__('Specify the Heading font properties.', 'dogmawp'),
                            'default'     => array(
                            'color'       => false,
                            'font-style'  => false,
                            'font-family' => false,
                            'google'      => true,
                            'font-size'   => false,
                            'line-height' => false,
                            ),
						),	
                        array(
                            'id'          => 'typography-h6',
                            'type'        => 'typography', 
                            'title'       => esc_attr__('H6', 'dogmawp'),
                            'google'      => true, 
                            'font-backup' => false,
                            'output'      => array('h6'),
                            'units'       =>'px',
                            'subtitle'    => esc_attr__('Specify the Heading font properties.', 'dogmawp'),
                            'default'     => array(
                            'color'       => false,
                            'font-style'  => false,
                            'font-family' => false,
                            'google'      => true,
                            'font-size'   => false,
                            'line-height' => false,
                            ),
						),

						array(
                            'id'          => 'typography-p',
                            'type'        => 'typography', 
                            'title'       => esc_attr__('p', 'dogmawp'),
                            'google'      => true, 
                            'font-backup' => false,
                            'output'      => array('p'),
                            'units'       =>'px',
                            'subtitle'    => esc_attr__('Specify the content font properties.', 'dogmawp'),
                            'default'     => array(
                            'color'       => false,
                            'font-style'  => false,
                            'font-family' => false,
                            'google'      => true,
                            'font-size'   => false,
                            'line-height' => false,
                            ),
						),
						
						array(
                            'id'          => 'typography-a',
                            'type'        => 'typography', 
                            'title'       => esc_attr__('a', 'dogmawp'),
                            'google'      => true, 
                            'font-backup' => false,
                            'output'      => array('a, .footer-social li a span, .blog-title a, .btn'),
                            'units'       =>'px',
                            'subtitle'    => esc_attr__('Specify the permalink font properties.', 'dogmawp'),
                            'default'     => array(
                            'color'       => false,
                            'font-style'  => false,
                            'font-family' => false,
                            'google'      => true,
                            'font-size'   => false,
                            'line-height' => false,
                            ),
						),
						
						array(
                            'id'          => 'typography-span',
                            'type'        => 'typography', 
                            'title'       => esc_attr__('span', 'dogmawp'),
                            'google'      => true, 
                            'font-backup' => false,
                            'output'      => array('span, .show-share span'),
                            'units'       =>'px',
                            'subtitle'    => esc_attr__('Specify the span font properties.', 'dogmawp'),
                            'default'     => array(
                            'color'       => false,
                            'font-style'  => false,
                            'font-family' => false,
                            'google'      => true,
                            'font-size'   => false,
                            'line-height' => false,
                            ),
						),
						
						array(
                            'id'          => 'typography-input',
                            'type'        => 'typography', 
                            'title'       => esc_attr__('input', 'dogmawp'),
                            'google'      => true, 
                            'font-backup' => false,
                            'output'      => array('input, #contact-form input[type="text"], #contact-form textarea, #comment-form input[type="text"], #comment-form textarea, #contact-form input[type="email"]'),
                            'units'       =>'px',
                            'subtitle'    => esc_attr__('Specify the input font properties.', 'dogmawp'),
                            'default'     => array(
                            'color'       => false,
                            'font-style'  => false,
                            'font-family' => false,
                            'google'      => true,
                            'font-size'   => false,
                            'line-height' => false,
                            ),
						),
						
						array(
                            'id'          => 'typography-li',
                            'type'        => 'typography', 
                            'title'       => esc_attr__('li', 'dogmawp'),
                            'google'      => true, 
                            'font-backup' => false,
                            'output'      => array('ul li, .project-details li, .services-box-info ul li'),
                            'units'       =>'px',
                            'subtitle'    => esc_attr__('Specify the list Style font properties.', 'dogmawp'),
                            'default'     => array(
                            'color'       => false,
                            'font-style'  => false,
                            'font-family' => false,
                            'google'      => true,
                            'font-size'   => false,
                            'line-height' => false,
                            ),
						),
						

						array(
			                'id' => 'notice_menucritical11',
			                'type' => 'info',
			                'notice' => true,
			                'style' => 'success',
			                'title' => esc_attr__('Menu Font Options', 'dogmawp'),
			                'desc' => esc_attr__('Menu Item font properties', 'dogmawp')
			            ),					
                        array(
                            'id'          => 'typography-menu-main',
                            'type'        => 'typography', 
                            'title'       => esc_attr__('Menu Item', 'dogmawp'),
                            'google'      => true, 
                            'font-backup' => false,
                            'output'      => array('.nav-inner nav li a, .nav-inner nav li ul li a'),
                            'units'       =>'px',
                            'subtitle'    => esc_attr__('Specify the menu item font properties.', 'dogmawp'),
                            'default'     => array(
                            'color'       => false,
                            'font-style'  => false,
                            'font-family' => false,
                            'google'      => true,
                            'font-size'   => false,
                            'line-height' => false,
                            ),
						),

						array(
			                'id' => 'notice_menucritical1134r',
			                'type' => 'info',
			                'notice' => true,
			                'style' => 'success',
			                'title' => esc_attr__('Menu Font Hover & Active Options', 'dogmawp'),
			                'desc' => esc_attr__('Menu Item font properties', 'dogmawp')
			            ),
						
						array(
                            'id'          => 'typography-menu-mainac',
                            'type'        => 'typography', 
                            'title'       => esc_attr__('Menu Item Active & Hover', 'dogmawp'),
                            'google'      => true, 
                            'font-backup' => false,
                            'output'      => array('.nav-inner nav li ul li a:hover, .nav-inner nav li a:hover'),
                            'units'       =>'px',
                            'subtitle'    => esc_attr__('Specify the menu item font properties.', 'dogmawp'),
                            'default'     => array(
                            'color'       => false,
                            'font-style'  => false,
                            'font-family' => false,
                            'google'      => true,
                            'font-size'   => false,
                            'line-height' => false,
                            ),
						),
						
						array(
			                'id' => 'notice_menucritical1134rdee',
			                'type' => 'info',
			                'notice' => true,
			                'style' => 'success',
			                'title' => esc_attr__('Extra Options', 'dogmawp'),
			                'desc' => esc_attr__('', 'dogmawp')
			            ),
						
						array(
                            'id'          => 'typography-footer-text',
                            'type'        => 'typography', 
                            'title'       => esc_attr__('Footer Text', 'dogmawp'),
                            'google'      => true, 
                            'font-backup' => false,
                            'output'      => array('footer p, footer p a'),
                            'units'       =>'px',
                            'subtitle'    => esc_attr__('Specify the Footer Text font properties.', 'dogmawp'),
                            'default'     => array(
                            'color'       => false,
                            'font-style'  => false,
                            'font-family' => false,
                            'google'      => true,
                            'font-size'   => false,
                            'line-height' => false,
                            ),
						),
												
						
                    )
                ) );	
				
				
				 Redux::setSection( $opt_name, array(
                    'icon'   => 'el-icon-th-large',
                    'title'  => esc_attr__( 'Footer Options', 'dogmawp' ),
                    'fields' => array(
					
						
					
					
					array(
							'id' => 'theme-cus-copy',
							'type' => 'info',
		                    'notice' => true,
		                    'style' => 'info',
							'title' => esc_attr__('Copy right Text', 'dogmawp'),
							'desc' => esc_attr__('Footer copy right Text', 'dogmawp')
							
					  ),
					
					array(
							'id' => 'copyright',
							'type' => 'editor',
							'wpautop'=>true,
							'compiler' => 'true',
							'title' => esc_attr__('Copyright text of the WebSite', 'dogmawp'),
							'subtitle' => esc_attr__('Write a Copyright text of your WebSite', 'dogmawp'),
							'default'          => '<span>&#169; Dogma 2016  /  All rights reserved. </span>',
							'args'   => array(
								'teeny'            => true,
								'textarea_rows'    => 10
							)
					),
					
					
					
					
					array(
							'id' => 'theme-cus-css',
							'type' => 'info',
		                    'notice' => true,
		                    'style' => 'info',
							'title' => esc_attr__('Custom CSS', 'dogmawp'),
							'desc' => esc_attr__('Custom CSS Option', 'dogmawp')
							
					  ),
					  
					  
					  
					  
					
					array(
							'id'        => 'effectcustomcss',
							'type'      => 'ace_editor',
							'title'     => esc_attr__('Custom CSS:', 'dogmawp'),
							'subtitle'  => esc_attr__('Write Your Custom CSS Here','dogmawp'),
							'dece'      => esc_attr__('','dogmawp'),
							'mode'      => 'css',
							'theme'    => 'monokai',
							
						),
						
					
					
					
					
					
					
					)
                ) );
				
				Redux::setSection( $opt_name, array(
                    'icon'   => 'el-icon-key',
                    'title'  => __( 'Documentation', 'redux-framework-demo' ),
                    'fields' => array(
					
					array(
							'id' => 'docs',
							'type' => 'info',
		                    'notice' => true,
		                    'style' => 'info',
							'title' => __('Dogma Theme Documentation', 'dogmawp'),
							'desc' => __('<a href="http://webredox.net/demo/wp/dogma/doc/documentation.html" target="_blank">Click Here</a> To get the theme documentation.', 'dogmawp')
							
					),
					
					
					)
                ) );

    
   
    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => esc_attr__( 'Section via hook', 'dogmawp' ),
                'desc'   => esc_attr__( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'dogmawp' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-dogmawp plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }

