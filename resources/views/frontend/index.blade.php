@extends('frontend.app')
@section('content')
<style type="text/css">
	@media (min-width: 1200px){
	.container {
	    width: 1170px;
	}
</style>
	<!-- main -->
	<section id="main" class="clearfix home-default">
		<div class="container">
			<!-- banner -->
			<div class="banner-section text-center">
					<h1 class="title">Online Market Marketplace in Bangladesh</h1> 
				<h2 class="title">Trade Bangla is a Marketplace in Bangladesh. Listing, ক্রয়- bikroy, Jobs, E-Shop </h2>
				<h3><strong>Trade Bangla is a free Classified & Marketplace in Bangladesh.  Buy and Sell Anything, Post your free ad.  Search for Cars, Mobile Phones, Computers, Software,  
Property, Animals, Pet & jobs in Bangladesh. </strong></h3>

				@if(isset($banners[1]))
				<div class="index-banner-one" style="margin-right: 15px;">
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
			</div><!-- banner -->
			
			<!-- main-content -->
			<div class="main-content">
					<div class="col-md-3 no-padding">
							<!-- panel-group -->
							<div class="panel-group" id="accordion">
							 	
								<!-- panel -->
								<div class="panel-default panel-faq">
									<!-- panel-heading -->
									<div class="panel-heading">
										<a data-toggle="collapse" data-parent="#accordion" href="#accordion-one">
											<h4 class="panel-title top_title"><strong>Business  Directory</strong> <i class="fa fa-angle-right pull-right"></i></h4>
										</a>
									</div><!-- panel-heading -->

									<div id="accordion-one" class="panel-collapse collapse collapse in">
										<!-- panel-body -->
										<div class="panel-body">
											<ul class="business-category" id="business-category">

											@foreach($category['business'] as $bCat)
												<li><a data-toggle="collapse" data-parent="#business-category" href="#accordion-{{$bCat->id}}">
												@if($bCat->icon_photo!=null)
												<img src='{{asset("public/img/category/2/$bCat->icon_photo")}}' alt="#" class="img-responsive businessCatImg">
												@else
												<i class="{{$bCat->icon_class}}"></i>
												@endif
												{{$bCat->name}}<span class="pull-right"><i class="fa fa-angle-right"></i></span></a>

												@if(count($businessSubCategory[$bCat->id])>0)
												<div id="accordion-{{$bCat->id}}" class="panel-collapse collapse " role="tabpanel">
													<div class="sub-business">
														<ul>
														@foreach($businessSubCategory[$bCat->id] as $subCat)
															<li><a href='{{URL::to("business/$bCat->link/$subCat->id")}}'><i class="fa fa-angle-double-right"></i>{{$subCat->sub_category_name}} </a></li>
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
							 </div><!-- panel-group -->
					</div>
					
					<!-- product-list -->

					<div class="col-md-9">
						<!-- categorys -->
						<div class="section section-home category-banner text-center">
						<div class="panel-default">
							<div class="panel-heading">
								<h4  class="panel-title top_title"><strong>Products / Services for Buy &amp; Sell</strong></h4> 
							</div>
							<div class="panel-body">
								<ul class="category-list">
								@foreach($category['product'] as $pCat)
									<li class="category-item">
										<a href='{{URL::to("ads/bangladesh/$pCat->link")}}'>
											<div class="category-icon productCatIcon">
												@if($pCat->icon_photo!=null)
												<img src='{{asset("public/img/category/1/$pCat->icon_photo")}}' alt="#" class="img-responsive ">
												@else
												<i class="{{$pCat->icon_class}}"></i>
												@endif
											</div>
											<span class="category-title"><strong>{{$pCat->name}}</strong> ({{$pCat->ad}})</span>
										</a>
										<p class="short_description">{{$pCat->short_description}}</p>
									</li><!-- category-item -->
								@endforeach				
								</ul>
							</div>	
						</div>
										
						</div><!-- category-ad -->	
						
						

						<!-- ad-section -->	
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
						
				</div><!-- row -->
				<!-- <div class="col-md-12">
					
						<div class="section featureds">
							<div class="row">
								<div class="col-sm-12">
									<div class="section-title featured-top">
										<h4>e-Shop</h4>
									</div>
								</div>
							</div>
							

							<div class="featured-slider">
								<div id="featured-slider" >

									<div class="featured">
										<div class="featured-image">
											<a href=""><img src="{{asset('public/frontend/images/featured/1.jpg')}}" alt="" class="img-respocive"></a>
											<a href="#" class="verified" data-toggle="tooltip" data-placement="left" title="Verified"><i class="fa fa-check-square-o"></i></a>
										</div>
									</div>
									
									<div class="featured">
										<div class="featured-image">
											<a href=""><img src="{{asset('public/frontend/images/featured/2.jpg')}}" alt="" class="img-respocive"></a>
										</div>
									</div>
									
									<div class="featured">
										<div class="featured-image">
											<a href=""><img src="{{asset('public/frontend/images/featured/3.jpg')}}" alt="" class="img-respocive"></a>
											<a href="#" class="verified" data-toggle="tooltip" data-placement="left" title="Verified"><i class="fa fa-check-square-o"></i></a>
										</div>
									</div>
									<div class="featured">
										<div class="featured-image">
											<a href=""><img src="{{asset('public/frontend/images/trending/4.jpg')}}" alt="" class="img-respocive"></a>
										</div>
									</div>
									
									<div class="featured">
										<div class="featured-image">
											<a href=""><img src="{{asset('public/frontend/images/trending/3.jpg')}}" alt="" class="img-respocive"></a>
										</div>
									</div>
									<div class="featured">
										<div class="featured-image">
											<a href=""><img src="{{asset('public/frontend/images/featured/3.jpg')}}" alt="" class="img-respocive"></a>
											<a href="#" class="verified" data-toggle="tooltip" data-placement="left" title="Verified"><i class="fa fa-check-square-o"></i></a>
										</div>
									</div>
									<div class="featured">
										<div class="featured-image">
											<a href=""><img src="{{asset('public/frontend/images/trending/4.jpg')}}" alt="" class="img-respocive"></a>
										</div>
									</div>
									
									<div class="featured">
										<div class="featured-image">
											<a href=""><img src="{{asset('public/frontend/images/trending/3.jpg')}}" alt="" class="img-respocive"></a>
										</div>
									</div>
								</div>
							</div>
						</div>
				</div>
				 -->
				</div>
			</div><!-- main-content -->
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