<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Default Filters</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="<?php echo e(route('subCategories')); ?>">All Product Categories</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Default Filters</li>
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
            <div class="block-title">
                    <form action="<?php echo e(route('storeDefaultfiler')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                <div class="row"> 
                        <div class="col-lg-5"> 
                      
                                <select class="form-control js-select2"  name="filername" >
                                       <option value="null">Select Filter </option>
                                        <?php $__currentLoopData = $section; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $se): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <option value="" disabled><?php echo e($se->name); ?></option>
                                        <?php $__currentLoopData = $pd_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fields): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($se->sectionId == $fields->section_id): ?>
                                        <option value="<?php echo e($fields->pd_field_id); ?>|<?php echo e($fields->field_name); ?>" > &nbsp;&nbsp;<?php echo e($fields->field_name); ?></option>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <option value=""disabled>Other</option>
                                        <option value="series01|Series" > &nbsp;&nbsp;Series</option>
                                        <option value="status02|Status" > &nbsp;&nbsp;Status</option>
                                        <option value="safety03|Safety" > &nbsp;&nbsp;Safety</option>
                                        <option value="certifi04|Certificate" > &nbsp;&nbsp;Certificate</option>
                                   </select>
                        </div>
                        <div class="col-lg-2"> 
                            <button type="submit" class="btn btn-success">ADD</button>
                        </div>
                </div>
                </form>
                
            </div>
            <div class="block-options">
                <div class="block-options-item ">
                  
                </div>
                
            </div>
        </div>
        <div class="block-content block-content-full">
 
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No.</th>
                        <th class="d-none d-sm-table-cell" style="width: 20%;">Name</th>
                        <th style="width: 20%;" class="text-center">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($filter_pro) and !empty($filter_pro)): ?>
                    <?php $__currentLoopData = $filter_pro; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <tr class="odd order-list" data-id="<?php echo e($item->id); ?>">
                    <td class="text-center"><?php echo e($loop->iteration); ?></td>
                    <td class="d-none d-sm-table-cell"><?php echo e($item->name); ?></td>
                    <td class="text-center">
                            <button type="button" class="btn btn-danger" onclick="ondelelete(<?php echo e($item->id); ?>);" data-toggle="modal" data-target="#modal-block-vcenter">Delete</button>
                    </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>
 <!-- Vertically Centered Block Modal -->
 <div class="modal" id="modal-block-vcenter" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-danger">
                        <h3 class="block-title">!! Warning </h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form action="<?php echo e(route('deleteDefaultfilter')); ?>" method="POST" >
                        <?php echo e(csrf_field()); ?>

                    <div class="block-content">
                        <input type="hidden" name="itemId" id="itemId">
                        <p>Data will be lost?</p>
                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <button type="button" class="btn  btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">OK</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>

    function ondelelete(id){
         $('#itemId').val(id);

    }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Deltapsu_Production\dependencies\resources\views\product\default_filter.blade.php ENDPATH**/ ?>