<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Barang') }}
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
                            Daftar Item</h3>
                        <a href="{{ route('items.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-white border border-indigo-600 text-indigo-600 font-bold rounded-md text-xs uppercase tracking-widest hover:bg-indigo-600 hover:text-white transition-all duration-300 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Item Baru
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300 bg-white">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-semibold text-gray-700">Item Name</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-semibold text-gray-700">Category</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-semibold text-gray-700">Price</th>
                                    <th class="border border-gray-300 px-4 py-2 text-center text-sm font-semibold text-gray-700">Stock</th>
                                    <th class="border border-gray-300 px-4 py-2 text-center text-sm font-semibold text-gray-700">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-900">{{ $item->name }}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">{{ $item->category->name }}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-900 font-medium">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-sm text-center text-gray-900">{{ $item->stock }}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-sm text-center">
                                            <div class="flex justify-center gap-2">
                                                <a href="{{ route('items.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold px-2 py-1 border border-indigo-200 rounded">Edit</a>
                                                <form action="{{ route('items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 font-semibold px-2 py-1 border border-red-200 rounded">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="border border-gray-300 px-4 py-8 text-center text-sm text-gray-500">Belum ada item barang.</td>
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