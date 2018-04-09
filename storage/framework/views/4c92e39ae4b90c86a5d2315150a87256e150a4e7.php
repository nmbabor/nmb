<?php $__env->startSection('content'); ?>
<!-- main -->
	<section id="main" class="clearfix ad-details-page">
		<div class="container">
		
			<div class="breadcrumb-section">
				<!-- breadcrumb -->
				<ol class="breadcrumb">
					<li><a href="<?php echo e(URL::to('')); ?>">Home</a></li>
					<li><?php echo e($category->name); ?></li>
				</ol><!-- breadcrumb -->						
			</div><!-- banner -->

			<div class="adpost-details">
				<div class="row">	
					<div class="col-md-9">
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
					<div class="col-md-9">
					
						<?php echo Form::open(array('route' => 'ad-post.store','class'=>'form-horizontal','files'=>true, 'data-toggle'=>'validator','role'=>'form')); ?>

							<fieldset>
								<div class="section postdetails">
									<h4><?php echo e($category->sub_category_name); ?> <span class="pull-right">* Mandatory Fields</span></h4>
									
									<div class="form-group selected-product">
										<ul class="select-category list-inline">
											<li>
												<a>
													<span class="select no-margin">
														<i class="fa fa-bars" aria-hidden="true"></i>
													</span>
													<?php echo e($category->name); ?>

												</a>
											</li>
											<li class="<?php echo e((isset($category->last_id))?'':'active'); ?>">
												<a>
													<?php echo e($category->sub_category_name); ?>

													<input type="hidden" name="fk_sub_category_id" value="<?php echo e($category->sub_id); ?>">
												</a>
											</li>
											<?php if(isset($category->last_id)): ?>
											<li class="active">
												<a><?php echo e($category->last_step_category_name); ?></a>
												<input type="hidden" name="fk_last_step_id" value="<?php echo e($category->last_id); ?>">
											</li>
											<?php endif; ?>
										</ul>
										<a class="edit" href="<?php echo e(URL::to('ad-post')); ?>"><i class="fa fa-pencil"></i>Edit</a>
									</div>
									<div class="row form-group <?php echo e($errors->has('fk_division_id') ? ' has-error' : ''); ?>">
										<?
										$divisionId=$userInfo->fk_division_id;
										$areaId=$userInfo->fk_area_id;
										?>
										<label class="col-sm-3"> Location <span class="required">*</span></label>
										<div class="col-sm-4">
										<?php echo e(Form::select('fk_division_id',$division_town,$divisionId,['class'=>'form-control','onchange'=>"loadArea(this.value)"])); ?>

											<div class="help-block with-errors"></div>
											<?php if($errors->has('fk_division_id')): ?>
							                    <span class="help-block">
							                        <strong><?php echo e($errors->first('fk_division_id')); ?></strong>
							                    </span>
								            <?php endif; ?>
										</div>
										<div class="col-sm-5">
											<div id="loadArea">
											<?php echo e(Form::select('fk_area_id',$area,$areaId,['class'=>'form-control'])); ?>

											</div>
											<div class="help-block with-errors"></div>
												<?php if($errors->has('fk_area_id')): ?>
								                    <span class="help-block">
								                        <strong><?php echo e($errors->first('fk_area_id')); ?></strong>
								                    </span>
									            <?php endif; ?>
										</div>
										
									</div>
									<div class="row form-group <?php echo e($errors->has('address') ? ' has-error' : ''); ?>">
										<label class="col-sm-3">Specific Address<span class="required"></span></label>
										<div class="col-sm-9">
										<?php echo e(Form::text('address',$userInfo->address,['class'=>'form-control','placeholder'=>'Specific Address'])); ?>

											<div class="help-block with-errors"></div>
											<?php if($errors->has('address')): ?>
							                    <span class="help-block">
							                        <strong><?php echo e($errors->first('address')); ?></strong>
							                    </span>
								            <?php endif; ?>
										</div>
									</div>
								<?php if($category->post_type!=2): ?>
									<div class="row form-group <?php echo e($errors->has('type') ? ' has-error' : ''); ?>">
										<label class="col-sm-3"> Type of ad <span class="required">*</span></label>
										<div class="col-sm-9 user-type">
										
											<input type="radio" name="type" value="1" id="newsell" checked required> <label for="newsell" > I want to sell </label>
											<input type="radio" name="type" value="2" id="newbuy" required> <label for="newbuy">want to buy</label>
											<div class="help-block with-errors"></div>
											<?php if($errors->has('type')): ?>
							                    <span class="help-block">
							                        <strong><?php echo e($errors->first('type')); ?></strong>
							                    </span>
								            <?php endif; ?>
										</div>
									</div>
									<div class="row form-group add-title <?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
										<label class="col-sm-3 label-title">Title for your Ad<span class="required">*</span></label>
										<div class="col-sm-9">
										<?php echo e(Form::text('title','',['class'=>'form-control','placeholder'=>'Ex: Sony Xperia dual sim 100% brand new','required'])); ?>

											<div class="help-block with-errors"></div>
											<?php if($errors->has('title')): ?>
							                    <span class="help-block">
							                        <strong><?php echo e($errors->first('title')); ?></strong>
							                    </span>
								            <?php endif; ?>
										</div>
									</div>
									<div class="row form-group <?php echo e($errors->has('photo_one') ? ' has-error' : ''); ?>  <?php echo e($errors->has('photo_two') ? ' has-error' : ''); ?>  <?php echo e($errors->has('photo_three') ? ' has-error' : ''); ?>  <?php echo e($errors->has('photo_four') ? ' has-error' : ''); ?> add-image">
										<label class="col-sm-3 label-title">Photos for your ad </label>
										<div class="col-sm-9">
											<p><span>The first photo is your main photo. You must upload the first photo.</span></p>
											<div class="upload-section">
												<label class="upload-image" for="upload-image-one">
													<input type="file" id="upload-image-one" name="photo_one" onchange="loadPhoto(this,'loadImage1')" required>
												<img id="loadImage1" class="img-responsive" style="display: none">
												</label>

												<label class="upload-image" for="upload-image-two">
													<input type="file" id="upload-image-two" name="photo_two" onchange="loadPhoto(this,'loadImage2')">
												<img id="loadImage2" class="img-responsive" style="display: none">
												</label>											
												<label class="upload-image" for="upload-image-three">
													<input type="file" id="upload-image-three" name="photo_three" onchange="loadPhoto(this,'loadImage3')">
												<img id="loadImage3" class="img-responsive" style="display: none">
												</label>										

												<label class="upload-image" for="upload-imagefour">
													<input type="file" id="upload-imagefour" name="photo_four" onchange="loadPhoto(this,'loadImage4')">
												<img id="loadImage4" class="img-responsive" style="display: none">
												</label>
											</div>
											<div id="errorPhoto">
												
											</div>
											<?php if($errors->has('photo_one')): ?>
							                    <span class="help-block">
							                        <strong><?php echo e($errors->first('photo_one')); ?></strong>
							                    </span>
							                    <br>
								            <?php endif; ?>
								            
								            <?php if($errors->has('photo_two')): ?>
							                    <span class="help-block">
							                        <strong><?php echo e($errors->first('photo_two')); ?></strong>
							                    </span>
								            <br>
								            <?php endif; ?>
								            <?php if($errors->has('photo_three')): ?>
							                    <span class="help-block">
							                        <strong><?php echo e($errors->first('photo_three')); ?></strong>
							                    </span>
								            <br>
								            <?php endif; ?>
								            <?php if($errors->has('photo_four')): ?>
							                    <span class="help-block">
							                        <strong><?php echo e($errors->first('photo_four')); ?></strong>
							                    </span>
								            <br>
								            <?php endif; ?>
										</div>
									</div>
									<div class="row form-group <?php echo e($errors->has('condition') ? ' has-error' : ''); ?> select-condition">
										<label class="col-sm-3">Condition<span class="required">*</span></label>
										<div class="col-sm-9">
											<input type="radio" name="condition" value="2" id="used" required> 
											<label for="used">Used</label>
											<input type="radio" name="condition" value="1" id="new" required> 
											<label for="new">New</label>
											<div class="help-block with-errors"></div>
											<?php if($errors->has('condition')): ?>
							                    <span class="help-block">
							                        <strong><?php echo e($errors->first('condition')); ?></strong>
							                    </span>
								            <?php endif; ?>
											
										</div>
									</div>
									<div class="row form-group  <?php echo e($errors->has('price') ? ' has-error' : ''); ?> select-price">
										<label class="col-sm-3 label-title">Price<span class="required">*</span></label>
										<div class="col-sm-6">
											<?php echo e(Form::number('price','',['class'=>'form-control','min'=>'0','step'=>'any','placeholder'=>'TK'])); ?>



											<div class="help-block with-errors"></div>
											<?php if($errors->has('price')): ?>
							                    <span class="help-block">
							                        <strong><?php echo e($errors->first('price')); ?></strong>
							                    </span>
								            <?php endif; ?>
										</div>
										<div class="col-md-3">
											<div class="checkbox">
												<div class="form-group <?php echo e($errors->has('is_negotiable') ? ' has-error' : ''); ?> col-md-12">
												<label for="negotiable">
													<input name="is_negotiable" type="checkbox" id="negotiable">Negotiable
												</label>
												<div class="help-block with-errors"></div>
													<?php if($errors->has('is_negotiable')): ?>
									                    <span class="help-block">
									                        <strong><?php echo e($errors->first('is_negotiable')); ?></strong>
									                    </span>
										            <?php endif; ?>
												</div>
											</div>
											
										</div>
									</div>
								<?php else: ?>
								<input type="hidden" name="type" value="3">
								<input type="hidden" name="condition" value="1">
								<div class="row form-group add-title <?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
									<label class="col-sm-3 label-title">Job Title<span class="required">*</span></label>
									<div class="col-sm-9">
									<?php echo e(Form::text('title','',['class'=>'form-control','placeholder'=>'Ex: Digital Marketing Executive','required'])); ?>

										<div class="help-block with-errors"></div>
										<?php if($errors->has('title')): ?>
						                    <span class="help-block">
						                        <strong><?php echo e($errors->first('title')); ?></strong>
						                    </span>
							            <?php endif; ?>
									</div>
								</div>
								<div class="row form-group  <?php echo e($errors->has('price') ? ' has-error' : ''); ?> select-price">
										<label class="col-sm-3 label-title">Salary (per month)<span class="required"></span></label>
										<div class="col-sm-3">
											<?php echo e(Form::number('price','',['class'=>'form-control','min'=>'0','step'=>'any','placeholder'=>'From'])); ?>

											<div class="help-block with-errors"></div>
											<?php if($errors->has('price')): ?>
							                    <span class="help-block">
							                        <strong><?php echo e($errors->first('price')); ?></strong>
							                    </span>
								            <?php endif; ?>
										</div>
										<div class="col-sm-3">
											<?php echo e(Form::number('price2','',['class'=>'form-control','min'=>'0','step'=>'any','placeholder'=>'To'])); ?>

											<div class="help-block with-errors"></div>
											<?php if($errors->has('price2')): ?>
							                    <span class="help-block">
							                        <strong><?php echo e($errors->first('price2')); ?></strong>
							                    </span>
								            <?php endif; ?>
										</div>
										<div class="col-md-3">
											<div class="checkbox">
												<div class="form-group <?php echo e($errors->has('is_negotiable') ? ' has-error' : ''); ?> col-md-12">
												<label for="negotiable">
													<input name="is_negotiable" type="checkbox" id="negotiable">Negotiable
												</label>
												<div class="help-block with-errors"></div>
													<?php if($errors->has('is_negotiable')): ?>
									                    <span class="help-block">
									                        <strong><?php echo e($errors->first('is_negotiable')); ?></strong>
									                    </span>
										            <?php endif; ?>
												</div>
											</div>
											
										</div>
									</div>


								<?php endif; ?>
									<!-- Brand load by category -->
									<?php if(count($brand)>0): ?>
									<div class="row form-group  <?php echo e($errors->has('fk_brand_id') ? ' has-error' : ''); ?> brand-name">
										<label class="col-sm-3 label-title">Brand<span class="required">*</span></label>
										<div class="col-sm-9">
											<?php echo e(Form::select('fk_brand_id',$brand,'',['class'=>'form-control','placeholder'=>'Select brand','required'])); ?>

											<div class="help-block with-errors"></div>
											<?php if($errors->has('fk_brand_id')): ?>
							                    <span class="help-block">
							                        <strong><?php echo e($errors->first('fk_brand_id')); ?></strong>
							                    </span>
								            <?php endif; ?>
										</div>
									</div>
									<?php endif; ?>
								<div class="different">
								<?php if(count($fields)>0): ?>

									<?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="row form-group  <?php echo e($errors->has('field_value') ? ' has-error' : ''); ?> model-name">
										<label class="col-sm-3 label-title"><?php echo e($field->title); ?><span class="required"><?php echo e(($field->required!=null)?'*':''); ?></span></label>
										<?php echo e(Form::hidden('fk_post_field_id[]',$field->id)); ?>

										<div class="col-sm-9">
										
										<?php if($field->type=='text'): ?>
											<?php echo e(Form::text('field_value[]','',['class'=>'form-control','placeholder'=>$field->title,$field->required])); ?>

										<?php elseif($field->type=='number'): ?>
											<?php echo e(Form::number('field_value[]','',['class'=>'form-control','min'=>'0','step'=>'any','placeholder'=>$field->title,$field->required])); ?>

										<?php elseif($field->type=='dropdown'): ?>
										<?
										$value1=explode(',',$field->value);
											$value=array();
											foreach ($value1 as $val) {
												if($val!=null){
													$value[$val]=$val;
												}

											}
										 ?>
										
											<?php echo e(Form::select('field_value[]',$value,'',['class'=>'form-control','placeholder'=>'- Select option -',$field->required])); ?>

										<?php endif; ?>
										<div class="help-block with-errors"></div>
										<?php if($errors->has('field_value')): ?>
							                    <span class="help-block">
							                        <strong><?php echo e($errors->first('field_value')); ?></strong>
							                    </span>
								            <?php endif; ?>
										</div>
									</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php endif; ?>
								<?php if(count($parts)>0): ?>
									<?php $__currentLoopData = $parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div class="row form-group <?php echo e($errors->has('field_value') ? ' has-error' : ''); ?> model-name">
										<label class="col-sm-3 label-title"><?php echo e($part->title); ?>

										<span class="required"><?php echo e(($part->required!=null)?'*':''); ?></span></label>
										<?php echo e(Form::hidden('fk_post_field_id[]',$part->id)); ?>

											<div class="col-sm-7">
											<? $value1=explode(',',$part->value);
												$value=array();
												foreach ($value1 as $val) {
													if($val!=null){
														$value[$val]=$val;
													}
												}
												
											 ?>
											<?php if($part->type=='text'): ?>
												<?php echo e(Form::text('field_value[]','',['class'=>'form-control','placeholder'=>$part->title,$part->required])); ?>

											<?php elseif($part->type=='number'): ?>
												<?php echo e(Form::number('field_value[]','',['class'=>'form-control','min'=>'0','step'=>'any','placeholder'=>$part->title,$part->required])); ?>

											<?php elseif($part->type=='dropdown'): ?>
												<?php echo e(Form::select('field_value[]',$value,'',['class'=>'form-control','placeholder'=>'- Select option -',$part->required])); ?>

											<?php endif; ?>
											<div class="help-block with-errors"></div>
											<?php if($errors->has('field_value')): ?>
							                    <span class="help-block">
							                        <strong><?php echo e($errors->first('field_value')); ?></strong>
							                    </span>
								            <?php endif; ?>
											</div>
											<?php echo e(Form::hidden('fk_post_field_id[]',$part->id2)); ?>

											<div class="col-md-2">
											<? $value3=explode(',',$part->value2);
												$value2=array();
												foreach ($value3 as $val) {
													if($val!=null){
														$value2[$val]=$val;
													}
												}
											 ?>
											<?php if($part->type2=='text'): ?>
												<?php echo e(Form::text('field_value[]','',['class'=>'form-control','placeholder'=>$part->title2,$part->required])); ?>

											<?php elseif($part->type2=='number'): ?>
												<?php echo e(Form::number('field_value[]','',['class'=>'form-control','min'=>'0','step'=>'any','placeholder'=>$part->title2,$part->required2])); ?>

											<?php elseif($part->type2=='dropdown'): ?>
												<?php echo e(Form::select('field_value[]',$value2,'',['class'=>'form-control','placeholder'=>'- Select -',$part->required2])); ?>

											<?php endif; ?>
											<span><small><?php echo e($part->title2); ?></small></span>
											</div>
										</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php endif; ?>
								</div>
								
									<div class="row form-group  <?php echo e($errors->has('tag') ? ' has-error' : ''); ?> additional">
										<label class="col-sm-3 label-title">Tags</label>
										<div class="col-sm-9">
											<?php echo e(Form::textArea('tag','',['class'=>'form-control','placeholder'=>'Tag separate by comma ( , )','rows'=>'2'])); ?>

											<!-- <div class="checkbox">
												<label for="camera"><input type="checkbox" name="camera" id="camera"> Camera</label>
												<label for="dual-sim"><input type="checkbox" name="dual-sim" id="dual-sim"> Dual SIM</label>
												<label for="keyboard"><input type="checkbox" name="keyboard" id="keyboard">  Physical keyboard</label>
												<label for="3g"><input type="checkbox" name="3g" id="3g"> 3G</label>

												<label for="gsm"><input type="checkbox" name="gsm" id="gsm"> GSM</label>

												<label for="screen"><input type="checkbox" name="screen" id="screen"> Touch screen</label>
											</div> -->
											<div class="help-block with-errors"></div>
											<?php if($errors->has('tag')): ?>
							                    <span class="help-block">
							                        <strong><?php echo e($errors->first('tag')); ?></strong>
							                    </span>
								            <?php endif; ?>
										</div>
									</div>
									<div class="row form-group  <?php echo e($errors->has('description') ? ' has-error' : ''); ?> item-description">
										<label class="col-sm-3 label-title">Description<span class="required">*</span></label>
										<div class="col-sm-9">
										<?php echo e(Form::textArea('description','',['class'=>'form-control textarea','placeholder'=>'Write few lines about your products or service','rows'=>'15'])); ?>

											<div class="help-block with-errors"></div>
											<?php if($errors->has('description')): ?>
							                    <span class="help-block">
							                        <strong><?php echo e($errors->first('description')); ?></strong>
							                    </span>
								            <?php endif; ?>	
										</div>
									</div>								
								</div><!-- section -->
								
								<div class="section seller-info">
									<h4>Your Information</h4>
									<div class="col-md-12">
										<label class="label-title">
											<b>Name : </b> <?php echo e(Auth::user()->name); ?>

										</label>
									</div>
									<div class="col-md-12">
										<label class="label-title">
											<b>Email : </b> <?php echo e(Auth::user()->email); ?>

										</label>
									</div>
									<div class="col-md-12">
										<label class="label-title">
											<b>Mobile Number : </b>
										</label>
									</div>
									<div class="col-md-12">
										<div class="well">
											<ul class="mobile_number_list">
											<? $primarynumber=Auth::user()->mobile; ?>
												<li id="primaryNumber">
													<div class="number-list">
														
													
													<span> <i class="fa fa-mobile"></i>  <?php echo e($primarynumber); ?></span> 
													<?php if(Auth::user()->mobile_verified==1): ?>
													<span class="verified"><img src="<?php echo e(asset('public/img/icon/verified.png')); ?>" alt="Verified" title="Verified"></span>
													<?php endif; ?>
													<button class="btn btn-xs btn-danger fa fa-times pull-right" onclick="mobileNumber('primaryNumber')"></button>
													<?php echo e(Form::hidden('mobile_number[]',$primarynumber)); ?>

													</div>
												</li>
											<?php $__currentLoopData = $numbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mobile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<li id="primaryNumber<?php echo e($mobile->id); ?>">
													<div class="number-list">
													<span> <i class="fa fa-mobile"></i>  <?php echo e($mobile->mobile); ?></span> 
													<?php if($mobile->is_verified==1): ?>
													<span class="verified"><img src="<?php echo e(asset('public/img/icon/verified.png')); ?>" alt="Verified" title="Verified"></span>
													<?php endif; ?>
													<button class="btn btn-xs btn-danger fa fa-times pull-right" onclick='mobileNumber("primaryNumber<?php echo e($mobile->id); ?>")''></button>
												<?php echo e(Form::hidden('mobile_number[]',$mobile->mobile)); ?>

													</div>
												</li>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												
											</ul>
											<br>
											<a href=""><i class="fa fa-plus-square"></i> Add new mobile number.</a>
											<?php if($errors->has('mobile_number')): ?>
							                    <span class="help-block">
							                        <strong class="text-danger"><?php echo e($errors->first('mobile_number')); ?></strong>
							                    </span>
								            <?php endif; ?>
										</div>
									</div>
								</div><!-- section -->
								
								<div class="checkbox section">
								<div class="form-group col-md-12" style="margin-bottom: 0">
									<label for="send">
										<input type="checkbox" id="send" required>I agree with<a href="<?php echo e(URL::to('page/using-rules')); ?>">Terms of Use</a> and <a href="<?php echo e(URL::to('page/using-rules')); ?>">Privacy Policy.</a>
									</label>
									<div class="help-block with-errors"></div>
								</div>
									<br>
									<button type="submit" class="btn btn-primary" id="submit">Post Your Ad</button>
								</div><!-- section -->
								
							</fieldset>
							<?php echo e(Form::close()); ?>	
					</div>
				

					<!-- quick-rules -->	
					<div class="col-md-3">
						<div class="section quick-rules">
							<h4>Quick rules</h4>
							<p class="lead">Posting an ad on <a href="https://www.tradebangla.com.bd">Trade Bangla</a> is free! However, all ads must follow our rules:</p>

							<ul>
								<li>Make sure you post in the correct category.</li>
								<li>Do not post the same ad more than once or repost an ad within 48 hours.</li>
								<li>Do not upload pictures with watermarks.</li>
								<li>Do not post ads containing multiple items unless it's a package deal.</li>
								<li>Do not put your email or phone numbers in the title or description.</li>
						
							</ul>
						</div>
					</div><!-- quick-rules -->	
				</div><!-- photos-ad -->				
			</div>	
		</div><!-- container -->
	</section><!-- main -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>


<script type="text/javascript">
	
	$('#submit').click(function(){
		photo = $('#upload-image-one').val();
		if(photo===''){
			$('#errorPhoto').html('<span class="text-danger">You must upload the first photo.</span>');
		}else{
			$('#errorPhoto').html('');
		}
	});
	function loadArea(id){
		$('#loadArea').load('<?php echo e(URL::to("loadArea")); ?>/'+id);
	}

	function mobileNumber(id){
		$('#'+id).html('');
	}
	
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>