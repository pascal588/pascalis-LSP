<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaksi Baru') }}
        </h2>
    </x-slot>

    <div class="py-12 text-blue-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl p-8 border border-gray-100">
                @if (session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-8 rounded-xl shadow-sm text-sm font-bold flex items-center gap-3"
                        role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-8 rounded-xl shadow-sm text-sm font-bold flex items-center gap-3"
                        role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                <div style="display: flex; flex-wrap: wrap; justify-content: center; padding: 20px;">
                    @forelse ($items as $item)
                        <div
                            style="display: flex; flex-direction: column; background-color: #ffffff; border: 1px solid #f1f5f9; border-radius: 30px; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05); margin: 15px; width: 220px; overflow: hidden; transition: all 0.3s ease;">
                            <!-- Category Badge -->
                            <div style="padding: 15px 20px 5px 20px;">
                                <span
                                    style="background-color: #eef2ff; color: #4f46e5; font-size: 8px; font-weight: 900; padding: 4px 10px; border-radius: 50px; text-transform: uppercase; letter-spacing: 1px;">
                                    {{ $item->category->name }}
                                </span>
                            </div>

                            <div style="padding: 5px 20px 20px 20px; flex-grow: 1; display: flex; flex-direction: column;">
                                <!-- Name & Price -->
                                <h3
                                    style="font-weight: 800; color: #1e293b; font-size: 14px; margin-bottom: 5px; height: 36px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; line-height: 1.2;">
                                    {{ $item->name }}
                                </h3>
                                <div style="display: flex; align-items: baseline; gap: 4px; margin-bottom: 15px;">
                                    <span style="font-size: 10px; font-weight: 700; color: #cbd5e1;">Rp</span>
                                    <span
                                        style="font-size: 18px; font-weight: 900; color: #4f46e5;">{{ number_format($item->price, 0, ',', '.') }}</span>
                                </div>

                                <div
                                    style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px; background-color: #f8fafc; padding: 10px; border-radius: 15px;">
                                    <span
                                        style="font-size: 9px; text-transform: uppercase; font-weight: 800; color: #94a3b8; letter-spacing: 1px;">Stok</span>
                                    <span
                                        style="font-size: 12px; font-weight: 900; color: {{ $item->stock > 0 ? '#334155' : '#e11d48' }};">
                                        {{ $item->stock > 0 ? $item->stock . ' ' : 'Habis' }}
                                    </span>
                                </div>

                                <!-- Action Section -->
                                <div style="margin-top: auto;">
                                    <form action="{{ route('transactions.add-to-cart') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="item_id" value="{{ $item->id }}">

                                        <div style="display: flex; flex-direction: column; gap: 10px;">
                                            <div
                                                style="display: flex; align-items: center; justify-content: space-between; background-color: #ffffff; padding: 5px 0;">
                                                <span
                                                    style="font-size: 10px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">Jumlah</span>
                                                <input type="number" name="qty" value="1" min="1" max="{{ $item->stock }}"
                                                    style="width: 70px; border: 2px solid #eef2ff; background-color: #f8fafc; text-align: center; font-weight: 900; color: #4f46e5; border-radius: 10px; padding: 8px; outline: none; font-size: 15px;">
                                            </div>

                                            <button type="submit" @if($item->stock <= 0) disabled @endif
                                                style="background-color: #2563eb; color: #ffffff; border: none; padding: 12px; border-radius: 50px; font-weight: 800; cursor: pointer; font-size: 11px; width: 100%; text-transform: uppercase; letter-spacing: 1px; transition: opacity 0.2s;"
                                                onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                                                {{ $item->stock > 0 ? '+ Tambah' : 'Stok Habis' }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-32 text-center">
                            <div class="text-slate-300 mb-4 flex justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                            </div>
                            <p class="text-slate-400 text-lg font-bold tracking-tight italic">Belum ada item yang tersedia.
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>