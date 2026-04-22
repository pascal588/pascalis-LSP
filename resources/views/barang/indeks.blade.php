<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-card overflow-hidden animate-fade-up">
                <div class="p-10">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800">Daftar Produk</h3>
                            <p class="text-gray-500 text-sm">Manajemen inventori dan stok barang toko.</p>
                        </div>
                        <a href="{{ route('barang.tambah') }}" class="btn-premium-primary">
                            <span>+ Tambah Produk</span>
                        </a>
                    </div>

                    <div class="overflow-hidden rounded-lg border border-gray-200">
                        <table class="table-premium">
                            <thead>
                                <tr>
                                    <th>Informasi Produk</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th class="text-center">Stok</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                    <tr>
                                        <td>
                                            <div class="font-semibold text-gray-800">{{ $item->name }}</div>
                                            <div class="text-xs text-gray-400">SKU #{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</div>
                                        </td>
                                        <td>
                                            <span class="text-xs font-medium px-2 py-0.5 rounded bg-gray-100 text-gray-600 border border-gray-200">
                                                {{ $item->category->name }}
                                            </span>
                                        </td>
                                        <td class="font-medium text-gray-700">
                                            Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </td>
                                        <td class="text-center">
                                            <span class="text-xs font-bold {{ $item->stock > 10 ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $item->stock }} Unit
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="flex justify-center items-center gap-2">
                                                <a href="{{ route('barang.ubah', $item->id) }}" 
                                                    class="p-2 text-blue-600 hover:bg-blue-50 rounded-md transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                </a>
                                                <form action="{{ route('barang.hapus', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus produk ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-md transition-colors">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-12 text-center">
                                            <p class="text-gray-400">Belum ada data produk.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
