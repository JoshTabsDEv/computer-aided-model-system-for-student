<x-teacher-app-layout>
    <x-user-route-page-name 
        :routeName="'teacher.teacher.index'"
        :courseDetails="[
            'course_name' => $manageCourse->course->course_name,
            'time' => date('g:i A', strtotime($manageCourse->class_start_time)) . ' - ' . date('g:i A', strtotime($manageCourse->class_end_time)),
            'days_of_the_week' => $manageCourse->days_of_the_week,
            'section' => $manageCourse->section,
        ]"
    />
    <x-teacher.section-div-style>
        <div class="container ml-1.5 sm:mx-auto p-4 relative">
                <!-- heading -->
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
            <!-- Menu's -->
            <div id="floatingMenu" class="z-10 fixed right-4 top-1/2 transform -translate-y-1/2 bg-white shadow-lg rounded-md p-5 sm:p-6 md:p-7 lg:p-3 border-2 border-gray-400 text-black font-medium opacity-0 pointer-events-none transition-all duration-500">
                <div class="text-center font-bold">View</div>
                <hr class="border-gray-300">
                <a href="#" class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-200">
                    <i class="fa-solid fa-file"></i> Classwork
                </a>
                <hr class="border-gray-300">
                <a href="#" class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-200">
                    <i class="fa-solid fa-users"></i> People
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
            <!-- Toggle Button for Adding of Components -->
            <div id="toggleButton2" class="fixed -right-1 top-1/2 transform -translate-y-1/2 z-50 bg-white text-gray-500 p-2 rounded-full shadow-md cursor-pointer">
                <svg id="toggleIcon2" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l7-7-4-4-7 7v4h4z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 13l-6-6m6 6L13 6m0 0l-3 3"/>
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
                        <hr  class="w-full border border-gray-500">
                        <div class="p-2">Module</div>
                    </div>
                    <div class="flex justify-start w-72 h-24 p-2 bg-white rounded-[5px] hidden sm:block md:w-52 lg:w-72">
                        <div class="w-full h-6">
                            <i class="fa-solid fa-check" style="color: #000000;"></i>
                            On-going
                        </div>
                        <hr  class="w-full border border-gray-500">
                    </div>   
                </div>
                <div class="flex flex-col w-full md:ml-5 mb-5 space-y-5">
                    <div x-data="{ expanded: false, content: '' }" class="w-full   " >
                        <div @click="expanded = !expanded" class="rounded-[5px] p-4 bg-white  cursor-pointer" :class="expanded ? 'hidden' : 'h-20'">
                            <div  class="flex items-center">
                                <a href="#" class="block">
                                    <!-- User Image Logic -->
                                    <img  src="{{ Auth::user()->teacher_photo && Storage::exists('public/teacher_photos/' . Auth::user()->teacher_photo) ? asset('storage/teacher_photos/' . Auth::user()->teacher_photo) : asset('assets/img/user.png') }}" class="shadow-xl border-[.1px] border-gray-500 rounded-full w-9 object-contain mx-auto">
                                </a>
                                <div class="flex justify-center p-3.5 ml-2 text-sm text-gray-500">Announce something to your class</div>
                            </div>
                        </div>
                        <div x-show="expanded" class="bg-gray-100 p-4 rounded-lg relative" x-cloak>
                            <div class="text-gray-500">
                                Announcement for your student..
                            </div>
                            <div id="editor" contenteditable="true" class="border p-2 mt-2 rounded h-40 bg-white overflow-y-auto"
                                placeholder="Enter your announcement here..." oninput="checkContent()"></div>
                            <div class="editor-toolbar">
                                <button onclick="formatText('bold')" title="Bold"><strong>B</strong></button>
                                <button onclick="formatText('italic')" title="Italic"><em>I</em></button>
                                <button onclick="formatText('underline')" title="Underline"><u>U</u></button>
                            </div>
                            <div class="flex justify-end mt-2">
                                <button @click="expanded = false; content=''" class="bg-red-500 text-white px-4 py-2 rounded mr-2">Cancel</button>
                                <button onclick="postContent()" id="postButton" disabled class="bg-blue-500 text-white px-4 py-2 rounded disabled">Post</button>
                            </div>
                        </div>
                    </div>
                    @if(count($announcements) > 0)
                        @foreach($announcements as $announcement)
                            <div class="flex bg-white w-full h-20 rounded-[5px] p-4">
                                <div class="flex items-center">
                                    <img  src="{{ Auth::user()->teacher_photo && Storage::exists('public/teacher_photos/' . Auth::user()->teacher_photo) ? asset('storage/teacher_photos/' . Auth::user()->teacher_photo) : asset('assets/img/user.png') }}" class="shadow-xl border-[.1px] border-gray-500 rounded-full w-9 object-contain mx-auto">
                                </div>
                                <div class="flex justify-between w-full">
                                    <div class="text-md mt-2 text-tight md:mt-2.5  lg:mt-2 lg:p-1.5 lg:text-md ml-2 text-md text-black w-full">
                                        Posted an announcement
                                    </div>
                                    <div x-data="{ showModal: false, announcementId: {{ $announcement->id }} }">
                                        <div class="p-2.5 w-28 ml-2 mr-3 text-sm text-center text-gray-500 border rounded-md cursor-pointer  border-gray-400 hover:border-green-500 hover:text-black"
                                            @click="showModal = true">Click to view</div>

                                        <!-- Modal -->
                                        <div x-show="showModal"
                                            x-transition:enter="transition ease-out duration-300"
                                            x-transition:enter-start="opacity-0 transform scale-95"
                                            x-transition:enter-end="opacity-100 transform scale-100"
                                            x-transition:leave="transition ease-in duration-200"
                                            x-transition:leave-start="opacity-100 transform scale-100"
                                            x-transition:leave-end="opacity-0 transform scale-95"
                                            @click.away="showModal = false"
                                            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                            <!-- Modal content -->
                                            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md">
                                                <!-- Modal header -->
                                                <div class="flex justify-between items-center border-b mb-4">
                                                    <h2 class="text-xl font-semibold">Announcement # 1{{ $announcement->id }}</h2>
                                                    <button @click="showModal = false" class="text-lg hover:text-red-500">×</button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="text-sm text-gray-700">
                                                    <!-- Modal content goes here -->
                                                    <span class="text-black text-lg">{{ $announcement->announcement }}</span>
                                                </div>
                                                <div class="flex justify-end mt-4">
                                                    <button class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white text-gray-700 rounded-md"
                                                            @click="showModal = false">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div x-data="{ open: false }" class="relative inline-block text-left">
                                        <div class="dropdown">
                                            <button @click="open = !open" type="button" class="z-50 inline-flex items-center p-2.5 ml-2 mt-2 text-sm text-gray-500 rounded-md cursor-pointer hover:text-black hover:shadow-xl focus:outline-none">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div x-show="open" @click.away="open = false" class="dropdown-content absolute right-0 mt-2 w-32 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none">
                                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:rounded-md hover:text-black hover:bg-gray-100">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                    <div class="flex bg-white w-full h-20 rounded-[5px] p-4 ">
                        <div class="flex items-center mx-auto">
                            <div class="p-3.5 w-full ml-2 text-md text-black">No posted announcement / materials or modules</div>
                        </div>
                    </div>


                    @endif
                </div>
            </div>
            <!-- MODAL -->
            <div id="inviteCodeModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 opacity-0 pointer-events-none transition-opacity duration-500">
                <div class="bg-white rounded-lg p-6 max-w-md mx-auto">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold">Invite Code</h3>
                        <button id="closeModal" class="text-gray-500 hover:text-gray-800">
                            <i class="fa-solid fa-times"></i>
                        </button>
                    </div>
                    <p>Your invite code is: <strong>XYZ123</strong></p>
                    <button id="closeModalBottom" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </x-teacher.section-div-style>
</x-teacher-app-layout>

<x-show-hide-sidebar
    toggleButtonId="toggleButton"
    sidebarContainerId="sidebarContainer"
    dashboardContentId="dashboardContent"
    toggleIconId="toggleIcon"
/>

<script>
    document.addEventListener('DOMContentLoaded', function () {
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

<style>
    #floatingMenu {
        transition: opacity 0.5s ease-in-out;
    }

    #toggleButton2 {
        transition: opacity 0.5s ease-in-out;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var settingsIcon = document.getElementById('settingsIcon');
        var menu = document.getElementById('floatingMenu1');
        var inviteCodeLink = document.getElementById('inviteCodeLink');
        var inviteCodeModal = document.getElementById('inviteCodeModal');
        var closeModalButtons = document.querySelectorAll('#closeModal, #closeModalBottom');

        settingsIcon.addEventListener('mouseover', function() {
            menu.classList.remove('opacity-0', 'pointer-events-none');
            menu.classList.add('opacity-100', 'pointer-events-auto');
        });

        menu.addEventListener('mouseleave', function() {
            menu.classList.remove('opacity-100', 'pointer-events-auto');
            menu.classList.add('opacity-0', 'pointer-events-none');
        });

        menu.addEventListener('mouseover', function() {
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
        inviteCodeLink.addEventListener('click', function(event) {
            event.preventDefault();
            inviteCodeModal.classList.remove('opacity-0', 'pointer-events-none');
            inviteCodeModal.classList.add('opacity-100', 'pointer-events-auto');
        });

        closeModalButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                inviteCodeModal.classList.remove('opacity-100', 'pointer-events-auto');
                inviteCodeModal.classList.add('opacity-0', 'pointer-events-none');
            });
        });
    });
</script>

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
    color: #a0aec0; /* Adjust color to your preference */
    pointer-events: none; /* Ensures the placeholder text is not selectable */
    display: block;
    /* Other styles like font size, padding, etc. can be adjusted as needed */
}

 .editor-toolbar button.active {
        background-color: #eaeaea; /* Light gray background when active */
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

// Function to handle posting content (example alert)
function postContent() {
    var content = document.getElementById('editor').innerText.trim();
    alert(content);
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
</script>