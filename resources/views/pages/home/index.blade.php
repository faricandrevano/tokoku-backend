@extends('layouts.dashboard')

@section('main')
    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-screen-xl px-4 py-8">
            <div class="grid w-full grid-cols-1 gap-4 xl:grid-cols-2 2xl:grid-cols-3">
                <div
                    class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                    <div class="w-full">
                        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Products</h3>
                        <span
                            class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">{{ $products }}</span>
                        <p class="flex items-center text-base font-normal text-gray-500 dark:text-gray-400">
                            Total item products
                        </p>
                    </div>
                    <div class="w-full" id="new-products-chart"></div>
                </div>
                <div
                    class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                    <div class="w-full">
                        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Customers</h3>
                        <span
                            class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">{{ $customers }}</span>
                        <p class="flex items-center text-base font-normal text-gray-500 dark:text-gray-400">
                            Total active customers
                        </p>
                    </div>
                    <div class="w-full" id="week-signups-chart"></div>
                </div>
                <div
                    class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                    <div class="w-full">
                        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Transaction</h3>
                        <span
                            class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">{{ $counts }}</span>
                        <p class="flex items-center text-base font-normal text-gray-500 dark:text-gray-400">
                            Total progress transactions
                        </p>
                    </div>
                    <div class="w-full" id="new-products-chart"></div>
                </div>
                <div
                    class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                    <div class="w-full">
                        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Chat</h3>
                        <span
                            class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">{{ $rooms }}</span>
                        <p class="flex items-center text-base font-normal text-gray-500 dark:text-gray-400">
                            Total room chats
                        </p>
                    </div>
                    <div class="w-full" id="week-signups-chart"></div>
                </div>
            </div>
            <div class="overflow-x-auto mt-8">
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
                        </tr>
                    </thead>
                    <tbody>
                        @if ($transactions->isNotEmpty())
                            @foreach ($transactions as $item)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                    <th scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $item->code }}
                                    </th>
                                    <td class="px-4 py-3">
                                        <ol
                                            class="max-w-md space-y-1 text-gray-500 list-decimal list-inside dark:text-gray-400">
                                            @foreach ($item->products as $product)
                                                <li>
                                                    <span
                                                        class="font-semibold text-gray-900 dark:text-white">{{ $product->product->name }}</span>
                                                    with <span
                                                        class="font-semibold text-gray-900 dark:text-white">{{ $product->qty }}</span>
                                                    item
                                                </li>
                                            @endforeach
                                        </ol>
                                    </td>
                                    <td class="px-4 py-3">{{ $item->address }}</td>
                                    <td class="px-4 py-3">Rp{{ number_format($item->total, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3">{{ $item->user->name }}</td>
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
                                </tr>
                            @endforeach
                        @else
                            <tr class="border-b dark:border-gray-700">
                                <td colspan="8" class="px-4 py-3">Not found transaction.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
