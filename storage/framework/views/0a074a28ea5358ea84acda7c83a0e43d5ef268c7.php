<div class="col-md-3 col-sm-6">
	<div class="section tab-content lastcategory post-option">
		<h4>Select a subcategory</h4>
			<ul>
				<?php $__currentLoopData = $lastCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lastCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<li class="lastcategory-list<?php echo e($lastCat->id); ?>"><a href="<?php echo e(URL::to('ad-post')); ?>#next-submit"  onclick="finalStep(<?php echo e($lastCat->id); ?>)"><?php echo e($lastCat->last_step_category_name); ?> <span class="pull-right final-check"><i class="fa fa-check-circle"></i></span></a></li>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</ul>
	</div>
</div>
<script src="<?php echo e(asset('public/frontend/js/jquery.min.js')); ?>"></script>
<script type="text/javascript">
	function finalStep(id){
		$('.final-check i').css({'opacity':'0','font-size':'25px'});
		$('.lastcategory-list'+id+' .final-check i').css({'opacity':'1','font-size':'18px'});
		$('.next-btn').css('display','block');
		$('.lastcategory .link-active').removeClass('link-active');
		$('.lastcategory-list'+id).addClass('link-active');
		$('#category_id').val(id);
		$('#category_id').attr('name','subcategory');
	}
</script>