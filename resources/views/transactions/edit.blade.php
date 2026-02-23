<x-app-layout title="Edit Transaction">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-2">
            <div>
                <h1 class="text-4xl font-bold text-[#2d2d2d] mb-2">Edit Transaction</h1>
                <p class="text-[#89986d]">Update your transaction details</p>
            </div>
            <a href="{{ route('transactions.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#c5d89d]/30 to-[#9cab84]/20 hover:from-[#c5d89d]/50 hover:to-[#9cab84]/30 text-[#2d2d2d] font-semibold rounded-xl transition-all duration-300 border border-[#c5d89d]/50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to List
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-gradient-to-br from-white to-[#faf8ed] border border-[#c5d89d]/30 rounded-2xl p-6 md:p-8 shadow-xl">
        <form method="POST" action="{{ route('transactions.update', $transaction->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Category -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-[#6b7854] mb-2">
                    Category <span class="text-[#9cab84]">*</span>
                </label>
                <select id="category_id" name="category_id" required class="w-full px-4 py-3 bg-[#faf8ed] border border-[#c5d89d]/50 text-[#2d2d2d] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#c5d89d] focus:border-transparent transition">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (old('category_id', $transaction->category_id) == $category->id) ? 'selected' : '' }} class="bg-[#faf8ed]">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1 text-sm text-[#c17b7b]">{{ $message }}</p>
                @enderror
            </div>

            <!-- Type -->
            <div>
                <label class="block text-sm font-medium text-[#6b7854] mb-2">
                    Type <span class="text-[#9cab84]">*</span>
                </label>
                <div class="grid grid-cols-2 gap-3">
                    <label class="flex items-center p-3 bg-[#faf8ed] border border-[#c5d89d]/50 rounded-xl cursor-pointer hover:border-[#9cab84]/70 transition {{ $transaction->type == 'income' ? 'border-[#c5d89d] bg-[#c5d89d]/20' : '' }}" id="label-income">
                        <input type="radio" name="type" value="income" {{ $transaction->type == 'income' ? 'checked' : '' }} class="w-4 h-4 text-[#c5d89d] bg-[#faf8ed] border-[#c5d89d]/50 focus:ring-[#c5d89d]" required>
                        <span class="ml-2 text-[#2d2d2d]">
                            <svg class="w-5 h-5 inline mr-1 text-[#6b7854]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                            </svg>
                            Income
                        </span>
                    </label>
                    <label class="flex items-center p-3 bg-[#faf8ed] border border-[#c5d89d]/50 rounded-xl cursor-pointer hover:border-[#c17b7b]/50 transition {{ $transaction->type == 'expense' ? 'border-[#d9a3a3] bg-[#d9a3a3]/20' : '' }}" id="label-expense">
                        <input type="radio" name="type" value="expense" {{ $transaction->type == 'expense' ? 'checked' : '' }} class="w-4 h-4 text-[#c17b7b] bg-[#faf8ed] border-[#c5d89d]/50 focus:ring-[#c17b7b]" required>
                        <span class="ml-2 text-[#2d2d2d]">
                            <svg class="w-5 h-5 inline mr-1 text-[#c17b7b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                            </svg>
                            Expense
                        </span>
                    </label>
                </div>
                @error('type')
                    <p class="mt-1 text-sm text-[#c17b7b]">{{ $message }}</p>
                @enderror
            </div>

            <!-- Amount -->
            <div>
                <label for="amount" class="block text-sm font-medium text-[#6b7854] mb-2">
                    Amount <span class="text-[#9cab84]">*</span>
                </label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[#9cab84] font-semibold">Rp</span>
                    <input type="number" id="amount" name="amount" value="{{ old('amount', $transaction->amount) }}" required min="0" step="0.01" class="w-full pl-12 pr-4 py-3 bg-[#faf8ed] border border-[#c5d89d]/50 text-[#2d2d2d] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#c5d89d] focus:border-transparent transition placeholder-[#9cab84]" placeholder="0.00">
                </div>
                @error('amount')
                    <p class="mt-1 text-sm text-[#c17b7b]">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-[#6b7854] mb-2">
                    Description
                </label>
                <textarea id="description" name="description" rows="3" class="w-full px-4 py-3 bg-[#faf8ed] border border-[#c5d89d]/50 text-[#2d2d2d] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#c5d89d] focus:border-transparent transition placeholder-[#9cab84]" placeholder="Enter description...">{{ old('description', $transaction->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-[#c17b7b]">{{ $message }}</p>
                @enderror
            </div>

            <!-- Transaction Date -->
            <div>
                <label for="transaction_date" class="block text-sm font-medium text-[#6b7854] mb-2">
                    Transaction Date <span class="text-[#9cab84]">*</span>
                </label>
                <input type="date" id="transaction_date" name="transaction_date" value="{{ old('transaction_date', $transaction->transaction_date->format('Y-m-d')) }}" required class="w-full px-4 py-3 bg-[#faf8ed] border border-[#c5d89d]/50 text-[#2d2d2d] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#c5d89d] focus:border-transparent transition">
                @error('transaction_date')
                    <p class="mt-1 text-sm text-[#c17b7b]">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end gap-4 pt-4 border-t border-[#c5d89d]/30">
                <a href="{{ route('transactions.index') }}" class="px-6 py-3 bg-[#faf8ed] border border-[#c5d89d]/50 text-[#6b7854] font-semibold rounded-xl hover:bg-[#c5d89d]/20 transition">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-[#c5d89d] to-[#9cab84] hover:from-[#9cab84] hover:to-[#89986d] text-[#2d2d2d] font-semibold rounded-xl transition shadow-lg border border-[#c5d89d]/50">
                    Update Transaction
                </button>
            </div>
        </form>
    </div>

    <script>
        // Add visual feedback for radio buttons
        document.querySelectorAll('input[name="type"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.getElementById('label-income').classList.remove('border-[#c5d89d]', 'bg-[#c5d89d]/20');
                document.getElementById('label-expense').classList.remove('border-[#d9a3a3]', 'bg-[#d9a3a3]/20');
                
                if (this.value === 'income') {
                    document.getElementById('label-income').classList.add('border-[#c5d89d]', 'bg-[#c5d89d]/20');
                } else {
                    document.getElementById('label-expense').classList.add('border-[#d9a3a3]', 'bg-[#d9a3a3]/20');
                }
            });
        });
    </script>
</x-app-layout>
