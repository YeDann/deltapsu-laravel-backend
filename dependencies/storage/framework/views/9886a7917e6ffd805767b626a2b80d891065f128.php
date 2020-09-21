
<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Subscribes</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Subscribes</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Content -->
<div class="content">

    <?php if(Session::has('flash_message')): ?>
    <div class="alert alert-success" role="alert">
        <button class="close" data-dismiss="alert"></button>
        <?php echo Session('flash_message'); ?>

    </div>
    <?php endif; ?>
    <?php if(Session::has('error_message')): ?>
    <div class="alert alert-danger" role="alert">
        <button class="close" data-dismiss="alert"></button>
        <?php echo Session('error_message'); ?>

    </div>
    <?php endif; ?>
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">
        
            </h3>
            <div class="block-options">
                
                    <a href="<?php echo e(route('exportSubscribes')); ?>" class="btn btn-primary">Export Data</a>
                    
               
            </div>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No.</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Email</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">CountryName</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Name</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Accept Privacy Policy</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Created At</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($subscribes) and !empty($subscribes)): ?>
                    <?php $__currentLoopData = $subscribes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td class="text-center"><?php echo e($loop->iteration); ?></td>
                    <td class="d-none d-sm-table-cell"><?php echo e($item->email); ?></td>
                    <td class="d-none d-sm-table-cell"><?php echo e($item->country_name); ?></td>
                    <td class="d-none d-sm-table-cell"><?php echo e($item->name); ?></td>
                  
            
                    <td class="font-w600 text-center">
                            <?php if($item->accept == 1): ?>
                            <span class="badge badge-success text-uppercase">Accepted</span>
                            <?php else: ?>
                            <span class="badge badge-secondary text-uppercase">Not accept</span>
                            <?php endif; ?>
                    </td>
                    <td class="font-w600 text-center"><?php echo e($item->created_at); ?></td>
                    
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/deltaPSU/dependencies/resources/views/subscribes/index.blade.php ENDPATH**/ ?>