
<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold">Category Details</h1>
    </x-slot>
    <div class="max-w-2xl mx-auto py-8">
        <div class="p-8 bg-gradient-to-br from-gray-700 via-gray-600 to-gray-900 text-white rounded-2xl shadow-lg">
            <div class="mb-6">
                <span class="text-lg font-semibold">Name:</span>
                <span>{{ $category->name }}</span>
            </div>
            <div>
                <span class="text-lg font-semibold">Description:</span>
                <span>{{ $category->description ?? 'No description' }}</span>
            </div>
            <div class="mt-8 flex gap-2">
                <a href="{{ route('categories.edit', $category->id) }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">Edit Category</a>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded">Delete</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

