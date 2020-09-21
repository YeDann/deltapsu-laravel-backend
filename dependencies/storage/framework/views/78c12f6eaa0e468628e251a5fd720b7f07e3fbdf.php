
<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Create Document</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="<?php echo e(route('docFilerBy' ,1)); ?>">Documents</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Content -->
<div class="content">
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">Document</h3>
        </div>
        <div class="block-content">
            <form action="<?php echo e(route('storeProdoc')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <!-- Basic Elements -->
                <div class="row">
                    <div class="col-lg-12">
                            <div class="form-group">
                                    <label for="example-select"><span class="req-fed">*</span> Select Document Types</label>
                            <select class="js-select2 form-control" id="catedocId" onchange="selectDocCate();" name="doc_categories" data-placeholder="Choose one.." required>
                                 <option></option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $main): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($main->id); ?>"><?php echo e($main->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   
                            </select>
                                </div>
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
                            <button class="btn btn-success" type="submit">Create </button>
                            <a href="<?php echo e(route('docFilerBy' ,1)); ?>" class="btn btn-secondary">
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
    $(document).on('change', '#file_input', function () {
        // alert(this.files[0].size);
        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 20) {
            alert("File size exceeds 20 MB!");
            this.value = "";
        };
    });

    function selectDocCate() {
      var cateid = $("#catedocId").val();
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
                console.log(data);
                var options = '';

                for (var i = 0; i < data.data.length; i++) {
                    options += '<option value="' + data.data[i].pro_id + '">' + data.data[i]
                        .pro_code + '</option>';
                }
                $("select#ModelIdNotSelectIncate").html(options);
            }

        });

    }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/deltaPSU/dependencies/resources/views/product_doc/create_doc.blade.php ENDPATH**/ ?>