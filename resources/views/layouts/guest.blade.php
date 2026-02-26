@props(['title' => null, 'hasFooter' => true, 'fullWidth' => false, 'lightBg' => false])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>WildTrace{{ isset($title) ? ' - ' . $title : '' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>


<body
    class="font-sans antialiased {{ $lightBg ? 'bg-white text-stone-800' : 'bg-stone-950 text-stone-200' }} selection:bg-green-600 selection:text-white overscroll-none overflow-x-hidden">
    <div class="min-h-screen flex flex-col relative overflow-hidden">

        <div class="fixed inset-0 z-0 pointer-events-none">
            <div class="absolute top-[-10%] right-[-5%] w-[600px] h-[600px] bg-green-600/5 rounded-full blur-[120px]">
            </div>
            <div
                class="absolute bottom-[-10%] left-[-5%] w-[500px] h-[500px] bg-stone-400/10 rounded-full blur-[100px]">
            </div>
        </div>

        <main
            class="{{ $fullWidth ? 'flex-grow relative z-10 w-full' : 'flex-grow flex flex-col items-center justify-start pt-4 pb-12 px-6 relative z-10 w-full' }}">
            {{ $slot }}
        </main>

        @if($hasFooter)
            <footer class="bg-stone-950 pt-20 pb-10 text-stone-400 border-t border-white/5 relative z-10 font-sans">
                <div class="container mx-auto px-6">
                    <div class="border-t border-white/5 pt-8 pb-12 flex items-center justify-center">
                        <p class="text-[10px] font-medium text-stone-600 text-center">Copyright &copy; 2026 <span
                                class="text-stone-400 uppercase">WILDTRACE</span>. All Rights Reserved.</p>
                    </div>
                </div>
            </footer>
        @endif
    </div>

    @livewireScripts
    <x-notification-toast />
</body>

</html>