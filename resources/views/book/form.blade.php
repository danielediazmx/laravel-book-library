<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(isset($book) ? 'Edit book' : 'New book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white mt-5 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Or change a checkbox color using text color utilities: -->
                    <form
                        method="POST"
                        @if (isset($book))
                        action="{{ route('book.update', $book->id) }}">
                        @method('PUT')
                        @else
                            action="{{ route('book.store') }}">
                        @endif
                        @csrf
                        <div class="grid grid-cols-3 gap-6">
                            <div>
                                <label for="name">Name:</label>
                                <input type="text" class="rounded text-green-500 w-full" name="name" id="name"
                                       value="{{ $book->name ?? '' }}"
                                       required autofocus/>
                            </div>
                            <div>
                                <label for="author">Author:</label>
                                <input type="text" class="rounded text-green-500 w-full" name="author"
                                       value="{{ $book->author ?? '' }}"
                                       id="author" required/>
                            </div>
                            <div>
                                <label for="category_id">Category:</label>
                                <select class="px-4 py-3 rounded-full w-full" name="category_id" id="category_id"
                                        required>
                                    @if (count($categories) == 0)
                                        <option value="" selected disabled>
                                            You need to create a category first
                                        </option>
                                    @endif
                                    @foreach($categories as $category)
                                        <option
                                            value="{{ $category->id }}" {{ isset($book) && $book->name ? 'selected':'' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
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
