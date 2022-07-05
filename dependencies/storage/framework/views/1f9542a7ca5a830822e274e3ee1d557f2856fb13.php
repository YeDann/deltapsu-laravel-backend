<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit Product Categories</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="<?php echo e(route('subCategories')); ?>">All Product Categories</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Content -->
<div class="content">
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">Product Categories</h3>
        </div>
        <div class="block-content">
            <form action="<?php echo e(route('UpdateSubCategories')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="subid" value="<?php echo e($subid); ?>">
                <!-- Basic Elements -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="block block-rounded block-bordered">
                            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($loop->iteration == 1): ?>
                                <li class="nav-item">
                                    <a class="nav-link active" href="#btabs-alt-static-<?php echo e($item->name); ?>"
                                        style="text-transform: capitalize;"><?php echo e($item->name); ?></a>
                                </li>
                                <?php else: ?>
                                <li class="nav-item">
                                    <a class="nav-link " href="#btabs-alt-static-<?php echo e($item->name); ?>"
                                        style="text-transform: capitalize;"><?php echo e($item->name); ?></a>
                                </li>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <div class="block-content tab-content">

                                <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php 
                                    $current = null;
                                    foreach($subCategories as $item) { 
                                        if ($item2->name == $item->local) {
                                            $current = $item;
                                            break;
                                        }
                                    }
                               ?>
                                <input type="hidden" name="lang_loop[]" value="<?php echo e($item2->name); ?>">
                                <input type="hidden" name="oldfile[<?php echo e($item2->name); ?>]" value="<?php echo e(isset($current->file) ? $current->file :''); ?>">
                               
                                <div class="tab-pane <?php echo e(($loop->iteration == 1) ? "active":""); ?>" id="btabs-alt-static-<?php echo e($item2->name); ?>" role="tabpanel">
                                    <div class="form-group"> 
                                        <label for="example-select"><span class="req-fed">*</span>Name</label>
                                        <input type="text"
                                            class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>"
                                            name="name[<?php echo e($item2->name); ?>]" value="<?php echo e(isset($current->name) ? $current->name :''); ?>"
                                            placeholder="Enter name...">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-select">Overview</label>
                                        <textarea rows="4" class="form-control"
                                            name="content[<?php echo e($item2->name); ?>]"><?php echo e(isset($current->content) ? $current->content :''); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-select">Overview (Medical Power)</label>
                                        <textarea rows="4" class="form-control"
                                            name="contentAddType1[<?php echo e($item2->name); ?>]"><?php echo e(isset($current->contenttype1) ? $current->contenttype1 :''); ?> </textarea>
                                    </div>
            
                                    <div class="form-group">
                                        <label for="example-select">Overview(Industrial Power)</label>
                                        <textarea rows="4" class="form-control"
                                            name="contentAddType2[<?php echo e($item2->name); ?>]"><?php echo e(isset($current->contenttype2) ? $current->contenttype2 :''); ?> </textarea>
                                    </div>
            
                                    <div class="form-group">
                                        <label for="example-select">Overview (LED Driver)</label>
                                        <textarea rows="4" class="form-control"
                                            name="contentAddType3[<?php echo e($item2->name); ?>]"><?php echo e(isset($current->contenttype3) ? $current->contenttype3 :''); ?> </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-select"> Old File</label>
                                        <a href="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e(isset($current->file) ? $current->file :''); ?>"><?php echo e(isset($current->file) ? $current->file :''); ?></a>
                                        <?php if(isset($current->file)): ?>
                                        <a href="<?php echo e(route('removefileDocSelectionGuide',[$subCategories[0]->sub_pro_id,$item2->name])); ?>"  class="btn btn btn-danger"><i class="fa fa-trash"></i> </a>
                                            <?php endif; ?>
                                    </div>
                                 

                                    <div class="form-group">


                                        <label for="example-select">New Selection Guide <span class="req-fed">* Max File
                                                Size 20 MB</span></label>
                                        <div class="custom-file " style="width:100%;">
                                            <input type="file" class="custom-file-input file_input"
                                                name="fileGU[<?php echo e($item2->name); ?>]" data-toggle="custom-file-input">
                                            <label class="custom-file-label" for="fileImage">Choose file</label>
                                        </div>
                                    </div>
                                    <?php if($subCategories[0]->sub_pro_id == 7): ?>
                                
                                    <p>-- Detail Page --</p>
                                    <div class="form-group">
                                    <label for="example-select">Content 1</label>
                                    <textarea rows="4"  class="jssummernote"
                                        name="content1[<?php echo e($item2->name); ?>]"><?php echo e(isset($current->content1) ? $current->content1 :''); ?></textarea>
                                    </div>
             
                                    <div class="form-group">
                                    <label for="example-select">Content 2</label>
                                    <textarea rows="4"  class="jssummernote1"
                                        name="content2[<?php echo e($item2->name); ?>]"><?php echo e(isset($current->content2) ? $current->content2 :''); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-select">Safety Certificates</label>
                                        <textarea rows="4"  class="jssummernote2"
                                            name="safety_cer[<?php echo e($item2->name); ?>]"><?php echo e(isset($current->safety_cer) ? $current->safety_cer :''); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                            <label for="example-select"> Highlights & Features </label>
                                            <textarea rows="4"  class="jssummernote3"
                                                name="features[<?php echo e($item2->name); ?>]"><?php echo e(isset($current->highlight) ? $current->highlight :''); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                     <label for="example-select">Dimensions </label>
                                     <textarea rows="4"  class="jssummernote4"
                                         name="dimensions[<?php echo e($item2->name); ?>]"><?php echo e(isset($current->dimension) ? $current->dimension :''); ?></textarea>
                                  </div>
                                  
                                  <div class="form-group">
                                     <label for="example-select">Unit Weight</label>
                                     <textarea rows="4"  class="jssummernote5"
                                         name="unit[<?php echo e($item2->name); ?>]"><?php echo e(isset($current->unit_wight) ? $current->unit_wight :''); ?></textarea>
                                  </div>
                                 
                                 <?php endif; ?>
                                </div>

                               
                             
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
              
                    <div class="col-lg-12">
                     
                        <div class="table-responsive">
                                <table class="table table-bordered table-striped table-vcenter">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 10px;">
                                                File Type
                                            </th>
                                            <th class="text-center" style="width:400px;">
                                                 Old Image
                                                </th>
                                          
                                            <th style="width: 300px;">Preview</th>
                                            <th style="width: 300px;">Update File <span class="req-fed">* File Max Size 2 MB</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">
                                                    thumbnail
                                            </td>
                                            <td class="">
                                                    <img src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($subCategories[0]->image); ?>"
                                                        class="img-thumbnail res-image" alt="">
                                                        <input type="hidden" name="oldfileimage" value="<?php echo e($subCategories[0]->image); ?>">
                                                </td>
                                            <td class="">
                                                <img src="https://via.placeholder.com/375x184.png"
                                                    class="img-thumbnail imagePreview2 res-image" alt="">
                                            </td>
    
                                            <td class="">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        data-toggle="custom-file-input" id="thumbnail" name="thumbnail"
                                                        value=" " accept="image/*">
                                                    <label id="label1" class="custom-file-label" for="thumbnail">Choose file</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <input type="hidden" name="typeImage[type1]"   value="type1">
                                        <input type="hidden" name="typeImage[type2]"  value="type2" >
                                        <input type="hidden" name="typeImage[type3]"  value="type3" >
                              

                                    

                                        <tr>
                                            <td class="text-center">
                                                    thumbnail (Medical Power)
                                            </td>
                                            <td class="">
                                                <img src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($subCategories[0]->image_type1); ?>"
                                                    class="img-thumbnail res-image" alt="">
                                                    <input type="hidden" name="oldfileytype[type1]" value="<?php echo e($subCategories[0]->image_type1); ?>">
                                            </td>
                                            <td class="">
                                                    <img src="https://via.placeholder.com/375x184.png" class="img-thumbnail imagePreviewType1"
                                                    alt="">
                                            </td>
                                            <td class="">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        data-toggle="custom-file-input" id="thumbnail1" name="thumbnailOpt[type1]"
                                                        value=" " accept="image/*">
                                                    <label id="labelType1" class="custom-file-label" for="thumbnail1">Choose file</label>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="text-center">
                                                    thumbnail (Industrial Power)
                                            </td>
                                            <td class="">
                                                <img src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($subCategories[0]->image_type2); ?>"
                                                    class="img-thumbnail res-image" alt="">
                                                    <input type="hidden" name="oldfileytype[type2]" value="<?php echo e($subCategories[0]->image_type2); ?>">
                                            </td>
                                            <td class="">
                                                    <img src="https://via.placeholder.com/375x184.png" class="img-thumbnail imagePreviewType2"
                                                    alt="">
                                            </td>
                                            <td class="">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        data-toggle="custom-file-input" id="thumbnail2" name="thumbnailOpt[type2]"
                                                        value=" " accept="image/*">
                                                    <label id="labelType2" class="custom-file-label" for="thumbnail2">Choose file</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                    thumbnail (LED Driver)
                                            </td>
                                            <td class="">
                                                <img src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($subCategories[0]->image_type3); ?>"
                                                    class="img-thumbnail res-image" alt="">
                                                    <input type="hidden" name="oldfileytype[type3]" value="<?php echo e($subCategories[0]->image_type3); ?>">
                                            </td>
                                            <td class="">
                                                    <img src="https://via.placeholder.com/375x184.png" class="img-thumbnail imagePreviewType3"
                                                    alt="">
                                            </td>
                                        
                                            <td class="">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        data-toggle="custom-file-input" id="thumbnail3" name="thumbnailOpt[type3]"
                                                        value=" " accept="image/*">
                                                    <label id="labelType3" class="custom-file-label" for="thumbnail1">Choose file</label>
                                                </div>
                                            </td>
                                        </tr>
                                     
                                    </tbody>
                                </table>
                            </div>
                    </div>
                    <div class="col-lg-8">
                        <label for="example-select"><span class="req-fed">*</span> Main Categories</label>
                        <select onchange="orderAddPro();" class="js-select2 form-control" name="main_categories[]" data-placeholder="Choose many.." multiple>
                            <option></option>
                            <?php $__currentLoopData = $mainCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $main): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($main->main_id); ?>"><?php echo e($main->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $mainInCate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $incate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($incate->main_id); ?>" selected><?php echo e($incate->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                       
                        <div class="form-group mt-2">
                            <label for="example-select">Unit dimension</label>
                            <div style="color:red;">*Only H or D</div>
                            <input type="text"
                                class="form-control "
                        name="unit_dimension" value="<?php echo e($subCategories[0]->unit_dimension); ?>" maxlength="2" placeholder="Enter text...">
                        </div>
                        <div class="form-group">
                                        <label for="example-select"> Old File Warranty</label>
                                        <a href="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e(isset($subCategories[0]->warranty_file) ?$subCategories[0]->warranty_file:''); ?>"><?php echo e(isset($subCategories[0]->warranty_file) ? $subCategories[0]->warranty_file :''); ?></a>
                                        <?php if(isset($subCategories[0]->warranty_file)): ?>
                                        <a href="<?php echo e(route('removefileDocWaranfile',$subCategories[0]->sub_pro_id)); ?>"  class="btn btn btn-danger"><i class="fa fa-trash"></i> </a>
                                            <?php endif; ?>
                                            <input type="hidden" name="oldfile_warranty_file" value="<?php echo e(isset($subCategories[0]->warranty_file) ? $subCategories[0]->warranty_file :''); ?>">
                                    </div>
                        <div class="form-group">
                            <label for="example-select"> Warranty Policy<span class="req-fed">* Max File
                                    Size 20 MB</span></label>
                            <div class="custom-file " style="width:100%;">
                                <input type="file" class="custom-file-input file_input"
                                    name="warranty_file" data-toggle="custom-file-input">
                                <label class="custom-file-label" for="warranty_file">Choose file</label>
                            </div>
                            </div>
                    </div>
                    <div class="form-group">
                    <?php $__currentLoopData = $orderCate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <input type="hidden" name="orderCate[<?php echo e($cate->main_cateid); ?>]" value="<?php echo e($cate->order_seq); ?>">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="col-lg-12 mt-5 mb-5">
                        <div class="text-center form-group">
                            <button class="btn btn-info" type="submit">Update </button>
                            <a href="<?php echo e(route('subCategories')); ?>" class="btn btn-secondary">
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
    $('.jssummernote').summernote({
      tabsize: 2,
      height: 200,
      callbacks: {
                        onImageUpload: function(files) {
                            that = $(this);
                           sendFile(files[0], that);
                        }
                    }
    });
    $('.jssummernote1').summernote({
      tabsize: 2,
      height: 200,
      callbacks: {
                        onImageUpload: function(files) {
                            that = $(this);
                           sendFile(files[0], that);
                        }
                    }
    });
    $('.jssummernote2').summernote({
      tabsize: 2,
      height: 200,
      callbacks: {
                        onImageUpload: function(files) {
                            that = $(this);
                           sendFile(files[0], that);
                        }
                    }
    });
    $('.jssummernote3').summernote({
      tabsize: 2,
      height: 200,
      callbacks: {
                        onImageUpload: function(files) {
                            that = $(this);
                           sendFile(files[0], that);
                        }
                    }
    });
    $('.jssummernote4').summernote({
      tabsize: 2,
      height: 100,
      callbacks: {
                        onImageUpload: function(files) {
                            that = $(this);
                           sendFile(files[0], that);
                        }
                    }
    });
    $('.jssummernote5').summernote({
      tabsize: 2,
      height: 100,
      callbacks: {
                        onImageUpload: function(files) {
                            that = $(this);
                           sendFile(files[0], that);
                        }
                    }

    });

    function sendFile(file,that) {
                   
                   var data = new FormData();
                    console.log(file);
                    data.append("file", file);
                    $.ajax({
                        data: data,
                        type: "POST",
                        url: "<?php echo e(route('uploadtoTexteditor')); ?>",
                        cache: false,
                        contentType: false,
                        processData: false,
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(url) {
                            $(that).summernote('insertImage', url.url, '');
                        }
                    });
                }
  </script>
<script>
    var previewImage = function (input, block) {
        var fileTypes = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
        var extension = input.files[0].name.split('.').pop().toLowerCase(); /*se preia extensia*/
        var isSuccess = fileTypes.indexOf(extension) > -1; /*se verifica extensia*/

        if (isSuccess) {
            var reader = new FileReader();

            reader.onload = function (e) {
                block.attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            alert('file is not accept!');
        }

    };

    $(document).on('change', '#thumbnail', function () {

        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert("File size exceeds 2 MB!");
            this.value = "";
            $('#label2').text('Choose file');
        }else{
            previewImage(this, $('.imagePreview2'));
        }
  });
  $(document).on('change', '#thumbnail1', function () {
    var FileSize = this.files[0].size / 1024 / 1024; // in MB
    if (FileSize > 2) {
        alert("File size exceeds 2 MB!");
        this.value = "";
        $('#labelType1').text('Choose file');
    }else{
        previewImage(this, $('.imagePreviewType1'));
    }
    });

    $(document).on('change', '#thumbnail2', function () {
    var FileSize = this.files[0].size / 1024 / 1024; // in MB
    if (FileSize > 2) {
        alert("File size exceeds 2 MB!");
        this.value = "";
        $('#labelType2').text('Choose file');
    }else{
        previewImage(this, $('.imagePreviewType2'));
    }
    });
    $(document).on('change', '#thumbnail3', function () {
    var FileSize = this.files[0].size / 1024 / 1024; // in MB
    if (FileSize > 2) {
        alert("File size exceeds 2 MB!");
        this.value = "";
        $('#labelType3').text('Choose file');
    }else{
        previewImage(this, $('.imagePreviewType3'));
    }
    });

    $(document).on('change', '#file_input', function () {
        // alert(this.files[0].size);
        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 20) {
            alert("File size exceeds 20 MB!");
            this.value = "";
        };
    });
  
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Deltapsu_Production/dependencies/resources/views/pro_categories/sub_edit.blade.php ENDPATH**/ ?>