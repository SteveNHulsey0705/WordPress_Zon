<?php /*defined('ABSPATH') or die("No script kiddies please!"); */ ?>


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



   <!-- <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'> -->
<style>
@font-face {
    font-family: 'Roboto';
    src: url('<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/dogmawp-child/fonts/RobotoRegular2.eot');
    src: url('<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/dogmawp-child/fonts/RobotoRegular2.eot') format('embedded-opentype'),
         url('<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/dogmawp-child/fonts/RobotoRegular2.woff2') format('woff2'),
         url('<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/dogmawp-child/fonts/RobotoRegular2.woff') format('woff'),
         url('<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/dogmawp-child/fonts/RobotoRegular2.ttf') format('truetype'),
         url('<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/dogmawp-child/fonts/RobotoRegular2.svg#RobotoRegular') format('svg');
}
</style>


        <link rel="shortcut icon" href="<?php echo esc_url(AfterSetupTheme::return_thme_option('favicon','url'));?>" type="image/x-icon" />

		<?php }?>

		<?php 

			if ( is_singular() && comments_open() && get_option('thread_comments') )

			  wp_enqueue_script( 'comment-reply' );

			wp_head(); 

		?>
<style>
#ascrail2000, .nicescroll-cursors { background-color: transparent !important;}

.headercart {
    margin-top: 23px;
    position: absolute;
    right: 200px;
}

.headercart img { margin-top: 0px;}
.headercart a{font-size: 13px; float: right;
    margin-left: 5px;
    margin-top: 3px;}

@media only screen and (max-width:1037px){ 
.resize-carousel-holder { left: 0px !important;}
.full-height {
    overflow: visible !important;
}

.fixed-info-container {opacity: 1 !important;}
/* .woocommerce span.onsale { left: 8px;} */
.woocommerce ul.products li.product .onsale {display: none;}
}
@media only screen and (max-width:480px){
	.headercart {
    margin-top: 0px; right: 23px;
}
.headercart img { display: none;}
.woocommerce ul.products li.product, .woocommerce-page ul.products li.product { width:100%;}
.page-id-406 #wrapper .content.full-height .row  {/* background-image: url(<?php echo esc_url( home_url( '/' ) ); ?>wp-content/uploads/2016/06/test.jpg) !important; */ background-attachment: fixed;}
	 }
</style>

<script type="text/javascript">
 jQuery(document).ready(function (){
jQuery('input[name="update_cart"]').click(function() {
	setTimeout(
  function() 
  { location.reload();  }, 3000);
});

jQuery("a#inline").fancybox();

<?php if ($post->ID != 6) { ?>

 if (jQuery.cookie('mycookie2')) {
        // it hasn't been three days yet
    } else {
     if (!jQuery.cookie('mytime4') && jQuery.cookie('myfirts2')) {
       jQuery("a#inline").trigger("click");
        var date1 = new Date();
        date1.setTime(date1.getTime() + (300 * 1000));
        jQuery.cookie('mytime4', 'true', { expires: date1, path: '/jairo/zonaar/', domain: '.creativamotion.com' }); } 

        var date = new Date();
        date.setTime(date.getTime() + (30 * 1000));
        jQuery.cookie('mycookie2', 'true', { expires: date, path: '/jairo/zonaar/', domain: '.creativamotion.com'});
        var date2 = new Date();
        date2.setTime(date2.getTime() + (300 * 1000));
        jQuery.cookie('myfirts2', 'true', { expires: date1, path: '/jairo/zonaar/', domain: '.creativamotion.com'});

    }


setTimeout(function(){
  if (!jQuery.cookie('mytime4') && jQuery.cookie('myfirts2')) {
       jQuery("a#inline").trigger("click");
        var date1 = new Date();
        date1.setTime(date1.getTime() + (300 * 1000));
        jQuery.cookie('mytime4', 'true', { expires: date1, path: '/jairo/zonaar/', domain: '.creativamotion.com'}); } 
}, 20000);
<?php } ?>

});


function deleteCookie(name) {
                setCookie(name,"",-1);
            }
            function setCookie(name,value,days) {
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime()+(days*24*60*60*1000));
                    var expires = "; expires="+date.toGMTString();
                }
                else expires = "";
                document.cookie = name+"="+value+expires+"; path=/";
            }

jQuery(window).unload(function() {
 deleteCookie('mycookie2');
});
</script>
</head>

<body <?php body_class(); ?>>

<a id="inline" href="#data" style="display:none;">This shows content of element who has id="data"</a>
<div style="display: none">
<div id="data" style="width: 300px; padding: 15px;"><?php echo do_shortcode('[wysija_form id="2"]'); ?> </div>
</div>

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



                <div class="headercart">

                <span> <img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/uploads/2016/06/icon-cart.png" width="20"> </span>

                <?php

                global $woocommerce;



                // get cart quantity

                $qty = $woocommerce->cart->get_cart_contents_count();



                // get cart total

                $total = $woocommerce->cart->get_cart_total();



                // get cart url

                $cart_url = $woocommerce->cart->get_cart_url();



                // if multiple products in cart

                if($qty>1)

                      echo '<a href="'.$cart_url.'">'.$qty.' products | '.$total.'</a>';



                // if single product in cart

                if($qty==1)

                      echo '<a href="'.$cart_url.'">1 product | '.$total.'</a>';

                ?>

                </div>





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