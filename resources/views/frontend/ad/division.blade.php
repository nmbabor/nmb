@extends('frontend.app')
@section('content')
<!-- main -->
<section id="main" class="clearfix category-page main-categories">
	<div class="container">
		@include('frontend.ad.header')

		<div class="category-info">	
			<div class="row">
			<!-- recommended-ads -->
				<div class="col-sm-8 col-md-9">
					@include('frontend.ad.ad')
				</div><!-- recommended-ads -->
				<!-- accordion-->
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
												<li>
												@if(isset($filter['area']))
												<? $areaId=$filter['area']; ?>
												<a href='{{URL::to("ads/$divLink/$cat->link?area=$areaId")}}'>
												@else
												<a href='{{URL::to("ads/$divLink/$cat->link")}}'>
												@endif
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
										<li><a href='{{URL::to("/ads")}}'><b><i class="fa fa-angle-double-left"></i>{{$division->name}} </b></a></li>
											@foreach($area as $div)
												<li class="sub-category @if(isset($filter['area']))  {{($filter['area']==$div->id) ?'active':''}} @endif"><a href='{{URL::to("ads/$divLink?area=$div->id")}}'>
												@if(isset($filter['area']) and $filter['area']==$div->id)  
												<i class="fa fa-angle-double-right"></i>
												@else
												<i class="fa fa-angle-right"></i>
												@endif
												{{$div->area_name}}<span>({{$div->ad}})</span></a></li>
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