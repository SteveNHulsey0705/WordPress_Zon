<?php defined('ABSPATH') or die("No script kiddies please!");?>

<!DOCTYPE html>
<!--[if lte IE 6]> <html class="no-js ie  lt-ie10 lt-ie9 lt-ie8 lt-ie7 ancient oldie" lang="en-US"> <![endif]-->
<!--[if IE 7]>     <html class="no-js ie7 lt-ie10 lt-ie9 lt-ie8 oldie" lang="en-US"> <![endif]-->
<!--[if IE 8]>     <html class="no-js ie8 lt-ie10 lt-ie9 oldie" lang="en-US"> <![endif]-->
<!--[if IE 9]>     <html class="no-js ie9 lt-ie10 oldie" lang="en-US"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"  dir="ltr" <?php language_attributes(); ?>> <!--<![endif]-->

    <head>

        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <?php $wr_options = get_option('wr_wp'); ?> 
        
         <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <?php  if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>   
        <link rel="shortcut icon" href="<?php echo esc_url(AfterSetupTheme::return_thme_option('favicon','url'));?>" type="image/x-icon" />
		<?php }?>
		<?php 
			if ( is_singular() && comments_open() && get_option('thread_comments') )
			  wp_enqueue_script( 'comment-reply' );
			wp_head(); 
		?>
</head>
<body <?php body_class(); ?>>
<div class="loader">
            <div class="tm-loader">
                <div id="circle"></div>
            </div>
        </div>
        <!--================= main start ================-->
        <div id="main">
            <!--=============== header ===============-->
            <header>
                <!-- Nav button-->
                <div class="nav-button">
                    <span  class="nos"></span>
                    <span class="ncs"></span>
                    <span class="nbs"></span>
                </div>
                <!-- Nav button end -->
                <!-- Logo--> 
                <div class="logo-holder">
				<?php if ($wr_options['textlogo']=="st1") {?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ajax logotextwr"><?php echo esc_attr(AfterSetupTheme::return_thme_option('logotext',''));?></a>
				<?php }
				else{
				?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ajax"><img src="<?php echo esc_url(AfterSetupTheme::return_thme_option('logopic','url'));?>" alt=""></a>
				<?php }?>
                </div>
                <!-- Logo  end--> 
                <!-- Header  title --> 
                <div class="header-title">
                    <h2><a class="ajax" href="#"></a></h2>
                </div>
                <!-- Header  title  end-->
				<?php if ($wr_options['showshare']=="yes") {?>
				<!-- share -->
                <div class="show-share isShare">
                    <span><?php esc_attr_e('Share','dogmawp');?></span>
                    <i class="fa fa-chain-broken"></i>            
                </div>
                <!-- share  end-->	
				<?php }

				else{
				?>
					
				<?php }?>
                		
            </header>
            <!-- Header   end-->
            <!--=============== wrapper ===============-->	
            <div id="wrapper">