<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-card overflow-hidden animate-fade-up">
                <div class="p-10">
                    <div class="flex items-center justify-between mb-10">
                        <div>
                            <h3 class="text-3xl font-black text-slate-800 tracking-tight italic">Keranjang Belanja</h3>
                            <p class="text-slate-500 text-sm font-medium">Tinjau item dan selesaikan pembayaran.</p>
                        </div>
                        <div class="bg-indigo-50 px-4 py-2 rounded-2xl border border-indigo-100">
                            <span class="text-indigo-600 font-black text-sm uppercase tracking-widest">{{ count(session('cart', [])) }} Item</span>
                        </div>
                    </div>

                    @if(session('cart') && count(session('cart')) > 0)
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                            <!-- Tabel Produk -->
                            <div class="lg:col-span-2">
                                <div class="overflow-hidden rounded-2xl border border-slate-100">
                                    <table class="table-premium">
                                        <thead>
                                            <tr>
                                                <th>Produk</th>
                                                <th>Harga</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-right">Subtotal</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-50">
                                            @foreach($cart as $id => $details)
                                                <tr class="hover:bg-slate-50/50 transition-colors">
                                                    <td>
                                                        <div class="font-black text-slate-800">{{ $details['name'] }}</div>
                                                        <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">ID #{{ $id }}</div>
                                                    </td>
                                                    <td class="font-bold text-slate-500">Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                                                    <td class="text-center">
                                                        <span class="inline-flex items-center px-3 py-1 bg-slate-100 rounded-lg font-black text-slate-700 text-xs">
                                                            {{ $details['qty'] }}
                                                        </span>
                                                    </td>
                                                    <td class="text-right font-black text-indigo-600">Rp {{ number_format($details['subtotal'], 0, ',', '.') }}</td>
                                                    <td class="text-right">
                                                        <form action="{{ route('transaksi.hapus-keranjang', $id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="p-2 text-rose-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all">
                                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Order Summary -->
                            <div class="lg:col-span-1">
                                <div class="bg-slate-50/80 rounded-3xl p-8 border border-slate-100 shadow-inner">
                                    <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-6 pb-4 border-b border-slate-200">Ringkasan Pesanan</h4>
                                    
                                    <div class="space-y-4 mb-8">
                                        <div class="flex justify-between items-center text-sm">
                                            <span class="text-slate-500 font-bold">Subtotal</span>
                                            <span class="text-slate-800 font-black">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="flex justify-between items-center text-sm">
                                            <span class="text-slate-500 font-bold">Pajak (0%)</span>
                                            <span class="text-slate-800 font-black">Rp 0</span>
                                        </div>
                                        <div class="pt-4 border-t border-slate-200 flex justify-between items-center">
                                            <span class="text-slate-800 font-black uppercase text-xs tracking-widest">Total Bayar</span>
                                            <span class="text-3xl font-black text-indigo-600 tracking-tighter">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                    
                                    <form action="{{ route('transaksi.bayar') }}" method="POST" class="space-y-6">
                                        @csrf
                                        <div>
                                            <label for="amount_paid_display" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Input Pembayaran</label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                                                    <span class="text-slate-400 font-bold text-sm">Rp</span>
                                                </div>
                                                <input type="text" id="amount_paid_display" 
                                                    class="input-premium text-xl font-bold" 
                                                    style="padding-left: 4.5rem;"
                                                    required placeholder="0"
                                                    oninput="formatRupiah(this)">
                                                <input type="hidden" name="amount_paid" id="amount_paid_raw">
                                            </div>
                                            <p class="mt-3 text-[10px] text-gray-400 font-bold italic">* Minimal pembayaran Rp {{ number_format($total, 0, ',', '.') }}</p>
                                        </div>

                                        <script>
                                            function formatRupiah(el) {
                                                let val = el.value.replace(/[^0-9]/g, '');
                                                if (val === '') {
                                                    el.value = '';
                                                    document.getElementById('amount_paid_raw').value = '';
                                                    return;
                                                }
                                                
                                                let formatted = new Intl.NumberFormat('id-ID').format(val);
                                                el.value = formatted;
                                                document.getElementById('amount_paid_raw').value = val;
                                            }
                                        </script>
                                        
                                        <button type="submit" class="btn-premium-secondary w-full py-4 shadow-emerald-200 uppercase tracking-widest text-xs">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                            Selesaikan Transaksi
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Keranjang Kosong -->
                        <div class="flex flex-col items-center justify-center py-20 animate-fade-up">
                            <div class="w-32 h-32 bg-slate-50 rounded-full flex items-center justify-center mb-8 text-slate-200">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </div>
                            <h4 class="text-xl font-black text-slate-800 mb-2">Wah, Keranjang Kosong!</h4>
                            <p class="text-slate-400 font-medium mb-10">Belum ada item yang Anda pilih untuk dibayar.</p>
                            <a href="{{ route('transaksi.indeks') }}" class="btn-premium-primary px-10">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                Mulai Belanja
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
