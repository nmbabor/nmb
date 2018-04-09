 @include('backend._partials.head')
 @include('backend._partials.header')
 @include('backend._partials.sidebar')
 

<!--main content start-->
<section id="main-content">

<section class="wrapper">
@if(Session::has('success'))
<div class="col-md-12">
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       <b>{!! Session::get('success')!!}</b> 
       </div>
</div>
@elseif(Session::has('error'))
  <div class="col-md-12">
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       <b>{!! Session::get('error')!!}</b> 
       </div>
  </div>
@endif
 @yield('content')
</section>
</section>
<!--main content end-->
 @include('backend._partials.footer')
 @yield('script')
 </body>
</html>
