
<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Product Launch Schedule</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('pro_lauch')); ?>">All Product Launch Schedule</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Product Launch Schedule</li>
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
            </h3>
            <div class="block-options">
                <div class="block-options-item">
                
                </div>
                <div class="block-options-item">

                    <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#modal-block-create">create</button>
      
                </div>
            </div>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No.</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Month/Date</th>
                        <th style="width: 20%;" class="text-center">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($pro_launch_sche_mo) and !empty($pro_launch_sche_mo)): ?>
                    <?php $__currentLoopData = $pro_launch_sche_mo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td class="text-center"><?php echo e($loop->iteration); ?></td>
                    <td class="d-none d-sm-table-cell"><?php echo e($item->month); ?></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-info" onclick="onedit(<?php echo e($item->pl_m_id); ?>);">Edit</button>
                        <a href="<?php echo e(route('launch_datail',$item->pl_m_id)); ?>" class="btn btn-outline-info">Product Launch Deatail</a>
                        <button type="button" class="btn btn-danger" onclick="ondelelete(<?php echo e($item->pl_m_id); ?>);" data-toggle="modal" data-target="#modal-block-vcenter">Delete</button>
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
                    <form action="<?php echo e(route('scheduleDelete')); ?>" method="POST" >
                        <?php echo e(csrf_field()); ?>

                    <div class="block-content">
                        <input type="hidden" name="pl_fk_id" id="pl_fk_id" value="<?php echo e($headId); ?>">
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

     <!-- Vertically Centered Block Modal -->
 <div class="modal" id="modal-block-create" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Information </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="<?php echo e(route('store_schedule')); ?>" method="POST" >
                    <?php echo e(csrf_field()); ?>

                <div class="block-content">
                <input type="hidden" name="pl_fk_id" id="pl_fk_id" value="<?php echo e($headId); ?>">
                    <label for="example-text-input"><span class="req-fed">*</span>Month / Date</label>
                    <input type="text" class="js-datepicker form-control <?php echo e($errors->has('date') ? 'is-invalid' : ''); ?>"  data-week-start="1" data-autoclose="true"
                        data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" name="date" required>
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
     <div class="modal" id="modal-block-edit" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">Information </h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form action="<?php echo e(route('scheduleUpdate')); ?>" method="POST" >
                        <?php echo e(csrf_field()); ?>

                    <div class="block-content">
                    <input type="hidden" name="pl_fk_id" id="pl_fk_id" value="<?php echo e($headId); ?>">
                    <input type="hidden" name="pl_m_id" id="pl_m_id" value="">
                        <label for="example-text-input"><span class="req-fed">*</span>Month / Date</label>
                        <input type="text" id="data_date" class="js-datepicker form-control <?php echo e($errors->has('date') ? 'is-invalid' : ''); ?>"  data-week-start="1" data-autoclose="true"
                            data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" name="date" required>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
    function ondelelete(id){
         $('#itemId').val(id);

    }
    function onedit(id){
        $.ajax({
            url: "<?php echo e((route('edit_schedule'))); ?>/" + id,
            type: 'get',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
              console.log(data.data.month);
              $('#data_date').val(data.data.month);
              $('#pl_m_id').val(data.data.pl_m_id);
              $('#modal-block-edit').modal('show');
            }

        });
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/deltaPSU/dependencies/resources/views/partners/schedule.blade.php ENDPATH**/ ?>