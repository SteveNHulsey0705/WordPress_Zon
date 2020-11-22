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

                        <div class="show-hid-content <?php if($_REQUEST['description'] == 1) { ?>ishid <?php } else { ?>ishid<?php } ?>"><?php esc_attr_e('Description','dogmawp');?> <i class="fa fa-long-arrow-down"></i></div>
                        

                        <!--  show-hid-content end-->

                        <!--  fixed-info-container-->

                        <div class="fixed-info-container hidden-column">

                            <div class="content-nav">

                                <ul>

                                    <?php $previous_post = get_previous_post();

								 $url = is_object( $previous_post ) ? get_permalink( $previous_post->ID ) : '';
								  if($post->ID == 448) {$url = get_permalink(455); }
								  if($post->ID == 456) {$url = get_permalink(463); }
								  if($post->ID == 465) {$url = get_permalink(536); }
								  if($post->ID == 522) {$url = get_permalink(465); }

								 ?>

								 <?php  if ($previous_post) { ?>

                                    <li><a href="<?php echo esc_url( $url );?>?description=1" class="ajax ln"><i class="fa fa fa-angle-left"></i></a></li>

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
									 if($post->ID == 446) {$url = get_permalink(362); }
									 if($post->ID == 455) {$url = get_permalink(448); }
									 if($post->ID == 463) {$url = get_permalink(456); }
									 if($post->ID == 536) {$url = get_permalink(465); }

									?>

								<?php if ($next_post) { ?>	

                                    <li><a href="<?php echo esc_url( $url );?>?description=1" class="ajax rn"><i class="fa fa fa-angle-right"></i></a></li>

								<?php }?>

                                </ul>

                            </div>

                            <h3><?php the_title();?></h3>

                            <div class="separator"></div>

                            <div class="clearfix"></div>

                            <?php if(have_posts()) : while ( have_posts() ) : the_post();?>

                            <?php the_content();?>

							<?php endwhile;  endif; wp_reset_postdata(); ?>

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

                        <!--  resize-carousel-holder  -->					

                        <div class="resize-carousel-holder anim-holder">

                            <!--  full-width-slider-holder  -->	

                            <div class="full-width-slider-holder">

                                <!--  full-width-slider  -->	

                                <div  class="full-width-slider owl_carousel">

                                    <?php $images = rwmb_meta( 'rnr_portfolio-image','type=image&size=' );

                                    foreach ( $images as $image ){

                                        echo "<!-- 1--> 

                                    <div class='item'>

                                        <div class='bg bg-slider' style='background-image:url({$image['url']})'></div>

                                        <div class='zoomimage'><img src='{$image['url']}' class='intense' alt=''><i class='fa fa-expand'></i></div>

                                        

                                    </div>

                                    <!-- 1 end-->

							   ";

								 };?>

                                  

									<?php $wr_values =  rwmb_meta(

								 'rnr_pt_vimeo', 

								 $args = array(

								 'type'=>'text',

								 ),

								$post_id = $post->ID

								); 

								if($wr_values){

								foreach ($wr_values as $key => $value) {

								echo " <!-- 3 --> 

                                    <div class='item'>

                                        <div class='ifarme-fwh-holder'>

                                            <iframe src=".$value."></iframe> 

                                        </div>

                                    </div>

                                    <!-- 3 end --> ";

								}

								};?>

                                    	

                                </div>

                                <!--  full-width-slider  end  -->

                                <!--  navigation -->

                                <div class="customNavigation">

                                    <a class="prev-slide transition"><i class="fa fa-angle-left"></i></a>

                                    <a class="next-slide transition"><i class="fa fa-angle-right"></i></a>

                                </div>

                                <!--  navigation end-->

                            </div>

                            <!--  full-width-slider-holder  -->

                        </div>

                        <!--  resize-carousel-holder  -->

                    </div>

                    <!--  Content  end --> 

                     <?php get_template_part('template-parts/social-share');?>

                </div>

                <!-- Content holder  end -->