@extends('frontend.app')
@section('content')
<section id="main" class="clearfix  ad-profile-page">
	<div class="container">
	
		<div class="breadcrumb-section">
			<!-- breadcrumb -->
			<ol class="breadcrumb">
				<li><a href="{{URL::to('/')}}">Home</a></li>
				<li>Membership Registration</li>
			</ol><!-- breadcrumb -->						
		</div><!-- banner -->
			@include('frontend.profile.profileHeader')			
		

		<div class="profile">
			<div class="row">
				<div class="col-sm-8">
					<div class="business-section">
						<!-- profile-details -->
						<div class="profile-details section">
							<h2>Update Business Profile</h2><hr>
							<!-- form -->
							{!! Form::open(array('route' => ['business-account.update',$data->id],'class'=>'form-horizontal', 'data-toggle'=>'validator','role'=>'form','method'=>'PUT','files'=>'true')) !!}
							<div class="form-group">
								<label class="col-sm-3 control-label">Email &amp; Mobile</label>
								<div class="col-sm-5">
									<div class="form-control">{{Auth::user()->email}}
									@if(Auth::user()->email_verified==1)
									<span class="verified pull-right"><img src="{{asset('public/img/icon/verified.png')}}" alt="Verified" title="Verified"></span>
									@else
									<a href="#" class="pull-right text-danger" title="Not Verified !"><i class="fa fa-info-circle"></i></a>
									@endif
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-control">{{Auth::user()->mobile}} 
									@if(Auth::user()->mobile_verified==1)
									<span class="verified pull-right"><img src="{{asset('public/img/icon/verified.png')}}" alt="Verified" title="Verified"></span>
									@else
									<a href="#" class="pull-right text-danger" title="Not Verified !"><i class="fa fa-info-circle"></i></a>
									@endif
									</div>
								</div>
								 
							</div>
							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Organization Name</label>
								<div class="col-sm-9">
									<input name="name" type="text" class="form-control" placeholder="Name" value="{{Auth::user()->name}}" required>
									<div class="help-block with-errors"></div>
									 @if ($errors->has('name'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('name') }}</strong>
		                                </span>
		                            @endif
		                            
								</div>
								
							</div>

							<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Title</label>
								<div class="col-sm-9">
									
									<input name="title" type="text" class="form-control" placeholder="Ex: Best Laptop Collection" value="{{$data->title}}" required>
									<div class="help-block with-errors"></div>
									 @if ($errors->has('title'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('title') }}</strong>
		                                </span>
		                            @endif
								</div>
								
							</div>
							<div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Link</label>
								<div class="col-sm-9">
									<span>https://www.tradebangla.com.bd/business/</span>
									<input name="link" value="{{$data->link}}" type="text" class="form-control" placeholder="Make your URL" value="{{old('link')}}" required>
									<div class="help-block with-errors"></div>
									 @if ($errors->has('link'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('link') }}</strong>
		                                </span>
		                            @endif
								</div>
								
							</div>
							<div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Address</label>
								<div class="col-sm-9">
									
									<input name="location" type="text" class="form-control" placeholder="Address" value="{{$data->location}}" required>
									<div class="help-block with-errors"></div>
									 @if ($errors->has('location'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('location') }}</strong>
		                                </span>
		                            @endif
								</div>
								
							</div>
							<div class="form-group{{ $errors->has('fk_category_id') ? ' has-error' : '' }}{{ $errors->has('fk_sub_category_id') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Business Category</label>
								<div class="col-sm-9">
									
									{{Form::select('fk_category_id',$category,$data->fk_category_id,['class'=>'form-control','placeholder'=>'Select Category','required','onchange'=>'loadSubCat(this.value)'])}}
									<div class="help-block with-errors"></div>
									 @if ($errors->has('fk_category_id'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('fk_category_id') }}</strong>
		                                </span>
		                            @endif
		                            @if ($errors->has('fk_sub_category_id'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('fk_sub_category_id') }}</strong>
		                                </span>
		                            @endif
								</div>
								
							</div>
							<div id="loadSubCategory">
								<div class="form-group{{ $errors->has('fk_sub_category_id') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Sub Category</label>
								<div class="col-sm-9">
									
									{{Form::select('fk_sub_category_id',$subCat,$data->fk_sub_category_id,['class'=>'form-control','placeholder'=>'Select sub Category','required'])}}
									<div class="help-block with-errors"></div>
									 @if ($errors->has('fk_sub_category_id'))
							            <span class="help-block">
							                <strong>{{ $errors->first('fk_sub_category_id') }}</strong>
							            </span>
							        @endif
								</div>
								
							</div>
							</div>
							
							<div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Website</label>
								<div class="col-sm-9">
									<input name="website" type="text" class="form-control" placeholder="http://www.example.com" pattern="https?://.+" title="Include http://" value="{{$data->website}}">
									<div class="help-block with-errors"></div>
									 @if ($errors->has('website'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('website') }}</strong>
		                                </span>
		                            @endif
								</div>
								
							</div>
							<div class="form-group{{ $errors->has('open_hour') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Open hour</label>
								<div class="col-sm-3">
									<input name="open_hour" type="time" class="form-control" placeholder="Ex: 10:00 AM" value="{{$hour['open_hour']}}">
								</div>
								<!-- <div class="col-sm-1"><h4>TO</h4></div> -->
								<div class="col-sm-3">
									<? $close_hour=(isset($userInfo->close_hour))?$userInfo->close_hour:''; ?>
									<input name="close_hour" type="time" class="form-control" placeholder="Ex: 8:00 PM" value="{{$hour['close_hour']}}">
								</div>
								<div class="col-sm-3">
									
									{{Form::select('closed_day',$days,$data->closed_day,['class'=>'form-control','placeholder'=>'Select Close Day',])}}
								</div>
								
							</div>
							<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">About Organization</label>
								<div class="col-sm-9">
									{{Form::textArea('description',$data->description,['class'=>'form-control textarea','placeholder'=>'About Organization','required'])}}
									<div class="help-block with-errors"></div>
									 @if ($errors->has('description'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('description') }}</strong>
		                                </span>
		                            @endif
								</div>
							</div>
							<div class="form-group{{ $errors->has('services') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Product or Services</label>
								<div class="col-sm-9">
									
									{{Form::textArea('services',$data->services,['class'=>'form-control textarea','placeholder'=>'Product or Services','required'])}}
									<div class="help-block with-errors"></div>
									 @if ($errors->has('services'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('services') }}</strong>
		                                </span>
		                            @endif
								</div>
								
							</div>
							<div class="form-group{{ $errors->has('contact_phone') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Contact phone</label>
								<div class="col-sm-9">
									
									<input name="contact_phone" type="number" class="form-control" placeholder="Contact phone" min="0" value="{{$data->contact_phone}}" required>
									<div class="help-block with-errors"></div>
									 @if ($errors->has('contact_phone'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('contact_phone') }}</strong>
		                                </span>
		                            @endif
								</div>
								
							</div>
							<div class="form-group{{ $errors->has('contact_email') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Contact email</label>
								<div class="col-sm-9">
									
									<input name="contact_email" type="email" class="form-control" placeholder="Contact email" value="{{$data->contact_email}}" required>
									<div class="help-block with-errors"></div>
									 @if ($errors->has('contact_email'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('contact_email') }}</strong>
		                                </span>
		                            @endif
								</div>
								
							</div>
							<div class="form-group{{ $errors->has('cover_photo') ? ' has-error' : '' }} add-image business-cover">
								<label class="col-sm-3 control-label">Cover Photo</label>
								<div class="col-sm-9">
									<? $cover_photo=(isset($userInfo->cover_photo))?$userInfo->cover_photo:''; ?>
									
									<label class="upload-image text-center" for="cover_photo">
										<input type="file" id="cover_photo" name="cover_photo" onchange="loadPhoto(this,'loadImage1')">
									<img id="loadImage1" src='{{asset("images/business/cover/$data->cover_photo")}}' class="img-responsive">
									</label>
									<br>
									<span>Photo size : 800 X 350 px</span>
									<div class="help-block with-errors"></div>
									 @if ($errors->has('cover_photo'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('cover_photo') }}</strong>
		                                </span>
		                            @endif
								</div>
								
							</div>
							<div class="form-group{{ $errors->has('profile_photo') ? ' has-error' : '' }} add-image business-photo">
								<label class="col-sm-3 control-label">Profile Photo / Logo</label>
								<div class="col-sm-9">
									<? $profile_photo=(isset($userInfo->profile_photo))?$userInfo->profile_photo:''; ?>
									
									<label class="upload-image text-center" for="upload-image-one">
										<input type="file" id="upload-image-one" name="profile_photo" onchange="loadPhoto(this,'loadImage2')">
									<img id="loadImage2" src='{{asset("images/business/profile/$data->profile_photo")}}' class="img-responsive">
									</label>
										<br>	
									<span>Photo size : 200 X 150 px</span>
									<div class="help-block with-errors"></div>
									 @if ($errors->has('profile_photo'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('profile_photo') }}</strong>
		                                </span>
		                            @endif
								</div>
								
							</div>
							<div class="form-group ">
								<label class="col-sm-3 control-label"></label>
								<div class="col-sm-9">
								<button type="submit" class="business-btn btn btn-success">Submit</button>
									
								</div>
							</div>
						{{Form::close()}}				
						</div><!-- profile-details -->
					</div><!-- user-pro-edit -->
				</div><!-- profile -->

				<div class="col-sm-4 text-center">
					@include('frontend._partials.support')
				</div><!-- recommended-cta-->
			</div><!-- row -->	
		</div>				
	</div><!-- container -->
</section><!-- ad-profile-page -->
@endsection
@section('scripts')
	<script type="text/javascript">
		function loadSubCat(id){
			$('#loadSubCategory').load('{{URL::to("loadSubCategory")}}/'+id);
		}
	</script>
@endsection