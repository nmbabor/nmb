<?php $__env->startSection('content'); ?>
<div class="tab_content">

<h3 class="box_title">Add New Ad
 <a href="<?php echo e(route('banner-manager.index')); ?>" class="btn btn-default pull-right"> <i class="ion ion-navicon-round"></i> View All Ad</a></h3>
 <div class="col-md-12">
	<?php echo Form::open(array('route' => 'banner-manager.store','class'=>'form-horizontal','files'=>true)); ?>

	    <div class="form-group <?php echo e($errors->has('photo') ? 'has-error' : ''); ?>">
            <?php echo e(Form::label('photo', 'Photo', array('class' => 'col-md-3 control-label'))); ?>

            <div class="col-md-8">
                <label class="banner_upload" for="file">
                    <!--  -->
                    <img id="image_load" src="<?php echo e(asset('public/img/upload.png')); ?>" alt="Upload Your Photo" title="Upload Your Photo">
                </label>
                <?php echo e(Form::file('photo',array('id'=>'file','style'=>'display:none'))); ?>

                 <?php if($errors->has('photo')): ?>
	                    <span class="help-block" style="display:block">
	                        <strong><?php echo e($errors->first('photo')); ?></strong>
	                    </span>
	                <?php endif; ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo e(Form::label('caption', 'Caption', array('class' => 'col-md-3 control-label'))); ?>

            <div class="col-md-8">
                <?php echo e(Form::text('caption',"",array('class'=>'form-control','placeholder'=>'Caption'))); ?>

            </div>
        </div>
        <div class="form-group">
            <?php echo e(Form::label('link', 'Link', array('class' => 'col-md-3 control-label'))); ?>

            <div class="col-md-8">
                <?php echo e(Form::text('link',"",array('class'=>'form-control','placeholder'=>'link'))); ?>

            </div>
        </div>
        <div class="form-group">
            <?php echo e(Form::label('is_photo', 'Use Photo or Script', array('class' => 'col-md-3 control-label'))); ?>


            <div class="col-md-4">
                <?php echo e(Form::select('is_photo', array('1' => 'Photo', '2' => 'Script'),'1', ['class' => 'form-control'])); ?>

            </div>
        </div>
        <div class="form-group">
            <?php echo e(Form::label('script', 'Script', array('class' => 'col-md-3 control-label'))); ?>

            <div class="col-md-8">
                <?php echo e(Form::textArea('script',"",array('class'=>'form-control','placeholder'=>'script'))); ?>

            </div>
        </div>
        <div class="form-group  <?php echo e($errors->has('fk_page_id') ? 'has-error' : ''); ?>">
            <?php echo e(Form::label('fk_page_id', 'Page &amp; Position', array('class' => 'col-md-3 control-label'))); ?>


            <div class="col-md-4">
                <?php echo e(Form::select('fk_page_id',$pages,'', ['class' => 'form-control','placeholder'=>'Select a Page','onchange'=>'loadSerial(this.value)'])); ?>

                <?php if($errors->has('fk_page_id')): ?>
                        <span class="help-block" style="display:block">
                            <strong><?php echo e($errors->first('fk_page_id')); ?></strong>
                        </span>
                    <?php endif; ?>
            </div>
            <div class="col-md-4">
               <div id="loadSerialNumber"></div>
            </div>
        </div>
        <div class="form-group  <?php echo e($errors->has('fk_category_id') ? 'has-error' : ''); ?>">
            <?php echo e(Form::label('fk_category_id', 'Category', array('class' => 'col-md-3 control-label'))); ?>


            <div class="col-md-4">
                <?php echo e(Form::select('fk_category_id',$category,'', ['class' => 'form-control','placeholder'=>'Select a category','onchange'=>'loadCatSerial(this.value)'])); ?>

                <?php if($errors->has('fk_category_id')): ?>
                        <span class="help-block" style="display:block">
                            <strong><?php echo e($errors->first('fk_category_id')); ?></strong>
                        </span>
                    <?php endif; ?>
            </div>
            <div class="col-md-4">
               <div id="loadCatSerialNumber"></div>
            </div>
        </div>
        <div class="form-group">
            <?php echo e(Form::label('status', 'Status', array('class' => 'col-md-3 control-label'))); ?>


            <div class="col-md-4">
                <?php echo e(Form::select('status', array('1' => 'Active', '2' => 'Inactive'),'1', ['class' => 'form-control'])); ?>

            </div>
        </div>
	    <div class="form-group">
	        <div class="col-md-8 col-md-offset-3">
	            <button type="submit" class="btn btn-primary">Submit</button>
	        </div>
	    </div>
	<?php echo Form::close(); ?>

 </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">
	function loadSerial(id){
        $('#loadSerialNumber').load('<?php echo e(URL::to("banner-manager")); ?>/'+id);
    }
    function loadCatSerial(id){
		$('#loadSerialNumber').load('<?php echo e(URL::to("banner-serial")); ?>/'+id);
	}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>