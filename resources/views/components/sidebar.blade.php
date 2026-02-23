<!-- Sidebar -->
<div x-data="{ 
    open: false,
    collapsed: localStorage.getItem('sidebarCollapsed') === 'true'
}" 
x-init="$watch('collapsed', val => localStorage.setItem('sidebarCollapsed', val))"
class="relative">

    <!-- Sidebar Backdrop (Mobile) -->
    <div class="fixed inset-0 bg-black/50 z-30 lg:hidden transition-opacity duration-300" 
         :class="{'opacity-100 pointer-events-auto':open,'opacity-0 pointer-events-none':!open}" 
         @click="open = false"></div>

    <!-- Sidebar -->
    <aside x-show="open || !window.matchMedia('(max-width: 1024px)').matches"
           x-transition:enter="transition ease-out duration-300"
           x-transition:enter-start="-translate-x-full"
           x-transition:enter-end="translate-x-0"
           x-transition:leave="transition ease-in duration-200"
           x-transition:leave-start="translate-x-0"
           x-transition:leave-end="-translate-x-full"
           class="fixed lg:sticky top-0 left-0 z-40 h-screen w-64 transform transition-transform duration-300 lg:transform-none"
           :class="collapsed ? 'lg:w-20' : 'lg:w-64'">
        
        <!-- Sidebar Content -->
        <div class="flex flex-col h-full bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-700 shadow-xl">
            
            <!-- Logo Section -->
            <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-3" x-show="!collapsed">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl flex items-center justify-center shadow-lg shadow-primary-500/30">
                        <span class="text-white font-bold text-lg">M</span>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-gray-900 dark:text-white">MyPocket</span>
                </div>
                <div x-show="collapsed" class="mx-auto">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl flex items-center justify-center shadow-lg shadow-primary-500/30">
                        <span class="text-white font-bold text-lg">M</span>
                    </div>
                </div>
                
                <!-- Collapse Button (Desktop) -->
                <button @click.stop="collapsed = !collapsed" class="hidden lg:flex p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    <svg class="w-5 h-5 transition-transform duration-300" :class="collapsed ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
                    </svg>
                </button>
                
                <!-- Close Button (Mobile) -->
                <button @click="open = false" class="lg:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- User Profile Section -->
            <div class="px-4 py-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-3" :class="collapsed ? 'justify-center' : ''">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-medium">{{ substr(Auth::user()->name ?? 'G', 0, 1) }}</span>
                    </div>
                    <div class="flex-1 min-w-0" x-show="!collapsed">
                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ Auth::user()->name ?? 'Guest' }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email ?? '' }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto py-4">
                <ul class="space-y-1 px-2">
                    <!-- Dashboard -->
                    <li>
                        <a href="/dashboard" 
                           class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 dark:text-gray-300 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200 group"
                           :class="collapsed ? 'justify-center' : ''">
                            <svg class="w-5 h-5 flex-shrink-0 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-4 7 4M5 10v10a1 1 0 001 1h12a1 1 0 001-1V10m-9 4h4"></path>
                            </svg>
                            <span x-show="!collapsed" class="font-medium">Dashboard</span>
                        </a>
                    </li>
                    
                    <!-- Transactions -->
                    <li>
                        <a href="/transactions" 
                           class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 dark:text-gray-300 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200 group"
                           :class="collapsed ? 'justify-center' : ''">
                            <svg class="w-5 h-5 flex-shrink-0 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span x-show="!collapsed" class="font-medium">Transactions</span>
                        </a>
                    </li>
                    
                    <!-- Targets -->
                    <li>
                        <a href="/targets" 
                           class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 dark:text-gray-300 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200 group"
                           :class="collapsed ? 'justify-center' : ''">
                            <svg class="w-5 h-5 flex-shrink-0 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            <span x-show="!collapsed" class="font-medium">Targets</span>
                        </a>
                    </li>
                    
                    <!-- Reminders -->
                    <li>
                        <a href="/reminders" 
                           class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 dark:text-gray-300 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200 group"
                           :class="collapsed ? 'justify-center' : ''">
                            <svg class="w-5 h-5 flex-shrink-0 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            <span x-show="!collapsed" class="font-medium">Reminders</span>
                        </a>
                    </li>
                    
                    <!-- Badges -->
                    <li>
                        <a href="/badges" 
                           class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 dark:text-gray-300 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200 group"
                           :class="collapsed ? 'justify-center' : ''">
                            <svg class="w-5 h-5 flex-shrink-0 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                            <span x-show="!collapsed" class="font-medium">Badges</span>
                        </a>
                    </li>

                    <!-- Categories -->
                    <li>
                        <a href="/categories" 
                           class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 dark:text-gray-300 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200 group"
                           :class="collapsed ? 'justify-center' : ''">
                            <svg class="w-5 h-5 flex-shrink-0 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            <span x-show="!collapsed" class="font-medium">Categories</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Footer -->
            <div class="p-4 border-t border-gray-200 dark:border-gray-700" x-show="!collapsed">
                <div class="bg-gradient-to-r from-primary-500 to-primary-600 rounded-xl p-4 text-white">
                    <p class="text-sm font-medium">Need help?</p>
                    <p class="text-xs opacity-80 mt-1">Check our documentation</p>
                </div>
            </div>
        </div>
    </aside>
</div>
