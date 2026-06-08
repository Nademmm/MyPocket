<x-app-layout title="Manage Badges">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Badge Achievements</h1>
            <p class="text-gray-600">Create and manage gamification rewards</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-white border border-gray-200 text-gray-600 font-bold rounded-xl hover:bg-gray-50 transition shadow-sm flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <a href="{{ route('admin.badges.create') }}" class="px-4 py-2 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition shadow-lg flex items-center gap-2">
                <i class="fas fa-plus"></i> New Badge
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-xl font-medium flex items-center gap-3">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse($badges as $badge)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 relative group overflow-hidden">
            <div class="flex items-start gap-4 relative z-10">
                <div class="w-16 h-16 rounded-2xl bg-amber-50 border border-amber-100 flex items-center justify-center overflow-hidden flex-shrink-0">
                    @if($badge->image_path)
                        <img src="{{ asset('storage/' . $badge->image_path) }}" alt="{{ $badge->name }}" class="w-full h-full object-cover">
                    @else
                        <i class="fas fa-award text-3xl text-amber-500"></i>
                    @endif
                </div>
                <div class="flex-1">
                    <h3 class="font-bold text-gray-800 text-lg mb-1">{{ $badge->name }}</h3>
                    <p class="text-gray-500 text-xs line-clamp-2 mb-3">{{ $badge->description }}</p>
                    <div class="flex items-center gap-2">
                        <span class="px-2 py-1 bg-gray-100 text-gray-600 text-[10px] font-bold rounded uppercase tracking-wider">
                            Req: {{ $badge->requirement_count }} Target
                        </span>
                    </div>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-gray-50 flex items-center justify-end gap-2">
                <a href="{{ route('admin.badges.edit', $badge->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('admin.badges.destroy', $badge->id) }}" method="POST" onsubmit="return confirm('Delete this badge?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </div>
            
            <!-- Background Decoration -->
            <div class="absolute -right-4 -bottom-4 text-gray-50 text-7xl opacity-0 group-hover:opacity-100 transition-opacity">
                <i class="fas fa-award"></i>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white p-12 rounded-2xl border-2 border-dashed border-gray-100 text-center">
            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                <i class="fas fa-award text-3xl"></i>
            </div>
            <h3 class="font-bold text-gray-800">No Badges Created</h3>
            <p class="text-gray-500 mb-6">Start by creating your first achievement reward.</p>
            <a href="{{ route('admin.badges.create') }}" class="text-blue-600 font-bold hover:underline">Add New Badge</a>
        </div>
        @endforelse
    </div>

    @if($badges->hasPages())
    <div class="mt-8">
        {{ $badges->links() }}
    </div>
    @endif
</x-app-layout>
