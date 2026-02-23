<x-app-layout title="Reminder Details">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-[#2d2d2d] mb-2">{{ $reminder->title }}</h1>
                <p class="text-[#89986d]">View reminder details</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('reminders.edit', $reminder->id) }}" class="px-4 py-2 bg-gradient-to-r from-[#c5d89d] to-[#9cab84] hover:from-[#9cab84] hover:to-[#89986d] text-[#2d2d2d] font-semibold rounded-xl transition shadow-lg border border-[#c5d89d]/50">
                    <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <form method="POST" action="{{ route('reminders.destroy', $reminder->id) }}" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button class="px-4 py-2 bg-gradient-to-r from-[#d9a3a3] to-[#c17b7b] hover:from-[#c17b7b] hover:to-[#a85a5a] text-white font-semibold rounded-xl transition shadow-lg border border-[#c17b7b]/50">
                        <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>

        <!-- Details Card -->
        <div class="bg-gradient-to-br from-white to-[#faf8ed] border border-[#c5d89d]/30 rounded-2xl p-6 md:p-8 shadow-xl">
            <!-- Note Section -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-[#6b7854] mb-2">Note</label>
                <p class="text-lg text-[#2d2d2d] bg-[#faf8ed] rounded-xl p-4 border border-[#c5d89d]/40">{{ $reminder->note ?? 'No note provided' }}</p>
            </div>

            <!-- Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="bg-[#faf8ed] rounded-xl p-4 border border-[#c5d89d]/40">
                    <p class="text-xs text-[#9cab84] uppercase tracking-wider font-medium mb-1">Remind Date</p>
                    <p class="text-lg font-semibold text-[#2d2d2d]">{{ $reminder->remind_date->format('M d, Y') }}</p>
                    <p class="text-sm text-[#89986d]">{{ $reminder->remind_date->format('h:i A') }}</p>
                </div>
                <div class="bg-[#faf8ed] rounded-xl p-4 border border-[#c5d89d]/40">
                    <p class="text-xs text-[#9cab84] uppercase tracking-wider font-medium mb-1">Repeat Type</p>
                    <p class="text-lg font-semibold text-[#2d2d2d] capitalize">{{ $reminder->repeat_type }}</p>
                </div>
                <div class="bg-[#faf8ed] rounded-xl p-4 border border-[#c5d89d]/40">
                    <p class="text-xs text-[#9cab84] uppercase tracking-wider font-medium mb-1">Status</p>
                    <span class="px-3 py-1 {{ $reminder->is_active ? 'bg-[#c5d89d]/30 text-[#6b7854] border border-[#9cab84]/40' : 'bg-[#d9a3a3]/30 text-[#8b4141] border border-[#c17b7b]/40' }} text-sm font-semibold rounded-full inline-flex items-center gap-1">
                        @if($reminder->is_active)
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Active
                        @else
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Inactive
                        @endif
                    </span>
                </div>
                <div class="bg-[#faf8ed] rounded-xl p-4 border border-[#c5d89d]/40">
                    <p class="text-xs text-[#9cab84] uppercase tracking-wider font-medium mb-1">Days Until</p>
                    <p class="text-lg font-semibold {{ $reminder->remind_date->isFuture() ? 'text-[#6b7854]' : 'text-[#c17b7b]' }}">{{ round(max(0, $reminder->remind_date->diffInDays(now()))) }} days</p>
                </div>


            </div>

            <!-- Metadata -->
            <div class="pt-4 border-t border-[#c5d89d]/30 mb-6">
                <div class="flex flex-wrap gap-4 text-sm text-[#89986d]">
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Created: {{ $reminder->created_at->format('M d, Y H:i') }}
                    </span>
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Updated: {{ $reminder->updated_at->format('M d, Y H:i') }}
                    </span>
                </div>
            </div>

            <!-- Back Button -->
            <a href="{{ route('reminders.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#c5d89d]/30 to-[#9cab84]/20 hover:from-[#c5d89d]/50 hover:to-[#9cab84]/30 text-[#2d2d2d] font-semibold rounded-xl transition border border-[#c5d89d]/50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Reminders
            </a>
        </div>
    </div>
</x-app-layout>
