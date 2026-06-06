<x-app-layout title="Transactions">

    {{-- Header --}}
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-blue-900 mb-1">Transactions</h1>
            <p class="text-gray-500 text-sm">Manage your income and expenses (Total: {{ $transactions->total() }})</p>
        </div>
        <a href="{{ route('transactions.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-xl transition shadow-sm active:scale-95">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Transaction
        </a>
    </div>

    {{-- Flash message --}}
    @if($message = Session::get('success'))
        <div class="mb-6 flex items-center justify-between p-4 bg-emerald-100 border border-emerald-200 text-emerald-700 rounded-xl">
            <div class="flex items-center gap-3">
                <div class="w-7 h-7 bg-emerald-500 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <span class="font-medium text-sm">{{ $message }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 transition p-1">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
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

    {{-- Transactions list --}}
    @if($transactions->count())
        <div class="bg-white rounded-2xl shadow-[0_2px_10px_rgba(0,0,0,0.05)] overflow-hidden">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="border-b-2 border-gray-200">
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wide">Transaction</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wide">Category</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wide">Date</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wide">Type</th>
                        <th class="text-right px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wide">Amount</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors duration-150">

                        {{-- Icon + description --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0
                                    {{ $transaction->type == 'income' ? 'bg-emerald-100' : 'bg-red-100' }}">
                                    <svg class="w-5 h-5 {{ $transaction->type == 'income' ? 'text-emerald-500' : 'text-red-500' }}"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        @if($transaction->type == 'income')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                                        @endif
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-500 truncate max-w-[160px]">
                                    {{ Str::limit($transaction->description, 40) ?: '—' }}
                                </p>
                            </div>
                        </td>

                        {{-- Category --}}
                        <td class="px-6 py-4">
                            <span class="text-sm font-medium text-gray-800">{{ $transaction->category->name ?? 'Unknown' }}</span>
                        </td>

                        {{-- Date --}}
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-500">{{ $transaction->transaction_date->format('M d, Y') }}</span>
                        </td>

                        {{-- Type badge --}}
                        <td class="px-6 py-4">
                            <span class="inline-block px-2.5 py-1 rounded-full text-xs font-semibold
                                {{ $transaction->type == 'income' ? 'bg-emerald-100 text-emerald-500' : 'bg-red-100 text-red-500' }}">
                                {{ ucfirst($transaction->type) }}
                            </span>
                        </td>

                        {{-- Amount --}}
                        <td class="px-6 py-4 text-right">
                            <span class="text-sm font-bold {{ $transaction->type == 'income' ? 'text-emerald-500' : 'text-red-500' }}">
                                {{ $transaction->type == 'income' ? '+' : '-' }}Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                            </span>
                        </td>

                        {{-- Actions --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('transactions.edit', $transaction->id) }}"
                                   class="p-2 text-gray-500 hover:text-blue-500 hover:bg-blue-100 rounded-lg transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete this transaction?')"
                                            class="p-2 text-gray-500 hover:text-red-500 hover:bg-red-100 rounded-lg transition">
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

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $transactions->links() }}
        </div>

    @else
        {{-- Empty state --}}
        <div class="bg-white rounded-2xl p-16 text-center shadow-[0_2px_10px_rgba(0,0,0,0.05)] border-2 border-dashed border-gray-200">
            <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-blue-900 mb-1">No Transactions Yet</h3>
            <p class="text-gray-500 text-sm mb-6">Start by adding your first transaction to track your finances</p>
            <a href="{{ route('transactions.create') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-xl transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Your First Transaction
            </a>
        </div>
    @endif

</x-app-layout>