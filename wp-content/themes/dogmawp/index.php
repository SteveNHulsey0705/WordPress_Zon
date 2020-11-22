<?php defined('ABSPATH') or die("No script kiddies please!");?>
<?php $wr_options = get_option('wr_wp'); ?>
<?php
get_header();

 ?>
 <!--=============== content-holder ===============-->
<div class="content-holder elem scale-bg2 transition3">
<!-- Page title -->
<?php if(!empty($wr_options['blogtitle'])):?>
<div class="dynamic-title"><?php echo esc_attr(AfterSetupTheme::return_thme_option('blogtitle',''));?></div>
<?php else:?>
<div class="dynamic-title"><?php esc_attr_e('Blog','dogmawp');?></div>
<?php endif;?>
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
 <div style="display:none;"><?php the_tags(); next_posts_link(); previous_posts_link();wp_link_pages();comment_form();paginate_comments_links();previous_comments_link(); wp_enqueue_script('comment-reply'); the_post_thumbnail();?></div>
 </div>
<!--  Content  end -->
<?php get_template_part('template-parts/social-share');?>
</div>
 <!-- Content holder  end --> 
 
 
 <?php get_footer(); ?>	