<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Civitas_Akademika;

class CivitasAkademikaController extends Controller
{
    public function index()
    {
        $civitas_akademika = Civitas_Akademika::all();
        return view('admin.civitasakademikas.index', compact('civitas_akademika'));
    }

    public function create(Request $request)
    {
        return view('admin.civitasakademikas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'unique:civitas_akademika,nama',

        ]);
        $nama = $request->nama;
        Civitas_Akademika::create([
            'nama' => $request->nama,]);
        return redirect()->route('admin.civitasakademikas.index');
        }
    
    public function edit($id)
    {
        $civitas_akademika = Civitas_Akademika::find($id);
        return view('admin.civitasakademikas.edit',compact('civitas_akademika'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'unique:civitas_akademika,nama',

        ]);
        Civitas_Akademika::where('id',$id)->update([
            'nama' => $request->nama,]);
        return redirect()->route('admin.civitasakademikas.index');
            
        
    }

    public function destroy(Request $request, $id)
    {
        Civitas_Akademika::where('id',$id)->delete();
        return back();
    }

}
