<? $url=Request::path(); ?>
<div class="col-md-12 text-center">
		<h1 class="title">Welcome to Our Help &amp; Support page</h1>
		<h4>Here you can find answers learn about <a href="http://www.tradebangla.com.bd"><strong>Trade Bangla</strong></a>, how to use it, how to stay safe.</h4>
		<hr>
	</div>
	<div class="col-md-3">
		<div class="page-sidebar">
			<h4>All Pages</h4>
			<ul>
				<li><a href="{{URL::to('faq')}}" class="{{($url=='faq')?'active':''}}"><i class="fa fa-angle-double-right"></i> FAQ</a></li>
				@foreach($pages as $link => $page)
				<li><a href='{{URL::to("page/$link")}}' class="{{((isset($data)) and ($link==$data->link))?'active':''}}"><i class="fa fa-angle-double-right"></i> {{$page}}</a></li>
				@endforeach
			</ul>
		</div>
	</div>
	