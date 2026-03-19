
<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold">Edit Category</h1>
    </x-slot>
    <div class="max-w-2xl mx-auto py-8">
        <div class="p-8 bg-gradient-to-br from-gray-700 via-gray-600 to-gray-900 text-white rounded-2xl shadow-lg">
            <form method="POST" action="{{ route('categories.update', $category->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium mb-1">Name</label>
                    <input type="text" class="w-full px-3 py-2 rounded border border-gray-400 text-black @error('name') border-red-500 @enderror" id="name" name="name" value="{{ old('name', $category->name) }}" required>
                    @error('name')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="type" class="block text-sm font-medium mb-1">Type</label>
                    <select class="w-full px-3 py-2 rounded border border-gray-400 text-black @error('type') border-red-500 @enderror" id="type" name="type" required>
                        <option value="">Select Type</option>
                        <option value="income" {{ old('type', $category->type) == 'income' ? 'selected' : '' }}>Income</option>
                        <option value="expense" {{ old('type', $category->type) == 'expense' ? 'selected' : '' }}>Expense</option>
                    </select>
                    @error('type')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">Update</button>
                    <a href="{{ route('categories.index') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

