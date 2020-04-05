<?php $__env->startSection('title', 'Home Page'); ?>

<?php $__env->startSection('content'); ?>
<h2>Welcome Home</h2>
<p>Navigate using the navbar</p>

<img class="image" src="https://cdn2.iconfinder.com/data/icons/popular-social-media-flat/48/Popular_Social_Media-22-512.png" alt="" width="120" height="120">


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>