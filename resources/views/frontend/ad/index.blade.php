@extends('frontend.app')
@section('content')
<!-- main -->
<section id="main" class="clearfix category-page main-categories">
	<div class="container">
		@include('frontend.ad.header')

		<div class="category-info">	
			<div class="row">
				<!-- accordion-->
				
				<!-- recommended-ads -->
				<div class="col-sm-8 col-md-9">
					@include('frontend.ad.ad')
				</div><!-- recommended-ads -->
				<div class="col-md-3 col-sm-4">
					<div class="accordion">
						<!-- panel-group -->
						<div class="panel-group" id="accordion">
						 	
							<!-- panel -->
							<div class="panel-default panel-faq">
								<!-- panel-heading -->
								<div class="panel-heading active-faq">
									<a data-toggle="collapse" data-parent="#accordion" href="#accordion-one">
										<h4 class="panel-title">All Categories<span class="pull-right"><i class="fa fa-minus"></i></span></h4>
									</a>
								</div><!-- panel-heading -->

								<div id="accordion-one" class="panel-collapse collapse collapse in">
									<!-- panel-body -->
									<div class="panel-body">
										<ul>

											@foreach($productCategory as $cat)
												<li><a href='{{URL::to("ads/bangladesh/$cat->link")}}'>
												@if($cat->icon_photo!=null)
												<img src='{{asset("public/img/category/1/$cat->icon_photo")}}' alt="#" class="img-responsive businessCatImg">
												@else
												<i class="{{$cat->icon_class}}"></i>
												@endif
												{{$cat->name}}<span>({{$cat->ad}})</span></a></li>
											@endforeach
											
										</ul>
									</div><!-- panel-body -->
								</div>
							</div><!-- panel -->

							<!-- panel -->
							<div class="panel-default panel-faq">
								<!-- panel-heading -->
								<div class="panel-heading active-faq">
									<a data-toggle="collapse" data-parent="#accordion" href="#accordion-location">
										<h4 class="panel-title">Location<span class="pull-right"><i class="fa fa-minus"></i></span></h4>
									</a>
								</div><!-- panel-heading -->

								<div id="accordion-location" class="panel-collapse collapse collapse in">
									<!-- panel-body -->
									<div class="panel-body">
										<ul>

											@foreach($division as $div)
												<li><a href='{{URL::to("ads/$div->link")}}'>
												{{$div->name}}<span>({{$div->ad}})</span></a></li>
											@endforeach
											
										</ul>
									</div><!-- panel-body -->
								</div>
							</div><!-- panel -->
							<!-- panel -->
							
						 </div><!-- panel-group -->
					</div>
				</div><!-- accordion-->

			</div>	
		</div>
	</div><!-- container -->
</section><!-- main -->




@endsection