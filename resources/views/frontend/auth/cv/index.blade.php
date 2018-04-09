@extends('frontend.app')
@section('content')
<section id="main" class="clearfix  ad-profile-page">
	<div class="container">
	
		<div class="breadcrumb-section">
			<!-- breadcrumb -->
			<ol class="breadcrumb">
				<li><a href="{{URL::to('/')}}">Home</a></li>
				<li>Profile</li>
			</ol><!-- breadcrumb -->						
		</div><!-- banner -->
			@include('frontend.profile.profileHeader')			
		

		<div class="profile">
			<div class="row">
				
				<div class="col-sm-8">
					<div class="user-pro-section section">
						<h2 class="text-center">Increase your sales with a E-business Membership!</h2>
						<p>Membership allows your business to have a bigger presence on E-business, so that you can reach even more customers. Our Membership packages are specifically designed to give you the tools you need to expand your business and increase your sales through E-business.</p>
						<a href="{{URL::to('business/create')}}" class="btn btn-lg btn-success">Create Your Business Account</a>
						<h3 class="text-center">Benefits of Membership</h3>
						<hr>
						<div class="business_facility">	
							<ul>
								<li>
									<h4><i class="fa fa-angle-double-right"></i> Only getting a separate page for your business organization, where there will be detailed information about your business with beautiful pictures.</h4>
								</li>
								<li>
									<h4><i class="fa fa-angle-double-right"></i> Our membership packages will allow you to post numerous ads. The more the post, the more will be sold!</h4>
								</li>
								<li>
									<h4><i class="fa fa-angle-double-right"></i> Without any extra cost, bonus bump up and top add per month in the membership Promotion included.</h4>
								</li>
								<li>
									<h4><i class="fa fa-angle-double-right"></i> Membership packages come loaded with features that give your business tools to grow including a dedicated team to help you post ads on E-business.</h4>
								</li>
							</ul>

							
						</div>
					</div><!-- user-pro-edit -->
				</div><!-- profile -->

				<div class="col-sm-4 text-center">
					@include('frontend._partials.support')
				</div><!-- recommended-cta-->
			</div><!-- row -->	
		</div>				
	</div><!-- container -->
</section><!-- ad-profile-page -->
@endsection
@section('scripts')
	<script type="text/javascript">
		function loadArea(id){
			$('#area').css('display','block')
			$('#loadArea').load('{{URL::to("loadArea")}}/'+id);
		}
	</script>
@endsection