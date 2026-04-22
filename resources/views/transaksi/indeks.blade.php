<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaksi Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-card p-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">Kasir / Point of Sale</h3>
                        <p class="text-gray-500 text-sm">Pilih produk untuk ditambahkan ke transaksi.</p>
                    </div>
                    <a href="{{ route('transaksi.keranjang') }}" class="btn-premium-primary relative">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <span>Keranjang</span>
                        @if(count(session('cart', [])) > 0)
                            <span class="absolute -top-2 -right-2 bg-red-600 text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full border-2 border-white">
                                {{ count(session('cart', [])) }}
                            </span>
                        @endif
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @forelse ($items as $item)
                        <div class="border border-gray-200 rounded-lg overflow-hidden bg-white hover:shadow-md transition-shadow">
                            <div class="p-4 border-b border-gray-100 flex justify-between items-center">
                                <span class="text-[10px] font-bold text-blue-600 uppercase">{{ $item->category->name }}</span>
                                <span class="text-[10px] text-gray-400">#{{ $item->id }}</span>
                            </div>

                            <div class="p-4">
                                <h4 class="font-bold text-gray-800 mb-1 truncate">{{ $item->name }}</h4>
                                <div class="text-lg font-bold text-gray-900 mb-4">Rp {{ number_format($item->price, 0, ',', '.') }}</div>

                                <div class="flex items-center justify-between text-xs mb-4">
                                    <span class="text-gray-500">Stok:</span>
                                    <span class="font-bold {{ $item->stock > 0 ? 'text-gray-700' : 'text-red-500' }}">
                                        {{ $item->stock > 0 ? $item->stock : 'Habis' }}
                                    </span>
                                </div>

                                <form action="{{ route('transaksi.tambah-keranjang') }}" method="POST" class="space-y-3">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <div class="flex items-center gap-2">
                                        <input type="number" name="qty" value="1" min="1" max="{{ $item->stock }}"
                                            class="w-full input-premium text-center"
                                            @if($item->stock <= 0) disabled @endif>
                                    </div>
                                    <button type="submit" @if($item->stock <= 0) disabled @endif
                                        class="w-full btn-premium-primary py-2 text-xs">
                                        {{ $item->stock > 0 ? 'Tambah ke Keranjang' : 'Stok Habis' }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-12 text-center">
                            <p class="text-gray-400">Belum ada item tersedia.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
