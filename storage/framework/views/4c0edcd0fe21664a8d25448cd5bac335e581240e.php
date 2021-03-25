<?php $__env->startSection('title', 'Deal List'); ?>
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
                                <span class="widget-caption">Deal List</span>
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
                                            Image
                                        </th>
                                        <th>
                                           Name
                                        </th>
                                        <th>
                                            End Date
                                        </th>
                                        <th>

                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="<?php echo e(url('/admin/user/view/')); ?>" class="btn btn-info btn-xs edit"><i class="fa fa-edit"></i> Edit</a>
                                            <a href="#" class="btn btn-danger btn-xs delete" data-id="" data-url="<?php echo e(url('/admin/user/')); ?>"><i class="fa fa-trash-o"></i> Delete</a>
                                        </td>
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