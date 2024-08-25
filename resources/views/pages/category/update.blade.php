@extends('layouts.dashboard')

@section('main')
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-8 max-w-2xl">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Update a category</h2>
            <form action="/product/category/{{ $category->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="name"
                            class="block mb-2 text-sm font-medium @error('name') text-red-700 dark:text-red-500 @else text-gray-900 dark:text-white @enderror">Channel
                            Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}"
                            class="@error('name') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-red-100 dark:border-red-400 @else bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @enderror"
                            placeholder="Type helper name">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                <span class="font-medium">Oops!</span> {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="desc"
                            class="block mb-2 text-sm font-medium @error('description') text-red-700 dark:text-red-500 @else text-gray-900 dark:text-white @enderror">Description</label>
                        <textarea id="desc" rows="4" name="desc"
                            class="block p-2.5 w-full @error('description') text-sm text-red-900 bg-red-50 rounded-lg border border-red-300 focus:ring-red-500 focus:border-red-500 dark:bg-red-700 dark:border-red-600 dark:placeholder-red-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500 @else text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @endif"
                            placeholder="Write your description here...">{{ old('desc', $category->desc) }}</textarea>
                        @error('desc')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                <span class="font-medium">Oops!</span> {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                <button type="submit"
                            class="mt-8 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                            Update product
                        </button>
                    </form>
                </div>
            </section>
@endsection
