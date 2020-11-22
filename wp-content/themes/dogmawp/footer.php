<?php defined('ABSPATH') or die("No script kiddies please!");?>
<?php $wr_options = get_option('wr_wp'); ?> 
</div>
            <!-- wrapper end -->
            <!--=============== footer ===============-->
            <footer>
                <div class="policy-box">
                    <?php $copy = AfterSetupTheme::return_thme_option('copyright');
					  echo apply_filters('the_content',$copy);
					 ?>
                </div>
                <div class="footer-social">
				 <?php if ($wr_options['social-menu']=="st2") {?>
				 <ul class="wr-footer-menu">
				 <?php

										$defaults = array(
													'theme_location'  => 'footer-menu',
													'menu'            => 'nav',
													'container'       => '',
													'container_class' => '',
													'menu_class'      => 'navbar-main-menu',
													'menu_id'         => '',
													'echo'            => true,
													'fallback_cb'     => 'wp_page_menu',
													'before'          => '',
													'after'           => '',
													'link_before'     => '',
													'link_after'      => '',
													'items_wrap'      => '%3$s',
													'depth'           => 0,
													
														);
								if(has_nav_menu('footer-menu')) {
														wp_nav_menu( $defaults );
								}
										  else {
											echo '<li><a>No menu assigned!</a></li>';
										  }
														?>
				 </ul>
				 <?php } else { ?>
                    <ul>
						<?php if(!empty($wr_options['facebook'])):?>
                        <li><a href="<?php echo esc_url($wr_options['facebook']);?>" target="_blank" ><i class="fa fa-facebook"></i><span><?php esc_attr_e('facebook','dogmawp');?></span></a></li>
						<?php endif;?>
						<?php if(!empty($wr_options['twitter'])):?>
                        <li><a href="<?php echo esc_url($wr_options['twitter']);?>" target="_blank"><i class="fa fa-twitter"></i><span><?php esc_attr_e('twitter','dogmawp');?></span></a></li>
						<?php endif;?>
						<?php if(!empty($wr_options['instagram'])):?>
                        <li><a href="<?php echo esc_url($wr_options['instagram']);?>" target="_blank" ><i class="fa fa-instagram"></i><span><?php esc_attr_e('instagram','dogmawp');?></span></a></li>
						<?php endif;?>
						<?php if(!empty($wr_options['pinterest'])):?>
                        <li><a href="<?php echo esc_url($wr_options['pinterest']);?>" target="_blank" ><i class="fa fa-pinterest"></i><span><?php esc_attr_e('pinterest','dogmawp');?></span></a></li>
						<?php endif;?>
						<?php if(!empty($wr_options['tumblr'])):?>
                        <li><a href="<?php echo esc_url($wr_options['tumblr']);?>" target="_blank" ><i class="fa fa-tumblr"></i><span><?php esc_attr_e('tumblr','dogmawp');?></span></a></li>
						<?php endif;?>
						<?php if(!empty($wr_options['gplus'])):?>
                        <li><a href="<?php echo esc_url($wr_options['gplus']);?>" target="_blank" ><i class="fa fa-google-plus"></i><span><?php esc_attr_e('google+','dogmawp');?></span></a></li>
						<?php endif;?>
						<?php if(!empty($wr_options['linkedin'])):?>
                        <li><a href="<?php echo esc_url($wr_options['linkedin']);?>" target="_blank" ><i class="fa fa-linkedin"></i><span><?php esc_attr_e('linkedin','dogmawp');?></span></a></li>
						<?php endif;?>
						<?php if(!empty($wr_options['youtube'])):?>
                        <li><a href="<?php echo esc_url($wr_options['youtube']);?>" target="_blank" ><i class="fa fa-youtube"></i><span><?php esc_attr_e('youtube','dogmawp');?></span></a></li>
						<?php endif;?>
						
						<?php if(!empty($wr_options['slack'])):?>
                        <li><a href="<?php echo esc_url($wr_options['slack']);?>" target="_blank" ><i class="fa fa-slack"></i><span><?php esc_attr_e('slack','dogmawp');?></span></a></li>
						<?php endif;?>
						<?php if(!empty($wr_options['vimeo'])):?>
                        <li><a href="<?php echo esc_url($wr_options['vimeo']);?>" target="_blank" ><i class="fa fa-vimeo"></i><span><?php esc_attr_e('vimeo','dogmawp');?></span></a></li>
						<?php endif;?>
												
						<?php if(!empty($wr_options['behance'])):?>
                        <li><a href="<?php echo esc_url($wr_options['behance']);?>" target="_blank" ><i class="fa fa-behance"></i><span><?php esc_attr_e('behance','dogmawp');?></span></a></li>
						<?php endif;?>
						
                    </ul>
					<?php }?>
                </div>
            </footer>
            <!-- footer end -->
        </div>
        <!-- Main end -->
<?php wp_footer(); ?>
</body>
</html>