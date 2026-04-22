<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Struk Pembayaran Virtual') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <!-- TAG: Container Struk Diperkecil -->
                <div class="bg-white shadow-xl rounded-lg p-6 w-[100%] max-w-[380px] border border-gray-100">
                    <div class="text-center mb-6 no-print">
                        <div
                            class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-green-100 text-green-600 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <h2 class="text-lg font-extrabold text-gray-900">Transaksi Berhasil!</h2>
                        <p class="text-gray-500 text-xs mt-1">Terima kasih atas pembelian Anda.</p>
                    </div>

                    <!-- Virtual Receipt -->
                    <div id="receipt-area"
                        class="bg-gray-50 border-2 border-dashed border-gray-200 p-4 font-mono text-[10px] text-gray-700 rounded-sm mx-auto">
                        <div class="text-center mb-4 border-b border-gray-200 pb-3">
                            <h3 class="text-lg font-bold uppercase tracking-widest text-gray-900">Pascal Mart</h3>
                            <p>jl. Elkoding 12 no.23</p>
                            <p>Telp: 12345678910</p>
                        </div>

                        <div class="space-y-1 mb-4">
                            <div class="flex justify-between">
                                <span>No. Invoice</span>
                                <span
                                    class="font-bold">#TRX-{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Date</span>
                                <span>{{ $transaction->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Cashier</span>
                                <span class="font-bold uppercase">{{ $transaction->user->name }}</span>
                            </div>
                        </div>

                        <table class="w-full mb-4 border-t border-b border-gray-200 border-dotted py-2">
                            <thead>
                                <tr class="text-left text-[10px] text-gray-500 uppercase">
                                    <th class="py-1">Item</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-right">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaction->details as $detail)
                                    <tr>
                                        <td class="py-1">{{ $detail->item->name }}</td>
                                        <td class="text-center">{{ $detail->qty }}</td>
                                        <td class="text-right">{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="space-y-1 text-sm border-b border-gray-200 border-dotted pb-2 mb-2">
                            <div class="flex justify-between font-bold text-gray-900 uppercase">
                                <span>Total</span>
                                <span>Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span>Paid</span>
                                <span>Rp {{ number_format($transaction->amount_paid, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="flex justify-between font-bold text-green-700 bg-green-50 p-1 px-2 rounded">
                            <span>Change</span>
                            <span>Rp {{ number_format($transaction->change, 0, ',', '.') }}</span>
                        </div>

                        <div class="mt-8 text-center text-[10px] italic text-gray-400">
                            *** Thank you for shopping with us! ***
                        </div>
                    </div>

                    <div class="mt-8 flex gap-4 no-print">
                        <button onclick="window.print()"
                            style="background-color: #374151; color: white; border: none; padding: 12px; border-radius: 8px; font-weight: 700; cursor: pointer; flex: 1; display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 12px;"
                            class="hover:opacity-90">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 16px; height: 16px;" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            Cetak Struk
                        </button>
                        <a href="{{ route('transaksi.indeks') }}"
                            style="background-color: #4f46e5; color: white; border: none; padding: 12px; border-radius: 8px; font-weight: 700; text-decoration: none; flex: 1; display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 12px;"
                            class="hover:opacity-90">
                            Transaksi Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Print styling -->
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #receipt-area,
            #receipt-area * {
                visibility: visible;
            }

            #receipt-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                max-width: 100%;
                border: none !important;
                background-color: white !important;
                padding: 10px !important;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>
</x-app-layout>