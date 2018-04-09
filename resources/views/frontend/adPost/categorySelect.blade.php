@extends('frontend.app')
@section('content')
	<!-- post-page -->
	<section id="main" class="clearfix banner-post-page">
		<div class="container">

			<div class="breadcrumb-section">
				<!-- breadcrumb -->
				<ol class="breadcrumb">
					<li><a href="index.html">Home</a></li>
					<li>Ad Post</li>
				</ol><!-- breadcrumb -->						
			</div><!-- banner -->

				
				
			<div id="banner-post">
				<div class="row category-tab">	
					<div class="col-md-3 col-sm-6">
						<div class="section cat-option select-category post-option">
							<h5>Select a Category</h5>
							<ul>
							@foreach($category as $cat)
								<li><a href="{{URL::to('ad-post')}}#sub-category" onclick="selectCat({{$cat->id}})">
									<span class="select cat_img">
									@if($cat->icon_photo!=null)
										<img src='{{asset("public/img/category/1/$cat->icon_photo")}}' alt="#" class="img-responsive">
									@else
										<i class="{{$cat->icon_class}}"></i>
									@endif
									</span>
									{{$cat->name}}
								</a></li>
							@endforeach
							</ul>
						</div>
					</div>
					<form action="{{URL::to('ad-post/create')}}" method="GET">
						
					<!-- Tab panes -->
					<div class="col-md-3 col-sm-6 scroll-right" id="sub-category">
						<div id="loadSubCat">
						</div>
					</div>
					<!-- Tab panes -->
					
						<div id="loadLastCat" class="scroll-right2">
							
						</div>
					<input type="hidden" value="" id="category_id" required>
					<div class="col-md-3 col-sm-6 next-btn" style="display: none;" id="next-submit">
						<div class="section next-stap post-option">
							
							<div class="btn-section">
								<button type="submit" class="btn btn-info">GO</button>
							</div>
							<!-- <p>Please DO NOT post multiple ads for the same items or service. All duplicate, spam and wrongly categorized ads will be deleted.</p> -->
						</div>
					</div><!-- next-stap -->
					</form>
				</div>
			</div>				
		</div><!-- container -->
	</section><!-- post-page -->
@endsection
@section('scripts')
<script type="text/javascript">
	function selectCat(id){
		$('.next-btn').css('display','none');
		$('#loadSubCat').load('{{URL::to("loadSubCat")}}/'+id);
		$('#loadLastCat').html('');
		$('.scroll-right').css({'margin-left':'0px','opacity':'1'});
	}
</script>
@endsection