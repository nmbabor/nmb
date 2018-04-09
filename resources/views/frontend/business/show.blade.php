@extends('frontend.app')
@section('content')
<section id="main" class="clearfix  ad-profile-page">
	<div class="container">
	
		<div class="breadcrumb-section">
			<!-- breadcrumb -->
			<ol class="breadcrumb">
				<li><a href="{{URL::to('/')}}">Home</a></li>
				<li><a href="{{URL::to('/business')}}">Business</a></li>
				<li>{{$data->name}}</li>
			</ol><!-- breadcrumb -->						
		</div><!-- banner -->	

		<div class="profile">
			<div class="row">
				<div class="col-sm-10">
					<div class="business-section">
						<!-- profile-details -->
						<div class="profile-details section">
							<div class="business-profile">
								<div class="cover-photo">
									<img class="cover img-responsive" src='{{asset("images/business/cover/$data->cover_photo")}}' alt="Cover Photo">
									<div class="profile-info">
									<img class="img-responsive profile-photo" src='{{asset("images/business/profile/$data->profile_photo")}}' alt="Profile Photo">
									<h2>{{$data->name}}</h2>
										
									</div>
								</div>
								<div class="business-details">
									<div class="col-md-8">
										<h3>{{$data->title}}</h3>
										<div>

										  <!-- Nav tabs -->
										  <ul class="nav nav-tabs" role="tablist">
										    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">About <span class="hidden-xs">Organization </span></a></li>
										    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><span class="hidden-xs"> Product or </span> Services </a></li>
										  </ul>

										  <!-- Tab panes -->
										  <div class="tab-content">
										    <div role="tabpanel" class="tab-pane active" id="home">
										    	<? echo $data->description ?>
										    </div>
										    <div role="tabpanel" class="tab-pane" id="profile">
										    	<? echo $data->services ?>
										    </div>
										  </div>

										</div>
									</div>
									<div class="col-md-4">
										<ul>
											<li>
												<h4>Business: {{$data->sub_category_name}}</h4>
											</li>
											<li>
												<h4><i class="fa fa-clock-o"></i> Opening Time</h4>
												<h5>Open Hours :<b> {{$data->open_hour}}</b></h5>
												<h5 class="text-danger">Close Day :<b> {{$data->closed_day}}</b></h5>
											</li>
											<li>
												<h4><i class="fa fa-map-marker"></i> {{$data->location}}</h4>
											</li>
											<li>
												<h4><i class="fa fa-phone-square"></i> {{$data->contact_phone}}</h4>
											</li>
											<li>
												<h4><i class="fa fa-envelope"></i> {{$data->contact_email}}</h4>
											</li>
											@if($data->website!=null)
											<li>
												<h4><i class="fa fa-globe"></i> <a href="{{$data->website}}" target="_blank">{{$data->website}}</a></h4>
											</li>
											@endif
										</ul>
									</div>
								</div>
								<div class="bannerPost">
									<div class="col-md-8">
									<h4>All Ads</h4><hr>
							
							@if(count($adPost)==0)
								<h4>No ads found!</h4>
							@endif
							@foreach($adPost as $ad)
							<div class="banner-item row">
								<!-- item-image -->
									<div class="item-image-box col-xs-3">
										<div class="item-image">
										<? $photo= "images/post/small/$ad->photo_one";
										?>
											<a href='{{URL::to("ad/$ad->link")}}' title="{{$ad->title}}" >
										@if($ad->type!=3)
											@if(($ad->photo_one!=null) and file_exists($photo) )
											<img src='{{asset("images/post/small/$ad->photo_one")}}' alt="{{$ad->title}}" class="img-responsive">
											@else
											<img src='{{asset("images/smallDefault.jpg")}}' alt="{{$ad->title}}" class="img-responsive">
											@endif
										@else
											<? $business=DB::table('business_account')->where('fk_user_id',$ad->created_by)->first();?>
												@if(($business!=null) and ($business->profile_photo!=null) and file_exists("images/business/profile/$business->profile_photo"))
												<img src='{{asset("images/business/profile/$business->profile_photo")}}' alt="{{$ad->title}}" class="img-responsive">
												@else
												<img src='{{asset("images/smallDefault.jpg")}}' alt="{{$ad->title}}" class="img-responsive">
												@endif
										@endif

											</a>
										</div><!-- item-image -->
									</div>
									
									<!-- rending-text -->
									<div class="item-info col-xs-9">
										<!-- ad-info -->
										<div class="post-info">
											<h3 class="item-price">Tk. {{$ad->price}}</h3>
											<h4 class="item-title"><a href='{{URL::to("ad/$ad->link")}}'  title="{{$ad->title}}">{{$ad->title}}</a></h4>
											<div class="item-cat">
												@if($ad->last_step_category_name!=null)
												 <span>{{$ad->last_step_category_name}}</span>
												@endif
											</div>
											<div>
												<span class="dated"> <a><i class="fa fa-clock-o"></i> {{ date('jS M, Y h:i A',strtotime($ad->created_at))}}</a></span>
											</div>										
										</div><!-- ad-info -->
									</div><!-- item-info -->
								
								
							</div><!-- ad-item -->
						@endforeach
						<div>
							{{$adPost->render()}}
						</div>
									</div>
									<div class="col-md-4">
										
									</div>
								</div>
							</div>
						</div><!-- profile-details -->
					</div><!-- user-pro-edit -->
				</div><!-- profile -->

				<div class="col-sm-2 text-center no-padding">
					@if(isset($banners[1]))
						<div class="banners-section text-center">
							@if($banners[1]->is_photo==1)
			                  @if($banners[1]->photo!=null)
			                  <? $adPhoto=$banners[1]->photo; ?>
			                  <a href="{{$banners[1]->link}}" target="_blank">
			                  	<img class="img-responsive" src='{{asset("public/img/banners/$adPhoto")}}' alt="{{$banners[1]->caption}}">
			                  </a>

			                  @endif
			                @else
			                <? echo $banners[1]->script ?>
			                @endif

						</div>
			            @endif
				</div><!-- recommended-cta-->
			</div><!-- row -->	
		</div>				
	</div><!-- container -->
</section><!-- ad-profile-page -->
@endsection