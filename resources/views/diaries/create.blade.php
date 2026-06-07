<x-app-layout title="New Diary">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="mb-10 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-black text-[#2d2d2d] mb-2 tracking-tight">Write Your Diary.</h1>
                <p class="text-[#89986d] font-medium">Reflect on your financial journey today.</p><br>
            </div>
            <a href="{{ route('diaries.index') }}" class="flex items-center gap-2 px-4 py-2 bg-white border border-[#c5d89d]/50 text-[#89986d] hover:text-[#6b7854] hover:bg-[#f8faf2] rounded-xl transition-all shadow-sm group">
                <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span class="font-bold text-sm">Back</span>
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white border border-[#c5d89d]/30 rounded-[2.5rem] p-8 md:p-12 shadow-2xl relative overflow-hidden">
            <!-- Decorative element -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-[#faf8ed] rounded-bl-full opacity-50"></div>
            
            @if($errors->has('error'))
                <div class="mb-8 p-5 bg-red-50 border-l-4 border-red-400 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                    <span class="text-sm text-red-700 font-bold">{{ $errors->first('error') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('diaries.store') }}" class="space-y-8 relative">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Title Input -->
                    <div class="md:col-span-2 space-y-3">
                        <label for="title" class="block text-xs font-black uppercase tracking-widest text-[#9cab84] ml-1">
                            Story Title
                        </label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required 
                               placeholder="e.g., My Savings Milestone" 
                               class="w-full px-6 py-4 bg-[#faf8ed]/50 border-2 border-[#c5d89d]/20 focus:border-[#c5d89d] text-[#2d2d2d] font-bold rounded-2xl transition-all outline-none shadow-sm placeholder-[#9cab84]/50"/>
                        @error('title')
                            <p class="text-[10px] text-red-500 mt-1 ml-1 font-semibold uppercase tracking-wider">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date Input -->
                    <div class="space-y-3">
                        <label for="diary_date" class="block text-xs font-black uppercase tracking-widest text-[#9cab84] ml-1">
                            Date
                        </label>
                        <input type="date" id="diary_date" name="diary_date" value="{{ old('diary_date', today()->toDateString()) }}" required 
                               class="w-full px-6 py-4 bg-[#faf8ed]/50 border-2 border-[#c5d89d]/20 focus:border-[#c5d89d] text-[#2d2d2d] font-bold rounded-2xl transition-all outline-none shadow-sm"/>
                        @error('diary_date')
                            <p class="text-[10px] text-red-500 mt-1 ml-1 font-semibold uppercase tracking-wider">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Content Area -->
                <div class="space-y-3">
                    <label for="content" class="block text-xs font-black uppercase tracking-widest text-[#9cab84] ml-1">
                        Your Reflection
                    </label>
                    <textarea id="content" name="content" rows="10" required minlength="10" 
                              placeholder="Describe your financial journey today, your wins, or your challenges..." 
                              class="w-full px-8 py-6 bg-[#faf8ed]/50 border-2 border-[#c5d89d]/20 focus:border-[#c5d89d] text-[#2d2d2d] font-medium rounded-[2rem] transition-all outline-none shadow-sm resize-none leading-relaxed placeholder-[#9cab84]/50">{{ old('content') }}</textarea>
                    <div class="flex items-center justify-between px-2">
                        <p class="text-[10px] text-[#89986d] font-bold uppercase tracking-widest">Min. 10 characters</p>
                        @error('content')
                            <p class="text-[10px] text-red-500 font-semibold uppercase tracking-wider">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="pt-8 flex flex-col sm:flex-row gap-4 border-t border-[#faf8ed]">
                    <button type="submit" class="flex-1 py-5 bg-[#2d2d2d] text-white text-base font-black rounded-2xl transition-all duration-300 shadow-xl hover:bg-black hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-3 group">
                        <span>Save Diary</span>
                        <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>
                    <a href="{{ route('diaries.index') }}" class="px-10 py-5 text-[#89986d] hover:text-[#2d2d2d] font-black text-xs transition-colors text-center uppercase tracking-widest border-2 border-transparent hover:border-[#c5d89d]/20 rounded-2xl flex items-center justify-center">
                        Discard
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
