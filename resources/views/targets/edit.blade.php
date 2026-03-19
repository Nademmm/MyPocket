<x-app-layout title="Edit Savings Target">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-[#2d2d2d] mb-2">Edit Savings Target</h1>
            <p class="text-[#89986d]">Update your financial goal</p>
        </div>

        <!-- Form Card -->
        <div class="bg-gradient-to-br from-white to-[#faf8ed] border border-[#c5d89d]/30 rounded-2xl p-6 md:p-8 shadow-xl">
            <form method="POST" action="{{ route('targets.update', $target->id) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-[#6b7854] mb-2">
                        Target Title <span class="text-[#9cab84]">*</span>
                    </label>
                    <input type="text" id="title" name="title" value="{{ old('title', $target->title) }}" required placeholder="e.g., Emergency Fund, New Car, Vacation" class="w-full px-4 py-3 bg-[#faf8ed] border border-[#c5d89d]/50 text-[#2d2d2d] placeholder-[#9cab84] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#c5d89d] focus:border-transparent transition"/>
                    @error('title')
                        <p class="mt-2 text-sm text-[#c17b7b]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Target Amount -->
                <div>
                    <label for="target_amount" class="block text-sm font-medium text-[#6b7854] mb-2">
                        Target Amount <span class="text-[#9cab84]">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[#9cab84] font-semibold">Rp</span>
                        <input type="number" id="target_amount" name="target_amount" step="0.01" value="{{ old('target_amount', $target->target_amount) }}" required placeholder="0.00" class="w-full pl-12 pr-4 py-3 bg-[#faf8ed] border border-[#c5d89d]/50 text-[#2d2d2d] placeholder-[#9cab84] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#c5d89d] focus:border-transparent transition"/>
                    </div>
                    @error('target_amount')
                        <p class="mt-2 text-sm text-[#c17b7b]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current Amount -->
                <div>
                    <label for="current_amount" class="block text-sm font-medium text-[#6b7854] mb-2">
                        Current Amount <span class="text-[#9cab84]">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[#9cab84] font-semibold">Rp</span>
                        <input type="number" id="current_amount" name="current_amount" step="0.01" value="{{ old('current_amount', $target->current_amount) }}" required placeholder="0.00" class="w-full pl-12 pr-4 py-3 bg-[#faf8ed] border border-[#c5d89d]/50 text-[#2d2d2d] placeholder-[#9cab84] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#c5d89d] focus:border-transparent transition"/>
                    </div>
                    @error('current_amount')
                        <p class="mt-2 text-sm text-[#c17b7b]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deadline -->
                <div>
                    <label for="deadline" class="block text-sm font-medium text-[#6b7854] mb-2">
                        Target Deadline <span class="text-[#9cab84]">*</span>
                    </label>
                    <input type="date" id="deadline" name="deadline" value="{{ old('deadline', $target->deadline->toDateString()) }}" required class="w-full px-4 py-3 bg-[#faf8ed] border border-[#c5d89d]/50 text-[#2d2d2d] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#c5d89d] focus:border-transparent transition"/>
                    @error('deadline')
                        <p class="mt-2 text-sm text-[#c17b7b]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-[#6b7854] mb-2">
                        Status <span class="text-[#9cab84]">*</span>
                    </label>
                    <select id="status" name="status" required class="w-full px-4 py-3 bg-[#faf8ed] border border-[#c5d89d]/50 text-[#2d2d2d] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#c5d89d] focus:border-transparent transition">
                        <option value="">Select Status</option>
                        <option value="active" {{ old('status', $target->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="completed" {{ old('status', $target->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ old('status', $target->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status')
                        <p class="mt-2 text-sm text-[#c17b7b]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 pt-6 border-t border-[#c5d89d]/30">
                    <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-[#c5d89d] to-[#9cab84] hover:from-[#9cab84] hover:to-[#89986d] text-[#2d2d2d] font-semibold rounded-xl transition transform hover:scale-105 active:scale-95 shadow-lg border border-[#c5d89d]/50">Update Target</button>
                    <a href="{{ route('targets.index') }}" class="flex-1 px-6 py-3 bg-[#faf8ed] hover:bg-[#c5d89d]/20 border border-[#c5d89d]/50 text-[#6b7854] hover:text-[#2d2d2d] text-center font-semibold rounded-xl transition">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
