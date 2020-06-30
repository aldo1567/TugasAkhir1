<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data=Status::all();
        return view('pages.status.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validateData=$request->validate([
            'status_karyawan'=>'required|unique:statuses'
        ]);
        Status::create($validateData);
        return redirect()->route('status.index')->with([
            'css'=>'alert alert-success',
            'status'=>"Data Status {$request->status_karyawan} Berhasil Ditambah ",
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        //
        $validateData=$request->validate([
            'status_karyawan'=>'required|unique:statuses,status_karyawan,'.$status->id
        ]);
        $status->update($validateData);
        return redirect()->route('status.index')->with([
            'css'=>'alert alert-warning',
            'status'=>"Data Status {$request->status_karyawan} Berhasil Diubah ",
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        //
        $status->delete();
        return redirect()->route('status.index')->with([
            'css'=>'alert alert-danger',
            'status'=>"Data Status {$status->status_karyawan} Berhasil Dihapus ",
            ]);
    }
}
