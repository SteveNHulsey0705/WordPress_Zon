<?php defined('ABSPATH') or die("No script kiddies please!");?>
<?php get_header();?>
<?php $wr_options = get_option('wr_wp'); ?> 
		
		<?php if(get_post_meta($post->ID,'rnr_wr_portdt_pagetype',true)=='st2'){ ?> 
         <?php get_template_part('template-parts/portfolio-details/style-one');?>
		 <?php }
		 else if(get_post_meta($post->ID,'rnr_wr_portdt_pagetype',true)=='st3'){ ?> 
         <?php get_template_part('template-parts/portfolio-details/style-two');?>
		 <?php }
		 else if(get_post_meta($post->ID,'rnr_wr_portdt_pagetype',true)=='st4'){ ?> 
         <?php get_template_part('template-parts/portfolio-details/style-three');?>
		 <?php }
		 else if(get_post_meta($post->ID,'rnr_wr_portdt_pagetype',true)=='st5'){ ?> 
         <?php get_template_part('template-parts/portfolio-details/style-four');?>
		 <?php }
		 else if(get_post_meta($post->ID,'rnr_wr_portdt_pagetype',true)=='st6'){ ?> 
         <?php get_template_part('template-parts/portfolio-details/style-five');?>
		 <?php }
		 else if(get_post_meta($post->ID,'rnr_wr_portdt_pagetype',true)=='st7'){ ?> 
         <?php get_template_part('template-parts/portfolio-details/style-six');?>
		 <?php }
		  else if(get_post_meta($post->ID,'rnr_wr_portdt_pagetype',true)=='st8'){ ?> 
         <?php get_template_part('template-parts/portfolio-details/style-seven');?>
		 <?php }
		 else  { ?>
		 <?php get_template_part('template-parts/portfolio-details/style-one');?>
		 <?php }?>

<?php get_footer(); ?> 