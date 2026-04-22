<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Global Toast Notifications -->
            <div class="fixed top-24 right-6 z-[100] flex flex-col gap-4 max-w-sm w-full">
                @if(session('success') || session('Berhasil'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" 
                        class="glass-card p-4 flex items-center gap-4 animate-slide-in border-l-4 border-emerald-500 shadow-2xl">
                        <div class="bg-emerald-100 p-2 rounded-xl text-emerald-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-slate-900">Berhasil!</h4>
                            <p class="text-xs text-slate-600 font-medium">{{ session('success') ?? session('Berhasil') }}</p>
                        </div>
                        <button @click="show = false" class="text-slate-400 hover:text-slate-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                @endif

                @if(session('error') || session('Error'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
                        class="glass-card p-4 flex items-center gap-4 animate-slide-in border-l-4 border-rose-500 shadow-2xl">
                        <div class="bg-rose-100 p-2 rounded-xl text-rose-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-slate-900">Gagal!</h4>
                            <p class="text-xs text-slate-600 font-medium">{{ session('error') ?? session('Error') }}</p>
                        </div>
                        <button @click="show = false" class="text-slate-400 hover:text-slate-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                @endif
            </div>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
