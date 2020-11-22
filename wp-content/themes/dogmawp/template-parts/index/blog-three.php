<?php defined('ABSPATH') or die("No script kiddies please!");?>
<?php $wr_options = get_option('wr_wp');?>

                        <!--  blog-inner -->
                        <div class="blog-inner">
                            <!--  gallery-items  -->
                            <div class="gallery-items    hid-port-info grid-small-pad three-coulms">
									
                               <?php global $post, $post_id;?>
							   <?php while ( have_posts() ) : the_post();?>
                                <!-- 3 -->
                                <div class="gallery-item">
								<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <div class="grid-item-holder">
                                        <article>
                                            <ul class="blog-title">
                                                <li><a href="#" class="tag"><?php the_time('j F Y') ?></a></li>
                                                <?php
										        if( has_category() ) {?>
                                                <li> - </li>
                                                <li><?php the_category(', ') ?><li>
												<?php } else {?>
										        <?php }?>
                                            </ul>
											<?php if( has_post_format( 'video' ) !='') :?>
											<?php if(get_post_meta($post->ID,'rnr_bl-video',true)):?>
											<div class="blog-media">
                                            <div class="resp-video">
                                            
                                             </div>
                                            </div>
											<?php endif;?>
											<?php else: ?>
											<?php if (has_post_thumbnail( $post->ID ) ):
										    $wr_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'dg_portfolio_image' );?>
                                            <div class="blog-media">
											<a href="<?php the_permalink();?>" class="ajax">
                                            <img alt="" src="<?php echo esc_url($wr_image[0]);?>" />
											</a>
                                            </div>
											<?php endif;?>
											<?php endif;?>
                                            <div class="blog-text">
                                                <h3><a href="<?php the_permalink();?>" class="ajax"><?php the_title();?></a></h3>
                                                <p>
												<?php
												$excerpt= substr(strip_tags($post->post_content), 0, 300);
												update_post_meta(get_the_ID(), 'excerpt', $excerpt);
												echo esc_html($excerpt);
												?>..
                                                </p>
                                                <a href="<?php the_permalink();?>" class="ajax btn anim-button   trans-btn   transition  fl-l" target="_blank"><span><?php esc_attr_e('read  more','dogmawp');?></span><i class="fa fa-eye"></i></a>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                                </div>
                                <!-- 3 end -->
								 <?php endwhile; ?>
								 <?php wp_reset_postdata();?>
                            </div>
                            <!-- end gallery items -->
                            <!-- pagination   -->
                            
                                    <?php if (function_exists("pagination")) {

									pagination($wp_query->max_num_pages);
									} ?>
                                
                            <!--  pagination end -->
                        </div>
                        <!--  blog-inner end -->
                    </div>
                   