
<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Product Doc</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                        <li class="breadcrumb-item"> <a href="<?php echo e(route('products.index')); ?>">Products</a> </li>
                    <li class="breadcrumb-item active" aria-current="page"> Product Doc </li>
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
                    <form action="<?php echo e(route('storeProDocuments')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                <div class="row"> 
                        <div class="col-lg-5"> 
                        <input type="hidden" value="<?php echo e($productId); ?>" name="productId">
                                <select class="js-select2 form-control"  name="documents" style="width: 100%;" data-placeholder="Choose Documents.." required >
                                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        <?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->doc_id); ?>"> 
                                    
                                      <?php echo e($item->name); ?>

                                     
                                      <?php 
                                      $name = '';
                                      if($item->main_cate_id == 1){
                                        $name = 'Documents';
                                      }else{
                                        $name = 'Certificate';
                                      }
                                      ?>
                                    (<?php echo e($name); ?>)
                                      (<?php echo e($item->catename); ?>)
                                    </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                        </div>
                        <div class="col-lg-2"> 
                            <button type="submit" class="btn btn-success">ADD</button>
                        </div>
                </div>
                </form>
            </h3>
            <div class="block-options">
                <div class="block-options-item">
                
                </div>
                <div class="block-options-item">
                    <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#modal-block-create">Create Doc</button>
                </div>
            </div>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No.</th>
                        <th class="d-none d-sm-table-cell" style="width: 20%;">Type file</th>
                        <th class="d-none d-sm-table-cell">Name</th>
                        <th class="d-none d-sm-table-cell" style="">Created</th>
                        <th style="width: 20%;" class="text-center">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($doc_has_pros) and !empty($doc_has_pros)): ?>
                    <?php $__currentLoopData = $doc_has_pros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td class="text-center"><?php echo e($loop->iteration); ?></td>
                    <td class="d-none d-sm-table-cell"><?php echo e($item->catename); ?></td>
                    <td class="d-none d-sm-table-cell"><?php echo e($item->name); ?></td>
                    <td class="d-none d-sm-table-cell"><?php echo e($item->created_at); ?></td>
                    <td class="text-center">
                        <?php if($item->file != ''): ?>
                        <a href="<?php echo e(config('app.url')); ?>/upload/product_files/<?php echo e($item->file); ?>" target="_blank" class="btn btn-outline-info">View EN file</a>
                        <?php else: ?> 
                        <button type="button" class="btn btn-default">No file</button>
                        <?php endif; ?>
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
                    <form action="<?php echo e(route('deleteproHasDoc')); ?>" method="POST" >
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" value="<?php echo e($productId); ?>" name="productId">
                    <div class="block-content">
                        <input type="hidden" name="itemId" id="itemId">
                        <p>Only delete product in document</p>
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
 <div class="modal" id="modal-block-create" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter" aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Create Document </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="<?php echo e(route('createProdocuments')); ?>" method="POST"  enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                  
                <div class="block-content">
                    <div class="col-lg-12">
                        <div class="form-group">
                               <label for="example-select"><span class="req-fed">*</span> Select Document Types</label>
                        </div>
                        <select class="form-control" name="doc_categories" data-placeholder="Choose one.." required>
                           
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $main): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($main->id); ?>"><?php echo e($main->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                            <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <input type="hidden" name="lang_loop[]" value="<?php echo e($item->name); ?>">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $other_lang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $spelang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <input type="hidden" name="lang_loop[]" value="<?php echo e($spelang->name); ?>">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="form-group">
                            <label for="example-select">Name</label>
                            <input type="text"
                                class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>"
                                name="name" placeholder="Enter name...">
                        </div>
                        <div class="form-group">
                            <label for="example-select">File <span class="req-fed">* Max File Size 20 MB</span></label>
                            <div class="custom-file " style="width:100%;">
                                <input type="file" class="custom-file-input" name="fileGU[en]"
                                    data-toggle="custom-file-input">
                                <label class="custom-file-label" for="fileImage">Choose file</label>
                            </div>
                        </div>
                </div>
                    <input type="hidden" value="<?php echo e($productId); ?>" name="productId">
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
    function ondelelete(id){
         $('#itemId').val(id);
    }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/deltaPSU/dependencies/resources/views/product/document_pro.blade.php ENDPATH**/ ?>