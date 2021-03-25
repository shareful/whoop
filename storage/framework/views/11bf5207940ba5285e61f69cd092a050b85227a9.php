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
                               <span class="widget-caption"><a href="<?php echo e(url('/admin/deal/add')); ?>" class="btn btn-default btn-xs shiny icon-only blue addnewbtn"><i class="fa fa-plus"></i></a>&nbsp; Deal List</span>
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
                                           Category
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
                                        <?php if(isset($deals)): ?>
                                         <?php $__currentLoopData = $deals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr role="row">
                                                <td>
                                                    <?php if(isset($deal['image']) && file_exists(public_path('upload/deal/'.$deal['image']))): ?>
                                                    <img src="<?php echo e(asset('upload/deal/'.$deal['image'])); ?>" width="120">
                                                    <?php else: ?>
                                                    <img src="<?php echo e(asset('/assets/img/no-image.png')); ?>" width="120">
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e($deal['categories']['name']); ?></td>
                                                <td><?php echo e($deal['name']); ?></td>
                                                <td><?php echo e($deal['end_date']); ?></td>
                                                <td>
                                                    <a href="<?php echo e(url('/admin/deal/edit/'.$deal['id'])); ?>" class="btn btn-info btn-xs edit"><i class="fa fa-edit"></i> Edit</a>
                                                    <a href="javascript:;" class="btn btn-danger btn-xs deletedeal" data-id="<?php echo e($deal['id']); ?>" data-url="<?php echo e(url('/admin/deal/'.$deal['id'])); ?>"><i class="fa fa-trash-o"></i> Delete</a>
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