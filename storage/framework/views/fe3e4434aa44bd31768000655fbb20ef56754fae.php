<!doctype html>
<html>
   <head>
      <?php echo $__env->make('admin.includes.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   </head>
   <body>
      <?php echo $__env->yieldContent('content'); ?>
      <?php echo $__env->make('admin.includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   </body>
</html>