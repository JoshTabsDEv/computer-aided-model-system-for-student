<x-student-app-layout>
    <x-user-route-page-name :routeName="'student.student.index'" :courseDetails="[
        'course_name' => $manageCourse->course->course_name,
        'time' =>
            date('g:i A', strtotime($manageCourse->class_start_time)) .
            ' - ' .
            date('g:i A', strtotime($manageCourse->class_end_time)),
        'days_of_the_week' => $manageCourse->days_of_the_week,
        'section' => $manageCourse->section,
    ]" />
    <x-student.section-div-style>
        <div class="container ml-1.5 sm:mx-auto p-4 relative">
            <!-- heading -->
            <div class="rounded-md p-3 sm:p-4 md:p-6 lg:p-2 w-full h-18 sm:h-20 md:h-28 lg:h-24 lg:pt-4  mb-4 truncate"
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
            <div id="floatingMenu1"
                class="fixed right-10 top-[160px] transform -translate-y-1/2 bg-white shadow-lg rounded-md p-5 sm:p-6 md:p-7 lg:p-3 border-2  text-black font-medium opacity-0 pointer-events-none transition-all duration-500">
                <form
                    action="{{ route('student.unenroll', ['userID' => auth()->user()->id, 'assignmentTableID' => $manageCourse->id, 'courseID' => $manageCourse->course_id]) }}"
                    method="post">
                    @csrf
                    <button class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-200  cursor-pointer">
                        <i class="fa-solid fa-file"></i> Unenroll
                    </button>
                </form>

            </div>
            <!-- Menu's -->
            <div id="floatingMenu"
                class="z-10 fixed right-4 top-1/2 transform -translate-y-1/2 bg-white shadow-lg rounded-md p-5 sm:p-6 md:p-7 lg:p-3 border-2 border-gray-400 text-black font-medium opacity-0 pointer-events-none transition-all duration-500">
                <div class="text-center font-bold">View</div>
                <hr class="border-gray-300">
                <a href="#" @click.prevent="openClassworkModal()"
                    class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-200">
                    <i class="fa-solid fa-file"></i> People
                </a>
                <hr class="border-gray-300">
                <a href="#" class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-200">
                    <i class="fa-solid fa-list-ol"></i> Scores
                </a>
                <hr class="border-gray-300">
                <a href="#" class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-200">
                    <i class="fa-solid fa-file-pen"></i> Student
                </a>
            </div>

            <!-- Classwork Modal -->
            <div id="studentModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
                <div class="fixed inset-0 bg-gray-800 bg-opacity-75"></div>
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-3xl w-full z-50">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-black">People</h2>
                        <button id="closeClassworkModal" class="text-lg text-black">X</button>
                    </div>

                    <!-- Modal body -->
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Teacher section -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Instructor</h3>
                            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                                <div class="p-4 flex items-center">
                                    <img src="teacher.jpg" alt="Teacher" class="w-12 h-12 rounded-full mr-4">
                                    <p class="text-base font-medium text-gray-800">{{ $manageCourse->teacher->name }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Student section -->
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Students</h3>
                        @foreach ($enrolledStudent->sortBy('courseStudent.name') as $enrolledStudents)
                            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                                <div class="p-4 flex items-center">
                                    <img src="student.jpg" alt="Student" class="w-12 h-12 rounded-full mr-4">
                                    <p class="text-base font-medium text-gray-800">
                                        {{ $enrolledStudents->courseStudent->name }}</p>
                                </div>
                            </div>
                        @endforeach
                        <div>


                        </div>
                    </div>

                </div>
            </div>

            <!-- Toggle Button for Adding of Components -->
            <div id="toggleButton2"
                class="fixed -right-1 top-1/2 transform -translate-y-1/2 z-50 bg-white text-gray-500 p-2 rounded-full shadow-md cursor-pointer">
                <svg id="toggleIcon2" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l7-7-4-4-7 7v4h4z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18 13l-6-6m6 6L13 6m0 0l-3 3" />
                </svg>
            </div>
            <!-- Content Area -->
            <div class="flex rounded-[5px] lg:p-0 text-black font-medium">
                <div class="flex flex-col hidden sm:hidden md:block mb-5">
                    <div class="flex flex-col justify-start w-72 h-24 mb-5 p-2 bg-white rounded-[5px] md:w-52 lg:w-72">
                        <div class="w-full h-6">
                            <i class="fa-solid fa-check" style="color: #000000;"></i>
                            Completed
                        </div>
                        <hr class="w-full border border-gray-500">
                        <div class="p-2">Module</div>
                    </div>
                    <div
                        class="flex justify-start w-72 h-24 p-2 bg-white rounded-[5px] hidden sm:block md:w-52 lg:w-72">
                        <div class="w-full h-6">
                            <i class="fa-solid fa-check" style="color: #000000;"></i>
                            On-going
                        </div>
                        <hr class="w-full border border-gray-500">
                    </div>
                </div>
                @if (session('success'))
                    <x-sweetalert type="success" :message="session('success')" />
                @endif

                @if (session('info'))
                    <x-sweetalert type="info" :message="session('info')" />
                @endif

                @if (session('error'))
                    <x-sweetalert type="error" :message="session('error')" />
                @endif
                <div class="flex flex-col w-full md:ml-5 mb-5 space-y-5">
                    <div x-data="{ expanded: false, content: '' }" class="w-full   ">
                        <div @click="expanded = !expanded"
                            class="rounded-[5px] p-4 bg-white  cursor-pointer hover:bg-neutral-100"
                            :class="expanded ? 'hidden' : 'h-20'">
                            <div class="flex items-center">
                                <a href="#" class="block">
                                    <!-- User Image Logic -->
                                    <img src="{{ $manageCourse->teacher->teacher_photo && Storage::exists('public/teacher_photos/' . $manageCourse->teacher->teacher_photo) ? asset('storage/teacher_photos/' . $manageCourse->teacher->teacher_photo) : asset('assets/img/user.png') }}"
                                        class="shadow-xl border-[.1px] border-gray-500 rounded-full w-9 object-contain mx-auto">
                                </a>
                                <div class="flex justify-center p-3.5 ml-2 text-sm text-gray-500">Announce something to
                                    your class</div>
                            </div>
                        </div>
                        <div x-show="expanded" class="bg-gray-100 p-4 rounded-lg relative" x-cloak>
                            <form id="announcementForm"
                                action="{{ route('teacher.teacher.postAnnouncement', ['userID' => auth()->user()->id, 'assignmentTableID' => $manageCourse->id, 'courseID' => $manageCourse->course_id]) }}"
                                method="POST" onsubmit="logAnnouncement(event)">
                                @csrf
                                <div class="text-gray-500">
                                    Announcement for your student..
                                </div>
                                <div id="editor" contenteditable="true"
                                    class="border p-2 mt-2 rounded h-40 bg-white overflow-y-auto"
                                    placeholder="Enter your announcement here..." oninput="checkContent()"></div>
                                <input type="hidden" name="content" id="content">
                                <div class="editor-toolbar">
                                    <button type="button" onclick="formatText('bold')"
                                        title="Bold"><strong>B</strong></button>
                                    <button type="button" onclick="formatText('italic')"
                                        title="Italic"><em>I</em></button>
                                    <button type="button" onclick="formatText('underline')"
                                        title="Underline"><u>U</u></button>
                                </div>
                                <div class="flex justify-end mt-2">
                                    <button type="button"
                                        @click="expanded = false; document.getElementById('editor').innerText=''"
                                        class="bg-red-500 text-white px-4 py-2 rounded mr-2">Cancel</button>
                                    <button type="submit" id="postButton" disabled
                                        class="bg-blue-500 text-white px-4 py-2 rounded disabled">Post</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @if (count($announcementsByAssignment) > 0 || count($classworkByAssignment) > 0)
                        @foreach (['Announcement' => $announcementsByAssignment, 'Classwork' => $classworkByAssignment] as $type => $items)
                            @foreach ($items as $contentId => $contentItems)
                                @foreach ($contentItems as $content)
                                    <div class="flex bg-white w-full h-20 rounded-[5px] p-4">
                                        <div class="flex items-center">
                                            <img src="{{ Auth::user()->teacher_photo && Storage::exists('public/teacher_photos/' . Auth::user()->teacher_photo) ? asset('storage/teacher_photos/' . Auth::user()->teacher_photo) : asset('assets/img/user.png') }}"
                                                class="shadow-xl border-[.1px] border-gray-500 rounded-full w-9 object-contain mx-auto">
                                        </div>
                                        <div class="flex justify-between w-full">
                                            @if ($type === 'Announcement')
                                                <div
                                                    class="text-md sm:mt-3 text-tight md:mt-2.5 lg:mt-2 lg:p-1 lg:text-md ml-2 text-md text-black w-full">
                                                    Posted an {{ strtolower($type) }} <span
                                                        class="ml-5 text-gray-500 text-sm">{{ date('l, g:i A', strtotime($content['created_at'])) }}</span>
                                                </div>
                                            @else
                                                @if ($content['type_of_classwork'] === 'Assignment')
                                                    <div
                                                        class="text-md sm:mt-3 text-tight md:mt-2.5 lg:mt-2 lg:p-1 lg:text-md ml-2 text-md text-black w-full">
                                                        Posted an {{ strtolower($content['type_of_classwork']) }} <span
                                                            class="ml-5 text-gray-500 text-sm">{{ date('l, g:i A', strtotime($content['created_at'])) }}</span>
                                                    </div>
                                                @else
                                                    <div
                                                        class="text-md sm:mt-3 text-tight md:mt-2.5 lg:mt-2 lg:p-1 lg:text-md ml-2 text-md text-black w-full">
                                                        Posted a {{ strtolower($content['type_of_classwork']) }} <span
                                                            class="ml-5 text-gray-500 text-sm">{{ date('l, g:i A', strtotime($content['created_at'])) }}</span>
                                                    </div>
                                                @endif
                                            @endif

                                            <div x-cloak x-data="{ showModal: false, contentId: {{ $content['content_id'] }} }">
                                                <div class="p-3 w-28 ml-3 mr-3 text-sm text-center text-gray-500 border rounded-md cursor-pointer border-gray-400 hover:border-blue-500 hover:text-black"
                                                    @click="showModal = true">Click to view</div>

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

                                                    <div
                                                        class="bg-white p-6 rounded-lg shadow-lg -mt-32 max-w-xl w-full mt-5 relative">
                                                        @if ($type === 'Classwork')
                                                            <button @click="showModal = false"
                                                                id="closeClassworkModal"
                                                                class="absolute top-0 right-0 m-2 text-lg text-black">X</button>
                                                        @endif

                                                        <div x-cloak
                                                            class="flex justify-between items-center border-b mb-4 w-full">
                                                            <h2 class="text-xl font-semibold">{{ $type }} #
                                                                {{ $content['content_id'] }}</h2>

                                                            <div class="flex items-center">
                                                                <img src="{{ $manageCourse->teacher->teacher_photo && Storage::exists('public/teacher_photos/' . $manageCourse->teacher->teacher_photo) ? asset('storage/teacher_photos/' . $manageCourse->teacher->teacher_photo) : asset('assets/img/user.png') }}"
                                                                    class="shadow-xl border-[.1px] border-gray-500 rounded-full w-9 object-contain mx-auto mr-2">
                                                                <p>{{ $manageCourse->teacher->name }}</p>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class=" p-2 rounded h-auto text-lg bg-white overflow-y-auto">
                                                            {!! $content['content'] !!}
                                                        </div>

                                                        @if ($type === 'Classwork')
                                                            @foreach ($file as $files)
                                                                @if ($content['content_id'] === $files->classwork_id)
                                                                    @if ($content['type_of_classwork'] != 'Practice Problem')
                                                                        <li
                                                                            class="mb-2 flex items-center border rounded p-2">
                                                                            <img src="{{ route('thumbnails.show', ['filename' => $files->classwork_file . '.jpg']) }}"
                                                                                alt="{{ $files->classwork_file }}"
                                                                                class="w-16 h-16 object-cover mr-3">
                                                                            <div x-cloak x-data="{ showModal1: false, contentId: {{ $content['content_id'] }} }">
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
                                                                                    @click.away="showModal = false"
                                                                                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">

                                                                                    <iframe frameborder="0"
                                                                                        src="{{ route('student.classroom.files.show', ['id' => $files->id]) }}#toolbar=0&scrollbar=10&view=FitH"
                                                                                        width="600" height="800"
                                                                                        style=" overflow: auto;"></iframe>
                                                                                    <div
                                                                                        class="fixed top-0 right-0 m-4">
                                                                                        <button
                                                                                            class="close-btn flex items-center justify-center rounded-full"
                                                                                            @click="showModal1 = false">
                                                                                            <svg class="w-6 h-6 text-white"
                                                                                                fill="none"
                                                                                                stroke="currentColor"
                                                                                                viewBox="0 0 24 24"
                                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                                <path
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"
                                                                                                    stroke-width="2"
                                                                                                    d="M6 18L18 6M6 6l12 12">
                                                                                                </path>
                                                                                            </svg>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                        </li>
                                                                    @endif

                                                                    @php
                                                                        $submitted = $student_file
                                                                            ->where(
                                                                                'classwork_id',
                                                                                $content['content_id'],
                                                                            )
                                                                            ->where('student_id', Auth::id())
                                                                            ->isNotEmpty();
                                                                    @endphp
                                                                    @if ($content['type_of_classwork'] === 'Practice Problem')
                                                                        {{-- <div id="countdown" class="text-lg font-semibold text-red-500 dark:text-red-400 mb-4" x-data="{ deadline: new Date('{{ $content['deadline'] }}') }" x-init="setInterval(() => {
                                                                                    let now = new Date().getTime();
                                                                                    let distance = deadline - now;
                                                                                    if (distance < 0) {
                                                                                       
                                                                                    } else {
                                                                                        let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                                                        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                                                        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                                                        let seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                                                                        document.getElementById('countdown').innerHTML = days + 'd ' + hours + 'h ' + minutes + 'm ' + seconds + 's ';
                                                                                    }
                                                                                }, 1000)">
                                                                                </div> --}}

                                                                        {{-- @if (!$submitted)

                                                                                <template x-if="showModal">
                                                                                    <div id="countdown{{$content['content_id']}}" class="text-lg font-semibold text-red-500 dark:text-red-400 mb-4"   x-show="showModal" x-data="{ timer: 3600, interval: null, expired: false }" x-init="
                                                                                    interval = setInterval(() => {
                                                                                        if (timer > 0) {
                                                                                            timer--;
                                                                                            let hours = Math.floor(timer / 3600);
                                                                                            let minutes = Math.floor((timer % 3600) / 60);
                                                                                            let seconds = Math.floor(timer % 60);
                                                                                            document.getElementById('countdown{{$content['content_id']}}').innerHTML = hours + 'h ' + minutes + 'm ' + seconds + 's ';
                                                                                        } else {
                                                                                            clearInterval(interval);
                                                                                            expired = true;
                                                                                            document.getElementById('countdown{{$content['content_id']}}').innerHTML = 'Time\'s up!';
                
                                                                                            updateStatusToMissing({{ $content['content_id'] }});
                                                                                        }
                                                                                    }, 1000);
                                                                                ">
                                                                                </div>
                                                                                </template>

                                                                                {{-- <div x-data="{ open: false, timer: 3600, interval: null, expired: false }"
                                                                                    x-show="showModal"
                                                                                    @keydown.escape.window="open = false"
                                                                                    @click.away="open = false"
                                                                                    x-init="
                                                                                        $watch('open', value => {
                                                                                            if (value) {
                                                                                                startCountdown();
                                                                                            } else {
                                                                                                clearInterval(interval);
                                                                                            }
                                                                                        });

                                                                                        function startCountdown() {
                                                                                            interval = setInterval(() => {
                                                                                                if (timer > 0) {
                                                                                                    timer--;
                                                                                                    let hours = Math.floor(timer / 3600);
                                                                                                    let minutes = Math.floor((timer % 3600) / 60);
                                                                                                    let seconds = Math.floor(timer % 60);
                                                                                                    $el.querySelector('#countdown').innerHTML = hours + 'h ' + minutes + 'm ' + seconds + 's ';
                                                                                                } else {
                                                                                                    clearInterval(interval);
                                                                                                    expired = true;
                                                                                                    $el.querySelector('#countdown').innerHTML = 'Time\'s up!';
                                                                                                    updateStatusToMissing({{ $content['content_id'] }});
                                                                                                }
                                                                                            }, 1000);
                                                                                        }
                                                                                    "
                                                                                    class="modal">
                                                                                    </div> --}}
                                                                        {{-- @else
                                                                                
                                                                                @endif --}}
                                                                    @else
                                                                        <div
                                                                            class="text-lg font-semibold text-red-500 dark:text-gray-400 mb-4">
                                                                            {{ $content['deadline'] }}</div>
                                                                        <div class="mt-4 p-4 bg-gray-100 rounded-lg">
                                                                            <div
                                                                                class="flex justify-between items-center mb-4">
                                                                                <h3 class="text-lg font-semibold">Your
                                                                                    work</h3>
                                                                                @php
                                                                                    $submitted = $student_file
                                                                                        ->where(
                                                                                            'classwork_id',
                                                                                            $content['content_id'],
                                                                                        )
                                                                                        ->where(
                                                                                            'student_id',
                                                                                            Auth::id(),
                                                                                        )
                                                                                        ->isNotEmpty();
                                                                                @endphp
                                                                                @if (Carbon\Carbon::parse($content['deadline_timestamp'])->isPast() && !$submitted)
                                                                                    <span class="text-red-600">
                                                                                        Missing
                                                                                    </span>
                                                                                @elseif(!$submitted)
                                                                                    <span class="text-green-600">
                                                                                        Assigned
                                                                                    </span>
                                                                                @else
                                                                                    <span class="text-blue-600">
                                                                                        Submitted
                                                                                    </span>
                                                                                @endif

                                                                            </div>
                                                                            <form
                                                                                action="{{ route('student.student.postClasswork', ['userID' => auth()->user()->id, 'assignmentTableID' => $manageCourse->id, 'courseID' => $manageCourse->course_id, 'classwork_id' => $content['content_id']]) }}"
                                                                                method="POST"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                @if (!$submitted)
                                                                                    <div
                                                                                        class="flex justify-between items-center">
                                                                                        <input id="files"
                                                                                            type="file"
                                                                                            name="files[]"class="block w-full text-sm text-gray-500
                                                                                                file:me-4 file:py-2 file:px-4
                                                                                                file:rounded-lg file:border-0
                                                                                                file:text-sm file:font-semibold
                                                                                                file:bg-blue-600 file:text-white
                                                                                                hover:file:bg-blue-700
                                                                                                file:disabled:opacity-50 file:disabled:pointer-events-none
                                                                                                dark:text-neutral-500
                                                                                                dark:file:bg-blue-500
                                                                                                dark:hover:file:bg-blue-400
                                                                                                file:before:content-['Add_or_Create']
                                                                                                " multiple
                                                                                            onchange="displaySelectedFiles(this)
                                                                                                ">

                                                                                    </div>
                                                                                @else
                                                                                    <div
                                                                                        class="flex justify-between items-center">
                                                                                        <input id="files"
                                                                                            type="file"
                                                                                            name="files[]"class="block w-full text-sm text-gray-500
                                                                                            file:me-4 file:py-2 file:px-4
                                                                                            file:rounded-lg file:border-0
                                                                                            file:text-sm file:font-semibold
                                                                                            file:bg-blue-600 file:text-white
                                                                                            hover:file:bg-blue-700
                                                                                            file:disabled:opacity-50 file:disabled:pointer-events-none
                                                                                            dark:text-neutral-500
                                                                                            dark:file:bg-blue-500
                                                                                            dark:hover:file:bg-blue-400
                                                                                            file:before:content-['Add_or_Create']
                                                                                            " multiple
                                                                                            onchange="displaySelectedFiles(this)
                                                                                            "
                                                                                            disabled required>
                                                                                    </div>
                                                                                @endif

                                                                                @if (Carbon\Carbon::parse($content['deadline_timestamp'])->isPast())
                                                                                    <p
                                                                                        class="text-sm text-gray-500 mt-2">
                                                                                        Your teacher is not accepting
                                                                                        work at this time</p>
                                                                                @endif
                                                                                {{-- <p class="text-sm text-gray-500 mt-2">Your teacher is not accepting work at this time</p> --}}
                                                                        </div>
                                                                        @if (!$submitted)
                                                                            <button type="submit"
                                                                                class="px-4 py-2 mt-5 bg-green-300 text-black-500 rounded-md w-full">Submit</button>
                                                                        @else
                                                                            <button type="submit"
                                                                                class="px-4 py-2 mt-5 bg-gray-300 text-black-500 rounded-md w-full"
                                                                                disabled>Submit</button>
                                                                        @endif

                                                                        <p></p>
                                                                        </form>
                                                                        @foreach ($student_file as $student_files)
                                                                            @if ($student_files->classwork_id === $content['content_id'] && $student_files->student_id === Auth::id())
                                                                                @foreach ($solution as $solutions)
                                                                                    @if ($solutions->classwork_id === $content['content_id'])
                                                                                        <div
                                                                                            class="mt-4 p-4 bg-gray-100 rounded-lg">
                                                                                            <div
                                                                                                class="mt-4 p-4 bg-green-100 rounded-lg">
                                                                                                <h3
                                                                                                    class="text-lg font-semibold">
                                                                                                    Solution</h3>

                                                                                                <li
                                                                                                    class="mb-2 flex items-center border rounded p-2">
                                                                                                    <a href="{{ route('student.solutions.show', $solutions->id) }}"
                                                                                                        class="text-blue-500 hover:underline">{{ basename($solutions->solution_file) }}</a>
                                                                                                    <div
                                                                                                        class="text-gray-500 text-sm ml-2">
                                                                                                        {{ strtoupper(pathinfo($solutions->solution_file, PATHINFO_EXTENSION)) }}
                                                                                                    </div>
                                                                                                </li>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endforeach
                                                                            @endif
                                                                        @endforeach
                                                                        <div class="flex justify-end mt-4">

                                                                        </div>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        @if ($content['type_of_classwork'] === 'Practice Problem')
                                                            <button type="submit"
                                                                class="px-4 py-2 mt-5 bg-green-300 text-black-500 rounded-md w-full"><a
                                                                    href="{{ route('student.classwork.index', ['userID' => auth()->user()->id, 'assignmentTableID' => $manageCourse->id, 'courseID' => $manageCourse->course_id, 'classworkID' => $content['content_id']]) }}"
                                                                    class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-200">Start</a></button>
                                                        @endif
                                                        @if ($type === 'Announcement')
                                                            <div class="flex justify-end mt-4">
                                                                <button type="submit"
                                                                    class="px-4 py-2 mx-4 bg-blue-500 hover:bg-blue-700 text-white rounded-md"
                                                                    @click="showModal = false">
                                                                    Close
                                                                </button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div x-data="{ open: false }" class="relative inline-block text-left">
                                                <div class="dropdown">
                                                    <button @click="open = !open" type="button"
                                                        class="z-50 inline-flex items-center p-2.5 ml-2 mt-2 text-sm text-gray-500 rounded-md cursor-pointer hover:text-black hover:shadow-xl focus:outline-none">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <div x-cloak x-show="open" @click.away="open = false"
                                                        class="dropdown-content absolute right-0 mt-2 w-32 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none">
                                                        <div x-data="{ open: false }" class="relative">
                                                            <a href="#"
                                                                class="block px-4 py-2 w-full text-sm hover:rounded-md text-gray-700 hover:bg-gray-100 hover:text-black focus:outline-none">
                                                                Copy link
                                                            </a>

                                                            <!-- Modal -->
                                                            <div x-cloak x-show="open" id="updateModal"
                                                                class="fixed inset-0 flex items-center justify-center z-50">
                                                                <div class="fixed inset-0 bg-gray-800 bg-opacity-75">
                                                                </div>
                                                                <div
                                                                    class="bg-white p-6 rounded-lg shadow-lg -mt-32 max-w-3xl w-full z-50">
                                                                    <div x-cloak
                                                                        class="flex justify-between items-center">
                                                                        <h2 class="text-xl font-semibold">Edit
                                                                            {{ $type }}</h2>
                                                                        <button @click="open = false"
                                                                            class="text-lg text-hover:text-red-500">×</button>
                                                                    </div>

                                                                    <!-- Modal body -->
                                                                    <form
                                                                        id="updateForm_{{ $type }}_{{ $content['content_id'] }}"
                                                                        action="{{ route('teacher.teacher.updateAnnouncement', [
                                                                            'userID' => auth()->user()->id,
                                                                            'assignmentTableID' => $manageCourse->id,
                                                                            'courseID' => $manageCourse->course_id,
                                                                            'contentID' => $contentId,
                                                                            'type' => $type,
                                                                            'announcementID' => $content['content_id'],
                                                                        ]) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PUT')

                                                                        <div x-data="{
                                                                            message: `{!! $content['content'] !!}`,
                                                                            initialMessage: `{!! $content['content'] !!}`,
                                                                            isEdited: false
                                                                        }">
                                                                            <!-- Editable content -->
                                                                            <div contenteditable="true"
                                                                                @input="message = $event.target.innerHTML; isEdited = true"
                                                                                x-ref="editable"
                                                                                class="w-full border p-2 mt-2 rounded h-40 bg-white overflow-y-auto">
                                                                                {!! $content['content'] !!}</div>

                                                                            <!-- Hidden textarea to hold the content -->
                                                                            <textarea hidden name="content" x-text="message"></textarea>

                                                                            <!-- Editor toolbar -->
                                                                            <div class="editor-toolbar mt-2">
                                                                                <button type="button"
                                                                                    @click="formatText('bold')"
                                                                                    title="Bold"><strong>B</strong></button>
                                                                                <button type="button"
                                                                                    @click="formatText('italic')"
                                                                                    title="Italic"><em>I</em></button>
                                                                                <button type="button"
                                                                                    @click="formatText('underline')"
                                                                                    title="Underline"><u>U</u></button>
                                                                            </div>

                                                                            <!-- Buttons for cancel and save -->
                                                                            <div class="flex justify-end mt-2">
                                                                                <button type="button"
                                                                                    @click="open = false;"
                                                                                    class="bg-red-500 text-white px-4 py-2 rounded mr-2">Cancel</button>
                                                                                <button type="submit"
                                                                                    id="updateButton_{{ $type }}_{{ $content['content_id'] }}"
                                                                                    class="text-white px-4 py-2 rounded"
                                                                                    :class="{
                                                                                        'bg-blue-500 cursor-pointer': isEdited,
                                                                                        'bg-blue-300 cursor-not-allowed':
                                                                                            !isEdited
                                                                                    }"
                                                                                    x-text="isEdited ? 'Save changes' : 'Save changes'"
                                                                                    :disabled="!isEdited"></button>

                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <form
                                                            action="{{ route('teacher.teacher.removeAnnouncement', [
                                                                'userID' => auth()->user()->id,
                                                                'assignmentTableID' => $manageCourse->id,
                                                                'courseID' => $manageCourse->course_id,
                                                                'type' => $type,
                                                                'contentID' => $contentId,
                                                                'announcementID' => $content['content_id'],
                                                            ]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <input type="hidden" name="content_id"
                                                                value="{{ $content['content_id'] }}">


                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        @endforeach
                    @else
                        <div class="flex bg-white w-full h-20 rounded-[5px] p-4 ">
                            <div class="flex items-center mx-auto">
                                <div class="p-3.5 w-full ml-2 text-md text-black">No posted announcement / materials or
                                    modules</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <!-- MODAL -->
            <div id="inviteCodeModal"
                class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 opacity-0 pointer-events-none transition-opacity duration-500">
                <div class="bg-white rounded-lg p-6 max-w-md mx-auto">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold">Invite Code</h3>
                        <button id="closeModal" class="text-gray-500 hover:text-gray-800">
                            <i class="fa-solid fa-times"></i>
                        </button>
                    </div>
                    <p>Your invite code is: <strong>XYZ123</strong></p>
                    <button id="closeModalBottom"
                        class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </x-student.section-div-style>
</x-student-app-layout>

<x-show-hide-sidebar toggleButtonId="toggleButton" sidebarContainerId="sidebarContainer"
    dashboardContentId="dashboardContent" toggleIconId="toggleIcon" />

<script>
    function updateInput() {
        // Get the content of the div
        var announcementContent = document.getElementById('update').innerHTML;
        // Set the value of the input field
        document.getElementById('content').value = announcementContent;

        document.getElementById('updateAnnouncementForm').submit();
    }



    // code for adding announcement                                                
    function logAnnouncement(event) {
        event.preventDefault();
        // Get the content from the editor
        const editorContent = document.getElementById('editor').innerHTML;
        // Set the value of the hidden input field
        document.getElementById('content').value = editorContent;
        // Submit the form
        document.getElementById('announcementForm').submit();
    }

    function logClasswork(event) {
        event.preventDefault();
        // Get the content from the editor
        const editorContent = document.getElementById('editor1').innerHTML;
        const element = document.getElementById('editor2');
        // Set the value of the hidden input field
        document.getElementById('content1').value = editorContent;
        document.getElementById('content2').value = element.options[element.selectedIndex].getAttribute('data-id');
        // Submit the form
        document.getElementById('classworkForm').submit();
    }

    // code for toggleButton floating menu

    document.addEventListener('DOMContentLoaded', function() {
        var toggleButton = document.getElementById('toggleButton2');
        var menu = document.getElementById('floatingMenu');

        toggleButton.addEventListener('mouseover', function() {
            menu.classList.remove('opacity-0', 'pointer-events-none');
            menu.classList.add('opacity-100', 'pointer-events-auto');
            toggleButton.style.opacity = '0'; // Hide toggleButton when menu is shown
        });

        menu.addEventListener('mouseleave', function() {
            menu.classList.remove('opacity-100', 'pointer-events-auto');
            menu.classList.add('opacity-0', 'pointer-events-none');
            toggleButton.style.opacity = '1'; // Show toggleButton when menu is hidden
        });
    });
</script>


<script>
    //code for toggling Classwork Modal
    document.addEventListener('DOMContentLoaded', function() {
        const classworkModal = document.getElementById('studentModal');
        const openClassworkModalButton = document.querySelector('#floatingMenu a[href="#"]');
        const closeClassworkModalButton = document.getElementById('closeClassworkModal');

        openClassworkModalButton.addEventListener('click', function() {
            classworkModal.classList.remove('hidden');
        });

        closeClassworkModalButton.addEventListener('click', function() {
            classworkModal.classList.add('hidden');
        });
    });
</script>


<style>
    /* css for toggleButton floating menu */
    #floatingMenu {
        transition: opacity 0.5s ease-in-out;
    }

    #toggleButton2 {
        transition: opacity 0.5s ease-in-out;
    }
</style>

<script>
    // Javascript Modal code for Invite
    document.addEventListener('DOMContentLoaded', function() {
        var settingsIcon = document.getElementById('settingsIcon');
        var menu = document.getElementById('floatingMenu1');
        var inviteCodeLink = document.getElementById('inviteCodeLink');
        var inviteCodeModal = document.getElementById('inviteCodeModal');
        var closeModalButtons = document.querySelectorAll('#closeModal, #closeModalBottom');

        // Handle settingsIcon and menu interactions
        settingsIcon.addEventListener('mouseover', function() {
            menu.classList.remove('opacity-0', 'pointer-events-none');
            menu.classList.add('opacity-100', 'pointer-events-auto');
        });

        settingsIcon.addEventListener('mouseleave', function() {
            setTimeout(function() {
                if (!menu.matches(':hover')) {
                    menu.classList.remove('opacity-100', 'pointer-events-auto');
                    menu.classList.add('opacity-0', 'pointer-events-none');
                }
            }, 300);
        });

        menu.addEventListener('mouseover', function() {
            menu.classList.remove('opacity-0', 'pointer-events-none');
            menu.classList.add('opacity-100', 'pointer-events-auto');
        });

        menu.addEventListener('mouseleave', function() {
            menu.classList.remove('opacity-100', 'pointer-events-auto');
            menu.classList.add('opacity-0', 'pointer-events-none');
        });

        // Handle inviteCodeLink click
        inviteCodeLink.addEventListener('click', function(event) {
            event.preventDefault();
            inviteCodeModal.classList.remove('opacity-0', 'pointer-events-none');
            inviteCodeModal.classList.add('opacity-100', 'pointer-events-auto');
        });

        // Handle close modal buttons
        closeModalButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                inviteCodeModal.classList.remove('opacity-100', 'pointer-events-auto');
                inviteCodeModal.classList.add('opacity-0', 'pointer-events-none');
            });
        });
    });
</script>

{{-- <script>
    //upload multiple files display
    function displaySelectedFiles(input) {
      const fileList = document.getElementById('fileList');
      fileList.innerHTML = ''; // Clear previous content

      for (let i = 0; i < input.files.length; i++) {
        const fileName = input.files[i].name;
        const listItem = document.createElement('div');
        listItem.textContent = fileName;
        fileList.appendChild(listItem);
      }
    }
  </script> --}}

<style>
    #floatingMenu2 {
        transition: opacity 0.5s ease-in-out;
    }

    .relative {
        position: relative;
    }

    #inviteCodeModal {
        transition: opacity 0.5s ease-in-out;
    }

    .editor-toolbar button {
        background: none;
        border: none;
        cursor: pointer;
        padding: 5px;
    }

    div[contenteditable][placeholder]:empty::before {
        content: attr(placeholder);
        color: #a0aec0;
        /* Adjust color to your preference */
        pointer-events: none;
        /* Ensures the placeholder text is not selectable */
        display: block;
        /* Other styles like font size, padding, etc. can be adjusted as needed */
    }

    .editor-toolbar button.active {
        background-color: #eaeaea;
        /* Light gray background when active */
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        tippy('[data-tippy-content]', {
            allowHTML: true,
            theme: 'light', // Optional: Change the tooltip theme (light, dark, etc.)
            placement: 'right-end', // Optional: Adjust tooltip placement
        });
    });



    // add announcement
    function checkContent() {
        var content = document.getElementById('editor').innerText.trim();
        var postButton = document.getElementById('postButton');
        postButton.disabled = content === '';
        postButton.classList.toggle('disabled', content === ''); // Add or remove 'disabled' class based on content
    }

    // Function to clear editor content
    function clearEditor() {
        var editor = document.getElementById('editor');
        editor.innerText = '';
        checkContent(); // Update button state after clearing
    }


    function formatText(command) {
        document.execCommand(command, false, null);
        // Update button state (e.g., toggle class to indicate active state)
        updateButtonState(command);
    }

    function updateButtonState(command) {
        const button = document.querySelector(`button[onclick="formatText('${command}')"]`);
        if (document.queryCommandState(command)) {
            button.classList.add('active');
        } else {
            button.classList.remove('active');
        }
    }

    function checkContent() {
        var content = document.getElementById('editor').innerText.trim();
        var postButton = document.getElementById('postButton');
        postButton.disabled = content === '';
        postButton.classList.toggle('disabled', content === ''); // Add or remove 'disabled' class based on content
    }



    // Function to handle posting content (example alert)
    function postContent() {
        var content = document.getElementById('editor').innerText.trim();
        alert(content);
    }


    document.addEventListener('selectionchange', () => {
        updateButtonState('bold');
        updateButtonState('italic');
        updateButtonState('underline');
    });




    //  UPDATE ANNOUNCEMENT




    // function formatText(command) {
    //     document.execCommand(command, false, null);
    // }

    function updateStatusToMissing(contentId) {
        // Make an AJAX request to update the status to Missing
        fetch(`/update-status/${contentId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                status: 'Missing'
            })
        }).then(response => {
            return response.json();
        }).then(data => {
            if (data.success) {
                document.getElementById('work-status').innerHTML = '<span class="text-red-600">Missing</span>';
            }
        }).catch(error => {
            console.error('Error updating status:', error);
        });
    }
</script>

<script>
    function logClasswork(event) {
        event.preventDefault();
        document.getElementById('content1').value = document.getElementById('editor1').innerHTML;
        document.getElementById('content2').value = document.getElementById('editor2').value;
        event.target.submit();
    }

    function displaySelectedFiles(input) {
        const fileList = document.getElementById('fileList');
        fileList.innerHTML = '';
        for (let i = 0; i < input.files.length; i++) {
            const file = input.files[i];
            const listItem = document.createElement('div');
            listItem.textContent = file.name;
            fileList.appendChild(listItem);
        }
    }

    function formatText(command) {
        document.execCommand(command, false, null);
    }
</script>
