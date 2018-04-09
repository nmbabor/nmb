<?php $__env->startSection('content'); ?>


<h3 class="box_title"> Brands </h3>
	<div class="box-body col-md-11">
		<?php echo Form::open(array('route' => 'brand.store','class'=>'form-horizontal','files'=>true)); ?>

		<div class="form-group <?php echo e($errors->has('brand_name') ? 'has-error' : ''); ?>">
			<?php echo e(Form::label('brand_name', 'Brand Name* :', array('class' => 'col-md-2 control-label'))); ?>

			<div class="col-md-10">
			<input name="brand_name" id="tagboxField" value="" type="hidden">
				<ul id="tagbox"></ul>
				<span>For white space, use underscore ( _ )</span>
				<?php if($errors->has('brand_name')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('brand_name')); ?></strong>
                    </span>
	            <?php endif; ?>
			</div>
			
		</div>
		<div class="form-group">
			<?php echo e(Form::label('category', 'Select Category* :', array('class' => 'col-md-2 control-label'))); ?>

			<div class="col-md-10">
				<?php echo e(Form::select('category[]',$category,'', ['class' => 'form-control chosen-select','placeholder'=>'Select Category','required','onchange'=>'loadSubCategory(this.value)'])); ?>

			</div>
		</div>
		<div id="loadSubCat"><!-- Load Sub Category --></div>

		<div class="form-group">
			<?php echo e(Form::label('status', 'Status', array('class' => 'col-md-2 control-label'))); ?>


			<div class="col-md-4">
				<?php echo e(Form::select('status', array('1' => 'Active', '2' => 'Inactive'), '1', ['class' => 'form-control'])); ?>

			</div>
		</div>
		<div class="form-group">
			<div class="col-md-10 col-md-offset-2">
				<?php echo e(Form::submit('Submit',array('class'=>'btn btn-lg btn-info'))); ?>

			</div>
		</div>
			
		<?php echo Form::close(); ?>

	</div>
	<?
	$total=count($allData);
	$chunk=round($total/2);
	$i=0;
	?>
	<?php $__currentLoopData = $allData->chunk($chunk); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<div class="col-md-6">
		<table class="table table-striped table-hover table-bordered center_table" id="my_table">
			<thead>
				<tr>
					<th>SL</th>
					<th>Brand Name</th>
					<th>Status</th>
					<th>Sub Category</th>
					<th colspan="2" width="5%">Action</th>
				</tr>
			</thead>
			<tbody>
			<?php $__currentLoopData = $data1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<? $i++; ?>
				<tr>
					<td><?php echo e($i); ?></td>
					<td><?php echo e($data->brand_name); ?></td>
					<td><i class="<?php echo e(($data->status==1)? 'ion-checkmark-circled success' : 'ion-ios-close danger'); ?>"></i></td>
					
					<td><small><?php echo e($data->category); ?></small></td>
					<td><a href='<?php echo e(URL::to("brand/$data->id/edit")); ?>' data-toggle="modal" class="btn btn-info btn-xs"><i class="ion ion-compose"></i></a></td>
					<td>
						<?php echo e(Form::open(array('route'=>['brand.destroy',$data->id],'method'=>'DELETE'))); ?>

            				<button type="submit" class="btn btn-xs btn-danger" onclick="return deleteConfirm()"><i class="ion ion-ios-trash-outline"></i></button>
        				<?php echo Form::close(); ?>

					</td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
		

	</div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<div class="col-md-12">
		<div class="pull-right">
			<?php echo e($allData->render()); ?>	
		</div>
	</div>
	

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
 <script type="text/javascript">
 	function loadSubCategory(id){
 		$('#loadSubCat').load('<?php echo e(URL::to("brand")); ?>/'+id);

 	}
 </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>