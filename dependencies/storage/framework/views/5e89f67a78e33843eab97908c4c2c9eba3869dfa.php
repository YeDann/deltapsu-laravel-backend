<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('container'); ?>

<?php 
      function getDateformat($date){
                                       
                                       $eng_month_arr = array(
                                           "0" => "",
                                           "1" => "Jan",
                                           "2" => "Feb",
                                           "3" => "Mar",
                                           "4" => "Apr",
                                           "5" => "May",
                                           "6" => "Jun",
                                           "7" => "Jul",
                                           "8" => "Aug",
                                           "9" => "Sep",
                                           "10" => "Oct",
                                           "11" => "Nov",
                                           "12" => "Dec"
                                       );
                                       $publicDate = date_create($date);
                                       $pDate = explode("-", $publicDate->format('Y-n-d'));
                                       $datearray = [
                                           'm' =>  $eng_month_arr[$pDate[1]],
                                           'd'=>  $pDate[2],
                                           'y' => $pDate[0]

                                       ];
                                       return  $datearray;
         }

?>

<?php
 $date = getDateformat(isset($events[0]->date_publish) ?$events[0]->date_publish :'00:00:00' );
 $endDate = getDateformat(isset($events[0]->date_end) ?$events[0]->date_end:'00:00:00' );
?>
<div class="" style="margin-top: 90px;">

</div>
<?php echo e($date['m'].' '.$date['d'] .''.(isset($endDate['d'])?' - '.$endDate['d']:'').' '.$date['y']); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Deltapsu_Production\dependencies\resources\views\front-end\test.blade.php ENDPATH**/ ?>