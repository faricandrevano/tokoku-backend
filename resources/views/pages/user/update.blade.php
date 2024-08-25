@extends('layouts.dashboard')

@section('main')
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-8 max-w-2xl">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Update a product</h2>
            <form action="/product/detail/{{ $product->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="name"
                            class="block mb-2 text-sm font-medium @error('name') text-red-700 dark:text-red-500 @else text-gray-900 dark:text-white @enderror">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                            class="@error('name') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-red-100 dark:border-red-400 @else bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @enderror"
                            placeholder="Type helper name">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                <span class="font-medium">Oops!</span> {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="price"
                            class="block mb-2 text-sm font-medium @error('price') text-red-700 dark:text-red-500 @else text-gray-900 dark:text-white @enderror">Price</label>
                        <div class="flex">
                            <span
                                class="inline-flex items-center px-3 text-sm border border-r-0 rounded-l-md @error('price') text-red-900 bg-red-200 border-red-300 dark:bg-red-600 dark:text-red-400 dark:border-red-600 @else text-gray-900 bg-gray-200 border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600 @endif">
                                Rp
                            </span>
                            <input type="number" step="0.1" min="0" id="price" name="price" value="{{ old('price', $product->price) }}"
                                class="rounded-none rounded-r-lg border block flex-1 min-w-0 w-full text-sm p-2.5 @error('price') bg-red-50 text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300 dark:bg-red-700 dark:border-red-600 dark:placeholder-red-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500 @else bg-gray-50 text-gray-900 focus:ring-blue-500 focus:border-blue-500 border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @endif"
                                placeholder="0.0" />
                            @error('price')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                    <span class="font-medium">Oops!</span> {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                        {{-- <div class="w-full">
                                <label for="category_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                <select
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    name="category_id" id="category_id" required>
                                    @foreach ($categories as $item)
                                        @if (old('category_id', $product->category_id) === $item->id)
                                            <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                        </div> --}}
                        <div class="sm:col-span-2">
                            <label for="desc"
                                class="block mb-2 text-sm font-medium @error('desc') text-red-700 dark:text-red-500 @else text-gray-900 dark:text-white @enderror">Description</label>
                            <textarea id="desc" rows="4" name="desc"
                                class="block p-2.5 w-full @error('desc') text-sm text-red-900 bg-red-50 rounded-lg border border-red-300 focus:ring-red-500 focus:border-red-500 dark:bg-red-700 dark:border-red-600 dark:placeholder-red-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500 @else text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @endif"
                                    placeholder="Write your description here...">{{ old('desc', $product->desc) }}</textarea>
                                @error('desc')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                        <span class="font-medium">Oops!</span> {{ $message }}
                                    </p>
                                @enderror
                        </div>
                        <div class="w-full">
                                        <label class="relative inline-flex items-center mb-4 cursor-pointer">
                                            <input type="checkbox" name="is_new" class="sr-only peer" value="1" {{ old('is_new', $product->is_new) == 1 ? 'checked' : '' }} />
                                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                            </div>
                                            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">New Product</span>
                                        </label>
                                    </div>
                                <div class="w-full">
                                        <label class="relative inline-flex items-center mb-4 cursor-pointer">
                                            <input type="checkbox" name="is_popular" class="sr-only peer" value="1" {{ old('is_popular', $product->is_popular) == 1 ? 'checked' : '' }} />
                                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                            </div>
                                            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Popular Product</span>
                                        </label>
                                    </div>
                                <div class="w-full">
                                        <label class="relative inline-flex items-center mb-4 cursor-pointer">
                                            <input type="checkbox" name="is_publish" class="sr-only peer" value="1" {{ old('is_publish', $product->is_publish) == 1 ? 'checked' : '' }} />
                                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                            </div>
                                            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Publish</span>
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="mt-8 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">Update product</button>
                            </form>
                        </div>
                    </section>
@endsection
