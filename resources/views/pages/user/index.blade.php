@extends('layouts.dashboard')

@section('main')
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <div class="max-w-screen-xl px-4 py-8">
            <!-- Start coding here -->
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Transactions</h2>
            <div class="bg-white pb-8 dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center" action="{{ route('transaction') }}" method="GET">
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
                                <th scope="col" class="px-4 py-3">Code</th>
                                <th scope="col" class="px-4 py-3">Product</th>
                                <th scope="col" class="px-4 py-3">Address</th>
                                <th scope="col" class="px-4 py-3">Total Price</th>
                                <th scope="col" class="px-4 py-3">User</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">Created At</th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($user->isNotEmpty())
                                @foreach ($user as $item)
                                    <tr class="border-b dark:border-gray-700">
                                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                        <th scope="row"
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->code }}
                                        </th>
                                        
                                        <td class="px-4 py-3">{{ $item->address }}</td>
                                        <td class="px-4 py-3">Rp{{ number_format($item->total, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3">{{ $item->user }}</td>
                                        <td class="px-4 py-3">
                                            @if ($item->status === 'CONFIRMED' || $item->status === 'PROGRESS' || $item->status === 'WAITING')
                                                <div
                                                    class="inline-flex items-center bg-orange-100 text-orange-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-orange-900 dark:text-orange-300">
                                                    <span class="w-2 h-2 mr-1 bg-orange-500 rounded-full"></span>
                                                    {{ $item->status }}
                                                </div>
                                            @elseif ($item->status === 'SUCCESS')
                                                <div
                                                    class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                                    <span class="w-2 h-2 mr-1 bg-green-500 rounded-full"></span>
                                                    {{ $item->status }}
                                                </div>
                                            @else
                                                <div
                                                    class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                                    <span class="w-2 h-2 mr-1 bg-red-500 rounded-full"></span>
                                                    {{ $item->status }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">{{ $item->created_at }}</td>
                                        <td class="px-4 py-3 flex items-center justify-end">
                                            <button id="confirmButton" onclick="showId('{{ $item->id }}')"
                                                data-modal-toggle="confirmModal"
                                                class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                                type="button">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                    viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="border-b dark:border-gray-700">
                                    <td colspan="9" class="px-4 py-3">Not found transaction.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="p-4">
                    {{ $user->links() }}
                </div>
            </div>
        </div>
    </section>

    @include('pages.transaction.confirm')
@endsection
