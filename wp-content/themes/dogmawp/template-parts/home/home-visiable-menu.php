<?php defined('ABSPATH') or die("No script kiddies please!");?>
<?php $wr_options = get_option('wr_wp'); ?>
<!--=============== content-holder ===============-->
                <div class="content-holder elem scale-bg2">
                    <!-- Page title -->
                    <div class="dynamic-title"><?php the_title();?></div>
                    <!-- Page title  end--> 
                     <?php get_template_part('template-parts/menu-part');?>
                    <!--  Content -->
                    <div class="content full-height">
                        <!--full-height wrap -->
                        <div class="full-height-wrap">
                            <div class="full-width-slider-holder">
							<?php if(get_post_meta($post->ID,'rnr_portfolio-post-formats',true)=='portfolio'){ ?>
							<div  class="full-width-slider owl_carousel">
								<?php global $post;
									$showpost= get_post_meta($post->ID, 'rnr_port-post-show', true);
		                            $categoryname= get_post_meta($post->ID, 'rnr_intro-slider-post-cat', true);
		                            $paged=(get_query_var('paged'))?get_query_var('paged'):1;
		                            $loop = new WP_Query( array( 'post_type' => 'portfolio','posts_per_page'=> $showpost, 'portfolio_category'=> $categoryname) );
		                            while ( $loop->have_posts() ) : $loop->the_post();?>
                                    <!-- slide item-->
                                    <div class="item">
										<?php if (has_post_thumbnail( $post->ID ) ): 
  									    $wr_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' ); ?>
                                        <div class="bg bg-slider" style="background-image:url(<?php echo esc_url($wr_image[0]); ?>)"></div>
										<?php endif;?>
                                        <div class="overlay"></div>
                                        <!-- enter-wrap -->
                                        <div class="enter-wrap-holder cent-holder wht-bg">
                                            <div class="enter-wrap">
                                                <h3><?php the_title();?></h3>
                                                
                                    <a href="<?php the_permalink(); ?>" class="ajax btn anim-button   trans-btn   transition"><span><?php esc_attr_e('View Project','dogmawp');?></span><i class="fa fa-long-arrow-right"></i></a>
									
                                            </div>
                                        </div>
                                        <!-- enter-wrap end  -->                                   
                                    </div>
                                    <!-- slide item -->
                                   <?php endwhile; wp_reset_postdata(); ?>	
                                </div>
							<?php }
							else if(get_post_meta($post->ID,'rnr_portfolio-post-formats',true)=='post') { ?>
							<div  class="full-width-slider owl_carousel">
								<?php global $post;
									$showpost= get_post_meta($post->ID, 'rnr_port-post-show', true);
		                            $categoryname= get_post_meta($post->ID, 'rnr_intro-slider-post-cat', true);
		                            $paged=(get_query_var('paged'))?get_query_var('paged'):1;
		                            $loop = new WP_Query( array( 'post_type' => 'post','posts_per_page'=> $showpost, 'category'=> $categoryname) );
		                            while ( $loop->have_posts() ) : $loop->the_post();?>
                                    <!-- slide item-->
                                    <div class="item">
										<?php if (has_post_thumbnail( $post->ID ) ): 
  									    $wr_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' ); ?>
                                        <div class="bg bg-slider" style="background-image:url(<?php echo esc_url($wr_image[0]); ?>)"></div>
										<?php endif;?>
                                        <div class="overlay"></div>
                                        <!-- enter-wrap -->
                                        <div class="enter-wrap-holder cent-holder wht-bg">
                                            <div class="enter-wrap">
                                                <h3><?php the_title();?></h3>
                                                
                                    <a href="<?php the_permalink(); ?>" class="ajax btn anim-button   trans-btn   transition"><span><?php esc_attr_e('View Project','dogmawp');?></span><i class="fa fa-long-arrow-right"></i></a>
									
                                            </div>
                                        </div>
                                        <!-- enter-wrap end  -->                                   
                                    </div>
                                    <!-- slide item -->
                                   <?php endwhile; wp_reset_postdata(); ?>	
                                </div>
							<?php }
							else  { ?>
                                <div  class="full-width-slider owl_carousel">
								<?php global $post;
									$showpost= get_post_meta($post->ID, 'rnr_port-post-show', true);
		                            $categoryname= get_post_meta($post->ID, 'rnr_intro-slider-post-cat', true);
		                            $paged=(get_query_var('paged'))?get_query_var('paged'):1;
		                            $loop = new WP_Query( array( 'post_type' => 'slider','posts_per_page'=> $showpost, 'slider_category'=> $categoryname) );
		                            while ( $loop->have_posts() ) : $loop->the_post();?>
                                    <!-- slide item-->
                                    <div class="item">
										<?php if (has_post_thumbnail( $post->ID ) ): 
  									    $wr_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' ); ?>
                                        <div class="bg bg-slider" style="background-image:url(<?php echo esc_url($wr_image[0]); ?>)"></div>
										<?php endif;?>
                                        <div class="overlay"></div>
                                        <!-- enter-wrap -->
                                        <div class="enter-wrap-holder cent-holder wht-bg">
                                            <div class="enter-wrap">
                                                <h3><?php the_title();?></h3>
                                                <?php if (( get_post_meta($post->ID,'rnr_slider_bt_url',true))):?>
                                    <a href="<?php echo esc_attr(get_post_meta($post->ID,'rnr_slider_bt_url',true)); ?>" class="ajax btn anim-button   trans-btn   transition"><span><?php if (( get_post_meta($post->ID,'rnr_slider_bt_txt',true))):?><?php echo esc_attr(get_post_meta($post->ID,'rnr_slider_bt_txt',true)); ?><?php else:?><?php esc_attr_e('View Project','dogmawp');?><?php endif;?></span><i class="fa fa-long-arrow-right"></i></a>
									<?php endif;?>
                                            </div>
                                        </div>
                                        <!-- enter-wrap end  -->                                   
                                    </div>
                                    <!-- slide item -->
                                   <?php endwhile; wp_reset_postdata(); ?>	
                                </div>
							<?php }?>
                                <!--  navigation -->
                                <div class="customNavigation">
                                    <a class="prev-slide transition"><i class="fa fa-angle-left"></i></a>
                                    <a class="next-slide transition"><i class="fa fa-angle-right"></i></a>
                                </div>
                                <!--  navigation end-->
                            </div>
                        </div>
                        <!-- full-height-wrap end  -->  
                    </div>
                    <!-- Content   end -->	 
                    <?php get_template_part('template-parts/social-share');?>
                </div>
                <!-- Content holder  end -->