@props(['title' => null])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ 
    dark: localStorage.getItem('theme') === 'dark',
    sidebarOpen: false
}" x-bind:class="dark ? 'dark' : ''" x-init="$watch('dark', val => localStorage.setItem('theme', val ? 'dark' : 'light'))">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ? $title . ' - MyPocket' : 'MyPocket' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-[#f6f0d7] text-[#2d2d2d] min-h-screen antialiased">
    <div class="min-h-screen flex">
        <!-- Sidebar Backdrop -->
        <div class="fixed inset-0 bg-[#2d2d2d]/30 z-30 transition-opacity duration-300" 
             x-show="sidebarOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false"></div>


        <!-- Sidebar -->
        <aside 
            class="fixed top-0 left-0 z-40 h-screen w-64 transform transition-transform duration-300 ease-in-out bg-[#faf8ed] border-r border-[#c5d89d]/40 shadow-xl"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        >
            <!-- User Info Section -->
            <div class="px-4 py-4 pl-16 border-b border-[#c5d89d]/40">

                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-[#2d2d2d] truncate">{{ Auth::user()->name ?? 'Guest' }}</p>
                    <p class="text-xs text-[#89986d] truncate">{{ Auth::user()->email ?? 'guest@example.com' }}</p>
                </div>
            </div>


            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto py-4">

                <ul class="space-y-1 px-3">
                    <li>
                        <a href="/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-xl text-[#2d2d2d] hover:bg-[#c5d89d]/20 hover:text-[#6b7854] transition-all duration-200 group">
                            <svg class="w-5 h-5 flex-shrink-0 text-[#89986d] group-hover:text-[#6b7854] group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                            <span class="font-medium">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="/transactions" class="flex items-center gap-3 px-4 py-3 rounded-xl text-[#2d2d2d] hover:bg-[#c5d89d]/20 hover:text-[#6b7854] transition-all duration-200 group">
                            <svg class="w-5 h-5 flex-shrink-0 text-[#89986d] group-hover:text-[#6b7854] group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                            <span class="font-medium">Transactions</span>
                        </a>
                    </li>
                    <li>
                        <a href="/targets" class="flex items-center gap-3 px-4 py-3 rounded-xl text-[#2d2d2d] hover:bg-[#c5d89d]/20 hover:text-[#6b7854] transition-all duration-200 group">
                            <svg class="w-5 h-5 flex-shrink-0 text-[#89986d] group-hover:text-[#6b7854] group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            <span class="font-medium">Targets</span>
                        </a>
                    </li>
                    <li>
                        <a href="/reminders" class="flex items-center gap-3 px-4 py-3 rounded-xl text-[#2d2d2d] hover:bg-[#c5d89d]/20 hover:text-[#6b7854] transition-all duration-200 group">
                            <svg class="w-5 h-5 flex-shrink-0 text-[#89986d] group-hover:text-[#6b7854] group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            <span class="font-medium">Reminders</span>
                        </a>
                    </li>
                    <li>
                        <a href="/diaries" class="flex items-center gap-3 px-4 py-3 rounded-xl text-[#2d2d2d] hover:bg-[#c5d89d]/20 hover:text-[#6b7854] transition-all duration-200 group">
                            <svg class="w-5 h-5 flex-shrink-0 text-[#89986d] group-hover:text-[#6b7854] group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <span class="font-medium">Saving Diary</span>
                        </a>
                    </li>
                    <li>
                        <a href="/badges" class="flex items-center gap-3 px-4 py-3 rounded-xl text-[#2d2d2d] hover:bg-[#c5d89d]/20 hover:text-[#6b7854] transition-all duration-200 group">
                            <svg class="w-5 h-5 flex-shrink-0 text-[#89986d] group-hover:text-[#6b7854] group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                            <span class="font-medium">Badges</span>
                        </a>
                    </li>

                </ul>
            </nav>

            <!-- Footer -->
            <div class="p-4 border-t border-[#c5d89d]/40">
                <div class="bg-gradient-to-r from-[#c5d89d] to-[#9cab84] rounded-xl p-4 text-[#2d2d2d]">
                    <p class="text-sm font-medium">Need help?</p>
                    <p class="text-xs opacity-80 mt-1">Check our documentation</p>
                </div>
            </div>
        </aside>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen transition-all duration-300" :class="sidebarOpen ? 'lg:pl-64' : ''">

            <!-- Navbar -->
            <x-navbar />
            
            <!-- Main Content Area -->
            <main class="flex-1 bg-[#f6f0d7] p-4 md:p-6 lg:p-8 overflow-y-auto">
                <div class="max-w-7xl mx-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</body>
</html>
