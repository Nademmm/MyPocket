
<nav class="bg-slate-800 border-b border-slate-700 shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-8">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 flex-shrink-0">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-gray-500 to-gray-600 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2V6h10a2 2 0 0 0-2-2H4zm2 6a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-4zm6 4a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-white hidden sm:inline">MyPocket</span>
                </a>
                <div class="hidden space-x-1 sm:flex">
                    <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }} transition">Dashboard</a>
                    <a href="{{ route('transactions.index') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('transactions.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }} transition">Transactions</a>
                    <a href="{{ route('targets.index') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('targets.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }} transition">Targets</a>
                    <a href="{{ route('reminders.index') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('reminders.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }} transition">Reminders</a>
                </div>
            </div>
            <div class="hidden sm:flex sm:items-center sm:gap-4">
                <span class="text-white font-semibold">{{ Auth::user()->name ?? 'Guest' }}</span>
            </div>
        </div>
    </div>
</nav>





