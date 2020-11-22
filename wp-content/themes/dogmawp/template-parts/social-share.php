<?php defined('ABSPATH') or die("No script kiddies please!");?>
<?php $wr_options = get_option('wr_wp');?>

 <?php if ($wr_options['showshare']=="no") {?>

				<?php }

				else{
				?>
				<!-- share  -->
<div class="share-inner">
    <div class="share-container  isShare"  data-share="['facebook','googleplus','twitter','linkedin']"></div>
    <div class="close-share"></div>
</div>
  <!-- share end -->
				<?php }?>