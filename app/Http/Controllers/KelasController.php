<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;


class KelasController extends Controller
{
    public function index()
    {
        $data = Kelas::all()->sortBy('created_at');
        $guru = Guru::all();

        
        return view('kelas.index',[
            'data' => $data,
            'guru' => $guru
        ]);
    }


    public function insert(Request $request){

        $this->validate($request,[
            'nama_kelas' => 'required',
            'guru_id' => 'required'
        ]);

        kelas::create($request->all());
        
        return redirect()->route('kelas')->with('Success','Data berhasil Ditambahkan!');
    }


    public function destroy($id){
        $data = kelas::find($id);

        $data->delete();
        
        return redirect()->route('kelas');
    }


    public function edit($id){
        
        $data = kelas::find($id);
        $guru = Guru::all()->sortBy('nama_guru');

        return view('kelas.edit',[
            'data' => $data,
            'guru' => $guru
        ]);
    }


    public function update(Request $request,$id){
        $data = kelas::find($id);

        $data->update($request->all());
        
        return redirect()->route('kelas')->with('Edit','Data berhasil Diubah!');
    }

    public function form(){
        $data = Kelas::all();
        $guru = Guru::all()->sortBy('nama_guru');
        return view('kelas.tambah',[
            'data' => $data,
            'guru' => $guru
        ]);
    }
}

