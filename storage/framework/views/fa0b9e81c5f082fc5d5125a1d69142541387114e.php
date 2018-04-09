<div class="col-md-10 no-padding">
	<div class="section recommended-ads">
		<!-- featured-top -->
		<div class="featured-top all_post">
		<h2><?php echo e(isset($page_title)?$page_title:'Recommended Post for You'); ?></h2>					
		</div><!-- featured-top -->	

			<?php if(count($adPost)==0): ?>
					<h3>No ads found!</h3>
			<?php endif; ?>
		<? $adi=0; ?>
		<?php $__currentLoopData = $adPost->chunk(9); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if($key>0): ?>
		<? $adi++; ?>
			<?php if(isset($banners[4])): ?>
			<div class="banners-section text-center">
				<?php if($banners[4]->is_photo==1): ?>
                  <?php if($banners[4]->photo!=null): ?>
                  <? $adPhoto=$banners[4]->photo; ?>
                  <a href="<?php echo e($banners[4]->link); ?>" target="_blank">
                  	<img class="img-responsive" src='<?php echo e(asset("public/img/banners/$adPhoto")); ?>' alt="<?php echo e($banners[4]->caption); ?>">
                  </a>

                  <?php endif; ?>
                <?php else: ?>
                <? echo $banners[4]->script ?>
                <?php endif; ?>

			</div>
            <?php endif; ?>
		<?php endif; ?>
			<?php $__currentLoopData = $post; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="banner-item row catWiseItem">
				
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
						<? $business=DB::table('business_account')->where('fk_user_id',$ad->created_by)->first();
						
						?>
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
							<h2 class="item-title"><a href='<?php echo e(URL::to("ad/$ad->link")); ?>'  title="<?php echo e($ad->title); ?>"><?php echo e($ad->title); ?></a></h2>
							<?php if($ad->type!=3): ?>
							<h3 class="item-price">Tk. <?php echo e($ad->price); ?></h3>
								<?php if($ad->last_step_category_name!=null): ?>
								 <span><a href='<?php echo e(URL::to("ads/$ad->cat_link/$ad->sub_id/$ad->last_id")); ?>'><?php echo e($ad->last_step_category_name); ?></a></span>
								 <?php else: ?>
								 <span><a href='<?php echo e(URL::to("ads/$ad->cat_link/$ad->sub_id")); ?>'><?php echo e($ad->sub_category_name); ?></a></span>
								<?php endif; ?>
							<?php else: ?>
							<? $businessLink=($business!=null and $business->link!=null)?$business->link:''; ?>
							<h3 class="item-price"><a href='<?php echo e(URL::to("business/$businessLink")); ?>'><i class="fa fa-user"></i> <?php echo e($ad->creator); ?></a></h3>
							<h4>Salary: <?php echo e($ad->price); ?> <?php echo e(($ad->price2!=null)?' - '.$ad->price2: ''); ?></h4>

							<?php endif; ?>
							<div class="item-cat">
								<div>
								<span><?php echo e($ad->area_name); ?>, <?php echo e($ad->division_name); ?></span>
								</div>
							</div>										
						</div><!-- ad-info -->
					</div><!-- item-info -->
				
				
			</div><!-- ad-item -->
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<!-- pagination  -->
		<div>
			<?php echo e($adPost->render()); ?>

		</div><!-- pagination  -->	
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
</div>
<div class="col-md-2 no-padding">
	<?php if(isset($banners[2])): ?>
	<div class="side-banner-section">
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