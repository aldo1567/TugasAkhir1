<?php

namespace App\Http\Controllers;

use App\Karyawan;
use Illuminate\Http\Request;

use App\Status;
use App\Jabatan;
use App\Pendidikan;
use App\Telepon;

use Datatables;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data=Karyawan::all();
        $status=Status::all();
        $jabatan=Jabatan::all();
        $pendidikan=Pendidikan::all();
        return view('pages.karyawan.index',compact('data','status','jabatan','pendidikan'));
        
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
            'nama_Karyawan'=>'required|min:3|max:25|unique:karyawans',
            'gender'=>'required|in:P,L',
            'umur'=>'required|integer',
            'status_id'=>'required',
            'jabatan_id'=>'required',
            'pendidikan_id'=>'required',
        ]);
        $karyawan=Karyawan::create($validateData);
        $telp=new Telepon;
        $telp->no_hp=$request->input('no_hp');
        $karyawan->telepon()->save($telp);
        return redirect()->route('karyawan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit(Karyawan $karyawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        //
        $validateData=$request->validate([
            'nama_Karyawan'=>'required|min:3|max:25|unique:karyawans,nama_Karyawan,'.$karyawan->id,
            'gender'=>'required|in:P,L',
            'umur'=>'required|integer',
            'status_id'=>'required',
            'jabatan_id'=>'required',
            'pendidikan_id'=>'required',
        ]);
        $karyawan->update($validateData);
        $telp=$karyawan->telepon;
        $telp->no_hp=$request->input('no_hp');
        $karyawan->telepon()->save($telp);
        return redirect()->route('karyawan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Karyawan $karyawan)
    {
        //
        $karyawan->delete();
        return redirect()->route('karyawan.index');
    }
}
