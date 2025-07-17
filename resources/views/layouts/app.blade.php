<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
@include('layouts.header')
<body class="font-sans antialiased">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
            class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>
        @include('layouts.sidebar')
        <div class="flex-1 flex flex-col overflow-hidden ">
            <main class="overflow-y-auto">
                <div class="p-4 content aa">
                    {{ $slot }}
                </div>
            </main>
        </div>

    </div>
</body>
<script>
    const mainEl = document.querySelector('main');
    const headerEl = document.getElementById('main-header');
    let lastScrollTop = 0;

    mainEl.addEventListener('scroll', function() {
        const st = mainEl.scrollTop;
        if (st > lastScrollTop) {
            headerEl.style.transform = 'translateY(-100%)';
        } else {
            headerEl.style.transform = 'translateY(0)';
        }
        lastScrollTop = st <= 0 ? 0 : st;
    });
</script>


<style>
    .aa {
        background-color: #f8f8f8;
    }
</style>

</html>
