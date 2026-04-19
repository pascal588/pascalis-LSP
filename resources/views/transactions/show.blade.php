<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Struk Pembayaran Virtual') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <div class="bg-white shadow-xl rounded-lg p-10 w-full max-w-md border border-gray-100 no-print">
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 text-green-600 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-extrabold text-gray-900">Transaction Successful!</h2>
                        <p class="text-gray-500 text-sm mt-1">Thank you for your purchase.</p>
                    </div>

                    <!-- Virtual Receipt -->
                    <div class="bg-gray-50 border-2 border-dashed border-gray-200 p-6 font-mono text-xs text-gray-700 rounded-sm">
                        <div class="text-center mb-6 border-b border-gray-200 pb-4">
                            <h3 class="text-lg font-bold uppercase tracking-widest text-gray-900">Antigravity Mart</h3>
                            <p>Jl. Coding No. 101, Cloud City</p>
                            <p>Telp: 0812-3456-7890</p>
                        </div>

                        <div class="space-y-1 mb-4">
                            <div class="flex justify-between">
                                <span>No. Invoice</span>
                                <span class="font-bold">#TRX-{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</span>
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

                    <div class="mt-8 flex gap-4">
                        <button onclick="window.print()" style="background-color: #374151; color: white; border: none; padding: 12px; border-radius: 8px; font-weight: 700; cursor: pointer; flex: 1; display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 12px;" class="no-print hover:opacity-90">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            Cetak Struk
                        </button>
                        <a href="{{ route('transactions.index') }}" style="background-color: #4f46e5; color: white; border: none; padding: 12px; border-radius: 8px; font-weight: 700; text-decoration: none; flex: 1; display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 12px;" class="no-print hover:opacity-90">
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
            body * { visibility: hidden; }
            .bg-gray-50, .bg-gray-50 * { visibility: visible; }
            .bg-gray-50 {
                position: absolute;
                left: 50%;
                top: 0;
                transform: translateX(-50%);
                width: 100% !important;
                max-width: 80mm !important; /* Standard credit card thermal paper width */
                border: none !important;
                background-color: white !important;
                padding: 0 !important;
            }
            .no-print { display: none !important; }
        }
    </style>
</x-app-layout>
