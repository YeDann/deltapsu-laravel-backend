<?php $__env->startSection('css'); ?>
  <style>
        .old-image-edit{
               width:100% ;
        }
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<main id="main-container">
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Image</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('application-view.index')); ?>">Back</a></li>
                        <li class="breadcrumb-item">All Image appp</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->
    
      
    <div class="content">
        <?php if(Session::has('flash_message')): ?>
        <div class="alert alert-success alert-dismissable" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <p class="mb-0"> <?php echo Session('flash_message'); ?></p>
        </div>
        <?php endif; ?>
        
                      <!-- Dropzone (functionality is auto initialized by the plugin itself in js/plugins/dropzone/dropzone.min.js) -->
                    <!-- For more info and examples you can check out http://www.dropzonejs.com/#usage -->
                    <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Dropzone</h3>
                            <button onclick="funreload();" class="btn">
                                Reload DropZone
                            </button>
                        </div>
                        <div class="block-content block-content-full">
                            <h2 class="content-heading">Asynchronous File Uploads</h2>
                            <div class="row">
                                <div class="col-lg-4">
                                    <p class="text-muted">
                                        Drag and drop sections for your file uploads
                                    </p>
                                    <p style="color:red"> *accept file type .png .jpeg<p>
                                            <p style="color:red">  *max file 2 MB<p>
                                </div>
                                <div class="col-lg-8 col-xl-5">
                                    <!-- DropzoneJS Container -->
                                <form class="dropzone" id="my-awesome-dropzone"  method="post" enctype="multipart/form-data">
                                    <?php echo e(csrf_field()); ?>

                                    <input type="hidden" name="typeId" id="typeId" value="<?php echo e($appid); ?>">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Dropzone -->

        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">All image</h3>  

            </div>
            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 80px;">#</th>
                            <th>Image</th>
                            <th style="width:40%;">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $i = 1 ?>
                        <?php $__currentLoopData = $image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($i); ?></td>
                            <td class="font-w600">
                              <img src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($data->image_name); ?>" width="120px;">
                            </td>
                                <td>
                                <button type="button" class="btn btn-hero-danger" onclick="deleteItem(<?php echo e($data->id); ?>);"
                                    data-toggle="modal" data-target="#modal-block-vcenter"><i
                                        class="far fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        <?php  $i++?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>


<!-- Vertically Centered Block Modal -->
<div class="modal" id="modal-block-vcenter" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-warnning">
                    <h3 class="block-title">Warning</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="<?php echo e(route('deleteImage')); ?>" method="POST">
                    <?php echo e(csrf_field()); ?>

                    <div class="block-content">
                        <input type="hidden" name="itemId" id="itemId" >
                        <input type="hidden" name="appid" id="appid" value="<?php echo e($appid); ?>">
                        <p>Are you sure you want to delete this item?</p>
                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <button type="summit" class="btn btn-success">Yes</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal">No</button>

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
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("#my-awesome-dropzone", { 
            url: "<?php echo e(route('uploadImagemultiple')); ?>"}
            );
            myDropzone.on('success', function(file, response) {
                console.log(file);
         });

         function funreload(){
             location.reload();
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
        $(document).on('change', '#Image0', function () {
            previewImage(this, $('.imagePreview0'));
        });
    
      
    
    </script>
    <script>
        function deleteItem(id) {
            $('#itemId').val(id);
        } 

        
    
    </script>

<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Deltapsu_Production/dependencies/resources/views/application/imageapp.blade.php ENDPATH**/ ?>