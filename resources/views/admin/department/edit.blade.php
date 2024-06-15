<x-admin-app-layout>
<x-user-route-page-name :routeName="'admin.department.edit'" />
    <div class="min-h-screen flex flex-col flex-auto flex-shrink-0 antialiased bg-neutral-200 text-black dark:text-white">
        <div class="h-full ml-14 mb-10 md:ml-48 ">
            <div class="max-w-full mx-auto  mt-10 sm:px-10 md:px-12 lg:px-10 xl:px-10 ">
                <div class="ml-5 font-bold text-md tracking-tight text-gray-600 uppercase">admin / edit department</div>
                    <div class="container mx-auto p-4">
                        <div class="bg-white shadow-lg rounded-md p-5 sm:p-6 md:p-8 lg:p-10 text-black font-medium">
                            <div class="flex justify-end mb-4">
                                <a href="{{ route('admin.department.index') }}"><button class="bg-blue-500 text-white px-4 py-2 rounded-md"><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i> Back to list</button></a>
                            </div>
                            <form action="{{ route('admin.department.update', $department->id) }}" method="POST" class="">
                            <x-caps-lock-detector />
                                @csrf
                                @method('PUT')

                                <div class="mb-4">
                                    <label for="department_name" class="block text-gray-700 text-md font-bold mb-2">Department Name:</label>
                                    <input type="text" name="department_name" id="department_name" value="{{ old('department_name', $department->department_name) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required autofocus>
                                    <x-input-error :messages="$errors->get('department_name')" class="mt-2" />
                                </div>
                                <div class="mb-4">
                                    <label for="department_description" class="block text-gray-700 text-md font-bold mb-2">Department Description:</label>
                                    <input type="text" name="department_description" id="department_description" value="{{ old('department_description', $department->department_description) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                    <x-input-error :messages="$errors->get('department_description')" class="mt-2" />
                                </div>
                                <div class="flex  mb-4 mt-5 justify-center">
                                        <button type="submit" class="w-80 bg-blue-500 text-white px-4 py-2 rounded-md">
                                            <i class="fa-solid fa-pen" style="color: #ffffff;"></i> Save Update
                                        </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>