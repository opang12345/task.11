<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //tambahan

class mahasantricontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ar_mahasantri = DB::table('mahasantri') //join tabel dengan Query Builder Laravel
        ->join('dosen', 'dosen.id', '=', 'mahasantri.dosen_id')
        ->join('jurusan', 'jurusan.id', '=', 'mahasantri.jurusan_id')
        ->join('matkul', 'matkul.id', '=', 'dosen.matakuliah_id')
        ->select('mahasantri.*', 'dosen.nama AS dos', 'jurusan.nama AS jur','matkul.nama AS mt')
        ->get();
        return view('mahasantri.index',compact('ar_mahasantri'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasantri.c_mahasantri');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate(
            [
               'nama'=>'required|unique:mahasantri',
               'nim'=>'required|max:50',
               'dosen_id'=>'required',
               'jurusan_id'=>'required',
               
               
             ],
        
             //2. menampilkan pesan kesalahan
             [
               'nama.required'=>'Nama Wajib di Isi',
               'nama.unique'=>'Nama tidak Boleh Sama',
               'nim.required'=>'Nim Wajib di Isi',
               'dosen_id.required'=>'Dosen Wajib di Isi',
               'jurusan_id.required'=>'Jurusan Wajib di Isi',
               
        
             ],
         );
         
         
         DB::table('mahasantri')->insert(
            [
               'nama'=>$request->nama,
               'nim'=>$request->nim,
               'dosen_id'=>$request->dosen_id,
               'jurusan_id'=>$request->jurusan_id,
              
            ] );

            return redirect()->route('mahasantri.index')->with('success', 'Data Mahasantri berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ar_mahasantri = DB::table('mahasantri') 
        ->join('jurusan', 'jurusan.id', '=', 'mahasantri.jurusan_id')
        ->join('dosen', 'dosen.id', '=', 'mahasantri.dosen_id')
        ->join('matkul', 'matkul.id', '=', 'dosen.matakuliah_id')
        ->select('mahasantri.*', 'dosen.nama AS dos', 'jurusan.nama AS jur', 'matkul.nama AS mat')
        ->where('mahasantri.id','=',$id)->get();
        return view('mahasantri.show',compact('ar_mahasantri'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //mengarahkan ke halaman edit
      $data = DB::table('mahasantri')->where('id','=',$id)->get();
      return view('mahasantri.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::table('mahasantri')->where('id','=',$id)->update(
            [
               'nama'=>$request->nama,
               'nim'=>$request->nim,
               'dosen_id'=>$request->dosen_id,
               'jurusan_id'=>$request->jurusan_id,
            ] );

            return redirect('/mahasantri');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('mahasantri')->where('id',$id)->delete();
         return redirect('/mahasantri');
    }
}
