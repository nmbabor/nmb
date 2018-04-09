<?
$supports=DB::table('support')->where('status',1)->orderBy('id','ASC')->get();
?>
<div class="recommended-cta">					
	<div class="cta">
		<!-- single-cta -->	
		@foreach($supports as $support)				
		<div class="single-cta">
			<!-- cta-icon -->
			@if(($support->icon!=null) and file_exists("images/support/$support->icon"))
			<div class="cta-icon icon-secure">
				<img src='{{asset("images/support/$support->icon")}}' alt="{{$support->title}}" class="img-responsive">
			</div><!-- cta-icon -->
			@endif

			<h4>{{$support->title}}</h4>
			<p>{{$support->description}}</p>
		</div><!-- single-cta -->
		@endforeach
	</div>
</div><!-- cta -->
