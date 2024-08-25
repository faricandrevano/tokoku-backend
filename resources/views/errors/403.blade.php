@extends('layouts.simple')

@section('main')
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center">
                <h1 class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-primary-600 dark:text-primary-500">
                    403</h1>
                <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">You don't have
                    access.</p>
                <p class="mb-8 text-lg font-light text-gray-500 dark:text-gray-400">Please select help to ask questions or
                    request access permission. </p>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit"
                        class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-14 py-2.5 text-center mr-2 mb-2">Sign
                        Out</button>
                </form>
            </div>
        </div>
    </section>
@endsection
