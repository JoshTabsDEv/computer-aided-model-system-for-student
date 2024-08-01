<x-teacher-app-layout>
    <x-user-route-page-name 
        :routeName="'teacher.classwork.index'"
        :courseDetails="[
            'course_name' => $manageCourse->course->course_name,
            'time' => date('g:i A', strtotime($manageCourse->class_start_time)) . ' - ' . date('g:i A', strtotime($manageCourse->class_end_time)),
            'days_of_the_week' => $manageCourse->days_of_the_week,
            'section' => $manageCourse->section,
        ]"
    />
    <x-teacher.section-div-style>
        <div class="container ml-1.5 sm:mx-auto p-4 relative">
            <div class="rounded-md p-3 sm:p-4 md:p-6 lg:p-2 w-full h-18 sm:h-20 md:h-28 lg:h-24 lg:pt-4  mb-4 truncate" style="background: linear-gradient(to right, #3b82f6, #1e40af);">
                <div class="flex justify-between">
                    <span class="text-lg truncate sm:text-sm md:text-2xl lg:text-3xl lg:ml-3 font-bold">
                        {{ $manageCourse->course->course_code }} - {{ $manageCourse->course->course_name }}
                    </span>
                    <span class="mr-5 text-lg sm:text-sm md:text-2xl lg:text-xl lg:ml-3 font-bold relative">
                        <i id="settingsIcon" class="fa-solid fa-cog cursor-pointer"></i>
                    </span>
                </div>
                <span class="text-sm sm:text-md md:text-lg lg:text-xl lg:ml-3">
                    {{ $manageCourse->section }} | {{ date('g:i A', strtotime($manageCourse->class_start_time)) }} - {{ date('g:i A', strtotime($manageCourse->class_end_time)) }} {{ $manageCourse->days_of_the_week }}
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
        @foreach ($classworkByAssignment as $contentItems)
            @foreach ($contentItems as $content )
            <div class="flex bg-white w-full h-20 rounded-[5px] p-4 mt-2">
                <div class="flex items-center">
                    <img src="{{ Auth::user()->teacher_photo && Storage::exists('public/teacher_photos/' . Auth::user()->teacher_photo) ? asset('storage/teacher_photos/' . Auth::user()->teacher_photo) : asset('assets/img/user.png') }}" class="shadow-xl border-[.1px] border-gray-500 rounded-full w-9 object-contain mx-auto">
                </div>
                <div class="flex justify-between w-full">
                
                    <div class="text-md sm:mt-3 text-tight md:mt-2.5 lg:mt-2 lg:p-1 lg:text-md ml-2 text-md text-black w-full ">
                        {{$content['type_of_classwork']}} # {{$content['content_id']}}  <span class="ml-5 text-gray-500 text-sm">{{ date('l, g:i A', strtotime($content['created_at'])) }}</span>
                    </div>
                
                    <div x-cloak x-data="{ showModal: false, contentId: {{ $content['content_id'] }} }">
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
                                    @foreach ($enrolledStudent->sortBy('courseStudent.name') as $enrolledStudents)
                                        @if ($enrolledStudents->classwork_id === $manageCourse->classwork_id)
                                        <div class="p-2 rounded h-auto text-lg bg-white">
                                            <div class="p-4 flex items-center justify-between">
                                                <img src="{{asset('assets/img/user.png')}}" alt="Student" class="w-12 h-12 rounded-full mr-4">
                                                <p class="text-base font-medium text-gray-800 text-center">{{ $enrolledStudents->courseStudent->name }}</p>
                                                <div x-cloak x-data="{ showModalView: false, studentId: {{ $enrolledStudents->courseStudent->id }} }">
                                                    <div class="p-3 w-28 ml-3 mr-3 text-sm text-center text-gray-500 border rounded-md cursor-pointer border-gray-400 hover:border-blue-500 hover:text-black"
                                                    @click="showModalView = true; viewFiles({{ $enrolledStudents->courseStudent->id }})">View Work</div>

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
                                                                <h2 class="text-xl font-semibold text-black">{{ $enrolledStudents->courseStudent->name }}</h2>
                                                            </div>
                                                            @foreach ($studentClasswork as $studentClassworks )
                                                            @if ($studentClassworks->student_id === $enrolledStudents->student_id)
                                                               
                                                                    <div class="mt-4 p-4 bg-green-100 rounded-lg">  
                                                                            <li class="mb-2 flex items-center  rounded p-2">
                                                                                <a href="{{ route('teacher.classwork.show', $studentClassworks->id )}}" class="text-blue-500 hover:underline">{{ $studentClassworks->class_files }}</a>
                                                                                <div class="text-gray-500 text-sm ml-2">{{ strtoupper(pathinfo($studentClassworks->class_files, PATHINFO_EXTENSION)) }}</div>
                                                
                                                                            </li>
                                                                    </div>
                                                            @endif
                                                            
                                                        @endforeach
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
                                        @endif
                                            
                                    @endforeach
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
            @endforeach
         @endforeach
    </x-teacher.section-div-style>
</x-teacher-app-layout>

<x-show-hide-sidebar
    toggleButtonId="toggleButton"
    sidebarContainerId="sidebarContainer"
    dashboardContentId="dashboardContent"
    toggleIconId="toggleIcon"
/>

