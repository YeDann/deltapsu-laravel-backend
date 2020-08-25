
<?php $__env->startSection('style'); ?>
<style>
     .btn-pos{
        position: absolute;
        bottom: 0;
     }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Feature Products</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Feature Products</li>
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
            
            

                    
                    
                    

               

                    
                
        </div>
        <div class="block-content block-content-full">
                <div class="mb-3"> 
                        <form action="<?php echo e(route('setFeatureproducts')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <div class="row">
                                <div class="col-lg-5">
                                    <label for="example-select">Select Feature Products <span class="req-fed">*</span></label>
                                    <select class="js-select2 form-control" id="pro_id" name="pro_id"
                                        data-placeholder="Choose one.." required>
                                        <option></option>
                                        <?php $__currentLoopData = $Allproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($pro->pro_id); ?>"><?php echo e($pro->pro_code); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-success btn-pos">ADD</button>
                                </div>
                            </div>
                        </form>
                </div>
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full ">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">No.</th>
                            <th class="d-none d-sm-table-cell" style="width: 20%;">Product Code</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">create</th>
                            <th style="width: 20%;" class="text-center">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($products) and !empty($products)): ?>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td class="text-center"><?php echo e($loop->iteration); ?></td>
                        <td class="d-none d-sm-table-cell"><?php echo e($item->pro_code); ?></td>
                
                        <td class="d-none d-sm-table-cell"><?php echo e($item->created_at); ?></td>
                        <td class="text-center">
                                
                                <a href="<?php echo e(route('unSetting' ,$item->pro_id)); ?>" class="btn btn-primary">Unpin</a>
                        </td>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/deltaPSU/dependencies/resources/views/product/feature_products.blade.php ENDPATH**/ ?>