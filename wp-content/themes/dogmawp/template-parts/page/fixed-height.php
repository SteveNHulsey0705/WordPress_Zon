<?php defined('ABSPATH') or die("No script kiddies please!");?>
<?php $wr_options = get_option('wr_wp'); ?>
<!--=============== content-holder ===============-->
                <div class="content-holder elem scale-bg2 transition3">
                    <!-- Page title -->
                    <div class="dynamic-title"><?php the_title();?></div>
                    <!-- Page title  end--> 
                     <?php get_template_part('template-parts/menu-part');?> 
                    <!--  Content -->
                    <div class="content full-height wr-contact ">
                    <?php while ( have_posts() ) : the_post(); ?>
					<?php the_content();?>
					<?php endwhile; ?>
					<?php wp_reset_postdata();?>   
                    </div>
                    <!--  Content  end --> 
                     <?php get_template_part('template-parts/social-share');?>
                </div>
                <!-- Content holder  end -->	