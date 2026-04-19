<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                @if (session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm" role="alert">
                        <p class="font-bold">Error</p>
                        <p class="text-sm font-medium">{{ session('error') }}</p>
                    </div>
                @endif

                @if(session('cart') && count(session('cart')) > 0)
                    <!-- TAG: Layout Utama Keranjang -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- TAG: Tabel Produk -->
                        <div class="md:col-span-1">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($cart as $id => $details)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-bold text-gray-900">{{ $details['name'] }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-gray-900">{{ $details['qty'] }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-bold text-indigo-600">Rp {{ number_format($details['subtotal'], 0, ',', '.') }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                                    <!-- TAG: Tombol Hapus Cart -->
                                                    <form action="{{ route('transactions.remove-from-cart', $id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="px-3 py-1 bg-red-100 text-red-600 font-bold border border-red-200 rounded text-xs hover:bg-red-200">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- TAG: Bagian Checkout (Order Summary) -->
                        <div class="md:col-span-1">
                            <div class="bg-gray-50 rounded-xl p-6 shadow-sm border border-gray-100">
                                <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Order Summary</h3>
                                <div class="flex justify-between items-center mb-6">
                                    <span class="text-gray-600 font-medium">Total Harga</span>
                                    <span class="text-2xl font-extrabold text-indigo-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                                
                                <form action="{{ route('transactions.checkout') }}" method="POST">
                                    @csrf
                                    <div class="mb-6">
                                        <label for="amount_paid" class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Input Pembayaran</label>
                                        <!-- TAG: Input Rupiah -->
                                        <div class="flex items-center w-full border border-gray-300 rounded-lg overflow-hidden bg-white shadow-sm">
                                            <div class="px-4 py-3 bg-gray-100 text-gray-500 font-bold border-r border-gray-300">
                                                Rp
                                            </div>
                                            <input type="number" name="amount_paid" id="amount_paid" min="{{ $total }}" 
                                                class="flex-1 w-full border-none focus:ring-0 text-lg font-bold py-3 px-4" 
                                                required placeholder="0">
                                        </div>
                                        <p class="mt-2 text-[10px] text-gray-400 font-medium italic">*Pembayaran minimal: Rp {{ number_format($total, 0, ',', '.') }}</p>
                                    </div>
                                    <button type="submit" style="background-color: #16a34a; color: white; border: none; padding: 15px; border-radius: 12px; font-weight: 800; cursor: pointer; width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; text-transform: uppercase; font-size: 12px; letter-spacing: 0.1em;">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        Selesaikan Transaksi
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- TAG: Keranjang Kosong -->
                    <div class="flex flex-col items-center justify-center py-20">
                        <div class="flex items-center justify-center w-20 h-20 rounded-full bg-indigo-50 text-indigo-300 mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                        <p class="text-gray-600 text-lg font-medium mb-6">Keranjang Anda masih kosong.</p>
                        <!-- TAG: Tombol Belanja -->
                        <a href="{{ route('transactions.index') }}" class="px-6 py-2 bg-blue-600 text-white rounded font-semibold hover:bg-blue-700 transition">
                            Mulai Belanja Sekarang
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
