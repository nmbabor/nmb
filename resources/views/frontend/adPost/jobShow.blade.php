@extends('frontend.app')
@section('content')
<!-- main -->
	<section id="main" class="clearfix details-page">
		<div class="container">
			
						
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
					<div class="col-md-8">
						<div id="adDelete" style="display: none;">
							<div class="col-md-12 no-padding">
							    <div class="alert alert-danger alert-dismissable">
							        <h4>Do you want to delete this ad?</h4>
							        <b>{{$data->title}}</b>
							        <br>
							        <br>
							        {{Form::open(array('route'=>['ad-post.destroy',$data->id],'method'=>'DELETE','class'=>'frontend_del_btn'))}}
			            				<button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Delete this ad" >Yes</button>
			        				{!! Form::close() !!}
			        				<button type="button" class="btn btn-danger" onclick='return deleteCancel()'>Cancel</button>
							       </div>
							</div>
						</div>
						<div id="adPostInfo">
							<div class="col-md-12 no-padding">
								<div class="">
									<a href='{{URL::to("ad-post/$data->id/edit")}}' class="btn btn-xs btn-info"><i class="fa fa-pencil-square"></i> Edit</a>
									<button class="btn btn-xs btn-danger" onclick='return deleteConfirm()'><i class="fa fa-trash"></i> Delete</button>
									<a href='{{URL::to("my-ads")}}' class="btn btn-xs btn-success"><i class="fa fa-bars"></i> My ads</a>
								</div>
								<hr>
							</div>
						</div>
					
						
						<div class="slider-text">
							<h1 class="title">{{$data->title}}</h1>
							<h2><span><i class="fa fa-user"></i> <a href="#">{{$data->creator}}</a></span>
							<span> <i class="fa fa-eye"></i><a class="time">{{$data->visitor}}</a></span></h2>
							<h3>Tk. {{$data->price}} {{($data->price2!=null)?' - '.$data->price2: ''}}</h3>
							<span class="icon"><i class="fa fa-clock-o"></i>{{ date('jS M, Y h:i A',strtotime($data->created_at))}}</span><br>
							<span class="icon"><i class="fa fa-map-marker"></i>{{($data->address!=null)?$data->address.', ':''}} {{$data->area_name}}, {{$data->division_name}}</span>
							
							<!-- contact-with -->
						</div>
					</div><!-- slider-text -->
					<div class="col-md-4">
						<div class="text-center job-apply-btn">
							<button class="btn btn-success"><i class="fa fa-file-text-o" aria-hidden="true"></i> Apply for job</button>
						</div>
							
							<!-- social-links -->
							<div class="social-links">
								<h4>Share this Post</h4>
								<ul class="list-inline">
									<li><a href="#" title="Share with facebook"><i class="fa fa-facebook-square"></i></a></li>
									<li><a href="#" title="Share with twitter"><i class="fa fa-twitter-square"></i></a></li>
									<li><a href="#" title="Share with google plus"><i class="fa fa-google-plus-square"></i></a></li>
									<li><a href="#" title="Share with linkedin"><i class="fa fa-linkedin-square"></i></a></li>
								</ul>
							</div><!-- social-links -->	
					</div>


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
								
								
								@if($data->brand_name!=null)
								<li><i class="fa fa-bars"></i><a href="#"><strong>Brand: </strong>{{$data->brand_name}}</a></li>
								@endif
								@foreach($postField as $field)
								<li><i class="fa fa-bars"></i><strong>{{$field->title}}: </strong>{{$field->field_value}}</li>
								@endforeach
								@foreach($extraPart as $part)
								<li><i class="fa fa-bars"></i><strong>{{$part['title']}}: </strong>{{$part['field_value']}} {{$part['field_value2']}} </li>
								@endforeach
							</ul><!-- social-icon -->
						</div>
					</div>
				</div><!-- row -->
			</div><!-- description-info -->	
			
			<div class="recommended-info">
				<div class="row">
					<div class="col-sm-8">				
						<div class="section recommended-ads">
							<div class="featured-top">
								<h4>Others Post</h4>
							</div>
							@foreach($othersAd as $ad)
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
					        				<button type="button" class="btn btn-danger" onclick='return deleteCancel1("{{$ad->id}}")'>Cancel</button>
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
												@if($ad->is_approved!=0)
												<span class="visitors"><i class="fa fa-eye"></i> {{$ad->visitor}}</span>
												@else
												<span class="pending text-warning">Pending</span>
												@endif
											</div>										
											<!-- item-info-right -->
											<div class="user-option pull-right">
												<a class="edit-item" href='{{URL::to("ad-post/$ad->id/edit")}}' data-toggle="tooltip" data-placement="top" title="Edit this ad"><i class="fa fa-pencil"></i></a>
					            				<button class="btn btn-xs btn-danger" onclick='return deleteConfirm1("{{$ad->id}}")' data-toggle="tooltip" data-placement="top" title="Delete this ad" ><i class="fa fa-times"></i></button>
											</div><!-- item-info-right -->
										</div><!-- ad-meta -->
									</div><!-- item-info -->
								</div>
								
							</div><!-- ad-item -->
						@endforeach
						</div>
					</div><!-- recommended-ads -->

					<div class="col-sm-4 text-center">
						@include('frontend._partials.support')
					</div><!-- recommended-cta-->
				</div><!-- row -->
			</div><!-- recommended-info -->
		</div><!-- container -->
	</section><!-- main -->
	
@endsection
@section('scripts')
	<script type="text/javascript">
		function deleteConfirm(id){
			$('#adDelete').css('display','block');
			$('#adPostInfo').css('display','none');
		}
		function deleteCancel(id){
			$('#adDelete').css('display','none');
			$('#adPostInfo').css('display','block');
		}

		function deleteConfirm1(id){
			$('#adDelete'+id).css('display','block');
			$('#adPostInfo'+id).css('display','none');
		}
		function deleteCancel1(id){
			$('#adDelete'+id).css('display','none');
			$('#adPostInfo'+id).css('display','block');
		}
	</script>
@endsection
