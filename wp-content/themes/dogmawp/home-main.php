<?php defined('ABSPATH') or die("No script kiddies please!");?>
<?php $wr_options = get_option('wr_wp');?>
<?php
/*Template Name:Home Page Template*/
 get_header();
 
 
 ?>
 
 <?php if(get_post_meta($post->ID,'rnr_wr_home_pagetype',true)=='st2'){ ?> 
         <?php get_template_part('template-parts/home/home-slide');?>
		 <?php }
		 else if(get_post_meta($post->ID,'rnr_wr_home_pagetype',true)=='st3'){ ?> 
         <?php get_template_part('template-parts/home/home-multi-4');?>
		 <?php }
		 else if(get_post_meta($post->ID,'rnr_wr_home_pagetype',true)=='st4'){ ?> 
         <?php get_template_part('template-parts/home/home-multi-3');?>
		 <?php }
		 else if(get_post_meta($post->ID,'rnr_wr_home_pagetype',true)=='st5'){ ?> 
         <?php get_template_part('template-parts/home/home-video');?>
		 <?php }
		 else if(get_post_meta($post->ID,'rnr_wr_home_pagetype',true)=='st6'){ ?> 
         <?php get_template_part('template-parts/home/home-single-image');?>
		 <?php }
		 else if(get_post_meta($post->ID,'rnr_wr_home_pagetype',true)=='st7'){ ?> 
         <?php get_template_part('template-parts/home/home-slider');?>
		 <?php }
		  else if(get_post_meta($post->ID,'rnr_wr_home_pagetype',true)=='st8'){ ?> 
         <?php get_template_part('template-parts/home/home-visiable-menu');?>
		 <?php }
		 else  { ?>
		 <?php get_template_part('template-parts/home/home-slide');?>
		 <?php }?>
<?php get_footer(); ?>	