<x-app-layout title="New Diary Entry">
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-[#2d2d2d] mb-2">Write New Entry</h1>
            <p class="text-[#89986d]">Reflect on your financial journey</p>
        </div>
        <div class="bg-gradient-to-br from-white to-[#faf8ed] border border-[#c5d89d]/30 rounded-2xl p-6 md:p-8 shadow-xl">
            <form method="POST" action="{{ route('diaries.store') }}" class="space-y-6">
                @csrf
                <div>
                    <label for="title" class="block text-sm font-medium text-[#6b7854] mb-2">Title <span class="text-[#9cab84]">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required class="w-full px-4 py-3 bg-[#faf8ed] border border-[#c5d89d]/50 text-[#2d2d2d] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#c5d89d] focus:border-transparent transition" placeholder="e.g., My First Saving Milestone" />
                    @error('title')
                        <p class="mt-2 text-sm text-[#c17b7b]">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="diary_date" class="block text-sm font-medium text-[#6b7854] mb-2">Date <span class="text-[#9cab84]">*</span></label>
                    <input type="date" id="diary_date" name="diary_date" value="{{ old('diary_date', today()->toDateString()) }}" required class="w-full px-4 py-3 bg-[#faf8ed] border border-[#c5d89d]/50 text-[#2d2d2d] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#c5d89d] focus:border-transparent transition" />
                    @error('diary_date')
                        <p class="mt-2 text-sm text-[#c17b7b]">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="content" class="block text-sm font-medium text-[#6b7854] mb-2">Your Reflection <span class="text-[#9cab84]">*</span></label>
                    <textarea id="content" name="content" rows="8" required minlength="10" class="w-full px-4 py-3 bg-[#faf8ed] border border-[#c5d89d]/50 text-[#2d2d2d] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#c5d89d] focus:border-transparent transition resize-none placeholder-[#9cab84]" placeholder="Write about your financial situation, goals, challenges, or achievements...">{{ old('content') }}</textarea>
                    <p class="mt-2 text-xs text-[#89986d]">Minimum 10 characters</p>
                    @error('content')
                        <p class="mt-2 text-sm text-[#c17b7b]">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex gap-3 pt-6 border-t border-[#c5d89d]/30">
                    <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-[#c5d89d] to-[#9cab84] hover:from-[#9cab84] hover:to-[#89986d] text-[#2d2d2d] font-semibold rounded-xl transition shadow-lg border border-[#c5d89d]/50">Save Entry</button>
                    <a href="{{ route('diaries.index') }}" class="flex-1 px-6 py-3 bg-[#faf8ed] hover:bg-[#c5d89d]/20 border border-[#c5d89d]/50 text-[#6b7854] hover:text-[#2d2d2d] text-center font-semibold rounded-xl transition">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
