<?
$banners=DB::table('ad_manager')->where(['fk_page_id'=>7,'status'=>1])->get()->keyBy('serial_num');
?>
<div class="recommended-cta">					

		@if(isset($banners[1]))
			<div class="side-banner-section">
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
</div><!-- cta -->
