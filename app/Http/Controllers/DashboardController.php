<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $totalCategories = Category::count();
        $totalItems = Item::count();
        $totalTransactions = Transaction::count();

        return view('dashboard', compact('totalCategories', 'totalItems', 'totalTransactions'));
    }
}
