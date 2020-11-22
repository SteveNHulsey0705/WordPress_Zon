<?php defined('ABSPATH') or die("No script kiddies please!");?>
<?php $wr_options = get_option('wr_wp'); ?>
<!--=============== content-holder ===============-->
                <div class="content-holder elem scale-bg2 transition3">
                    <!-- Page title -->
                    <div class="dynamic-title"><?php the_title();?></div>
                    <!-- Page title  end--> 
                     <?php get_template_part('template-parts/menu-part');?>
                    <!--  Content  --> 
                    <div class="content ">
                        <section class="no-padding no-border">
						<?php if (( get_post_meta($post->ID,'rnr_port-filter',true))=='no'):?>
						
						<!-- gallery-items   -->
                            <div class="gallery-items   hid-port-info grid-small-pad">
							
                            <?php global $post, $post_id;?>
							<?php $showpost= get_post_meta($post->ID, 'rnr_portfolio-post-show', true);						
								$categoryname= get_post_meta($post->ID, 'rnr_portfolio-post-cat', true);						
								$paged=(get_query_var('paged'))?get_query_var('paged'):1;
								$loop = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page'=>$showpost, 'portfolio_category'=> $categoryname, 'paged'=>$paged ) ); ?>
								<?php while ( $loop->have_posts() ) : $loop->the_post();?>
				
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
                                <?php endwhile;
								wp_reset_postdata();?>
                               
                            </div>
                            <!-- end gallery items -->	
						<?php else: ?>
						
						<?php if(!get_post_meta(get_the_ID(), 'portfolio_category', true)):
						$portfolio_category = get_terms('portfolio_category');?>
						<?php if($portfolio_category):?>
                            <!-- Filters-->
                            <div class="filter-holder filter-nvis-column">
                                <div class="gallery-filters at">
                                    <a href="#" class="gallery-filter gallery-filter-active"  data-filter="*"><?php esc_attr_e('All','dogmawp');?></a>		
                                    <?php  foreach($portfolio_category as $portfolio_cat):?>
                                    <a href="#" class="gallery-filter " data-filter=".<?php echo esc_attr($portfolio_cat->slug);?>"><?php echo esc_attr($portfolio_cat->name);?></a>
									<?php endforeach;?>
                                </div>
                            </div>
                            <!-- filters end -->
                            <!-- filter-button   -->
                            <div class="filter-button vis-fc"><?php esc_attr_e('Filter','dogmawp');?></div>
                            <!-- filter-button end  -->
							<?php endif;?>
							<?php endif;?>
                            <!-- gallery-items   -->
                            <div class="gallery-items   hid-port-info grid-small-pad">
							
                            <?php global $post, $post_id;?>
							<?php query_posts(array('post_type' => 'portfolio','showposts' =>'-1'));
							while ( have_posts() ) : the_post();?>
				
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
                                <?php endwhile;
								wp_reset_postdata();?>
                               
                            </div>
                            <!-- end gallery items -->	
							<?php endif;?>
                        </section>
                    </div>
                    <!--  Content  end --> 
                    <?php get_template_part('template-parts/social-share');?>
                </div>
                <!-- Content holder  end -->