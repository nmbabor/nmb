@extends('frontend.app')
@section('content')
	<section id="main" class="clearfix page">
		<div class="container">
			<div class="faq-page">
				<div class="breadcrumb-section">
					<!-- breadcrumb -->
					<ol class="breadcrumb">
						<li><a href="index.html">Home</a></li>
						<li>FAQ</li>
					</ol><!-- breadcrumb -->						
				</div>
		<div class="page-content section">
			@include('frontend.pages.header')
			<div class="col-md-9"> 
				<h2 class="entry-title">Frequently Ask Questions</h2>
				<hr>
				<div class="accordion">
					<div class="panel-group" id="accordion">			
					@foreach($faq as $key => $data)
						<div class="panel panel-default panel-faq">
							<div class="panel-heading ">
								<a data-toggle="collapse" data-parent="#accordion" href="#faq-{{$key}}">
									<h4 class="panel-title">
									{{$data->title}}
									<span class="pull-right"><i class="fa fa-{{($key>0)?'plus':'minus'}}"></i></span>
									</h4>
								</a>
							</div><!-- panel-heading -->

							<div id="faq-{{$key}}" class="panel-collapse collapse collapse {{($key>0)?'':'in'}}">
								<div class="panel-body">
									<? echo $data->description ?>
								</div>
							</div>
						</div><!-- panel -->
					@endforeach
					</div>
				</div>
			</div>
		</div>
			</div><!-- faq-page -->
		</div><!-- container -->
	</section>
	


@endsection