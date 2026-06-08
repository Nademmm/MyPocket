<x-app-layout title="Create Badge">
    <div class="max-w-2xl mx-auto">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">New Achievement</h1>
                <p class="text-gray-600">Define a new reward for user milestones</p>
            </div>
            <a href="{{ route('admin.badges.index') }}" class="flex items-center gap-2 px-4 py-2 bg-white border border-[#c5d89d]/50 text-[#89986d] hover:text-[#6b7854] hover:bg-[#f8faf2] rounded-xl transition-all shadow-sm group">
                <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span class="font-bold text-sm">Back</span>
            </a>
        </div>

        <form action="{{ route('admin.badges.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            @csrf
            
            <div class="space-y-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Badge Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 rounded-xl transition-all outline-none font-bold text-gray-800"
                           placeholder="e.g. Super Saver">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Description</label>
                    <textarea name="description" id="description" rows="3" required
                              class="w-full px-4 py-3 bg-gray-50 border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 rounded-xl transition-all outline-none font-medium text-gray-800"
                              placeholder="Describe how users can earn this badge...">{{ old('description') }}</textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Requirement Type -->
                    <div>
                        <label for="requirement_type" class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Requirement Type</label>
                        <select name="requirement_type" id="requirement_type" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 rounded-xl transition-all outline-none font-bold text-gray-800">
                            <option value="target_count" {{ old('requirement_type') == 'target_count' ? 'selected' : '' }}>Completed Targets</option>
                            <option value="transaction_count" {{ old('requirement_type') == 'transaction_count' ? 'selected' : '' }}>Total Transactions</option>
                            <option value="total_savings" {{ old('requirement_type') == 'total_savings' ? 'selected' : '' }}>Total Savings (Rp)</option>
                        </select>
                        @error('requirement_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Requirement Value -->
                    <div>
                        <label for="requirement_value" class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Goal Value</label>
                        <input type="number" name="requirement_value" id="requirement_value" value="{{ old('requirement_value', 1) }}" required min="0" step="0.01"
                               class="w-full px-4 py-3 bg-gray-50 border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 rounded-xl transition-all outline-none font-bold text-gray-800">
                        @error('requirement_value') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Image -->
                <div>
                    <label for="image" class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Badge Icon (Optional)</label>
                    <input type="file" name="image" id="image" accept="image/*"
                           class="w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100 cursor-pointer">
                    @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="pt-6 flex flex-col gap-4 border-t border-gray-50">
                    <button type="submit" class="w-full py-4 bg-[#9cab84] text-[#2d2d2d] text-base font-bold rounded-2xl transition-all duration-200 shadow-sm flex items-center justify-center gap-2 group">
                        <span>Save Achievement</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>
                    <a href="{{ route('admin.badges.index') }}" class="w-full py-4 text-[#9cab84] hover:text-[#6b7854] font-bold text-xs transition text-center uppercase tracking-widest border-2 border-transparent hover:border-[#c5d89d]/20 rounded-2xl">
                        Cancel and Return
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
