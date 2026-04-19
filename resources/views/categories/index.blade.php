<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm"
                            role="alert">
                            <p class="font-bold">Success</p>
                            <p class="text-sm font-medium">{{ session('success') }}</p>
                        </div>
                    @endif

                    <div class="flex justify-between items-center mb-6">
                        <h3
                            class="text-lg font-bold text-gray-700 italic underline decoration-indigo-500 decoration-2 underline-offset-4">
                            Daftar Kategori</h3>
                        <a href="{{ route('categories.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-white border border-indigo-600 text-indigo-600 font-bold rounded-md text-xs uppercase tracking-widest hover:bg-indigo-600 hover:text-white transition-all duration-300 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Kategori
                        </a>
                    </div>

                    <!-- TAG: Tabel Kategori -->
                    <div class="overflow-x-auto mt-4">
                        <table class="w-full border-collapse border border-gray-300 bg-white">
                            <thead class="bg-gray-100">
                                <tr>
                                    <!-- TAG: Header Tabel -->
                                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-semibold text-gray-700">ID</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-semibold text-gray-700">Category Name</th>
                                    <th class="border border-gray-300 px-4 py-2 text-center text-sm font-semibold text-gray-700">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <!-- TAG: Baris Data Kategori -->
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-900">{{ $category->id }}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-900">{{ $category->name }}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-sm text-center">
                                            <!-- TAG: Tombol Aksi -->
                                            <div class="flex justify-center gap-2">
                                                <a href="{{ route('categories.edit', $category->id) }}" class="px-2 py-1 bg-blue-500 text-white text-xs font-semibold rounded hover:bg-blue-600 transition">
                                                    Edit
                                                </a>
                                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-2 py-1 bg-red-500 text-white text-xs font-semibold rounded hover:bg-red-600 transition">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <!-- TAG: Jika Kosong -->
                                    <tr>
                                        <td colspan="3" class="border border-gray-300 px-4 py-8 text-center text-sm text-gray-500">Belum ada data kategori.</td>
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