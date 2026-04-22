<!-- //Tampilan Tambah Kategori// -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kategori Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-card overflow-hidden animate-fade-up">
                <div class="p-10">
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold text-gray-800">Tambah Kategori</h3>
                        <p class="text-gray-500 text-sm">Tambahkan klasifikasi produk baru ke sistem.</p>
                    </div>

                    <form action="{{ route('kategori.simpan') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" 
                                class="input-premium" 
                                placeholder="Masukkan nama kategori" required autofocus>
                            @error('name')
                                <p class="mt-1 text-xs text-red-600 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100">
                            <a href="{{ route('kategori.indeks') }}" class="text-sm text-gray-500 hover:text-gray-700">Batal</a>
                            <button type="submit" class="btn-premium-primary">
                                Simpan Kategori
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
