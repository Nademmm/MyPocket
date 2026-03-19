<x-app-layout title="Create Reminder">
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-[#2d2d2d] mb-2">Create Reminder</h1>
            <p class="text-[#89986d]">Set up a new reminder</p>
        </div>
        <div class="bg-gradient-to-br from-white to-[#faf8ed] border border-[#c5d89d]/30 rounded-2xl p-6 md:p-8 shadow-xl">
            <form method="POST" action="{{ route('reminders.store') }}" class="space-y-6">
                @csrf
                <div>
                    <label for="title" class="block text-sm font-medium text-[#6b7854] mb-2">Title <span class="text-[#9cab84]">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required class="w-full px-4 py-3 bg-[#faf8ed] border border-[#c5d89d]/50 text-[#2d2d2d] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#c5d89d] focus:border-transparent transition" placeholder="Enter reminder title..." />
                    @error('title')
                        <p class="mt-2 text-sm text-[#c17b7b]">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="note" class="block text-sm font-medium text-[#6b7854] mb-2">Note (Optional)</label>
                    <textarea id="note" name="note" rows="3" class="w-full px-4 py-3 bg-[#faf8ed] border border-[#c5d89d]/50 text-[#2d2d2d] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#c5d89d] focus:border-transparent transition resize-none placeholder-[#9cab84]" placeholder="Add a note...">{{ old('note') }}</textarea>
                    @error('note')
                        <p class="mt-2 text-sm text-[#c17b7b]">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="remind_date" class="block text-sm font-medium text-[#6b7854] mb-2">Remind Date & Time <span class="text-[#9cab84]">*</span></label>
                    <input type="datetime-local" id="remind_date" name="remind_date" value="{{ old('remind_date') }}" required class="w-full px-4 py-3 bg-[#faf8ed] border border-[#c5d89d]/50 text-[#2d2d2d] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#c5d89d] focus:border-transparent transition" />
                    @error('remind_date')
                        <p class="mt-2 text-sm text-[#c17b7b]">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="repeat_type" class="block text-sm font-medium text-[#6b7854] mb-2">Repeat Type <span class="text-[#9cab84]">*</span></label>
                    <select id="repeat_type" name="repeat_type" required class="w-full px-4 py-3 bg-[#faf8ed] border border-[#c5d89d]/50 text-[#2d2d2d] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#c5d89d] focus:border-transparent transition">
                        <option value="">Select Repeat Type</option>
                        <option value="once" {{ old('repeat_type') == 'once' ? 'selected' : '' }}>Once</option>
                        <option value="daily" {{ old('repeat_type') == 'daily' ? 'selected' : '' }}>Daily</option>
                        <option value="weekly" {{ old('repeat_type') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                        <option value="monthly" {{ old('repeat_type') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                    </select>
                    @error('repeat_type')
                        <p class="mt-2 text-sm text-[#c17b7b]">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center gap-3 p-3 bg-[#c5d89d]/20 rounded-xl border border-[#c5d89d]/40">
                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }} class="w-5 h-5 text-[#c5d89d] bg-[#faf8ed] border-[#c5d89d]/50 rounded focus:ring-[#c5d89d]">
                    <label for="is_active" class="text-[#2d2d2d] font-medium">Active</label>
                </div>
                <div class="flex gap-3 pt-6 border-t border-[#c5d89d]/30">
                    <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-[#c5d89d] to-[#9cab84] hover:from-[#9cab84] hover:to-[#89986d] text-[#2d2d2d] font-semibold rounded-xl transition shadow-lg border border-[#c5d89d]/50">Create Reminder</button>
                    <a href="{{ route('reminders.index') }}" class="flex-1 px-6 py-3 bg-[#faf8ed] hover:bg-[#c5d89d]/20 border border-[#c5d89d]/50 text-[#6b7854] hover:text-[#2d2d2d] text-center font-semibold rounded-xl transition">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
