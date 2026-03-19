<x-app-layout title="Badges & Achievements">
    <div class="mb-8">
        <div class="flex items-center justify-between mb-2">
            <div>
                <h1 class="text-4xl font-bold text-[#2d2d2d] mb-2">Badges & Achievements</h1>
                <p class="text-[#89986d]">Track your financial milestones</p>
            </div>
            <div class="px-4 py-2 bg-gradient-to-r from-[#c5d89d] to-[#9cab84] rounded-xl border border-[#c5d89d]/50">
                <span class="text-[#2d2d2d] font-semibold">{{ Auth::user()->badges->count() }} Earned</span>
            </div>
        </div>
    </div>

    <!-- My Badges -->
    <div class="mb-20">
        <h2 class="text-2xl font-bold text-[#2d2d2d] mb-6 flex items-center gap-2">
            <svg class="w-6 h-6 text-[#c5d89d]" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            My Badges
        </h2>
        
        @if(Auth::user()->badges->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach(Auth::user()->badges as $badge)
                    <div class="bg-gradient-to-br from-white to-[#faf8ed] border border-[#c5d89d]/30 rounded-2xl p-6 text-center hover:border-[#9cab84]/50 transition-all duration-300 hover:shadow-xl hover:shadow-[#c5d89d]/10 hover:-translate-y-1">
                        <div class="w-20 h-20 bg-gradient-to-br from-[#c5d89d] to-[#9cab84] rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-[#c5d89d]/30 shadow-lg">
                            <span class="text-4xl">{{ $badge->icon }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-[#2d2d2d] mb-2">{{ $badge->name }}</h3>
                        <p class="text-[#89986d] text-sm mb-4">{{ $badge->description }}</p>
                        <div class="inline-flex items-center gap-1 px-3 py-1 bg-[#c5d89d]/30 rounded-full border border-[#9cab84]/40">
                            <svg class="w-4 h-4 text-[#6b7854]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-xs text-[#6b7854] font-medium">Earned {{ $badge->pivot->earned_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-gradient-to-br from-white to-[#faf8ed] border-2 border-dashed border-[#c5d89d]/40 rounded-2xl p-12 text-center">
                <div class="w-16 h-16 bg-gradient-to-br from-[#c5d89d] to-[#9cab84] rounded-full flex items-center justify-center mx-auto mb-4 border border-[#9cab84]/50 shadow-inner">
                    <svg class="w-8 h-8 text-[#2d2d2d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-[#2d2d2d] mb-2">No Badges Yet</h3>
                <p class="text-[#89986d]">Complete activities to earn your first badge!</p>
            </div>
        @endif
    </div>

    <!-- Available Badges -->
    <div style="margin-top: 50px; padding-top: 20px; border-top: 2px dashed rgba(197, 216, 157, 0.3);">
        <h2 class="text-2xl font-bold text-[#2d2d2d] mb-6 flex items-center gap-2">
            <svg class="w-6 h-6 text-[#9cab84]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Available Badges
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach(\App\Models\Badge::all() as $badge)
                @if(!Auth::user()->badges->contains($badge))
                    <div class="bg-gradient-to-br from-[#faf8ed] to-[#f6f0d7] border border-[#c5d89d]/20 rounded-2xl p-6 text-center opacity-70 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-300">
                        <div class="w-20 h-20 bg-gradient-to-br from-[#c5d89d]/50 to-[#9cab84]/50 rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-[#c5d89d]/20">
                            <span class="text-4xl opacity-60">{{ $badge->icon }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-[#6b7854] mb-2">{{ $badge->name }}</h3>
                        <p class="text-[#89986d] text-sm mb-4">{{ $badge->description }}</p>
                        <div class="inline-flex items-center gap-1 px-3 py-1 bg-[#c5d89d]/20 rounded-full border border-[#9cab84]/30">
                            <svg class="w-4 h-4 text-[#9cab84]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            <span class="text-xs text-[#9cab84] font-medium">{{ $badge->requirement }}</span>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>
