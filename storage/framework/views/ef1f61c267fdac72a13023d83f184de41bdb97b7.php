<?php $__env->startSection('content'); ?>
	<!-- post-page -->
	<section id="main" class="clearfix banner-post-page">
		<div class="container">

			<div class="breadcrumb-section">
				<!-- breadcrumb -->
				<ol class="breadcrumb">
					<li><a href="index.html">Home</a></li>
					<li>Ad Post</li>
				</ol><!-- breadcrumb -->						
			</div><!-- banner -->

				
				
			<div id="banner-post">
				<div class="row category-tab">	
					<div class="col-md-3 col-sm-6">
						<div class="section cat-option select-category post-option">
							<h5>Select a category</h5>
							<ul>
							<?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li><a href="<?php echo e(URL::to('ad-post')); ?>#sub-category" onclick="selectCat(<?php echo e($cat->id); ?>)">
									<span class="select cat_img">
									<?php if($cat->icon_photo!=null): ?>
										<img src='<?php echo e(asset("public/img/category/1/$cat->icon_photo")); ?>' alt="#" class="img-responsive">
									<?php else: ?>
										<i class="<?php echo e($cat->icon_class); ?>"></i>
									<?php endif; ?>
									</span>
									<?php echo e($cat->name); ?>

								</a></li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>
						</div>
					</div>
					<form action="<?php echo e(URL::to('ad-post/create')); ?>" method="GET">
						
					<!-- Tab panes -->
					<div class="col-md-3 col-sm-6 scroll-right" id="sub-category">
						<div id="loadSubCat">
						</div>
					</div>
					<!-- Tab panes -->
					
						<div id="loadLastCat" class="scroll-right2">
							
						</div>
					<input type="hidden" value="" id="category_id" required>
					<div class="col-md-3 col-sm-6 next-btn" style="display: none;" id="next-submit">
						<div class="section next-stap post-option">
							<p>Select category before click GO</p>
							<div class="btn-section">
								<button type="submit" class="btn btn-info">GO</button>
							</div>
							<!-- <p>Please DO NOT post multiple ads for the same items or service. All duplicate, spam and wrongly categorized ads will be deleted.</p> -->
						</div>
					</div><!-- next-stap -->
					</form>
				</div>
			</div>				
		</div><!-- container -->
	</section><!-- post-page -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
	function selectCat(id){
		$('.next-btn').css('display','none');
		$('#loadSubCat').load('<?php echo e(URL::to("loadSubCat")); ?>/'+id);
		$('#loadLastCat').html('');
		$('.scroll-right').css({'margin-left':'0px','opacity':'1'});
	}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>