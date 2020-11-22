<?php defined('ABSPATH') or die("No script kiddies please!");?>
<?php $wr_options = get_option('wr_wp'); ?>
 <!--=============== content-holder ===============-->
                <div class="content-holder elem scale-bg2 transition3">
                    <!-- Page title -->
                    <div class="dynamic-title"><?php the_title();?></div>
                    <!-- Page title  end--> 
                     <?php get_template_part('template-parts/menu-part');?>
                    <!--  Content -->
                    <div class="content">
                        <section>
                            <!--  container -->
                            <div class="container">
                                <!--  services-holder -->
                                <div class="services-holder wr-default-page">
                                    <?php while ( have_posts() ) : the_post(); ?>
									<?php the_content();?>
									<?php endwhile; ?>
									<?php wp_reset_postdata();?>
								<?php if (( get_post_meta($post->ID,'rnr_page-comment',true))=='yes'):?>   
								
								<article class="sinnle-post wr-page-comments">	
								<?php comments_template(); ?>
								</article> 								 
								<?php else:?>  
								 	 <!-- Empty --> 							
								
								<?php endif;?>
                                </div>
                                <!-- services-holder  end-->
                            </div>
                            <!-- Container-->
                        </section>
                    </div>
                    <!--  Content  end --> 
                     <?php get_template_part('template-parts/social-share');?>
                </div>
                <!-- Content holder  end -->