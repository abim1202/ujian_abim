<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\mahasiswa;
use Illuminate\Http\Request;

class mahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Mahasiswa::orderBy('nim', 'desc')->paginate(2);
        return view('mahasiswa.index', ['data' => $data]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('nim', $request->nim);
        Session::flash('nama', $request->nama);
        Session::flash('jurusan', $request->jurusan);


        $request->validate([
            'nim' => 'required|numeric|unique:mahasiswa,nim',
            'nama' => 'required',
            'jurusan' => 'required',
        ], [
            'nim.required' => 'NIM wajib diisi',
            'nim.numeric' => 'NIM wajib angka',
            'nim.unique' => 'NIM sudah ada',
            'nama.required' => 'NAMA wajib diisi',
            'jurusan.required' => 'JURUSAN wajib diisi',
        ]);
    
        $data = [
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
        ];
    
        Mahasiswa::create($data);
    
        return redirect()->to('mahasiswa')->with('berhasil','data sudah di tambahkan');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Mahasiswa::where('nim', $id)->first();
        return view('mahasiswa.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'jurusan' => 'required',
        ], [
            'nama.required' => 'NAMA wajib diisi',
            'jurusan.required' => 'JURUSAN wajib diisi',
        ]);
    
        $data = [
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
        ];
    
        Mahasiswa::where('nim', $id)->update($data);
    
        return redirect()->to('mahasiswa')->with('berhasil', 'Data sudah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      mahasiswa::where('nim', $id)->delete();
      return redirect()->to('mahasiswa')->with('berhasil','berhasil menghapus data');
    }
    
}
