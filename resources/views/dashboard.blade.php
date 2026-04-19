<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- TAG: Container Cards Dashboard -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- TAG: Card Total Kategori -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500 mb-4 md:mb-0">
                    <div class="text-gray-500 text-sm font-medium uppercase">Total Kategori</div>
                    <div class="text-3xl font-bold text-gray-800">{{ $totalCategories }}</div>
                    <div class="mt-4">
                        <a href="{{ route('categories.index') }}"
                            class="text-blue-600 hover:text-blue-800 text-sm font-semibold">View All &rarr;</a>
                    </div>
                </div>

                <!-- TAG: Card Total Barang -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500 mb-4 md:mb-0">
                    <div class="text-gray-500 text-sm font-medium uppercase">Total Barang</div>
                    <div class="text-3xl font-bold text-gray-800">{{ $totalItems }}</div>
                    <div class="mt-4">
                        <a href="{{ route('items.index') }}"
                            class="text-green-600 hover:text-green-800 text-sm font-semibold">View All &rarr;</a>
                    </div>
                </div>

                <!-- TAG: Card Total Transaksi -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-purple-500 mb-4 md:mb-0">
                    <div class="text-gray-500 text-sm font-medium uppercase">Total Transaksi</div>
                    <div class="text-3xl font-bold text-gray-800">{{ $totalTransactions }}</div>
                    <div class="mt-4">
                        <a href="{{ route('transactions.history') }}"
                            class="text-purple-600 hover:text-purple-800 text-sm font-semibold">View History &rarr;</a>
                    </div>
                </div>
            </div>

            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Quick Actions</h3>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('transactions.index') }}"
                        style="background-color: #4f46e5; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 700; text-decoration: none; display: inline-block; font-size: 14px; text-transform: uppercase; letter-spacing: 0.1em;">
                        Mulai Transaksi Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>