<x-app-layout title="Savings Targets">
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

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Target Amount -->
        <div class="bg-gradient-to-br from-white to-[#faf8ed] border border-[#c5d89d]/30 rounded-2xl p-6 hover:border-[#9cab84]/50 transition-all duration-300 hover:shadow-xl hover:shadow-[#c5d89d]/10 hover:-translate-y-0.5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[#89986d] text-sm font-medium mb-2">Total Target Amount</p>
                    <p class="text-3xl font-bold text-[#2d2d2d]">Rp {{ number_format($targets->sum('target_amount') ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-br from-[#c5d89d] to-[#9cab84] rounded-xl flex items-center justify-center border border-[#9cab84]/40 shadow-inner">
                    <svg class="w-6 h-6 text-[#2d2d2d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Saved -->
        <div class="bg-gradient-to-br from-white to-[#faf8ed] border border-[#c5d89d]/30 rounded-2xl p-6 hover:border-[#9cab84]/50 transition-all duration-300 hover:shadow-xl hover:shadow-[#c5d89d]/10 hover:-translate-y-0.5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[#89986d] text-sm font-medium mb-2">Total Saved</p>
                    <p class="text-3xl font-bold text-[#6b7854]">Rp {{ number_format($targets->sum('current_amount') ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-br from-[#c5d89d] to-[#9cab84] rounded-xl flex items-center justify-center border border-[#9cab84]/40 shadow-inner">
                    <svg class="w-6 h-6 text-[#2d2d2d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Active Targets -->
        <div class="bg-gradient-to-br from-white to-[#faf8ed] border border-[#c5d89d]/30 rounded-2xl p-6 hover:border-[#9cab84]/50 transition-all duration-300 hover:shadow-xl hover:shadow-[#c5d89d]/10 hover:-translate-y-0.5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[#89986d] text-sm font-medium mb-2">Active Targets</p>
                    <p class="text-3xl font-bold text-[#6b7854]">{{ $targets->where('status', 'active')->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-br from-[#c5d89d] to-[#9cab84] rounded-xl flex items-center justify-center border border-[#9cab84]/40 shadow-inner">
                    <svg class="w-6 h-6 text-[#2d2d2d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Targets List -->
    @if($targets->count() > 0)
        <div class="space-y-4">
            @foreach($targets as $target)
                <div class="bg-gradient-to-r from-white to-[#faf8ed] border border-[#c5d89d]/30 rounded-xl overflow-hidden hover:border-[#9cab84]/50 transition-all duration-300 hover:shadow-xl hover:shadow-[#c5d89d]/10 hover:-translate-y-0.5">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-xl font-bold text-[#2d2d2d]">{{ $target->title }}</h3>
                                    <span class="px-3 py-1 bg-[#c5d89d]/30 text-[#6b7854] text-xs font-semibold rounded-full border border-[#9cab84]/40">{{ ucfirst($target->status) }}</span>
                                </div>
                                <p class="text-[#89986d] text-sm">Target by {{ $target->deadline->format('M d, Y') }}</p>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('targets.edit', $target->id) }}" class="p-2 bg-gradient-to-br from-[#c5d89d] to-[#9cab84] hover:from-[#9cab84] hover:to-[#89986d] text-[#2d2d2d] rounded-lg transition border border-[#9cab84]/40 shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('targets.destroy', $target->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="p-2 bg-gradient-to-br from-[#d9a3a3] to-[#c17b7b] hover:from-[#c17b7b] hover:to-[#a85a5a] text-white rounded-lg transition border border-[#c17b7b]/40 shadow-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!-- Progress Bar -->
                        @php
                            $percentage = min(($target->current_amount / $target->target_amount) * 100, 100);
                        @endphp
                        <div class="mb-5">
                            <!-- Header with Amount and Percentage -->
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm text-[#89986d]">Progress</span>
                                    <span class="text-xs text-[#9cab84]">Rp {{ number_format($target->current_amount, 0, ',', '.') }} / Rp {{ number_format($target->target_amount, 0, ',', '.') }}</span>
                                </div>
                                <span class="text-lg font-bold text-[#6b7854]">{{ round($percentage) }}%</span>
                            </div>
                            
                            <!-- Progress Bar Container -->
                            <div class="relative w-full bg-[#f6f0d7] rounded-full h-5 overflow-hidden border-2 border-[#c5d89d]/40 shadow-inner">
                                <!-- Animated Progress Fill -->
                                <div class="h-full rounded-full transition-all duration-500 ease-out relative overflow-hidden" 
                                     style="width: {{ $percentage }}%; background: linear-gradient(90deg, #c5d89d 0%, #9cab84 50%, #89986d 100%);">
                                    <!-- Shine Effect -->
                                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent animate-pulse"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="grid grid-cols-2 gap-3 pt-4 border-t border-[#c5d89d]/30">
                            <div>
                                <p class="text-xs text-[#9cab84] mb-1">Remaining</p>
                                <p class="text-lg font-bold text-[#2d2d2d]">Rp {{ number_format(max(0, $target->target_amount - $target->current_amount), 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-[#9cab84] mb-1">Days Left</p>
                                <p class="text-lg font-bold text-[#2d2d2d]">{{ max(0, $target->deadline->diffInDays(now())) }} days</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-gradient-to-br from-white to-[#faf8ed] border-2 border-dashed border-[#c5d89d]/40 rounded-2xl p-12 text-center shadow-xl">
            <div class="w-16 h-16 bg-gradient-to-br from-[#c5d89d] to-[#9cab84] rounded-full flex items-center justify-center mx-auto mb-4 border border-[#9cab84]/50 shadow-inner">
                <svg class="w-8 h-8 text-[#2d2d2d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-[#2d2d2d] mb-2">No Savings Targets Yet</h3>
            <p class="text-[#89986d] mb-6">Start creating your first savings target to begin your financial journey</p>
            <a href="{{ route('targets.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#c5d89d] to-[#9cab84] hover:from-[#9cab84] hover:to-[#89986d] text-[#2d2d2d] font-semibold rounded-xl transition shadow-lg border border-[#c5d89d]/50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Create Your First Target
            </a>
        </div>
    @endif
</x-app-layout>
