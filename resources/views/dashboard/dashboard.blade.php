<x-app-layout title="Dashboard">
    {{-- Main Container --}}
    <div class="min-h-screen bg-[#f6f0d7] p-4 md:p-6 lg:p-8">
        
        {{-- Dashboard Grid Layout --}}
        <div class="dashboard-grid">
            
            {{-- Total Balance Card (Full Width) --}}
            <div class="dashboard-card card-balance">
                <div class="bg-gradient-to-br from-white via-[#faf8ed] to-[#e8edc2] rounded-2xl p-8 shadow-lg border border-[#c5d89d]/40">
                    <div class="text-center w-full">
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-[#c5d89d]/30 rounded-full mb-6 border border-[#9cab84]/40">
                            <svg class="w-4 h-4 text-[#89986d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-[#6b7854] text-sm uppercase tracking-widest font-semibold">Total Balance</span>
                        </div>
                        <div class="text-6xl md:text-7xl lg:text-8xl font-black text-[#2d2d2d] mb-4 tracking-tight drop-shadow-sm">
                            Rp {{ number_format($balance, 0, ',', '.') }}
                        </div>
                        <div class="text-[#89986d] text-lg flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Last updated: {{ now()->format('H:i') }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Row 1: Income + Expense (Side by Side) --}}
            <div class="dashboard-card card-income">
                <div class="bg-gradient-to-br from-white to-[#faf8ed] rounded-2xl p-6 shadow-lg border border-[#c5d89d]/30 hover:border-[#9cab84]/50 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-[#c5d89d] to-[#9cab84] rounded-xl flex items-center justify-center border-2 border-[#c5d89d]/50 shadow-inner">
                            <svg class="w-8 h-8 text-[#2d2d2d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                            </svg>
                        </div>
                        <div class="px-3 py-1 bg-[#c5d89d]/30 rounded-full border border-[#9cab84]/40">
                            <span class="text-[#6b7854] text-xs font-medium">+ Cashflow</span>
                        </div>
                    </div>
                    <div class="text-[#89986d] text-sm font-medium uppercase tracking-wider mb-1">Total Income</div>
                    <div class="text-3xl font-bold text-[#2d2d2d]">Rp {{ number_format($income, 0, ',', '.') }}</div>
                    <div class="mt-3 h-1 w-full bg-[#f6f0d7] rounded-full overflow-hidden border border-[#c5d89d]/30">
                        <div class="h-full bg-gradient-to-r from-[#c5d89d] to-[#9cab84] w-4/4 rounded-full"></div>
                    </div>
                </div>
            </div>

            <div class="dashboard-card card-expense">
                <div class="bg-gradient-to-br from-white to-[#faf8ed] rounded-2xl p-6 shadow-lg border border-[#d9a3a3]/30 hover:border-[#c17b7b]/50 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-[#d9a3a3] to-[#c17b7b] rounded-xl flex items-center justify-center border-2 border-[#d9a3a3]/50 shadow-inner">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                            </svg>
                        </div>
                        <div class="px-3 py-1 bg-[#d9a3a3]/30 rounded-full border border-[#c17b7b]/40">
                            <span class="text-[#8b4141] text-xs font-medium">- Cashflow</span>
                        </div>
                    </div>
                    <div class="text-[#c17b7b] text-sm font-medium uppercase tracking-wider mb-1">Total Expense</div>
                    <div class="text-3xl font-bold text-[#8b4141]">Rp {{ number_format($expense, 0, ',', '.') }}</div>
                    <div class="mt-3 h-1 w-full bg-[#f6f0d7] rounded-full overflow-hidden border border-[#d9a3a3]/30">
                        <div class="h-full bg-gradient-to-r from-[#d9a3a3] to-[#c17b7b] w-4/4 rounded-full"></div>
                    </div>
                </div>
            </div>

            {{-- Row 2: Saving Target + Reminders (Side by Side) --}}
            <div class="dashboard-card card-target">
                <div class="bg-gradient-to-br from-white to-[#faf8ed] rounded-2xl p-6 shadow-lg border border-[#c5d89d]/30 hover:border-[#9cab84]/50 transition-all duration-300 h-full hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-center justify-between mb-5">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-[#c5d89d] to-[#9cab84] rounded-xl flex items-center justify-center border-2 border-[#c5d89d]/50 shadow-inner">
                                <svg class="w-6 h-6 text-[#2d2d2d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-[#2d2d2d]">Saving Target</h3>
                                <p class="text-xs text-[#89986d]">Track your goals</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 bg-[#c5d89d]/30 rounded-full border border-[#9cab84]/40 text-xs text-[#6b7854]">{{ count($targets) }} goals</span>
                    </div>
                    <div class="space-y-4">
                        @forelse($targets as $target)
                            @php 
                                $percent = $target->target_amount > 0 ? ($target->current_amount / $target->target_amount) * 100 : 0;
                                $percent = min($percent, 100);
                            @endphp
                            <div class="bg-gradient-to-r from-[#faf8ed] to-[#f6f0d7] rounded-xl p-4 border border-[#c5d89d]/30">
                                <div class="flex justify-between items-center mb-3">
                                    <span class="text-[#2d2d2d] font-medium text-sm">{{ $target->title }}</span>
                                    <span class="text-sm {{ $percent >= 100 ? 'text-[#6b7854]' : 'text-[#89986d]' }} font-bold bg-[#c5d89d]/20 px-2 py-0.5 rounded border border-[#c5d89d]/40">
                                        {{ $percent >= 100 ? '✓ Done' : number_format($percent, 0) . '%' }}
                                    </span>
                                </div>
                                <div class="w-full bg-[#f6f0d7] rounded-full h-2.5 mb-3 border border-[#c5d89d]/30">
                                    <div class="h-full rounded-full bg-gradient-to-r {{ $percent >= 100 ? 'from-[#c5d89d] to-[#9cab84]' : 'from-[#9cab84] to-[#c5d89d]' }}" style="width: {{ $percent }}%"></div>
                                </div>
                                <div class="flex justify-between text-xs">
                                    <span class="text-[#89986d] font-medium">Rp{{ number_format($target->current_amount, 0, ',', '.') }}</span>
                                    <span class="text-[#9cab84]">Rp{{ number_format($target->target_amount, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 bg-[#faf8ed] rounded-xl border border-dashed border-[#c5d89d]/40">
                                <svg class="w-10 h-10 text-[#9cab84] mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                <p class="text-[#89986d] text-sm">No targets yet</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="dashboard-card card-reminders">
                <div class="bg-gradient-to-br from-white to-[#faf8ed] rounded-2xl p-6 shadow-lg border border-[#c5d89d]/30 hover:border-[#9cab84]/50 transition-all duration-300 h-full hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-center justify-between mb-5">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-[#c5d89d] to-[#9cab84] rounded-xl flex items-center justify-center border-2 border-[#c5d89d]/50 shadow-inner">
                                <svg class="w-6 h-6 text-[#2d2d2d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-[#2d2d2d]">Reminders</h3>
                                <p class="text-xs text-[#89986d]">Upcoming tasks</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 bg-[#c5d89d]/30 rounded-full border border-[#9cab84]/40 text-xs text-[#6b7854]">{{ count($reminders) }} items</span>
                    </div>
                    <div class="space-y-3">
                        @forelse($reminders as $reminder)
                            <div class="flex items-center justify-between p-4 bg-gradient-to-r from-[#faf8ed] to-[#f6f0d7] rounded-xl border border-[#c5d89d]/30 hover:border-[#9cab84]/50 transition">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-[#c5d89d]/30 rounded-lg flex items-center justify-center border border-[#9cab84]/40">
                                        <div class="w-2 h-2 bg-[#9cab84] rounded-full"></div>
                                    </div>
                                    <span class="text-[#2d2d2d] font-medium text-sm">{{ $reminder->title }}</span>
                                </div>
                                <span class="text-xs text-[#6b7854] bg-[#c5d89d]/20 border border-[#9cab84]/40 px-3 py-1.5 rounded-lg font-medium">{{ $reminder->remind_date->format('d M') }}</span>
                            </div>
                        @empty
                            <div class="text-center py-8 bg-[#faf8ed] rounded-xl border border-dashed border-[#c5d89d]/40">
                                <svg class="w-10 h-10 text-[#9cab84] mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                                <p class="text-[#89986d] text-sm">No reminders</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Row 3: Recent Transactions (Full Width) --}}
            <div class="dashboard-card card-transactions">
                <div class="bg-gradient-to-br from-white to-[#faf8ed] rounded-2xl p-6 shadow-lg border border-[#c5d89d]/30 hover:border-[#9cab84]/50 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-[#c5d89d] to-[#9cab84] rounded-xl flex items-center justify-center border-2 border-[#c5d89d]/50 shadow-inner">
                                <svg class="w-6 h-6 text-[#2d2d2d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-[#2d2d2d]">Recent Transactions</h3>
                                <p class="text-xs text-[#89986d]">Last 5 activities</p>
                            </div>
                        </div>
                        <a href="{{ route('transactions.index') }}" class="group flex items-center gap-2 px-4 py-2 bg-[#c5d89d]/30 hover:bg-[#c5d89d]/50 border border-[#9cab84]/40 hover:border-[#9cab84]/60 rounded-lg transition-all duration-300">
                            <span class="text-[#2d2d2d] group-hover:text-[#6b7854] text-sm font-medium">View All</span>
                            <svg class="w-4 h-4 text-[#89986d] group-hover:text-[#6b7854] group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-[#c5d89d]/30 bg-[#faf8ed]/50">
                                    <th class="text-left py-3 px-4 text-[#89986d] text-xs uppercase tracking-wider font-semibold rounded-tl-lg">Category</th>
                                    <th class="text-left py-3 px-4 text-[#89986d] text-xs uppercase tracking-wider font-semibold">Amount</th>
                                    <th class="text-left py-3 px-4 text-[#89986d] text-xs uppercase tracking-wider font-semibold">Date</th>
                                    <th class="text-left py-3 px-4 text-[#89986d] text-xs uppercase tracking-wider font-semibold rounded-tr-lg">Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentTransactions as $trx)
                                    <tr class="group hover:bg-[#c5d89d]/10 transition-all duration-200 border-b border-[#c5d89d]/20">
                                        <td class="py-4 px-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 bg-gradient-to-br from-[#c5d89d] to-[#9cab84] rounded-lg flex items-center justify-center flex-shrink-0 border border-[#c5d89d]/50 shadow-sm">
                                                    <svg class="w-5 h-5 text-[#2d2d2d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                    </svg>
                                                </div>
                                                <span class="text-[#2d2d2d] font-medium text-sm">{{ $trx->category->name ?? '-' }}</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span class="text-[#2d2d2d] font-bold text-sm">Rp{{ number_format($trx->amount, 2, ',', '.') }}</span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span class="text-[#89986d] text-sm">{{ $trx->transaction_date->format('d M Y') }}</span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span class="px-3 py-1.5 text-xs font-bold rounded-lg inline-flex items-center gap-1.5 border
                                                {{ ($trx->type ?? 'expense') === 'income' 
                                                    ? 'bg-[#c5d89d]/30 border-[#9cab84]/50 text-[#6b7854]' 
                                                    : 'bg-[#d9a3a3]/30 border-[#c17b7b]/50 text-[#8b4141]' }}">
                                                @if(($trx->type ?? 'expense') === 'income')
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                                                    </svg>
                                                @else
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                                                    </svg>
                                                @endif
                                                {{ ucfirst($trx->type ?? 'expense') }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-8">
                                            <div class="w-16 h-16 bg-gradient-to-br from-[#c5d89d] to-[#9cab84] rounded-full flex items-center justify-center mx-auto mb-4 border border-[#c5d89d]/50 shadow-inner">
                                                <svg class="w-8 h-8 text-[#2d2d2d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                                </svg>
                                            </div>
                                            <p class="text-[#89986d] text-sm">No transactions yet</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        {{-- Dashboard Grid Styles --}}
        <style>
            .dashboard-grid {
                display: grid;
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            @media (min-width: 768px) {
                .dashboard-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            @media (min-width: 1024px) {
                .dashboard-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            .dashboard-card {
                min-width: 0;
            }

            .card-balance,
            .card-transactions {
                grid-column: 1 / -1;
            }
        </style>

    </div>
</x-app-layout>
