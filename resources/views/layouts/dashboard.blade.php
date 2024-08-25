<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title }}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />

    @include('components.config')

    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body class="bg-white dark:bg-gray-900">

    @include('components.header')

    <div class="flex pt-16 overflow-hidden bg-white dark:bg-gray-900">

        @include('components.sidebar')

        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-white lg:ml-64 dark:bg-gray-900">
            <main class="bg-white dark:bg-gray-900">
                @yield('main')
            </main>
        </div>
    </div>

    @include('components.toast')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>

    @include('components.theme')

    <script>
        // Menutup toast secara otomatis setelah 5 detik
        setTimeout(function() {
            var successToast = document.getElementById('toast-success');
            var errorToast = document.getElementById('toast-error');
            var warningToast = document.getElementById('toast-warning');

            if (successToast) {
                successToast.classList.add('hidden');
            }

            if (errorToast) {
                errorToast.classList.add('hidden');
            }

            if (warningToast) {
                warningToast.classList.add('hidden');
            }
        }, 5000);
    </script>
</body>

</html>
