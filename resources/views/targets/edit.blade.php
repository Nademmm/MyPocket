<x-app-layout title="Edit Savings Target">
    <div class="max-w-xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-[#2d2d2d] mb-1">Edit Target</h1>
                <p class="text-[#89986d] text-sm">Update your financial goal</p>
            </div>
            <a href="{{ route('targets.index') }}" class="flex items-center gap-2 px-4 py-2 bg-white border border-[#c5d89d]/50 text-[#89986d] hover:text-[#6b7854] hover:bg-[#f8faf2] rounded-xl transition-all shadow-sm group">
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

            <form method="POST" action="{{ route('targets.update', $target->id) }}" class="space-y-8 relative">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="space-y-3">
                    <label for="title" class="block text-xs font-bold uppercase tracking-widest text-[#9cab84] ml-1">
                        Target Title
                    </label>
                    <input type="text" id="title" name="title" value="{{ old('title', $target->title) }}" required placeholder="e.g., Emergency Fund, New Car, Vacation" class="w-full px-5 py-4 bg-white border-2 border-[#c5d89d]/20 focus:border-[#c5d89d] text-[#2d2d2d] font-bold rounded-2xl transition-all outline-none shadow-sm"/>
                    @error('title')
                        <p class="text-[10px] text-red-500 mt-1 ml-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Target Amount -->
                <div class="space-y-3">
                    <label for="target_amount" class="block text-xs font-bold uppercase tracking-widest text-[#9cab84] ml-1">
                        Target Amount
                    </label>
                    <div class="flex items-center px-4 bg-white border-2 border-[#c5d89d]/20 focus-within:border-[#c5d89d] focus-within:ring-4 focus-within:ring-[#c5d89d]/10 rounded-2xl transition-all shadow-sm overflow-hidden group">
                        <div class="pl-10 pr-4 py-5 bg-[#f8faf2]/30 text-2xl font-bold text-[#6b7854] group-focus-within:text-[#4a5535] group-focus-within:bg-[#f8faf2] transition-all select-none">
                            Rp
                        </div>
                        <input type="text" id="target_amount" name="target_amount" inputmode="numeric" 
                               value="{{ old('target_amount', number_format($target->target_amount, 0, ',', '.')) }}" 
                               required placeholder="0" maxlength="15"
                               style="border: none !important; outline: none !important; box-shadow: none !important;"
                               class="rupiah-input w-full py-5 px-6 bg-transparent text-[#2d2d2d] text-3xl font-bold focus:ring-0 focus:border-0 focus:outline-none"/>
                    </div>
                    @error('target_amount')
                        <p class="text-[10px] text-red-500 mt-1 ml-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current Amount -->
                <div class="space-y-3">
                    <label for="current_amount" class="block text-xs font-bold uppercase tracking-widest text-[#9cab84] ml-1">
                        Current Amount
                    </label>
                    <div class="flex items-center px-4 bg-white border-2 border-[#c5d89d]/20 focus-within:border-[#c5d89d] focus-within:ring-4 focus-within:ring-[#c5d89d]/10 rounded-2xl transition-all shadow-sm overflow-hidden group">
                        <div class="pl-10 pr-4 py-5 bg-[#f8faf2]/30 text-2xl font-bold text-[#6b7854] group-focus-within:text-[#4a5535] group-focus-within:bg-[#f8faf2] transition-all select-none">
                            Rp
                        </div>
                        <input type="text" id="current_amount" name="current_amount" inputmode="numeric" 
                               value="{{ old('current_amount', number_format($target->current_amount, 0, ',', '.')) }}" 
                               required placeholder="0" maxlength="15"
                               style="border: none !important; outline: none !important; box-shadow: none !important;"
                               class="rupiah-input w-full py-5 px-6 bg-transparent text-[#2d2d2d] text-3xl font-bold focus:ring-0 focus:border-0 focus:outline-none"/>
                    </div>
                    @error('current_amount')
                        <p class="text-[10px] text-red-500 mt-1 ml-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Deadline -->
                    <div class="space-y-3">
                        <label for="deadline" class="block text-xs font-bold uppercase tracking-widest text-[#9cab84] ml-1">
                            Target Deadline
                        </label>
                        <input type="date" id="deadline" name="deadline" value="{{ old('deadline', $target->deadline->toDateString()) }}" required class="w-full px-5 py-4 bg-white border-2 border-[#c5d89d]/20 focus:border-[#c5d89d] text-[#2d2d2d] font-bold rounded-2xl transition-all outline-none shadow-sm"/>
                        @error('deadline')
                            <p class="text-[10px] text-red-500 mt-1 ml-1 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="space-y-3">
                        <label for="status" class="block text-xs font-bold uppercase tracking-widest text-[#9cab84] ml-1">
                            Status
                        </label>
                        <select id="status" name="status" required class="w-full px-5 py-4 bg-white border-2 border-[#c5d89d]/20 focus:border-[#c5d89d] text-[#2d2d2d] font-bold rounded-2xl transition-all outline-none shadow-sm appearance-none cursor-pointer">
                            <option value="">Select Status</option>
                            <option value="active" {{ old('status', $target->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="completed" {{ old('status', $target->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status', $target->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <p class="text-[10px] text-red-500 mt-1 ml-1 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <style>
                    /* Hide spin buttons for Chrome, Safari, Edge, Opera */
                    .rupiah-input::-webkit-outer-spin-button,
                    .rupiah-input::-webkit-inner-spin-button {
                        -webkit-appearance: none;
                        margin: 0;
                    }

                    /* Hide spin buttons for Firefox */
                    .rupiah-input {
                        -moz-appearance: textfield;
                    }
                </style>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const rupiahInputs = document.querySelectorAll('.rupiah-input');
                        const form = document.querySelector('form');

                        rupiahInputs.forEach(input => {
                            // Format on input
                            input.addEventListener('input', function(e) {
                                let value = this.value.replace(/[^0-9]/g, '');
                                if (value !== "") {
                                    this.value = new Intl.NumberFormat('id-ID').format(value);
                                } else {
                                    this.value = "";
                                }
                            });
                        });

                        // Clean dots before submit
                        form.addEventListener('submit', function() {
                            rupiahInputs.forEach(input => {
                                input.value = input.value.replace(/\./g, '');
                            });
                        });
                    });
                </script>

                <!-- Action Buttons -->
                <div class="pt-6 flex flex-col gap-4 border-t border-[#c5d89d]/20">
                    <button type="submit" class="w-full py-4 bg-[#9cab84] text-[#2d2d2d] text-base font-bold rounded-2xl transition-all duration-200 shadow-sm flex items-center justify-center gap-2 group">
                        <span>Update Target</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>
                    <a href="{{ route('targets.index') }}" class="w-full py-4 text-[#9cab84] hover:text-[#6b7854] font-bold text-xs transition text-center uppercase tracking-widest border-2 border-transparent hover:border-[#c5d89d]/20 rounded-2xl">
                        Cancel and Return
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
