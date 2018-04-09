<?php $__env->startSection('content'); ?>
<!-- myads-page -->
	<section id="main" class="clearfix mypost-page">
		<div class="container">

			<div class="breadcrumb-section">
				<!-- breadcrumb -->
				<ol class="breadcrumb">
					<li><a href="index.html">Home</a></li>
					<li><?php echo e($title); ?> Ad</li>
				</ol><!-- breadcrumb -->
			</div><!-- banner -->

			<?php echo $__env->make('frontend.profile.profileHeader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>			
			
			<div class="posts-info">
				<div class="row">
						
					<div class="col-sm-10">
						
						<div class="my-post section">
							<h2><?php echo e($title); ?> ads</h2>
							<!-- ad-item -->
							<?php if(count($adPost)==0): ?>
								<h3>You have no ads!</h3>
							<?php endif; ?>
							<?php $__currentLoopData = $adPost; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="banner-item row">
								<!-- item-image -->
								<div id="adDelete<?php echo e($ad->id); ?>" style="display: none;">
									<div class="col-md-12 no-padding">
									    <div class="alert alert-danger alert-dismissable">
									        <b>Do you want to delete this ad?</b><br>
									        <b><?php echo e($ad->title); ?></b>
									        <br>
									        <?php echo e(Form::open(array('route'=>['ad-post.destroy',$ad->id],'method'=>'DELETE','class'=>'frontend_del_btn'))); ?>

					            				<button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Delete this ad" >Yes</button>
					        				<?php echo Form::close(); ?>

					        				<button type="button" class="btn btn-danger" onclick='return deleteCancel("<?php echo e($ad->id); ?>")'>Cancel</button>
									       </div>
									</div>
								</div>
								<div id="adPostInfo<?php echo e($ad->id); ?>">
									<div class="item-image-box col-xs-3">
										<div class="item-image">
										<? $photo= "images/post/small/$ad->photo_one";
										?>
											<a href='<?php echo e(URL::to("ad-post/$ad->id/$ad->link")); ?>' title="<?php echo e($ad->title); ?>" >
											<?php if($ad->type!=3): ?>
												<?php if(($ad->photo_one!=null) and file_exists($photo) ): ?>
												<img src='<?php echo e(asset("images/post/small/$ad->photo_one")); ?>' alt="<?php echo e($ad->title); ?>" class="img-responsive dashboard-img">
												<?php else: ?>
												<img src='<?php echo e(asset("images/smallDefault.jpg")); ?>' alt="<?php echo e($ad->title); ?>" class="img-responsive dashboard-img">
												<?php endif; ?>
											<?php else: ?>
												<?php if((count($business)>0) and ($business->profile_photo!=null) and file_exists("images/business/profile/$business->profile_photo") ): ?>
												<img src='<?php echo e(asset("images/business/profile/$business->profile_photo")); ?>' alt="<?php echo e($ad->title); ?>" class="img-responsive dashboard-img">
												<?php else: ?>
												<img src='<?php echo e(asset("images/smallDefault.jpg")); ?>' alt="<?php echo e($ad->title); ?>" class="img-responsive dashboard-img">
												<?php endif; ?>
											<?php endif; ?>
											</a>
										</div><!-- item-image -->
									</div>
									
									<!-- rending-text -->
									<div class="item-info col-xs-9">
										<!-- ad-info -->
										<div class="post-info">
											<h2 class="item-title"><a href='<?php echo e(URL::to("ad-post/$ad->id/$ad->link")); ?>'  title="<?php echo e($ad->title); ?>"><?php echo e($ad->title); ?></a></h2>
											<?php if($ad->type!=3): ?>
												<h3 class="item-price">Tk. <?php echo e($ad->price); ?></h3>
											<?php else: ?>
												<h3 class="item-price"><?php echo e(Auth::user()->name); ?></h3>
												<h5>Tk. <?php echo e($ad->price); ?> <?php echo e(($ad->price2!=null)?' - '.$ad->price2: ''); ?></h5>
											<?php endif; ?>

											<div class="item-cat">
												<?php if($ad->last_step_category_name!=null): ?>
												 <span><a href='<?php echo e(URL::to("ad-post/$ad->id/$ad->link")); ?>'><?php echo e($ad->last_step_category_name); ?></a></span>
												<?php else: ?>
												<span><a href='<?php echo e(URL::to("ad-post/$ad->id/$ad->link")); ?>'><?php echo e($ad->sub_category_name); ?></a></span>
												<?php endif; ?>
													<?php if($title!='Pending'): ?>
													<span class="visitors"><i class="fa fa-eye"></i> <?php echo e($ad->visitor); ?></span>
													<?php else: ?>
													<span class="pending"><?php echo e($title); ?></span>
													<?php endif; ?>
												<div class="user-option pull-right">
													<a class="edit-item btn btn-info btn-xs" href='<?php echo e(URL::to("ad-post/$ad->id/edit")); ?>' data-toggle="tooltip" data-placement="top" title="Edit this ad"><i class="fa fa-pencil text-danger"></i></a>
						            				<button class="btn btn-xs btn-danger" onclick='return deleteConfirm("<?php echo e($ad->id); ?>")' data-toggle="tooltip" data-placement="top" title="Delete this ad" ><i class="fa fa-times"></i></button>
												</div><!-- item-info-right -->
											</div>										
										</div><!-- ad-info -->
									</div><!-- item-info -->
								</div>
							</div><!-- ad-item -->
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div><!-- my-ads -->

					<!-- recommended-cta-->
					<div class="col-sm-2 no-padding-left">
						<?php echo $__env->make('frontend._partials.support', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					</div><!-- recommended-cta-->				
					
				</div><!-- row -->
			</div><!-- row -->
		</div><!-- container -->
	</section><!-- myads-page -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

	<script type="text/javascript">
		
	function deleteConfirm(id){
		$('#adDelete'+id).css('display','block');
		$('#adPostInfo'+id).css('display','none');
	}
	function deleteCancel(id){
		$('#adDelete'+id).css('display','none');
		$('#adPostInfo'+id).css('display','block');
	}
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>