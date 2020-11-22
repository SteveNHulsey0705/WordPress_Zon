<?php defined('ABSPATH') or die("No script kiddies please!");?>
<?php $wr_options = get_option('wr_wp'); ?>
<?php
get_header();
?>
			

	  
						<?php global $post;?>
						<?php if(have_posts()) : ?>
				
 <!--=============== content-holder ===============-->
<div class="content-holder elem scale-bg2 transition3">
<!-- Page title -->

<div class="dynamic-title"><?php esc_attr_e('Tag','dogmawp');?></div>

<!-- Page title  end--> 
<?php get_template_part('template-parts/menu-part');?>
 <!--  Content -->
 <div class="content">
 <?php if ($wr_options['blog-sidebar']=="st1") {?>
 <?php get_template_part('template-parts/index/blog-three');?>
 
 <?php } elseif ($wr_options['blog-sidebar']=="st2") { ?>
 <?php get_template_part('template-parts/index/blog-four');?>
 <?php } else { ?>
 <?php get_template_part('template-parts/index/blog-right');?>
 <?php }?>
 </div>
<!--  Content  end -->
<?php get_template_part('template-parts/social-share');?>
</div>
 <!-- Content holder  end --> 					

		  
                            
               <?php else : ?>
				
 <div class="back-link "><span><h2><?php esc_attr_e('404','dogmawp');?></h2> <br> <?php esc_attr_e('Search not found.','dogmawp');?></span><a class="abl ajaxPageSwitchBacklink"><?php esc_attr_e('Back to the last page','dogmawp');?></a></div>
           
          
				<?php endif;?>
        
         


 
<?php get_footer(); ?>
