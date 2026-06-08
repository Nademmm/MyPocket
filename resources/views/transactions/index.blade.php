<x-app-layout title="Transactions">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-2">
            <div>
                <h1 class="text-4xl font-bold text-[#2d2d2d] mb-2">Transactions</h1>
                <p class="text-[#89986d]">Track your daily income and expenses </p>
            </div>
            <a href="{{ route('transactions.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#c5d89d] to-[#9cab84] hover:from-[#9cab84] hover:to-[#89986d] text-[#2d2d2d] font-semibold rounded-xl transition transform hover:scale-105 active:scale-95 shadow-lg border border-[#c5d89d]/50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                New Transaction
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

    @if($errors->has('error'))
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            {{ $errors->first('error') }}
        </div>
    @endif

    <!-- Transactions List -->
    @if($transactions->count())
        <div class="bg-gradient-to-br from-white to-[#faf8ed] border border-[#c5d89d]/30 rounded-2xl overflow-hidden shadow-lg shadow-[#c5d89d]/5">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-[#c5d89d]/10 border-b border-[#c5d89d]/30 text-left">
                            <th class="px-6 py-4 text-xs font-bold text-[#6b7854] uppercase tracking-wider">Transaction</th>
                            <th class="px-6 py-4 text-xs font-bold text-[#6b7854] uppercase tracking-wider">Date</th>
                            <th class="px-6 py-4 text-xs font-bold text-[#6b7854] uppercase tracking-wider text-right">Amount</th>
                            <th class="px-6 py-4 text-xs font-bold text-[#6b7854] uppercase tracking-wider text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#c5d89d]/20">
                        @foreach($transactions as $transaction)
                        <tr class="hover:bg-[#c5d89d]/5 transition-colors duration-150 group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 {{ $transaction->type == 'income' ? 'bg-[#c5d89d]/30 border border-[#c5d89d]/50' : 'bg-[#d9a3a3]/20 border border-[#d9a3a3]/30' }}">
                                        <svg class="w-5 h-5 {{ $transaction->type == 'income' ? 'text-[#6b7854]' : 'text-[#c17b7b]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            @if($transaction->type == 'income')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                                            @endif
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-[#2d2d2d] truncate max-w-[200px]">
                                            {{ $transaction->description ?: 'No description' }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[#89986d]">
                                {{ $transaction->transaction_date ? (is_string($transaction->transaction_date) ? \Illuminate\Support\Carbon::parse($transaction->transaction_date)->format('M d, Y') : $transaction->transaction_date->format('M d, Y')) : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <span class="text-sm font-bold {{ $transaction->type == 'income' ? 'text-[#6b7854]' : 'text-[#c17b7b]' }}">
                                    {{ $transaction->type == 'income' ? '+' : '-' }} Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end gap-3 transition-opacity duration-200">
                                    <a href="{{ route('transactions.edit', $transaction->id) }}" class="p-2 bg-gradient-to-br from-[#c5d89d] to-[#9cab84] hover:from-[#9cab84] hover:to-[#89986d] text-[#2d2d2d] rounded-lg transition border border-[#9cab84]/40 shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this transaction?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-gradient-to-br from-[#d9a3a3] to-[#c17b7b] hover:from-[#c17b7b] hover:to-[#a85a5a] text-white rounded-lg transition border border-[#c17b7b]/40 shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $transactions->links() }}
        </div>

    @else
        <!-- Empty State -->
        <div class="bg-gradient-to-br from-white to-[#faf8ed] border-2 border-dashed border-[#c5d89d]/50 rounded-2xl py-24 px-12 text-center shadow-lg shadow-[#c5d89d]/5">
            <div class="w-20 h-20 bg-gradient-to-br from-[#c5d89d]/30 to-[#9cab84]/20 rounded-2xl flex items-center justify-center mx-auto mb-6 border border-[#c5d89d]/30">
                <svg class="w-10 h-10 text-[#89986d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-[#2d2d2d] mb-2">No Transactions Yet</h3>
            <p class="text-[#89986d] mb-8 max-w-sm mx-auto">Start tracking your financial journey by adding your first transaction today.</p>
            <a href="{{ route('transactions.create') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-[#c5d89d] to-[#9cab84] hover:from-[#9cab84] hover:to-[#89986d] text-[#2d2d2d] font-bold rounded-xl transition transform hover:scale-105 active:scale-95 shadow-lg border border-[#c5d89d]/50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Your First Transaction
            </a>
        </div>
    @endif
</x-app-layout>
