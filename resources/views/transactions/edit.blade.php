<x-app-layout title="Edit Transaction">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-[#2d2d2d] mb-2">Edit Transaction</h1>
            <p class="text-[#89986d]">Update your transaction details to keep your records accurate</p>
        </div>

        <!-- Form Card -->
        <div class="bg-gradient-to-br from-white to-[#faf8ed] border border-[#c5d89d]/30 rounded-2xl p-6 md:p-8 shadow-xl">
            @if($errors->has('error'))
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    {{ $errors->first('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('transactions.update', $transaction->id) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-[#6b7854] mb-2">
                        Category <span class="text-[#9cab84]">*</span>
                    </label>
                    <select id="category_id" name="category_id" required
                            class="w-full px-4 py-3 bg-[#faf8ed] border border-[#c5d89d]/50 text-[#2d2d2d] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#c5d89d] focus:border-transparent transition">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $transaction->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-2 text-sm text-[#c17b7b]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Type -->
                <div>
                    <label class="block text-sm font-medium text-[#6b7854] mb-2">
                        Transaction Type <span class="text-[#9cab84]">*</span>
                    </label>
                    <div class="grid grid-cols-2 gap-4">
                        @php $currentType = old('type', $transaction->type); @endphp
                        <label class="relative flex items-center justify-center p-4 bg-[#faf8ed] border-2 {{ $currentType == 'income' ? 'border-[#c5d89d] bg-[#c5d89d]/10' : 'border-[#c5d89d]/30' }} rounded-xl cursor-pointer hover:border-[#c5d89d] transition-all has-[:checked]:border-[#c5d89d] has-[:checked]:bg-[#c5d89d]/10">
                            <input type="radio" name="type" value="income" {{ $currentType == 'income' ? 'checked' : '' }} class="hidden" required>
                            <div class="flex flex-col items-center gap-1">
                                <svg class="w-6 h-6 text-[#6b7854]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                                </svg>
                                <span class="text-sm font-bold text-[#2d2d2d]">Income</span>
                            </div>
                        </label>
                        <label class="relative flex items-center justify-center p-4 bg-[#faf8ed] border-2 {{ $currentType == 'expense' ? 'border-[#d9a3a3] bg-[#d9a3a3]/10' : 'border-[#d9a3a3]/30' }} rounded-xl cursor-pointer hover:border-[#d9a3a3] transition-all has-[:checked]:border-[#d9a3a3] has-[:checked]:bg-[#d9a3a3]/10">
                            <input type="radio" name="type" value="expense" {{ $currentType == 'expense' ? 'checked' : '' }} class="hidden" required>
                            <div class="flex flex-col items-center gap-1">
                                <svg class="w-6 h-6 text-[#c17b7b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                                </svg>
                                <span class="text-sm font-bold text-[#2d2d2d]">Expense</span>
                            </div>
                        </label>
                    </div>
                    @error('type')
                        <p class="mt-2 text-sm text-[#c17b7b]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Amount -->
                <div>
                    <label for="amount" class="block text-sm font-medium text-[#6b7854] mb-2">
                        Amount <span class="text-[#9cab84]">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[#9cab84] font-bold">Rp</span>
                        <input type="number" id="amount" name="amount" value="{{ old('amount', $transaction->amount) }}"
                               required min="0" step="0.01" placeholder="0.00"
                               class="w-full pl-12 pr-4 py-3 bg-[#faf8ed] border border-[#c5d89d]/50 text-[#2d2d2d] placeholder-[#9cab84] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#c5d89d] focus:border-transparent transition">
                    </div>
                    @error('amount')
                        <p class="mt-2 text-sm text-[#c17b7b]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date -->
                <div>
                    <label for="transaction_date" class="block text-sm font-medium text-[#6b7854] mb-2">
                        Transaction Date <span class="text-[#9cab84]">*</span>
                    </label>
                    <input type="date" id="transaction_date" name="transaction_date"
                           value="{{ old('transaction_date', $transaction->transaction_date->format('Y-m-d')) }}" required
                           class="w-full px-4 py-3 bg-[#faf8ed] border border-[#c5d89d]/50 text-[#2d2d2d] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#c5d89d] focus:border-transparent transition">
                    @error('transaction_date')
                        <p class="mt-2 text-sm text-[#c17b7b]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-[#6b7854] mb-2">Description</label>
                    <textarea id="description" name="description" rows="3" placeholder="What was this for?"
                              class="w-full px-4 py-3 bg-[#faf8ed] border border-[#c5d89d]/50 text-[#2d2d2d] placeholder-[#9cab84] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#c5d89d] focus:border-transparent transition resize-none">{{ old('description', $transaction->description) }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-[#c17b7b]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-4 pt-6 border-t border-[#c5d89d]/30">
                    <button type="submit" class="flex-1 px-8 py-4 bg-gradient-to-r from-[#c5d89d] to-[#9cab84] hover:from-[#9cab84] hover:to-[#89986d] text-[#2d2d2d] font-bold rounded-xl transition transform hover:scale-105 active:scale-95 shadow-lg border border-[#c5d89d]/50">
                        Update Transaction
                    </button>
                    <a href="{{ route('transactions.index') }}" class="px-8 py-4 bg-[#faf8ed] hover:bg-[#c5d89d]/20 border border-[#c5d89d]/50 text-[#6b7854] font-bold rounded-xl transition text-center">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Simple UI feedback for radio buttons
        document.querySelectorAll('input[name="type"]').forEach(input => {
            input.addEventListener('change', function() {
                // Reset all labels
                document.querySelectorAll('input[name="type"]').forEach(other => {
                    const label = other.closest('label');
                    const isIncome = other.value === 'income';
                    label.classList.remove('border-[#c5d89d]', 'bg-[#c5d89d]/10', 'border-[#d9a3a3]', 'bg-[#d9a3a3]/10');
                    label.classList.add(isIncome ? 'border-[#c5d89d]/30' : 'border-[#d9a3a3]/30');
                });
                
                // Set active label
                const label = this.closest('label');
                const isIncome = this.value === 'income';
                label.classList.remove(isIncome ? 'border-[#c5d89d]/30' : 'border-[#d9a3a3]/30');
                label.classList.add(isIncome ? 'border-[#c5d89d]' : 'border-[#d9a3a3]');
                label.classList.add(isIncome ? 'bg-[#c5d89d]/10' : 'bg-[#d9a3a3]/10');
            });
        });
    </script>
</x-app-layout>
