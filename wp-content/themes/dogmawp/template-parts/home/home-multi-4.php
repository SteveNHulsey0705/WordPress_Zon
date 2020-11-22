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
                            <!-- 1 -->
                            <div class="hero-grid">
                                <div class="hero-slider  owl-carousel" data-attime="3220" data-rtlt="false">
                                    <?php $wr_images = rwmb_meta( 'rnr_wr_mu_slide_show1','type=image&size=menu-feature-img' );
                                    foreach ( $wr_images as $image ){
                                        echo "<div class='item'><div class='bg' style='background-image:url({$image['url']})'></div></div>
								   ";
									 };?>
                                </div>
                            </div>
                            <!-- 1 end -->
                            <!-- 2 -->
                            <div class="hero-grid">
                                <div class="hero-slider owl-carousel" data-attime="3220" data-rtlt="false">
                                   <?php $wr_images = rwmb_meta( 'rnr_wr_mu_slide_show2','type=image&size=menu-feature-img' );
                                    foreach ( $wr_images as $image ){
                                        echo "<div class='item'><div class='bg' style='background-image:url({$image['url']})'></div></div>
								   ";
									 };?>
                                </div>
                            </div>
                            <!-- 2end -->
                            <!-- 3 -->
                            <div class="hero-grid">
                                <div class="hero-slider owl-carousel"  data-attime="3220" data-rtlt="true">
                                    <?php $wr_images = rwmb_meta( 'rnr_wr_mu_slide_show3','type=image&size=menu-feature-img' );
                                    foreach ( $wr_images as $image ){
                                        echo "<div class='item'><div class='bg' style='background-image:url({$image['url']})'></div></div>
								   ";
									 };?>
                                </div>
                            </div>
                            <!-- 3end -->
                            <!-- 4 -->
                            <div class="hero-grid">
                                <div class="hero-slider owl-carousel" data-attime="3220" data-rtlt="true">
                                    <?php $wr_images = rwmb_meta( 'rnr_wr_mu_slide_show4','type=image&size=menu-feature-img' );
                                    foreach ( $wr_images as $image ){
                                        echo "<div class='item'><div class='bg' style='background-image:url({$image['url']})'></div></div>
								   ";
									 };?>
                                </div>
                            </div>
                            <!-- 4end -->
                            <div class="overlay"></div>
                            <!-- enter-wrap -->
                            <div class="enter-wrap-holder cent-holder wht-bg">
                                <div class="enter-wrap">
                                    <?php if (( get_post_meta($post->ID,'rnr_home_content',true))):?>
                                    <h3> <?php echo balanceTags(get_post_meta($post->ID,'rnr_home_content',true)); ?></h3>
								<?php endif;?>
                                    
									
								<?php if (( get_post_meta($post->ID,'rnr_home_bt_url2',true))):?>
								    
									<?php if (( get_post_meta($post->ID,'rnr_home_bt_url',true))):?>
                                    <a href="<?php echo esc_attr(get_post_meta($post->ID,'rnr_home_bt_url',true)); ?>" class="<?php echo (get_post_meta($post->ID,'rnr_intro-link-option1',true)) ?> btn anim-button   trans-btn  wr-multi-button-4 transition "><span><?php if (( get_post_meta($post->ID,'rnr_home_bt_txt',true))):?><?php echo esc_attr(get_post_meta($post->ID,'rnr_home_bt_txt',true)); ?><?php else:?><?php esc_attr_e('Enter site','dogmawp');?><?php endif;?></span><i class="fa fa-long-arrow-right"></i></a>
								    <?php endif;?>
									
                                    <a href="<?php echo esc_attr(get_post_meta($post->ID,'rnr_home_bt_url2',true)); ?>" class="<?php echo (get_post_meta($post->ID,'rnr_intro-link-option2',true)) ?> btn anim-button   trans-btn  wr-multi-button transition "><span><?php if (( get_post_meta($post->ID,'rnr_home_bt_txt2',true))):?><?php echo esc_attr(get_post_meta($post->ID,'rnr_home_bt_txt2',true)); ?><?php else:?><?php esc_attr_e('Enter site','dogmawp');?><?php endif;?></span><i class="fa fa-long-arrow-right"></i></a>
								<?php else:?>
								<?php if (( get_post_meta($post->ID,'rnr_home_bt_url',true))):?>
                                    <a href="<?php echo esc_attr(get_post_meta($post->ID,'rnr_home_bt_url',true)); ?>" class="<?php echo (get_post_meta($post->ID,'rnr_intro-link-option1',true)) ?> btn anim-button   trans-btn  transition "><span><?php if (( get_post_meta($post->ID,'rnr_home_bt_txt',true))):?><?php echo esc_attr(get_post_meta($post->ID,'rnr_home_bt_txt',true)); ?><?php else:?><?php esc_attr_e('Enter site','dogmawp');?><?php endif;?></span><i class="fa fa-long-arrow-right"></i></a>
								    <?php endif;?>
								<?php endif;?>
                                </div>
                            </div>
                            <!-- enter-wrap end  -->
                        </div>
                        <!-- full-height-wrap end  -->  
                    </div>
                    <!-- Content   end -->	 
                    <?php get_template_part('template-parts/social-share');?>
                </div>
                <!-- Content holder  end -->