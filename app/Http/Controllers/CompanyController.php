<?php

namespace App\Http\Controllers;

use App\Models\company;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'type_menu' => 'master',
            'menu'      => 'Company',
            'form'      => 'Form Company'
        ];
        return view('pages.company.index',$data);
    }

    public function getData(){
        $result  = company::get();

        return DataTables::of($result)->addIndexColumn()
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
        $data =  $request->validate([
            'name'      => 'required',
            'address'   => 'required',
            'email'     => 'required',
            'latitude'  => 'required',
            'longitude' => 'required',
            'radius_km' => 'required',
            'time_in'   => 'required',
            'time_out'  => 'required',
        ]);

        $result = company::create($data);

        if ($result) {
            $message = array(
                'status' => true,
                'message' => 'Data Berhasil di simpan'
            );
        } else {
            $message = array(
                'status' => false,
                'message' => 'Data gagal di simpan'
            );
        }

        echo json_encode($message);
    }

    /**
     * Display the specified resource.
     */
    public function show(company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, company $company)
    {
        // Validate the request data
        $request->validate([
            'name'      => 'required',
            'address'   => 'required',
            'email'     => 'required',
            'latitude'  => 'required',
            'longitude' => 'required',
            'radius_km' => 'required',
            'time_in'   => 'required',
            'time_out'  => 'required',
        ]);

        // Update the category with the new data
        $user = company::find($request->id);
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->address  = $request->address;
        $user->latitude = $request->latitude;
        $user->longitude= $request->longitude;
        $user->radius_km= $request->radius_km;
        $user->time_in  = $request->time_in;
        $user->time_out = $request->time_out;


        if ($user->save()) {
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
    public function destroy(company $company)
    {
        if ($company->delete()) {
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
