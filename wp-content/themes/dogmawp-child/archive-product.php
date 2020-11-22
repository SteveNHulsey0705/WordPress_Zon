<?php defined('ABSPATH') or die("No script kiddies please!");?>

<?php $wr_options = get_option('wr_wp');?>
<?php 
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
  get_header();
defined('ABSPATH') or die("No script kiddies please!");?>
<style>
.woocommerce #wrapper {
    height: inherit !important;
}

#ascrail2000, .nicescroll-cursors { background-color: transparent !important;}
</style>
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

                            <!-- fixed-info-container -->

                            <div class="fixed-info-container">

							<?php if(!get_post_meta(get_the_ID(), 'product_cat', true)):

							$portfolio_category = get_terms('product_cat');?>

							<?php if($portfolio_category):?>

                                <!-- Filters-->

                                <div class="filter-holder filter-vis-column">

                                    <div class="gallery-filters">

                                        <a href="#" class="gallery-filter gallery-filter-active"  data-filter="*"><?php esc_attr_e('All','dogmawp');?></a>

										<?php  foreach($portfolio_category as $portfolio_cat):?>										

                                        <a href="#" class="gallery-filter " data-filter=".<?php echo esc_attr($portfolio_cat->slug);?>"><?php echo esc_attr($portfolio_cat->name);?></a>

									    <?php endforeach;?>

                                        

                                    </div>

                                </div>

                                <!-- Filters end -->

							<?php endif;?>

							<?php endif;?>

                            </div>

                            <!-- fixed-info-container end-->

                            <!-- filters end -->

                            <!-- resize-carousel-holder-->

                            <div class="resize-carousel-holder vis-info">

                                <!-- gallery-items -->

                                <div class="gallery-items   hid-port-info">

                                   <?php global $post, $post_id;?>

									<?php query_posts(array('post_type' => 'product'));

									while ( have_posts() ) : the_post();?>

						

									<?php $portfolio_category = wp_get_post_terms($post->ID,'product_cat');?>

									<?php foreach ($portfolio_category as $item);?>

                                <!-- portfolio item -->	

                                    <div class="gallery-item <?php echo (get_post_meta($post->ID,'rnr_post-box-width',true)) ?> <?php echo esc_attr($item->slug . ' ');?>">

                                    <div class="grid-item-holder">

                                        <div class="box-item">

                                            <div class="wh-info-box">

                                                <div class="wh-info-box-inner at">

                                                    <a href="<?php the_permalink();?>" class="ajax">

                                                    <?php the_title();?>                                                

                                                    </a>

                                                    <span class="folio-cat"><?php echo esc_attr($item->name . ' ');?></span>

                                                </div>

                                            </div>

											<?php  if (has_post_thumbnail( $post->ID ) ):

											$wr_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'dg_portfolio_image' );?>

                                            <img  src="<?php echo esc_url($wr_image[0]);?>"   alt="<?php the_title();?>">

											<?php endif;?>

                                        </div>

                                    </div>

                                </div>

                                    <!-- 1 end -->

                                    <?php endwhile;

									wp_reset_postdata();?>

                                </div>

                                <!-- end gallery items -->

                            </div>

                        </section>

                    </div>

                    <!--  Content  end --> 

                    <?php get_template_part('template-parts/social-share');?>

                </div>

                <!-- Content holder  end -->
                
                <?php get_footer(); ?>	