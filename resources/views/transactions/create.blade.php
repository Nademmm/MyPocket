<x-app-layout title="Create Transaction">

    {{-- Header --}}
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-blue-900 mb-1">Create Transaction</h1>
            <p class="text-gray-500 text-sm">Record your income or expense</p>
        </div>
        <a href="{{ route('transactions.index') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-gray-200 text-gray-500 font-medium rounded-xl hover:bg-gray-100 hover:border-gray-300 transition shadow-[0_2px_10px_rgba(0,0,0,0.05)]">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to List
        </a>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-2xl p-6 md:p-8 shadow-[0_2px_10px_rgba(0,0,0,0.05)]">
        <form method="POST" action="{{ route('transactions.store') }}" class="space-y-6">
            @csrf

            {{-- Category --}}
            <div>
                <label for="category_id" class="block text-sm font-semibold text-blue-900 mb-1.5">
                    Category <span class="text-blue-500">*</span>
                </label>
                <select id="category_id" name="category_id" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 text-gray-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Type --}}
            <div>
                <label class="block text-sm font-semibold text-blue-900 mb-1.5">
                    Type <span class="text-blue-500">*</span>
                </label>
                <div class="grid grid-cols-2 gap-3">
                    <label id="label-income"
                           class="flex items-center gap-3 p-3.5 bg-gray-50 border border-gray-200 rounded-xl cursor-pointer hover:border-emerald-400 transition">
                        <input type="radio" name="type" value="income" {{ old('type') == 'income' ? 'checked' : '' }}
                               class="w-4 h-4 text-blue-500 border-gray-200 focus:ring-blue-500" required>
                        <span class="flex items-center gap-1.5 font-medium text-gray-800">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                            </svg>
                            Income
                        </span>
                    </label>
                    <label id="label-expense"
                           class="flex items-center gap-3 p-3.5 bg-gray-50 border border-gray-200 rounded-xl cursor-pointer hover:border-red-400 transition">
                        <input type="radio" name="type" value="expense" {{ old('type') == 'expense' ? 'checked' : '' }}
                               class="w-4 h-4 text-red-500 border-gray-200 focus:ring-red-500" required>
                        <span class="flex items-center gap-1.5 font-medium text-gray-800">
                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                            </svg>
                            Expense
                        </span>
                    </label>
                </div>
                @error('type')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Amount --}}
            <div>
                <label for="amount" class="block text-sm font-semibold text-blue-900 mb-1.5">
                    Amount <span class="text-blue-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-semibold text-sm">Rp</span>
                    <input type="number" id="amount" name="amount" value="{{ old('amount') }}"
                           required min="0" step="0.01" placeholder="0"
                           class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 text-gray-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition placeholder-gray-500">
                </div>
                @error('amount')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-semibold text-blue-900 mb-1.5">Description</label>
                <textarea id="description" name="description" rows="3" placeholder="Enter description..."
                          class="w-full px-4 py-3 bg-gray-50 border border-gray-200 text-gray-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition placeholder-gray-500 resize-none">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Transaction Date --}}
            <div>
                <label for="transaction_date" class="block text-sm font-semibold text-blue-900 mb-1.5">
                    Transaction Date <span class="text-blue-500">*</span>
                </label>
                <input type="date" id="transaction_date" name="transaction_date"
                       value="{{ old('transaction_date', now()->format('Y-m-d')) }}" required
                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 text-gray-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                @error('transaction_date')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('transactions.index') }}"
                   class="px-5 py-2.5 bg-gray-50 border border-gray-200 text-gray-500 font-medium rounded-xl hover:bg-gray-100 transition">
                    Cancel
                </a>
                <button type="submit"
                        class="px-6 py-2.5 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-xl transition shadow-sm">
                    Create Transaction
                </button>
            </div>
        </form>
    </div>

    <script>
        const incomeLabel  = document.getElementById('label-income');
        const expenseLabel = document.getElementById('label-expense');

        function updateTypeStyle(val) {
            incomeLabel.classList.remove('border-emerald-500', 'bg-emerald-100');
            expenseLabel.classList.remove('border-red-500', 'bg-red-100');
            if (val === 'income')  incomeLabel.classList.add('border-emerald-500', 'bg-emerald-100');
            if (val === 'expense') expenseLabel.classList.add('border-red-500', 'bg-red-100');
        }

        document.querySelectorAll('input[name="type"]').forEach(r =>
            r.addEventListener('change', () => updateTypeStyle(r.value))
        );

        const checked = document.querySelector('input[name="type"]:checked');
        if (checked) updateTypeStyle(checked.value);
    </script>

</x-app-layout>