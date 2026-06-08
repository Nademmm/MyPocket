<x-app-layout title="Admin Dashboard">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Admin Overview</h1>
        <p class="text-gray-600">Global statistics and system monitoring</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center text-xl">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Users</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $stats['total_users'] }}</h3>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center text-xl">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Transactions</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $stats['total_transactions'] }}</h3>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center text-xl">
                    <i class="fas fa-award"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Badges</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $stats['total_badges'] }}</h3>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center text-xl">
                    <i class="fas fa-wallet"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Saved</p>
                    <h3 class="text-xl font-bold text-gray-800">Rp {{ number_format($stats['total_amount_saved'], 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Users -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-bold text-gray-800">Recently Joined Users</h3>
                <a href="{{ route('admin.users.index') }}" class="text-sm text-blue-600 font-semibold hover:underline">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-3 font-bold">User</th>
                            <th class="px-6 py-3 font-bold">Joined</th>
                            <th class="px-6 py-3 font-bold">Level</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($recent_users as $user)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center font-bold text-gray-500 text-xs">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-800">{{ $user->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $user->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-amber-50 text-amber-600 text-[10px] font-bold rounded-lg border border-amber-100 uppercase">
                                    Lvl {{ $user->level }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="grid grid-cols-1 gap-6">
            <!-- Badge Management Card -->
            <div class="bg-white border-2 border-[#c5d89d]/30 p-8 rounded-3xl shadow-sm hover:shadow-md transition-all group relative overflow-hidden">
                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-[#faf8ed] text-[#89986d] rounded-xl flex items-center justify-center text-xl shadow-sm">
                            <i class="fas fa-award"></i>
                        </div>
                        <h3 class="text-2xl font-black text-[#2d2d2d] tracking-tight">Badge Management</h3>
                    </div>
                    <p class="text-gray-500 mb-8 text-sm leading-relaxed max-w-md">
                        Create and update achievement badges for your users to keep them motivated.
                    </p>
                    <a href="{{ route('admin.badges.index') }}" 
                       style="background-color: #2d2d2d !important; color: white !important;"
                       class="inline-flex items-center gap-3 px-8 py-4 font-bold rounded-2xl hover:opacity-90 transition-all shadow-lg active:scale-95">
                        Manage Badges <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- User Directory Card -->
            <div class="bg-white border-2 border-[#c5d89d]/30 p-8 rounded-3xl shadow-sm hover:shadow-md transition-all group relative overflow-hidden">
                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-[#faf8ed] text-[#89986d] rounded-xl flex items-center justify-center text-xl shadow-sm">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="text-2xl font-black text-[#2d2d2d] tracking-tight">User Directory</h3>
                    </div>
                    <p class="text-gray-500 mb-8 text-sm leading-relaxed max-w-md">
                        Monitor user activity and manage accounts within the MyPocket ecosystem.
                    </p>
                    <a href="{{ route('admin.users.index') }}" 
                       style="background-color: #2d2d2d !important; color: white !important;"
                       class="inline-flex items-center gap-3 px-8 py-4 font-bold rounded-2xl hover:opacity-90 transition-all shadow-lg active:scale-95">
                        Manage Users <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
