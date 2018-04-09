@extends('frontend.app')
@section('content')
<section id="main" class="clearfix  ad-profile-page">
	<div class="container">
	
		<div class="breadcrumb-section">
			<!-- breadcrumb -->
			<ol class="breadcrumb">
				<li><a href="{{URL::to('/')}}">Home</a></li>
				<li>Profile</li>
			</ol><!-- breadcrumb -->						
		</div><!-- banner -->
			@include('frontend.profile.profileHeader')			
		

		<div class="profile">
			<div class="row">
				
				<div class="col-sm-10">
					<div class="user-pro-section">
						<!-- profile-details -->
						<div class="profile-details section">
							<h2>Profile Details</h2>
							<!-- form -->
							{!! Form::open(array('url' => 'profile-update','class'=>'form-horizontal', 'data-toggle'=>'validator','role'=>'form','method'=>'post')) !!}
							<div class="form-group">
								<label>Email ID</label>
								<div class="form-control">{{$profile->email}}
								@if($profile->email_verified==1)
								<span class="verified pull-right"><img src="{{asset('public/img/icon/verified.png')}}" alt="Verified" title="Verified"></span>
								@else
								<a href="#" class="pull-right text-danger" title="Not Verified !"><i class="fa fa-info-circle"></i> </a>
								@endif
								</div> 
							</div>
							<div class="form-group">
								<label>Mobile Number</label>
								<div class="form-control">{{$profile->mobile}} 
								@if($profile->mobile_verified==1)
								<span class="verified pull-right"><img src="{{asset('public/img/icon/verified.png')}}" alt="Verified" title="Verified"></span>
								@else
								<a href="#" class="pull-right text-danger" title="Not Verified !"><i class="fa fa-info-circle"></i></a>
								@endif
								</div>
							</div>
							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label>Name</label>
								<input name="name" type="text" class="form-control" placeholder="Name" value="{{$profile->name}}" required>
								 @if ($errors->has('name'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('name') }}</strong>
	                                </span>
	                            @endif
							</div>

							<div class="form-group">
								<label>Division/Town</label>
								<? $divisionId=(isset($userInfo->fk_division_id))?$userInfo->fk_division_id:'' ?>
								{{Form::select('fk_division_id',$division_town,$divisionId,['class'=>'form-control','placeholder'=>'Select division/town','onchange'=>"loadArea(this.value)",'required'])}}
								 @if ($errors->has('fk_division_id'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('fk_division_id') }}</strong>
	                                </span>
	                            @endif
							</div>
							<div class="form-group">
								<label id="area" style="{{(count($area)>0)?'':'display: none'}}">Your Area</label>
								<div id="loadArea">
							@if(count($area)>0)
								{{Form::select('fk_area_id',$area,$userInfo->fk_area_id,['class'=>'form-control','required'])}}
							@endif
								</div>
								 @if ($errors->has('fk_area_id'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('fk_area_id') }}</strong>
	                                </span>
	                            @endif

							</div>
							<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
								<label>Address</label>
								<? $address=(isset($userInfo->address))?$userInfo->address:''; ?>
								<input name="address" type="text" class="form-control" placeholder="Specific Address" value="{{$address}}">
								 @if ($errors->has('address'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('address') }}</strong>
	                                </span>
	                            @endif
							</div>
							<div class="form-group">
								<label></label>
								<button type="submit" class="btn btn-success">Update profile</button>
							</div>
						{{Form::close()}}				
						</div><!-- profile-details -->

						<!-- change-password -->
						<div class="change-password section">
							<h2>Change password</h2>
							<!-- form -->
						{!! Form::open(array('url' => 'changePassword','class'=>'form-horizontal','method'=>'POST')) !!}
							<div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
								<label>Old Password</label>
								<input name="old_password" type="password" class="form-control" required>

							</div>
							
							<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
								<label>New password</label>
								<input name="password" type="password" class="form-control"  placeholder="@if ($errors->has('password')) {{ $errors->first('password') }}
	                            @endif" required>
							</div>
							
							<div class="form-group">
								<label>Confirm password</label>
								<input name="password_confirmation" type="password" class="form-control">
							</div>
							<div class="form-group">
								<label></label>
								<button type="submit" class="btn btn-warning">Change Password </button>
							</div>	
						{{Form::close()}}													
						</div><!-- change-password -->
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
@section('scripts')
	<script type="text/javascript">
		function loadArea(id){
			$('#area').css('display','block')
			$('#loadArea').load('{{URL::to("loadArea")}}/'+id);
		}
	</script>
@endsection