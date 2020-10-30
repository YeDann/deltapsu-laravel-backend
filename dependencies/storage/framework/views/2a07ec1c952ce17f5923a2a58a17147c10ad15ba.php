<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Parallel Connection(s) </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="<?php echo e(route('configurableProduct')); ?>">Configurable Power</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Parallel Connection(s)</li>
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
                    <button type="button" class="btn btn-success"  onclick="createData();" data-toggle="modal" data-target="#modal-block-create_code">Create</button>
                </div>
            </div>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th class="d-none d-sm-table-cell" style="width: 20%;">Code</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Slot</th>
                        
                        <th style="width: 20%;" class="text-center">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $Parallels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                       <td class="text-center"><?php echo e($item->code); ?></td>
                        <td class="text-center"><?php echo e($item->slot_using); ?></td>
                        
                        <td class="text-center">
                            <button type="button" class="btn btn-danger" onclick="ondelelete(<?php echo e($item->id); ?>);" data-toggle="modal" data-target="#modal-block-vcenter">Delete</button>
                            <button type="button" class="btn btn-primary" onclick="edit(<?php echo e($item->id); ?>);" data-toggle="modal" data-target="#modal-block-create_code">Edit</button>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  
                </tbody>
            </table>
        </div>
    </div>
</div>
 <!-- Vertically Centered Block Modal -->
 <div class="modal" id="modal-block-create_code" tabindex="-1" role="dialog" aria-labelledby="modal-block-create_code" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">New Parallel</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-12 p-4">
                        <form id="f_data_slot" action="<?php echo e(route('storeParallel')); ?>" method="POST" >
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="itemId_edit" id="itemId_edit">
                            <input type="hidden"  name="max_slot" value="<?php echo e($cproducts->max_slot); ?>"  >
                            <input type="hidden"  name="model_id" value="<?php echo e($cproducts->id); ?>"  >
                        
                            <div class="form-group">
                                <label for="example-select">Code</label>
                                <input id="code_s"type="text" class="form-control"  name="code" placeholder="" >
                            </div>
                            <div class="form-group">
                                <label for="example-select">Slot Using</label>
                             <?php 
                             $maxslot = $cproducts->max_slot;
                             for($i = 1 ; $i <= $maxslot;$i++ ) {
                                 echo '<div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                    <input type="checkbox" class="custom-control-input" id="status-'.$i.'" name="use_slot[]" value="'.$i.'"  >
                                    <label class="custom-control-label" for="status-'.$i.'">'.$i.'</label>
                                </div>';
                             }
                              ?>
                            </div>
                            <div class="form-group d-none">
                                <label for="example-select">Condition Can Parallel Connection </label>
                                <input id="con_s" type="text" class="form-control"
                                    name="condition" placeholder="" >
                            </div>
                            <button class="btn btn-success" type="submit">
                                Save
                            </button>
                        </form>
                    </div>
                 
                </div>
            </div>
        </div>
    </div>
    <!-- END Vertically Centered Block Modal -->
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
                    <form action="<?php echo e(route('deleteParalle')); ?>" method="POST" >
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" 
                        name="model_id" value="<?php echo e($cproducts->id); ?>"  >
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

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>

   function createData(){
       $('.block-title').text('Create Parallel Connection(s)');
       document.getElementById("f_data_slot").reset();
       $('#itemId_edit').val(0);
   }
    function ondelelete(id){
         $('#itemId').val(id);
    }
    function edit(id){
        document.getElementById("f_data_slot").reset();
        $.ajax({
					url: "<?php echo e(route('editParallel')); ?>",
					data: {'id': id},
					type: 'POST',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					success: function(data){
                     var parr =  data.data;
                    //  console.log(parr);
                     $('#con_s').val(parr[0]['condition_slot']);
                     $('#code_s').val(parr[0]['code']);
                     $('.block-title').text('Edit Parallel Connection(s)');
                     $('#itemId_edit').val(id);
                     var slot_using = parr[0]['slot_using'].split(',');
                     $.each(slot_using,function(index,value){
                        $('#status-'+value).prop("checked", true );
                     });

					},
					error: function(data){
						console.log(data);
						}
			});
        
    }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Deltapsu_Production\dependencies\resources\views/configurableProduct/parallelCon.blade.php ENDPATH**/ ?>