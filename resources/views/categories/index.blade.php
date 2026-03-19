<x-app-layout title="Categories">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-2">
            <div>
                <h1 class="text-4xl font-bold text-[#EBD5AB] mb-2 drop-shadow-lg">Categories</h1>
                <p class="text-[#8BAE66]">Manage your transaction categories</p>
            </div>
            <a href="{{ route('categories.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#628141] to-[#4e672e] hover:from-[#4e672e] hover:to-[#3d5223] text-[#EBD5AB] font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 active:scale-95 shadow-lg border border-[#8BAE66]/30">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Category
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if($message = Session::get('success'))
        <div class="mb-6 p-4 bg-gradient-to-r from-[#628141]/20 to-[#4e672e]/20 border border-[#8BAE66]/40 text-[#aaffaa] rounded-xl flex items-center justify-between shadow-lg">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-[#628141] rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#EBD5AB]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <span class="font-medium">{{ $message }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-[#8BAE66] hover:text-[#aaffaa] transition">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
    @endif

    <!-- Categories Table -->
    @if($categories->count())
        <div class="bg-gradient-to-br from-[#252d24] to-[#1f261d] border border-[#628141]/20 rounded-2xl overflow-hidden shadow-xl shadow-[#1B211A]/50">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-[#1B211A] border-b border-[#628141]/20">
                            <th class="text-left py-4 px-6 text-[#8BAE66] text-sm uppercase tracking-wider font-semibold">Name</th>
                            <th class="text-left py-4 px-6 text-[#8BAE66] text-sm uppercase tracking-wider font-semibold">Type</th>
                            <th class="text-left py-4 px-6 text-[#8BAE66] text-sm uppercase tracking-wider font-semibold">Description</th>
                            <th class="text-center py-4 px-6 text-[#8BAE66] text-sm uppercase tracking-wider font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#628141]/10">
                        @foreach($categories as $category)
                            <tr class="hover:bg-[#628141]/5 transition-all duration-200">
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-[#628141] to-[#4e672e] rounded-lg flex items-center justify-center border border-[#8BAE66]/50 shadow-sm">
                                            <svg class="w-5 h-5 text-[#EBD5AB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                            </svg>
                                        </div>
                                        <span class="text-[#EBD5AB] font-medium">{{ $category->name }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="px-3 py-1 text-xs font-bold rounded-lg inline-flex items-center gap-1.5 border {{ $category->type == 'income' ? 'bg-[#628141]/20 border-[#8BAE66]/40 text-[#aaffaa]' : 'bg-[#8B4141]/20 border-[#ffaaaa]/30 text-[#ffcccc]' }}">
                                        @if($category->type == 'income')
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                                            </svg>
                                        @else
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                                            </svg>
                                        @endif
                                        {{ ucfirst($category->type) }}
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    <p class="text-[#8BAE66] text-sm truncate max-w-xs">{{ $category->description ?? 'No description' }}</p>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('categories.edit', $category->id) }}" class="p-2 bg-gradient-to-br from-[#628141] to-[#4e672e] hover:from-[#4e672e] hover:to-[#3d5223] text-[#EBD5AB] rounded-lg transition border border-[#8BAE66]/30 shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure? This will affect all transactions using this category.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 bg-gradient-to-br from-[#8B4141] to-[#672e2e] hover:from-[#672e2e] hover:to-[#522323] text-[#ffcccc] rounded-lg transition border border-[#ffaaaa]/30 shadow-sm">
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
        <div class="mt-6">
            {{ $categories->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-gradient-to-br from-[#252d24] to-[#1f261d] border-2 border-dashed border-[#628141]/30 rounded-2xl p-12 text-center shadow-xl shadow-[#1B211A]/50">
            <div class="w-20 h-20 bg-gradient-to-br from-[#628141] to-[#4e672e] rounded-full flex items-center justify-center mx-auto mb-4 border border-[#8BAE66]/50 shadow-inner">
                <svg class="w-10 h-10 text-[#EBD5AB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-[#EBD5AB] mb-2">No Categories Yet</h3>
            <p class="text-[#8BAE66] mb-6">Start by adding your first category to organize your transactions</p>
            <a href="{{ route('categories.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#628141] to-[#4e672e] hover:from-[#4e672e] hover:to-[#3d5223] text-[#EBD5AB] font-semibold rounded-xl transition shadow-lg border border-[#8BAE66]/30">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Your First Category
            </a>
        </div>
    @endif
</x-app-layout>
