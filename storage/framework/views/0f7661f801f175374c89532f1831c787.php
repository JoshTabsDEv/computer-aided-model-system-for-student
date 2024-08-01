<?php if (isset($component)) { $__componentOriginalcc67118e210132cf50b1c183d70505e3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcc67118e210132cf50b1c183d70505e3 = $attributes; } ?>
<?php $component = App\View\Components\StudentAppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('student-app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\StudentAppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php if (isset($component)) { $__componentOriginal8a863ae962bbf3c4907cbf5446e54179 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8a863ae962bbf3c4907cbf5446e54179 = $attributes; } ?>
<?php $component = App\View\Components\UserRoutePageName::resolve(['routeName' => 'teacher.classwork.index','courseDetails' => [
            'course_name' => $manageCourse->course->course_name,
            'time' => date('g:i A', strtotime($manageCourse->class_start_time)) . ' - ' . date('g:i A', strtotime($manageCourse->class_end_time)),
            'days_of_the_week' => $manageCourse->days_of_the_week,
            'section' => $manageCourse->section,
        ]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('user-route-page-name'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\UserRoutePageName::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8a863ae962bbf3c4907cbf5446e54179)): ?>
<?php $attributes = $__attributesOriginal8a863ae962bbf3c4907cbf5446e54179; ?>
<?php unset($__attributesOriginal8a863ae962bbf3c4907cbf5446e54179); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8a863ae962bbf3c4907cbf5446e54179)): ?>
<?php $component = $__componentOriginal8a863ae962bbf3c4907cbf5446e54179; ?>
<?php unset($__componentOriginal8a863ae962bbf3c4907cbf5446e54179); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginala5bba5a6e530dd54f8ed958a04b808fc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala5bba5a6e530dd54f8ed958a04b808fc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.student.section-div-style','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('student.section-div-style'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
       
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala5bba5a6e530dd54f8ed958a04b808fc)): ?>
<?php $attributes = $__attributesOriginala5bba5a6e530dd54f8ed958a04b808fc; ?>
<?php unset($__attributesOriginala5bba5a6e530dd54f8ed958a04b808fc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala5bba5a6e530dd54f8ed958a04b808fc)): ?>
<?php $component = $__componentOriginala5bba5a6e530dd54f8ed958a04b808fc; ?>
<?php unset($__componentOriginala5bba5a6e530dd54f8ed958a04b808fc); ?>
<?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcc67118e210132cf50b1c183d70505e3)): ?>
<?php $attributes = $__attributesOriginalcc67118e210132cf50b1c183d70505e3; ?>
<?php unset($__attributesOriginalcc67118e210132cf50b1c183d70505e3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcc67118e210132cf50b1c183d70505e3)): ?>
<?php $component = $__componentOriginalcc67118e210132cf50b1c183d70505e3; ?>
<?php unset($__componentOriginalcc67118e210132cf50b1c183d70505e3); ?>
<?php endif; ?>

<?php /**PATH C:\Users\Joshua Tabura\Desktop\computer-aided-model-system-for-student\resources\views\student\classwork\index.blade.php ENDPATH**/ ?>