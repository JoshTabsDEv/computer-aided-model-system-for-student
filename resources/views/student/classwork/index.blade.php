{{-- @php
    $user = Auth::user();
@endphp

<x-student-app-layout>
    <x-user-route-page-name :routeName="'student.dashboard'" />
    <x-student.section-div-style>
        <div class="container mx-auto p-4 relative">
            <!-- Heading -->
            <div class="rounded-md p-3 sm:p-4 md:p-6 lg:p-2 w-full h-18 sm:h-20 md:h-28 lg:h-24 lg:pt-4 mb-4 truncate"
                style="background: linear-gradient(to right, #3b82f6, #1e40af);">
                <div class="flex justify-between">
                    <span class="text-lg truncate sm:text-sm md:text-2xl lg:text-3xl lg:ml-3 font-bold">
                        {{ $manageCourse->course->course_code }} - {{ $manageCourse->course->course_name }}
                    </span>
                    <span class="mr-5 text-lg sm:text-sm md:text-2xl lg:text-xl lg:ml-3 font-bold relative">
                        <i id="settingsIcon" class="fa-solid fa-cog cursor-pointer"></i>
                    </span>
                </div>
                <span class="text-sm sm:text-md md:text-lg lg:text-xl lg:ml-3">
                    {{ $manageCourse->section }} | {{ date('g:i A', strtotime($manageCourse->class_start_time)) }} -
                    {{ date('g:i A', strtotime($manageCourse->class_end_time)) }} {{ $manageCourse->days_of_the_week }}
                </span>
            </div>

            <!-- Floating Menu -->
            <div id="floatingMenu1"
                class="fixed right-10 top-[160px] transform -translate-y-1/2 bg-white shadow-lg rounded-md p-5 sm:p-6 md:p-7 lg:p-3 border-2 text-black font-medium opacity-0 pointer-events-none transition-all duration-500">
                <form
                    action="{{ route('student.unenroll', ['userID' => auth()->user()->id, 'assignmentTableID' => $manageCourse->id, 'courseID' => $manageCourse->course_id]) }}"
                    method="post">
                    @csrf
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
            @if (session('success'))
                <x-sweetalert type="success" :message="session('success')" />
            @endif
            @if (session('info'))
                <x-sweetalert type="info" :message="session('info')" />
            @endif
            @if (session('error'))
                <x-sweetalert type="error" :message="session('error')" />
            @endif

            <!-- Cards Container -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mt-2">
                <!-- Repeat this card for each class -->
                @foreach ($subClasswork as $index => $subClassworks)
                    @php
                        $solution = \App\Models\Solution::where('sub_classwork_id', $subClassworks->id)->first();
                        $files = \App\Models\CourseClassworkFiles::where(
                            'sub_classwork_id',
                            $subClassworks->id,
                        )->first();
                        $submitted = \App\Models\StudentClasswork::where('classwork_id', $subClassworks->classwork_id)
                            ->where('student_id', Auth::id())
                            ->first();
                    @endphp

                    <div class="p-4">
                        <div class="bg-white rounded-lg shadow-lg p-6 h-full">
                            <div class="flex items-center mb-2">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $index + 1 }}.</h3>
                            </div>
                            <div class="p-2 rounded h-auto text-lg bg-white overflow-y-auto text-black">
                                {!! $subClassworks->content !!}
                            </div>
                            <li class="mb-2 flex items-center border rounded p-2">
                                <img src="{{ route('thumbnails.show', ['filename' => $files->classwork_file . '.jpg']) }}"
                                    alt="{{ $files->classwork_file }}" class="w-16 h-16 object-cover mr-3">
                                <div x-cloak x-data="{ showModal1: false, contentId: {{ $subClassworks->classwork_id }} }">
                                    <a @click="showModal1 = true"
                                        class="text-blue-500 hover:underline">{{ $files->classwork_file }}</a>
                                    <div class="text-gray-500 text-sm">
                                        {{ strtoupper(pathinfo($files->classwork_file, PATHINFO_EXTENSION)) }}
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
                                            src="{{ route('student.classroom.files.show', ['id' => $files->id]) }}#toolbar=0&scrollbar=10&view=FitH"
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

                            <form
                                action="{{ route('student.student.postClasswork', ['userID' => auth()->user()->id, 'assignmentTableID' => $manageCourse->id, 'courseID' => $manageCourse->course_id, 'classwork_id' => $subClassworks->classwork_id]) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="flex justify-between items-center mb-4">
                                    <input id="files" type="file" name="files[]"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 file:disabled:opacity-50 file:disabled:pointer-events-none dark:text-neutral-500 dark:file:bg-blue-500 dark:hover:file:bg-blue-400 file:before:content-['Add_or_Create']"
                                        multiple {{ $submitted ? 'disabled' : '' }} required>
                                </div>
                                <button type="submit"
                                    class="px-4 py-2 bg-green-300 text-black rounded-md w-full {{ $submitted ? 'bg-gray-300' : '' }}"
                                    {{ $submitted ? 'disabled' : '' }}>
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- End of Cards Container -->
        </div>
    </x-student.section-div-style>
</x-student-app-layout>

<x-show-hide-sidebar toggleButtonId="toggleButton" sidebarContainerId="sidebarContainer"
    dashboardContentId="dashboardContent" toggleIconId="toggleIcon" /> --}}


@php
    $user = Auth::user();
@endphp

<x-student-app-layout>
    <x-user-route-page-name :routeName="'student.dashboard'" />
    <x-student.section-div-style>
        <div class="container mx-auto p-4 relative">
            <!-- Heading -->
            <div class="rounded-md p-3 sm:p-4 md:p-6 lg:p-2 w-full h-18 sm:h-20 md:h-28 lg:h-24 lg:pt-4 mb-4 truncate"
                style="background: linear-gradient(to right, #3b82f6, #1e40af);">
                <div class="flex justify-between">
                    <span class="text-lg truncate sm:text-sm md:text-2xl lg:text-3xl lg:ml-3 font-bold">
                        {{ $manageCourse->course->course_code }} - {{ $manageCourse->course->course_name }}
                    </span>
                    <span class="mr-5 text-lg sm:text-sm md:text-2xl lg:text-xl lg:ml-3 font-bold relative">
                        <i id="settingsIcon" class="fa-solid fa-cog cursor-pointer"></i>
                    </span>
                </div>
                <span class="text-sm sm:text-md md:text-lg lg:text-xl lg:ml-3">
                    {{ $manageCourse->section }} | {{ date('g:i A', strtotime($manageCourse->class_start_time)) }} -
                    {{ date('g:i A', strtotime($manageCourse->class_end_time)) }} {{ $manageCourse->days_of_the_week }}
                </span>
            </div>

            <!-- Floating Menu -->
            <div id="floatingMenu1"
                class="fixed right-10 top-[160px] transform -translate-y-1/2 bg-white shadow-lg rounded-md p-5 sm:p-6 md:p-7 lg:p-3 border-2 text-black font-medium opacity-0 pointer-events-none transition-all duration-500">
                <form
                    action="{{ route('student.unenroll', ['userID' => auth()->user()->id, 'assignmentTableID' => $manageCourse->id, 'courseID' => $manageCourse->course_id]) }}"
                    method="post">
                    @csrf
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
            @if (session('success'))
                <x-sweetalert type="success" :message="session('success')" />
            @endif
            @if (session('info'))
                <x-sweetalert type="info" :message="session('info')" />
            @endif
            @if (session('error'))
                <x-sweetalert type="error" :message="session('error')" />
            @endif

            <!-- Cards Container -->

            <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1 gap-4 mt-2">
                <!-- Repeat this card for each class -->
                @foreach ($subClasswork as $index => $subClassworks)
                    @php
                        $solution = \App\Models\Solution::where('sub_classwork_id', $subClassworks->id)->first();
                        $files = \App\Models\CourseClassworkFiles::where(
                            'sub_classwork_id',
                            $subClassworks->id,
                        )->first();
                        $submitted = \App\Models\StudentClasswork::where('sub_classwork_id', $subClassworks->id)
                            ->where('student_id', Auth::id())
                            ->first();
                    @endphp
                    <div class="p-4">

                        <div class="bg-white rounded-lg shadow-lg p-6 h-full">
                            @if (!$submitted)
                                <div id="countdown{{ $subClassworks->id }}"
                                    class="text-lg font-semibold text-red-500 dark:text-red-400 mb-4"
                                    x-data="{ timer: 3600, interval: null, expired: false }" x-init="interval = setInterval(() => {
                                        if (timer > 0) {
                                            timer--;
                                            let hours = Math.floor(timer / 3600);
                                            let minutes = Math.floor((timer % 3600) / 60);
                                            let seconds = Math.floor(timer % 60);
                                            document.getElementById('countdown{{ $subClassworks->id }}').innerHTML = hours + 'h ' + minutes + 'm ' + seconds + 's ';
                                        } else {
                                            clearInterval(interval);
                                            expired = true;
                                            document.getElementById('countdown{{ $subClassworks->id }}').innerHTML = 'Time\'s up!';
                                            document.getElementById('submit{{ $subClassworks->id }}').disabled = true;
                                            document.getElementById('autoSubmitForm').submit();
                                        }
                                    }, 1000);">
                                </div>
                            @endif
                            <form id="autoSubmitForm" action="{{ route('student.student.postAnswer', ['userID' => auth()->user()->id, 'assignmentTableID' => $manageCourse->id, 'courseID' => $manageCourse->course_id, 'classwork_id' => $subClassworks->classwork_id, 'subClassworkID' => $subClassworks->id]) }} " method="post">@csrf</form>


                            <div class="flex items-center mb-2">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $index + 1 }}.</h3>
                            </div>
                            <div class="p-2 rounded h-auto text-lg bg-white overflow-y-auto text-black">
                                {!! $subClassworks->content !!}
                            </div>
                            <li class="mb-2 flex items-center border rounded p-2">
                                <img src="{{ route('thumbnails.show', ['filename' => $files->classwork_file . '.jpg']) }}"
                                    alt="{{ $files->classwork_file }}" class="w-16 h-16 object-cover mr-3">
                                <div x-cloak x-data="{ showModal1: false, contentId: {{ $subClassworks->classwork_id }} }">
                                    <a @click="showModal1 = true"
                                        class="text-blue-500 hover:underline">{{ $files->classwork_file }}</a>
                                    <div class="text-gray-500 text-sm">
                                        {{ strtoupper(pathinfo($files->classwork_file, PATHINFO_EXTENSION)) }}
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
                                            src="{{ route('student.classroom.files.show', ['id' => $files->id]) }}#toolbar=0&scrollbar=10&view=FitH"
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

                            @if ($submitted)
                                <div class="mt-4">
                                    <p class="text-gray-600 font-semibold">Submitted Files:</p>

                                    <div class="flex items-center mt-2">
                                        <a class="text-blue-500 hover:underline">{{ $submitted->class_files }}</a>
                                    </div>
                                </div>
                                <div class="mt-4 p-4 bg-gray-100 rounded-lg">
                                    <div class="mt-4 p-4 bg-green-100 rounded-lg">
                                        <h3 class="text-lg font-semibold text-black">
                                            Solution</h3>
                                        <li class="mb-2 flex items-center border rounded p-2">
                                            <img src="{{ route('thumbnails.show', ['filename' => $files->classwork_file . '.jpg']) }}"
                                                alt="{{ $files->classwork_file }}" class="w-16 h-16 object-cover mr-3">
                                            <div x-cloak x-data="{ showModal2: false, contentId: {{ $subClassworks->classwork_id }} }">
                                                <a @click="showModal2 = true"
                                                    class="text-blue-500 hover:underline">{{ $files->classwork_file }}</a>
                                                <div class="text-gray-500 text-sm">
                                                    {{ strtoupper(pathinfo($files->classwork_file, PATHINFO_EXTENSION)) }}
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
                                                        src="{{ route('student.solutions.show', $solution->id) }}#toolbar=0&scrollbar=10&view=FitH"
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
                            @endif

                            <form
                                action="{{ route('student.student.postAnswer', ['userID' => auth()->user()->id, 'assignmentTableID' => $manageCourse->id, 'courseID' => $manageCourse->course_id, 'classwork_id' => $subClassworks->classwork_id, 'subClassworkID' => $subClassworks->id]) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="flex justify-between items-center mb-4">
                                    <input id="files" type="file" name="files[]"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 file:disabled:opacity-50 file:disabled:pointer-events-none dark:text-neutral-500 dark:file:bg-blue-500 dark:hover:file:bg-blue-400 file:before:content-['Add_or_Create']"
                                        multiple onchange="displaySelectedFiles(this)"
                                        {{ $submitted ? 'disabled' : '' }} required>
                                </div>
                                <button id="submit{{ $subClassworks->id }}" type="submit"
                                    class="px-4 py-2 bg-green-300 text-black rounded-md w-full {{ $submitted ? 'bg-gray-300' : '' }}"
                                    {{ $submitted ? 'disabled' : '' }}>
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- End of Cards Container -->
        </div>
    </x-student.section-div-style>
</x-student-app-layout>

<x-show-hide-sidebar
