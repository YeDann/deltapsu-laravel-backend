
<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Contact us</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Contact us</li>
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

        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No.</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Name</th>
                        <th style="width: 10%;" class="text-center">Type</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td class="d-none d-sm-table-cell">Sell Offices</td>
                        <td class="d-none d-sm-table-cell text-center"><a href="<?php echo e(route('contact-zone.show','sell-office')); ?>"
                                class="btn btn-info col-md-8">Sale Offices <i class="fa fa-chevron-right"></a></td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td class="d-none d-sm-table-cell">Distributors</td>
                        <td class="d-none d-sm-table-cell text-center"><a href="<?php echo e(route('contact-zone.show','distributors')); ?>"
                                class="btn btn-info col-md-8">Distributors <i class="fa fa-chevron-right"></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('js'); ?>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/deltaPSU/dependencies/resources/views/contact-zone/type.blade.php ENDPATH**/ ?>