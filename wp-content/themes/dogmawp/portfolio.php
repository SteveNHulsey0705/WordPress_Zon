<?php defined('ABSPATH') or die("No script kiddies please!");?>
<?php $wr_options = get_option('wr_wp');?>
<?php
/*Template Name:Portfolio Page Template*/
 get_header();
 
 
 ?>
 
		 <?php if(get_post_meta($post->ID,'rnr_wr_portfolio_pagetype',true)=='st2'){ ?> 
         <?php get_template_part('template-parts/portfolio/style-one');?>
		 <?php }
		 else if(get_post_meta($post->ID,'rnr_wr_portfolio_pagetype',true)=='st3'){ ?> 
         <?php get_template_part('template-parts/portfolio/style-two');?>
		 <?php }
		 else if(get_post_meta($post->ID,'rnr_wr_portfolio_pagetype',true)=='st4'){ ?> 
         <?php get_template_part('template-parts/portfolio/style-three');?>
		 <?php }
		 else if(get_post_meta($post->ID,'rnr_wr_portfolio_pagetype',true)=='st5'){ ?> 
         <?php get_template_part('template-parts/portfolio/style-four');?>
		 <?php }
		 else if(get_post_meta($post->ID,'rnr_wr_portfolio_pagetype',true)=='st6'){ ?> 
         <?php get_template_part('template-parts/portfolio/style-five');?>
		 <?php }
		 else if(get_post_meta($post->ID,'rnr_wr_portfolio_pagetype',true)=='st7'){ ?> 
         <?php get_template_part('template-parts/portfolio/style-six');?>
		 <?php }
		 else  { ?>
		 <?php get_template_part('template-parts/portfolio/style-one');?>
		 <?php }?>
<?php get_footer(); ?>	