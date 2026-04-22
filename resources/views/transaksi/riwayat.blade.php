<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-card overflow-hidden animate-fade-up">
                <div class="p-10">
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold text-gray-800">Riwayat Transaksi</h3>
                        <p class="text-gray-500 text-sm">Lacak semua aktivitas penjualan yang telah berhasil diproses.</p>
                    </div>

                    <div class="overflow-hidden rounded-lg border border-gray-200">
                        <table class="table-premium">
                            <thead>
                                <tr>
                                    <th>Tanggal & Waktu</th>
                                    <th>Total Transaksi</th>
                                    <th>Dibayar</th>
                                    <th>Kembalian</th>
                                    <th class="text-center">Struk</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $transaction)
                                    <tr>
                                        <td>
                                            <div class="font-semibold text-gray-800">{{ $transaction->created_at->format('d M Y') }}</div>
                                            <div class="text-xs text-gray-400">{{ $transaction->created_at->format('H:i') }} WIB</div>
                                        </td>
                                        <td class="font-semibold text-gray-700">
                                            Rp {{ number_format($transaction->total, 0, ',', '.') }}
                                        </td>
                                        <td class="text-gray-600">
                                            Rp {{ number_format($transaction->amount_paid, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <span class="text-green-600 font-semibold">Rp {{ number_format($transaction->change, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('transaksi.struk', $transaction->id) }}" 
                                                class="btn-premium-primary text-xs py-2 px-4">
                                                Lihat Struk
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-12 text-center">
                                            <p class="text-gray-400">Belum ada riwayat transaksi.</p>
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
