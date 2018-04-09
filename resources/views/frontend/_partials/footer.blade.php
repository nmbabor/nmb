 <? $info=DB::table('about_company')->first();
	$socialLinks=DB::table('social_links')->where('status',1)->get();
 ?>
	<!-- footer -->
	<footer id="footer" class="clearfix">
		<!-- footer-top -->
		<section class="footer-top clearfix">
			<div class="container">
				<div class="row">
					<!-- footer-widget -->
					<div class="col-sm-3">
						<div class="footer-widget">
							<h3>Learn More</h3>
							<ul>
								<li><a href="{{URL::to('page/using-rules')}}">Using Rules</a></li>
								<li><a href="{{URL::to('page/privacy-policy')}}">Privacy Policy</a></li>
								<li class="hidden-xs"><a href="{{URL::to('page/privacy-policy')}}">Terms & Conditions</a></li>
								<li class="hidden-xs"><a href="{{URL::to('page/post-free-ad')}}">Post Free ad</a></li>
								
								<li><a href="{{URL::to('faq')}}">FAQ</a></li>
							</ul>
						</div>
					</div><!-- footer-widget -->
					<div class="col-sm-2 hidden-xs">
						<div class="footer-widget">
							<h3>Quick Links</h3>
							<ul>
								<li><a href="{{URL::to('page/about-us')}}">About  Us</a></li>
								<li><a href="{{URL::to('/page/contact-us')}}">Contact us</a></li>
								<li><a href="{{URL::to('/')}}">Blog</a></li>
								<li><a href="{{URL::to('/')}}">Sitemap</a></li>
								<li><a href="{{URL::to('page/advertising')}}">Advertising</a></li>
							
							</ul>
						</div>
					</div><!-- footer-widget -->

					<!-- footer-widget -->
					<div class="col-sm-3">
						<div class="footer-widget">
							<h3>Connect with us</h3>
							<div class="app-link">
								<a href=""><img src="{{asset('images/icon/google-play.png')}}" alt="Google Play Store" title="Download App from Google Play Store"></a>
								<a href=""><img src="{{asset('images/icon/apple.png')}}" alt="Apple App Store" title="Download App from Apple App Store"></a>
							</div>
							<div class="socila_link">
								<ul class="social">
								@foreach($socialLinks as $social)
									<li class="{{$social->name}}"><a href="{{$social->link}}" target="_blank" class="{{$social->icon_class}}"></a></li>
		                        @endforeach
								</ul>								
							</div><!-- language-dropdown -->
						</div>
					</div><!-- footer-widget -->

					<!-- footer-widget -->
					<div class="col-sm-4">
						<div class="footer-widget social-widget">
							<div class="facebook-link">
								<h4></h4>
								<div class="fb-page" data-href="{{$info->fb_link}}" data-height="170" data-small-header="true" data-adapt-container-width="false" data-hide-cover="true" data-show-facepile="true"></div>
							</div>
						</div>
					</div><!-- footer-widget -->

				</div><!-- row -->
			</div><!-- container -->
		</section><!-- footer-top -->

		
		<div class="footer-bottom clearfix">
			<div class="container">
            <div class="row">
                <div class="col-xs-6">
                <p class="footer_left">
                   &copy; {{date('Y')}} All Rights Reserved by <a href="{{URL::to('/')}}">{{$info->company_name}}</a> 
                </p>
                </div>
                <div class="col-xs-6 text-right">Powered by <a href="http://www.smartsoftware.com.bd" target="_blank" title="Smart Software Inc."> <img src="{{asset('images/Smart-Soft-Inc-logo.png')}}" alt="Smart Software Inc."></a></div>
            </div>
        </div>
		</div><!-- footer-bottom -->
	</footer><!-- footer -->
	
    <!-- JS -->
    <script src="{{asset('public/frontend/js/jquery.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/modernizr.min.js')}}"></script>
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/smoothscroll.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/scrollup.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script> 
    <script src="{{asset('public/frontend/js/jquery.countdown.js')}}"></script>    
    <script src="{{asset('public/frontend/js/custom.js')}}"></script>
	<script src="{{asset('public/frontend/js/switcher.js')}}"></script>
	<script src="{{asset('public/frontend/js/validator.js')}}"></script>
	<script src="{{ asset('public/frontend/jssocials/jssocials.min.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.3/sweetalert2.all.min.js"></script>
	<script src="{{ asset('public/frontend/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
	<script type="text/javascript" src="{{asset('public/js/tinymce/tinymce.min.js')}}"></script>
	
	@if(Session::has('success'))
	  <script type="text/javascript">
	    var text="{{Session::get('success')}}";
	    swal(
	      'Successfully Done!',
	      text,
	      'success'
	    )
	  </script>
	@endif

	@if(Session::has('error'))
	<script type="text/javascript">
	    var text="{{Session::get('error')}}";
	    swal(
	      'Error!',
	      text,
	      'error'
	    )
	  </script>
	@endif
	<script>
	$('form').on('focus', 'input[type=number]', function (e) {
          $(this).on('mousewheel.disableScroll', function (e) {
            e.preventDefault()
          })
        })
    $('form').on('blur', 'input[type=number]', function (e) {
      $(this).off('mousewheel.disableScroll')
    })
        
	tinymce.init({
	  selector: '.textarea',
	  menubar: false,
	  plugins:'link',
	  toolbar: 'bold italic backcolor  | alignleft aligncenter alignright alignjustify | link | removeformat',
	});
	 $('.datepicker').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        });
	  function loadPhoto(input,id) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();

	        reader.onload = function (e) {
	        	$('#'+id).css('display','block');
	            $('#'+id).attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    	}
		}

	</script>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.10&appId=1813434502243857";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
