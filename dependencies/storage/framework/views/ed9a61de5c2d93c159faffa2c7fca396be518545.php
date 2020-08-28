<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Video & Images</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Video & Images</li>
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
                <?php echo e($products[0]->pro_code); ?>

            </h3>
            <div class="block-options">
                <div class="block-options-item">
                
                </div>
                <div class="block-options-item">
                    <button data-toggle="modal" data-target="#modal-block-create_video" class="btn btn-success">Create Video</button>
                    <button data-toggle="modal" data-target="#modal-block-create_Image" class="btn btn-success">Create Image</button>
                </div>
            </div>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No.</th>
                        <th class="d-none d-sm-table-cell" style="width: 20%;">Content</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">create</th>
                        <th style="width: 20%;" class="text-center">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($vieo_img) and !empty($vieo_img)): ?>
                    <?php $__currentLoopData = $vieo_img; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td class="text-center"><?php echo e($loop->iteration); ?></td>
                    <td class="d-none d-sm-table-cell">
                     
                        <?php if($item->type == 1): ?>
                      <img  width="20%" src="<?php echo e(config('app.url')); ?>/uploads_delta/<?php echo e($item->content); ?>">
                        <?php else: ?> 
                        <iframe  src="<?php echo e($item->content); ?>"
                        width="50%" height="200px" frameborder="0" allowfullscreen></iframe>
                        <?php endif; ?>
                    </td>
                    <td class="d-none d-sm-table-cell"><?php echo e($item->created_at); ?></td>
                    <td class="text-center">
                          
                            <button class="btn btn-info" onclick="editContent(<?php echo e($item->id); ?> ,<?php echo e($item->type); ?>)">Edit</button>
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
                    <form action="<?php echo e(route('deleteVideImagePro')); ?>" method="POST" >
                        <?php echo e(csrf_field()); ?>

                      
                    <div class="block-content">
                        <input type="hidden" name="itemId" id="itemId">
                        <input type="hidden" name="pro_id" value="<?php echo e($products[0]->pro_id); ?>" >
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
 <div class="modal" id="modal-block-create_video" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Video </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="<?php echo e(route('SaveVideoPro')); ?>" method="POST" >
                    <?php echo e(csrf_field()); ?>

                  
                <div class="block-content">
                    <div class="form-group">
                        <label for="example-select">Youtube Link <span class="req-fed">*</span></label>
                        <p>Example Link  https://youtu.be/aovZiyKb4NE </p>
                        <p id="text_arr" style="color:red"></p>
                        <input type="text"
                            class="form-control"
                            name="link" value=""  id="linkyoutube" onkeyup="playyourtest()" placeholder="Enter LInk...">
                            <input type="hidden" name="pro_image_id" id="video_id" >
                            <input type="hidden" name="type" value="2" >
                            <input type="hidden" name="pro_id" value="<?php echo e($products[0]->pro_id); ?>" >
                            <input type="hidden" name="newlink" id='linkyourtube' >
                            <div id="oldlink" class="mt-2"> 
                            </div>
                            <iframe id="abc_frame" src=""
                            width="100%" height="315" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <button type="button" class="btn  btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" id="savedata" class="btn btn-success d-none">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Vertically Centered Block Modal -->


    <!-- Vertically Centered Block Modal -->
    <div class="modal" id="modal-block-create_Image" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">Image </h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form action="<?php echo e(route('SaveImagePro')); ?>" method="POST"  enctype="multipart/form-data" >
                        <?php echo e(csrf_field()); ?>

                      
                    <div class="block-content">
                        <div class="form-group">
                            <p style="color:red">Max Size 2 MB ,png ,jpeg</p>
                            <label for="example-select">Image <span class="req-fed">*</span></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input"
                                    data-toggle="custom-file-input" id="thumbnail" name="thumbnail"
                                    value="no image" accept="image/*">
                                <label id="label2" class="custom-file-label" for="thumbnail">Choose
                                    file</label>
                            </div>
                                <input type="hidden" name="oldImage" id="oldImage" >
                                <input type="hidden" name="pro_image_id" id="image_id" >
                                <input type="hidden" name="type" value="1" >
                                <input type="hidden" name="pro_id" value="<?php echo e($products[0]->pro_id); ?>" >
                                
                                <img src="https://via.placeholder.com/200x200.png"
                                class="img-thumbnail imagePreview2" alt="">
                                <div id="old_img"> 
                                </div>
                           
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <button type="button" class="btn  btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
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
    function playyourtest(){
       var link =  $('#linkyoutube').val();
       var regex = RegExp('https://youtu.be/');
        if(regex.test(link) == false){
           $('#text_arr').text('Format Link is incorrect')
        }else{
            $('#text_arr').text('')
           
            var code = link.substring(17);
            var newlink = 'https://www.youtube.com/embed/'+code;
            $('#abc_frame').attr('src', newlink)
            $('#linkyourtube').val(newlink);
            $('#savedata').removeClass('d-none');
        }
     
    }
    function editContent(id , type){
        $.ajax({
           url: "<?php echo e(route('getProImageContent')); ?>",
           data: {
          'content_id': id,
           },
           type: 'POST',
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (res) {
              
            if(type == 1){
            $('#modal-block-create_Image').modal('show')
            $('#image_id').val(res.data['id']);
            $('#oldImage').val(res.data['content']);
            $('#old_img').html( '<div>Old Image</div><br>'+'<img class="w-50" src="<?php echo e(config('app.url')); ?>/uploads_delta/'+res.data['content']+'" >');
            }else{
            $('#modal-block-create_video').modal('show');
            $('#video_id').val(res.data['id']);
        
            $('#abc_frame').attr('src', res.data['content'])
            $('#oldlink').text('Old Video');
            }
           },
           });
      
    }

    function ondelelete(id){
         $('#itemId').val(id);

    }
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
            return false;
        } else {
            alert('File is not expept!');
            return true;
        }

    };
    $(document).on('change', '#thumbnail', function () {
        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert("File size exceeds 2 MB!");
            this.value = "";
            $('#label2').text('Choose file');
        } else {
            previewImage(this, $('.imagePreview2'));
        }

    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Deltapsu_Production\dependencies\resources\views\product\video_image_pro.blade.php ENDPATH**/ ?>