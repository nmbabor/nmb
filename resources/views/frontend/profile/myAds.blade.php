@extends('frontend.app')
@section('content')
<!-- myads-page -->
	<section id="main" class="clearfix mypost-page">
		<div class="container">

			<div class="breadcrumb-section">
				<!-- breadcrumb -->
				<ol class="breadcrumb">
					<li><a href="index.html">Home</a></li>
					<li>{{$title}} Ad</li>
				</ol><!-- breadcrumb -->
			</div><!-- banner -->

			@include('frontend.profile.profileHeader')			
			
			<div class="posts-info">
				<div class="row">
						
					<div class="col-sm-10">
						
						<div class="my-post section">
							<h2>{{$title}} ads</h2>
							<!-- ad-item -->
							@if(count($adPost)==0)
								<h3>You have no ads!</h3>
							@endif
							@foreach($adPost as $ad)
							<div class="banner-item row">
								<!-- item-image -->
								<div id="adDelete{{$ad->id}}" style="display: none;">
									<div class="col-md-12 no-padding">
									    <div class="alert alert-danger alert-dismissable">
									        <b>Do you want to delete this ad?</b><br>
									        <b>{{$ad->title}}</b>
									        <br>
									        {{Form::open(array('route'=>['ad-post.destroy',$ad->id],'method'=>'DELETE','class'=>'frontend_del_btn'))}}
					            				<button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Delete this ad" >Yes</button>
					        				{!! Form::close() !!}
					        				<button type="button" class="btn btn-danger" onclick='return deleteCancel("{{$ad->id}}")'>Cancel</button>
									       </div>
									</div>
								</div>
								<div id="adPostInfo{{$ad->id}}">
									<div class="item-image-box col-xs-3">
										<div class="item-image">
										<? $photo= "images/post/small/$ad->photo_one";
										?>
											<a href='{{URL::to("ad-post/$ad->id/$ad->link")}}' title="{{$ad->title}}" >
											@if($ad->type!=3)
												@if(($ad->photo_one!=null) and file_exists($photo) )
												<img src='{{asset("images/post/small/$ad->photo_one")}}' alt="{{$ad->title}}" class="img-responsive dashboard-img">
												@else
												<img src='{{asset("images/smallDefault.jpg")}}' alt="{{$ad->title}}" class="img-responsive dashboard-img">
												@endif
											@else
												@if((count($business)>0) and ($business->profile_photo!=null) and file_exists("images/business/profile/$business->profile_photo") )
												<img src='{{asset("images/business/profile/$business->profile_photo")}}' alt="{{$ad->title}}" class="img-responsive dashboard-img">
												@else
												<img src='{{asset("images/smallDefault.jpg")}}' alt="{{$ad->title}}" class="img-responsive dashboard-img">
												@endif
											@endif
											</a>
										</div><!-- item-image -->
									</div>
									
									<!-- rending-text -->
									<div class="item-info col-xs-9">
										<!-- ad-info -->
										<div class="post-info">
											<h2 class="item-title"><a href='{{URL::to("ad-post/$ad->id/$ad->link")}}'  title="{{$ad->title}}">{{$ad->title}}</a></h2>
											@if($ad->type!=3)
												<h3 class="item-price">Tk. {{$ad->price}}</h3>
											@else
												<h3 class="item-price">{{Auth::user()->name}}</h3>
												<h5>Tk. {{$ad->price}} {{($ad->price2!=null)?' - '.$ad->price2: ''}}</h5>
											@endif

											<div class="item-cat">
												@if($ad->last_step_category_name!=null)
												 <span><a href='{{URL::to("ad-post/$ad->id/$ad->link")}}'>{{$ad->last_step_category_name}}</a></span>
												@else
												<span><a href='{{URL::to("ad-post/$ad->id/$ad->link")}}'>{{$ad->sub_category_name}}</a></span>
												@endif
													@if($title!='Pending')
													<span class="visitors"><i class="fa fa-eye"></i> {{$ad->visitor}}</span>
													@else
													<span class="pending">{{$title}}</span>
													@endif
												<div class="user-option pull-right">
													<a class="edit-item btn btn-info btn-xs" href='{{URL::to("ad-post/$ad->id/edit")}}' data-toggle="tooltip" data-placement="top" title="Edit this ad"><i class="fa fa-pencil text-danger"></i></a>
						            				<button class="btn btn-xs btn-danger" onclick='return deleteConfirm("{{$ad->id}}")' data-toggle="tooltip" data-placement="top" title="Delete this ad" ><i class="fa fa-times"></i></button>
												</div><!-- item-info-right -->
											</div>										
										</div><!-- ad-info -->
									</div><!-- item-info -->
								</div>
							</div><!-- ad-item -->
						@endforeach
						</div>
					</div><!-- my-ads -->

					<!-- recommended-cta-->
					<div class="col-sm-2 no-padding-left">
						@include('frontend._partials.support')
					</div><!-- recommended-cta-->				
					
				</div><!-- row -->
			</div><!-- row -->
		</div><!-- container -->
	</section><!-- myads-page -->
@endsection
@section('scripts')

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