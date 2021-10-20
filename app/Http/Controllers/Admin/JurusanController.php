<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jurusan;
use App\Fakultas;
use App\Civitas_Akademika;

class JurusanController extends Controller
{
    public function createJurusan($fakultas)
    {
        $id_fakultas = $fakultas;
        return view('admin.jurusans.create',compact('id_fakultas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'unique:jurusan,nama',

        ]);
        $nama = $request->nama;
        $id_fakultas = $request->id_fakultas;
        Jurusan::create([
            'nama' => $request->nama,
            'id_fakultas' => $request->id_fakultas,]);
        return redirect()->route('admin.fakultass.index');
    }

    public function edit($id)
    {
        $jurusan = Jurusan::find($id);
        return view('admin.jurusans.edit',compact('jurusan'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'unique:jurusan,nama',

        ]);
        Jurusan::where('id',$id)->update([
            'nama' => $request->nama,]);
        return redirect()->route('admin.fakultass.index');   
    }
    
    public function show($id_jurusan)
    {
        $civitas_akademika = Civitas_Akademika::all()->where('id_jurusan',$id_jurusan);
        // return $jurusan;
        return view('admin.jurusans.show', compact('id_jurusan','civitas_akademika'));
    }

    public function destroy(Request $request, $id)
    {
        Jurusan::where('id',$id)->delete();
        return back();
    }

}
