@extends('frontend.app')
@section('content')
	<!-- main -->
	<section id="main" class="clearfix category-page main-categories">
		<div class="container">
			<div class="breadcrumb-section">
				<!-- breadcrumb -->
				<ol class="breadcrumb">
					<li><a href="{{URL::to('/')}}">Home</a></li>
					<li><a href="{{URL::to('/business-directory')}}">Business</a> </li>
					<li>
						@if(isset($category->sub_category_name))
							{{$category->sub_category_name}}
						@elseif(isset($category->name))
							{{$category->name}}
						@else
							All Business
						@endif
					</li>
				</ol><!-- breadcrumb -->						
			</div>
	
			<div class="category-info">	
				<div class="row">
					<div class="col-md-12">
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
					</div>
					<!-- accordion-->
					<div class="col-md-3 col-sm-4 no-padding-right">
						<div class="accordion">
							<!-- panel-group -->
							<div class="panel-group" id="accordion">
							 	
								<!-- panel -->
								<div class="panel-default panel-faq">
									
									<!-- panel-heading -->
									<div class="panel-heading">
										<a data-toggle="collapse" data-parent="#accordion" href="#accordion-one">
											<h4 class="panel-title">Business Categories <i class="fa fa-angle-right pull-right"></i></h4>
										</a>
									</div><!-- panel-heading -->

									<div id="accordion-one" class="panel-collapse collapse collapse in">
										<!-- panel-body -->
										<div class="panel-body">
											<ul class="business-category" id="business-category">
											
											@foreach($businessCategory as $bCat)
												<li><a data-toggle="collapse" data-parent="#business-category" href="#accordion-{{$bCat->id}}">
												@if($bCat->icon_photo!=null)
												<img src='{{asset("public/img/category/2/$bCat->icon_photo")}}' alt="#" class="img-responsive businessCatImg">
												@else
												<i class="{{$bCat->icon_class}}"></i>
												@endif
												{{$bCat->name}}<span class="pull-right"><i class="fa fa-angle-right"></i></span></a>

												@if(count($businessSubCategory[$bCat->id])>0)
												<div id="accordion-{{$bCat->id}}" class="panel-collapse collapse {{(isset($category) and $bCat->id==$category->fk_category_id)?'in':''}}" role="tabpanel">
													<div class="sub-business">
														<ul>
														@foreach($businessSubCategory[$bCat->id] as $subCat)
															<li class="{{(isset($category) and $subCat->id==$category->id)?'active':''}}"><a href='{{URL::to("business/$bCat->link/$subCat->id")}}'><i class="fa fa-angle-double-right"></i>{{$subCat->sub_category_name}} </a></li>
														@endforeach
														</ul>
													</div>
												</div>
												@endif
												</li>
											@endforeach
											</ul>
										</div><!-- panel-body -->
									</div>
								
								</div><!-- panel -->

								<!-- panel -->
 
							 </div><!-- panel-group -->
						</div>
					</div><!-- accordion-->

					<!-- recommended-ads -->
					<div class="col-sm-8 col-md-7 no-padding-left">				
						<div class="section recommended-banner">
							<!-- featured-top -->
							<div class="featured-top business_header">
								<h2>@if(isset($category->sub_category_name))
										{{$category->sub_category_name}} in Bangladesh
									@elseif(isset($page_title))
										{{$page_title}}
									@else
										All Business in Bangladesh
									@endif
						 			
						 		</h2>							
							</div><!-- featured-top -->	
							@if(count($business)==0)
							<h2 class="text-danger">No Business Account found!</h2>
							@endif
							<!-- ad-item -->
							<? $adi=3; ?>
							@foreach($business->chunk(7) as $key => $bsns)
							@if($key>0)
							<? $adi++; ?>
								@if(isset($banners[$adi]))
								<div class="banners-section text-center">
									@if($banners[$adi]->is_photo==1)
					                  @if($banners[$adi]->photo!=null)
					                  <? $adPhoto=$banners[$adi]->photo; ?>
					                  <a href="{{$banners[$adi]->link}}" target="_blank">
					                  	<img class="img-responsive" src='{{asset("public/img/banners/$adPhoto")}}' alt="{{$banners[$adi]->caption}}">
					                  </a>
					                  @endif
					                @else
					                <? echo $banners[$adi]->script ?>
					                @endif

								</div>
					            @endif
							@endif
							@foreach($bsns as $data)
							<div class="banner-item row">
								<!-- item-image -->
								<div class="item-image-box col-xs-4">
									<div class="item-image">
										<a href='{{URL::to("business/$data->link")}}'><img src='{{asset("images/business/profile/$data->profile_photo")}}' alt="{{$data->name}}" class="img-responsive"></a>
									</div><!-- item-image -->
								</div>
								
								<!-- rending-text -->
								<div class="item-info col-xs-8">
									<!-- ad-info -->
									<div class="post-info">
									<a href='{{URL::to("business/$data->link")}}'>
										<h2 class="item-price">{{$data->name}}</h2>
										<h5>{{$data->title}}</h5>
										<div class="item-cat">
											<span><i class="fa fa-map-marker"></i>  {{$data->location}}</span>
										</div>	
									</a>									
									</div><!-- ad-info -->
								</div><!-- item-info -->
							</div><!-- ad-item -->
						@endforeach
						@endforeach

							
							<!-- pagination  -->
							<div class="text-center">
								{{$business->render()}}
							</div><!-- pagination  -->					
						</div>
						<div class="col-md-12">
						@if(isset($banners[3]))
						<div class="banners-section">
							@if($banners[3]->is_photo==1)
			                  @if($banners[3]->photo!=null)
			                  <? $adPhoto=$banners[3]->photo; ?>
			                  <a href="{{$banners[3]->link}}" target="_blank">
			                  	<img class="img-responsive" src='{{asset("public/img/banners/$adPhoto")}}' alt="{{$banners[3]->caption}}">
			                  </a>

			                  @endif
			                @else
			                <? echo $banners[3]->script ?>
			                @endif

						</div>
			            @endif
					</div>
					</div><!-- recommended-ads -->

					<div class="col-md-2 hidden-xs">
						@if(isset($banners[2]))
						<div class="banners-section text-center">
							@if($banners[2]->is_photo==1)
			                  @if($banners[2]->photo!=null)
			                  <? $adPhoto=$banners[2]->photo; ?>
			                  <a href="{{$banners[2]->link}}" target="_blank">
			                  	<img class="img-responsive" src='{{asset("public/img/banners/$adPhoto")}}' alt="{{$banners[2]->caption}}">
			                  </a>

			                  @endif
			                @else
			                <? echo $banners[2]->script ?>
			                @endif

						</div>
			            @endif
					</div>
				</div>	
			</div>
		</div><!-- container -->
	</section><!-- main -->
	
@endsection
@section('scripts')
<script type="text/javascript">
	$( document ).ready(function() {
	    var width1 = $(window).width();
		 if(width1<=974){
		 	$('#accordion-one').removeClass('in');
		 }else{
		 	$('#accordion-one').addClass('in');
		 }
	});
	 
</script>
@endsection