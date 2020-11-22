<?php defined('ABSPATH') or die("No script kiddies please!");?>
<?php $wr_options = get_option('wr_wp'); ?>
<?php
get_header();
/*Template Name:Default Template*/
 ?>


         
		 <?php if(get_post_meta($post->ID,'rnr_wr-pagetype',true)=='st2'){ ?> 
         <?php get_template_part('template-parts/page/left-sidebar');?>
		 <?php }
		 else if(get_post_meta($post->ID,'rnr_wr-pagetype',true)=='st3'){ ?> 
         <?php get_template_part('template-parts/page/full-width');?>
		 <?php }
		 
		 else if(get_post_meta($post->ID,'rnr_wr-pagetype',true)=='st4'){ ?> 
         <?php get_template_part('template-parts/page/fixed-height');?>
		 <?php }
		 
		 else  { ?>
		 <?php get_template_part('template-parts/page/default');?>
		 <?php }?>
       
      

 
<?php get_footer(); ?>	
