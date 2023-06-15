<?php $__env->startSection('css'); ?>
<style>

    
    hr{
        border-top: 2px solid #E3EFF8;
    }
    .content img{
        max-width: 100%;
    }
    .content b{
      font-weight: bold;
    }

</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta'); ?>
<title><?php echo e(isset($metatag[0]->meta_title)? $metatag[0]->meta_title :''); ?></title>
<meta name="description" content="<?php echo e(isset($metatag[0]->meta_description)? $metatag[0]->meta_description :''); ?>">
<meta name="keywords" content="<?php echo e(isset($metatag[0]->meta_key) ? $metatag[0]->meta_key :''); ?>">
<meta property="og:title" content="<?php echo e(isset($metatag[0]->meta_title)? $metatag[0]->meta_title :''); ?>" />
<meta property="og:description" content="<?php echo iconv_substr(strip_tags(isset($faqs[0]->title)? $faqs[0]->title:''),0,90,'UTF-8'); ?>" />

<?php $__env->stopSection(); ?>
<?php $__env->startSection('container'); ?>

<div class="padding-top-content">
</div>
<div class="products-index-nav visible-up-922">
    <div class="bg-bredcrumb">
        <div class="container">
            <nav aria-label="breadcrumb" id="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-breadcrumb-home"><a href="<?php echo e(route('index','home')); ?>"><?php echo e($staticContent['Home']); ?></a></li>
                    <li class="breadcrumb-item active text-breadcrumb-home dropdown" aria-current="page"><a
                            href="#" data-toggle="dropdown" id="tools-dropdown"><?php echo e($staticContent['Supports']); ?></a>
                            <ul class="dropdown-menu">
                                <li><a href="#" id="tools-dropdown" class="text-bold"><?php echo e($staticContent['Supports']); ?></a></li>
                                <hr>
                                <li><a href="<?php echo e(route('contactSupport')); ?>"><?php echo e($staticContent['contact_us']); ?></a></li>
                                <li><a href="<?php echo e(route('contactSalesOffices')); ?>"><?php echo e($staticContent['sales_offices']); ?></a></li>
                                <li><a href="<?php echo e(route('contactFindDistributor')); ?>"><?php echo e($staticContent['find_a_distributor']); ?></a></li>
                                <li><a href="<?php echo e(route('index','faqs')); ?>"><?php echo e($staticContent['FAQs']); ?></a></li>
                              </ul>   
                    </li>
                    <li class="breadcrumb-item text-breadcrumb" aria-current="page"><a href="<?php echo e(route('index','faqs')); ?>"><?php echo e($staticContent['FAQs']); ?></a></li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#"> <?php echo e(isset($faqs[0]->title)? $faqs[0]->title:''); ?></a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<section class="box-news  my-5 ">
    <div class="container">
        <div class="box-news-detail">
            <h2 class="text-dark">
                <?php echo e(isset($faqs[0]->title)? $faqs[0]->title:''); ?>

            </h2>
            </div>
            <div class="content">
                <?php if(isset($faqs[0]->content)): ?>
                 <?php echo $faqs[0]->content; ?>

                <?php endif; ?>      
            </div>
             <div class="">
           
             </div>
            
        </div>
    
    </div>
</section>



<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Deltapsu_Production/dependencies/resources/views/front-end/faq-detail.blade.php ENDPATH**/ ?>