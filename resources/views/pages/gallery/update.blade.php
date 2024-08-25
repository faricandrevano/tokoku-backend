@extends('layouts.dashboard')

@section('main')
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-8 max-w-2xl">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Update a category</h2>
            <form action="/product/gallery/{{ $gallery->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="product_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product</label>
                        <select
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            name="product_id" id="product_id" required>
                            @foreach ($products as $item)
                                @if (old('product_id', $gallery->product_id) === $item->id)
                                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <div class="bg-white dark:bg-gray-700 px-4 py-5 rounded-lg border @error('image') border-red-500 dark:border-red-400 @else border-gray-300 dark:border-gray-600 @endif text-center w-48">
                <div class="mb-4">
                    @if ($gallery->url)
                        <img id="preview-image" class="w-auto mx-auto rounded-lg object-cover object-center h-24"
                        src="{{ $gallery->url }}"
                        alt="Avatar Upload" />
                    @else
                        <img id="preview-image" class="w-auto mx-auto rounded-lg object-cover object-center h-24"
                        src="https://static.vecteezy.com/system/resources/previews/005/544/718/original/profile-icon-design-free-vector.jpg"
                        alt="Avatar Upload" />
                    @endif
                </div>
                <label class="cursor-pointer mt-6">
                    <span
                        class="mt-2 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Select
                        Image</span>
                    <input type="file" class="hidden" name="url" onchange="previewImage(event)" accept="image/jpeg, image/png"/>
                </label>
            </div>
            @error('url')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    <span class="font-medium">Oops!</span> {{ $message }}
                </p>
            @enderror
            </div>
                </div>
        <button type="submit"
                            class="mt-8 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                            Update Gallery
                            </button>
            </form>
        </div>
    </section>

    <script>
        function previewImage(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var previewImage = document.getElementById('preview-image');
                    previewImage.src = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
