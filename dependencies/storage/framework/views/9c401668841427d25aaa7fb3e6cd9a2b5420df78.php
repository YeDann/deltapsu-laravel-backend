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
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Feedback Form </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Feedback Form</li>
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
                    <option value="0" <?php echo e(isset($selecValue) &&  $selecValue == 'All' ? 'selected':''); ?> >All</option>
                    <option value="Sale Enquiries" <?php echo e(isset($selecValue) &&  $selecValue == 'Sale Enquiries' ? 'selected':''); ?> >Sale Enquiries</option>
                    <option value="Products and Service Support" <?php echo e(isset($selecValue) &&  $selecValue == 'Products and Service Support' ? 'selected':''); ?>>Products and Service Support</option>
                    <option value="General Comments" <?php echo e(isset($selecValue) &&  $selecValue == 'General Comments' ? 'selected':''); ?> >General Comments</option> 
                </select>
            </div>
            <h3 class="block-title">
            </h3>
            <div class="block-options">
                <div class="block-options-item">
                
                </div>
                <div class="block-options-item">
                  <a href="<?php echo e(route('exportfeedbackFrom',$selecValue)); ?>" class="btn btn-outline-primary">Export Data</a> 
                </div>
            </div>
        </div>
        <div class="block-content block-content-full" >
            <div class="table-responsive">
            <table id="dtBasicExample"  class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">No.</th>
                        <th class="th-sm">Subject</th>
                        <th class="th-sm">Email</th>
                        <th class="th-sm">Name</th>
                        <th class="th-sm">Country</th>
                        <th class="th-sm">Type</th>
                        <th class="th-sm">Model</th>
                        <th class="th-sm">Tel</th>
                        <th class="th-sm">Created_at</th>
                        <th class="th-sm">Config file</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($contactemail) and !empty($contactemail)): ?>
                    <?php $__currentLoopData = $contactemail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td class="text-center"><?php echo e($loop->iteration); ?></td>
                    <td class="d-none d-sm-table-cell"><?php echo e($item->subject); ?></td>
                    <td class="d-none d-sm-table-cell"><?php echo e($item->email); ?></td>
                    <td class="d-none d-sm-table-cell"><?php echo e($item->name); ?></td>
                    <td class="d-none d-sm-table-cell"><?php echo e($item->country); ?></td>
                    <td class="d-none d-sm-table-cell"><?php echo e($item->type_name); ?></td>
                    <td class="d-none d-sm-table-cell"><?php echo e($item->model_name); ?></td>
                    <td class="d-none d-sm-table-cell"><?php echo e($item->tel); ?></td>
                    <td class="d-none d-sm-table-cell"><?php echo e($item->created_at); ?></td>
                    <td class="text-center">
                     <?php if(isset($item->file)): ?>
                    <a href="<?php echo e(config('app.url')); ?>/config_history/<?php echo e($item->file); ?>"   target="_blank" class="btn btn-outline-primary">View</a>
                    <?php else: ?> 
                     No file
                      <?php endif; ?>
                    </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
            </div>
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
                    <form action="<?php echo e(route('deleteConfigProduct')); ?>" method="POST" >
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
            window.location = '<?php echo e(route('feedbackform')); ?>/All';
        }else{
            window.location = '<?php echo e(route('feedbackform')); ?>'+'/'+value;
        }
     
    }

    function ondelelete(id){
         $('#itemId').val(id);

    }

    $(document).ready(function () {
            $('#dtBasicExample').DataTable();
        });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Deltapsu_Production/dependencies/resources/views/feedbackEmail/contactFeebackform.blade.php ENDPATH**/ ?>