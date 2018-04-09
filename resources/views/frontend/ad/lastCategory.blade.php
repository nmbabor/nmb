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
								<div class="panel-heading">
									<a data-toggle="collapse" data-parent="#accordion" href="#accordion-one">
										<h4 class="panel-title">{{$category->last_step_category_name}}<span class="pull-right"><i class="fa fa-minus"></i></span></h4>
									</a>
								</div><!-- panel-heading -->
								<? $areaLink=(isset($filter['area']))?"?area=".$filter['area']:''; ?>
								<div id="accordion-one" class="panel-collapse collapse in">
									<!-- panel-body -->
									<div class="panel-body">
										<ul>
										<li><a href='{{URL::to("/ads/$divLink/$link/$subId$areaLink")}}'><b><i class="fa fa-angle-double-left"></i> Back to sub category </b></a></li>
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
										@if($divLink!='bangladesh')
										<li><a href='{{URL::to("/ads/bangladesh/$link/$id")}}'><b><i class="fa fa-angle-double-left"></i>{{$division->name}} </b></a></li>
											@foreach($area as $div)
												<li class="sub-category @if(isset($filter['area']))  {{($filter['area']==$div->id) ?'active':''}} @endif"><a href='{{URL::to("ads/$divLink/$link/$subId/$id?area=$div->id")}}'>
												@if(isset($filter['area']) and $filter['area']==$div->id)  
												<i class="fa fa-angle-double-right"></i>
												@else
												<i class="fa fa-angle-right"></i>
												@endif
												{{$div->area_name}}<span>({{$div->ad}})</span></a></li>
											@endforeach
										@else
											@foreach($division as $div)
												<li><a href='{{URL::to("ads/$div->link/$link/$subId/$id")}}'>
												{{$div->name}}<span>({{$div->ad}})</span></a></li>
											@endforeach
										@endif
										</ul>
									</div><!-- panel-body -->
								</div>
							</div><!-- panel -->

							<!-- panel -->
							<div class="panel-default panel-faq">
								<!-- panel-heading -->
								<div class="panel-heading">
									<a data-toggle="collapse" data-parent="#accordion" href="#accordion-two">
										<h4 class="panel-title">Condition<span class="pull-right"><i class="fa fa-plus"></i></span></h4>
									</a>
								</div><!-- panel-heading -->

								<div id="accordion-two" class="panel-collapse collapse">
									<!-- panel-body -->
									<div class="panel-body">
										<label for="new"><input type="checkbox" name="new" id="new"> New</label>
										<label for="used"><input type="checkbox" name="used" id="used"> Used</label>
									</div><!-- panel-body -->
								</div>
							</div><!-- panel -->

							<!-- panel -->
							<div class="panel-default panel-faq">
								<!-- panel-heading -->
								<div class="panel-heading">
									<a data-toggle="collapse" data-parent="#accordion" href="#accordion-three">
										<h4 class="panel-title">
										Price
										<span class="pull-right"><i class="fa fa-plus"></i></span>
										</h4>
									</a>
								</div><!-- panel-heading -->

								<div id="accordion-three" class="panel-collapse collapse">
									<!-- panel-body -->
									<div class="panel-body">
										<div class="price-range"><!--price-range-->
											<div class="price">
												<span>$100 - <strong>$700</strong></span>
												<div class="dropdown category-dropdown pull-right">	
													<a data-toggle="dropdown" href="#"><span class="change-text">USD</span><i class="fa fa-caret-square-o-down"></i></a>
													<ul class="dropdown-menu category-change">
														<li><a href="#">$05</a></li>
														<li><a href="#">$10</a></li>
														<li><a href="#">$15</a></li>
														<li><a href="#">$20</a></li>
														<li><a href="#">$25</a></li>
													</ul>								
												</div><!-- category-change -->													
												 <input type="text"value="" data-slider-min="0" data-slider-max="700" data-slider-step="5" data-slider-value="[250,450]" id="price" ><br />
											</div>
										</div><!--/price-range-->
									</div><!-- panel-body -->
								</div>
							</div><!-- panel -->

							<!-- panel -->
							<div class="panel-default panel-faq">
								<!-- panel-heading -->
								<div class="panel-heading">
									<a data-toggle="collapse" data-parent="#accordion" href="#accordion-four">
										<h4 class="panel-title">
										Posted By
										<span class="pull-right"><i class="fa fa-plus"></i></span>
										</h4>
									</a>
								</div><!-- panel-heading -->

								<div id="accordion-four" class="panel-collapse collapse">
									<!-- panel-body -->
									<div class="panel-body">
										<label for="individual"><input type="checkbox" name="individual" id="individual"> Individual</label>
										<label for="dealer"><input type="checkbox" name="dealer" id="dealer"> Dealer</label>
										<label for="reseller"><input type="checkbox" name="reseller" id="reseller"> Reseller</label>
										<label for="manufacturer"><input type="checkbox" name="manufacturer" id="manufacturer"> Manufacturer</label>
									</div><!-- panel-body -->
								</div>
							</div><!-- panel -->

							<!-- panel -->
							<div class="panel-default panel-faq">
								<!-- panel-heading -->
								<div class="panel-heading">
									<a data-toggle="collapse" data-parent="#accordion" href="#accordion-five">
										<h4 class="panel-title">
										Brand
										<span class="pull-right"><i class="fa fa-plus"></i></span>
										</h4>
									</a>
								</div><!-- panel-heading -->

								<div id="accordion-five" class="panel-collapse collapse">
									<!-- panel-body -->
									<div class="panel-body">
										<input type="text" placeholder="Search Brand" class="form-control">
										<label for="apple"><input type="checkbox" name="apple" id="apple"> Apple</label>
										<label for="htc"><input type="checkbox" name="htc" id="htc"> HTC</label>
										<label for="micromax"><input type="checkbox" name="micromax" id="micromax"> Micromax</label>
										<label for="nokia"><input type="checkbox" name="nokia" id="nokia"> Nokia</label>
										<label for="others"><input type="checkbox" name="others" id="others"> Others</label>
										<label for="samsung"><input type="checkbox" name="samsung" id="samsung"> Samsung</label>
											<span class="border"></span>
										<label for="acer"><input type="checkbox" name="acer" id="acer"> Acer</label>
										<label for="bird"><input type="checkbox" name="bird" id="bird"> Bird</label>
										<label for="blackberry"><input type="checkbox" name="blackberry" id="blackberry"> Blackberry</label>
										<label for="celkon"><input type="checkbox" name="celkon" id="celkon"> Celkon</label>
										<label for="ericsson"><input type="checkbox" name="ericsson" id="ericsson"> Ericsson</label>
										<label for="fly"><input type="checkbox" name="fly" id="fly"> Fly</label>
										<label for="g-fone"><input type="checkbox" name="g-fone" id="g-fone"> g-Fone</label>
										<label for="gionee"><input type="checkbox" name="gionee" id="gionee"> Gionee</label>
										<label for="haier"><input type="checkbox" name="haier" id="haier"> Haier</label>
										<label for="hp"><input type="checkbox" name="hp" id="hp"> HP</label>

									</div><!-- panel-body -->
								</div>
							</div> <!-- panel -->   
						 </div><!-- panel-group -->
					</div>
				</div><!-- accordion-->

				
			</div>	
		</div>
	</div><!-- container -->
</section><!-- main -->




@endsection