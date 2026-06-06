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
        <div class="bg-white border border-[#c5d89d]/30 rounded-3xl p-8 shadow-sm relative overflow-hidden">
            <!-- Decorative background element -->
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-32 h-32 bg-[#c5d89d]/10 rounded-full blur-3xl"></div>
            
            @if($errors->has('error'))
                <div class="mb-6 p-4 rounded-xl border border-red-100 bg-red-50 text-xs text-red-600">
                    {{ $errors->first('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('transactions.store') }}" class="space-y-6 relative">
                @csrf

                <!-- Type Selector (Segmented Control style) -->
                <div class="flex justify-center mb-8">
                    <div class="inline-flex p-1 bg-[#faf8ed] rounded-2xl border border-[#c5d89d]/30 w-full max-w-[300px]">
                        <label class="flex-1 relative cursor-pointer group">
                            <input type="radio" name="type" value="income" {{ old('type', 'income') == 'income' ? 'checked' : '' }} class="peer hidden" required>
                            <div class="py-2.5 text-center rounded-xl transition-all duration-300 peer-checked:bg-white peer-checked:text-[#6b7854] peer-checked:shadow-sm text-[#9cab84] font-bold text-sm group-hover:text-[#6b7854]">
                                Income
                            </div>
                        </label>
                        <label class="flex-1 relative cursor-pointer group">
                            <input type="radio" name="type" value="expense" {{ old('type') == 'expense' ? 'checked' : '' }} class="peer hidden" required>
                            <div class="py-2.5 text-center rounded-xl transition-all duration-300 peer-checked:bg-white peer-checked:text-[#c17b7b] peer-checked:shadow-sm text-[#9cab84] font-bold text-sm group-hover:text-[#c17b7b]">
                                Expense
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Amount -->
                <div class="space-y-2">
                    <label for="amount" class="block text-xs font-bold uppercase tracking-widest text-[#9cab84] ml-1">
                        Amount
                    </label>
                    <div class="relative group">
                        <div class="absolute left-5 top-1/2 -translate-y-1/2 text-xl font-bold text-[#6b7854] group-focus-within:text-[#2d2d2d] transition-colors">Rp</div>
                        <input type="number" id="amount" name="amount" value="{{ old('amount') }}"
                               required min="0" step="0.01" placeholder="0"
                               class="w-full pl-16 pr-6 py-5 bg-[#faf8ed] border border-transparent focus:bg-white focus:border-[#c5d89d] text-[#2d2d2d] text-2xl font-bold rounded-2xl transition-all outline-none placeholder-[#c5d89d]/50">
                    </div>
                    @error('amount')
                        <p class="text-[10px] text-red-400 mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Category -->
                    <div class="space-y-2">
                        <label for="category_id" class="block text-xs font-bold uppercase tracking-widest text-[#9cab84] ml-1">
                            Category
                        </label>
                        <select id="category_id" name="category_id" required
                                class="w-full px-5 py-3.5 bg-[#faf8ed] border border-transparent focus:bg-white focus:border-[#c5d89d] text-[#2d2d2d] font-semibold rounded-2xl transition-all outline-none appearance-none cursor-pointer">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-[10px] text-red-400 mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date -->
                    <div class="space-y-2">
                        <label for="transaction_date" class="block text-xs font-bold uppercase tracking-widest text-[#9cab84] ml-1">
                            Date
                        </label>
                        <input type="date" id="transaction_date" name="transaction_date"
                               value="{{ old('transaction_date', date('Y-m-d')) }}" required
                               class="w-full px-5 py-3.5 bg-[#faf8ed] border border-transparent focus:bg-white focus:border-[#c5d89d] text-[#2d2d2d] font-semibold rounded-2xl transition-all outline-none">
                        @error('transaction_date')
                            <p class="text-[10px] text-red-400 mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="space-y-2">
                    <label for="description" class="block text-xs font-bold uppercase tracking-widest text-[#9cab84] ml-1">
                        Note
                    </label>
                    <textarea id="description" name="description" rows="2" placeholder="What was this for?"
                              class="w-full px-5 py-4 bg-[#faf8ed] border border-transparent focus:bg-white focus:border-[#c5d89d] text-[#2d2d2d] font-medium rounded-2xl transition-all outline-none placeholder-[#c5d89d]/50 resize-none">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-[10px] text-red-400 mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="pt-4 flex flex-col gap-3">
                    <button type="submit" class="w-full py-4 bg-[#6b7854] hover:bg-[#5a6546] text-white font-bold rounded-2xl transition shadow-md hover:shadow-lg active:scale-[0.98]">
                        Save Transaction
                    </button>
                    <a href="{{ route('transactions.index') }}" class="w-full py-3 text-[#9cab84] hover:text-[#6b7854] font-bold text-sm transition text-center">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
