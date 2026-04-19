<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('category')->get();
        return view('items.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|unique:items|max:255',
            'price' => 'required|integer|min:100',
            'stock' => 'required|integer|min:0',
        ]);
        Item::create($request->all());
        return redirect()->route('items.index')->with('Berhasil', 'Barang Berhasil Ditambahkan.');
    }

    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|unique:items,name,' . $item->id,
            'price' => 'required|integer|min:100',
            'stock' => 'required|integer|min:0',
        ]);
        $item->update($request->all());
        return redirect()->route('items.index')->with('Berhasil', 'Barang Berhasil Diupdate.');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('Berhasil', 'Barang Berhasil Dihapus.');
    }
}
