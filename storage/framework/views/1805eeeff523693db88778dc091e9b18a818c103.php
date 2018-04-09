<?php $__env->startSection('content'); ?>
<section id="main" class="clearfix category-page main-categories">
	<div class="container">
		<div class="breadcrumb-section">
			<!-- breadcrumb -->
			<ol class="breadcrumb">
				<li><a href="<?php echo e(URL::to('/')); ?>">Home</a></li>
				<li>All Directory</li>
			</ol><!-- breadcrumb -->						
		</div>
		<div class="main-content section">
			<h2 class="entry-title no-margin">Business Directory in Bangladesh</h2>
			<hr>
			<div class="col-md-12 no-padding">
				<?php if(isset($banners[1])): ?>
				<div class="banners-section">
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
			</div>
			<ul class="directory-list">
			<?php $__currentLoopData = $businessCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<li><a href='<?php echo e(URL::to("business/cat/$bCat->link")); ?>'><?php echo e($bCat->short_Description); ?></a>
					<ul>
						<?php $__currentLoopData = $businessSubCategory[$bCat->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<li><a href='<?php echo e(URL::to("business/$bCat->link/$sub->id")); ?>'><?php echo e($sub->sub_category_name); ?>, </a></li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
				</li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</ul>
		</div>
	</div>
</section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>