<?php defined('ABSPATH') or die("No script kiddies please!");?>
<?php $wr_options = get_option('wr_wp');?>
<?php
 get_header();
  ?>
 
 <!--=============== content-holder ===============-->
                <div class="content-holder elem scale-bg2 transition3">
                    <!-- Page title -->
                    <div class="dynamic-title"><?php single_cat_title( '', true ); ?></div>
                    <!-- Page title  end--> 
                     <?php get_template_part('template-parts/menu-part');?>
                    <!--  Content  --> 
                    <div class="content ">
                        <section class="no-padding no-border">
						
                            <!-- gallery-items   -->
                            <div class="gallery-items   hid-port-info grid-small-pad">
							
                            <?php global $loop; 
							$args = array_merge( $wp_query->query, array( 'post_type' => 'portfolio' ) );
							query_posts( $args );
							?>	
						
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
							<?php $portfolio_category = wp_get_post_terms($post->ID,'portfolio_category');?>
							<?php foreach ($portfolio_category as $item);?>
                                <!-- portfolio item -->	
                                    <div class="gallery-item <?php echo esc_attr($item->slug . ' ');?>">
                                        <div class="grid-item-holder">
                                            <div class="box-item">
                                            <?php if (has_post_thumbnail( $post->ID ) ):
											$wr_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'dg_portfolio_image' );?>
                                            <img  src="<?php echo esc_url($wr_image[0]);?>"   alt="<?php the_title();?>">
											<?php endif;?>
                                            </div>
                                            <div class="grid-item">
                                                <h3><a href="<?php the_permalink();?>" class="ajax portfolio-link"><?php the_title();?></a></h3>
                                                <span><?php echo esc_attr($item->name . ' ');?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 1 end -->
                                <?php  endwhile; endif; wp_reset_postdata(); ?>	
                               
                            </div>
                            <!-- end gallery items -->					
                        </section>
                    </div>
                    <!--  Content  end --> 
                    <?php get_template_part('template-parts/social-share');?>
                </div>
                <!-- Content holder  end -->
 
<?php get_footer(); ?>	