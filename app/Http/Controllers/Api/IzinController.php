<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IzinController extends Controller
{
    public function izin(Request $request){

        $izin   = $request->user()->izin()->create([
            'date_permission'   => $request->date_permission,
            'reason'            => $request->reason
        ]);

        return response([
            'message'=> 'Permission Created',
            'data'  =>$izin
        ],201);

    }
}
