<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Fakultas;
use App\Jurusan;
use App\Civitas_Akademika;



class FakultasController extends Controller
{
    public function index()
    {
        $fakultas = Fakultas::all();
        return view('admin.fakultass.index', compact('fakultas'));
    }

    public function create(Request $request)
    {
        return view('admin.fakultass.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'unique:fakultas,nama',

        ]);
        $nama = $request->nama;
        Fakultas::create([
            'nama' => $request->nama,]);
        return redirect()->route('admin.fakultass.index');
        }
    
    public function edit($id)
    {
        $fakultas = Fakultas::find($id);
        return view('admin.fakultass.edit',compact('fakultas'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'unique:fakultas,nama',

        ]);
        Fakultas::where('id',$id)->update([
            'nama' => $request->nama,]);
        return redirect()->route('admin.fakultass.index');
            
        
    }

    public function show($id_fakultas)
    {
        $jurusan = Jurusan::all()->where('id_fakultas',$id_fakultas);
        // return $jurusan;
        return view('admin.fakultass.show', compact('id_fakultas','jurusan'));
    }

    public function destroy(Request $request, $id)
    {
        Fakultas::where('id',$id)->delete();
        return back();
    }

}
