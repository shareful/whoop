<?php $__env->startSection('title', 'User List'); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.includes.navigation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-container container-fluid">
    <div class="page-container">
        <?php echo $__env->make('admin.includes.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="page-content">
            <div class="page-body">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="widget">
                            
                            <div class="widget-header ">
                                <span class="widget-caption">User List</span>
                            </div>
                            
                            <div class="widget-body">
                                <?php if(Session::has('success')): ?>
                                    <div class="alert alert-success fade in">
                                        <?php echo e(Session::get('success')); ?>

                                    </div>
                                <?php endif; ?>
                                <table class="table table-striped table-hover table-bordered" id="usertable">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                           Email
                                        </th>
                                        <th>
                                            Zip Code
                                        </th>
                                        <th>
                                            Mobile
                                        </th>
                                        <th>
                                            No of Unlocked deals
                                        </th>
                                        <th>

                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(isset($users)): ?>
                                           <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($user['firstname']); ?></td>
                                                    <td><?php echo e($user['email']); ?></td>
                                                    <td><?php echo e($user['zipcode']); ?></td>
                                                    <td><?php echo e($user['mobile']); ?></td>
                                                    <td></td>
                                                    <td>
                                                        <a href="<?php echo e(url('/admin/user/view/'.$user['id'])); ?>" class="btn btn-info btn-xs edit"><i class="fa fa-info"></i> View</a>
                                                        <a href="<?php echo e(url('/admin/appointment/add/')); ?>" class="btn btn-magenta btn-xs appointment"><i class="fa fa-edit"></i> Create an Appointment</a>
                                                        <a href="#" class="btn btn-danger btn-xs delete" data-id="<?php echo e($user['id']); ?>" data-url="<?php echo e(url('/admin/user/'.$user['id'])); ?>"><i class="fa fa-trash-o"></i> Delete</a>
                                                    </td>
                                                </tr>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.baselayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>