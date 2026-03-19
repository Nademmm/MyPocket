<x-app-layout title="Dashboard">
    {{-- Main Container --}}
    <div class="min-h-screen bg-[#f8f9fa] p-4 md:p-8">
        
        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-[#2d2d2d]">Financial Overview</h1>
                <p class="text-[#89986d] mt-1">Monitor your income, expenses, and goals in one place.</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="bg-white px-4 py-2 rounded-xl shadow-sm border border-[#c5d89d]/30 text-[#6b7854] text-sm font-medium">
                    <span class="opacity-60">Last sync:</span> {{ now()->format('H:i') }}
                </div>
            </div>
        </div>

        {{-- Dashboard Grid Layout --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            {{-- Total Balance Card (Span 4 on LG) --}}
            <div class="col-span-1 md:col-span-2 lg:col-span-4">
                <div class="relative overflow-hidden bg-gradient-to-br from-[#2d2d2d] to-[#1a1a1a] rounded-3xl p-8 shadow-2xl">
                    {{-- Decorative Circles --}}
                    <div class="absolute -right-10 -top-10 w-64 h-64 bg-[#c5d89d]/10 rounded-full blur-3xl"></div>
                    <div class="absolute -left-10 -bottom-10 w-48 h-48 bg-[#9cab84]/10 rounded-full blur-2xl"></div>

                    <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-6">
                        <div class="text-center md:text-left">
                            <span class="text-[#c5d89d] text-xs uppercase tracking-[0.2em] font-bold">Available Balance</span>
                            <div class="text-5xl md:text-6xl font-black text-white mt-2 tracking-tight">
                                <span class="text-[#c5d89d] text-2xl font-light">Rp</span> {{ number_format($balance, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <a href="{{ route('transactions.index') }}" class="px-6 py-3 bg-[#c5d89d] hover:bg-[#b4c78c] text-[#2d2d2d] font-bold rounded-xl transition-all shadow-lg shadow-[#c5d89d]/20">
                                History
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Income Card --}}
            <div class="col-span-1 md:col-span-1 lg:col-span-2">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-[#c5d89d]/20 hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-[#c5d89d]/20 rounded-xl flex items-center justify-center text-[#6b7854]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/></svg>
                        </div>
                        <div>
                            <p class="text-sm text-[#89986d] font-medium uppercase">Income</p>
                            <h4 class="text-2xl font-bold text-[#2d2d2d]">Rp {{ number_format($income, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Expense Card --}}
            <div class="col-span-1 md:col-span-1 lg:col-span-2">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-red-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center text-red-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/></svg>
                        </div>
                        <div>
                            <p class="text-sm text-[#89986d] font-medium uppercase">Expenses</p>
                            <h4 class="text-2xl font-bold text-[#2d2d2d]">Rp {{ number_format($expense, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Saving Targets --}}
            <div class="col-span-1 md:col-span-2 lg:col-span-2">
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-[#c5d89d]/20 h-full">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-[#2d2d2d]">Savings Goal</h3>
                        <span class="text-xs bg-[#f8f9fa] px-3 py-1 rounded-full text-[#89986d]">{{ count($targets) }} Total</span>
                    </div>
                    <div class="space-y-5">
                        @forelse($targets as $target)
                            @php 
                                $percent = $target->target_amount > 0 ? ($target->current_amount / $target->target_amount) * 100 : 0;
                            @endphp
                            <div>
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="font-semibold text-[#4a4a4a]">{{ $target->title }}</span>
                                    <span class="text-[#89986d]">{{ number_format($percent, 0) }}%</span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-2">
                                    <div class="bg-[#c5d89d] h-2 rounded-full transition-all duration-500" style="width: {{ min($percent, 100) }}%"></div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-400 py-4">No goals set yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Reminders --}}
            <div class="col-span-1 md:col-span-2 lg:col-span-2">
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-[#c5d89d]/20 h-full">
                    <h3 class="text-lg font-bold text-[#2d2d2d] mb-6">Reminders</h3>
                    <div class="space-y-4">
                        @forelse($reminders as $reminder)
                            <div class="flex items-center justify-between p-4 bg-[#f8f9fa] rounded-2xl border border-transparent hover:border-[#c5d89d]/50 transition-all">
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-2 bg-[#c5d89d] rounded-full"></div>
                                    <span class="text-sm font-medium text-[#2d2d2d]">{{ $reminder->title }}</span>
                                </div>
                                <span class="text-xs font-bold text-[#89986d]">{{ $reminder->remind_date->format('d M') }}</span>
                            </div>
                        @empty
                            <p class="text-center text-gray-400 py-4">All caught up!</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Recent Transactions --}}
            <div class="col-span-1 md:col-span-2 lg:col-span-4">
                <div class="bg-white rounded-3xl shadow-sm border border-[#c5d89d]/20 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-[#2d2d2d]">Recent Activity</h3>
                        <a href="{{ route('transactions.index') }}" class="text-sm text-[#89986d] hover:text-[#6b7854] font-semibold">See all</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-[#f8f9fa]">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-[#89986d] uppercase tracking-wider">Category</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-[#89986d] uppercase tracking-wider">Amount</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-[#89986d] uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-[#89986d] uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach($recentTransactions as $trx)
                                    <tr class="hover:bg-gray-50/50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $trx->category->name ?? 'Uncategorized' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                            Rp{{ number_format($trx->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $trx->transaction_date->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $trx->type === 'income' ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">
                                                {{ ucfirst($trx->type) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>