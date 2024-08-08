


<?php
    $user = Auth::user();
?>

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
<?php $component = App\View\Components\UserRoutePageName::resolve(['routeName' => 'student.dashboard'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
        <div class="container mx-auto p-4 relative">
            <!-- Heading -->
            <div class="rounded-md p-3 sm:p-4 md:p-6 lg:p-2 w-full h-18 sm:h-20 md:h-28 lg:h-24 lg:pt-4 mb-4 truncate"
                style="background: linear-gradient(to right, #3b82f6, #1e40af);">
                <div class="flex justify-between">
                    <span class="text-lg truncate sm:text-sm md:text-2xl lg:text-3xl lg:ml-3 font-bold">
                        <?php echo e($manageCourse->course->course_code); ?> - <?php echo e($manageCourse->course->course_name); ?>

                    </span>
                    <span class="mr-5 text-lg sm:text-sm md:text-2xl lg:text-xl lg:ml-3 font-bold relative">
                        <i id="settingsIcon" class="fa-solid fa-cog cursor-pointer"></i>
                    </span>
                </div>
                <span class="text-sm sm:text-md md:text-lg lg:text-xl lg:ml-3">
                    <?php echo e($manageCourse->section); ?> | <?php echo e(date('g:i A', strtotime($manageCourse->class_start_time))); ?> -
                    <?php echo e(date('g:i A', strtotime($manageCourse->class_end_time))); ?> <?php echo e($manageCourse->days_of_the_week); ?>

                </span>
            </div>

            <!-- Floating Menu -->
            <div id="floatingMenu1"
                class="fixed right-10 top-[160px] transform -translate-y-1/2 bg-white shadow-lg rounded-md p-5 sm:p-6 md:p-7 lg:p-3 border-2 text-black font-medium opacity-0 pointer-events-none transition-all duration-500">
                <form
                    action="<?php echo e(route('student.unenroll', ['userID' => auth()->user()->id, 'assignmentTableID' => $manageCourse->id, 'courseID' => $manageCourse->course_id])); ?>"
                    method="post">
                    <?php echo csrf_field(); ?>
                    <button class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-200 cursor-pointer">
                        <i class="fa-solid fa-file"></i> Unenroll
                    </button>
                </form>
            </div>

            <!-- Practice Problem Section -->
            <div class="container mx-auto p-4 uppercase -mb-8">
                <p class="mb-2 xl:text-3xl text-black font-bold">Practice Problem</p>
                <div class="border-t border-gray-600"></div>
            </div>


            <!-- Alerts -->
            <?php if(session('success')): ?>
                <?php if (isset($component)) { $__componentOriginal54e362747f6a5fcdcf7fd32363698818 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal54e362747f6a5fcdcf7fd32363698818 = $attributes; } ?>
<?php $component = App\View\Components\Sweetalert::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sweetalert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Sweetalert::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'success','message' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('success'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal54e362747f6a5fcdcf7fd32363698818)): ?>
<?php $attributes = $__attributesOriginal54e362747f6a5fcdcf7fd32363698818; ?>
<?php unset($__attributesOriginal54e362747f6a5fcdcf7fd32363698818); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal54e362747f6a5fcdcf7fd32363698818)): ?>
<?php $component = $__componentOriginal54e362747f6a5fcdcf7fd32363698818; ?>
<?php unset($__componentOriginal54e362747f6a5fcdcf7fd32363698818); ?>
<?php endif; ?>
            <?php endif; ?>
            <?php if(session('info')): ?>
                <?php if (isset($component)) { $__componentOriginal54e362747f6a5fcdcf7fd32363698818 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal54e362747f6a5fcdcf7fd32363698818 = $attributes; } ?>
<?php $component = App\View\Components\Sweetalert::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sweetalert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Sweetalert::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'info','message' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('info'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal54e362747f6a5fcdcf7fd32363698818)): ?>
<?php $attributes = $__attributesOriginal54e362747f6a5fcdcf7fd32363698818; ?>
<?php unset($__attributesOriginal54e362747f6a5fcdcf7fd32363698818); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal54e362747f6a5fcdcf7fd32363698818)): ?>
<?php $component = $__componentOriginal54e362747f6a5fcdcf7fd32363698818; ?>
<?php unset($__componentOriginal54e362747f6a5fcdcf7fd32363698818); ?>
<?php endif; ?>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <?php if (isset($component)) { $__componentOriginal54e362747f6a5fcdcf7fd32363698818 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal54e362747f6a5fcdcf7fd32363698818 = $attributes; } ?>
<?php $component = App\View\Components\Sweetalert::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sweetalert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Sweetalert::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'error','message' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('error'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal54e362747f6a5fcdcf7fd32363698818)): ?>
<?php $attributes = $__attributesOriginal54e362747f6a5fcdcf7fd32363698818; ?>
<?php unset($__attributesOriginal54e362747f6a5fcdcf7fd32363698818); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal54e362747f6a5fcdcf7fd32363698818)): ?>
<?php $component = $__componentOriginal54e362747f6a5fcdcf7fd32363698818; ?>
<?php unset($__componentOriginal54e362747f6a5fcdcf7fd32363698818); ?>
<?php endif; ?>
            <?php endif; ?>

            <!-- Cards Container -->

            <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1 gap-4 mt-2">
                <!-- Repeat this card for each class -->
                <?php $__currentLoopData = $subClasswork; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $subClassworks): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $solution = \App\Models\Solution::where('sub_classwork_id', $subClassworks->id)->first();
                        $files = \App\Models\CourseClassworkFiles::where(
                            'sub_classwork_id',
                            $subClassworks->id,
                        )->first();
                        $submitted = \App\Models\StudentClasswork::where('sub_classwork_id', $subClassworks->id)
                            ->where('student_id', Auth::id())
                            ->first();
                    ?>
                    <div class="p-4">

                        <div class="bg-white rounded-lg shadow-lg p-6 h-full">
                            <?php if(!$submitted): ?>
                                <div id="countdown<?php echo e($subClassworks->id); ?>"
                                    class="text-lg font-semibold text-red-500 dark:text-red-400 mb-4"
                                    x-data="{ timer: 3600, interval: null, expired: false }" x-init="interval = setInterval(() => {
                                        if (timer > 0) {
                                            timer--;
                                            let hours = Math.floor(timer / 3600);
                                            let minutes = Math.floor((timer % 3600) / 60);
                                            let seconds = Math.floor(timer % 60);
                                            document.getElementById('countdown<?php echo e($subClassworks->id); ?>').innerHTML = hours + 'h ' + minutes + 'm ' + seconds + 's ';
                                        } else {
                                            clearInterval(interval);
                                            expired = true;
                                            document.getElementById('countdown<?php echo e($subClassworks->id); ?>').innerHTML = 'Time\'s up!';
                                            document.getElementById('submit<?php echo e($subClassworks->id); ?>').disabled = true;
                                            document.getElementById('autoSubmitForm').submit();
                                        }
                                    }, 1000);">
                                </div>
                            <?php endif; ?>
                            <form id="autoSubmitForm" action="<?php echo e(route('student.student.postAnswer', ['userID' => auth()->user()->id, 'assignmentTableID' => $manageCourse->id, 'courseID' => $manageCourse->course_id, 'classwork_id' => $subClassworks->classwork_id, 'subClassworkID' => $subClassworks->id])); ?> " method="post"><?php echo csrf_field(); ?></form>


                            <div class="flex items-center mb-2">
                                <h3 class="text-lg font-semibold text-gray-800"><?php echo e($index + 1); ?>.</h3>
                            </div>
                            <div class="p-2 rounded h-auto text-lg bg-white overflow-y-auto text-black">
                                <?php echo $subClassworks->content; ?>

                            </div>
                            <li class="mb-2 flex items-center border rounded p-2">
                                <img src="<?php echo e(route('thumbnails.show', ['filename' => $files->classwork_file . '.jpg'])); ?>"
                                    alt="<?php echo e($files->classwork_file); ?>" class="w-16 h-16 object-cover mr-3">
                                <div x-cloak x-data="{ showModal1: false, contentId: <?php echo e($subClassworks->classwork_id); ?> }">
                                    <a @click="showModal1 = true"
                                        class="text-blue-500 hover:underline"><?php echo e($files->classwork_file); ?></a>
                                    <div class="text-gray-500 text-sm">
                                        <?php echo e(strtoupper(pathinfo($files->classwork_file, PATHINFO_EXTENSION))); ?>

                                    </div>
                                    <div x-show="showModal1" x-cloak
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 transform scale-95"
                                        x-transition:enter-end="opacity-100 transform scale-100"
                                        x-transition:leave="transition ease-in duration-200"
                                        x-transition:leave-start="opacity-100 transform scale-100"
                                        x-transition:leave-end="opacity-0 transform scale-95"
                                        @click.away="showModal1 = false"
                                        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                        <iframe frameborder="0"
                                            src="<?php echo e(route('student.classroom.files.show', ['id' => $files->id])); ?>#toolbar=0&scrollbar=10&view=FitH"
                                            width="600" height="800" style="overflow: auto;"></iframe>
                                        <div class="fixed top-0 right-0 m-4">
                                            <button class="close-btn flex items-center justify-center rounded-full"
                                                @click="showModal1 = false">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <?php if($submitted): ?>
                                <div class="mt-4">
                                    <p class="text-gray-600 font-semibold">Submitted Files:</p>

                                    <div class="flex items-center mt-2">
                                        <a class="text-blue-500 hover:underline"><?php echo e($submitted->class_files); ?></a>
                                    </div>
                                </div>
                                <div class="mt-4 p-4 bg-gray-100 rounded-lg">
                                    <div class="mt-4 p-4 bg-green-100 rounded-lg">
                                        <h3 class="text-lg font-semibold text-black">
                                            Solution</h3>
                                        <li class="mb-2 flex items-center border rounded p-2">
                                            <img src="<?php echo e(route('thumbnails.show', ['filename' => $files->classwork_file . '.jpg'])); ?>"
                                                alt="<?php echo e($files->classwork_file); ?>" class="w-16 h-16 object-cover mr-3">
                                            <div x-cloak x-data="{ showModal2: false, contentId: <?php echo e($subClassworks->classwork_id); ?> }">
                                                <a @click="showModal2 = true"
                                                    class="text-blue-500 hover:underline"><?php echo e($files->classwork_file); ?></a>
                                                <div class="text-gray-500 text-sm">
                                                    <?php echo e(strtoupper(pathinfo($files->classwork_file, PATHINFO_EXTENSION))); ?>

                                                </div>
                                                <div x-show="showModal2" x-cloak
                                                    x-transition:enter="transition ease-out duration-300"
                                                    x-transition:enter-start="opacity-0 transform scale-95"
                                                    x-transition:enter-end="opacity-100 transform scale-100"
                                                    x-transition:leave="transition ease-in duration-200"
                                                    x-transition:leave-start="opacity-100 transform scale-100"
                                                    x-transition:leave-end="opacity-0 transform scale-95"
                                                    @click.away="showModal1 = false"
                                                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                                    <iframe frameborder="0"
                                                        src="<?php echo e(route('student.solutions.show', $solution->id)); ?>#toolbar=0&scrollbar=10&view=FitH"
                                                        width="800" height="800" style="overflow: auto;"></iframe>
                                                    <div class="fixed top-0 right-0 m-4">
                                                        <button
                                                            class="close-btn flex items-center justify-center rounded-full"
                                                            @click="showModal2 = false">
                                                            <svg class="w-6 h-6 text-white" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <form
                                action="<?php echo e(route('student.student.postAnswer', ['userID' => auth()->user()->id, 'assignmentTableID' => $manageCourse->id, 'courseID' => $manageCourse->course_id, 'classwork_id' => $subClassworks->classwork_id, 'subClassworkID' => $subClassworks->id])); ?>"
                                method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="flex justify-between items-center mb-4">
                                    <input id="files" type="file" name="files[]"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 file:disabled:opacity-50 file:disabled:pointer-events-none dark:text-neutral-500 dark:file:bg-blue-500 dark:hover:file:bg-blue-400 file:before:content-['Add_or_Create']"
                                        multiple onchange="displaySelectedFiles(this)"
                                        <?php echo e($submitted ? 'disabled' : ''); ?> required>
                                </div>
                                <button id="submit<?php echo e($subClassworks->id); ?>" type="submit"
                                    class="px-4 py-2 bg-green-300 text-black rounded-md w-full <?php echo e($submitted ? 'bg-gray-300' : ''); ?>"
                                    <?php echo e($submitted ? 'disabled' : ''); ?>>
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <!-- End of Cards Container -->
        </div>
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

<x-show-hide-sidebar
<?php /**PATH C:\Users\Joshua Tabura\Desktop\computer-aided-model-system-for-student\resources\views/student/classwork/index.blade.php ENDPATH**/ ?>