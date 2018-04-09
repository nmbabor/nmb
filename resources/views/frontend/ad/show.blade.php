@extends('frontend.app')
@section('content')
<!-- main -->
<? 
$searchCategory=App\Model\Category::where(['status'=>1,'type'=>1])->pluck('name','link');?>
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
			<form action="{{URL::to('search')}}">
				{{Form::select('area',$division_town,'',['class'=>'form-control','placeholder'=>'Bangladesh','id'=>'area'])}}
				{{Form::select('cat',$searchCategory,'',['class'=>'form-control','placeholder'=>'All Category','id'=>'searchCategory'])}}
			
				<input type="text" class="form-control" value="{{isset($name)?$name:''}}" name="key" placeholder="Type Your key word" id="searchKey">

				<button type="submit" class="form-control">Search</button>
			</form>
		</div><!-- banner-form -->
			</div><!-- banner -->
	

			<div class="section slider product_single">				
				<div class="row">
					<!-- carousel -->
					<div class="col-md-7">
						<div id="product-carousel" class="carousel slide" data-ride="carousel">
							<!-- Indicators -->
							<ol class="carousel-indicators">
							<? $path="images/post" ?>
								@if(file_exists("$path/small/$data->photo_one") and ($data->photo_one!=null))
								<li data-target="#product-carousel" data-slide-to="0" class="active">
									<img src='{{asset("$path/small/$data->photo_one")}}' alt="Main Photo" class="img-responsive">
								</li>
								@else
								<li data-target="#product-carousel" data-slide-to="0" class="active">
									<img src='{{asset("images/default.jpg")}}' alt="Main Photo" class="img-responsive">
								</li>
								@endif
								@if(file_exists("$path/small/$data->photo_two") and ($data->photo_two!=null))
								<li data-target="#product-carousel" data-slide-to="1">
									<img src='{{asset("$path/small/$data->photo_two")}}' alt="Second Photo" class="img-responsive">
								</li>
								@endif
								@if(file_exists("$path/small/$data->photo_three") and ($data->photo_three!=null))
								<li data-target="#product-carousel" data-slide-to="2">
									<img src='{{asset("$path/small/$data->photo_three")}}' alt="Third Photo" class="img-responsive">
								</li>
								@endif
								@if(file_exists("$path/small/$data->photo_four") and ($data->photo_four!=null))
								<li data-target="#product-carousel" data-slide-to="3">
									<img src='{{asset("$path/small/$data->photo_four")}}' alt="Fourth Photo" class="img-responsive">
								</li>

								@endif
							</ol>

							<!-- Wrapper for slides -->
							<div class="carousel-inner" role="listbox">
								<!-- item -->
								@if(file_exists("$path/big/$data->photo_one") and ($data->photo_one!=null))
								<div class="item active">
									<div class="carousel-image">
										<!-- image-wrapper -->
										<img src='{{asset("$path/big/$data->photo_one")}}' alt="Main Photo" class="img-responsive">
									</div>
								</div><!-- item -->
								@else
								<div class="item active">
									<div class="carousel-image">
										<!-- image-wrapper -->
										<img src='{{asset("images/default.jpg")}}' alt="Main Photo" class="img-responsive">
									</div>
								</div><!-- item -->
								@endif

								@if(file_exists("$path/big/$data->photo_two") and ($data->photo_two!=null))
								<!-- item -->
								<div class="item">
									<div class="carousel-image">
										<!-- image-wrapper -->
										<img src='{{asset("$path/big/$data->photo_two")}}' alt="Second Photo" class="img-responsive">
									</div>
								</div><!-- item -->
								@endif

								@if(file_exists("$path/big/$data->photo_three") and ($data->photo_three!=null))
								<!-- item -->
								<div class="item">
									<div class="carousel-image">
										<!-- image-wrapper -->
										<img src='{{asset("$path/big/$data->photo_three")}}' alt="Third Photo" class="img-responsive">
									</div>
								</div><!-- item -->
								@endif

								@if(file_exists("$path/big/$data->photo_four") and ($data->photo_four!=null))
								<!-- item -->
								<div class="item">
									<div class="carousel-image">
										<!-- image-wrapper -->
										<img src='{{asset("$path/big/$data->photo_four")}}' alt="Fourth Photo" class="img-responsive">
									</div>
								</div><!-- item -->
								@endif
							</div><!-- carousel-inner -->

							<!-- Controls -->
							<a class="left carousel-control" href="#product-carousel" role="button" data-slide="prev">
								<i class="fa fa-chevron-left"></i>
							</a>
							<a class="right carousel-control" href="#product-carousel" role="button" data-slide="next">
								<i class="fa fa-chevron-right"></i>
							</a><!-- Controls -->
						</div>
					</div><!-- Controls -->	

					<!-- slider-text -->
					<div class="col-md-5">
						<div class="slider-text">
							<h1 class="title">{{$data->title}}</h1>
							<h2><span><i class="fa fa-user"></i> 
							<? $business=DB::table('business_account')->where('fk_user_id',$data->created_by)->first(); ?>
							@if(count($business)>0)
							<a class="text-success" href='{{URL::to("business/$business->link")}}'>{{$data->creator}}</a>
							@else
							{{$data->creator}}

							@endif
							</span>
							</h2>
							<h3>Tk. {{$data->price}}</h3>
							<span class="icon"><i class="fa fa-map-marker"></i>{{$data->address}}<br><i></i> - {{$data->area_name}}, {{$data->division_name}}</span>
							<br>
							<span class="icon"><i class="fa fa-folder"></i><a href='{{URL::to("ads/$data->cat_link")}}'>{{$data->cat_name}}</a>/ <a href="">{{$data->sub_category_name}}</a><a href="#"> {{isset($data->last_step_category_name)?'/ '.$data->last_step_category_name:''}}</a></span>
							<!-- contact-with -->
							<div class="contact-with">
								<h4>Contact with </h4>
								<span class="btn btn-red show-number">
									<i class="fa fa-phone-square"></i>
									<span class="hide-text">Click to show phone number </span> 
									<span class="hide-number">
										@foreach($mobile as $number)
										{{$number->mobile_number}}<br>
										@endforeach
									</span>
								</span>
								<!-- <a href="mailto:{{$data->email}}" data-toggle="tooltip" data-placement="top" title="{{$data->email}}" class="btn"><i class="fa fa-envelope-square"></i>Reply by email</a> -->
							</div><!-- contact-with -->
							
							<!-- social-links -->
							<div class="social-links">
								<h4>Share this ad</h4>
								<div id="share"></div>
							</div><!-- social-links -->						
						</div>
					</div><!-- slider-text -->				
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
							<h4>Short Info</h4>
							<!-- social-icon -->
							<ul>
								<li><i class="fa fa-bars"></i><strong>Condition: </strong>{{($data->condition==1)?'New':'Used'}}</li>
								
								@if($data->brand_name!=null)
								<li><i class="fa fa-bars"></i><a href="#"><strong>Brand: </strong>{{$data->brand_name}}</a></li>
								@endif
								@foreach($postField as $field)
								<li><i class="fa fa-bars"></i><strong>{{$field->title}}: </strong>{{$field->field_value}}</li>
								@endforeach
								@foreach($extraPart as $part)
								<li><i class="fa fa-bars"></i><strong>{{$part['title']}}: </strong>{{$part['field_value']}} {{$part['field_value2']}} </li>
								@endforeach
								<li><i class="fa fa-shopping-cart"></i><a>Delivery: Meet in person</a></li>
								<li><i class="fa fa-heart-o"></i><a href="#">Save ad as Favorite</a></li>
							</ul><!-- social-icon -->
						</div>
					</div>
				</div><!-- row -->
			</div><!-- description-info -->	
			<br>
			<div class="recommended-info">
				<div class="row">
					<div class="col-sm-12 no-padding">				
						<div class="section recommended-banner">
							<div class="featured-top">
								<h4>Recommended Ads for You</h4>
							</div>
							@foreach($othersAd as $ad)
							<div class="banner-item col-md-6 no-padding">

									<div class="item-image-box col-xs-3">
										<div class="item-image">
										<? $photo= "images/post/small/$ad->photo_one";
										?>
											<a href='{{URL::to("ad/$ad->link")}}' title="{{$ad->title}}" >
											@if(($ad->photo_one!=null) and file_exists($photo) )
											<img src='{{asset("images/post/small/$ad->photo_one")}}' alt="{{$ad->title}}" class="img-responsive">
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

