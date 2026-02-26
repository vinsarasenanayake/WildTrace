<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>WildTrace Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="font-sans antialiased bg-white overscroll-none overflow-x-hidden">
    <div class="min-h-screen flex flex-col">
        <nav class="bg-stone-900 border-b border-stone-800 text-white z-50 sticky top-0">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-20">

                    <div class="flex items-center gap-4">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                            <img src="{{ asset('images/logo.png') }}"
                                class="h-10 w-10 object-contain opacity-90 group-hover:opacity-100 transition-opacity">
                            <div class="flex flex-col">
                                <span
                                    class="text-lg font-black tracking-[0.2em] uppercase group-hover:text-green-500 transition-colors leading-none">WildTrace</span>
                                <span
                                    class="text-[0.6rem] uppercase tracking-widest text-stone-500 font-bold">Administration</span>
                            </div>
                        </a>

                        <div class="hidden md:flex ml-10 gap-4">
                            <a href="{{ route('admin.photographers.index') }}"
                                class="px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wider transition-colors {{ request()->routeIs('admin.photographers.*') ? 'bg-stone-800 text-green-500' : 'text-stone-400 hover:text-white hover:bg-stone-800' }}">
                                Photographers
                            </a>
                            <a href="{{ route('admin.users.index') }}"
                                class="px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wider transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-stone-800 text-green-500' : 'text-stone-400 hover:text-white hover:bg-stone-800' }}">
                                Users
                            </a>
                            <a href="{{ route('admin.orders.index') }}"
                                class="px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wider transition-colors {{ request()->routeIs('admin.orders.*') ? 'bg-stone-800 text-green-500' : 'text-stone-400 hover:text-white hover:bg-stone-800' }}">
                                Orders
                            </a>
                            <a href="{{ route('admin.products.index') }}"
                                class="px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wider transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-stone-800 text-green-500' : 'text-stone-400 hover:text-white hover:bg-stone-800' }}">
                                Products
                            </a>
                            <a href="{{ route('admin.milestones.index') }}"
                                class="px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wider transition-colors {{ request()->routeIs('admin.milestones.*') ? 'bg-stone-800 text-green-500' : 'text-stone-400 hover:text-white hover:bg-stone-800' }}">
                                Milestones
                            </a>
                        </div>
                    </div>

                    <div class="flex items-center gap-6">
                        <div class="flex items-center gap-3">
                            <div class="text-right hidden sm:block">
                                <p class="text-sm font-bold text-white">{{ Auth::user()->name }}</p>
                                <p class="text-[10px] uppercase font-bold text-stone-500 tracking-wider">Administrator
                                </p>
                            </div>
                            <img class="h-9 w-9 rounded-full object-cover border-2 border-green-600"
                                src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="p-2 text-stone-400 hover:text-red-400 transition-colors"
                                title="Logout">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-1 max-w-6xl w-full mx-auto p-6 lg:p-10">
            <header class="flex items-center justify-between mb-12">
                <div>
                    <h1 class="text-3xl font-black text-stone-900 tracking-tight uppercase">
                        @yield('header')
                    </h1>
                    <p class="text-stone-500 font-medium mt-1">Manage your application content and data.</p>
                </div>
            </header>

            {{ $slot }}
        </main>

        <footer class="bg-stone-950 pt-20 pb-10 text-stone-400 border-t border-white/5 relative z-10 font-sans">
            <div class="container mx-auto px-6">
                <div class="border-t border-white/5 pt-8 pb-12 flex items-center justify-center">
                    <p class="text-[10px] font-medium text-stone-600 text-center">Copyright &copy; 2026 <span
                            class="text-stone-400 uppercase">WILDTRACE</span>. All Rights Reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    @livewireScripts
    <x-notification-toast />
</body>

</html>