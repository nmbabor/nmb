<div class="section tab-content subcategory post-option">
	<h4>Select a subcategory</h4>
		<ul>
			<?php $__currentLoopData = $subCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $subCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<li class="subcategory-list<?php echo e($subCat->id); ?>">
			<?php if($lastStep[$key]>0): ?>
				<a href="<?php echo e(URL::to('ad-post')); ?>#last-sub-category" onclick="selectSubCat(<?php echo e($subCat->id); ?>)">
				<?php echo e($subCat->sub_category_name); ?> <span class="pull-right"><i class="fa fa-angle-right"></i></span></a>
			<?php else: ?>
				<a href="<?php echo e(URL::to('ad-post')); ?>#next-submit" onclick="finalSubCat(<?php echo e($subCat->id); ?>)">
				<?php echo e($subCat->sub_category_name); ?> <span class="pull-right final-check"><i class="fa fa-check-circle"></i></span></a>

			<?php endif; ?>
			</li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</ul>	
</div>
<script src="<?php echo e(asset('public/frontend/js/jquery.min.js')); ?>"></script>
<script type="text/javascript">
	function selectSubCat(id){
		$('.final-check i').css({'opacity':'0','font-size':'25px'});
		$('.next-btn').css('display','none');
		$('#loadLastCat').load('<?php echo e(URL::to("loadLastCat")); ?>/'+id);
		$('.subcategory .link-active').removeClass('link-active');
		$('.subcategory-list'+id).addClass('link-active');
		$('.scroll-right2').css({'margin-left':'0px','opacity':'1'});
	}
	function finalSubCat(id){
		$('.final-check i').css({'opacity':'0','font-size':'25px'});
		$('.next-btn').css('display','block');
		$('.subcategory-list'+id+' .final-check i').css({'opacity':'1','font-size':'18px'});
		$('#loadLastCat').html('');
		$('.subcategory .link-active').removeClass('link-active');
		$('.subcategory-list'+id).addClass('link-active');
		$('.scroll-right2').css({'margin-left':'0px','opacity':'1'});
		$('#category_id').val(id);
		$('#category_id').attr('name','category');

	}
</script>