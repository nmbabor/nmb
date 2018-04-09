<?php $__env->startSection('content'); ?>
<section id="main" class="clearfix  ad-profile-page">
	<div class="container">
	
		<div class="breadcrumb-section">
			<!-- breadcrumb -->
			<ol class="breadcrumb">
				<li><a href="<?php echo e(URL::to('/')); ?>">Home</a></li>
				<li><a href="<?php echo e(URL::to('/business')); ?>">Business</a></li>
				<li><?php echo e($data->name); ?></li>
			</ol><!-- breadcrumb -->						
		</div><!-- banner -->	

		<div class="profile">
			<div class="row">
				<div class="col-sm-10">
					<div class="business-section">
						<!-- profile-details -->
						<div class="profile-details section">
							<div class="business-profile">
								<div class="cover-photo">
									<img class="cover img-responsive" src='<?php echo e(asset("images/business/cover/$data->cover_photo")); ?>' alt="Cover Photo">
									<div class="profile-info">
									<img class="img-responsive profile-photo" src='<?php echo e(asset("images/business/profile/$data->profile_photo")); ?>' alt="Profile Photo">
									<h2><?php echo e($data->name); ?></h2>
										
									</div>
								</div>
								<div class="business-details">
									<div class="col-md-8">
										<h3><?php echo e($data->title); ?></h3>
										<div>

										  <!-- Nav tabs -->
										  <ul class="nav nav-tabs" role="tablist">
										    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">About <span class="hidden-xs">Organization </span></a></li>
										    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><span class="hidden-xs"> Product or </span> Services </a></li>
										  </ul>

										  <!-- Tab panes -->
										  <div class="tab-content">
										    <div role="tabpanel" class="tab-pane active" id="home">
										    	<? echo $data->description ?>
										    </div>
										    <div role="tabpanel" class="tab-pane" id="profile">
										    	<? echo $data->services ?>
										    </div>
										  </div>

										</div>
									</div>
									<div class="col-md-4">
										<ul>
											<li>
												<h4>Business: <?php echo e($data->sub_category_name); ?></h4>
											</li>
											<li>
												<h4><i class="fa fa-clock-o"></i> Opening Time</h4>
												<h5>Open Hours :<b> <?php echo e($data->open_hour); ?></b></h5>
												<h5 class="text-danger">Close Day :<b> <?php echo e($data->closed_day); ?></b></h5>
											</li>
											<li>
												<h4><i class="fa fa-map-marker"></i> <?php echo e($data->location); ?></h4>
											</li>
											<li>
												<h4><i class="fa fa-phone-square"></i> <?php echo e($data->contact_phone); ?></h4>
											</li>
											<li>
												<h4><i class="fa fa-envelope"></i> <?php echo e($data->contact_email); ?></h4>
											</li>
											<?php if($data->website!=null): ?>
											<li>
												<h4><i class="fa fa-globe"></i> <a href="<?php echo e($data->website); ?>" target="_blank"><?php echo e($data->website); ?></a></h4>
											</li>
											<?php endif; ?>
										</ul>
									</div>
								</div>
								<div class="bannerPost">
									<div class="col-md-8">
									<h4>All Ads</h4><hr>
							
							<?php if(count($adPost)==0): ?>
								<h4>No ads found!</h4>
							<?php endif; ?>
							<?php $__currentLoopData = $adPost; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="banner-item row">
								<!-- item-image -->
									<div class="item-image-box col-xs-3">
										<div class="item-image">
										<? $photo= "images/post/small/$ad->photo_one";
										?>
											<a href='<?php echo e(URL::to("ad/$ad->link")); ?>' title="<?php echo e($ad->title); ?>" >
										<?php if($ad->type!=3): ?>
											<?php if(($ad->photo_one!=null) and file_exists($photo) ): ?>
											<img src='<?php echo e(asset("images/post/small/$ad->photo_one")); ?>' alt="<?php echo e($ad->title); ?>" class="img-responsive">
											<?php else: ?>
											<img src='<?php echo e(asset("images/smallDefault.jpg")); ?>' alt="<?php echo e($ad->title); ?>" class="img-responsive">
											<?php endif; ?>
										<?php else: ?>
											<? $business=DB::table('business_account')->where('fk_user_id',$ad->created_by)->first();?>
												<?php if(($business!=null) and ($business->profile_photo!=null) and file_exists("images/business/profile/$business->profile_photo")): ?>
												<img src='<?php echo e(asset("images/business/profile/$business->profile_photo")); ?>' alt="<?php echo e($ad->title); ?>" class="img-responsive">
												<?php else: ?>
												<img src='<?php echo e(asset("images/smallDefault.jpg")); ?>' alt="<?php echo e($ad->title); ?>" class="img-responsive">
												<?php endif; ?>
										<?php endif; ?>

											</a>
										</div><!-- item-image -->
									</div>
									
									<!-- rending-text -->
									<div class="item-info col-xs-9">
										<!-- ad-info -->
										<div class="post-info">
											<h3 class="item-price">Tk. <?php echo e($ad->price); ?></h3>
											<h4 class="item-title"><a href='<?php echo e(URL::to("ad/$ad->link")); ?>'  title="<?php echo e($ad->title); ?>"><?php echo e($ad->title); ?></a></h4>
											<div class="item-cat">
												<?php if($ad->last_step_category_name!=null): ?>
												 <span><?php echo e($ad->last_step_category_name); ?></span>
												<?php endif; ?>
											</div>
											<div>
												<span class="dated"> <a><i class="fa fa-clock-o"></i> <?php echo e(date('jS M, Y h:i A',strtotime($ad->created_at))); ?></a></span>
											</div>										
										</div><!-- ad-info -->
									</div><!-- item-info -->
								
								
							</div><!-- ad-item -->
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<div>
							<?php echo e($adPost->render()); ?>

						</div>
									</div>
									<div class="col-md-4">
										
									</div>
								</div>
							</div>
						</div><!-- profile-details -->
					</div><!-- user-pro-edit -->
				</div><!-- profile -->

				<div class="col-sm-2 text-center no-padding">
					<?php if(isset($banners[1])): ?>
						<div class="banners-section text-center">
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
				</div><!-- recommended-cta-->
			</div><!-- row -->	
		</div>				
	</div><!-- container -->
</section><!-- ad-profile-page -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>