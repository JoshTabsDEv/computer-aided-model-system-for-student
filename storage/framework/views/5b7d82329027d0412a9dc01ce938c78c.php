<?php if (isset($component)) { $__componentOriginalbf020ec425b6d0b9fddc69f3baf70e3e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbf020ec425b6d0b9fddc69f3baf70e3e = $attributes; } ?>
<?php $component = App\View\Components\TeacherAppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('teacher-app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\TeacherAppLayout::ignoredParameterNames()); ?>
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
    <?php if (isset($component)) { $__componentOriginal7fdc4497c56b05cf19ce7214a31530f3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7fdc4497c56b05cf19ce7214a31530f3 = $attributes; } ?>
<?php $component = App\View\Components\Teacher\sectionDivStyle::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('teacher.section-div-style'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Teacher\sectionDivStyle::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
        <div class="container ml-1.5 sm:mx-auto p-4 relative">
            <div class="rounded-md p-3 sm:p-4 md:p-6 lg:p-2 w-full h-18 sm:h-20 md:h-28 lg:h-24 lg:pt-4  mb-4 truncate" style="background: linear-gradient(to right, #3b82f6, #1e40af);">
                <div class="flex justify-between">
                    <span class="text-lg truncate sm:text-sm md:text-2xl lg:text-3xl lg:ml-3 font-bold">
                        <?php echo e($manageCourse->course->course_code); ?> - <?php echo e($manageCourse->course->course_name); ?>

                    </span>
                    <span class="mr-5 text-lg sm:text-sm md:text-2xl lg:text-xl lg:ml-3 font-bold relative">
                        <i id="settingsIcon" class="fa-solid fa-cog cursor-pointer"></i>
                    </span>
                </div>
                <span class="text-sm sm:text-md md:text-lg lg:text-xl lg:ml-3">
                    <?php echo e($manageCourse->section); ?> | <?php echo e(date('g:i A', strtotime($manageCourse->class_start_time))); ?> - <?php echo e(date('g:i A', strtotime($manageCourse->class_end_time))); ?> <?php echo e($manageCourse->days_of_the_week); ?>

                </span>
            </div>
            <div id="floatingMenu1" class="fixed right-10 top-[160px] transform -translate-y-1/2 bg-white shadow-lg rounded-md p-5 sm:p-6 md:p-7 lg:p-3 border-2 border-gray-400 text-black font-medium opacity-0 pointer-events-none transition-all duration-500">
                <div class="text-center font-bold">Class</div>
                <hr class="border-gray-300">
                <a id="inviteCodeLink" class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-200  cursor-pointer">
                    <i class="fa-solid fa-file"></i> Code
                </a>
            </div>
             <div class="rounded-md p-3 sm:p-4 md:p-6 lg:p-2 w-full h-18 sm:h-20 md:h-28 lg:h-24   mb-4 ">
                    <div  class="w-full   " >
                        <div  class="rounded-[5px] p-4 " :class="expanded ? 'hidden' : 'h-20'">
                            <div  class="flex items-center">
                                <div class="flex items-center p-3.5 ml-2 text-3xl text-gray-800 font-bold">Student Classworks</div>
                            </div>
                        <div class="border-t border-gray-600"></div>
                    </div>   
            </div>
            
               
        </div>
        <?php $__currentLoopData = $classworkByAssignment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contentItems): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $contentItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="flex bg-white w-full h-20 rounded-[5px] p-4 mt-2">
                <div class="flex items-center">
                    <img src="<?php echo e(Auth::user()->teacher_photo && Storage::exists('public/teacher_photos/' . Auth::user()->teacher_photo) ? asset('storage/teacher_photos/' . Auth::user()->teacher_photo) : asset('assets/img/user.png')); ?>" class="shadow-xl border-[.1px] border-gray-500 rounded-full w-9 object-contain mx-auto">
                </div>
                <div class="flex justify-between w-full">
                
                    <div class="text-md sm:mt-3 text-tight md:mt-2.5 lg:mt-2 lg:p-1 lg:text-md ml-2 text-md text-black w-full ">
                        <?php echo e($content['type_of_classwork']); ?> # <?php echo e($content['content_id']); ?>  <span class="ml-5 text-gray-500 text-sm"><?php echo e(date('l, g:i A', strtotime($content['created_at']))); ?></span>
                    </div>
                
                    <div x-cloak x-data="{ showModal: false, contentId: <?php echo e($content['content_id']); ?> }">
                        <div class="p-3 w-28 ml-3 mr-3 text-sm text-center text-gray-500 border rounded-md cursor-pointer border-gray-400 hover:border-blue-500 hover:text-black"
                        @click="showModal = true">Manage</div>

                        <!-- Modal -->
                        <div x-show="showModal" x-cloak
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            @click.away="showModal = false"
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">

                            <div class="bg-white p-6 rounded-lg shadow-lg max-w-3xl w-full">
                                <div x-cloak class="flex justify-between items-center border-b mb-4 w-full">
                                    <h2 class="text-xl font-semibold text-black">Students</h2>
                                </div>
                                <div class="max-h-96 overflow-y-auto">
                                    <?php $__currentLoopData = $enrolledStudent->sortBy('courseStudent.name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enrolledStudents): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($enrolledStudents->classwork_id === $manageCourse->classwork_id): ?>
                                        <div class="p-2 rounded h-auto text-lg bg-white">
                                            <div class="p-4 flex items-center justify-between">
                                                <img src="<?php echo e(asset('assets/img/user.png')); ?>" alt="Student" class="w-12 h-12 rounded-full mr-4">
                                                <p class="text-base font-medium text-gray-800 text-center"><?php echo e($enrolledStudents->courseStudent->name); ?></p>
                                                <div x-cloak x-data="{ showModalView: false, studentId: <?php echo e($enrolledStudents->courseStudent->id); ?> }">
                                                    <div class="p-3 w-28 ml-3 mr-3 text-sm text-center text-gray-500 border rounded-md cursor-pointer border-gray-400 hover:border-blue-500 hover:text-black"
                                                    @click="showModalView = true; viewFiles(<?php echo e($enrolledStudents->courseStudent->id); ?>)">View Work</div>

                                                    <!-- Modal for View -->
                                                    <div x-show="showModalView" x-cloak
                                                    x-transition:enter="transition ease-out duration-300"
                                                    x-transition:enter-start="opacity-0 transform scale-95"
                                                    x-transition:enter-end="opacity-100 transform scale-100"
                                                    x-transition:leave="transition ease-in duration-200"
                                                    x-transition:leave-start="opacity-100 transform scale-100"
                                                    x-transition:leave-end="opacity-0 transform scale-95"
                                                    @click.away="showModalView = false"
                                                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                                        
                                                        <div class="bg-white p-6 rounded-lg shadow-lg max-w-3xl w-full">
                                                            <div x-cloak class="flex justify-between items-center mb-4 w-full">
                                                                <h2 class="text-xl font-semibold text-black"><?php echo e($enrolledStudents->courseStudent->name); ?></h2>
                                                            </div>
                                                            <?php $__currentLoopData = $studentClasswork; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $studentClassworks): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($studentClassworks->student_id === $enrolledStudents->student_id): ?>
                                                               
                                                                    <div class="mt-4 p-4 bg-green-100 rounded-lg">  
                                                                            <li class="mb-2 flex items-center  rounded p-2">
                                                                                <a href="<?php echo e(route('teacher.classwork.show', $studentClassworks->id )); ?>" class="text-blue-500 hover:underline"><?php echo e($studentClassworks->class_files); ?></a>
                                                                                <div class="text-gray-500 text-sm ml-2"><?php echo e(strtoupper(pathinfo($studentClassworks->class_files, PATHINFO_EXTENSION))); ?></div>
                                                
                                                                            </li>
                                                                    </div>
                                                            <?php endif; ?>
                                                            
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="flex justify-end mt-4">
                                                                <button class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded-md"
                                                                        @click="showModalView = false">
                                                                        Close
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                            
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <div class="flex justify-end mt-4">
                                    <button class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded-md"
                                            @click="showModal = false">
                                            Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7fdc4497c56b05cf19ce7214a31530f3)): ?>
<?php $attributes = $__attributesOriginal7fdc4497c56b05cf19ce7214a31530f3; ?>
<?php unset($__attributesOriginal7fdc4497c56b05cf19ce7214a31530f3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7fdc4497c56b05cf19ce7214a31530f3)): ?>
<?php $component = $__componentOriginal7fdc4497c56b05cf19ce7214a31530f3; ?>
<?php unset($__componentOriginal7fdc4497c56b05cf19ce7214a31530f3); ?>
<?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbf020ec425b6d0b9fddc69f3baf70e3e)): ?>
<?php $attributes = $__attributesOriginalbf020ec425b6d0b9fddc69f3baf70e3e; ?>
<?php unset($__attributesOriginalbf020ec425b6d0b9fddc69f3baf70e3e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbf020ec425b6d0b9fddc69f3baf70e3e)): ?>
<?php $component = $__componentOriginalbf020ec425b6d0b9fddc69f3baf70e3e; ?>
<?php unset($__componentOriginalbf020ec425b6d0b9fddc69f3baf70e3e); ?>
<?php endif; ?>

<?php if (isset($component)) { $__componentOriginal7f83d574ebf694838d71081ed65bad7b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7f83d574ebf694838d71081ed65bad7b = $attributes; } ?>
<?php $component = App\View\Components\ShowHideSidebar::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('show-hide-sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ShowHideSidebar::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['toggleButtonId' => 'toggleButton','sidebarContainerId' => 'sidebarContainer','dashboardContentId' => 'dashboardContent','toggleIconId' => 'toggleIcon']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7f83d574ebf694838d71081ed65bad7b)): ?>
<?php $attributes = $__attributesOriginal7f83d574ebf694838d71081ed65bad7b; ?>
<?php unset($__attributesOriginal7f83d574ebf694838d71081ed65bad7b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7f83d574ebf694838d71081ed65bad7b)): ?>
<?php $component = $__componentOriginal7f83d574ebf694838d71081ed65bad7b; ?>
<?php unset($__componentOriginal7f83d574ebf694838d71081ed65bad7b); ?>
<?php endif; ?>

<?php /**PATH C:\Users\Joshua Tabura\Desktop\computer-aided-model-system-for-student\resources\views\teacher\classwork\index.blade.php ENDPATH**/ ?>