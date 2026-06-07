<x-app-layout title="Edit Transaction">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-[#2d2d2d] mb-1">Edit Transaction</h1>
                <p class="text-[#89986d] text-sm">Update your transaction details to keep your records accurate</p>
            </div>
            <a href="{{ route('transactions.index') }}" class="flex items-center gap-2 px-4 py-2 bg-white border border-[#c5d89d]/50 text-[#89986d] hover:text-[#6b7854] hover:bg-[#f8faf2] rounded-xl transition-all shadow-sm group">
                <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span class="font-bold text-sm">Back</span>
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

            <form method="POST" action="{{ route('transactions.update', $transaction->id) }}" class="space-y-8 relative">
                @csrf
                @method('PUT')

                <!-- Type Selector -->
                <div class="space-y-3">
                    <label class="block text-xs font-bold uppercase tracking-widest text-[#9cab84] ml-1">
                        Transaction Type
                    </label>
                    <div class="grid grid-cols-2 gap-4" id="type-selector-container">
                        @php $currentType = old('type', $transaction->type); @endphp
                        <!-- Income Option -->
                        <label class="relative cursor-pointer group flex-1">
                            <input type="radio" name="type" value="income" {{ $currentType == 'income' ? 'checked' : '' }} class="hidden" required>
                            <div class="type-card flex flex-col items-center justify-center p-5 bg-white border-2 border-gray-100 rounded-2xl transition-all duration-200">
                                <div class="icon-circle w-12 h-12 rounded-full bg-gray-50 flex items-center justify-center mb-2 transition-all duration-200">
                                    <svg class="w-7 h-7 text-gray-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                                    </svg>
                                </div>
                                <span class="text-xs font-bold text-gray-400 transition-colors">Income</span>
                            </div>
                        </label>

                        <!-- Expense Option -->
                        <label class="relative cursor-pointer group flex-1">
                            <input type="radio" name="type" value="expense" {{ $currentType == 'expense' ? 'checked' : '' }} class="hidden" required>
                            <div class="type-card flex flex-col items-center justify-center p-5 bg-white border-2 border-gray-100 rounded-2xl transition-all duration-200">
                                <div class="icon-circle w-12 h-12 rounded-full bg-gray-50 flex items-center justify-center mb-2 transition-all duration-200">
                                    <svg class="w-7 h-7 text-gray-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                                    </svg>
                                </div>
                                <span class="text-xs font-bold text-gray-400 transition-colors">Expense</span>
                            </div>
                        </label>
                    </div>

                    <style>
                        .type-card.active-income {
                            border-color: #c5d89d !important;
                            background-color: #f8faf2 !important;
                            box-shadow: 0 0 0 1px #c5d89d !important;
                        }
                        .type-card.active-income .icon-circle {
                            background-color: #c5d89d !important;
                        }
                        .type-card.active-income svg {
                            color: white !important;
                        }
                        .type-card.active-income span {
                            color: #6b7854 !important;
                        }

                        .type-card.active-expense {
                            border-color: #d9a3a3 !important;
                            background-color: #fff9f9 !important;
                            box-shadow: 0 0 0 1px #d9a3a3 !important;
                        }
                        .type-card.active-expense .icon-circle {
                            background-color: #d9a3a3 !important;
                        }
                        .type-card.active-expense svg {
                            color: white !important;
                        }
                        .type-card.active-expense span {
                            color: #c17b7b !important;
                        }
                        
                        .type-card:hover:not(.active-income):not(.active-expense) {
                            border-color: #e5e7eb;
                            background-color: #f9fafb;
                        }
                    </style>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const container = document.getElementById('type-selector-container');
                            const radios = container.querySelectorAll('input[type="radio"]');
                            
                            function updateStyles() {
                                radios.forEach(radio => {
                                    const card = radio.nextElementSibling;
                                    const isIncome = radio.value === 'income';
                                    
                                    if (radio.checked) {
                                        card.classList.add(isIncome ? 'active-income' : 'active-expense');
                                        card.classList.remove(isIncome ? 'active-expense' : 'active-income');
                                    } else {
                                        card.classList.remove('active-income', 'active-expense');
                                    }
                                });
                            }

                            radios.forEach(radio => {
                                radio.addEventListener('change', updateStyles);
                                radio.closest('label').addEventListener('click', (e) => {
                                    radio.checked = true;
                                    updateStyles();
                                });
                            });

                            updateStyles();
                        });
                    </script>
                    @error('type')
                        <p class="text-[10px] text-red-500 mt-1 ml-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Amount -->
                <div class="space-y-3">
                    <label for="amount" class="block text-xs font-bold uppercase tracking-widest text-[#9cab84] ml-1">
                        Amount
                    </label>
                    <div class="flex items-center px-4 bg-white border-2 border-[#c5d89d]/20 focus-within:border-[#c5d89d] focus-within:ring-4 focus-within:ring-[#c5d89d]/10 rounded-2xl transition-all shadow-sm overflow-hidden group">
                        <div class="pl-10 pr-4 py-5 bg-[#f8faf2]/30 text-2xl font-bold text-[#6b7854] group-focus-within:text-[#4a5535] group-focus-within:bg-[#f8faf2] transition-all select-none">
                            Rp
                        </div>
                        <input type="number" id="amount" name="amount" value="{{ old('amount', $transaction->amount) }}"
                               required min="0" step="0.01" placeholder="0"
                               style="border: none !important; outline: none !important; box-shadow: none !important;"
                               class="amount-input w-full py-5 px-6 bg-transparent text-[#2d2d2d] text-3xl font-bold focus:ring-0 focus:border-0 focus:outline-none">
                    </div>

                    <style>
                        /* Hide spin buttons for Chrome, Safari, Edge, Opera */
                        .amount-input::-webkit-outer-spin-button,
                        .amount-input::-webkit-inner-spin-button {
                            -webkit-appearance: none;
                            margin: 0;
                        }

                        /* Hide spin buttons for Firefox */
                        .amount-input {
                            -moz-appearance: textfield;
                        }
                    </style>
                    @error('amount')
                        <p class="text-[10px] text-red-500 mt-1 ml-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 gap-6">
                    <!-- Date -->
                    <div class="space-y-3">
                        <label for="transaction_date" class="block text-xs font-bold uppercase tracking-widest text-[#9cab84] ml-1">
                            Date
                        </label>
                        <input type="date" id="transaction_date" name="transaction_date"
                               value="{{ old('transaction_date', $transaction->transaction_date->format('Y-m-d')) }}" required
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
                              class="w-full px-5 py-4 bg-white border-2 border-[#c5d89d]/20 focus:border-[#c5d89d] text-[#2d2d2d] font-medium rounded-2xl transition-all outline-none placeholder-[#c5d89d]/40 resize-none shadow-sm">{{ old('description', $transaction->description) }}</textarea>
                    @error('description')
                        <p class="text-[10px] text-red-500 mt-1 ml-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="pt-6 flex flex-col gap-4 border-t border-[#c5d89d]/20">
                    <button type="submit" class="w-full py-4 bg-[#9cab84] text-[#2d2d2d] text-base font-bold rounded-2xl transition-all duration-200 shadow-sm flex items-center justify-center gap-2 group">
                        <span>Update Transaction</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>
                    <a href="{{ route('transactions.index') }}" class="w-full py-4 text-[#9cab84] hover:text-[#6b7854] font-bold text-xs transition text-center uppercase tracking-widest border-2 border-transparent hover:border-[#c5d89d]/20 rounded-2xl">
                        Cancel and Return
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
