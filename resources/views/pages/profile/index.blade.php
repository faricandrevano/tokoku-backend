@extends('layouts.dashboard')

@section('main')
    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-2xl px-8 py-8">
            <h2 class="mb-8 text-xl font-bold text-gray-900 dark:text-white">My profile</h2>
            <form action="{{ route('profile') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="center mx-auto">
                    <div class="bg-white dark:bg-gray-700 px-4 py-5 rounded-lg border @error('image') border-red-500 dark:border-red-400 @else border-gray-300 dark:border-gray-600 @endif text-center w-48">
                        <div class="mb-4">
                            @if ($user->image)
                                <img id="preview-image" class="w-auto mx-auto rounded-lg object-cover object-center h-24"
                                src="{{ $user->image }}"
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
                                Avatar</span>
                            <input type="file" class="hidden" name="image" onchange="previewImage(event)" accept="image/jpeg, image/png"/>
                        </label>
                    </div>
                    @error('image')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            <span class="font-medium">Oops!</span> {{ $message }}
                        </p>
                    @enderror
                </div>


                <div class="grid
                        gap-4 my-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                        <div class="sm:col-span-2">
                            <label for="name"
                                class="block mb-2 text-sm font-medium @error('name') text-red-700 dark:text-red-500 @else text-gray-900 dark:text-white @enderror">My
                                name</label>
                            <input type="text" name="name" id="name"
                                class="@error('name') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-red-100 dark:border-red-400 @else bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @enderror"
                                value="{{ old('name', $user->name) }}" placeholder="name">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                    <span class="font-medium">Oops!</span> {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="username"
                                class="block mb-2 text-sm font-medium @error('username') text-red-700 dark:text-red-500 @else text-gray-900 dark:text-white @enderror">Username</label>
                            <input type="text" name="username" id="username"
                                class="@error('username') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-red-100 dark:border-red-400 @else bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @enderror"
                                value="{{ old('username', $user->username) }}" placeholder="username">
                            @error('username')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                    <span class="font-medium">Oops!</span> {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="phone"
                                class="block mb-2 text-sm font-medium @error('phone') text-red-700 dark:text-red-500 @else text-gray-900 dark:text-white @enderror">Phone
                                number</label>
                            <input type="text" name="phone" id="phone"
                                class="@error('phone') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-red-100 dark:border-red-400 @else bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @enderror"
                                value="{{ old('phone', $user->phone) }}" placeholder="phone number">
                            @error('phone')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                    <span class="font-medium">Oops!</span> {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <button type="submit"
                        class="mt-4 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">Update
                        profile</button>
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
