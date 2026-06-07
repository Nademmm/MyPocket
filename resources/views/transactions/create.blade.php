<x-app-layout title="Create Transaction">
    <div class="max-w-xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-[#2d2d2d] mb-1">New Transaction</h1>
                <p class="text-[#89986d] text-sm">Record your income or expense</p>
            </div>
            <a href="{{ route('transactions.index') }}" class="p-2 text-[#89986d] hover:text-[#6b7854] transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-gradient-to-br from-white to-[#faf8ed] border border-[#c5d89d]/30 rounded-3xl p-6 md:p-8 shadow-xl relative overflow-hidden">
            <!-- Decorative background element -->
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-32 h-32 bg-[#c5d89d]/10 rounded-full blur-3xl"></div>
            
            @if($errors->has('error'))
                <div class="mb-6 p-4 rounded-xl border border-red-100 bg-red-50 text-xs text-red-600">
                    {{ $errors->first('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('transactions.store') }}" class="space-y-8 relative">
                @csrf

                <!-- Type Selector -->
                <div class="space-y-3">
                    <label class="block text-xs font-bold uppercase tracking-widest text-[#9cab84] ml-1">
                        Transaction Type
                    </label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="relative flex items-center justify-center p-4 bg-white border-2 border-[#c5d89d]/30 rounded-2xl cursor-pointer hover:border-[#c5d89d] transition-all has-[:checked]:border-[#c5d89d] has-[:checked]:bg-[#c5d89d]/10 group">
                            <input type="radio" name="type" value="income" {{ old('type', 'income') == 'income' ? 'checked' : '' }} class="hidden" required>
                            <div class="flex flex-col items-center gap-1">
                                <div class="w-10 h-10 rounded-full bg-[#c5d89d]/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 text-[#6b7854]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-bold text-[#2d2d2d]">Income</span>
                            </div>
                        </label>
                        <label class="relative flex items-center justify-center p-4 bg-white border-2 border-[#d9a3a3]/30 rounded-2xl cursor-pointer hover:border-[#d9a3a3] transition-all has-[:checked]:border-[#d9a3a3] has-[:checked]:bg-[#d9a3a3]/10 group">
                            <input type="radio" name="type" value="expense" {{ old('type') == 'expense' ? 'checked' : '' }} class="hidden" required>
                            <div class="flex flex-col items-center gap-1">
                                <div class="w-10 h-10 rounded-full bg-[#d9a3a3]/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 text-[#c17b7b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-bold text-[#2d2d2d]">Expense</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Amount -->
                <div class="space-y-3">
                    <label for="amount" class="block text-xs font-bold uppercase tracking-widest text-[#9cab84] ml-1">
                        Amount
                    </label>
                    <div class="relative group">
                        <div class="absolute left-5 top-1/2 -translate-y-1/2 text-2xl font-bold text-[#6b7854] group-focus-within:text-[#2d2d2d] transition-colors">Rp</div>
                        <input type="number" id="amount" name="amount" value="{{ old('amount') }}"
                               required min="0" step="0.01" placeholder="0"
                               class="w-full pl-16 pr-6 py-5 bg-white border-2 border-[#c5d89d]/20 focus:border-[#c5d89d] text-[#2d2d2d] text-3xl font-bold rounded-2xl transition-all outline-none placeholder-[#c5d89d]/30 shadow-sm">
                    </div>
                    @error('amount')
                        <p class="text-[10px] text-red-500 mt-1 ml-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Category -->
                    <div class="space-y-3">
                        <label for="category_id" class="block text-xs font-bold uppercase tracking-widest text-[#9cab84] ml-1">
                            Category
                        </label>
                        <div class="relative">
                            <select id="category_id" name="category_id" required
                                    class="w-full px-5 py-4 bg-white border-2 border-[#c5d89d]/20 focus:border-[#c5d89d] text-[#2d2d2d] font-bold rounded-2xl transition-all outline-none appearance-none cursor-pointer shadow-sm">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-[#9cab84]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                        @error('category_id')
                            <p class="text-[10px] text-red-500 mt-1 ml-1 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date -->
                    <div class="space-y-3">
                        <label for="transaction_date" class="block text-xs font-bold uppercase tracking-widest text-[#9cab84] ml-1">
                            Date
                        </label>
                        <input type="date" id="transaction_date" name="transaction_date"
                               value="{{ old('transaction_date', date('Y-m-d')) }}" required
                               class="w-full px-5 py-4 bg-white border-2 border-[#c5d89d]/20 focus:border-[#c5d89d] text-[#2d2d2d] font-bold rounded-2xl transition-all outline-none shadow-sm">
                        @error('transaction_date')
                            <p class="text-[10px] text-red-500 mt-1 ml-1 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="space-y-3">
                    <label for="description" class="block text-xs font-bold uppercase tracking-widest text-[#9cab84] ml-1">
                        Note (Optional)
                    </label>
                    <textarea id="description" name="description" rows="3" placeholder="What was this for?"
                              class="w-full px-5 py-4 bg-white border-2 border-[#c5d89d]/20 focus:border-[#c5d89d] text-[#2d2d2d] font-medium rounded-2xl transition-all outline-none placeholder-[#c5d89d]/40 resize-none shadow-sm">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-[10px] text-red-500 mt-1 ml-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="pt-6 flex flex-col gap-4 border-t border-[#c5d89d]/20">
                    <button type="submit" class="w-full py-5 bg-gradient-to-r from-[#c5d89d] to-[#9cab84] hover:from-[#9cab84] hover:to-[#89986d] text-[#2d2d2d] text-lg font-black rounded-2xl transition transform hover:scale-[1.02] active:scale-[0.98] shadow-xl border border-[#c5d89d]/50 flex items-center justify-center gap-3 group">
                        <span>Save Transaction</span>
                        <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>
                    <a href="{{ route('transactions.index') }}" class="w-full py-3 text-[#9cab84] hover:text-[#6b7854] font-bold text-sm transition text-center uppercase tracking-widest">
                        Cancel & Return
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
