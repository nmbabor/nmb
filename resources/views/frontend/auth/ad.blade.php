				
					<div class="section recommended-ads">
						<!-- featured-top -->
						<div class="featured-top">
						<h2>{{isset($page_title)?$page_title:'Recommended Post for You'}}</h2>					
						</div><!-- featured-top -->	

							@if(count($adPost)==0)
									<h3>No ads found!</h3>
							@endif
						@foreach($adPost->chunk(6) as $key => $post)
						@if($key>0)
							<!-- ad-section -->						
							<div class="banners-section text-center">
								<a href="#"><img src="{{asset('public/frontend/images/ads/5.png')}}" alt="Image" class="img-responsive"></a>
							</div><!-- ad-section -->
						@endif
							@foreach($post as $ad)
							<div class="banner-item row catWiseItem">
								<div id="adPostInfo{{$ad->id}}">
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
										<? $business=DB::table('business_account')->where('fk_user_id',$ad->created_by)->first(); ?>
											@if(($business!=null) and file_exists("images/business/profile/$business->profile_photo"))
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
											<h3 class="item-price"><a href='{{URL::to("business-account/$business->link")}}'><i class="fa fa-user"></i> {{$ad->creator}}</a></h3>
											<h4>Tk. {{$ad->price}} {{($ad->price2!=null)?' - '.$ad->price2: ''}}</h4>

											@endif
											<div class="item-cat">
												

												<div>
												<span class="dated"> <a><i class="fa fa-clock-o"></i> {{ date('jS M, Y h:i A',strtotime($ad->created_at))}}, </a></span>
												<span>{{$ad->area_name}}, {{$ad->division_name}}</span>
												</div>
											</div>										
										</div><!-- ad-info -->
									</div><!-- item-info -->
								</div>
								
							</div><!-- ad-item -->
						@endforeach
						
					@endforeach
						<!-- pagination  -->
						<div class="text-center">
							{{$adPost->render()}}
						</div><!-- pagination  -->					
					</div>
				