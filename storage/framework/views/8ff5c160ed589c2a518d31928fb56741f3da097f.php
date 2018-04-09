<?php $__env->startSection('content'); ?>
<!-- main -->
	<section id="main" class="clearfix details-page">
		<div class="container">
			
						
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
	

			<div class="section slider product_single">				
				<div class="row">
					<!-- carousel -->
					<div class="col-md-7">
						<div id="product-carousel" class="carousel slide" data-ride="carousel">
							<!-- Indicators -->
							<ol class="carousel-indicators">
							<? $path="images/post" ?>
								<?php if(file_exists("$path/small/$data->photo_one") and ($data->photo_one!=null)): ?>
								<li data-target="#product-carousel" data-slide-to="0" class="active">
									<img src='<?php echo e(asset("$path/small/$data->photo_one")); ?>' alt="Main Photo" class="img-responsive">
								</li>
								<?php else: ?>
								<li data-target="#product-carousel" data-slide-to="0" class="active">
									<img src='<?php echo e(asset("images/default.jpg")); ?>' alt="Main Photo" class="img-responsive">
								</li>
								<?php endif; ?>
								<?php if(file_exists("$path/small/$data->photo_two") and ($data->photo_two!=null)): ?>
								<li data-target="#product-carousel" data-slide-to="1">
									<img src='<?php echo e(asset("$path/small/$data->photo_two")); ?>' alt="Second Photo" class="img-responsive">
								</li>
								<?php endif; ?>
								<?php if(file_exists("$path/small/$data->photo_three") and ($data->photo_three!=null)): ?>
								<li data-target="#product-carousel" data-slide-to="2">
									<img src='<?php echo e(asset("$path/small/$data->photo_three")); ?>' alt="Third Photo" class="img-responsive">
								</li>
								<?php endif; ?>
								<?php if(file_exists("$path/small/$data->photo_four") and ($data->photo_four!=null)): ?>
								<li data-target="#product-carousel" data-slide-to="3">
									<img src='<?php echo e(asset("$path/small/$data->photo_four")); ?>' alt="Fourth Photo" class="img-responsive">
								</li>

								<?php endif; ?>
							</ol>

							<!-- Wrapper for slides -->
							<div class="carousel-inner" role="listbox">
								<!-- item -->
								<?php if(file_exists("$path/big/$data->photo_one") and ($data->photo_one!=null)): ?>
								<div class="item active">
									<div class="carousel-image">
										<!-- image-wrapper -->
										<img src='<?php echo e(asset("$path/big/$data->photo_one")); ?>' alt="Main Photo" class="img-responsive">
									</div>
								</div><!-- item -->
								<?php else: ?>
								<div class="item active">
									<div class="carousel-image">
										<!-- image-wrapper -->
										<img src='<?php echo e(asset("images/default.jpg")); ?>' alt="Main Photo" class="img-responsive">
									</div>
								</div><!-- item -->
								<?php endif; ?>

								<?php if(file_exists("$path/big/$data->photo_two") and ($data->photo_two!=null)): ?>
								<!-- item -->
								<div class="item">
									<div class="carousel-image">
										<!-- image-wrapper -->
										<img src='<?php echo e(asset("$path/big/$data->photo_two")); ?>' alt="Second Photo" class="img-responsive">
									</div>
								</div><!-- item -->
								<?php endif; ?>

								<?php if(file_exists("$path/big/$data->photo_three") and ($data->photo_three!=null)): ?>
								<!-- item -->
								<div class="item">
									<div class="carousel-image">
										<!-- image-wrapper -->
										<img src='<?php echo e(asset("$path/big/$data->photo_three")); ?>' alt="Third Photo" class="img-responsive">
									</div>
								</div><!-- item -->
								<?php endif; ?>

								<?php if(file_exists("$path/big/$data->photo_four") and ($data->photo_four!=null)): ?>
								<!-- item -->
								<div class="item">
									<div class="carousel-image">
										<!-- image-wrapper -->
										<img src='<?php echo e(asset("$path/big/$data->photo_four")); ?>' alt="Fourth Photo" class="img-responsive">
									</div>
								</div><!-- item -->
								<?php endif; ?>
							</div><!-- carousel-inner -->

							<!-- Controls -->
							<a class="left carousel-control" href="#product-carousel" role="button" data-slide="prev">
								<i class="fa fa-chevron-left"></i>
							</a>
							<a class="right carousel-control" href="#product-carousel" role="button" data-slide="next">
								<i class="fa fa-chevron-right"></i>
							</a><!-- Controls -->
						</div>
					</div><!-- Controls -->	

					<!-- slider-text -->
					<div class="col-md-5">
						<div id="adDelete" style="display: none;">
							<div class="col-md-12 no-padding">
							    <div class="alert alert-danger alert-dismissable">
							        <h4>Do you want to delete this ad?</h4>
							        <b><?php echo e($data->title); ?></b>
							        <br>
							        <br>
							        <?php echo e(Form::open(array('route'=>['ad-post.destroy',$data->id],'method'=>'DELETE','class'=>'frontend_del_btn'))); ?>

			            				<button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Delete this ad" >Yes</button>
			        				<?php echo Form::close(); ?>

			        				<button type="button" class="btn btn-danger" onclick='return deleteCancel()'>Cancel</button>
							       </div>
							</div>
						</div>
						<div id="adPostInfo">
							<div class="col-md-12 no-padding">
								<div class="">
									<a href='<?php echo e(URL::to("ad-post/$data->id/edit")); ?>' class="btn btn-xs btn-info"><i class="fa fa-pencil-square"></i> Edit</a>
									<button class="btn btn-xs btn-danger" onclick='return deleteConfirm()'><i class="fa fa-trash"></i> Delete</button>
									<a href='<?php echo e(URL::to("my-ads")); ?>' class="btn btn-xs btn-success"><i class="fa fa-bars"></i> My ads</a>
								</div>
								<hr>
							</div>
						</div>
					
						
						<div class="slider-text">
							<h1 class="title"><?php echo e($data->title); ?></h1>
							<p><span><i class="fa fa-user"></i> <a href="#"><?php echo e($data->creator); ?></a></span>
							<span> <i class="fa fa-eye"></i><a class="time"><?php echo e($data->visitor); ?></a></span></p>
							<h3>Tk. <?php echo e($data->price); ?></h3>
							<span class="icon"><i class="fa fa-clock-o"></i><?php echo e(date('jS M, Y h:i A',strtotime($data->created_at))); ?></span><br>
							<span class="icon"><i class="fa fa-map-marker"></i><?php echo e($data->address); ?><br><i></i> - <?php echo e($data->area_name); ?>, <?php echo e($data->division_name); ?></span>
							<br>
							<span class="icon"><i class="fa fa-folder"></i><a href="#"><?php echo e($data->cat_name); ?></a>/ <a href=""><?php echo e($data->sub_category_name); ?></a><a href="#"> <?php echo e(isset($data->last_step_category_name)?'/ '.$data->last_step_category_name:''); ?></a></span>
							<!-- contact-with -->
							<div class="contact-with">
								<h4>Contact with </h4>
								<span class="btn btn-red show-number">
									<i class="fa fa-phone-square"></i>
									<span class="hide-text">Click to show phone number </span> 
									<span class="hide-number">
										<?php $__currentLoopData = $mobile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $number): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php echo e($number->mobile_number); ?><br>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</span>
								</span>
								<a href="mailto:<?php echo e($data->email); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e($data->email); ?>" class="btn"><i class="fa fa-envelope-square"></i>Reply by email</a>
							</div><!-- contact-with -->
							
							<!-- social-links -->
							<div class="social-links">
								<h4>Share this ad</h4>
								<ul class="list-inline">
									<li><a href="#" title="Share with facebook"><i class="fa fa-facebook-square"></i></a></li>
									<li><a href="#" title="Share with twitter"><i class="fa fa-twitter-square"></i></a></li>
									<li><a href="#" title="Share with google plus"><i class="fa fa-google-plus-square"></i></a></li>
									<li><a href="#" title="Share with linkedin"><i class="fa fa-linkedin-square"></i></a></li>
								</ul>
							</div><!-- social-links -->						
						</div>
					</div><!-- slider-text -->				
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
							<h4>Short Info</h4>
							<!-- social-icon -->
							<ul>
								<li><i class="fa fa-bars"></i><strong>Condition: </strong><?php echo e(($data->condition==1)?'New':'Used'); ?></li>
								
								<?php if($data->brand_name!=null): ?>
								<li><i class="fa fa-bars"></i><a href="#"><strong>Brand: </strong><?php echo e($data->brand_name); ?></a></li>
								<?php endif; ?>
								<?php $__currentLoopData = $postField; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li><i class="fa fa-bars"></i><strong><?php echo e($field->title); ?>: </strong><?php echo e($field->field_value); ?></li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php $__currentLoopData = $extraPart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li><i class="fa fa-bars"></i><strong><?php echo e($part['title']); ?>: </strong><?php echo e($part['field_value']); ?> <?php echo e($part['field_value2']); ?> </li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<li><i class="fa fa-shopping-cart"></i><a>Delivery: Meet in person</a></li>
								<li><i class="fa fa-heart-o"></i><a href="#">Save ad as Favorite</a></li>
							</ul><!-- social-icon -->
						</div>
					</div>
				</div><!-- row -->
			</div><!-- description-info -->	
			
			<div class="recommended-info">
				<div class="row">
					<div class="col-sm-8">				
						<div class="section recommended-ads">
							<div class="featured-top">
								<h4>Others ad</h4>
							</div>
							<?php $__currentLoopData = $othersAd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="ad-item row">
								<!-- item-image -->
								<div id="adDelete<?php echo e($ad->id); ?>" style="display: none;">
									<div class="col-md-12 no-padding">
									    <div class="alert alert-danger alert-dismissable">
									        <h4>Do you want to delete this ad?</h4><br>
									        <b><?php echo e($ad->title); ?></b>
									        <br>
									        <br>
									        <?php echo e(Form::open(array('route'=>['ad-post.destroy',$ad->id],'method'=>'DELETE','class'=>'frontend_del_btn'))); ?>

					            				<button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Delete this ad" >Yes</button>
					        				<?php echo Form::close(); ?>

					        				<button type="button" class="btn btn-danger" onclick='return deleteCancel1("<?php echo e($ad->id); ?>")'>Cancel</button>
									       </div>
									</div>
								</div>
								<div id="adPostInfo<?php echo e($ad->id); ?>">
									<div class="item-image-box col-sm-3">
										<div class="item-image">
										<? $photo= "images/post/small/$ad->photo_one";
										?>
											<a href='<?php echo e(URL::to("ad-post/$ad->id/$ad->link")); ?>' title="<?php echo e($ad->title); ?>" >
											<?php if(($ad->photo_one!=null) and file_exists($photo) ): ?>
											<img src='<?php echo e(asset("images/post/small/$ad->photo_one")); ?>' alt="<?php echo e($ad->title); ?>" class="img-responsive">
											<?php else: ?>
											<img src='<?php echo e(asset("images/smallDefault.jpg")); ?>' alt="<?php echo e($ad->title); ?>" class="img-responsive">
											<?php endif; ?>
											</a>
										</div><!-- item-image -->
									</div>
									
									<!-- rending-text -->
									<div class="item-info col-sm-9">
										<!-- ad-info -->
										<div class="ad-info">
											<h3 class="item-price">Tk. <?php echo e($ad->price); ?></h3>
											<h4 class="item-title"><a href='<?php echo e(URL::to("ad-post/$ad->id/$ad->link")); ?>'  title="<?php echo e($ad->title); ?>"><?php echo e($ad->title); ?></a></h4>
											<div class="item-cat">
												<span><a href='<?php echo e(URL::to("ad-post/$ad->id/$ad->link")); ?>'><?php echo e($ad->cat_name); ?></a></span> /
												<span><a href='<?php echo e(URL::to("ad-post/$ad->id/$ad->link")); ?>'><?php echo e($ad->sub_category_name); ?></a></span>
												<?php if($ad->last_step_category_name!=null): ?>
												 / <span><a href='<?php echo e(URL::to("ad-post/$ad->id/$ad->link")); ?>'><?php echo e($ad->last_step_category_name); ?></a></span>
												<?php endif; ?>
											</div>										
										</div><!-- ad-info -->
									
										<!-- ad-meta -->
										<div class="ad-meta">
											<div class="meta-content">
												<span class="dated"> <a><i class="fa fa-clock-o"></i> <?php echo e(date('jS M, Y h:i A',strtotime($ad->created_at))); ?></a></span>
												<?php if($ad->is_approved!=0): ?>
												<span class="visitors"><i class="fa fa-eye"></i> <?php echo e($ad->visitor); ?></span>
												<?php else: ?>
												<span class="pending text-warning">Pending</span>
												<?php endif; ?>
											</div>										
											<!-- item-info-right -->
											<div class="user-option pull-right">
												<a class="edit-item" href='<?php echo e(URL::to("ad-post/$ad->id/edit")); ?>' data-toggle="tooltip" data-placement="top" title="Edit this ad"><i class="fa fa-pencil"></i></a>
					            				<button class="btn btn-xs btn-danger" onclick='return deleteConfirm1("<?php echo e($ad->id); ?>")' data-toggle="tooltip" data-placement="top" title="Delete this ad" ><i class="fa fa-times"></i></button>
											</div><!-- item-info-right -->
										</div><!-- ad-meta -->
									</div><!-- item-info -->
								</div>
								
							</div><!-- ad-item -->
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div><!-- recommended-ads -->

					<div class="col-sm-4 text-center">
						<?php echo $__env->make('frontend._partials.support', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					</div><!-- recommended-cta-->
				</div><!-- row -->
			</div><!-- recommended-info -->
		</div><!-- container -->
	</section><!-- main -->
	
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
	<script type="text/javascript">
		function deleteConfirm(id){
			$('#adDelete').css('display','block');
			$('#adPostInfo').css('display','none');
		}
		function deleteCancel(id){
			$('#adDelete').css('display','none');
			$('#adPostInfo').css('display','block');
		}

		function deleteConfirm1(id){
			$('#adDelete'+id).css('display','block');
			$('#adPostInfo'+id).css('display','none');
		}
		function deleteCancel1(id){
			$('#adDelete'+id).css('display','none');
			$('#adPostInfo'+id).css('display','block');
		}
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>