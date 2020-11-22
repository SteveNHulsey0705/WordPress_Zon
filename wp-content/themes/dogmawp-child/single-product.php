<?php defined('ABSPATH') or die("No script kiddies please!");?>
<?php $wr_options = get_option('wr_wp');?>

<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
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
 * @version     1.6.4
 */


get_header();  ?> 
<style>
.show-hid-content, .related.products {display: none;}
</style>

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

                            <div class="content-nav">

                                <ul>

                                    <?php $previous_post = get_previous_post();

								 $url = is_object( $previous_post ) ? get_permalink( $previous_post->ID ) : '';
								  if($post->ID == 568) {$url = get_permalink(651); }


								 ?>

								 <?php  if ($previous_post) { ?>

                                    <li><a href="<?php echo esc_url( $url );?>" class="ajax ln"><i class="fa fa fa-angle-left"></i></a></li>

								<?php } else { if($post->ID == 568) {?><li><a href="<?php echo esc_url( $url );?>" class="ajax ln"><i class="fa fa fa-angle-left"></i></a></li> <?php } }?>

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
									 if($post->ID == 651) {$url = get_permalink(568); }
									
									?>

								<?php if ($next_post) { ?>	

                                    <li><a href="<?php echo esc_url( $url );?>" class="ajax rn"><i class="fa fa fa-angle-right"></i></a></li>

								<?php } else { if($post->ID == 651) { ?><li><a href="<?php echo esc_url( $url );?>" class="ajax rn"><i class="fa fa fa-angle-right"></i></a></li> <?php } } ?>

                                </ul>

                            </div>

                            <h3><?php the_title();?></h3>

                            <div class="separator"></div>

                            <div class="clearfix"></div>

                            <?php if(have_posts()) : while ( have_posts() ) : the_post();?>

                            <?php the_content(); 
							global $product;?>
							
                            
                            <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

	<p class="price"><?php echo $product->get_price_html(); ?></p>

	<meta itemprop="price" content="<?php echo esc_attr( $product->get_display_price() ); ?>" />
	<meta itemprop="priceCurrency" content="<?php echo esc_attr( get_woocommerce_currency() ); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

</div>
							
							<?php

if ( ! $product->is_purchasable() ) {
	return;
}

?>

<?php
	// Availability
	$availability      = $product->get_availability();
	$availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>';

	echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
?>

<?php if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart" method="post" enctype='multipart/form-data'>
	 	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

	 	<?php
	 		if ( ! $product->is_sold_individually() ) {
	 			woocommerce_quantity_input( array(
	 				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
	 				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product ),
	 				'input_value' => ( isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 )
	 			) );
	 		}
	 	?>

	 	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />

	 	<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>


							<?php endwhile;  endif; wp_reset_postdata(); 
							
							$woocommerce_loop;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

if ( ! $related = $product->get_related( $posts_per_page ) ) {
	return;
}

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $posts_per_page,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id ),
	'posts_per_page'       => 3
) );

$products                    = new WP_Query( $args );
$woocommerce_loop['name']    = 'related';
$woocommerce_loop['columns'] = apply_filters( 'woocommerce_related_products_columns', $columns );

if ( $products->have_posts() ) : ?>

	<div class="related products">
    <h3><?php _e( 'Related Products', 'woocommerce' ); ?></h3>
    <div class="separator"></div>

		<h2><?php _e( 'Related Products', 'woocommerce' ); ?></h2>

		<?php woocommerce_product_loop_start(); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php wc_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

		<?php woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_postdata(); ?>

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

                        <!--  resize-carousel-holder--> 

                        <div class="resize-carousel-holder anim-holder gallery-horizontal-holder">

                            <!--  gallery_horizontal-->

                            <div id="gallery_horizontal" class="gallery_horizontal owl_carousel">

                                <?php $images = rwmb_meta( 'rnr_portfolio-image','type=image&size=' );
								 global $product;
                                  $attachment_ids = $product->get_gallery_attachment_ids();

                                    foreach ( $attachment_ids as $image ){

                                        echo "<!-- gallery Item-->

                                <div class='horizontal_item'>

                                    <div class='zoomimage'><img src='".wp_get_attachment_url( $image )."' class='intense' alt=''><i class='fa fa-expand'></i></div>

                                    <img src='".wp_get_attachment_url( $image )."' alt=''>

                                    

                                </div>

                                <!-- gallery item end-->

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

								echo "<!-- gallery Item-->

                                <div class='horizontal_item'>

                                    <div class='ifarme-holder'>

                                        <iframe src=".$value."></iframe> 

                                    </div>

                                </div>

                                <!-- gallery item end-->";

								}

								};?>

                            </div>

                            <!--  gallery_horizontal end-->

                            <!--  navigation -->

                            <div class="customNavigation">

                                <a class="prev-slide transition"><i class="fa fa-angle-left"></i></a>

                                <a class="next-slide transition"><i class="fa fa-angle-right"></i></a>

                            </div>

                            <!--  navigation end-->

                        </div>

                        <!--  resize-carousel-holder end-->

                    </div>

                    <!--  Content  end --> 

                     <?php get_template_part('template-parts/social-share');?>

                </div>

                <!-- Content holder  end -->
       <?php get_footer(); ?> 