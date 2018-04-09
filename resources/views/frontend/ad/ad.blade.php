<div class="col-md-10 no-padding">
	<div class="section recommended-ads">
		<!-- featured-top -->
		<div class="featured-top all_post">
		<h2>{{isset($page_title)?$page_title:'Recommended Post for You'}}</h2>					
		</div><!-- featured-top -->	

			@if(count($adPost)==0)
					<h3>No ads found!</h3>
			@endif
		<? $adi=0; ?>
		@foreach($adPost->chunk(9) as $key => $post)
		@if($key>0)
		<? $adi++; ?>
			@if(isset($banners[4]))
			<div class="banners-section text-center">
				@if($banners[4]->is_photo==1)
                  @if($banners[4]->photo!=null)
                  <? $adPhoto=$banners[4]->photo; ?>
                  <a href="{{$banners[4]->link}}" target="_blank">
                  	<img class="img-responsive" src='{{asset("public/img/banners/$adPhoto")}}' alt="{{$banners[4]->caption}}">
                  </a>

                  @endif
                @else
                <? echo $banners[4]->script ?>
                @endif

			</div>
            @endif
		@endif
			@foreach($post as $ad)
			<div class="banner-item row catWiseItem">
				
					<div class="item-image-box col-xs-3">
						<div class="item-image">
						<? $photo= "images/post/small/$ad->photo_one";
						?>
							<a href='{{URL::to("ad/$ad->link")}}' title="{{$ad->title}}" >
						@if($ad->type!=3)
							@if(($ad->photo_one!=null) and file_exists($photo) )
							<img src='{{asset("images/post/small/$ad->photo_one")}}' alt="{{$ad->title}}" class="img-responsive">
							@else
							<img src='{{asset("images/smallDefault.jpg")}}' alt="{{$ad->title}}" class="img-responsive">
							@endif
						@else
						<? $business=DB::table('business_account')->where('fk_user_id',$ad->created_by)->first();
						
						?>
							@if(($business!=null) and ($business->profile_photo!=null) and file_exists("images/business/profile/$business->profile_photo"))
							<img src='{{asset("images/business/profile/$business->profile_photo")}}' alt="{{$ad->title}}" class="img-responsive">
							@else
							<img src='{{asset("images/smallDefault.jpg")}}' alt="{{$ad->title}}" class="img-responsive">
							@endif
						@endif
							</a>
						</div><!-- item-image -->

					</div>
					
					<!-- rending-text -->
					<div class="item-info col-xs-9">
						<!-- ad-info -->
						<div class="post-info">
							<h2 class="item-title"><a href='{{URL::to("ad/$ad->link")}}'  title="{{$ad->title}}">{{$ad->title}}</a></h2>
							@if($ad->type!=3)
							<h3 class="item-price">Tk. {{$ad->price}}</h3>
								@if($ad->last_step_category_name!=null)
								 <span><a href='{{URL::to("ads/$ad->cat_link/$ad->sub_id/$ad->last_id")}}'>{{$ad->last_step_category_name}}</a></span>
								 @else
								 <span><a href='{{URL::to("ads/$ad->cat_link/$ad->sub_id")}}'>{{$ad->sub_category_name}}</a></span>
								@endif
							@else
							<? $businessLink=($business!=null and $business->link!=null)?$business->link:''; ?>
							<h3 class="item-price"><a href='{{URL::to("business/$businessLink")}}'><i class="fa fa-user"></i> {{$ad->creator}}</a></h3>
							<h4>Salary: {{$ad->price}} {{($ad->price2!=null)?' - '.$ad->price2: ''}}</h4>

							@endif
							<div class="item-cat">
								<div>
								<span>{{$ad->area_name}}, {{$ad->division_name}}</span>
								</div>
							</div>										
						</div><!-- ad-info -->
					</div><!-- item-info -->
				
				
			</div><!-- ad-item -->
		@endforeach
		
	@endforeach
		<!-- pagination  -->
		<div>
			{{$adPost->render()}}
		</div><!-- pagination  -->	
		@if(isset($banners[3]))
		<div class="banners-section">
			@if($banners[3]->is_photo==1)
	          @if($banners[3]->photo!=null)
	          <? $adPhoto=$banners[3]->photo; ?>
	          <a href="{{$banners[3]->link}}" target="_blank">
	          	<img class="img-responsive" src='{{asset("public/img/banners/$adPhoto")}}' alt="{{$banners[3]->caption}}">
	          </a>

	          @endif
	        @else
	        <? echo $banners[3]->script ?>
	        @endif

		</div>
	    @endif				
	</div>
</div>
<div class="col-md-2 no-padding">
	@if(isset($banners[2]))
	<div class="side-banner-section">
		@if($banners[2]->is_photo==1)
          @if($banners[2]->photo!=null)
          <? $adPhoto=$banners[2]->photo; ?>
          <a href="{{$banners[2]->link}}" target="_blank">
          	<img class="img-responsive" src='{{asset("public/img/banners/$adPhoto")}}' alt="{{$banners[2]->caption}}">
          </a>

          @endif
        @else
        <? echo $banners[2]->script ?>
        @endif

	</div>
    @endif
</div>	