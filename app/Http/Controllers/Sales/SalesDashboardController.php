<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Transaction;
use Illuminate\Support\Facades\Auth;

class SalesDashboardController extends Controller
{
    public function index()
    {
        $customer = User::count();
        $revenue = Transaction::where('users_id', Auth::id())->where('transaction_status','Terkirim')->sum('total_price');
        $transactions = Transaction::count();

        return view('pages.sales.dashboard', [
            'customer' => $customer,
            'revenue' => $revenue,
            'transactions' => $transactions,
        ]);
    }
}
