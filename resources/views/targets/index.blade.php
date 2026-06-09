<x-app-layout title="Savings Targets">
    <div x-data="{ 
        showLogModal: false, 
        currentTarget: null,
        logType: 'increase',
        showAllLogs: false,
        openLogModal(target) {
            this.currentTarget = target;
            this.showLogModal = true;
            this.showAllLogs = false;
        }
    }">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-2">
            <div>
                <h1 class="text-4xl font-bold text-[#2d2d2d] mb-2">Your Targets</h1>
                <p class="text-[#89986d]">Track your financial goals and watch them grow</p>
            </div>
            <a href="{{ route('targets.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#c5d89d] to-[#9cab84] hover:from-[#9cab84] hover:to-[#89986d] text-[#2d2d2d] font-semibold rounded-xl transition transform hover:scale-105 active:scale-95 shadow-lg border border-[#c5d89d]/50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                New Target
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if($message = Session::get('success'))
        <div class="mb-6 p-4 bg-gradient-to-r from-[#c5d89d]/30 to-[#9cab84]/20 border border-[#c5d89d]/50 text-[#6b7854] rounded-xl flex items-center justify-between shadow-lg">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-gradient-to-br from-[#c5d89d] to-[#9cab84] rounded-full flex items-center justify-center border border-[#9cab84]/40">
                    <svg class="w-5 h-5 text-[#2d2d2d]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <span class="font-medium">{{ $message }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-[#89986d] hover:text-[#6b7854] transition">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
    @endif

    @if($errors->has('error'))
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            {{ $errors->first('error') }}
        </div>
    @endif

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-br from-white to-[#faf8ed] border border-[#c5d89d]/30 rounded-2xl p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[#89986d] text-sm font-medium mb-1">Total Target</p>
                    <p class="text-2xl font-bold text-[#2d2d2d]">Rp {{ number_format($targets->sum('target_amount') ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="w-10 h-10 bg-[#c5d89d]/20 rounded-xl flex items-center justify-center text-[#6b7854]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-white to-[#faf8ed] border border-[#c5d89d]/30 rounded-2xl p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[#89986d] text-sm font-medium mb-1">Total Saved</p>
                    <p class="text-2xl font-bold text-[#6b7854]">Rp {{ number_format($targets->sum('current_amount') ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="w-10 h-10 bg-[#c5d89d]/20 rounded-xl flex items-center justify-center text-[#6b7854]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-white to-[#faf8ed] border border-[#c5d89d]/30 rounded-2xl p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[#89986d] text-sm font-medium mb-1">Active Goals</p>
                    <p class="text-2xl font-bold text-[#6b7854]">{{ $targets->where('status', 'active')->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-[#c5d89d]/20 rounded-xl flex items-center justify-center text-[#6b7854]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Targets List -->
    @if($targets->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($targets as $target)
                <div class="bg-gradient-to-br from-white to-[#faf8ed] border border-[#c5d89d]/30 rounded-2xl overflow-hidden hover:border-[#9cab84]/50 transition-all duration-300 hover:shadow-lg shadow-sm group">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-[#2d2d2d] mb-1">{{ $target->title }}</h3>
                                <p class="text-[#89986d] text-sm flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Until {{ $target->deadline->format('M d, Y') }}
                                </p>
                            </div>
                            <div class="flex items-center justify-end gap-2">
                                <button @click="openLogModal({{ json_encode($target) }})" 
                                        class="flex items-center gap-1.5 px-3 py-2 bg-[#89986d]/10 text-[#6b7854] hover:bg-[#89986d]/20 rounded-xl transition-all font-bold text-xs border border-[#89986d]/20 shadow-sm group/log" 
                                        title="Savings Log">
                                    <svg class="w-4 h-4 transition-transform group-hover/log:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    <span>Log</span>
                                </button>
                                <a href="{{ route('targets.edit', $target->id) }}" class="p-2 bg-gradient-to-br from-[#c5d89d] to-[#9cab84] hover:from-[#9cab84] hover:to-[#89986d] text-[#2d2d2d] rounded-xl transition border border-[#9cab84]/40 shadow-sm" title="Edit Target">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('targets.destroy', $target->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this target?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 bg-gradient-to-br from-[#d9a3a3] to-[#c17b7b] hover:from-[#c17b7b] hover:to-[#a85a5a] text-white rounded-xl transition border border-[#c17b7b]/40 shadow-sm" title="Delete Target">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                        @php
                            $percentage = min(($target->current_amount / $target->target_amount) * 100, 100);
                        @endphp
                        
                        <div class="mb-4">
                            <div class="flex justify-between items-end mb-2">
                                <span class="text-2xl font-bold text-[#2d2d2d]">{{ round($percentage) }}%</span>
                                <span class="text-sm text-[#89986d]">Rp {{ number_format($target->current_amount, 0, ',', '.') }} / {{ number_format($target->target_amount, 0, ',', '.') }}</span>
                            </div>
                            <div class="w-full bg-[#c5d89d]/10 rounded-full h-2 overflow-hidden border border-[#c5d89d]/20">
                                <div class="bg-gradient-to-r from-[#c5d89d] to-[#89986d] h-full rounded-full transition-all duration-500" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>

                        <div class="flex justify-between pt-4 border-t border-[#c5d89d]/20">
                            <div class="text-center">
                                <p class="text-[10px] uppercase tracking-wider text-[#9cab84] mb-1 font-bold">Remaining</p>
                                <p class="text-sm font-bold text-[#2d2d2d]">Rp {{ number_format(max(0, $target->target_amount - $target->current_amount), 0, ',', '.') }}</p>
                            </div>
                            <div class="text-center">
                                <p class="text-[10px] uppercase tracking-wider text-[#9cab84] mb-1 font-bold">Days Left</p>
                                @php
                                    $today = now()->startOfDay();
                                    $deadline = $target->deadline->startOfDay();
                                    $daysLeft = $today->diffInDays($deadline, false);
                                @endphp
                                <p class="text-sm font-bold {{ $daysLeft < 0 ? 'text-red-500' : 'text-[#2d2d2d]' }}">
                                    @if($daysLeft > 0)
                                        {{ $daysLeft }} Days
                                    @elseif($daysLeft == 0)
                                        Today
                                    @else
                                        Overdue
                                    @endif
                                </p>
                            </div>
                            <div class="text-center">
                                <p class="text-[10px] uppercase tracking-wider text-[#9cab84] mb-1 font-bold">Status</p>
                                <span class="text-[10px] px-2 py-0.5 rounded-full font-bold uppercase {{ $target->status == 'active' ? 'bg-[#c5d89d]/30 text-[#6b7854]' : 'bg-gray-100 text-gray-500' }}">
                                    {{ $target->status }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $targets->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-gradient-to-br from-white to-[#faf8ed] border-2 border-dashed border-[#c5d89d]/40 rounded-3xl py-24 px-12 text-center shadow-sm">
            <div class="w-20 h-20 bg-[#c5d89d]/20 rounded-full flex items-center justify-center mx-auto mb-6 text-[#6b7854]">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-[#2d2d2d] mb-2">Set Your First Goal</h3>
            <p class="text-[#89986d] mb-8 max-w-sm mx-auto">Track your dreams and watch them become reality with our goal tracker.</p>
            <a href="{{ route('targets.create') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-[#c5d89d] to-[#9cab84] hover:from-[#9cab84] hover:to-[#89986d] text-[#2d2d2d] font-bold rounded-xl transition transform hover:scale-105 active:scale-95 shadow-lg border border-[#c5d89d]/50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Create Goal
            </a>
        </div>
    @endif

    <!-- Savings Log Modal -->
    <template x-if="showLogModal">
        <div class="fixed inset-0 z-[100] flex items-center justify-center p-4" x-cloak>
            <div class="fixed inset-0 bg-[#2d2d2d]/40 backdrop-blur-sm" @click="showLogModal = false"></div>

            <div class="relative bg-white w-full max-w-md rounded-[2rem] shadow-2xl overflow-hidden transform transition-all border border-[#c5d89d]/30 flex flex-col max-h-[85vh]">
                <!-- Header -->
                <div class="px-6 py-4 border-b border-[#c5d89d]/20 flex items-center justify-between shrink-0 bg-[#faf8ed]/50">
                    <h3 class="text-lg font-bold text-[#2d2d2d] truncate pr-4" x-text="currentTarget.title"></h3>
                    <button @click="showLogModal = false" class="text-[#89986d] hover:text-[#c17b7b] transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto custom-scrollbar p-6 space-y-6">
                    <!-- Form -->
                    <form :action="'/targets/' + currentTarget.id + '/logs'" method="POST" class="space-y-4">
                        @csrf
                        <div class="flex gap-2 p-1 bg-[#f8faf2] border border-[#c5d89d]/20 rounded-xl">
                            <button type="button" @click="logType = 'increase'" :class="logType === 'increase' ? 'bg-[#c5d89d] text-[#2d2d2d] shadow-sm' : 'text-[#89986d] hover:bg-white'" class="flex-1 py-2 text-[10px] font-bold rounded-lg transition-all uppercase tracking-wider">Increase</button>
                            <button type="button" @click="logType = 'decrease'" :class="logType === 'decrease' ? 'bg-[#c5d89d] text-[#2d2d2d] shadow-sm' : 'text-[#89986d] hover:bg-white'" class="flex-1 py-2 text-[10px] font-bold rounded-lg transition-all uppercase tracking-wider">Decrease</button>
                        </div>
                        <input type="hidden" name="type" :value="logType">
                        
                        <div class="space-y-4">
                            <div class="relative flex items-center bg-white border-2 border-[#c5d89d]/20 focus-within:border-[#c5d89d] rounded-xl transition-all shadow-sm">
                                <span class="pl-4 text-[#6b7854] font-bold text-sm">Rp</span>
                                <input type="text" name="amount" required inputmode="numeric" placeholder="Amount" maxlength="15" 
                                       style="border: none !important; outline: none !important; box-shadow: none !important;"
                                       class="rupiah-input w-full py-3 px-3 bg-transparent text-[#2d2d2d] font-bold focus:ring-0 focus:border-0 focus:outline-none">
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <input type="date" name="log_date" required value="{{ date('Y-m-d') }}" class="w-full px-3 py-2.5 bg-white border-2 border-[#c5d89d]/20 focus:border-[#c5d89d] text-[#2d2d2d] text-sm font-bold rounded-xl outline-none shadow-sm">
                                <input type="text" name="description" placeholder="Note (opt)" class="w-full px-3 py-2.5 bg-white border-2 border-[#c5d89d]/20 focus:border-[#c5d89d] text-[#2d2d2d] text-sm font-medium rounded-xl outline-none shadow-sm">
                            </div>
                        </div>

                        <button type="submit" class="bg-[#9cab84] text-[#2d2d2d] w-full py-3 text-sm font-bold rounded-xl transition-all shadow-lg hover:opacity-90 flex items-center justify-center gap-2 group">
                            <span x-text="logType === 'increase' ? 'Save Changes' : 'Confirm Withdrawal'"></span>
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </button>
                    </form>

                    <!-- Compact History -->
                    <div class="pt-4 border-t border-[#c5d89d]/20">
                        <div class="flex items-center justify-between mb-3">
                            <p class="text-[10px] font-bold text-[#9cab84] uppercase tracking-widest">Recent Activity</p>
                            <template x-if="currentTarget.logs && currentTarget.logs.length > 3">
                                <button @click="showAllLogs = !showAllLogs" class="text-[10px] font-bold text-[#6b7854] hover:text-[#2d2d2d] transition-colors" x-text="showAllLogs ? 'Show Less' : 'View All (' + currentTarget.logs.length + ')'"></button>
                            </template>
                        </div>
                        <div class="space-y-2">
                            <template x-for="(log, index) in currentTarget.logs" :key="log.id">
                                <div x-show="showAllLogs || index < 3" class="flex items-center justify-between p-3 bg-[#faf8ed]/50 border border-[#c5d89d]/10 rounded-xl group/item">
                                    <div class="flex items-center gap-3">
                                        <div :class="log.type === 'increase' ? 'text-[#6b7854]' : 'text-[#c17b7b]'" class="font-bold text-sm">
                                            <span x-text="log.type === 'increase' ? '+' : '-'"></span>
                                            <span x-text="'Rp' + Number(log.amount).toLocaleString('id-ID')"></span>
                                        </div>
                                        <p class="text-[10px] text-[#89986d] truncate max-w-[120px]" x-text="(log.description ? log.description + ' • ' : '') + new Date(log.log_date).toLocaleDateString('id-ID')"></p>
                                    </div>
                                    <form :action="'/targets/' + currentTarget.id + '/logs/' + log.id" method="POST" onsubmit="return confirm('Delete?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-[#d9a3a3] hover:text-[#c17b7b] transition opacity-0 group-hover/item:opacity-100"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                                    </form>
                                </div>
                            </template>
                            <template x-if="!currentTarget.logs || currentTarget.logs.length === 0">
                                <p class="text-center py-2 text-[10px] text-[#89986d] italic">No activity</p>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #c5d89d;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #9cab84;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Event Delegation for Input formatting
            document.addEventListener('input', function(e) {
                if (e.target.classList.contains('rupiah-input')) {
                    let value = e.target.value.replace(/[^0-9]/g, '');
                    if (value !== "") {
                        e.target.value = new Intl.NumberFormat('id-ID').format(value);
                    } else {
                        e.target.value = "";
                    }
                }
            });

            // Clean dots before submit
            document.addEventListener('submit', function(e) {
                const inputs = e.target.querySelectorAll('.rupiah-input');
                inputs.forEach(input => {
                    if (input.value) {
                        input.value = input.value.replace(/\./g, '').replace(',', '.');
                    }
                });
            });
        });
    </script>
</x-app-layout>
