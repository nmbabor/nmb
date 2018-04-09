@extends('frontend.app')
@section('content')
<section id="main" class="clearfix category-page main-categories">
	<div class="container">
		<div class="breadcrumb-section">
			<!-- breadcrumb -->
			<ol class="breadcrumb">
				<li><a href="{{URL::to('/')}}">Home</a></li>
				<li>All Directory</li>
			</ol><!-- breadcrumb -->						
		</div>
		<div class="main-content section">
			<h2 class="entry-title no-margin">Business Directory in Bangladesh</h2>
			<hr>
			<div class="col-md-12 no-padding">
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
			<ul class="directory-list">
			@foreach($businessCategory as $bCat)
				<li><a href='{{URL::to("business/cat/$bCat->link")}}'>{{$bCat->short_Description}}</a>
					<ul>
						@foreach($businessSubCategory[$bCat->id] as $sub)
						<li><a href='{{URL::to("business/$bCat->link/$sub->id")}}'>{{$sub->sub_category_name}}, </a></li>
						@endforeach
					</ul>
				</li>
			@endforeach
			</ul>
		</div>
	</div>
</section>


@endsection