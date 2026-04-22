<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Barang Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-card overflow-hidden animate-fade-up">
                <div class="p-10">
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold text-gray-800">Tambah Produk</h3>
                        <p class="text-gray-500 text-sm">Lengkapi detail produk untuk inventori toko.</p>
                    </div>

                    <form action="{{ route('barang.simpan') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori Produk</label>
                                <select name="category_id" id="category_id" class="input-premium" required>
                                    <option value="" disabled selected>-- Pilih Kategori --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="mt-1 text-xs text-red-600 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                                    class="input-premium" placeholder="Masukkan nama produk" required>
                                @error('name')
                                    <p class="mt-1 text-xs text-red-600 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga Satuan (Rp)</label>
                                    <input type="number" name="price" id="price" value="{{ old('price') }}" 
                                        class="input-premium" placeholder="0" required>
                                    @error('price')
                                        <p class="mt-1 text-xs text-red-600 font-semibold">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stok Awal</label>
                                    <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}" 
                                        class="input-premium" required>
                                    @error('stock')
                                        <p class="mt-1 text-xs text-red-600 font-semibold">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100">
                            <a href="{{ route('barang.indeks') }}" class="text-sm text-gray-500 hover:text-gray-700">Batal</a>
                            <button type="submit" class="btn-premium-primary">
                                Simpan Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
