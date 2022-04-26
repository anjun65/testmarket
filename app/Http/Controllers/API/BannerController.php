<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Helpers\ResponseFormatter;

class BannerController extends Controller
{
    public function all(Request $request)
    {
        
        $banners = Banner::where("is_show", 1)->latest()->get();

        if($banners)
            return ResponseFormatter::success(
                $banners,
                'Data banner berhasil diambil'
            );
        else
            return ResponseFormatter::error(
                null,
                'Data banner tidak ada',
                404
            );

        
    }
}
