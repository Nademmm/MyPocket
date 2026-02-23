<x-app-layout title="Transactions">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-2">
            <div>
                <h1 class="text-4xl font-bold text-[#2d2d2d] mb-2">Transactions</h1>
                <p class="text-[#89986d]">Manage your income and expenses</p>
            </div>
            <a href="{{ route('transactions.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#c5d89d] to-[#9cab84] hover:from-[#9cab84] hover:to-[#89986d] text-[#2d2d2d] font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 active:scale-95 shadow-lg border border-[#c5d89d]/50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Transaction
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if($message = Session::get('success'))
        <div class="mb-6 p-4 bg-gradient-to-r from-[#c5d89d]/30 to-[#9cab84]/20 border border-[#c5d89d]/50 text-[#6b7854] rounded-xl flex items-center justify-between shadow-lg">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-gradient-to-br from-[#c5d89d] to-[#9cab84] rounded-full flex items-center justify-center border border-[#9cab84]/40">
                    <svg class="w-5 h-5 text-[#2d2d2d]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <span class="font-medium">{{ $message }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-[#89986d] hover:text-[#6b7854] transition">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
    @endif

    <!-- Transactions List -->
    @if($transactions->count())
        <div class="space-y-3">
            @foreach($transactions as $transaction)
                <div class="bg-gradient-to-r from-white to-[#faf8ed] border border-[#c5d89d]/30 rounded-xl overflow-hidden hover:border-[#9cab84]/50 transition-all duration-300 hover:shadow-xl hover:shadow-[#c5d89d]/10 hover:-translate-y-0.5">
                    <div class="p-4">
                        <div class="flex items-center justify-between">
                            <!-- Left Section -->
                            <div class="flex items-center gap-4 flex-1">
                                <!-- Icon -->
                                <div class="w-12 h-12 rounded-xl {{ $transaction->type == 'income' ? 'bg-gradient-to-br from-[#c5d89d] to-[#9cab84] border-[#9cab84]/50' : 'bg-gradient-to-br from-[#d9a3a3] to-[#c17b7b] border-[#c17b7b]/50' }} flex items-center justify-center flex-shrink-0 border shadow-inner">
                                    <svg class="w-6 h-6 {{ $transaction->type == 'income' ? 'text-[#2d2d2d]' : 'text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        @if($transaction->type == 'income')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                                        @endif
                                    </svg>
                                </div>
                                <!-- Details -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 mb-1">
                                        <h3 class="text-sm font-semibold text-[#2d2d2d] truncate">{{ $transaction->category->name ?? 'Unknown' }}</h3>
                                        <span class="px-2 py-0.5 bg-[#c5d89d]/30 border border-[#9cab84]/40 text-[#6b7854] text-xs font-medium rounded-full">{{ $transaction->transaction_date->format('M d, Y') }}</span>
                                    </div>
                                    <p class="text-xs text-[#89986d] truncate">{{ Str::limit($transaction->description, 50) }}</p>
                                </div>
                                <!-- Amount -->
                                <div class="text-right flex-shrink-0">
                                    <p class="text-lg font-bold {{ $transaction->type == 'income' ? 'text-[#6b7854]' : 'text-[#8b4141]' }}">
                                        {{ $transaction->type == 'income' ? '+' : '-' }}Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                            <!-- Actions -->
                            <div class="flex gap-2 ml-4">
                                <a href="{{ route('transactions.edit', $transaction->id) }}" class="p-2 bg-gradient-to-br from-[#c5d89d] to-[#9cab84] hover:from-[#9cab84] hover:to-[#89986d] text-[#2d2d2d] rounded-lg transition border border-[#9cab84]/40 shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="p-2 bg-gradient-to-br from-[#d9a3a3] to-[#c17b7b] hover:from-[#c17b7b] hover:to-[#a85a5a] text-white rounded-lg transition border border-[#c17b7b]/40 shadow-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $transactions->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-gradient-to-br from-white to-[#faf8ed] border-2 border-dashed border-[#c5d89d]/40 rounded-2xl p-12 text-center shadow-xl">
            <div class="w-20 h-20 bg-gradient-to-br from-[#c5d89d] to-[#9cab84] rounded-full flex items-center justify-center mx-auto mb-4 border border-[#9cab84]/50 shadow-inner">
                <svg class="w-10 h-10 text-[#2d2d2d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-[#2d2d2d] mb-2">No Transactions Yet</h3>
            <p class="text-[#89986d] mb-6">Start by adding your first transaction to track your finances</p>
            <a href="{{ route('transactions.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#c5d89d] to-[#9cab84] hover:from-[#9cab84] hover:to-[#89986d] text-[#2d2d2d] font-semibold rounded-xl transition shadow-lg border border-[#c5d89d]/50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Your First Transaction
            </a>
        </div>
    @endif
</x-app-layout>
