
<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Order Series</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('subCategories')); ?>">All Product Categories</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('series_index' ,$pro_cate_id)); ?>">All Series By Categories</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Order </li>
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

                </div>
            </div>
        </div>
       
        <div class="block-content block-content-full">
                <p class="warrning-text">*Can draggable order Item </p>
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">Order.</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Name</th>
                      
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($series) and !empty($series)): ?>
                    <?php $__currentLoopData = $series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="odd order-list" data-id="<?php echo e($item->se_id); ?>">
                    <td class="text-center"><?php echo e($loop->iteration); ?></td>
                    <td class="d-none d-sm-table-cell"><?php echo e($item->title); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="order-input" style="display: none;"></div>
<div id="order-index" style="display: none;"></div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
                    url: "<?php echo e(route('update_order_Series')); ?>",
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/deltaPSU/dependencies/resources/views/pro_categories/orderSeries.blade.php ENDPATH**/ ?>