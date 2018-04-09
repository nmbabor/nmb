@extends('frontend.app')
@section('content')
<!-- main -->
	<section id="main" class="clearfix details-page">
		<div class="container">
			
				@if(isset($banners[1]))
				<div class="banners-section">
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
			<div class="section banner">				
				<!-- banner-form -->
				<div class="banner-form banner-form-full">
					<form action="#">
						<!-- category-change -->
							
						{{Form::select('category',$category,'',['class'=>'form-control','placeholder'=>'Select category'])}}
						{{Form::select('category',$division_town,'',['class'=>'form-control','placeholder'=>'Select location'])}}
					
						<input type="text" class="form-control" placeholder="Type Your key word">
						<button type="submit" class="form-control" value="Search">Search</button>
					</form>
				</div><!-- banner-form -->
			</div><!-- banner -->
	

			<div class="section slider">				
				<div class="row">
					<!-- carousel -->
					<div class="col-md-12">
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
					<!-- slider-text -->
					<div class="col-md-8">
						<div class="col-md-3">
							<? $business=DB::table('business_account')->where('fk_user_id',$data->created_by)->first(); ?>
							@if(($business!=null) and ($business->profile_photo!=null) and file_exists("images/business/profile/$business->profile_photo"))
								<img src='{{asset("images/business/profile/$business->profile_photo")}}' alt="{{$data->title}}" class="img-responsive">
							@else
								<img src='{{asset("images/smallDefault.jpg")}}' alt="{{$data->title}}" class="img-responsive">
							@endif
						</div>
						<div class="col-md-9 slider-text">
							<h1 class="title">{{$data->title}}</h1>
							<? $businessLink=($business!=null and $business->link!=null)?$business->link:''; ?>
							<h2><span><i class="fa fa-user"></i> <a href='{{URL::to("business/$businessLink")}}'>{{$data->creator}}</a></span>
							</h2>
							<h3>Salary: {{$data->price}} {{($data->price2!=null)?' - '.$data->price2: ''}}</h3>
							<span class="icon"><i class="fa fa-map-marker"></i>{{($data->address!=null)?$data->address.', ':''}} {{$data->area_name}}, {{$data->division_name}}</span>					
						</div>
						
					</div><!-- slider-text -->
					<div class="col-md-4">
						<div class="text-right job-apply-btn">
						 @if (Auth::check())
						 <? $job=DB::table('job_application')->where(['fk_user_id'=>Auth::user()->id,'fk_post_id'=>$data->id])->count(); ?>
							 @if($job>0)
							 	<button class="btn btn-success"><i class="fa fa-check-square-o" aria-hidden="true"></i> Applied </button>
							 @else
								<button class="btn btn-info" data-toggle="modal" data-target="#jobApplyModal"><i class="fa fa-file-text-o" aria-hidden="true"></i> Apply for job</button>
							@endif
						@else
							<button class="btn btn-info" data-toggle="modal" data-target="#jobApplyModal"><i class="fa fa-file-text-o" aria-hidden="true"></i> Apply for job</button>
						@endif
						</div>
						 <!-- Modal -->
								<div class="modal fade" id="jobApplyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog" role="document">
								    <div class="modal-content">
								    <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        <h4 class="modal-title" id="myModalLabel">Are you sure you want to apply ? </h4>
								      </div>
								      <div class="modal-body ">
								        <input type="hidden" name="form" value="language">
								        <input type="hidden" name="id" value="{{$data->id}}">
								        <h4 class="text-centers">{{$data->title}}<br><small>{{$data->creator}}</small></h4>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
								        <a href='{{URL::to("job-apply/$data->id")}}' class="btn btn-primary">Confirm</a>
								      </div>
								    </div>
								  </div>
								</div><!-- /Delete Modal -->
							<!-- social-links -->
							<div class="social-links text-right">
								<h4>Share this Post</h4>
								<div id="share"></div>
							</div><!-- social-links -->	
					</div>
					<div class="col-md-12">
						<hr>
							
						</div>
						<? $count= count($postField);
							$pics=ceil($count/2);
						 ?>
						@foreach($postField->chunk($pics) as $fields)
						<div class="col-md-6">
							<ul class="job-post-field">
								@foreach($fields as $field)
								<li>
								<div class="col-md-6">
									<i class="fa fa-angle-double-right"></i> <strong>{{$field->title}} </strong>
								</div>
								<div class="col-md-6">
								: &nbsp;&nbsp;&nbsp;{{$field->field_value}}
								</div>
								</li>
								@endforeach
							</ul><!-- social-icon -->
						</div>
						@endforeach
				</div>				
			</div><!-- slider -->
			<div class="description-info">
				<div class="row">
					<!-- description -->
					<div class="col-md-8">
						<div class="description">
							<h4>Description</h4>
							<? echo $data->description ?>
						</div>
					</div><!-- description -->

					<!-- description-short-info -->
					<div class="col-md-4">					
						<div class="short-info">
							<img src='{{URL::to("images/ad/single.png")}}' class="img-responsive">
						</div>
					</div>
				</div><!-- row -->
			</div><!-- description-info -->	
			
			<div class="recommended-info">
				<div class="row">
					<div class="col-sm-12 no-padding">				
						<div class="section recommended-banner">
							<div class="featured-top">
								<h4>Recommended Job for You</h4>
							</div>
							@foreach($othersAd as $ad)
							<div class="banner-item col-md-6">

									<div class="item-image-box col-xs-3">
										<div class="item-image">
											<a href='{{URL::to("ad/$ad->link")}}' title="{{$ad->title}}" >
											<? $business=DB::table('business_account')->where('fk_user_id',$ad->created_by)->first(); ?>
												@if(($business!=null) and file_exists("images/business/profile/$business->profile_photo"))
												<img src='{{asset("images/business/profile/$business->profile_photo")}}' alt="{{$ad->title}}" class="img-responsive">
												@else
												<img src='{{asset("images/smallDefault.jpg")}}' alt="{{$ad->title}}" class="img-responsive">
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
												 <span><a href='{{URL::to("ad-post/$ad->id/$ad->link")}}'>{{$ad->last_step_category_name}}</a></span>
												 @else
												 <span><a href='{{URL::to("ad-post/$ad->id/$ad->link")}}'>{{$ad->sub_category_name}}</a></span>
												@endif
												<div>
												<span>{{$ad->area_name}}, {{$ad->division_name}}</span>
												</div>
											</div>

										</div><!-- ad-info -->
									</div><!-- item-info -->
								
								
							</div><!-- ad-item -->
						@endforeach
						</div>
					</div><!-- recommended-ads -->
				</div><!-- row -->
			</div><!-- recommended-info -->
		</div><!-- container -->
	</section><!-- main -->
	
@endsection

@section('scripts')
<script>
    $("#share").jsSocials({
      url:"{{URL::to('')}}",
      shareIn: "popup",
      text: '{{$data->title}} | {{URL::to("$data->link")}}',
      showLabel: false,
      showCount: false,
      shares: ["facebook", "email", "twitter", "googleplus", "linkedin"]
    });
</script>
@endsection

