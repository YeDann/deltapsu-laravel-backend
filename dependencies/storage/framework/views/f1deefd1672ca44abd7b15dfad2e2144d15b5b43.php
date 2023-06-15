<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Special Languages</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Special Languages</li>
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
                <div class="block-options-item">
                
                </div>
                <div class="block-options-item">
                <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#modal-block-create">Create</button>
                </div>
            </div>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No.</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Short Name</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Full Name</th>
                        <th style="width: 20%;" class="text-center">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($secial_langs) and !empty($secial_langs)): ?>
                    <?php $__currentLoopData = $secial_langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td class="text-center"><?php echo e($loop->iteration); ?></td>
                    <td class="d-none d-sm-table-cell"><?php echo e($item->name); ?></td>
                    <td class="d-none d-sm-table-cell"><?php echo e($item->full_name); ?></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-primary" onclick="edit(<?php echo e($item->id); ?> ,'<?php echo e($item->name); ?>','<?php echo e($item->full_name); ?>' );" data-toggle="modal" data-target="#modal-block-edit">Edit</button>
                        <button type="button" class="btn btn-danger" onclick="ondelelete(<?php echo e($item->id); ?>,'<?php echo e($item->name); ?>');" data-toggle="modal" data-target="#modal-block-vcenter">Delete</button>
                       
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
                    <form action="<?php echo e(route('deleteSpecailLang')); ?>" method="POST" >
                        <?php echo e(csrf_field()); ?>

                      
                    <div class="block-content">
                        <input type="hidden" name="itemId" id="itemId">
                        <input type="hidden" name="itemName" id="itemName">
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
    <!-- END Vertically Centered Block Modal -->

     <!-- Vertically Centered Block Modal -->
 <div class="modal" id="modal-block-edit" tabindex="-1" role="dialog" aria-labelledby="modal-block-edit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Update Language </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="<?php echo e(route('Update_spelang')); ?>" method="POST" >
                    <?php echo e(csrf_field()); ?>

                  
                <div class="block-content">
                    <div class="form-group">
                        <label for="example-select">Language</label>
                        <input type="hidden" id="langId"  name="langId">
                        <input type="text" class="form-control"  id="langName"   name="langName" placeholder="Enter text...">
                    </div>
                  
                    <div class="form-group">
                        <label for="example-select">Language (full Name )</label>
                        <input type="text" class="form-control" id="fulname"  name="full_name" placeholder="Enter text...">
                    </div>
                 
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
<!-- END Vertically Centered Block Modal -->
     <!-- Vertically Centered Block Modal -->
     <div class="modal" id="modal-block-create" tabindex="-1" role="dialog" aria-labelledby="modal-block-create" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">Create Special Language</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form action="<?php echo e(route('store_spelang')); ?>" method="POST" >
                        <?php echo e(csrf_field()); ?>

                      
                    <div class="block-content">
                        <div class="form-group">
                            <label for="example-select">Language (Short Name Ex. en ,th ,jw ...)</label>
                            <input type="text" class="form-control"   name="langName" placeholder="Enter text...">
                        </div>
                        <div class="form-group">
                            <label for="example-select">Language (full Name )</label>
                            <input type="text" class="form-control"  name="full_name" placeholder="Enter text...">
                        </div>
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
    <!-- END Vertically Centered Block Modal -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
    function edit(id ,name, fulname){
        //  console.log(id);
         $('#langId').val(id);
         $('#langName').val(name);
         $('#fulname').val(fulname);
    }  

    function ondelelete(id ,name){
         $('#itemId').val(id);
         $('#itemName').val(name);
         

    }
 

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Deltapsu_Production/dependencies/resources/views/product_doc/special_lang.blade.php ENDPATH**/ ?>