@extends('frontend.app')
@section('content')
<section id="main" class="clearfix  ad-profile-page">
	<div class="container">
	
		<div class="breadcrumb-section">
			<!-- breadcrumb -->
			<ol class="breadcrumb">
				<li><a href="{{URL::to('/')}}">Home</a></li>
				<li>Eshop</li>
			</ol><!-- breadcrumb -->						
		</div><!-- banner -->
			@include('frontend.profile.profileHeader')			
		

		<div class="profile">
			<div class="row">
				
				<div class="col-sm-3 text-center">
					@include('frontend.auth.sidebar')
				</div><!-- recommended-cta-->
				<div class="col-sm-9 no-padding-left">
					<div class="business-section">
						<!-- profile-details -->
						<div class="profile-details section">
						<div class="col-md-12">
							
							<h1 class="title">Update your E-Shop</h1>
							<hr>
						</div>
						<div class="col-md-12 no-padding">
							
							<!-- form -->
							{!! Form::open(array('route' => ['eshop.update',$data->id],'class'=>'form-horizontal', 'data-toggle'=>'validator','role'=>'form','method'=>'PUT','files'=>'true')) !!}
							@if($data->is_approved==1)
							 <div class="form-group">
							    <label class="col-sm-3 control-label">Visit your site</label>
							    <div class="col-sm-9">
							      <a target="_blank" href='http://{{$data->subdomain}}.tradebangla.com.bd' class="btn btn-xs btn-info">{{$data->subdomain}}.tradebangla.com.bd</a>
							    </div>
							   
							 </div>
							@endif
							<div class="form-group{{ $errors->has('subdomain') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">SubDomain</label>
								<div class="col-sm-9">
								    <div class="input-group">
								    <input type="text" name="subdomain" class="form-control" placeholder="Your Subdomain" required pattern="[^', _/%+=)(^!@#$&{}\x22]+" value="{{$data->subdomain}}" title="Do no use special character. ">
								      <div class="input-group-addon">.tradebangla.com.bd </div>
								    </div>
									
									<div class="help-block with-errors"></div>
									 @if ($errors->has('subdomain'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('subdomain') }}</strong>
		                                </span>
		                            @endif
		                           
								</div>
								
							</div>

							<div class="form-group{{ $errors->has('eshop_name') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Eshop Name</label>
								<div class="col-sm-9">
									
									<input name="eshop_name" type="text" class="form-control" placeholder="Ex: Smart Software" value="{{$data->eshop_name}}" required>
									<div class="help-block with-errors"></div>
									 @if ($errors->has('eshop_name'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('eshop_name') }}</strong>
		                                </span>
		                            @endif
								</div>
							</div>
							<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Title</label>
								<div class="col-sm-9">
									
									<input name="title" type="text" class="form-control" placeholder="Ex: Best Software Solution" value="{{$data->title}}" required>
									<div class="help-block with-errors"></div>
									 @if ($errors->has('title'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('title') }}</strong>
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

							<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">About Organization</label>
								<div class="col-sm-9">
									<? $description=(isset($data->description))?$data->description:''; ?>
									{{Form::textArea('description',$description,['class'=>'form-control textarea','placeholder'=>'About Organization','required'])}}
									<div class="help-block with-errors"></div>
									 @if ($errors->has('description'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('description') }}</strong>
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
						</div>
						</div><!-- profile-details -->
					</div><!-- user-pro-edit -->
				</div><!-- profile -->

				
			</div><!-- row -->	
		</div>				
	</div><!-- container -->
</section><!-- ad-profile-page -->
@endsection