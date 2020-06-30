<?php

namespace App\Http\Controllers;

use App\Jabatan;
use Illuminate\Http\Request;
use Log;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data=Jabatan::all();
        return view('pages.jabatan.index',compact('data'));
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
            'nama_jabatan'=>'required|unique:jabatans',
        ]);
        Jabatan::create($validateData);
        return redirect()->route('jabatan.index')->with([
            'css'=>'alert alert-success',
            'status'=>"Data Jabatan {$request->nama_jabatan} Berhasil Ditambah ",
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jabatan $jabatan)
    {
        //
        
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        //
        Log::debug($request->all());
        Log::debug($jabatan);
        $validateData=$request->validate([
            'nama_jabatan'=>'required|unique:jabatans,nama_jabatan,'.$jabatan->id,
        ]);
        $jabatan->update($validateData);
        return redirect()->route('jabatan.index')->with([
            'css'=>'alert alert-warning',
            'status'=>"Data Jabatan {$request->nama_jabatan} Berhasil Diupdate ",
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jabatan $jabatan)
    {
        //
        $jabatan->delete();
        return redirect()->route('jabatan.index')->with([
            'css'=>'alert alert-danger',
            'status'=>"Data Jabatan {$jabatan->nama_jabatan} Berhasil Ditambah ",
            ]);
    }
}
