<x-app-layout title="Transaction Details">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-2">
            <div>
                <h1 class="text-4xl font-bold text-[#2d2d2d] mb-2">Transaction Details</h1>
                <p class="text-[#89986d]">View transaction information</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('transactions.edit', $transaction->id) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#c5d89d] to-[#9cab84] hover:from-[#9cab84] hover:to-[#89986d] text-[#2d2d2d] font-semibold rounded-xl transition-all duration-300 shadow-lg border border-[#c5d89d]/50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <form method="POST" action="{{ route('transactions.destroy', $transaction->id) }}" onsubmit="return confirm('Are you sure you want to delete this transaction?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#d9a3a3] to-[#c17b7b] hover:from-[#c17b7b] hover:to-[#a85a5a] text-white font-semibold rounded-xl transition-all duration-300 shadow-lg border border-[#c17b7b]/50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Details Card -->
    <div class="bg-gradient-to-br from-white to-[#faf8ed] border border-[#c5d89d]/30 rounded-2xl p-6 md:p-8 shadow-xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Category -->
            <div class="bg-[#faf8ed] rounded-xl p-4 border border-[#c5d89d]/40">
                <label class="block text-sm font-medium text-[#6b7854] mb-1">Category</label>
                <p class="text-lg font-semibold text-[#2d2d2d]">{{ $transaction->category->name ?? 'Unknown' }}</p>
            </div>

            <!-- Type -->
            <div class="bg-[#faf8ed] rounded-xl p-4 border border-[#c5d89d]/40">
                <label class="block text-sm font-medium text-[#6b7854] mb-1">Type</label>
                <p class="text-lg font-semibold {{ $transaction->type == 'income' ? 'text-[#6b7854]' : 'text-[#8b4141]' }} flex items-center gap-2">
                    @if($transaction->type == 'income')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                        </svg>
                    @else
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                        </svg>
                    @endif
                    {{ ucfirst($transaction->type) }}
                </p>
            </div>

            <!-- Amount -->
            <div class="bg-[#faf8ed] rounded-xl p-4 border border-[#c5d89d]/40">
                <label class="block text-sm font-medium text-[#6b7854] mb-1">Amount</label>
                <p class="text-2xl font-bold text-[#2d2d2d]">Rp {{ number_format($transaction->amount, 2, ',', '.') }}</p>
            </div>

            <!-- Transaction Date -->
            <div class="bg-[#faf8ed] rounded-xl p-4 border border-[#c5d89d]/40">
                <label class="block text-sm font-medium text-[#6b7854] mb-1">Transaction Date</label>
                <p class="text-lg font-semibold text-[#2d2d2d]">{{ $transaction->transaction_date->format('F d, Y') }}</p>
            </div>

            <!-- Description -->
            <div class="md:col-span-2 bg-[#faf8ed] rounded-xl p-4 border border-[#c5d89d]/40">
                <label class="block text-sm font-medium text-[#6b7854] mb-1">Description</label>
                <p class="text-[#2d2d2d]">{{ $transaction->description ?? 'No description provided' }}</p>
            </div>

            <!-- Metadata -->
            <div class="md:col-span-2 pt-4 border-t border-[#c5d89d]/30">
                <div class="flex flex-wrap gap-4 text-sm text-[#89986d]">
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Created: {{ $transaction->created_at->format('M d, Y H:i') }}
                    </span>
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Updated: {{ $transaction->updated_at->format('M d, Y H:i') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-6 pt-6 border-t border-[#c5d89d]/30">
            <a href="{{ route('transactions.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#c5d89d]/30 to-[#9cab84]/20 hover:from-[#c5d89d]/50 hover:to-[#9cab84]/30 text-[#2d2d2d] font-semibold rounded-xl transition-all duration-300 border border-[#c5d89d]/50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Transactions
            </a>
        </div>
    </div>
</x-app-layout>
