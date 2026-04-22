<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    //list semua kategori//
    public function indeks()
    {
        $categories = Category::all();
        return view('kategori.indeks', compact('categories'));
    }

    //menampilkan halaman tambah kategori//
    public function tambah()
    {
        return view('kategori.tambah');
    }

    //menyimpan data kategori ke database//
    public function simpan(Request $request)
    {
        $request->validate(['name' => 'required|string|unique:categories|max:255']);
        Category::create($request->all());
        return redirect()->route('kategori.indeks')->with('Berhasil', 'Kategori Berhasil Ditambahkan.');
    }

    //menampilkan halaman ubah kategori//
    public function ubah(Category $category)
    {
        return view('kategori.ubah', compact('category'));
    }

    //menyimpan pembaruan kategori//
    public function perbarui(Request $request, Category $category)
    {
        $request->validate(['name' => 'required|string|max:255|unique:categories,name,' . $category->id]);
        $category->update($request->all());
        return redirect()->route('kategori.indeks')->with('Berhasil', 'Kategori Berhasil Diperbarui.');
    }

    //menghapus kategori//
    public function hapus(Category $category)
    {
        $category->delete();
        return redirect()->route('kategori.indeks')->with('Berhasil', 'Kategori Berhasil Dihapus.');
    }
}
