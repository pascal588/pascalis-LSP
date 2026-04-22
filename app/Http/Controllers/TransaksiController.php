<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    //menampilkan halaman awal transaksi dengan daftar barang//
    public function indeks()
    {
        $items = Item::where('stock', '>', 0)->get();
        return view('transaksi.indeks', compact('items'));
    }

    //menambahkan barang ke dalam keranjang belanja//
    public function tambahKeranjang(Request $request)
    {
        $item = Item::findOrFail($request->item_id);
        $qty = $request->qty ?? 1;

        if ($item->stock < $qty) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$item->id])) {
            $cart[$item->id]['qty'] += $qty;
            $cart[$item->id]['subtotal'] = $cart[$item->id]['qty'] * $item->price;
        } else {
            $cart[$item->id] = [
                "name" => $item->name,
                "qty" => $qty,
                "price" => $item->price,
                "subtotal" => $item->price * $qty
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('transaksi.keranjang')->with('Berhasil', 'Barang Berhasil Ditambahkan Ke Keranjang.');
    }

    //menampilkan halaman keranjang belanja beserta rincian subtotal//
    public function keranjang()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_column($cart, 'subtotal'));
        return view('transaksi.keranjang', compact('cart', 'total'));
    }

    //menghapus salah satu barang dari dalam keranjang//
    public function hapusKeranjang($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return back()->with('Berhasil', 'Barang Berhasil dihapus dari Keranjang.');
    }

    //memproses pembayaran dan melakukan pemotongan stok barang//
    public function bayar(Request $request)
    {
        $cart = session()->get('cart');
        if (!$cart) {
            return back()->with('Error', 'Keranjang Kosong.');
        }

        $total = array_sum(array_column($cart, 'subtotal'));
        $amountPaid = $request->amount_paid;

        if ($amountPaid < $total) {
            return back()->with('Error', 'Uang Kurang dari Total Harga.');
        }

        $change = $amountPaid - $total;

        DB::transaction(function () use ($cart, $total, $amountPaid, $change) {
            $transaction = Transaction::create([
                'user_id' => auth()->id(),
                'date' => now(),
                'total' => $total,
                'amount_paid' => $amountPaid,
                'change' => $change,
            ]);

            foreach ($cart as $id => $details) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'item_id' => $id,
                    'qty' => $details['qty'],
                    'subtotal' => $details['subtotal'],
                ]);

                // Deduct stock
                $item = Item::find($id);
                $item->decrement('stock', $details['qty']);
            }
        });

        session()->forget('cart');

        // Redirect to receipt (show)
        $transaction = Transaction::latest()->first();
        return redirect()->route('transaksi.struk', $transaction->id)->with('Berhasil', 'Transaksi Berhasil.');
    }

    //menampilkan riwayat list transaksi bagi user bersangkutan//
    public function riwayat()
    {
        $transactions = Transaction::where('user_id', auth()->id())->latest()->get();
        return view('transaksi.riwayat', compact('transactions'));
    }

    //menampilkan halaman struk cetak virtual//
    public function struk(Transaction $transaction)
    {
        $transaction->load('details.item');
        return view('transaksi.struk', compact('transaction'));
    }
}
