<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $items = Item::where('stock', '>', 0)->get();
        return view('transactions.index', compact('items'));
    }

    public function addToCart(Request $request)
    {
        $item = Item::findOrFail($request->item_id);
        $qty = $request->qty ?? 1;

        if ($item->stock < $qty) {
            return back()->with('error', 'Insufficient stock.');
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
        return redirect()->route('transactions.cart')->with('Berhasil', 'Barang Berhasil Ditambahkan Ke Keranjang.');
    }

    public function cart()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_column($cart, 'subtotal'));
        return view('transactions.cart', compact('cart', 'total'));
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return back()->with('Berhasil', 'Barang Berhasil dihapus dari Keranjang.');
    }

    public function checkout(Request $request)
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
        return redirect()->route('transactions.show', $transaction->id)->with('Berhasil', 'Transaksi Berhasil.');
    }

    public function history()
    {
        $transactions = Transaction::where('user_id', auth()->id())->latest()->get();
        return view('transactions.history', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('details.item');
        return view('transactions.show', compact('transaction'));
    }
}
