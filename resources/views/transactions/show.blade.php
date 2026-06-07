<x-app-layout title="Transaction Details">

    {{-- Header --}}
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-blue-900 mb-1">Transaction Details</h1>
            <p class="text-gray-500 text-sm">View transaction information</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('transactions.edit', $transaction->id) }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-xl transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit
            </a>
            <form method="POST" action="{{ route('transactions.destroy', $transaction->id) }}"
                  onsubmit="return confirm('Delete this transaction?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-red-200 text-red-500 font-semibold rounded-xl hover:bg-red-100 transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Delete
                </button>
            </form>
        </div>
    </div>

    {{-- Detail Card --}}
    <div class="bg-white rounded-2xl p-6 md:p-8 shadow-[0_2px_10px_rgba(0,0,0,0.05)]">

        {{-- Amount hero --}}
        <div class="flex items-center gap-4 p-5 rounded-xl mb-6
            {{ $transaction->type == 'income' ? 'bg-emerald-100 border border-emerald-200' : 'bg-red-100 border border-red-200' }}">
            <div class="w-14 h-14 rounded-xl flex items-center justify-center flex-shrink-0
                {{ $transaction->type == 'income' ? 'bg-emerald-500' : 'bg-red-500' }}">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    @if($transaction->type == 'income')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                    @else
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                    @endif
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold {{ $transaction->type == 'income' ? 'text-emerald-500' : 'text-red-500' }} mb-0.5">
                    {{ ucfirst($transaction->type) }}
                </p>
                <p class="text-2xl font-bold {{ $transaction->type == 'income' ? 'text-emerald-500' : 'text-red-500' }}">
                    {{ $transaction->type == 'income' ? '+' : '-' }}Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                </p>
            </div>
        </div>

        {{-- Detail fields --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Transaction Date</p>
                <p class="text-base font-semibold text-blue-900">{{ $transaction->transaction_date->format('F d, Y') }}</p>
            </div>

            <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Description</p>
                <p class="text-base text-gray-800">{{ $transaction->description ?? '—' }}</p>
            </div>

        </div>

        {{-- Metadata --}}
        <div class="mt-6 pt-5 border-t border-gray-200 flex flex-wrap gap-4">
            <span class="flex items-center gap-1.5 text-xs text-gray-500">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Created {{ $transaction->created_at->format('M d, Y H:i') }}
            </span>
            <span class="flex items-center gap-1.5 text-xs text-gray-500">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Updated {{ $transaction->updated_at->format('M d, Y H:i') }}
            </span>
        </div>

        {{-- Back button --}}
        <div class="mt-6 pt-5 border-t border-gray-200">
            <a href="{{ route('transactions.index') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-50 border border-gray-200 text-gray-500 font-medium rounded-xl hover:bg-gray-100 hover:border-gray-300 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Transactions
            </a>
        </div>
    </div>

</x-app-layout>