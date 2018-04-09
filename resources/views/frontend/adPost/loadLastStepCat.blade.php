<div class="col-md-3 col-sm-6">
	<div class="section tab-content lastcategory post-option">
		<h4>Select a subcategory</h4>
			<ul>
				@foreach($lastCategory as $lastCat)
				<li class="lastcategory-list{{$lastCat->id}}"><a href="{{URL::to('ad-post')}}#next-submit"  onclick="finalStep({{$lastCat->id}})">{{$lastCat->last_step_category_name}} <span class="pull-right final-check"><i class="fa fa-check-circle"></i></span></a></li>
				@endforeach
			</ul>
	</div>
</div>
<script src="{{asset('public/frontend/js/jquery.min.js')}}"></script>
<script type="text/javascript">
	function finalStep(id){
		$('.final-check i').css({'opacity':'0','font-size':'25px'});
		$('.lastcategory-list'+id+' .final-check i').css({'opacity':'1','font-size':'18px'});
		$('.next-btn').css('display','block');
		$('.lastcategory .link-active').removeClass('link-active');
		$('.lastcategory-list'+id).addClass('link-active');
		$('#category_id').val(id);
		$('#category_id').attr('name','subcategory');
	}
</script>