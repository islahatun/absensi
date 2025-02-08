<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\attandence;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AttandenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'type_menu' => 'master',
            'menu'      => 'Attandence',
            'form'      => 'Form Attandence'
        ];
        return view('pages.attandence.index', $data);
    }

    public function getData()
    {
        $result  = attandence::with('user')->get();

        return DataTables::of($result)->addIndexColumn()
            ->addColumn('name', function ($data) {
                return $data->user->name;
            })
            ->addColumn('time_in', function ($data) {
                return Carbon::parse($data->time_in)->format('H:i:s');
            })
            ->addColumn('time_out', function ($data) {
                return  Carbon::parse($data->time_out)->format('H:i:s');
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(attandence $attandence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(attandence $attandence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, attandence $attandence)
    {
        // Validate the request data
        $request->validate([
            'date'      => 'required',
            'time_in'   => 'required',
            'time_out'  => 'required',
        ]);

        // Update the category with the new data
        $att = attandence::find($request->id);

        $att->date         = $request->date;
        $att->time_in      = $request->time_in;
        $att->time_out     = $request->time_out;


        if ($att->save()) {
            $message = array(
                'status' => true,
                'message' => 'Data Berhasil di ubah'
            );
        } else {
            $message = array(
                'status' => false,
                'message' => 'Data gagal di ubah'
            );
        }

        echo json_encode($message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(attandence $attandence)
    {
        if ($attandence->delete()) {
            $message = array(
                'status' => true,
                'message' => 'Data Berhasil dihapus'
            );
        } else {
            $message = array(
                'status' => false,
                'message' => 'Data gagal dihapus'
            );
        }

        echo json_encode($message);
    }
}
