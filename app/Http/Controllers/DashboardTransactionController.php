<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransactionDetail;

class DashboardTransactionController extends Controller
{
    public function index()
    {
        return view('pages.dashboard-transactions');
    }

    public function details($id)
    {

        $transaction = TransactionDetail::with(['transaction.user','product.galleries'])
                            ->findOrFail($id);



        return view('pages.dashboard-transactions-details',[
            'transaction' => $transaction
        ]);
    }
}
