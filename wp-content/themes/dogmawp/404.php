<?php defined('ABSPATH') or die("No script kiddies please!");?>
<?php $wr_options = get_option('wr_wp'); ?>
<?php
/*Template Name:404 Page*/
get_header();

 ?>
 <div class="back-link "><span><h2><?php esc_attr_e('404','dogmawp');?></h2> <br> <?php esc_attr_e('page not found.','dogmawp');?></span><a class="abl ajaxPageSwitchBacklink"><?php esc_attr_e('Back to the last page','dogmawp');?></a></div>
<?php get_footer(); ?>