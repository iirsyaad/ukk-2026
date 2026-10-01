<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Alat;
use App\Models\Kategori;

class AlatController extends Controller
{
    public function index(Request $request)
    {
        $data = Alat::orderBy('id_alat', 'desc')
            ->paginate(4);

        return view('alat.index', compact('data'));
    }

    public function create(Request $request)
    {
        $kategori = Kategori::all();

        return view('alat.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_alat' => 'required|string|min:3|max:100',
            'kode_alat' => 'required|string|min:3|max:100',
            'id_kategori' => 'required',
        ]);

        Alat::create($data);

        return redirect(route('alat.index'))
            ->with('success', 'Alat berhasil ditambahkan.');
    }

    public function edit(Request $request, $id_alat)
    {
        $data = Alat::findOrFail($id_alat);
        $kategori = Kategori::all();

        return view('alat.edit', compact('data', 'kategori'));
    }

    public function update(Request $request, $id_alat)
    {
        $data = $request->validate([
            'nama_alat' => 'required|string|min:3|max:100',
            'kode_alat' => 'required|string|min:3|max:100',
            'id_kategori' => 'nullable|exist:kategori,id_kategori',
                    ]);

        $alat = Alat::findOrFail($id_alat);

        $alat->update($data);

        return redirect(route('alat.index'))
            ->with('success', 'Alat berhasil diubah.');
    }

    public function destroy(Request $request, $id_alat)
    {
        $alat = Alat::findOrFail($id_alat);

        $alat->delete();

        return redirect(route('alat.index'))
            ->with('success', 'Alat berhasil dihapus.');
    }
}
