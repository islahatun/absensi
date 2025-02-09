<?php

namespace App\Http\Controllers\Api;

use App\Models\izin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IzinController extends Controller
{
    public function izin(Request $request){

        $izin   = new izin();
        $izin->date_permission  = $request->date_permission;
        $izin->reason           = $request->reason;
        $izin->user_id          = $request->user()->id;

        if($request->hasFile('image')){
            $image  = $request->file('image');
            $image->storeAs('public/izin',$image->hashName());
            $izin->image    = $image->hashName();
        };

        $izin->save();



        return response([
            'message'=> 'Permission Created',
            'data'  =>$izin
        ],201);

    }
}
