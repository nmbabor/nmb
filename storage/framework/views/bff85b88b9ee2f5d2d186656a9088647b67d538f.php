
<?
    $info=DB::table('about_company')->first();
    $menus=DB::table('menu')->where('status',1)->orderBy('serial_num','ASC')->get();
    $socialLinks=DB::table('social_links')->where('status',1)->get();
    if(Session::has('metaDescription')){
        $metaDescription=Session::get('metaDescription');
    }else{
        $metaDescription=$info->company_name.'- is a Marketplace in Bangladesh. Listing, ক্রয়- bikroy, Jobs, E-Shop
Trade Bangla is a free Classified & Marketplace in Bangladesh. Buy and Sell Anything, Post your free ad. Search for Cars, Mobile Phones, Computers, Software, Property, Animals, Pet & jobs in Bangladesh. Online Market Marketplace in Bangladesh
';
    }
    if(Session::has('title_msg')){
        $title=Session::get('title_msg')." |  ".$info->company_name;
    }else{
        $title=$info->company_name.' | ক্রয়, Bikroy, Jobs, E-Shop, Business Listing,';
    }
    if(Session::has('metaKeyword') and isset($metaKeyword)){
        $metaKeyword=Session::get('metaKeyword');
    }else{
        $metaKeyword = 'free ecommerce website, free ad posting in bangladesh, classified ads site in bangladesh, free ad post, free job posting site in bangladesh, Electronics, car, mobile, Software, ক্রয়, bikroy, Property, Electronics and Jobs in Bangladesh, sell bazar in bangladesh, business dictionary in Bangladesh, Software Price, Website Devlopment, Buy online, Lowest prices, The Largest E-commerce Site in Bangladesh, Bangladesh Online Shopping, Bangladeshi Classified Site, Classified, Bangladeshi Site, Bangladesh';
    }
    ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><? echo $title; ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="tradebangla.com.bd">
	<meta name="description" content="<? echo $metaDescription; ?>"/>
	
	<meta name="keywords" content="<? echo $metaKeyword; ?>">

<meta name="Abstract" content=" ক্রয়- bikroy Cars, Property, Software, Electronics and Jobs in Bangladesh" />
		  
		
			<meta name="Googlebot" content="all" />

			<meta http-equiv="imagetoolbar" content="no" />

			<meta name="Author" content="tradebangla.com.bd" />

			<meta name="Copyright" content="tradebangla.com.bd" />

			<meta name="owner" content="tradebangla.com.bd" />

			<meta name="Rating" content="General" />

			<meta http-equiv="Pragma" content="no-cache" />

			<meta name="distribution" content="Global" />
				<link rel="canonical" href="http://www.tradebangla.com.bd"/>

			<meta name="classification" content="Online Market Marketplace in Bangladesh, Buy &amp; sell everything or search for cars mobile phones and computers property & jobs in Bangladesh Huge Range of Products, Buy and Sell Anything, Post your free ad" />

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-110599322-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-110599322-1');
</script>

   <!-- Bing -->
<meta name="msvalidate.01" content="D5B391624C290F09E10F90CF6B7E7EA3" />
<meta name="p:domain_verify" content="0621a72636dfcd68190ab5917591092b"/>
<meta name="norton-safeweb-site-verification" content="4z41b60bhoa5vffu9geb-2nnhvsti8yzvlznub6uwivfqhe3nq6t293s0syuz4ab1yqyhnme2bzjh3cs-mwm-bv613jilnvsrh24sb4dxno0nru0ir3r8cs3hbfrzy7u" />
<meta property="og:url" content="<?php echo e(Request::fullUrl()); ?>" />
<meta property="og:type" content="article" />
<meta property="og:title" content="<? echo $title; ?>" />
<meta property="og:description" content="<? echo $metaDescription; ?>" />
<?php if(isset($ogImage)): ?>
<? $itemSmallPhoto=URL::to("$ogImage");?>
<meta property="og:image" content="<?php echo e($itemSmallPhoto); ?>" />
<?php else: ?>
<meta property="og:image" content="<?php echo e(asset('public/img/'.$info->logo)); ?>" />
<?php endif; ?>

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
 <!--<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-8770580490084389",
    enable_page_level_ads: true
  });
</script>-->


   <!-- CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('public/frontend/css/bootstrap.min_2.css')); ?>" >
    <link rel="stylesheet" href="<?php echo e(asset('public/frontend/css/font-awesome.min_2.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('public/frontend/css/icofont.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/frontend/css/owl.carousel_2.css')); ?>">  
    <link rel="stylesheet" href="<?php echo e(asset('public/frontend/css/slidr_2.css')); ?>">     
    <link rel="stylesheet" href="<?php echo e(asset('public/frontend/css/main_2.css')); ?>">  
	<link id="preset" rel="stylesheet" href="<?php echo e(asset('public/frontend/css/presets/preset1.css')); ?>">	
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.3/sweetalert2.min.css">
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>
    <link rel="stylesheet" href="<?php echo e(asset('public/frontend/css/custom.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/frontend/css/responsive.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('public/frontend/jssocials/jssocials.css')); ?>" />
	<link rel="stylesheet" href="<?php echo e(asset('public/frontend/jssocials/jssocials-theme-flat.css')); ?>" />
	<!-- font -->
	<link href='https://fonts.googleapis.com/css?family=Ubuntu:400,500,700,300' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Signika+Negative:400,300,600,700' rel='stylesheet' type='text/css'>

<!-- icon -->
<link rel="apple-touch-icon" sizes="57x57" href="/public/icon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/public/icon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/public/icon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/public/icon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/public/icon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/public/icon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/public/icon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/public/icon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/public/icon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/public/icon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/public/icon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/public/icon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/public/icon/favicon-16x16.png">
<link rel="manifest" href="/public/icon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<!-- icon -->


<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '426039157601201');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=426039157601201&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

<script>
  fbq('track', 'CompleteRegistration');
</script>

  
  </head>
  <body>
	<!-- header -->
	<header id="header" class="clearfix">
		<!-- navbar -->
		<nav class="navbar navbar-default">
			<div class="container">
				<!-- navbar-header -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php echo e(URL::to('/')); ?>"><img class="img-responsive" src='<?php echo e(asset("public/img/$info->logo")); ?>' alt="<?php echo e($info->company_name); ?>"></a>
				</div>
				<!-- /navbar-header -->
				
				<div class="navbar-left">
					<div class="collapse navbar-collapse" id="navbar-collapse">
						<ul class="nav navbar-nav">
							
								
						<?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?
                          $url= Request::path();
                            $subMenus=DB::table('sub_menu')->where('status',1)->where('fk_menu_id',$menu->id)->orderBy('serial_num','ASC')->get();
                        ?>
							<li class="<? echo($url==$menu->url)?'active' : '' ?> <?php echo e((count($subMenus)>0)?'dropdown' : ''); ?>"><a href='<?php echo e(URL::to("$menu->url")); ?>' class="<?php echo e((count($subMenus)>0)?'dropdown-toggle' : ''); ?>" data-toggle="<?php echo e((count($subMenus)>0)?'dropdown' : ''); ?>"><?php echo e($menu->name); ?> <?php echo e((count($subMenus)>0)?'<span class="caret"></span>' : ''); ?></a>
							<?php if(count($subMenus)>0): ?>
								<ul class="dropdown-menu">
								<?php $__currentLoopData = $subMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subMenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<li class="<? echo($url==$menu->url)?'active' : '' ?>"><a href='<?php echo e(URL::to("$subMenu->url")); ?>'><?php echo e($subMenu->name); ?></a></li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</ul>
							<?php endif; ?>
							</li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<li>
						<a href="<?php echo e(URL::to('ad-post')); ?>" class="btn-custom">আপনার বিজ্ঞাপন দিন
 </a>
						</li>
						</ul>
					</div>
				</div>
				
				<!-- nav-right -->
				<div class="nav-right">
					<!-- language-dropdown -->

					<!-- sign-in -->	
					<ul class="sign-in">
					<a href="<?php echo e(URL::to('ad-post')); ?>" class="btn btn-custom"> Ad Post <span class="hidden-mb"> Ad/ Jobs</span></a>				
						<?php if(Auth::check()): ?>
						<li class="dropdown">
						<i class="fa fa-user"></i>
				            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
				                <span class="username">My Account</span>
				                <b class="caret"></b>
				            </a>
				            <ul class="dropdown-menu extended logout">
				                <li><a href='<?php echo e(URL::to("profile")); ?>'><i class=" fa fa-user"></i><?php echo e(Auth::user()->name); ?></a></li>
				                <li>
				                    <a href="<?php echo e(route('logout')); ?>" class="fa fa-key"
				                        onclick="event.preventDefault();
				                                 document.getElementById('logout-form').submit();">
				                        Logout
				                    </a>

				                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
				                        <?php echo e(csrf_field()); ?>

				                    </form>
				                </li>
				            </ul>
				        </li>
			              <?php else: ?>
			              <li class="dropdown">
						<i class="fa fa-user"></i>
				            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
				                <span class="username">My Account</span>
				                <b class="caret"></b>
				            </a>
				            <ul class="dropdown-menu my-account">
				                <li><a href="<?php echo e(url('/login')); ?>">Sign In </a></li>
								<li><a href="<?php echo e(url('/signup')); ?>">Register</a></li>
				            </ul>
				        </li>
						
						<?php endif; ?>
					</ul><!-- sign-in -->					
				</div>
				<!-- nav-right -->
			</div><!-- container -->
		</nav><!-- navbar -->
	</header><!-- header -->