<x-app-layout title="My Profile">
    <div class="max-w-5xl mx-auto space-y-10 pb-20">
        <!-- Stats Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="bg-white border border-[#c5d89d]/30 rounded-3xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 group">
                <div class="w-10 h-10 bg-[#c5d89d]/20 rounded-xl flex items-center justify-center text-[#6b7854] mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-[10px] font-black uppercase tracking-widest text-[#9cab84] mb-1">Total Income</p>
                <h3 class="text-xl font-black text-[#2d2d2d]">Rp {{ number_format($stats['total_income'], 0, ',', '.') }}</h3>
            </div>
            <div class="bg-white border border-[#c5d89d]/30 rounded-3xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 group">
                <div class="w-10 h-10 bg-[#d9a3a3]/10 rounded-xl flex items-center justify-center text-[#c17b7b] mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-[10px] font-black uppercase tracking-widest text-[#9cab84] mb-1">Expenses</p>
                <h3 class="text-xl font-black text-[#2d2d2d]">Rp {{ number_format($stats['total_expenses'], 0, ',', '.') }}</h3>
            </div>
            <div class="bg-white border border-[#c5d89d]/30 rounded-3xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 group">
                <div class="w-10 h-10 bg-[#faf8ed] rounded-xl flex items-center justify-center text-[#89986d] mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <p class="text-[10px] font-black uppercase tracking-widest text-[#9cab84] mb-1">Stories</p>
                <h3 class="text-xl font-black text-[#2d2d2d]">{{ $stats['diaries_count'] }} Entry</h3>
            </div>
            <div class="bg-white border border-[#c5d89d]/30 rounded-3xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 group">
                <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center text-amber-500 mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z"/></svg>
                </div>
                <p class="text-[10px] font-black uppercase tracking-widest text-[#9cab84] mb-1">Badges</p>
                <h3 class="text-xl font-black text-[#2d2d2d]">{{ $stats['badges_count'] }} Earned</h3>
            </div>
        </div><br>

        <!-- Forms Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <!-- Account Settings -->
            <div class="space-y-6">
                <h2 class="text-2xl font-black text-[#2d2d2d] flex items-center gap-3 ml-2">
                    <svg class="w-6 h-6 text-[#89986d]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Profile Settings
                </h2>
                <div class="bg-white border border-[#c5d89d]/30 rounded-[2.5rem] p-8 shadow-sm">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div><br>

            <!-- Password Security -->
            <div class="space-y-6">
                <h2 class="text-2xl font-black text-[#2d2d2d] flex items-center gap-3 ml-2">
                    <svg class="w-6 h-6 text-[#89986d]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    Security
                </h2>
                <div class="bg-white border border-[#c5d89d]/30 rounded-[2.5rem] p-8 shadow-sm">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        <!-- Danger Zone -->
        <div class="pt-10">
            <div class="bg-red-50 border border-red-100 rounded-[2.5rem] p-8 md:p-10 flex flex-col md:flex-row items-center justify-between gap-8">
                <div>
                    <h2 class="text-2xl font-black text-red-700 mb-2">Danger Zone</h2>
                    <p class="text-red-600/70 font-medium">Permanently delete your account and all associated data.</p>
                </div>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
