<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AccountAddress;

class DashboardSettingController extends Controller
{
    public function account()
    {
        $user = AccountAddress::where('users_id', Auth::user()->id);

        if($user){
            return view('pages.dashboard-account',[
                'user' => $user,
            ]);
        }

        return view('pages.dashboard-account');
        
    }

    public function update(Request $request, $redirect){
        $data = $request->all();
        $item = Auth::user();

        $item->update($data);

        return redirect()->route($redirect);
    }
}
