<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-white">Admin Dashboard</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!--AdminStats-->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-gray-500 rounded-lg shadow-lg p-6 text-white">
                    <p class="text-gray-100">Total Users</p>
                    <p class="text-4xl font-bold">{{\App\Models\User::count()}}</p>
                </div>
                <div class="bg-gray-500 rounded-lg shadow-lg p-6 text-white">
                    <p class="text-gray-100">Total Badges</p>
                    <p class="text-4xl font-bold">{{\App\Models\Badge::count()}}</p>
                </div>
                <div class="bg-gray-500 rounded-lg shadow-lg p-6 text-white">
                    <p class="text-gray-100">Total Transactions</p>
                    <p class="text-4xl font-bold">{{\App\Models\Transaction::count()}}</p>
                </div>
                <div class="bg-gray-500 rounded-lg shadow-lg p-6 text-white">
                    <p class="text-gray-100">Total Saved</p>
                    <p class="text-2xl font-bold">Rp{{number_format(\App\Models\User::sum('total_saved'),0,',','.')}}</p>
                </div>
            </div>
            <!--AdminLinks-->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{route('badges.index')}}" class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 hover:shadow-xl transition">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Manage Badges</h3>
                    <p class="text-gray-600 dark:text-gray-400">Create and manage achievement badges</p>
                </a>
                <a href="{{route('categories.index')}}" class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 hover:shadow-xl transition">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Manage Categories</h3>
                    <p class="text-gray-600 dark:text-gray-400">Organize transaction categories</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>





