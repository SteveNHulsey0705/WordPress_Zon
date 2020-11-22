<?php defined('ABSPATH') or die("No script kiddies please!");?>
<?php $wr_options = get_option('wr_wp'); ?>
<!--=============== content-holder ===============-->
                <div class="content-holder elem scale-bg2   no-padding">
                    <!-- Page title -->
                    <div class="dynamic-title"><?php the_title();?></div>
                    <!-- Page title  end--> 
                     <?php get_template_part('template-parts/menu-part');?>
                    <!--  Content -->
                    <div class="content full-height no-padding home-content ">
                        <!--full-height wrap -->
                        <div class="full-height-wrap">
                            <div class="customNavigation fhsln">
                                <a class="prev-slide transition"><i class="fa fa-angle-left"></i></a>
                                <a class="next-slide transition"><i class="fa fa-angle-right"></i></a>
                            </div>
							<?php if(get_post_meta($post->ID,'rnr_portfolio-post-formats',true)=='portfolio'){ ?>
							<!--slideshow-holder -->
                            <div class="synh-slider-holder">
                                <div class="overlay"></div>
                                <div class="synh-slider owl-carousel">
								   <?php global $post;
								    $showpost= get_post_meta($post->ID, 'rnr_port-post-show', true);			
		                            $categoryname= get_post_meta($post->ID, 'rnr_intro-slider-post-cat', true);
		                            $paged=(get_query_var('paged'))?get_query_var('paged'):1;
		                            $loop = new WP_Query( array( 'post_type' => 'portfolio','posts_per_page'=> $showpost, 'portfolio_category'=> $categoryname) );
		                            while ( $loop->have_posts() ) : $loop->the_post();?>
                                    <!-- 1 -->
                                    <div class="item">
									<?php if (has_post_thumbnail( $post->ID ) ): 
  									$wr_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' ); ?>
                                        <div class="bg" style="background-image:url(<?php echo esc_url($wr_image[0]); ?>)"></div>
									<?php endif ;?>
                                    </div>
									<?php endwhile; wp_reset_postdata(); ?>	
                                    
                                </div>
                            </div>
                            <!--slideshow-holder end -->
                            <!-- synh-wrap-holder -->
                            <div class="synh-wrap-holder">
                                <div class="synh-wrap">
								    <?php global $post;
									$showpost= get_post_meta($post->ID, 'rnr_port-post-show', true);
		                            $categoryname= get_post_meta($post->ID, 'rnr_intro-slider-post-cat', true);
		                            $paged=(get_query_var('paged'))?get_query_var('paged'):1;
		                            $loop = new WP_Query( array( 'post_type' => 'portfolio','posts_per_page'=> $showpost, 'portfolio_category'=> $categoryname) );
		                            while ( $loop->have_posts() ) : $loop->the_post();?>
                                    <div class="item">
                                        <h3> <?php the_title();?>  </h3>
                                        <h4> <?php
												$excerpt= substr(strip_tags($post->post_content), 0, 50);
												update_post_meta(get_the_ID(), 'excerpt', $excerpt);
												echo esc_html($excerpt);
												?> </h4>
                                        
                                    <a href="<?php the_permalink(); ?>" class="ajax btn anim-button   trans-btn   transition  fl-l"><span><?php esc_attr_e('View Project','dogmawp');?></span><i class="fa fa-long-arrow-right"></i></a>
									
                                    </div>
									<?php endwhile; wp_reset_postdata(); ?>	
                                    
                                </div>
                            </div>
                            <!-- synh-wrap-holder end  -->
							<?php }
							else if(get_post_meta($post->ID,'rnr_portfolio-post-formats',true)=='post') { ?>
							<!--slideshow-holder -->
                            <div class="synh-slider-holder">
                                <div class="overlay"></div>
                                <div class="synh-slider owl-carousel">
								   <?php global $post;
								    $showpost= get_post_meta($post->ID, 'rnr_port-post-show', true);			
		                            $categoryname= get_post_meta($post->ID, 'rnr_intro-slider-post-cat', true);
		                            $paged=(get_query_var('paged'))?get_query_var('paged'):1;
		                            $loop = new WP_Query( array( 'post_type' => 'post','posts_per_page'=> $showpost, 'category'=> $categoryname) );
		                            while ( $loop->have_posts() ) : $loop->the_post();?>
                                    <!-- 1 -->
                                    <div class="item">
									<?php if (has_post_thumbnail( $post->ID ) ): 
  									$wr_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' ); ?>
                                        <div class="bg" style="background-image:url(<?php echo esc_url($wr_image[0]); ?>)"></div>
									<?php endif ;?>
                                    </div>
									<?php endwhile; wp_reset_postdata(); ?>	
                                    
                                </div>
                            </div>
                            <!--slideshow-holder end -->
                            <!-- synh-wrap-holder -->
                            <div class="synh-wrap-holder">
                                <div class="synh-wrap">
								    <?php global $post;
									$showpost= get_post_meta($post->ID, 'rnr_port-post-show', true);
		                            $categoryname= get_post_meta($post->ID, 'rnr_intro-slider-post-cat', true);
		                            $paged=(get_query_var('paged'))?get_query_var('paged'):1;
		                            $loop = new WP_Query( array( 'post_type' => 'post','posts_per_page'=> $showpost, 'category'=> $categoryname) );
		                            while ( $loop->have_posts() ) : $loop->the_post();?>
                                    <div class="item">
                                        <h3> <?php the_title();?>  </h3>
                                        <h4> <?php
												$excerpt= substr(strip_tags($post->post_content), 0, 50);
												update_post_meta(get_the_ID(), 'excerpt', $excerpt);
												echo esc_html($excerpt);
												?> </h4>
                                        
                                    <a href="<?php the_permalink(); ?>" class="ajax btn anim-button   trans-btn   transition  fl-l"><span><?php esc_attr_e('View Project','dogmawp');?></span><i class="fa fa-long-arrow-right"></i></a>
									
                                    </div>
									<?php endwhile; wp_reset_postdata(); ?>	
                                    
                                </div>
                            </div>
                            <!-- synh-wrap-holder end  -->
							<?php }
							else  { ?>
                            <!--slideshow-holder -->
                            <div class="synh-slider-holder">
                                <div class="overlay"></div>
                                <div class="synh-slider owl-carousel">
								   <?php global $post;
								    $showpost= get_post_meta($post->ID, 'rnr_port-post-show', true);			
		                            $categoryname= get_post_meta($post->ID, 'rnr_intro-slider-post-cat', true);
		                            $paged=(get_query_var('paged'))?get_query_var('paged'):1;
		                            $loop = new WP_Query( array( 'post_type' => 'slider','posts_per_page'=> $showpost, 'slider_category'=> $categoryname) );
		                            while ( $loop->have_posts() ) : $loop->the_post();?>
                                    <!-- 1 -->
                                    <div class="item">
									<?php if (has_post_thumbnail( $post->ID ) ): 
  									$wr_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' ); ?>
                                        <div class="bg" style="background-image:url(<?php echo esc_url($wr_image[0]); ?>)"></div>
									<?php endif ;?>
                                    </div>
									<?php endwhile; wp_reset_postdata(); ?>	
                                    
                                </div>
                            </div>
                            <!--slideshow-holder end -->
                            <!-- synh-wrap-holder -->
                            <div class="synh-wrap-holder">
                                <div class="synh-wrap">
								    <?php global $post;
									$showpost= get_post_meta($post->ID, 'rnr_port-post-show', true);
		                            $categoryname= get_post_meta($post->ID, 'rnr_intro-slider-post-cat', true);
		                            $paged=(get_query_var('paged'))?get_query_var('paged'):1;
		                            $loop = new WP_Query( array( 'post_type' => 'slider','posts_per_page'=> $showpost, 'slider_category'=> $categoryname) );
		                            while ( $loop->have_posts() ) : $loop->the_post();?>
                                    <div class="item">
                                        <h3> <?php the_title();?>  </h3>
                                        <h4> <?php the_content();?> </h4>
                                        <?php if (( get_post_meta($post->ID,'rnr_slider_bt_url',true))):?>
                                    <a href="<?php echo esc_attr(get_post_meta($post->ID,'rnr_slider_bt_url',true)); ?>" class="ajax btn anim-button   trans-btn   transition  fl-l"><span><?php if (( get_post_meta($post->ID,'rnr_slider_bt_txt',true))):?><?php echo esc_attr(get_post_meta($post->ID,'rnr_slider_bt_txt',true)); ?><?php else:?><?php esc_attr_e('View Project','dogmawp');?><?php endif;?></span><i class="fa fa-long-arrow-right"></i></a>
									<?php endif;?>
                                    </div>
									<?php endwhile; wp_reset_postdata(); ?>	
                                    
                                </div>
                            </div>
                            <!-- synh-wrap-holder end  -->
							<?php }?>
                        </div>
                        <!-- full-height-wrap end  -->  
                    </div>
                    <!-- Content   end -->	 
                     <?php get_template_part('template-parts/social-share');?>
                </div>
                <!-- Content holder  end -->