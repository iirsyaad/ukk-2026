<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $data = Kategori::orderBy('id_kategori', 'desc')
            ->paginate(10);

        return view('kategori.index', compact('data'));
    }

    public function create(Request $request)
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kategori' => 'required|string|max:20',
            'kode_kategori' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        Kategori::create($data);

        return redirect(route('kategori.index'))
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Request $request, $id)
    {
        $kategori = Kategori::all();
        $kategori = Kategori::findOrFail($id);

        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nama_kategori' => 'required|string|max:20',
            'kode_kategori' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        $kategori = Kategori::findOrFail($id);

        $kategori->update($data);

        return redirect(route('kategori.index'))
            ->with('success', 'Daftar kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);

        $kategori->delete();

        return redirect(route('kategori.index'))
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
