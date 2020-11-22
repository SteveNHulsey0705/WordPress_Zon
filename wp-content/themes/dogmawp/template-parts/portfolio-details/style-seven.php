<?php defined('ABSPATH') or die("No script kiddies please!");?>
<?php $wr_options = get_option('wr_wp'); ?>
 <!--=============== content-holder ===============-->
                <div class="content-holder elem scale-bg2 transition3">
                    <!-- Page title -->
                    <div class="dynamic-title"><?php the_title();?></div>
                    <!-- Page title  end--> 
                     <?php get_template_part('template-parts/menu-part');?>
                    <!--  Content -->
                    <div class="content full-height no-padding">
                        <!--  show-hid-content -->
                        <div class="show-hid-content ishid"><?php esc_attr_e('Description','dogmawp');?> <i class="fa fa-long-arrow-down"></i></div>
                        <!--  show-hid-content end-->
                        <!--  fixed-info-container-->
                        <div class="fixed-info-container hidden-column">
                            <!--  content-nav-->
                            <div class="content-nav">
                                <ul>
								 <?php $previous_post = get_previous_post();
								 $url = is_object( $previous_post ) ? get_permalink( $previous_post->ID ) : '';
								 ?>
								 <?php  if ($previous_post) { ?>
                                    <li><a href="<?php echo esc_url( $url );?>" class="ajax ln"><i class="fa fa fa-angle-left"></i></a></li>
								<?php }?>
                                    <?php if(!empty($wr_options['portfoliolink'])):?>
                                    <li>
                                        <div class="list">
                                            <a href="<?php echo esc_url($wr_options['portfoliolink']);?>" class="ajax">							
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
                            <!--  content-nav end-->							
                            <h3><?php the_title();?></h3>
                            <div class="separator"></div>
                            <div class="clearfix"></div>
                            <?php if(have_posts()) : while ( have_posts() ) : the_post();?>
                            <?php the_content();?>
							<?php endwhile;  endif; wp_reset_postdata(); ?>
                            <h4><?php esc_attr_e('Scrennshots','dogmawp');?> </h4>
                            <!--  popup-gallery-holder-->
                            <div class="popup-gallery-holder popup-gallery">
							<?php $images = rwmb_meta( 'rnr_portfolio-image','type=image&size=dg_portfolio_image' );
                                    foreach ( $images as $image ){
                                        echo "<!--  1-->
                                <div class='box-item'>
                                    <img  src='{$image['url']}'   alt=''>
                                    <a href='{$image['url']}' class='popup-link'><i class='fa fa-expand'></i></a>
                                </div>
                                <!-- 1 end -->
							   ";
								 };?>
                                
                                
                            </div>
                            <!--  popup-gallery-holder end-->
							<h4><?php esc_attr_e('Info','dogmawp');?></h4>
                            <ul class="project-details">
								<?php if(get_post_meta($post->ID,'rnr_wr-infor-date',true)=='st2'){ ?> 
								<!---->
								<?php }
								else { ?>
                                <li><span><?php esc_attr_e('Date :','dogmawp');?></span> <?php the_time('d.m.Y') ?> </li>
								<?php } ?>
								<?php if(get_post_meta($post->ID,'rnr_wr-infor-dis',true)=='st2'){ ?> 
								<!---->
								<?php }
								else { ?>
                                <?php $wr_values =  rwmb_meta(
								 'rnr_pt_client', 
								 $args = array(
								 'type'=>'text',
								 ),
								$post_id = $post->ID
								); 
								if($wr_values){
								foreach ($wr_values as $key => $value) {
								echo balanceTags($value) ;
								}
								};?>
								<?php } ?>
                            </ul> 
                            <?php if (( get_post_meta($post->ID,'rnr_pt_button_url',true))):?>
                            <a href="<?php echo esc_attr(get_post_meta($post->ID,'rnr_pt_button_url',true)); ?>" class=" btn anim-button   trans-btn   transition  fl-l" target="_blank"><span><?php echo esc_attr(get_post_meta($post->ID,'rnr_pt_button_text',true)); ?></span><i class="fa fa-eye"></i></a>
						    <?php endif;?>
                        </div>
                        <!--  fixed-info-container end-->  
                        <!--resize-carousel-holder-->
                        <div class="resize-carousel-holder anim-holder gallery-horizontal-holder">
                            <!--media-container-->
                            <div class="media-container">
                                <div class="video-mask"></div>
                                <!--=============== add you video id  in data-vid="" if you want add sound change data-mv="1" on data-mv="0" ===============-->
                                <?php if (( get_post_meta($post->ID,'rnr_yidp',true))):?>
                                <div  class="background-video" data-vid="<?php echo esc_attr(get_post_meta($post->ID,'rnr_yidp',true)); ?>" data-mv="<?php echo (get_post_meta($post->ID,'rnr_intro-section-video-soundp',true)) ?>"> </div>
								<?php endif;?>
								<?php if (has_post_thumbnail( $post->ID ) ):
								$wr_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );?>
                                <div class="bg mob-bg" style="background-image:url(<?php echo esc_url($wr_image[0]);?>)"></div>
								<?php endif;?>
                            </div>
                            <!--media-container end -->
                        </div>
                        <!--resize-carousel-holder end--> 
                    </div>
                    <!--  Content  end --> 
                    <?php get_template_part('template-parts/social-share');?>
                </div>
                <!-- Content holder  end -->