@extends('frontend.app')
@section('content')
<!-- main -->
	<section id="main" class="clearfix ad-details-page">
		<div class="container">
		
			<div class="breadcrumb-section">
				<!-- breadcrumb -->
				<ol class="breadcrumb">
					<li><a href="{{URL::to('/')}}">Home</a></li>
					<li><a href="{{URL::to('/ad-post')}}">{{$category->name}}</a></li>
					<li>Edit</li>
				</ol><!-- breadcrumb -->						
			</div><!-- banner -->

			<div class="adpost-details">
				<div class="row">	
					<div class="col-md-9 no-padding">
					   @if(Session::has('success'))
							<div class="col-md-12">
							    <div class="alert alert-success alert-dismissable">
							        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							       <b>{!! Session::get('success')!!}</b> 
							       </div>
							</div>
							@elseif(Session::has('error'))
							  <div class="col-md-12">
							    <div class="alert alert-danger alert-dismissable">
							        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							       <b>{!! Session::get('error')!!}</b> 
							       </div>
							  </div>
							@endif
					</div>
					<div class="col-md-9">
					
						{!! Form::open(array('route' => ['ad-post.update',$data->id],'class'=>'form-horizontal','method'=>'PUT','files'=>true)) !!}
							<fieldset>
								<div class="section postdetails">
									<h4>Edit your item or service <span class="pull-right">* Mandatory Fields</span></h4>
									
									<div class="form-group selected-product">
										<ul class="select-category list-inline">
											<li>
												<a>
													<span class="select no-margin">
														<i class="fa fa-bars" aria-hidden="true"></i>
													</span>
													{{$category->name}}
												</a>
											</li>
											<li class="{{(isset($category->last_id))?'':'active'}}">
												<a>
													{{$category->sub_category_name}}
													
												</a>
											</li>
											@if(isset($category->last_id))
											<li class="active">
												<a>{{$category->last_step_category_name}}</a>
												
											</li>
											@endif
										</ul>
										<!-- <a class="edit" href="{{URL::to('ad-post')}}"><i class="fa fa-pencil"></i>Edit</a> -->
									</div>
									<div class="row form-group {{ $errors->has('fk_division_id') ? ' has-error' : '' }}">
										<label class="col-sm-3"> Location <span class="required">*</span></label>
										<div class="col-sm-4">
										{{Form::select('fk_division_id',$division_town,$data->fk_division_id,['class'=>'form-control','onchange'=>"loadArea(this.value)"])}}
											<div class="help-block with-errors"></div>
											@if ($errors->has('fk_division_id'))
							                    <span class="help-block">
							                        <strong>{{ $errors->first('fk_division_id') }}</strong>
							                    </span>
								            @endif
										</div>
										<div class="col-sm-5">
											<div id="loadArea">
											{{Form::select('fk_area_id',$area,$data->fk_area_id,['class'=>'form-control'])}}
											</div>
											<div class="help-block with-errors"></div>
												@if ($errors->has('fk_area_id'))
								                    <span class="help-block">
								                        <strong>{{ $errors->first('fk_area_id') }}</strong>
								                    </span>
									            @endif
										</div>
										
									</div>
									<div class="row form-group {{ $errors->has('address') ? ' has-error' : '' }}">
										<label class="col-sm-3">Specific Address<span class="required"></span></label>
										<div class="col-sm-9">
										{{Form::text('address',$data->address,['class'=>'form-control','placeholder'=>'Specific Address'])}}
											<div class="help-block with-errors"></div>
											@if ($errors->has('address'))
							                    <span class="help-block">
							                        <strong>{{ $errors->first('address') }}</strong>
							                    </span>
								            @endif
										</div>
									</div>
								@if($category->post_type!=2)
									<div class="row form-group {{ $errors->has('type') ? ' has-error' : '' }}">
										<label class="col-sm-3"> Type of ad <span class="required">*</span></label>
										<div class="col-sm-9 user-type">
										
											<input type="radio" name="type" value="1" id="newsell" required {{($data->type==1)?'checked':''}}> <label for="newsell"> I want to sell </label>
											<input type="radio" name="type" value="2" id="newbuy" required {{($data->type==1)?'':'checked'}}> <label for="newbuy">want to buy</label>
											<div class="help-block with-errors"></div>
											@if ($errors->has('type'))
							                    <span class="help-block">
							                        <strong>{{ $errors->first('type') }}</strong>
							                    </span>
								            @endif
										</div>
									</div>
									<div class="row form-group add-title {{ $errors->has('title') ? ' has-error' : '' }}">
										<label class="col-sm-3 label-title">Post Title<span class="required">*</span></label>
										<div class="col-sm-9">
										{{Form::text('title',$data->title,['class'=>'form-control','placeholder'=>'Ex: Sony Xperia dual sim 100% brand new','required'])}}
											<div class="help-block with-errors"></div>
											@if ($errors->has('title'))
							                    <span class="help-block">
							                        <strong>{{ $errors->first('title') }}</strong>
							                    </span>
								            @endif
										</div>
									</div>

									<div class="row form-group {{ $errors->has('photo_one') ? ' has-error' : '' }}  {{ $errors->has('photo_two') ? ' has-error' : '' }}  {{ $errors->has('photo_three') ? ' has-error' : '' }}  {{ $errors->has('photo_four') ? ' has-error' : '' }} add-image">
										<label class="col-sm-3 label-title">Photos for your ad </label>
										<div class="col-sm-9">
											<p><span>The first photo is your main photo. Photo size : 600 x 260 px.</span></p>
											<? $path="images/post"; ?>
											<div class="upload-section">
												<label class="upload-image" for="upload-image-one">
												@if(file_exists("$path/big/$data->photo_one") and ($data->photo_one!=null))
													<input type="file" id="upload-image-one" name="photo_one" onchange="loadPhoto(this,'loadImage1')">
												<img id="loadImage1" class="img-responsive" src='{{asset("$path/big/$data->photo_one")}}'>
												@else
												<input class="upload-image-one" type="file" id="upload-image-one" name="photo_one" onchange="loadPhoto(this,'loadImage1')" required>
												<img id="loadImage1" class="img-responsive" style="display: none">

												@endif
												</label>

												<label class="upload-image" for="upload-image-two">
													<input type="file" id="upload-image-two" name="photo_two" onchange="loadPhoto(this,'loadImage2')">
												@if(file_exists("$path/big/$data->photo_two") and ($data->photo_two!=null))
												<img id="loadImage2" class="img-responsive" src='{{asset("$path/big/$data->photo_two")}}'>
												@else
												<img id="loadImage2" class="img-responsive" style="display: none">

												@endif
												</label>											
												<label class="upload-image" for="upload-image-three">
													<input type="file" id="upload-image-three" name="photo_three" onchange="loadPhoto(this,'loadImage3')">
												@if(file_exists("$path/big/$data->photo_three") and ($data->photo_three!=null))
												<img id="loadImage3" class="img-responsive" src='{{asset("$path/big/$data->photo_three")}}'>
												@else
												<img id="loadImage3" class="img-responsive" style="display: none">

												@endif
												</label>										

												<label class="upload-image" for="upload-imagefour">
													<input type="file" id="upload-imagefour" name="photo_four" onchange="loadPhoto(this,'loadImage4')">
												@if(file_exists("$path/big/$data->photo_four") and ($data->photo_four!=null))
												<img id="loadImage4" class="img-responsive" src='{{asset("$path/big/$data->photo_four")}}'>
												@else
												<img id="loadImage4" class="img-responsive" style="display: none">

												@endif
												</label>
											</div>
											<div id="errorPhoto">
												
											</div>
											@if ($errors->has('photo_one'))
							                    <span class="help-block">
							                        <strong>{{ $errors->first('photo_one') }}</strong>
							                    </span>
							                    <br>
								            @endif
								            
								            @if ($errors->has('photo_two'))
							                    <span class="help-block">
							                        <strong>{{ $errors->first('photo_two') }}</strong>
							                    </span>
								            <br>
								            @endif
								            @if ($errors->has('photo_three'))
							                    <span class="help-block">
							                        <strong>{{ $errors->first('photo_three') }}</strong>
							                    </span>
								            <br>
								            @endif
								            @if ($errors->has('photo_four'))
							                    <span class="help-block">
							                        <strong>{{ $errors->first('photo_four') }}</strong>
							                    </span>
								            <br>
								            @endif
										</div>
									</div>
									<div class="row form-group {{ $errors->has('condition') ? ' has-error' : '' }} select-condition">
										<label class="col-sm-3">Condition<span class="required">*</span></label>
										<div class="col-sm-9">
											<input type="radio" name="condition" value="2" id="used" required {{($data->condition==2)?'checked':''}}> 
											<label for="used">Used</label>
											<input type="radio" name="condition" value="1" id="new" required {{($data->condition==1)?'checked':''}}> 
											<label for="new">New</label>
											<div class="help-block with-errors"></div>
											@if ($errors->has('condition'))
							                    <span class="help-block">
							                        <strong>{{ $errors->first('condition') }}</strong>
							                    </span>
								            @endif
											
										</div>
									</div>
									<div class="row form-group  {{ $errors->has('price') ? ' has-error' : '' }} select-price">
										<label class="col-sm-3 label-title">Price<span class="required">*</span></label>
										<div class="col-sm-6">
											{{Form::number('price',$data->price,['class'=>'form-control','min'=>'0','step'=>'any','placeholder'=>'TK'])}}


											<div class="help-block with-errors"></div>
											@if ($errors->has('price'))
							                    <span class="help-block">
							                        <strong>{{ $errors->first('price') }}</strong>
							                    </span>
								            @endif
										</div>
										<div class="col-md-3">
											<div class="checkbox">
												<div class="form-group {{ $errors->has('is_negotiable') ? ' has-error' : '' }} col-md-12">
												<label for="negotiable" class="{{($data->is_negotiable==1)?'checked':''}}">
													<input name="is_negotiable" type="checkbox" value="1" id="negotiable" {{($data->is_negotiable==1)?'checked':''}}>Negotiable
												</label>
												<div class="help-block with-errors"></div>
													@if ($errors->has('is_negotiable'))
									                    <span class="help-block">
									                        <strong>{{ $errors->first('is_negotiable') }}</strong>
									                    </span>
										            @endif
												</div>
											</div>

										</div>
									</div>
								@else
									<input type="hidden" name="type" value="3">
								<input type="hidden" name="condition" value="1">
								<div class="row form-group add-title {{ $errors->has('title') ? ' has-error' : '' }}">
									<label class="col-sm-3 label-title">Job Title<span class="required">*</span></label>
									<div class="col-sm-9">
									{{Form::text('title',$data->title,['class'=>'form-control','placeholder'=>'Ex: Digital Marketing Executive','required'])}}
										<div class="help-block with-errors"></div>
										@if ($errors->has('title'))
						                    <span class="help-block">
						                        <strong>{{ $errors->first('title') }}</strong>
						                    </span>
							            @endif
									</div>
								</div>
								<div class="row form-group  {{ $errors->has('price') ? ' has-error' : '' }} select-price">
										<label class="col-sm-3 label-title">Salary (per month)<span class="required"></span></label>
										<div class="col-sm-3">
											{{Form::number('price',$data->price,['class'=>'form-control','min'=>'0','step'=>'any','placeholder'=>'From'])}}
											<div class="help-block with-errors"></div>
											@if ($errors->has('price'))
							                    <span class="help-block">
							                        <strong>{{ $errors->first('price') }}</strong>
							                    </span>
								            @endif
										</div>
										<div class="col-sm-3">
											{{Form::number('price2',$data->price2,['class'=>'form-control','min'=>'0','step'=>'any','placeholder'=>'To'])}}
											<div class="help-block with-errors"></div>
											@if ($errors->has('price2'))
							                    <span class="help-block">
							                        <strong>{{ $errors->first('price2') }}</strong>
							                    </span>
								            @endif
										</div>
										<div class="col-md-3">
											<div class="checkbox">
												<div class="form-group {{ $errors->has('is_negotiable') ? ' has-error' : '' }} col-md-12">
												<label for="negotiable" class="{{($data->is_negotiable==1)?'checked':''}}">
													<input name="is_negotiable" type="checkbox" value="1" id="negotiable" {{($data->is_negotiable==1)?'checked':''}}>Negotiable
												</label>
												<div class="help-block with-errors"></div>
													@if ($errors->has('is_negotiable'))
									                    <span class="help-block">
									                        <strong>{{ $errors->first('is_negotiable') }}</strong>
									                    </span>
										            @endif
												</div>
											</div>

										</div>
									</div>
								@endif
									<!-- Brand load by category -->
									@if(count($brand)>0)
									<div class="row form-group  {{ $errors->has('fk_brand_id') ? ' has-error' : '' }} brand-name">
										<label class="col-sm-3 label-title">Brand<span class="required">*</span></label>
										<div class="col-sm-9">
											{{Form::select('fk_brand_id',$brand,$data->fk_brand_id,['class'=>'form-control','placeholder'=>'Select brand','required'])}}
											<div class="help-block with-errors"></div>
											@if ($errors->has('fk_brand_id'))
							                    <span class="help-block">
							                        <strong>{{ $errors->first('fk_brand_id') }}</strong>
							                    </span>
								            @endif
										</div>
									</div>
									@endif
								<div class="different">
								@if(count($fields)>0)
									@foreach($fields as $field)
									<div class="row form-group  {{ $errors->has('field_value') ? ' has-error' : '' }} model-name">
										<label class="col-sm-3 label-title">{{$field->title}}<span class="required">{{($field->required!=null)?'*':''}}</span></label>
										{{Form::hidden('fk_post_field_id[]',$field->id)}}
										<div class="col-sm-9">
										<? $value1=explode(',',$field->value);
											$value=array();
											foreach ($value1 as $val) {
												if($val!=null){
													$value[$val]=$val;
												}

											}
										 ?>
								@foreach($postField as $fieldValue)
									@if($fieldValue->fk_post_field_id==$field->id)
										@if($field->type=='text')
											{{Form::text('field_value[]',$fieldValue->field_value,['class'=>'form-control','placeholder'=>$field->title,$field->required])}}
										@elseif($field->type=='number')
											{{Form::number('field_value[]',$fieldValue->field_value,['class'=>'form-control','min'=>'0','step'=>'any','placeholder'=>$field->title,$field->required])}}
										@elseif($field->type=='dropdown')
											{{Form::select('field_value[]',$value,$fieldValue->field_value,['class'=>'form-control','placeholder'=>'- Select option -',$field->required])}}
										@endif
									@endif
								@endforeach
										<div class="help-block with-errors"></div>
										@if ($errors->has('field_value'))
							                    <span class="help-block">
							                        <strong>{{ $errors->first('field_value') }}</strong>
							                    </span>
								            @endif
										</div>
									</div>
									@endforeach
								@endif
								@if(count($parts)>0)
									@foreach($parts as $part)
										<div class="row form-group {{ $errors->has('field_value') ? ' has-error' : '' }} model-name">
										<label class="col-sm-3 label-title">{{$part->title}}
										<span class="required">{{($part->required!=null)?'*':''}}</span></label>
										{{Form::hidden('fk_post_field_id[]',$part->id)}}
											<div class="col-sm-7">
											<? $value1=explode(',',$part->value);
											$value=array();
												foreach ($value1 as $val) {
													if($val!=null){
														$value[$val]=$val;
													}
												}
												
											 ?>
									@foreach($extraPart as $ePart)
										@if($ePart['id']==$part->id)
										<?$fieldValue=$ePart['field_value'];?>
											@if($part->type=='text')
												{{Form::text('field_value[]',$fieldValue,['class'=>'form-control','placeholder'=>$part->title,$part->required])}}
											@elseif($part->type=='number')
												{{Form::number('field_value[]',$fieldValue,['class'=>'form-control','min'=>'0','step'=>'any','placeholder'=>$part->title,$part->required])}}
											@elseif($part->type=='dropdown')
												{{Form::select('field_value[]',$value,$fieldValue,['class'=>'form-control','placeholder'=>'- Select option -',$part->required])}}
											@endif
										
										@endif

									@endforeach
									
											<div class="help-block with-errors"></div>
											@if ($errors->has('field_value'))
							                    <span class="help-block">
							                        <strong>{{ $errors->first('field_value') }}</strong>
							                    </span>
								            @endif
											</div>
											{{Form::hidden('fk_post_field_id[]',$part->id2)}}
											<div class="col-md-2">
											<? $value3=explode(',',$part->value2);
											$value2=array();
												foreach ($value3 as $val) {
													if($val!=null){
														$value2[$val]=$val;
													}
												}
											 ?>
									@foreach($extraPart as $ePart)
										@if($ePart['id2']==$part->id2)
											<?$fieldValue2=$ePart['field_value2'];?>
											@if($part->type2=='text')
												{{Form::text('field_value[]',$fieldValue2,['class'=>'form-control','placeholder'=>$part->title2,$part->required])}}
											@elseif($part->type2=='number')
												{{Form::number('field_value[]',$fieldValue2,['class'=>'form-control','min'=>'0','step'=>'any','placeholder'=>$part->title2,$part->required2])}}
											@elseif($part->type2=='dropdown')
												{{Form::select('field_value[]',$value2,$fieldValue2,['class'=>'form-control','placeholder'=>'- Select -',$part->required2])}}
											@endif
										
										@endif
									@endforeach
											<span><small>{{$part->title2}}</small></span>
											</div>
										</div>
									@endforeach
								@endif
								</div>
								
									<div class="row form-group  {{ $errors->has('tag') ? ' has-error' : '' }} additional">
										<label class="col-sm-3 label-title">Tags</label>
										<div class="col-sm-9">
											{{Form::textArea('tag',$data->tag,['class'=>'form-control','placeholder'=>'Tag separate by comma ( , )','rows'=>'2'])}}
											<!-- <div class="checkbox">
												<label for="camera"><input type="checkbox" name="camera" id="camera"> Camera</label>
												<label for="dual-sim"><input type="checkbox" name="dual-sim" id="dual-sim"> Dual SIM</label>
												<label for="keyboard"><input type="checkbox" name="keyboard" id="keyboard">  Physical keyboard</label>
												<label for="3g"><input type="checkbox" name="3g" id="3g"> 3G</label>

												<label for="gsm"><input type="checkbox" name="gsm" id="gsm"> GSM</label>

												<label for="screen"><input type="checkbox" name="screen" id="screen"> Touch screen</label>
											</div> -->
											<div class="help-block with-errors"></div>
											@if ($errors->has('tag'))
							                    <span class="help-block">
							                        <strong>{{ $errors->first('tag') }}</strong>
							                    </span>
								            @endif
										</div>
									</div>
									<div class="row form-group  {{ $errors->has('description') ? ' has-error' : '' }} item-description">
										<label class="col-sm-3 label-title">Description<span class="required">*</span></label>
										<div class="col-sm-9">
										{{Form::textArea('description',$data->description,['class'=>'form-control textarea','placeholder'=>'Write few lines about your products or service','rows'=>'15'])}}
											<div class="help-block with-errors"></div>
											@if ($errors->has('description'))
							                    <span class="help-block">
							                        <strong>{{ $errors->first('description') }}</strong>
							                    </span>
								            @endif	
										</div>
									</div>								
								</div><!-- section -->
								
								<div class="section seller-info">
									<h4>Seller Information</h4>
									<div class="col-md-12">
										<label class="label-title">
											<b>Name : </b> {{Auth::user()->name}}
										</label>
									</div>
									<div class="col-md-12">
										<label class="label-title">
											<b>Email : </b> {{Auth::user()->email}}
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
														<div class="col-md-9">
															<span> <i class="fa fa-mobile"></i>  {{$primarynumber}}</span> 
														@if(Auth::user()->mobile_verified==1)
														<span class="verified"><img src="{{asset('public/img/icon/verified.png')}}" alt="Verified" title="Verified"></span>
														@endif
														</div>
													<? $mobileNumber=''; ?>
													@foreach($mobiles as $mb)
													@if($primarynumber==$mb->mobile_number)
														<?$mobileNumber=$mb->mobile_number?>
													@endif
													@endforeach
													<div class="col-md-2">
														<div class="checkbox">
														<label for="number" class="{{($primarynumber==$mobileNumber)?'checked':''}}">
															<input name="mobile_number[]" value="{{$primarynumber}}" type="checkbox" id="number" {{($primarynumber==$mobileNumber)?'checked':''}}>Used
														</label>
													</div><!-- section -->
													</div>
													<div class="col-md-1">
														<button class="btn btn-xs btn-danger fa fa-times pull-right" onclick="mobileNumber('primaryNumber')"></button>
													</div>
													</div>
												</li>
											
											@foreach($numbers as $mobile)
												<? $mobileNumber=''; ?>
													@foreach($mobiles as $mb)
													@if($mobile->mobile==$mb->mobile_number)
														<?$mobileNumber=$mb->mobile_number?>
													@endif
													@endforeach
												<li id="primaryNumber{{$mobile->id}}">
													<div class="number-list">
														<div class="col-md-9">
															<span> <i class="fa fa-mobile"></i>  {{$mobile->mobile}}</span> 
															@if($mobile->is_verified==1)
															<span class="verified"><img src="{{asset('public/img/icon/verified.png')}}" alt="Verified" title="Verified"></span>
															@endif
														</div>
														<div class="col-md-2">
															<div class="checkbox">
																<label for="number{{$mobile->id}}" class="{{($mobile->mobile==$mobileNumber)?'checked':''}}">
																	<input name="mobile_number[]" value="{{$mobile->mobile}}" type="checkbox" id="number{{$mobile->id}}" {{($mobile->mobile==$mobileNumber)?'checked':''}}>Used
																</label>
															</div><!-- section -->
														</div>
														<div class="col-md-1">
															<button class="btn btn-xs btn-danger fa fa-times pull-right" onclick='mobileNumber("primaryNumber{{$mobile->id}}")''></button>
														</div>
													</div>
												</li>
											@endforeach
												
											</ul>
											<br>
											<a href=""><i class="fa fa-plus-square"></i> Add new mobile number.</a>
											@if ($errors->has('mobile_number'))
							                    <span class="help-block">
							                        <strong class="text-danger">{{ $errors->first('mobile_number') }}</strong>
							                    </span>
								            @endif
										</div>
									</div>
								</div><!-- section -->
								
								<div class="checkbox section">
								<div class="form-group col-md-12" style="margin-bottom: 0">
									<label for="send" class="checked">
										<input type="checkbox" id="send" required checked>I agree with<a href="#">Terms of Use</a> and <a href="#">Privacy Policy.</a>
									</label>
									<div class="help-block with-errors"></div>
								</div>
									<br>
									<button type="submit" class="btn btn-primary" id="submit">Post Your Ad</button>
								</div><!-- section -->
								
							</fieldset>
							{{Form::close()}}	
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

@endsection
@section('scripts')
<script type="text/javascript">
	function loadArea(id){
		$('#loadArea').load('{{URL::to("loadArea")}}/'+id);
	}

	function mobileNumber(id){
		$('#'+id).html('');
	}

	function loadPhoto(input,id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
        	$('#'+id).css('display','block');
            $('#'+id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection