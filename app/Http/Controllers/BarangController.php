<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    //menampilkan daftar barang//
    public function indeks()
    {
        $items = Item::with('category')->get();
        return view('barang.indeks', compact('items'));
    }

    //menampilkan halaman tambah barang//
    public function tambah()
    {
        $categories = Category::all();
        return view('barang.tambah', compact('categories'));
    }

    //menyimpan barang baru//
    public function simpan(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|unique:items|max:255',
            'price' => 'required|integer|min:100',
            'stock' => 'required|integer|min:0',
        ], [
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori tidak valid.',
            'name.required' => 'Nama barang tidak boleh kosong.',
            'name.unique' => 'Nama barang sudah terdaftar.',
            'price.required' => 'Harga tidak boleh kosong.',
            'price.min' => 'Harga minimal adalah Rp 100.',
            'stock.required' => 'Stok tidak boleh kosong.',
            'stock.min' => 'Stok tidak boleh bernilai negatif.',
        ]);
        Item::create($request->all());
        return redirect()->route('barang.indeks')->with('Berhasil', 'Barang Berhasil Ditambahkan.');
    }

    //menampilkan halaman ubah barang beserta data kategori//
    public function ubah(Item $item)
    {
        $categories = Category::all();
        return view('barang.ubah', compact('item', 'categories'));
    }

    //manyimpan pembaruan data barang//
    public function perbarui(Request $request, Item $item)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|unique:items,name,' . $item->id,
            'price' => 'required|integer|min:100',
            'stock' => 'required|integer|min:0',
        ], [
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori tidak valid.',
            'name.required' => 'Nama barang tidak boleh kosong.',
            'name.unique' => 'Nama barang sudah terdaftar digunakan.',
            'price.required' => 'Harga tidak boleh kosong.',
            'price.min' => 'Harga minimal adalah Rp 100.',
            'stock.required' => 'Stok tidak boleh kosong.',
            'stock.min' => 'Stok tidak boleh bernilai negatif.',
        ]);
        $item->update($request->all());
        return redirect()->route('barang.indeks')->with('Berhasil', 'Barang Berhasil Diperbarui.');
    }

    //menghapus data barang//
    public function hapus(Item $item)
    {
        $item->delete();
        return redirect()->route('barang.indeks')->with('Berhasil', 'Barang Berhasil Dihapus.');
    }
}
