@extends('frontend.app')
@section('content')
<section id="main" class="clearfix page">
	<div class="container">
		<div class="dynamic-page">
			<div class="breadcrumb-section">
				<!-- breadcrumb -->
				<ol class="breadcrumb">
					<li><a href="index.html">Home</a></li>
					<li>{{$data->name}}</li>
				</ol><!-- breadcrumb -->						
			</div>
		<div class="page-content section">
			@include('frontend.pages.header')
			<div class="col-md-9"> 
						<h2 class="entry-title">{{$data->title}}</h2>
				
				<div id="post-2112" class="tr-posts post-2112 post type-post status-publish format-standard has-post-thumbnail hentry category-blogging tag-creativity tag-social">

					<!-- <div class="entry-header"> 
						<div class="entry-thumbnail"> 
							<img width="1500" height="700" class="img-responsive" src="https://themes.themeregion.com/trade/wp-content/uploads/2017/06/blog-20.jpeg" alt="Eum Iriure Dolor Duis Autem"> 
						</div> 
					</div> -->
					<div class="post-content"> 
						<div class="entry-summary">
							<? echo $data->description; ?>
						</div>
					</div>
				</div><!--/post-->
			</div>					
		</div>

		</div>
	</div>
</section>

@endsection