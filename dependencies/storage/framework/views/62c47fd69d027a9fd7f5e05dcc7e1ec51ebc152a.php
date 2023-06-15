<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Application View</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Application View</li>
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
            <h3 class="block-title"></h3>
            <div class="block-options">
                <div class="block-options-item">
                    
                </div>
                <div class="block-options-item">
                    <a href="<?php echo e(route('application-view.create')); ?>" class="btn btn-success">Create </a>
                </div>
            </div>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">Order.</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Name</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Create At</th>
                        <th style="width: 20%;" class="text-center">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($contents) and !empty($contents)): ?>
                    <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="odd order-list" data-id="<?php echo e($item->applica_id); ?>">
                    <td class="text-center"><?php echo e($loop->iteration); ?></td>
                    <td class="d-none d-sm-table-cell"><?php echo e($item->name); ?></td>
                    <td class="font-w600"><?php echo e($item->created_at); ?></td>
                    <td class="text-center">
                        <div class="">
                            
                                <a href="<?php echo e(route('relateApplication',$item->app_id)); ?>" class="btn btn-outline-info btn-sm">Related Series </a>
                                
                                <a href="<?php echo e(route('addMoreImage',$item->app_id)); ?>" class="btn btn-outline-info btn-sm">Image Content</a>
                                <a href="<?php echo e(route('application-view.edit',$item->app_id)); ?>" class="btn btn-primary btn-sm">Edit </a>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" id="delbutton"
                                title="Delete" onclick="deleteIndex(<?php echo e($item->app_id); ?>)">
                                Delete
                            </button>
                        </div>
                    </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!--Modal Language Multi-->
<div class="modal fade" id="modal-block-popin" tabindex="-1" role="dialog" aria-labelledby="modal-block-popin"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Select language</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="<?php echo e(route('copyApp')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    <div class="block-content">
                        <div class="block-options-item form-group">
                            <label for="">Select language</label>
                            <select name="language" id="" class="form-control">
                                <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->name); ?>"><?php echo e($item->abbreviation); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <button type="button" class="btn  btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn  btn-primary">Duplicate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Modal Language-->

<!--Modal Language Single-->
<div class="modal fade" id="modal-block-popin-2" tabindex="-1" role="dialog" aria-labelledby="modal-block-popin"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Select language</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="<?php echo e(route('copyAppsingle')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    <div class="block-content">
                        <div class="block-options-item form-group">
                            <label for="">Select language</label>
                            <select name="language" id="" class="form-control">
                                <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->name); ?>"><?php echo e($item->abbreviation); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <input type="hidden" name="appId" id="appId" value="" >
                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <button type="button" class="btn  btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn  btn-primary">Duplicate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Modal Language-->
    <div id="order-input" style="display: none;"></div>
    <div id="order-index" style="display: none;"></div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    function deleteIndex(id) {
        swal({
            title: "Confirm Delete",
            text: "You Are Delete this Data?",
            icon: "warning",
            buttons: [
                'Cancel',
                'Delete'
            ],
            dangerMode: true,
        }).then(function (isConfirm) {
            if (isConfirm) {
                swal({
                    title: 'Shortlisted!',
                    text: 'Are your sure deleted?!',
                    icon: 'success'
                }).then(function () {
                    window.location = "<?php echo e((route('destroyApp'))); ?>/" + id;
                });
            }
        });
    }


    function sendId(id){
        $("#appId").val(id)
    }

</script>
<script>
    $( function() {
      $( "#sortable" ).sortable();
      $( "#sortable" ).disableSelection();
    } );

    var orderdata;
    $('tbody').sortable({

        stop: function (event, ui) {
            $('.order-list').each(function (index) {
                var term = $(this).data('id');
                $("#order-index").append(parseInt(index) + 1 + ",");
                $("#order-input").append(term + ",");
            });
            var formData = {
                'home_id': $("#order-input").html(),
                'home_order': $("#order-index").html()
            };
            $.ajax({
                url: "<?php echo e(route('update_order_application')); ?>",
                type: 'post',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    location.reload();
                }
            })
        }
    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Deltapsu_Production/dependencies/resources/views/application/index.blade.php ENDPATH**/ ?>