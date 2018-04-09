<?php $__env->startSection('content'); ?>

<div class="tab_content">

  <h3 class="box_title work_title">
    <?
    $url=Request::path();
    ?>
    <?php if($url=='manage-ad'): ?>
    All Pending Post
    <?php elseif($url=='published-ad'): ?>
    All Published Post
    <?php elseif($url=='published-jobs'): ?>
    All Published Jsbs
    <?php elseif($url=='unpublished-jobs'): ?>
    All Pending Jsbs
    <?php endif; ?>
 <a href='<?php echo e(url("ad-post")); ?>' class="btn btn-default pull-right"> <i class="ion ion-plus"></i> Add new</a></h3>
        <table class="table table-striped table-hover table-bordered center_table" id="my_table">
            <thead>
                <tr>
                    <th>SL</th>
                    <th width="30%">Title</th>
                    <th>Category</th>
                    <th>User Name</th>
                    <th>Type</th>
                    <th>Approved By</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th colspan="2" width="4%">Action</th>
                </tr>
            </thead>
            <tbody>
            <? $i=1; ?>
            <?php $__currentLoopData = $adPost; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($i++); ?></td>
                    <td><a href='<?php echo e(route("manage-ad.edit",$data->id)); ?>'> <h5><?php echo e($data->title); ?></h5> </a></td>
                    <td><?php echo e($data->cat_name); ?></td>
                    <td><?php echo e($data->creator); ?></td>
                    <td><?php echo e($data->type_name); ?></td>
                    <td><?php echo e($data->approver_name); ?></td>
                    <td><i class="<?php echo e(($data->status==1)? 'ion-checkmark-circled success' : 'ion-ios-close danger'); ?>"></i></td>

                    <td><?php echo e(date('d-m-y h:i A',strtotime($data->created_at))); ?></td>
                    <td> <a href='<?php echo e(route("manage-ad.edit",$data->id)); ?>' class="btn btn-xs btn-info"><i class="fa fa-pencil-square-o"></i></a></td>
                    <td>
                   
        <?php echo Form::open(array('route' => ["manage-ad.destroy",$data->id],'method'=>'DELETE')); ?>

            <button type="submit" class="btn btn-xs btn-danger" onclick="return deleteConfirm()"><i class="ion ion-ios-trash-outline"></i></button>
        <?php echo Form::close(); ?>

                    </td>

                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="pull-right">
        <?php echo e($adPost->render()); ?> 
        </div>
  </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>