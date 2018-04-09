<?php $__env->startSection('content'); ?>

<div class="tab_content">

  <h3 class="box_title work_title">
    <? $url=Request::path() ?>
<?php if($url=='pending-business'): ?>
    All Pending Business Profile
  <?php else: ?>
    All Published Business Profile
  <?php endif; ?>
</h3>
        <table class="table table-striped table-hover table-bordered center_table" id="my_table">
            <thead>
                <tr>
                    <th>SL</th>
                    <th width="30%">Name</th>
                    <th>Email</th>
                    <th>Approval</th>
                    <th>Approved By</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th colspan="1" width="4%">Action</th>
                </tr>
            </thead>
            <tbody>
            <? $i=1; ?>
            <?php $__currentLoopData = $business; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($i++); ?></td>
                    <td><a href='<?php echo e(route("manage-business.edit",$data->id)); ?>'> <h5><?php echo e($data->name); ?></h5> </a></td>
                    <td><?php echo e($data->email); ?></td>
                    <td>
                    <?php if($data->is_approved==1): ?>
                    <b class="text-success">Approved</b>
                    <?php elseif($data->is_approved==3): ?>

                    <b class="text-danger">Deny</b>
                    <?php else: ?>
                    <b class="text-warning">Pending</b>
                    <?php endif; ?>
                        
                    </td>
                    <td><?php echo e($data->approver_name); ?></td>
                    <td><i class="<?php echo e(($data->status==1)? 'ion-checkmark-circled success' : 'ion-ios-close danger'); ?>"></i></td>

                    <td><?php echo e(date('d-m-y h:i A',strtotime($data->created_at))); ?></td>
                    <td> <a href='<?php echo e(route("manage-business.edit",$data->id)); ?>' class="btn btn-xs btn-info"><i class="fa fa-pencil-square-o"></i></a></td>
                    <!-- <td>
                   
        <?php echo Form::open(array('route' => ["manage-business.destroy",$data->id],'method'=>'DELETE')); ?>

            <button type="submit" class="btn btn-xs btn-danger" onclick="return deleteConfirm()"><i class="ion ion-ios-trash-outline"></i></button>
        <?php echo Form::close(); ?>

                    </td> -->

                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="pull-right">
        <?php echo e($business->render()); ?> 
        </div>
  </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>