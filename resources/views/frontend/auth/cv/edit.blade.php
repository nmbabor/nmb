@extends('frontend.app')
@section('content')
<section id="main" class="clearfix  ad-profile-page">
	<div class="container">
	
		<div class="breadcrumb-section">
			<!-- breadcrumb -->
			<ol class="breadcrumb">
				<li><a href="{{URL::to('/')}}">Home</a></li>
				<li>Edit Resume</li>
			</ol><!-- breadcrumb -->						
		</div><!-- banner -->
			@include('frontend.profile.profileHeader')			
		

		<div class="profile">
			<div class="row">
				
				
				<div class="col-sm-10">
					<div class="business-section">
						<!-- profile-details -->
						<div class="profile-details section">
							
							<div class="updateHeader">
								@include('frontend.auth.cv.updateHeader')
							</div>
							<!-- form -->
							<div class="resume-form">
								
							
							{!! Form::open(array('route' => ['resume.update',$data->id],'class'=>'form-horizontal', 'data-toggle'=>'validator','role'=>'form','method'=>'PUT','files'=>'true')) !!}
							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Name</label>
								<div class="col-sm-9">
									<input name="name" type="text" class="form-control" placeholder="Name" value="{{$data->name}}" required>
									<div class="help-block with-errors"></div>
									 @if ($errors->has('name'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('name') }}</strong>
		                                </span>
		                            @endif
		                           
								</div>
								
							</div>
							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Email</label>
								<div class="col-sm-9">
									<input name="email" type="text" class="form-control" placeholder="Email" value="{{$data->email}}" required>
									<div class="help-block with-errors"></div>
									 @if ($errors->has('email'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('email') }}</strong>
		                                </span>
		                            @endif
		                           
								</div>
								
							</div>
							<div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Mobile Number</label>
								<div class="col-sm-9">
									<input name="mobile" type="number" min="0" class="form-control" placeholder="Mobile Number" value="{{$data->mobile}}" required>
									<div class="help-block with-errors"></div>
									 @if ($errors->has('mobile'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('mobile') }}</strong>
		                                </span>
		                            @endif
		                           
								</div>
								
							</div>

							<div class="form-group{{ $errors->has('fathers_name') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Father's Name</label>
								<div class="col-sm-9">
									
									<input name="fathers_name" type="text" class="form-control" placeholder="Father's Name" value="{{$data->fathers_name}}">
									<div class="help-block with-errors"></div>
									 @if ($errors->has('fathers_name'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('fathers_name') }}</strong>
		                                </span>
		                            @endif
								</div>
								
							</div>
							<div class="form-group{{ $errors->has('mothers_name') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Mother's Name</label>
								<div class="col-sm-9">
									
									<input name="mothers_name" type="text" class="form-control" placeholder="Mother's Name" value="{{$data->mothers_name}}">
									<div class="help-block with-errors"></div>
									 @if ($errors->has('mothers_name'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('mothers_name') }}</strong>
		                                </span>
		                            @endif
								</div>
								
							</div>

							<div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Date of birth</label>
								<div class="col-sm-9">
									<input name="date_of_birth" type="text" class="form-control datepicker" placeholder="Date of birth" value="{{date('d-m-Y',strtotime($data->date_of_birth))}}" required>
									<div class="help-block with-errors"></div>
									 @if ($errors->has('date_of_birth'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('date_of_birth') }}</strong>
		                                </span>
		                            @endif
								</div>
								
							</div>
							<div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Gender</label>
								<div class="col-sm-9">
									{{Form::select('gender',['Male'=>'Male','Female'=>'Female','Other'=>'Other'],$data->gender,['class'=>'form-control','required'])}}
									<div class="help-block with-errors"></div>
									 @if ($errors->has('gender'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('gender') }}</strong>
		                                </span>
		                            @endif
								</div>
								
							</div>
							<div class="form-group{{ $errors->has('religion') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Religion</label>
								<div class="col-sm-9">
									
									<input name="religion" type="text" class="form-control" placeholder="Religion" value="{{$data->religion}}" required>
									<div class="help-block with-errors"></div>
									 @if ($errors->has('religion'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('religion') }}</strong>
		                                </span>
		                            @endif
								</div>
								
							</div>
							
							<div class="form-group{{ $errors->has('national_id') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">National ID</label>
								<div class="col-sm-9">
									<input name="national_id" type="text" class="form-control" placeholder="National ID" value="{{$data->national_id}}">
									 @if ($errors->has('national_id'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('national_id') }}</strong>
		                                </span>
		                            @endif
								</div>
								
							</div>
							<div class="form-group{{ $errors->has('present_address') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Present Address</label>
								<div class="col-sm-9">
									
									{{Form::textArea('present_address',$data->present_address,['class'=>'form-control','placeholder'=>'Present Address','required','rows'=>'2'])}}
									<div class="help-block with-errors"></div>
									 @if ($errors->has('present_address'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('present_address') }}</strong>
		                                </span>
		                            @endif
								</div>
							</div>
							<div class="form-group{{ $errors->has('permanent_address') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Permanent Address</label>
								<div class="col-sm-9">
									
									{{Form::textArea('permanent_address',$data->permanent_address,['class'=>'form-control','placeholder'=>'Permanent Address','required','rows'=>'2'])}}
									<div class="help-block with-errors"></div>
									 @if ($errors->has('permanent_address'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('permanent_address') }}</strong>
		                                </span>
		                            @endif
								</div>
							</div>
							
							<div class="form-group{{ $errors->has('profile_photo') ? ' has-error' : '' }} add-image business-photo">
								<label class="col-sm-3 control-label">Profile Photo / Logo</label>
								<div class="col-sm-9">
									<? $profile_photo=(isset($userInfo->profile_photo))?$userInfo->profile_photo:''; ?>
									
									<label class="upload-image text-center resume_profile" for="upload-image-one">
										<input type="file" id="upload-image-one" name="profile_photo" onchange="loadPhoto(this,'loadImage2')">
									<img id="loadImage2" class="img-responsive" src='{{asset("images/resume/$data->profile_photo")}}'>
									</label>
										<br>	
									<span>Photo size : 180 X 200 px</span>
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
								<button type="submit" class="business-btn btn btn-success">Save Change</button>
									
								</div>
							</div>
						{{Form::close()}}
						</div>				
						</div><!-- profile-details -->
					</div><!-- user-pro-edit -->
				</div><!-- profile -->
				<div class="col-sm-2 no-padding-left">
					@include('frontend._partials.support')
				</div><!-- recommended-cta-->
			</div><!-- row -->	
		</div>				
	</div><!-- container -->
</section><!-- ad-profile-page -->
@endsection
