<?
$banners=DB::table('ad_manager')->where(['fk_page_id'=>7,'status'=>1])->get()->keyBy('serial_num');
?>
<div class="recommended-cta">					

		<?php if(isset($banners[1])): ?>
			<div class="side-banner-section">
				<?php if($banners[1]->is_photo==1): ?>
		          <?php if($banners[1]->photo!=null): ?>
		          <? $adPhoto=$banners[1]->photo; ?>
		          <a href="<?php echo e($banners[1]->link); ?>" target="_blank">
		          	<img class="img-responsive" src='<?php echo e(asset("public/img/banners/$adPhoto")); ?>' alt="<?php echo e($banners[1]->caption); ?>">
		          </a>

		          <?php endif; ?>
		        <?php else: ?>
		        <? echo $banners[1]->script ?>
		        <?php endif; ?>

			</div>
		    <?php endif; ?>
</div><!-- cta -->
