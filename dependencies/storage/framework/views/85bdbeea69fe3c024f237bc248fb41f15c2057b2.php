<?php $__env->startSection('style'); ?>
<style>

    .Absolute-Center {
        position: relative;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -10%);
}
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Multi Doc Upload</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Multi Doc Upload</li>
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
            
            <div class="Absolute-Center">
                <select onchange="getFiler()" class="js-select2 form-control" id="pro_categories" name="categories_doc" data-placeholder="Filter By.." required>
                    <option></option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($cate->id); ?>" <?php echo e(isset($selecValue) &&  $selecValue == $cate->id ? 'selected':''); ?>  ><?php echo e($cate->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <option value="0" <?php echo e(isset($selecValue) &&  $selecValue == 'all' ? 'selected':''); ?> >All</option>
                   </select>
            </div>
            <h3 class="block-title">
            </h3>
            <div class="block-options">
              
                <div class="block-options-item">
                <a href="<?php echo e(route('createDocMutidoc')); ?>" class="btn btn-success">Create</a>
      
                </div>
            </div>
        </div>
           
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No.</th>
                        <th class="d-none d-sm-table-cell" style="">Doc Id</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Document Type</th>
                        <th class="d-none d-sm-table-cell" style="width: 20%;">Model Name</th>
                        <th class="d-none d-sm-table-cell" style="">Name</th>
                        
                        <th class="d-none d-sm-table-cell" style="">Created</th>
                        <th class="d-none d-sm-table-cell" style="">Update</th>
                        <th style="width: 20%;" class="text-center">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($docPros) and !empty($docPros)): ?>
                    <?php $__currentLoopData = $docPros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td class="text-center"><?php echo e($loop->iteration); ?></td>
                    <td class="d-none d-sm-table-cell"><?php echo e($item['doc_id']); ?></td>
                    <td class="d-none d-sm-table-cell"><?php echo e($item['doc_type']); ?></td>
                    <td class="d-none d-sm-table-cell"> 
                        <?php $__currentLoopData = $item['prohas']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($pro->pro_code); ?> , <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                    </td>
                    <td class="d-none d-sm-table-cell"><?php echo e($item['doc_name']); ?></td>
                    <td class="d-none d-sm-table-cell"><?php echo e($item['updated_at']); ?></td>
                    <td class="d-none d-sm-table-cell"><?php echo e($item['created_at']); ?></td>
                    <td class="text-center">
                        <?php if($item['file'] != ''): ?>
                        <a href="<?php echo e(config('app.url')); ?>/upload/product_files/<?php echo e($item['file']); ?>" target="_blank" class="btn btn-outline-info">View EN file</a>
                        <?php else: ?> 
                        <button type="button" class="btn btn-default">No file</button>
                        <?php endif; ?>
                     
                           
                           
                           
                            <a href="<?php echo e(route('editDocMutidoc' ,$item['doc_id'])); ?>" class="btn btn-primary">Edit</a>
                            <button type="button" class="btn btn-danger" onclick="ondelelete(<?php echo e($item['doc_id']); ?>);" data-toggle="modal" data-target="#modal-block-vcenter">Delete</button>
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
                    <form action="<?php echo e(route('deleteproDoc')); ?>" method="POST" >
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
    <!-- END Vertically Centered Block Modal -->


<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
    function getFiler(){
        var value =  $('#pro_categories').val();
        if(value == 0){
            window.location = '<?php echo e(route('product_doc')); ?>';
        }else{
            window.location = '<?php echo e(route('docFilerBy')); ?>'+'/'+value;
        }
     
    }

    function ondelelete(id){
         $('#itemId').val(id);

    }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Deltapsu_Production\dependencies\resources\views\product_doc\index.blade.php ENDPATH**/ ?>