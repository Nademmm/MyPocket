<x-app-layout title="Savings Arena">
    <div class="mb-12 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#c5d89d]/20 text-[#6b7854] text-xs font-bold uppercase tracking-widest mb-4">
            <i class="fas fa-users text-[10px]"></i> Community Showcase
        </div>
        <h1 class="text-5xl font-black text-[#2d2d2d] mb-4">Savings Arena </h1>
        <p class="text-[#89986d] text-lg max-w-2xl mx-auto font-medium">
            Join the movement! Get inspired by how our community is reaching their financial goals and share your own journey to motivate others.
        </p>
    </div>

    @if($targets->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($targets as $target)
                <div class="bg-white rounded-[2.5rem] border border-[#c5d89d]/30 shadow-sm hover:shadow-2xl transition-all duration-500 overflow-hidden group flex flex-col h-[420px] relative">
                    <!-- Target Image/Header -->
                    <div class="relative aspect-video flex-shrink-0 overflow-hidden bg-[#faf8ed]">
                        @if($target->image)
                            <img src="{{ asset('storage/' . $target->image) }}" alt="{{ $target->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-[#c5d89d]/30 to-[#9cab84]/20 flex items-center justify-center transition-colors duration-500 group-hover:bg-[#c5d89d]/40">
                                <i class="fas fa-piggy-bank text-4xl text-[#89986d]/40"></i>
                            </div>
                        @endif
                        
                        <!-- User Overlay -->
                        <div class="absolute bottom-4 left-4 right-4 flex items-center gap-3 bg-white/90 backdrop-blur-md p-2.5 rounded-2xl border border-white/50 shadow-lg">
                            <div class="w-10 h-10 bg-[#c5d89d] rounded-xl flex items-center justify-center text-sm font-black text-[#2d2d2d] shadow-inner">
                                {{ substr($target->user->name, 0, 1) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-black text-[#2d2d2d] truncate">{{ $target->user->name }}</p>
                                <div class="flex items-center gap-2">
                                    <span class="text-[9px] font-bold text-[#89986d] uppercase tracking-wider">Level {{ $target->user->level }}</span>
                                    @if($target->user->streak_count > 0)
                                        <span class="flex items-center gap-1 text-[9px] font-bold text-orange-500 bg-orange-50 px-1.5 py-0.5 rounded-md">
                                            <i class="fas fa-fire"></i> {{ $target->user->streak_count }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Target Info -->
                    <div class="p-6 flex flex-col flex-1 min-h-0 bg-gradient-to-b from-white to-[#faf8ed]/30">
                        <div class="mb-6 h-16 flex-shrink-0">
                            <h3 class="text-xl font-black text-[#2d2d2d] line-clamp-2 group-hover:text-[#6b7854] transition-colors leading-tight">{{ $target->title }}</h3>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="px-2 py-0.5 rounded-md bg-[#c5d89d]/20 text-[#6b7854] text-[9px] font-bold uppercase tracking-widest">Target</span>
                                <p class="text-[11px] font-bold text-[#89986d]">
                                    Rp {{ number_format($target->target_amount, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-auto space-y-4 flex-shrink-0">
                            @php
                                $percentage = min(($target->current_amount / $target->target_amount) * 100, 100);
                            @endphp
                            <div class="flex justify-between items-end">
                                <div class="flex flex-col">
                                    <span class="text-[10px] font-bold text-[#89986d] uppercase tracking-widest">Progress</span>
                                    <span class="text-sm font-black text-[#6b7854]">{{ round($percentage) }}%</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-[10px] font-bold text-[#89986d] uppercase tracking-widest block">Saved</span>
                                    <span class="text-xs font-black text-[#2d2d2d]">Rp {{ number_format($target->current_amount, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            
                            <div class="relative">
                                <div class="overflow-hidden h-3.5 flex rounded-full bg-white border border-[#c5d89d]/30 shadow-inner p-0.5">
                                    <div style="width:{{ $percentage }}%" class="shadow-sm flex flex-col text-center whitespace-nowrap text-white justify-center bg-gradient-to-r from-[#c5d89d] via-[#9cab84] to-[#89986d] transition-all duration-1000 rounded-full"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Badges -->
                    @if($target->user->badges->count() > 0)
                        <div class="px-6 py-4 bg-white/50 border-t border-[#c5d89d]/10 flex items-center justify-between">
                            <span class="text-[9px] font-bold text-[#89986d] uppercase tracking-widest">Achievements</span>
                            <div class="flex -space-x-1.5">
                                @foreach($target->user->badges->take(5) as $badge)
                                    <div class="w-6 h-6 rounded-full bg-white border border-[#c5d89d]/20 flex items-center justify-center shadow-sm" title="{{ $badge->name }}">
                                        <i class="fas fa-medal text-amber-400 text-[10px]"></i>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-[4rem] border border-[#c5d89d]/20 py-24 px-12 text-center max-w-2xl mx-auto shadow-2xl shadow-[#c5d89d]/10 relative overflow-hidden">
            
            
            
            <h3 class="text-3xl font-black text-[#2d2d2d] mb-4">Be the Trailblazer!</h3>
            <p class="text-[#89986d] text-lg font-medium mb-12 leading-relaxed">
                The arena is waiting for its first champion. Share your savings target today and inspire the whole community with your financial journey!
            </p>
            
            <a href="{{ route('targets.index') }}" class="group relative inline-flex items-center gap-3 px-8 py-3.5 bg-gradient-to-r from-[#c5d89d] to-[#9cab84] hover:from-[#9cab84] hover:to-[#89986d] text-[#2d2d2d] font-bold rounded-2xl transition-all shadow-lg shadow-[#c5d89d]/20 active:scale-95 border border-[#c5d89d]/50">
                <span>Start Your Showcase</span>
                <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    @endif
</x-app-layout>