
<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Product News</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Product News</li>
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
                
                <a href="<?php echo e(route('newstype.index')); ?>" class="btn btn-info">Product News Type</a>
            </h3>
            <div class="block-options">
                <div class="block-options-item">
                    
                </div>
                <div class="block-options-item">
                    <a href="<?php echo e(route('news.create')); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Create </a>
                    
                   
                </div>
            </div>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No.</th>
                        <th class="d-none d-sm-table-cell" style="width:20%;">Title</th>
                        
                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Status</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Publish</th>
                        <th style="width:15%;" class="text-center">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($contents) and !empty($contents)): ?>
                    <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td class="text-center"><?php echo e($loop->iteration); ?></td>
                    <td class="d-none d-sm-table-cell"><?php echo e($item->title); ?></td>
                    
                    <td class="font-w600 text-center">
                            <?php if($item->status == "1"): ?>
                            <span class="badge badge-success text-uppercase">Show</span>
                            <?php elseif($item->status == "0"): ?>
                            <span class="badge badge-secondary text-uppercase">Hide</span>
                            <?php endif; ?>
                    </td>
                    <td class="font-w600 text-center"><?php echo e($item->date_publish); ?></td>
                    <td class="text-center">
                        <div class="">
                            
                                    <a href="<?php echo e(route('news.edit',$item->id)); ?>" class="btn btn-primary">Edit  </a>
                            <button type="button" class="btn btn-danger" data-toggle="tooltip" id="delbutton"
                                title="Delete" onclick="deleteNews(<?php echo e($item->id); ?>)">
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




<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
    function deleteNews(id) {
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
                    text: 'Candidates are successfully shortlisted!',
                    icon: 'success'
                }).then(function () {
                    window.location = "<?php echo e((route('destroyNews'))); ?>/" + id;
                });
            }
        });
    }


    function sendId(id){
        $("#newsId").val(id)
    }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/deltaPSU/dependencies/resources/views/news/index.blade.php ENDPATH**/ ?>