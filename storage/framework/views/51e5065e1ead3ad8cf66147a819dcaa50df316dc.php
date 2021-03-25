<?php $__env->startSection('title', 'Login'); ?>
<?php $__env->startSection('content'); ?>
<div class="login-container animated fadeInDown">
    <div class="loginbox bg-white">
        <div class="loginbox-title">SIGN IN</div><br>
            <?php if(session('message')): ?>
             <div class="alert alert-danger">
               <?php echo e(session('message')); ?>

             </div>
            <?php endif; ?> 
           <?php echo Form::open(['name' => 'frmAdminLogin', 'id' => 'frmAdminLogin', 'method' => 'post', 'route' => 'admin']); ?>

                <div class="loginbox-textbox">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" />
                </div>
                <div class="loginbox-textbox">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
                </div>
                <div class="loginbox-forgot">
                    <a href="<?php echo e(url('password/reset')); ?>">Forgot Password?</a>
                </div>
                <div class="loginbox-submit">
                    <input type="submit" name="btnAdminLogin" id="btnAdminLogin" class="btn btn-primary btn-block" value="Login">
                </div>
            <?php echo Form::close(); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.baselayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>