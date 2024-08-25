<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Room;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = Transaction::latest()->paginate(15);
        $counts = Transaction::all();
        $products = Product::all();
        $customers = User::where('role', 'USER')->get();
        $rooms = Room::all();

        return view('pages.home.index', [
            'title' => 'Overview',
            'transactions' => $transactions,
            'counts' => count($counts),
            'products' => count($products),
            'customers' => count($customers),
            'rooms' => count($rooms),
        ]);
    }
}
