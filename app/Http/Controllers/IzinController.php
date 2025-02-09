<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\izin;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class IzinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = [
            'type_menu' => 'master',
            'menu'      => 'Izin',
            'form'      => 'Form Izin'
        ];
        return view('pages.izin.index', $data);
    }
    public function getData()
    {
        $result  = izin::with('user')->get();

        return DataTables::of($result)->addIndexColumn()
        ->addColumn('name', function ($data) {

            return $data->user?$data->user->name:'-';
        })
            ->addColumn('is_approval', function ($data) {

                return $data->is_approval ==0?'Tidak disetujui':'disetujui';
            })
            ->addColumn('date_permission', function ($data) {
                return $data->date_permission;
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
    public function show(izin $izin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(izin $izin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, izin $izin)
    {
         // Validate the request data
         $request->validate([
            'date_permission'      => 'required',
            'reason'   => 'required',
            'image'  => 'required',
        ]);

        // Update the category with the new data
        $att = izin::find($request->id);

        $att->date_permission   = $request->date_permission;
        $att->reason            = $request->reason;
        $att->is_approval       = $request->is_approval;


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
    public function destroy(izin $izin)
    {
        //
    }
}
