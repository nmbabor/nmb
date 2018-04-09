<?php $__env->startSection('content'); ?>
<!-- main -->
<section id="main" class="clearfix category-page main-categories">
	<div class="container">
		<?php echo $__env->make('frontend.ad.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<div class="category-info">	
			<div class="row">
				<!-- accordion-->
				
				<!-- recommended-ads -->
				<div class="col-sm-8 col-md-9">
					<?php echo $__env->make('frontend.ad.ad', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div><!-- recommended-ads -->
				<div class="col-md-3 col-sm-4">
					<div class="accordion">
						<!-- panel-group -->
						<div class="panel-group" id="accordion">
						 	
							<!-- panel -->
							<div class="panel-default panel-faq">
								<!-- panel-heading -->
								<div class="panel-heading active-faq">
									<a data-toggle="collapse" data-parent="#accordion" href="#accordion-one">
										<h4 class="panel-title">All Categories<span class="pull-right"><i class="fa fa-minus"></i></span></h4>
									</a>
								</div><!-- panel-heading -->

								<div id="accordion-one" class="panel-collapse collapse collapse in">
									<!-- panel-body -->
									<div class="panel-body">
										<ul>

											<?php $__currentLoopData = $productCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<li><a href='<?php echo e(URL::to("ads/bangladesh/$cat->link")); ?>'>
												<?php if($cat->icon_photo!=null): ?>
												<img src='<?php echo e(asset("public/img/category/1/$cat->icon_photo")); ?>' alt="#" class="img-responsive businessCatImg">
												<?php else: ?>
												<i class="<?php echo e($cat->icon_class); ?>"></i>
												<?php endif; ?>
												<?php echo e($cat->name); ?><span>(<?php echo e($cat->ad); ?>)</span></a></li>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											
										</ul>
									</div><!-- panel-body -->
								</div>
							</div><!-- panel -->

							<!-- panel -->
							<div class="panel-default panel-faq">
								<!-- panel-heading -->
								<div class="panel-heading active-faq">
									<a data-toggle="collapse" data-parent="#accordion" href="#accordion-location">
										<h4 class="panel-title">Location<span class="pull-right"><i class="fa fa-minus"></i></span></h4>
									</a>
								</div><!-- panel-heading -->

								<div id="accordion-location" class="panel-collapse collapse collapse in">
									<!-- panel-body -->
									<div class="panel-body">
										<ul>

											<?php $__currentLoopData = $division; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $div): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<li><a href='<?php echo e(URL::to("ads/$div->link")); ?>'>
												<?php echo e($div->name); ?><span>(<?php echo e($div->ad); ?>)</span></a></li>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											
										</ul>
									</div><!-- panel-body -->
								</div>
							</div><!-- panel -->
							<!-- panel -->
							
						 </div><!-- panel-group -->
					</div>
				</div><!-- accordion-->

			</div>	
		</div>
	</div><!-- container -->
</section><!-- main -->




<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>