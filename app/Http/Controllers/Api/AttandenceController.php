<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\attandence;
use Illuminate\Http\Request;

class AttandenceController extends Controller
{
    public function checkIn(Request $request)
    {
        $attandence = $request->user()->attandence()->create([
            'time_in'   => date('H:i:s'),
            'date'      => date('Y-m-d'),
            'latlon_in' => $request->latitude . ',' . $request->longtitude
        ]);

        return response(['message' => 'Checkin Success', 'data' => $attandence], 200);
    }
    public function checkOut(Request $request)
    {
        $attandence = $request->user()->attandence()->where('date', date('Y-m-d'))->update([
            'time_out'  => date('H:i:s'),
            'date'      => date('Y-m-d'),
            'latlon_out' => $request->latitude . ',' . $request->longtitude
        ]);

        return response(['message' => 'ChekOut Success', 'data' => $attandence], 200);
    }

    public function isCheckedIn(Request $request)
    {
        $attandence = $request->user()->attandence()->where('date', date('Y-m-d'))->first();
        return response([
            'status' => $attandence ? true : false,
        ],200);
    }

    public function isCheckedOut(Request $request)
    {
        $attandence = $request->user()->attandence()->where('date', date('Y-m-d'))->whereNotNull('time_out')->first();

        return response([
            'status' => $attandence ? true : false,
        ],200);
    }
}
