<?php $__env->startSection('title', 'Service Provider List'); ?>
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
                               <span class="widget-caption"><a href="<?php echo e(url('/admin/service-provider/add')); ?>" class="btn btn-default btn-xs shiny icon-only blue addnewbtn"><i class="fa fa-plus"></i></a>&nbsp; Service Provider List</span>
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
                                            First Name
                                        </th>
                                        <th>
                                           Contact
                                        </th>
                                        <th>
                                            Available for Zip Codes
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(isset($providers)): ?>
                                         <?php $__currentLoopData = $providers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr role="row">
                                                
                                                <td><?php echo e($provider['firstname']); ?></td>
                                                <td><?php echo e($provider['mobile']); ?></td>
                                                <td><?php echo e($provider['available_for_zipcodes']); ?></td>
                                                <td>
                                                    <a href="<?php echo e(url('/admin/service-provider/edit/'.$provider['id'])); ?>" class="btn btn-info btn-xs edit"><i class="fa fa-edit"></i> Edit</a>
                                                    <a href="javascript:;" class="btn btn-danger btn-xs deleteprovider" data-id="<?php echo e($provider['id']); ?>" data-url="<?php echo e(url('/admin/service-provider/'.$provider['id'])); ?>"><i class="fa fa-trash-o"></i> Delete</a>
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