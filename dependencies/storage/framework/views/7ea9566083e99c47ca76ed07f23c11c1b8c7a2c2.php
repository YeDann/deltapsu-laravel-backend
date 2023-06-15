<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit Document</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="<?php echo e(route('docFilerBy' , $docs[0]->cate_id)); ?>">Documents</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
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
            <h3 class="block-title">Document</h3>
        </div>
        <div class="block-content">
            <form action="<?php echo e(route('updateProdoc')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

            <input type="hidden" name="doc_id" value="<?php echo e($docs[0]->doc_id); ?>">
                <!-- Basic Elements -->
                <div class="row">
                    <div class="col-lg-12">
                            <div class="form-group">
                                    <label for="example-select"><span class="req-fed">*</span> Select Document Types</label>
                            <select class="js-select2 form-control" id="catedocId" onchange="selectDocCate();" name="doc_categories" data-placeholder="Choose one.." required>
                                <option></option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $main): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($main->id == $docs[0]->cate_id): ?>
                                <option value="<?php echo e($main->id); ?>" selected><?php echo e($main->title); ?></option>
                                <?php else: ?> 
                                <option value="<?php echo e($main->id); ?>"><?php echo e($main->title); ?></option>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   
                            </select>
                                </div>
                        <div class="block block-rounded block-bordered">
                            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item">
                                <a class="nav-link <?php echo e($loop->iteration == 1 ?'active':''); ?>" href="#btabs-alt-static-<?php echo e($item->name); ?>"
                                        style="text-transform: capitalize;"><?php echo e($item->name); ?></a>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <div class="block-content tab-content">
                                <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php 
                                $current = null;
                                foreach($docs as $item) { 
                                    if ($item2->name == $item->local) {
                                        $current = $item;
                                        break;
                                    }
                                }
                               ?>
                                <input type="hidden" name="lang_loop[]" value="<?php echo e($item2->name); ?>">
                                <div class="tab-pane <?php echo e(($loop->iteration == 1)? 'active':''); ?>" id="btabs-alt-static-<?php echo e($item2->name); ?>" role="tabpanel">
                                        <div class="form-group">
                                            <label for="example-select">Name</label>
                                            <input type="text"
                                                class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>"
                                                name="name[<?php echo e($item2->name); ?>]" value="<?php echo e(isset($current->name)? $current->name :''); ?>" placeholder="Enter name...">
                                        </div>
                                        <div class="form-group">
                                                <label for="example-select"> Old File</label>
                                                <a href="<?php echo e(config('app.url')); ?>/upload/product_files/<?php echo e(isset($current->file)? $current->file :''); ?>"
                                                    target="_blank"><?php echo e(isset($current->file)? $current->file :''); ?></a>
                                                    <input type="hidden" name="oldfile[<?php echo e($item2->name); ?>]"  value="<?php echo e(isset($current->file)? $current->file :''); ?>" >
                                                    <?php if(isset($current->file)): ?>
                                                    <a href="<?php echo e(route('removefileDoc',[$item2->name,$docs[0]->doc_fk_id])); ?>" target="_blank" class="btn btn btn-danger"><i class="fa fa-trash"></i> </a>
                                                        <?php endif; ?>
                                            </div>
                                        <div class="form-group">
                                            <label for="example-select">New File <span class="req-fed">* Max File Size 80 MB</span></label>
                                            <div class="custom-file " style="width:100%;">
                                                <input type="file" class="custom-file-input" id="file_input<?php echo e($item2->name); ?>" onchange="checkmaxsize(`file_input<?php echo e($item2->name); ?>` ,'file_lable<?php echo e($item2->name); ?>')" name="fileGU[<?php echo e($item2->name); ?>]"
                                                    data-toggle="custom-file-input">
                                                <label class="custom-file-label file_lable<?php echo e($item2->name); ?>" for="fileImage">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div  class="block block-rounded block-bordered">
                            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                <?php $__currentLoopData = $other_lang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item">
                                <a class="nav-link <?php echo e($loop->iteration == 1 ?'active':''); ?>" href="#btabs-alt-static-<?php echo e($item->name); ?>"
                                        style="text-transform: capitalize;"><?php echo e($item->name); ?></a>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <div class="block-content tab-content">
                                <?php $__currentLoopData = $other_lang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php 
                                $current2 = null;
                                foreach($docs as $item) { 
                                    if ($item3->name == $item->local) {
                                        $current2 = $item;
                                        break;
                                    }
                                }
                               ?>
                             
                                <input type="hidden" name="lang_loop[]" value="<?php echo e($item3->name); ?>">
                                <div class="tab-pane <?php echo e(($loop->iteration == 1)? 'active':''); ?>" id="btabs-alt-static-<?php echo e($item3->name); ?>" role="tabpanel">
                                        <div class="form-group">
                                            <label for="example-select">Name</label>
                                            <input type="text"
                                                class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>"
                                                name="name[<?php echo e($item3->name); ?>]" value="<?php echo e(isset($current2->name)? $current2->name :''); ?>" placeholder="Enter name...">
                                        </div>
                                        <div class="form-group">
                                                <label for="example-select"> Old File</label>
                                                <a href="<?php echo e(config('app.url')); ?>/upload/product_files/<?php echo e(isset($current2->file)? $current2->file :''); ?>"
                                                    target="_blank"><?php echo e(isset($current2->file)? $current2->file :''); ?></a>
                                                    <input type="hidden" name="oldfile[<?php echo e($item3->name); ?>]"  value="<?php echo e(isset($current2->file)? $current2->file :''); ?>" >
                                                    <?php if(isset($current2->file)): ?>
                                                    <a href="<?php echo e(route('removefileDoc',[$item3->name,$docs[0]->doc_fk_id])); ?>" target="_blank" class="btn btn btn-danger"><i class="fa fa-trash"></i> </a>
                                                        <?php endif; ?>
                                                </div>
                                                
                                        <div class="form-group">
                                            <label for="example-select">New File <span class="req-fed">* Max File Size 80 MB</span></label>
                                            <div class="custom-file " style="width:100%;">
                                                <input type="file" class="custom-file-input" id="file_input<?php echo e($item3->name); ?>" onchange="checkmaxsize(`file_input<?php echo e($item3->name); ?>` ,'file_lable<?php echo e($item3->name); ?>')" name="fileGU[<?php echo e($item3->name); ?>]"
                                                    data-toggle="custom-file-input">
                                                <label class="custom-file-label file_lable<?php echo e($item3->name); ?>" for="fileImage">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                      <div class="col-lg-8 pt-2">
                           
                            <div class="form-group">
                                    <label for="example-select">Multiple  Select Products</label>
                                    <select class="js-select2 form-control" id="ModelIdNotSelectIncate" name="product[]" style="width: 100%;" data-placeholder="Choose many.." multiple>
                                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                      
                                        
                                       
                                    </select>
                                </div>
                          </div>
              
                    <div class="col-lg-12 mt-5">
                        <div class="text-center form-group">
                            <button class="btn btn-info" type="submit">Update </button>
                            <a href="<?php echo e(route('docFilerBy' , $docs[0]->cate_id)); ?>" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
    $(document).on('change', '.custom-file-input', function () {
        // alert(this.files[0].size);
        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 20) {
            alert("File size exceeds 20 MB!");
            $('.custom-file-label').text('Choose file');
            this.value = "";
        };
    }
</script>
<script>
 
    var doc_has_pros = <?= json_encode($doc_has_pros);?>;
    $(document).ready(function() {
           selectDocCate();
        });
    
    function selectDocCate() {
      var cateid = $("#catedocId").val();
      console.log(cateid);
        $.ajax({
            url: "<?php echo e((route('searhModelProductByCatedoc'))); ?>",
            data: {
            'cateid': cateid,
           },
           type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                // console.log(doc_has_pros[0]['pro_id'], doc_has_pros[0]['pro_code']);
                var options = '';

                for (var i = 0; i < data.data.length; i++) {
                    options += '<option value="' + data.data[i].pro_id + '">' + data.data[i]
                        .pro_code + '</option>';
                }

                for (var j = 0; j < doc_has_pros.length; j++) {
                    options += '<option value="' + doc_has_pros[j]['pro_id'] + '" selected>' + doc_has_pros[j]['pro_code']+ '</option>';
                }

                $("select#ModelIdNotSelectIncate").html(options);
            }

        });

    }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Deltapsu_Production/dependencies/resources/views/product_doc/edit_doc.blade.php ENDPATH**/ ?>