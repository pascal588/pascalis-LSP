<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- TAG: Container Cards Dashboard -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Card Total Kategori -->
                <div class="glass-card p-6 border-t-4 border-blue-600">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Kategori</span>
                    </div>
                    <div class="text-3xl font-bold text-gray-800">{{ $totalCategories }}</div>
                    <div class="mt-4">
                        <a href="{{ route('kategori.indeks') }}" class="text-blue-600 hover:underline text-sm font-semibold">
                            Lihat Semua →
                        </a>
                    </div>
                </div>

                <!-- Card Total Barang -->
                <div class="glass-card p-6 border-t-4 border-green-600">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Produk</span>
                    </div>
                    <div class="text-3xl font-bold text-gray-800">{{ $totalItems }}</div>
                    <div class="mt-4">
                        <a href="{{ route('barang.indeks') }}" class="text-green-600 hover:underline text-sm font-semibold">
                            Lihat Semua →
                        </a>
                    </div>
                </div>

                <!-- Card Total Transaksi -->
                <div class="glass-card p-6 border-t-4 border-orange-600">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Transaksi</span>
                    </div>
                    <div class="text-3xl font-bold text-gray-800">{{ $totalTransactions }}</div>
                    <div class="mt-4">
                        <a href="{{ route('transaksi.riwayat') }}" class="text-orange-600 hover:underline text-sm font-semibold">
                            Lihat Riwayat →
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Quick Actions</h3>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('transaksi.indeks') }}" class="btn-premium-primary py-3">
                        Mulai Transaksi Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
