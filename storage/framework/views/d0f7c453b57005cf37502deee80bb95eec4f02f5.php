 <?php echo $__env->make('backend._partials.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 <?php echo $__env->make('backend._partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 <?php echo $__env->make('backend._partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 

<!--main content start-->
<section id="main-content">

<section class="wrapper">
<?php if(Session::has('success')): ?>
<div class="col-md-12">
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       <b><?php echo Session::get('success'); ?></b> 
       </div>
</div>
<?php elseif(Session::has('error')): ?>
  <div class="col-md-12">
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       <b><?php echo Session::get('error'); ?></b> 
       </div>
  </div>
<?php endif; ?>
 <?php echo $__env->yieldContent('content'); ?>
</section>
</section>
<!--main content end-->
 <?php echo $__env->make('backend._partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 <?php echo $__env->yieldContent('script'); ?>
 </body>
</html>
