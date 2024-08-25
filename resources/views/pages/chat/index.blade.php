@extends('layouts.dashboard')

@section('main')
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <div class="max-w-screen-xl px-4 py-8">
            <!-- Start coding here -->
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">List of Chat Room</h2>
            <div class="bg-white pb-8 dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center" action="{{ route('chat') }}" method="GET">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                        fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="simple-search" name="search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Search" value="{{ request('search') }}">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">#</th>
                                <th scope="col" class="px-4 py-3">User</th>
                                <th scope="col" class="px-4 py-3">Total Message</th>
                                <th scope="col" class="px-4 py-3">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($rooms->isNotEmpty())
                                @foreach ($rooms as $item)
                                    <tr class="border-b dark:border-gray-700">
                                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3">
                                            <a href="/chat/{{ $item->id }}">
                                                <div class="flex items-center space-x-4">
                                                    <div class="flex-shrink-0">
                                                        @if ($item->user->image)
                                                            <img class="w-8 h-8 rounded-full" src="{{ $item->user->image }}"
                                                                alt="Neil image">
                                                        @else
                                                            <svg aria-hidden="true" class="w-8 h-8" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path
                                                                    d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                                                            </svg>
                                                        @endif

                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <p
                                                            class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                            {{ $item->user->name }}
                                                        </p>
                                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                            {{ $item->user->email }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="px-4 py-3">{{ count($item->chats) }}</td>
                                        <td class="px-4 py-3">{{ $item->created_at }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="border-b dark:border-gray-700">
                                    <td colspan="4" class="px-4 py-3">Not found chat.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="p-4">
                    {{ $rooms->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
