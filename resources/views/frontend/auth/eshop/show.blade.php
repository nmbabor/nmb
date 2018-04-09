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
				<div class="col-sm-10">
					<div class="business-section">
						<!-- profile-details -->
						<div class="profile-details section">
							<div class="business-profile">
								<div class="cover-photo">
								@if($data->cover_photo!=null and file_exists("images/business/cover/$data->cover_photo"))
									<img class="cover img-responsive" src='{{asset("images/business/cover/$data->cover_photo")}}' alt="Cover Photo">
								@else
									<img class="cover img-responsive" src='{{asset("images/business/cover/default.jpg")}}' alt="Cover Photo">

								@endif
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
										    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">About Organization </a></li>
										    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"> Product or Services </a></li>
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
											<a href="{{URL::to('business/profile/edit')}}" class="btn btn-xs btn-success">Edit</a>
											<a href="" class="btn btn-xs btn-info">Deactive</a>
											</li>
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
								<div class="adPost">
									<div class="col-md-8">
									<h2>All Ads from us</h2><hr>
							
							@if(count($adPost)==0)
								<h3>You have no ads!</h3>
							@endif
							@foreach($adPost as $ad)
							<div class="ad-item row">
								<!-- item-image -->
								<div id="adDelete{{$ad->id}}" style="display: none;">
									<div class="col-md-12 no-padding">
									    <div class="alert alert-danger alert-dismissable">
									        <h4>Do you want to delete this ad?</h4><br>
									        <b>{{$ad->title}}</b>
									        <br>
									        <br>
									        {{Form::open(array('route'=>['ad-post.destroy',$ad->id],'method'=>'DELETE','class'=>'frontend_del_btn'))}}
					            				<button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Delete this ad" >Yes</button>
					        				{!! Form::close() !!}
					        				<button type="button" class="btn btn-danger" onclick='return deleteCancel("{{$ad->id}}")'>Cancel</button>
									       </div>
									</div>
								</div>
								<div id="adPostInfo{{$ad->id}}">
									<div class="item-image-box col-sm-3">
										<div class="item-image">
										<? $photo= "images/post/small/$ad->photo_one";
										?>
											<a href='{{URL::to("ad-post/$ad->id/$ad->link")}}' title="{{$ad->title}}" >
											@if(($ad->photo_one!=null) and file_exists($photo) )
											<img src='{{asset("images/post/small/$ad->photo_one")}}' alt="{{$ad->title}}" class="img-responsive">
											@else
											<img src='{{asset("images/smallDefault.jpg")}}' alt="{{$ad->title}}" class="img-responsive">
											@endif
											</a>
										</div><!-- item-image -->
									</div>
									
									<!-- rending-text -->
									<div class="item-info col-sm-9">
										<!-- ad-info -->
										<div class="ad-info">
											<h3 class="item-price">Tk. {{$ad->price}}</h3>
											<h4 class="item-title"><a href='{{URL::to("ad-post/$ad->id/$ad->link")}}'  title="{{$ad->title}}">{{$ad->title}}</a></h4>
											<div class="item-cat">
												<span><a href='{{URL::to("ad-post/$ad->id/$ad->link")}}'>{{$ad->cat_name}}</a></span> /
												<span><a href='{{URL::to("ad-post/$ad->id/$ad->link")}}'>{{$ad->sub_category_name}}</a></span>
												@if($ad->last_step_category_name!=null)
												 / <span><a href='{{URL::to("ad-post/$ad->id/$ad->link")}}'>{{$ad->last_step_category_name}}</a></span>
												@endif
											</div>										
										</div><!-- ad-info -->
									
										<!-- ad-meta -->
										<div class="ad-meta">
											<div class="meta-content">
												<span class="dated"> <a><i class="fa fa-clock-o"></i> {{ date('jS M, Y h:i A',strtotime($ad->created_at))}}</a></span>
												<span class="visitors"><i class="fa fa-eye"></i> {{$ad->visitor}}</span>
											</div>										
											<!-- item-info-right -->
											<div class="user-option pull-right">
												<a class="edit-item" href='{{URL::to("ad-post/$ad->id/edit")}}' data-toggle="tooltip" data-placement="top" title="Edit this ad"><i class="fa fa-pencil"></i></a>
					            				<button class="btn btn-xs btn-danger" onclick='return deleteConfirm("{{$ad->id}}")' data-toggle="tooltip" data-placement="top" title="Delete this ad" ><i class="fa fa-times"></i></button>
											</div><!-- item-info-right -->
										</div><!-- ad-meta -->
									</div><!-- item-info -->
								</div>
								
							</div><!-- ad-item -->
						@endforeach
						
									</div>
									<div class="col-md-4">
										
									</div>
								</div>
							</div>
						</div><!-- profile-details -->
					</div><!-- user-pro-edit -->
				</div><!-- profile -->

				<div class="col-sm-2 text-center no-padding">
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

	<script type="text/javascript">
		
	function deleteConfirm(id){
		$('#adDelete'+id).css('display','block');
		$('#adPostInfo'+id).css('display','none');
	}
	function deleteCancel(id){
		$('#adDelete'+id).css('display','none');
		$('#adPostInfo'+id).css('display','block');
	}
	</script>
@endsection