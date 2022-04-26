<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;

use App\Cart;
use App\Transaction;
use App\TransactionDetail;
use App\Models\AccountAddress;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        
        $user = Auth::user();
        $new_total_price = 0;
        $user->update($request->except('total_price'));
        $address = 0;
        
        if($request->flexRadioDefault == 'diantar') {
            $address = AccountAddress::create([
                'users_id' => Auth::user()->id,
                'address1' => $request->address_one,
                'address2' => $request->address_two,
                'province' => $request->provinces_id,
                'city' => $request->regencies_id,
                'zip' => $request->zip_code,
                'country' => $request->country,
                'mobile' => $request->phone_number,
            ]);
        }
        

        //proses checkout

        // $code = 'STORE-'. mt_rand(000000,999999);
        $carts = Cart::with(['product','user'])
                    ->where('users_id', Auth::user()->id)
                    ->get();

        if($request->flexRadioDefault == 'diantar') {
            $transaction = Transaction::create([
                'users_id' => Auth::user()->id,
                'inscurance_price' => 0,
                'shipping_price' => 0,
                'total_price' => (int) $request->total_price,
                'transaction_status' => 'Proses',
                'address_id' => $address->id,
            ]);
        } else {
            $transaction = Transaction::create([
                'users_id' => Auth::user()->id,
                'inscurance_price' => 0,
                'shipping_price' => 0,
                'total_price' => (int) $request->total_price,
                'transaction_status' => 'Proses',
                'address_id' => $address,
            ]);
        }
        
        
        $new_total_price = 0;

        foreach ($carts as $cart){
            $trx = 'TRX-' . mt_rand(000000,999999);
            $new_total_price = $new_total_price + ($cart->product->price * $cart->total);
            TransactionDetail::create([
                'transactions_id' =>$transaction->id,
                'products_id' => $cart->product->id,
                'price' => $cart->product->price,
                'total' => $cart->total,
            ]);

        }


        $transaction->update(['total_price' => $new_total_price]);

        // delete cart data
        Cart::where('users_id', Auth::user()->id)->delete();


        return redirect('success');
        //konfigurasi midtrans

        // Config::$serverKey = "SB-Mid-server-M6cee59uKtcIhozORsxZQrCX";
        // Config::$isProduction = false;
        // Config::$isSanitized = true;
        // Config::$is3ds = true;

        //buat array dikirim midtrans

        // $midtrans = [
        //     'transaction_details' => [
        //         'order_id' => $code,
        //         'gross_amount' => (int) $request->total_price,
        //     ],
        //     'customer_details' => [
        //         'first_name' => Auth::user()->name,
        //         'email' => Auth::user()->email,
        //     ],
        //     'enabled_payment' => [
        //         'gopay', 'permata_va', 'bank_transfer'
        //     ],

        //     'vtweb' => []

        //     ];

        //     try {
        //         // Get Snap Payment Page URL
        //         $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
                
        //         // Redirect to Snap Payment Page
        //         return redirect($paymentUrl);
        //     }
        //     catch (Exception $e) {
        //         echo $e->getMessage();
        //     }
            
    }
}
