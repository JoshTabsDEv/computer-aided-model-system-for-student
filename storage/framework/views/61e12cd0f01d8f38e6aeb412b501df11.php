<form wire:submit.prevent="submit" enctype="multipart/form-data" class="p-6 max-w-lg mx-auto">
    <?php echo csrf_field(); ?>
    <div x-data="{ option: '' }">
        <!-- Form Fields -->
        
        <div class="relative mt-4">
            <select x-model="option" class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:border-blue-500 hover:bg-gray-100">
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
            <input wire:model="content1" type="text" class="text-black" placeholder="Enter practice problem details">
            <!-- Add other elements specific to Practice Problems -->
        </div>

        <div x-show="option === 'Assignment'">
            <h2>Assignments UI</h2>
            <input wire:model="content1" type="text" class="text-black" placeholder="Enter assignment details">
            <!-- Add other elements specific to Assignments -->
        </div>

        <div x-show="option === 'Module'">
            <h2>Module UI</h2>
            <input wire:model="content1" type="text" class="text-black" placeholder="Enter module details">
            <!-- Add other elements specific to Modules -->
        </div>

        <div class="mt-4">
            <label for="deadline" class="block text-gray-700">Set Deadline:</label>
            <input type="datetime-local" wire:model="deadline" id="deadline" class="block w-full border border-gray-300 rounded py-2 px-3 mt-1 focus:outline-none focus:border-blue-500 text-black">
        </div>

        <div class="mt-4">
            <label class="block text-gray-700">Classwork File</label>
            <input type="file" wire:model="files" multiple class="block w-full text-sm text-gray-500 file:me-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700">
            
        </div>

        <div class="mt-4">
            <label class="block text-gray-700">Solution (*only if practice problem is selected)</label>
            <input type="file" wire:model="solution_files" multiple class="block w-full text-sm text-gray-500 file:me-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700">
            
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
<?php /**PATH C:\Users\Joshua Tabura\Desktop\computer-aided-model-system-for-student\resources\views\livewire\classwork-form.blade.php ENDPATH**/ ?>