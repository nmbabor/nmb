<div class="post-profile section">	
			<div class="user-profile">
				<div class="user">
					<h2><a href="<?php echo e(URL::to('profile')); ?>"><?php echo e(Auth::user()->name); ?></a></h2>
				</div>

				<div class="favorites-user">
					<div class="my-posts">
						<a href="<?php echo e(URL::to('my-ads')); ?>"><?php echo e(DB::table('ad_post')->where('created_by',Auth::user()->id)->count()); ?><small>My ADS</small></a>
					</div>
					<!-- <div class="favorites">
						<a href="my-profile.html#">18<small>Favorites</small></a>
					</div> -->
				</div>								
			</div><!-- user-profile -->
			<ul class="user-menu">
			<? $url=Request::path(); ?>
				<li class="<?php echo e(($url=='profile')?'active':''); ?>"><a href="<?php echo e(URL::to('profile')); ?>">Profile</a></li>
				<li class="<?php echo e(($url=='my-ads')?'active':''); ?>"><a href="<?php echo e(URL::to('my-ads')); ?>">My ads</a></li>
				<!-- <li class="<?php echo e(($url=='favourite-ads')?'active':''); ?>"><a href="<?php echo e(URL::to('favourite-ads')); ?>">Favourite ads</a></li> -->
				<li class="<?php echo e(($url=='pending-ads')?'active':''); ?>"><a href="<?php echo e(URL::to('pending-ads')); ?>">Pending Ads</a></li>
				<?php if(Auth::user()->type==4): ?>
				<li class="<?php echo e(($url=='business-account')?'active':''); ?>"><a href="<?php echo e(URL::to('business-account')); ?>">Business Profile</a></li>
				<?php endif; ?>
				<?php if(Auth::user()->type==4): ?>
				<li class="<?php echo e(($url=='job-post')?'active':''); ?>"><a href="<?php echo e(URL::to('job-post')); ?>">Job Post</a></li>
				<?php endif; ?>
				<?php if(Auth::user()->type==3): ?>
				<li class="<?php echo e(($url=='resume')?'active':''); ?>"><a href="<?php echo e(URL::to('resume')); ?>">View Resume</a></li>
				<?php endif; ?>
				<?php if(Auth::user()->type==5): ?>
				<li class="<?php echo e((substr($url,0,5)=='eshop')?'active':''); ?>"><a href="<?php echo e(URL::to('eshop')); ?>">E-Shop</a></li>
				<?php endif; ?>
				<!-- <li class="<?php echo e(($url=='delete-account')?'active':''); ?>"><a href="delete-account.html">Close account</a></li> -->
			</ul>
		</div><!-- ad-profile -->
		<?php if(Auth::user()->email_verified!=1): ?>
		<div class="col-md-12 well">
			<h3 class="text-danger">Your email is not verified!</h3>
			<h4>An email send to your account. Check your Inbox or Spam. </h4>
			<h4>Verify email to active your account.</h4>
		</div>
		<?php endif; ?>