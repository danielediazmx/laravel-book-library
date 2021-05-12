<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="float-right">
                <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                   href="{{ route('book.create') }}">
                    + NEW BOOK
                </a>
            </div>
            <div class="clear-both"></div>
            <div class="bg-white mt-5 overflow-hidden shadow-sm sm:rounded-lg">
                @if (session()->has('message'))
                    <div class="m-7 bg-{!! session('type') !!}-800 text-white p-5">
                        {!! session('message') !!}
                    </div>
                @endif
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table-auto w-full">
                        <thead>
                        <tr>
                            <th class="text-left">Name / Author</th>
                            <th class="text-left">Category</th>
                            <th class="text-left">Status</th>
                            <th class="text-left">Borrowed</th>
                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td>{{ $book->name }} / {{ $book->author }}</td>
                                <td>{{ $book->category->name }}</td>
                                <td>{{ $book->available ? 'Available' : 'Unavailable' }}</td>
                                <td>
                                    @if ($book->isBorrowed())
                                        {{ $book->isBorrowed()->user->name }}
                                    @else
                                        No
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a class="inline-flex text-right px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                       href="{{ route('book.edit', $book->id) }}">
                                        {{ __('Edit') }}
                                    </a>
                                    <a class="inline-flex text-right px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                       href="{{ route('book.request', $book->id) }}">
                                        {{ __('Request') }}
                                    </a>
                                    <a href="javascript:;" data-id="{{ $book->id }}"
                                       class="modal-button inline-flex text-right px-4 py-2 bg-pink-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                        {{ __('Change Availability') }}
                                    </a>
                                    <form class="inline-flex" action="{{ route('book.destroy', $book->id) }}"
                                          method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <x-button class="ml-3">
                                            {{ __('Delete') }}
                                        </x-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div
        class="modal opacity-0 pointer-events-none absolute w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay absolute w-full h-full bg-black opacity-25 top-0 left-0 cursor-pointer"></div>
        <div class="absolute w-1/2 h-32 bg-white rounded-sm shadow-lg flex items-center justify-center text-2xl">
            <div class="modal-button-confirm inline-flex text-right px-4 py-2 bg-pink-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                {{ __('Confirm') }}
            </div>
        </div>
    </div>
    <script>
        const button = document.querySelector('.modal-button')
        button.addEventListener('click', toggleModal)

        const button_confirm = document.querySelector('.modal-button-confirm')
        button_confirm.addEventListener('click', confirmModal)

        const overlay = document.querySelector('.modal-overlay')
        overlay.addEventListener('click', toggleModal)

        var selected_book = null;

        function toggleModal() {
            let input = this;
            selected_book = input.getAttribute('data-id');

            const modal = document.querySelector('.modal')
            modal.classList.toggle('opacity-0')
            modal.classList.toggle('pointer-events-none')
        }

        function confirmModal() {
            location.href = "{{ route('book.change_availability', $book->id) }}"
        }
    </script>
</x-app-layout>
