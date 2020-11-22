<?php defined('ABSPATH') or die("No script kiddies please!");?>
<?php $wr_options = get_option('wr_wp'); ?>
<?php 
 get_header();
 ?>
 <!--=============== content-holder ===============-->
                <div class="content-holder elem scale-bg2 transition3">
                    <!-- Page title -->
                    <div class="dynamic-title"><?php the_title();?></div>
                    <!-- Page title  end--> 
                     <?php get_template_part('template-parts/menu-part');?>
                    <!--  Content -->
                    <div class="content">
                        <section class="no-bg box-page">
                            <!--  container -->
                            <div class="container">
                                <article class="sinnle-post">
                                    <h2><?php the_title();?></h2>
                                    <ul class="blog-title">
                                        <li><a href="#" class="tag"><?php the_time('j F Y') ?></a></li>
                                        <li> - </li>
                                        <li><a href="#" class="tag"><?php the_category(', ') ?> </a></li>
                                    </ul>
                                    <!--  blog-media  --> 
                                    <div class="blog-media">
									<?php if( has_post_format( 'video' ) !='') :?>
									<?php if(get_post_meta($post->ID,'rnr_bl-video',true)):?>
                                        <div class="custom-slider-holder">
                                           <div class="resp-video">
                                            
                                             </div>
                                        </div>
									<?php endif;?>
									<?php elseif( has_post_format( 'gallery' ) !='') :?>
									<div class="custom-slider-holder">
                                            <div class="customNavigation">
                                                <a class="next-slide transition"><i class="fa fa-long-arrow-right"></i></a>
                                                <a class="prev-slide transition"><i class="fa fa-long-arrow-left"></i></a>
                                            </div>
                                            <div class="custom-slider owl-carousel">
                                               <?php $images = rwmb_meta( 'rnr_wr_slide_show_blog','type=image&size=dg_blog_details_image' );
											foreach ( $images as $image ){
											echo "<!-- image -->
												<div class='item'>
                                                    <img src='{$image['url']}' class='respimg' alt=''>
                                                </div>
											<!-- image end -->
										   ";
											 };?>
                                                
												
                                                
                                            </div>
                                        </div>
									<?php elseif( has_post_format( 'image' ) !='') :?>
									<?php if (has_post_thumbnail( $post->ID ) ):
									$wr_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'dg_blog_details_image' );?>
									<div class="custom-slider-holder">
									<img src="<?php echo esc_url($wr_image[0]);?>" class="respimg" alt="">
									</div>
									<?php else:?>
									
									<?php endif;?>
									<?php endif;?>
                                    </div>
                                    <!--  blog-media  end--> 
                                    <!--  blog-text  --> 
                                    <div class="blog-text">
                                         <?php if(have_posts()) : while ( have_posts() ) : the_post();?>
                                         <?php the_content();?>
										<?php endwhile;  endif; wp_reset_postdata(); ?>
										<?php
										if( has_tag() ) {?>
                                        <div class="taglist">
                                            <?php the_tags();?>
                                        </div>
										<?php } else {?>
										<?php }?>
                                    </div>
                                    <!--  blog-text end --> 
                                    <?php comments_template(); ?>
                                   
                                </article>
                                <!--  content navigation -->
                                <div class="content-nav single-nav">
                                    <ul>
                                 <?php $previous_post = get_previous_post();
								 $url = is_object( $previous_post ) ? get_permalink( $previous_post->ID ) : '';
								 ?>
								 <?php  if ($previous_post) { ?>
                                    <li><a href="<?php echo esc_url( $url );?>" class="ajax ln"><i class="fa fa fa-angle-left"></i></a></li>
								<?php }?>
										<?php if(!empty($wr_options['bloglink'])):?>
                                        <li>
                                            <div class="list">
                                                <a href="<?php echo esc_url($wr_options['bloglink']);?>" class="ajax">							
                                                <span>
                                                <i class="b1 c1"></i><i class="b1 c2"></i><i class="b1 c3"></i>
                                                <i class="b2 c1"></i><i class="b2 c2"></i><i class="b2 c3"></i>
                                                <i class="b3 c1"></i><i class="b3 c2"></i><i class="b3 c3"></i>
                                                </span></a>
                                            </div>
                                        </li>
										<?php else:?>
										<li>
                                            <div class="list">
                                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ajax">							
                                                <span>
                                                <i class="b1 c1"></i><i class="b1 c2"></i><i class="b1 c3"></i>
                                                <i class="b2 c1"></i><i class="b2 c2"></i><i class="b2 c3"></i>
                                                <i class="b3 c1"></i><i class="b3 c2"></i><i class="b3 c3"></i>
                                                </span></a>
                                            </div>
                                        </li>
										<?php endif;?>
                                        <?php $next_post = get_next_post();
									 $url = is_object( $next_post ) ? get_permalink( $next_post->ID ) : '';
									?>
									<?php if ($next_post) {?>	
										<li><a href="<?php echo esc_url( $url );?>" class="ajax rn"><i class="fa fa fa-angle-right"></i></a></li>
									<?php }?>
                                    </ul>
                                </div>
                                <!--  content navigation end-->
                            </div>
                            <!--  container end -->
                        </section>
                    </div>
                    <!--  Content  end --> 
                    <?php get_template_part('template-parts/social-share');?>
                </div>
                <!-- Content holder  end -->
<?php get_footer(); ?> 