<?php

namespace App\Http\Controllers\Sales;

use App\Transaction;
use App\TransactionDetail;
use PDF;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
// use App\Http\Requests\Admin\TransactionRequest;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax())
        {
            $query = Transaction::with(['user','last_edit']);
            return Datatables::of($query)
                ->addcolumn('action', function($item) {
                    return '
                        <div class="btn-group">
                            <a class="btn btn-primary" href="' . route('transactions-sales.edit', $item->id) . '">
                                Proses
                            </a>
                        </div>
                    ';
                })

                ->rawColumns(['action'])
                ->make();
        }

        return view('pages.sales.transaction.index');
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Transaction::findOrFail($id);
        $transaction_details = TransactionDetail::with(['transaction.user','product.galleries'])
                                ->where('transactions_id', $id);
                                

        return view('pages.sales.transaction.edit', [
            'item' => $item,
            'transaction_details' => $transaction_details->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Transaction::findOrFail($id);

        if ($item->transaction_status == 'Proses'){
            $data['transaction_status'] = $request->transaction_status;
            $data['last_edited'] = Auth::id();
            $item->update($data);

            return redirect()->route('transactions-sales.index')->with(['success' => 'Data berhasil diubah.']);
        } else {
            if ($item->last_edited == Auth::id()){
                $data['transaction_status'] = $request->transaction_status;
                $data['last_edited'] = Auth::id();
                $item->update($data);

                return redirect()->route('transactions-sales.index')->with(['success' => 'Data berhasil diubah.']);
            }

            return redirect()->route('transactions-sales.index')->with(['error' => 'Data tidak bisa diubah karna sudah dihandle oleh sales lain.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    public function generatePDF($id)
    {
        $item = Transaction::findorFail($id);
        $transaction_details = TransactionDetail::with(['transaction.user'])
                                ->where('transactions_id', $id)->get();

        view()->share([
            'item'=> $item,
            'transaction_details'=> $transaction_details,
        ]);
        $pdf = PDF::loadView('pages.admin.transaction.pdf', [
            'item'=> $item,
            'transaction_details'=> $transaction_details,
        ]);
        
        return $pdf->stream('INVMBP-'.$item->id.'.pdf');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
}
