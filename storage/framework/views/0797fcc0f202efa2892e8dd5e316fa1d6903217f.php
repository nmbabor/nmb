<?php $__env->startSection('content'); ?>

<div class="tab_content">
<?php if($errors->has('email')): ?>
    <div class="col-md-12">
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <b><?php echo e($errors->first('email')); ?></b> 
       </div>
    </div>
<?php endif; ?>
  <h3 class="box_title">All Ads
 <a href="<?php echo e(route('banner-manager.create')); ?>" class="btn btn-default pull-right"> <i class="ion ion-plus"></i> Add new Ad</a></h3>
        <table class="table table-striped table-hover table-bordered center_table" id="my_table">
            <thead>
                <tr>
                    <th>Caption</th>
                    <th>Page Name</th>
                    <th>Category</th>
                    <th>Serial</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th colspan="2" width="5%">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $allData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><a href="<?php echo e(route('banner-manager.edit',$data->id)); ?>" class="top_caption">
                    <? echo $data['caption']; ?></a> </td>
                    <td><?php echo e($data->name); ?></td>
                    <td><?php echo e($data->cat_name); ?></td>
                    <td><?php echo e($data->serial_num); ?></td>
                    <td><i class="<?php echo e(($data->status==1)? 'ion-checkmark-circled success' : 'ion-ios-close danger'); ?>"></i></td>
                    <td><?php echo e(date('jS M Y',strtotime($data->created_at))); ?></td>
                    <td>
                       <a href="<?php echo e(route('banner-manager.edit',$data->id)); ?>" class="btn btn-info"><i class="ion ion-compose"></i></a> 
                        
                    </td>
                    <td>
        <?php echo Form::open(array('route' => ['banner-manager.destroy',$data->id],'method'=>'DELETE')); ?>

            <button type="submit" class="btn btn-danger" onclick="return deleteConfirm()"><i class="ion ion-ios-trash-outline"></i></button>
        <?php echo Form::close(); ?>

                    </td>

                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="pull-right">
        <?php echo e($allData->render()); ?> 
        </div>
  </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>