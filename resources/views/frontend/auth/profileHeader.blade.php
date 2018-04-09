<div class="ad-profile section">	
			<div class="user-profile">
				<div class="user">
					<h2><a href="{{URL::to('profile')}}">{{Auth::user()->name}}</a></h2>
				</div>

				<div class="favorites-user">
					<div class="my-ads">
						<a href="{{URL::to('my-ads')}}">{{DB::table('ad_post')->where('created_by',Auth::user()->id)->count()}}<small>My ADS</small></a>
					</div>
					<!-- <div class="favorites">
						<a href="my-profile.html#">18<small>Favorites</small></a>
					</div> -->
				</div>								
			</div><!-- user-profile -->
			<ul class="user-menu">
			<? $url=Request::path(); ?>
				<li class="{{($url=='profile')?'active':''}}"><a href="{{URL::to('profile')}}">Profile</a></li>
				<li class="{{($url=='my-ads')?'active':''}}"><a href="{{URL::to('my-ads')}}">My ads</a></li>
				<!-- <li class="{{($url=='favourite-ads')?'active':''}}"><a href="{{URL::to('favourite-ads')}}">Favourite ads</a></li> -->
				<li class="{{($url=='pending-ads')?'active':''}}"><a href="{{URL::to('pending-ads')}}">Pending Ads</a></li>
				@if(Auth::user()->type==4)
				<li class="{{($url=='business-account')?'active':''}}"><a href="{{URL::to('business-account')}}">Business Profile</a></li>
				@endif
				@if(Auth::user()->type==4)
				<li class="{{($url=='job-post')?'active':''}}"><a href="{{URL::to('job-post')}}">Job Post</a></li>
				@endif
				@if(Auth::user()->type==3)
				<li class="{{(substr($url,0,6)=='resume')?'active':''}}"><a href="{{URL::to('resume')}}">View Resume</a></li>
				@endif
				@if(Auth::user()->type==5)
				<li class="{{(substr($url,0,5)=='eshop')?'active':''}}"><a href="{{URL::to('eshop')}}">E-Shop</a></li>
				@endif
				<!-- <li class="{{($url=='delete-account')?'active':''}}"><a href="delete-account.html">Close account</a></li> -->
			</ul>
		</div><!-- ad-profile -->
		@if(Auth::user()->email_verified!=1)
		<div class="col-md-12 no-padding">
		    <div class="alert alert-danger alert-dismissable">
		        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		       <h4 class="text-danger">Your email is not verified!</h4>
			<h5>An email send to your account. Check your Inbox or Spam. Verify email to active your account.</h5>
		       </div>
		</div>
		@endif
	