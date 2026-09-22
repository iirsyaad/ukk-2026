<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Alat;

class AlatController extends Controller
{
  
       public function index(Request $request)
    {
        $data = alat::orderBy('id_alat','desc')->paginate(10);
    return view('alat.index', compact('data'));
    }

    public function create(Request $request)
    {
        return view('alat.create');
    }

    public function store(Request $request)
    {
       $data = $request->validate([
            'nama_alat' => 'required|string|max:20',
            'kode_alat' => 'required|varchar|max:255',
        ]);

       alat::create($data);
        return redirect(route('alat.index'))->with('success', 'alat berhasil ditambahkan.');
    
    }
    public function edit(Request $request, $id)
    {
    $alat = alat::findorfail($id);
    return view('alat.edit', compact('alat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_alat'=>'required',
            'kode_alat'=>'required',
        ]);
        $alat = alat::findorfail($id);
        $alat->update([
            'nama_alat'=> $request->nama_alat,
            'kode_alat'=> $request->kode_alat,
        ]);
        return redirect()->route('alat.index')->with('success','daftar alat berhasil di perbarui');
    }
    public function destroy($id)
    {
        $alat=alat::findorfail($id);
        $alat->delete();
        return redirect()->route('alat.index')->with('success', 'alat berhasil di hapus');
    }
    }
