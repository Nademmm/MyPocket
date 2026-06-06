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
                            <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('targets.edit', $target->id) }}" class="p-2 bg-[#c5d89d]/20 text-[#6b7854] rounded-lg hover:bg-[#c5d89d]/40 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('targets.destroy', $target->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 bg-[#d9a3a3]/10 text-[#c17b7b] rounded-lg hover:bg-[#d9a3a3]/20 transition">
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
                                <p class="text-sm font-bold text-[#2d2d2d]">{{ max(0, $target->deadline->diffInDays(now())) }}</p>
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
        <div class="bg-gradient-to-br from-white to-[#faf8ed] border-2 border-dashed border-[#c5d89d]/40 rounded-3xl p-16 text-center shadow-sm">
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
</x-app-layout>
