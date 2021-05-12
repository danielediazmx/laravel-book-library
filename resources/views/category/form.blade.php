<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (isset($category))
                {{ __('Edit Category') }}
            @else
                {{ __('New Category') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white mt-5 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Or change a checkbox color using text color utilities: -->
                    <form action="{{ route('category.store') }}" method="POST">
                        @if (isset($category))
                            @method('PUT')
                        @endif

                        @csrf
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label for="name">Name:</label>
                                <input type="text" class="rounded text-green-500 w-full" name="name" id="name" required autofocus/>
                            </div>
                            <div>
                                <label for="description">Description:</label>
                                <input type="text" class="rounded text-green-500 w-full" name="description"
                                       id="description" required/>
                            </div>
                        </div>
                        <div class="clear-both"></div>
                        <hr class="mt-10 mb-10">
                        <x-button class="ml-3">
                            {{ __('Save') }}
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
