<?php $__env->startSection('content'); ?>
<!-- main -->
	<section id="main" class="clearfix details-page">
		<div class="container">
			
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
			<div class="section banner">				
				<!-- banner-form -->
				<div class="banner-form banner-form-full">
					<form action="#">
						<!-- category-change -->
							
						<?php echo e(Form::select('category',$category,'',['class'=>'form-control','placeholder'=>'Select category'])); ?>

						<?php echo e(Form::select('category',$division_town,'',['class'=>'form-control','placeholder'=>'Select location'])); ?>

					
						<input type="text" class="form-control" placeholder="Type Your key word">
						<button type="submit" class="form-control" value="Search">Search</button>
					</form>
				</div><!-- banner-form -->
			</div><!-- banner -->
	

			<div class="section slider">				
				<div class="row">
					<!-- carousel -->
					<div class="col-md-12">
					   <?php if(Session::has('success')): ?>
						<div class="col-md-12">
						    <div class="alert alert-success alert-dismissable">
						        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						       <b><?php echo Session::get('success'); ?></b> 
						       </div>
						</div>
						<?php elseif(Session::has('error')): ?>
						  <div class="col-md-12">
						    <div class="alert alert-danger alert-dismissable">
						        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						       <b><?php echo Session::get('error'); ?></b> 
						       </div>
						  </div>
						<?php endif; ?>
					</div>
					<!-- slider-text -->
					<div class="col-md-8">
						<div class="col-md-3">
							<? $business=DB::table('business_account')->where('fk_user_id',$data->created_by)->first(); ?>
							<?php if(($business!=null) and ($business->profile_photo!=null) and file_exists("images/business/profile/$business->profile_photo")): ?>
								<img src='<?php echo e(asset("images/business/profile/$business->profile_photo")); ?>' alt="<?php echo e($data->title); ?>" class="img-responsive">
							<?php else: ?>
								<img src='<?php echo e(asset("images/smallDefault.jpg")); ?>' alt="<?php echo e($data->title); ?>" class="img-responsive">
							<?php endif; ?>
						</div>
						<div class="col-md-9 slider-text">
							<h1 class="title"><?php echo e($data->title); ?></h1>
							<? $businessLink=($business!=null and $business->link!=null)?$business->link:''; ?>
							<h2><span><i class="fa fa-user"></i> <a href='<?php echo e(URL::to("business/$businessLink")); ?>'><?php echo e($data->creator); ?></a></span>
							</h2>
							<h3>Salary: <?php echo e($data->price); ?> <?php echo e(($data->price2!=null)?' - '.$data->price2: ''); ?></h3>
							<span class="icon"><i class="fa fa-map-marker"></i><?php echo e(($data->address!=null)?$data->address.', ':''); ?> <?php echo e($data->area_name); ?>, <?php echo e($data->division_name); ?></span>					
						</div>
						
					</div><!-- slider-text -->
					<div class="col-md-4">
						<div class="text-right job-apply-btn">
						 <?php if(Auth::check()): ?>
						 <? $job=DB::table('job_application')->where(['fk_user_id'=>Auth::user()->id,'fk_post_id'=>$data->id])->count(); ?>
							 <?php if($job>0): ?>
							 	<button class="btn btn-success"><i class="fa fa-check-square-o" aria-hidden="true"></i> Applied </button>
							 <?php else: ?>
								<button class="btn btn-info" data-toggle="modal" data-target="#jobApplyModal"><i class="fa fa-file-text-o" aria-hidden="true"></i> Apply for job</button>
							<?php endif; ?>
						<?php else: ?>
							<button class="btn btn-info" data-toggle="modal" data-target="#jobApplyModal"><i class="fa fa-file-text-o" aria-hidden="true"></i> Apply for job</button>
						<?php endif; ?>
						</div>
						 <!-- Modal -->
								<div class="modal fade" id="jobApplyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog" role="document">
								    <div class="modal-content">
								    <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        <h4 class="modal-title" id="myModalLabel">Are you sure you want to apply ? </h4>
								      </div>
								      <div class="modal-body ">
								        <input type="hidden" name="form" value="language">
								        <input type="hidden" name="id" value="<?php echo e($data->id); ?>">
								        <h4 class="text-centers"><?php echo e($data->title); ?><br><small><?php echo e($data->creator); ?></small></h4>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
								        <a href='<?php echo e(URL::to("job-apply/$data->id")); ?>' class="btn btn-primary">Confirm</a>
								      </div>
								    </div>
								  </div>
								</div><!-- /Delete Modal -->
							<!-- social-links -->
							<div class="social-links text-right">
								<h4>Share this Post</h4>
								<div id="share"></div>
							</div><!-- social-links -->	
					</div>
					<div class="col-md-12">
						<hr>
							
						</div>
						<? $count= count($postField);
							$pics=ceil($count/2);
						 ?>
						<?php $__currentLoopData = $postField->chunk($pics); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fields): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="col-md-6">
							<ul class="job-post-field">
								<?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li>
								<div class="col-md-6">
									<i class="fa fa-angle-double-right"></i> <strong><?php echo e($field->title); ?> </strong>
								</div>
								<div class="col-md-6">
								: &nbsp;&nbsp;&nbsp;<?php echo e($field->field_value); ?>

								</div>
								</li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul><!-- social-icon -->
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>				
			</div><!-- slider -->
			<div class="description-info">
				<div class="row">
					<!-- description -->
					<div class="col-md-8">
						<div class="description">
							<h4>Description</h4>
							<? echo $data->description ?>
						</div>
					</div><!-- description -->

					<!-- description-short-info -->
					<div class="col-md-4">					
						<div class="short-info">
							<img src='<?php echo e(URL::to("images/ad/single.png")); ?>' class="img-responsive">
						</div>
					</div>
				</div><!-- row -->
			</div><!-- description-info -->	
			
			<div class="recommended-info">
				<div class="row">
					<div class="col-sm-12 no-padding">				
						<div class="section recommended-banner">
							<div class="featured-top">
								<h4>Recommended Job for You</h4>
							</div>
							<?php $__currentLoopData = $othersAd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="banner-item col-md-6">

									<div class="item-image-box col-xs-3">
										<div class="item-image">
											<a href='<?php echo e(URL::to("ad/$ad->link")); ?>' title="<?php echo e($ad->title); ?>" >
											<? $business=DB::table('business_account')->where('fk_user_id',$ad->created_by)->first(); ?>
												<?php if(($business!=null) and file_exists("images/business/profile/$business->profile_photo")): ?>
												<img src='<?php echo e(asset("images/business/profile/$business->profile_photo")); ?>' alt="<?php echo e($ad->title); ?>" class="img-responsive">
												<?php else: ?>
												<img src='<?php echo e(asset("images/smallDefault.jpg")); ?>' alt="<?php echo e($ad->title); ?>" class="img-responsive">
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
												 <span><a href='<?php echo e(URL::to("ad-post/$ad->id/$ad->link")); ?>'><?php echo e($ad->last_step_category_name); ?></a></span>
												 <?php else: ?>
												 <span><a href='<?php echo e(URL::to("ad-post/$ad->id/$ad->link")); ?>'><?php echo e($ad->sub_category_name); ?></a></span>
												<?php endif; ?>
												<div>
												<span><?php echo e($ad->area_name); ?>, <?php echo e($ad->division_name); ?></span>
												</div>
											</div>

										</div><!-- ad-info -->
									</div><!-- item-info -->
								
								
							</div><!-- ad-item -->
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div><!-- recommended-ads -->
				</div><!-- row -->
			</div><!-- recommended-info -->
		</div><!-- container -->
	</section><!-- main -->
	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    $("#share").jsSocials({
      url:"<?php echo e(URL::to('')); ?>",
      shareIn: "popup",
      text: '<?php echo e($data->title); ?> | <?php echo e(URL::to("$data->link")); ?>',
      showLabel: false,
      showCount: false,
      shares: ["facebook", "email", "twitter", "googleplus", "linkedin"]
    });
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>