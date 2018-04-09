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
								
							
							{!! Form::open(array('url' => ['resume-objective',$data->id],'class'=>'form-horizontal', 'data-toggle'=>'validator','role'=>'form','method'=>'POST','files'=>'true')) !!}
							<div class="form-group{{ $errors->has('career_objective') ? ' has-error' : '' }}">
								<label class="col-sm-12">Career Objective : </label>
								<div class="col-sm-12">
									<textarea name="career_objective" placeholder="Write your career objective" rows="8" class="form-control" required>{{$data->career_objective}}</textarea>
									<div class="help-block with-errors"></div>
									 @if ($errors->has('career_objective'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('career_objective') }}</strong>
		                                </span>
		                            @endif
		                           
								</div>
								
							</div>
							<div class="form-group{{ $errors->has('special_qualification') ? ' has-error' : '' }}">
								<label class="col-sm-12">Special Qualification : </label>
								<div class="col-sm-12">
									<textarea name="special_qualification" placeholder="Write your Special Qualification" rows="8" class="form-control">{{$data->special_qualification}}</textarea>
									<div class="help-block with-errors"></div>
									 @if ($errors->has('special_qualification'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('special_qualification') }}</strong>
		                                </span>
		                            @endif
		                           
								</div>
								
							</div>
							<div class="form-group ">
								<div class="col-sm-12">
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
				</div>
			</div><!-- row -->	
		</div>				
	</div><!-- container -->
</section><!-- ad-profile-page -->
@endsection
