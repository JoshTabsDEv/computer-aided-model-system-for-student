

<form wire:submit.prevent="submit" enctype="multipart/form-data" class="p-6 max-w-lg mx-auto">
    @csrf
    <div x-data="{ option: '' }">
        <!-- Form Fields -->
        
        <div class="relative mt-4">
            <select x-model="option"  wire:model="selectedOption" class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:border-blue-500 hover:bg-gray-100">
                <option value="">Select an Option</option>
                <option value="Practice Problem">Practice Problems</option>
                <option value="Assignment">Assignments</option>
                <option value="Module">Module</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9 11l3 3 3-3h-6z"/></svg>
            </div>
        </div>

        <div x-show="option === 'Practice Problem'">
            <h2>Practice Problems UI</h2>
            <input wire:model="content1" type="hidden" class="text-black" id="hiddenContent">
            {{-- <div  id="editor" contenteditable="true" class="border p-2 mt-2 rounded h-40 bg-white overflow-y-auto text-black" placeholder="Enter your announcement here..." oninput="updateHiddenContent()"></div>
            
            <div class="editor-toolbar">
                <button type="button" onclick="formatText('bold')" title="Bold" class="text-black" style=""><strong>B</strong></button>
                <button type="button" onclick="formatText('italic')" title="Italic" class="text-black"><em>I</em></button>
                <button type="button" onclick="formatText('underline')" title="Underline" class="text-black"><u>U</u></button>
            </div> --}}
            <!-- Add other elements specific to Practice Problems -->
        </div>

        <div x-show="option === 'Assignment'">
            <h2>Assignments UI</h2>
            {{-- <input wire:model="content1" type="text" class="text-black" placeholder="Enter assignment details"> --}}
            <!-- Add other elements specific to Assignments -->
        </div>

        <div x-show="option === 'Module'">
            <h2>Module UI</h2>
            {{-- <input wire:model="content1" type="text" class="text-black" placeholder="Enter module details"> --}}
            <!-- Add other elements specific to Modules -->
        </div>

        <div class="mt-4">
            <label for="deadline" class="block text-gray-700">Set Deadline:</label>
            <input type="datetime-local" wire:model="deadline" id="deadline" class="block w-full border border-gray-300 rounded py-2 px-3 mt-1 focus:outline-none focus:border-blue-500 text-black">
        </div>

        <div class="mt-4">
            <label class="block text-gray-700">Classwork File</label>
            <input type="file" wire:model="files[]" multiple class="block w-full text-sm text-gray-500 file:me-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700">
            @error('files.*') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <label class="block text-gray-700">Solution (*only if practice problem is selected)</label>
            <input type="file" wire:model="solution_files[]" multiple class="block w-full text-sm text-gray-500 file:me-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700">
            {{-- @error('solution_files.*') <span class="text-red-500">{{ $message }}</span> @enderror --}}
        </div>

        <div class="mt-4">
            <button type="button" wire:click="addInputField" class="bg-green-500 text-white px-4 py-2 rounded mt-4">
                <i class="fas fa-plus"></i> Add Input Field
            </button>
        </div>

        <div class="flex justify-end mt-4 w-full">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full">Submit</button>
        </div>
    </div>
</form>



<script>
    
   

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


    document.addEventListener('selectionchange', () => {
            updateButtonState('bold');
            updateButtonState('italic');
            updateButtonState('underline');
        });

</script>

