<header class="sticky top-0 z-40 w-full bg-white border-b border-[#c5d89d]/40 shadow-sm">
    <!-- Fixed Sidebar Toggle Button -->
    <button @click="sidebarOpen = !sidebarOpen" class="fixed top-3 left-4 z-50 p-2 rounded-xl bg-[#faf8ed] border border-[#c5d89d]/50 text-[#89986d] hover:bg-[#c5d89d]/20 hover:text-[#6b7854] transition-all duration-200 shadow-lg">
        <svg x-show="!sidebarOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
        <svg x-show="sidebarOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>

    <div class="flex items-center justify-between h-16 px-4 md:px-6 pl-16">
        <!-- Logo -->
        <div class="flex-1 flex justify-center">
            <h1 class="text-2xl font-bold tracking-widest text-[#2d2d2d]">
                MYPOCKET
            </h1>
        </div>


        <!-- Right Side -->
        <div class="flex items-center gap-2 md:gap-4">
            <!-- Notifications -->
            <button class="relative p-2 rounded-xl bg-[#faf8ed] border border-[#c5d89d]/50 text-[#89986d] hover:bg-[#c5d89d]/20 hover:text-[#6b7854] transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                <span class="absolute top-1 right-1 w-2 h-2 bg-[#c17b7b] rounded-full"></span>
            </button>

            <!-- Profile Dropdown -->
            <div class="relative" x-data="{ profileOpen: false }">
                <button @click="profileOpen = !profileOpen" class="flex items-center gap-2 p-1.5 pr-4 rounded-full bg-[#faf8ed] border border-[#c5d89d]/50 hover:bg-[#c5d89d]/20 transition-all duration-300">
                    <div class="w-8 h-8 bg-gradient-to-br from-[#c5d89d] to-[#9cab84] rounded-full flex items-center justify-center border border-[#c5d89d]/50">
                        <span class="text-[#2d2d2d] text-sm font-medium">{{ substr(Auth::user()->name ?? 'G', 0, 1) }}</span>
                    </div>
                    <svg class="w-4 h-4 text-[#89986d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="profileOpen" @click.away="profileOpen = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-[#c5d89d]/40 py-2 z-50">
                    <div class="px-4 py-2 border-b border-[#c5d89d]/30">
                        <p class="text-sm font-medium text-[#2d2d2d]">{{ Auth::user()->name ?? 'Guest' }}</p>
                        <p class="text-xs text-[#89986d] truncate">{{ Auth::user()->email ?? 'guest@example.com' }}</p>
                    </div>
                    <div class="py-2">
                        <a href="/profile" class="flex items-center gap-3 px-4 py-2 text-sm text-[#2d2d2d] hover:bg-[#c5d89d]/20 hover:text-[#6b7854] transition">
                            <svg class="w-4 h-4 text-[#89986d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Profile
                        </a>
                        <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm text-[#2d2d2d] hover:bg-[#c5d89d]/20 hover:text-[#6b7854] transition">
                            <svg class="w-4 h-4 text-[#89986d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Settings
                        </a>
                    </div>
                    <div class="border-t border-[#c5d89d]/30 py-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center gap-3 w-full px-4 py-2 text-sm text-[#c17b7b] hover:bg-[#d9a3a3]/20 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
