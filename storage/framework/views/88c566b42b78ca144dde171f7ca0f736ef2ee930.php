<?php $__env->startSection('content'); ?>
	<!-- main -->
	<section id="main" class="clearfix category-page main-categories">
		<div class="container">
			<div class="breadcrumb-section">
				<!-- breadcrumb -->
				<ol class="breadcrumb">
					<li><a href="<?php echo e(URL::to('/')); ?>">Home</a></li>
					<li><a href="<?php echo e(URL::to('/business-directory')); ?>">Business</a> </li>
					<li>
						<?php if(isset($category->sub_category_name)): ?>
							<?php echo e($category->sub_category_name); ?>

						<?php elseif(isset($category->name)): ?>
							<?php echo e($category->name); ?>

						<?php else: ?>
							All Business
						<?php endif; ?>
					</li>
				</ol><!-- breadcrumb -->						
			</div>
	
			<div class="category-info">	
				<div class="row">
					<div class="col-md-12">
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
					<!-- accordion-->
					<div class="col-md-3 col-sm-4 no-padding-right">
						<div class="accordion">
							<!-- panel-group -->
							<div class="panel-group" id="accordion">
							 	
								<!-- panel -->
								<div class="panel-default panel-faq">
									
									<!-- panel-heading -->
									<div class="panel-heading">
										<a data-toggle="collapse" data-parent="#accordion" href="#accordion-one">
											<h4 class="panel-title">Business Categories <i class="fa fa-angle-right pull-right"></i></h4>
										</a>
									</div><!-- panel-heading -->

									<div id="accordion-one" class="panel-collapse collapse collapse in">
										<!-- panel-body -->
										<div class="panel-body">
											<ul class="business-category" id="business-category">
											
											<?php $__currentLoopData = $businessCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<li><a data-toggle="collapse" data-parent="#business-category" href="#accordion-<?php echo e($bCat->id); ?>">
												<?php if($bCat->icon_photo!=null): ?>
												<img src='<?php echo e(asset("public/img/category/2/$bCat->icon_photo")); ?>' alt="#" class="img-responsive businessCatImg">
												<?php else: ?>
												<i class="<?php echo e($bCat->icon_class); ?>"></i>
												<?php endif; ?>
												<?php echo e($bCat->name); ?><span class="pull-right"><i class="fa fa-angle-right"></i></span></a>

												<?php if(count($businessSubCategory[$bCat->id])>0): ?>
												<div id="accordion-<?php echo e($bCat->id); ?>" class="panel-collapse collapse <?php echo e((isset($category) and $bCat->id==$category->fk_category_id)?'in':''); ?>" role="tabpanel">
													<div class="sub-business">
														<ul>
														<?php $__currentLoopData = $businessSubCategory[$bCat->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<li class="<?php echo e((isset($category) and $subCat->id==$category->id)?'active':''); ?>"><a href='<?php echo e(URL::to("business/$bCat->link/$subCat->id")); ?>'><i class="fa fa-angle-double-right"></i><?php echo e($subCat->sub_category_name); ?> </a></li>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
														</ul>
													</div>
												</div>
												<?php endif; ?>
												</li>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</ul>
										</div><!-- panel-body -->
									</div>
								
								</div><!-- panel -->

								<!-- panel -->
 
							 </div><!-- panel-group -->
						</div>
					</div><!-- accordion-->

					<!-- recommended-ads -->
					<div class="col-sm-8 col-md-7 no-padding-left">				
						<div class="section recommended-banner">
							<!-- featured-top -->
							<div class="featured-top business_header">
								<h2><?php if(isset($category->sub_category_name)): ?>
										<?php echo e($category->sub_category_name); ?> in Bangladesh
									<?php elseif(isset($page_title)): ?>
										<?php echo e($page_title); ?>

									<?php else: ?>
										All Business in Bangladesh
									<?php endif; ?>
						 			
						 		</h2>							
							</div><!-- featured-top -->	
							<?php if(count($business)==0): ?>
							<h2 class="text-danger">No Business Account found!</h2>
							<?php endif; ?>
							<!-- ad-item -->
							<? $adi=3; ?>
							<?php $__currentLoopData = $business->chunk(7); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bsns): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if($key>0): ?>
							<? $adi++; ?>
								<?php if(isset($banners[$adi])): ?>
								<div class="banners-section text-center">
									<?php if($banners[$adi]->is_photo==1): ?>
					                  <?php if($banners[$adi]->photo!=null): ?>
					                  <? $adPhoto=$banners[$adi]->photo; ?>
					                  <a href="<?php echo e($banners[$adi]->link); ?>" target="_blank">
					                  	<img class="img-responsive" src='<?php echo e(asset("public/img/banners/$adPhoto")); ?>' alt="<?php echo e($banners[$adi]->caption); ?>">
					                  </a>
					                  <?php endif; ?>
					                <?php else: ?>
					                <? echo $banners[$adi]->script ?>
					                <?php endif; ?>

								</div>
					            <?php endif; ?>
							<?php endif; ?>
							<?php $__currentLoopData = $bsns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="banner-item row">
								<!-- item-image -->
								<div class="item-image-box col-xs-4">
									<div class="item-image">
										<a href='<?php echo e(URL::to("business/$data->link")); ?>'><img src='<?php echo e(asset("images/business/profile/$data->profile_photo")); ?>' alt="<?php echo e($data->name); ?>" class="img-responsive"></a>
									</div><!-- item-image -->
								</div>
								
								<!-- rending-text -->
								<div class="item-info col-xs-8">
									<!-- ad-info -->
									<div class="post-info">
									<a href='<?php echo e(URL::to("business/$data->link")); ?>'>
										<h2 class="item-price"><?php echo e($data->name); ?></h2>
										<h5><?php echo e($data->title); ?></h5>
										<div class="item-cat">
											<span><i class="fa fa-map-marker"></i>  <?php echo e($data->location); ?></span>
										</div>	
									</a>									
									</div><!-- ad-info -->
								</div><!-- item-info -->
							</div><!-- ad-item -->
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

							
							<!-- pagination  -->
							<div class="text-center">
								<?php echo e($business->render()); ?>

							</div><!-- pagination  -->					
						</div>
						<div class="col-md-12">
						<?php if(isset($banners[3])): ?>
						<div class="banners-section">
							<?php if($banners[3]->is_photo==1): ?>
			                  <?php if($banners[3]->photo!=null): ?>
			                  <? $adPhoto=$banners[3]->photo; ?>
			                  <a href="<?php echo e($banners[3]->link); ?>" target="_blank">
			                  	<img class="img-responsive" src='<?php echo e(asset("public/img/banners/$adPhoto")); ?>' alt="<?php echo e($banners[3]->caption); ?>">
			                  </a>

			                  <?php endif; ?>
			                <?php else: ?>
			                <? echo $banners[3]->script ?>
			                <?php endif; ?>

						</div>
			            <?php endif; ?>
					</div>
					</div><!-- recommended-ads -->

					<div class="col-md-2 hidden-xs">
						<?php if(isset($banners[2])): ?>
						<div class="banners-section text-center">
							<?php if($banners[2]->is_photo==1): ?>
			                  <?php if($banners[2]->photo!=null): ?>
			                  <? $adPhoto=$banners[2]->photo; ?>
			                  <a href="<?php echo e($banners[2]->link); ?>" target="_blank">
			                  	<img class="img-responsive" src='<?php echo e(asset("public/img/banners/$adPhoto")); ?>' alt="<?php echo e($banners[2]->caption); ?>">
			                  </a>

			                  <?php endif; ?>
			                <?php else: ?>
			                <? echo $banners[2]->script ?>
			                <?php endif; ?>

						</div>
			            <?php endif; ?>
					</div>
				</div>	
			</div>
		</div><!-- container -->
	</section><!-- main -->
	
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
	$( document ).ready(function() {
	    var width1 = $(window).width();
		 if(width1<=974){
		 	$('#accordion-one').removeClass('in');
		 }else{
		 	$('#accordion-one').addClass('in');
		 }
	});
	 
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>