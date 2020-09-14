<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('backend-asset/js/plugins/summernote/summernote-bs4.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('backend-asset/js/plugins/simplemde/simplemde.min.css')); ?>">
<link rel="stylesheet"
    href="<?php echo e(asset('backend-asset/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')); ?>">

<style>
    #test-label {
        height: 100px !important;
    }
    .btn-outline-secondary {
        border-color: #dcdcdc!important;
    }

</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Event</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('event.index')); ?>">Events</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Content -->
<div class="content mb-5">
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">Edit Content</h3>
        </div>
        <br>
        <form id="form-work" class="form-horizontal" role="form" autocomplete="off" action="<?php echo e(route('eventUpdate')); ?>"
            method="post" novalidate="novalidate" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="eventId" value="<?php echo e($contents[0]->id); ?>">
            <div class="row pl-4 pr-4">
                <div class="col-md-12">
                    <div class="block block-rounded block-bordered">
                        <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                            <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <input type="hidden" name="langloop[]" value="<?php echo e($item->name); ?>" >
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
                            <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php 
                            $current = null;
                            foreach($contents as $item2) { 
                                if ($item->name == $item2->local) {
                                    $current = $item2;
                                    break;
                                }
                            }
                          ?>
                        <div class="tab-pane <?php echo e(($loop->iteration == 1)?"active":""); ?>" id="btabs-alt-static-<?php echo e($item->name); ?>" role="tabpanel">
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" class="form-control" name="title[<?php echo e($item->name); ?>]"
                                        value="<?php echo e(isset($current->title) ? $current->title :''); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Excerpt</label>
                                    <textarea  name="description[<?php echo e($item->name); ?>]"
                                        class="jsnotenew form-control"  rows="4"><?php echo e(isset($current->description) ? $current->description :''); ?></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Content</label>
                                    <textarea name="content[<?php echo e($item->name); ?>]"
                                        class="jsnotenew form-control"><?php echo e(isset($current->content) ? $current->content :''); ?></textarea>
                                </div>
                                <div class="form-group">
                                        <label for="">Location</label>
                                        <input type="text" class="form-control" name="location[<?php echo e($item->name); ?>]" value="<?php echo e(isset($current->location) ? $current->location :''); ?>" >
                                    </div>
                                    
                                <hr>
                                <div class="form-group">
                                    <label for="">Meta - Title</label>
                                    <input type="meta_title[<?php echo e($item->name); ?>]" class="form-control"
                                        name="meta_title[<?php echo e($item->name); ?>]" value="<?php echo e(isset($current->meta_title) ? $current->meta_title :''); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Meta - Description</label>
                                    <textarea name="meta_des[<?php echo e($item->name); ?>]"
                                        class="form-control "><?php echo e(isset($current->meta_description) ? $current->meta_description :''); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Meta - Keywords</label>
                                    <textarea name="meta_key[<?php echo e($item->name); ?>]"
                                        class="form-control "><?php echo e(isset($current->meta_keywords) ? $current->meta_keywords :''); ?></textarea>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="example-text-input">Date Start</label>
                                <input type="text" class="js-datepicker form-control" id="example-datepicker1"
                                    name="date_start" data-week-start="1" data-autoclose="true" data-today-highlight="true"
                                    data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" value="<?php echo e($contents[0]->date_publish); ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="example-text-input">Date End</label>
                                <input type="text" class="js-datepicker form-control" id="example-datepicker1"
                                    name="date_end" data-week-start="1" data-autoclose="true" data-today-highlight="true"
                                    data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" value="<?php echo e($contents[0]->date_end); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Time Start</label>
                                <input id="timeStart" class="form-control" value="<?php echo e($contents[0]->time_start); ?>" name="time_start" />
                            </div>
                            <div class="col-md-6">
                                <label for="">Time End</label>
                                <input id="timeEnd" class="form-control"  value="<?php echo e($contents[0]->time_end); ?>"  name="time_end" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="d-block">Event Status</label>
                        <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                            <input type="radio" class="custom-control-input" id="status-line-1"
                                name="status" value="1"  <?php echo e(($contents[0]->status == 1) ?"checked":""); ?>>
                            <label class="custom-control-label" for="status-line-1">Show</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                            <input type="radio" class="custom-control-input" id="status-line-2"
                                name="status" value="0" <?php echo e(($contents[0]->status == 0 ) ?"checked":""); ?>>
                            <label class="custom-control-label" for="status-line-2">Hide</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="example-text-input">Image-thumbnail</label>
                        <div id="imagePreview">
                            <img src="<?php echo e(asset('/uploads_delta/'.$contents[0]->thumb)); ?>" class="img-thumbnail imagePreview"
                                alt="">
                                <input type="hidden" name="oldfilethumb" value="<?php echo e($contents[0]->thumb); ?>" >
                        </div><br>
                        <div class="custom-file w-50">
                            <input type="file"
                                class="custom-file-input"
                                data-toggle="custom-file-input" id="image" name="thumb">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success text-uppercase col-2  mb-4">Update
                        </button>
                        <a href="<?php echo e(route('event.index')); ?>" class="btn btn-secondary text-uppercase col-2  mb-4">Cancel 
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

<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<script src="<?php echo e(asset('backend-asset/js/plugins/summernote/summernote-bs4.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend-asset/js/plugins/simplemde/simplemde.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend-asset/js/plugins/ckeditor/ckeditor.js')); ?>"></script>
<script src="<?php echo e(asset('backend-asset/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')); ?>"></script>
<script>
     $('#eventExcerpt').summernote({
        tabsize: 2,
        height: 200
    });
    jQuery(function () {
        Dashmix.helpers(['datepicker', 'summernote']);
    });
   

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
            alert('Fisierul selectat nu este acceptat!');
        }

    };

    $(document).on('change', '#image', function () {
        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert("File size exceeds 2 MB!");
            this.value = "";
            $('#label2').text('Choose file');
        }else{
            previewImage(this, $('.imagePreview'));
        }

});

    $('#timeStart').timepicker({
        uiLibrary: 'bootstrap4'
    });
    $('#timeEnd').timepicker({
            uiLibrary: 'bootstrap4'
    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Deltapsu_Production\dependencies\resources\views\event\edit.blade.php ENDPATH**/ ?>