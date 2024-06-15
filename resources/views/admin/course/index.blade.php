<x-admin-app-layout>
    <x-user-route-page-name :routeName="'admin.course.index'" />
    <x-section-div-style>
        <div class="h-full ml-14 mb-10 md:ml-48 ">
            <div class="max-w-full mx-auto  mt-10 sm:px-10 md:px-12 lg:px-10 xl:px-10 ">
                <div class="ml-5 font-bold text-md tracking-tight text-gray-600 uppercase">admin / manage course</div>
                    <div class="container mx-auto p-4">
                        <livewire:course-show-table />
                    </div>
                </div>
            </div>
        </div>
    </x-section-div-style>
</x-admin-app-layout>


