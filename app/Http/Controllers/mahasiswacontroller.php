<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class mahasiswacontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = mahasiswa::orderBy('nim', 'desc')->paginate(1);
        return view('mahasiswa.index')->with('data', $data);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('mahasiswa.create');
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
        Session::flash('mk', $request->mk);
        Session::flash('dosen', $request->dosen);

        $request->validate([
            'nim' => 'required|numeric|unique:mahasiswa,nim',
            'nama' => 'required',
            'mk' => 'required',
            'dosen' => 'required',
        ],[
            'nim.required' => 'NIM wajib diisi',
            'nim.numeric' => 'NIM wajib dalam angka',
            'nim.unique' => 'NIM yang diisikan sudah ada dalam database',
            'nama.required' => 'Nama wajib diisi',
            'mk.required' => 'mata kuliah wajib diisi',
            'dosen.required' => 'dosen mata kuliah wajib diisi',
        ]);

        $data = [
            'nim'=>$request->nim,
            'nama'=>$request->nama,
            'mk'=>$request->mk,
            'dosen'=>$request->dosen,
        ];
        mahasiswa::create($data);
        return redirect()->to('mahasiswa')->with('success','Berhasil menambahkan data');
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
        $data = mahasiswa::where('nim',$id)->first();
        return view('mahasiswa.edit')->with('data',$data);
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
            'mk' => 'required',
            'dosen' => 'required',
        ],[
            'nama.required' => 'Nama wajib diisi',
            'mk.required' => 'mata kuliah wajib diisi',
            'dosen.required' => 'dosen mata kuliah wajib diisi',
        ]);

        $data = [
            'nama'=>$request->nama,
            'mk'=>$request->mk,
            'dosen'=>$request->dosen,
        ];
        mahasiswa::where('nim',$id)->update($data);
        return redirect()->to('mahasiswa')->with('success','Berhasil update data');
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
        return redirect()->to('mahasiswa')->with('Success');
    }
}
