<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Alat;
use App\Models\LogAktifitas;

class PengembalianController extends Controller
{
    // =========================================================================
    // BAGIAN 1: KHUSUS ADMIN (FULL AKSES KELOLA)
    // =========================================================================

    public function index(Request $request)
    {
        $datap = Pengembalian::orderBy('id_pengembalian', 'desc')->paginate(10);
        $peminjaman = Peminjaman::all();
        $users = User::all();
        $alats = Alat::all();

        $peminjamanList = [];
        foreach ($peminjaman as $p) {
            $pid = $p->id_peminjaman ?? $p->id;
            $peminjamanList[$pid] = $p;
        }

        $userList = [];
        foreach ($users as $u) {
            $id = $u->id ?? $u->id_user;
            $userList[$id] = $u->username ?? $u->nama ?? "User #{$id}";
        }

        $alatList = [];
        foreach ($alats as $a) {
            $id = $a->id_alat ?? $a->id;
            $alatList[$id] = $a->nama_alat ?? "Alat #{$id}";
        }

        return view('pengembalian.index', compact('datap', 'peminjamanList', 'userList', 'alatList'));
    }

    public function create(Request $request)
    {
        $peminjaman = Peminjaman::where('status', '!=', 'Dikembalikan')->get();
        $users = User::all();
        $alats = Alat::all();

        $userList = [];
        foreach ($users as $u) {
            $id = $u->id ?? $u->id_user;
            $userList[$id] = $u->username ?? $u->nama ?? "User #{$id}";
        }

        $alatList = [];
        foreach ($alats as $a) {
            $id = $a->id_alat ?? $a->id;
            $alatList[$id] = $a->nama_alat ?? "Alat #{$id}";
        }

        return view('pengembalian.create', compact('peminjaman', 'userList', 'alatList'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_peminjaman'        => 'required|integer',
            'tanggal_pengembalian' => 'required|date',
            'kondisi_barang'       => 'nullable|string|max:100',
            'catatan'              => 'nullable|string',
        ]);

        $validatedData['kondisi_barang'] = $validatedData['kondisi_barang'] ?? 'Baik';

        // Ambil data peminjaman untuk hitung denda otomatis
        $peminjaman = Peminjaman::findOrFail($validatedData['id_peminjaman']);
        
        $tanggalBatas = $peminjaman->tanggal_kembali ?? $peminjaman->tanggal_selesai ?? $peminjaman->created_at;
        
        $terlambatHari = 0;
        if ($tanggalBatas) {
            $tglBatas = strtotime($tanggalBatas);
            $tglKembali = strtotime($validatedData['tanggal_pengembalian']);
            if ($tglKembali > $tglBatas) {
                $selisihDetik = $tglKembali - $tglBatas;
                $terlambatHari = floor($selisihDetik / (60 * 60 * 24));
            }
        }

        // Tarif Denda Keterlambatan (Rp 10.000 per hari)
        $tarifDendaPerHari = 10000; 
        $dendaKeterlambatan = $terlambatHari * $tarifDendaPerHari;

        // Denda Berdasarkan Kondisi Barang
        $dendaKerusakan = 0;
        $kondisi = strtolower($validatedData['kondisi_barang']);
        if ($kondisi == 'ringan rusak' || $kondisi == 'rusak ringan') {
            $dendaKerusakan = 50000; // Rp 50.000
        } elseif ($kondisi == 'rusak' || $kondisi == 'rusak berat' || $kondisi == 'rusak / tidak berfungsi') {
            $dendaKerusakan = 100000; // Rp 100.000
        }

        $totalDenda = $dendaKeterlambatan + $dendaKerusakan;

        $validatedData['terlambat_hari'] = $terlambatHari;
        $validatedData['denda'] = $totalDenda;

        // 1. Simpan data pengembalian
        Pengembalian::create($validatedData);

        // 2. Update status peminjaman & denda langsung di tabel peminjaman
        if ($peminjaman->status !== 'Dikembalikan') {
            $peminjaman->update([
                'status' => 'Dikembalikan',
                'denda'  => $totalDenda
            ]);
        }

        $currentUser = User::current();
        LogAktifitas::create([
            'id_user'   => $currentUser->id ?? null,
            'aktifitas' => 'Admin mencatat pengembalian alat (Peminjaman ID: ' . $validatedData['id_peminjaman'] . ') dengan denda Rp ' . number_format($totalDenda, 0, ',', '.') . '.'
        ]);

        return redirect(route('pengembalian.index'))->with('success', 'Data pengembalian berhasil ditambahkan. Total Denda: Rp ' . number_format($totalDenda, 0, ',', '.'));
    }

    public function edit(Request $request, $id_pengembalian)
    {
        $datap = Pengembalian::findOrFail($id_pengembalian);
        $peminjaman = Peminjaman::find($datap->id_peminjaman);

        $peminjamName = '-';
        $alatName = '-';

        if ($peminjaman) {
            $user = User::find($peminjaman->id_user);
            $alat = Alat::find($peminjaman->id_alat);
            if (!$alat) {
                $alat = Alat::where('id_alat', $peminjaman->id_alat)->first();
            }

            $peminjamName = $user->username ?? $user->nama ?? ("User #" . $peminjaman->id_user);
            $alatName = $alat->nama_alat ?? ("Alat #" . $peminjaman->id_alat);
        }

        return view('pengembalian.edit', compact('datap', 'peminjaman', 'peminjamName', 'alatName'));
    }

    public function update(Request $request, $id_pengembalian)
    {
        $validatedData = $request->validate([
            'id_peminjaman'        => 'required|integer',
            'tanggal_pengembalian' => 'required|date',
            'terlambat_hari'       => 'nullable|integer|min:0',
            'denda'                => 'nullable|integer|min:0',
            'kondisi_barang'       => 'nullable|string|max:100',
            'catatan'              => 'nullable|string',
        ]);

        $pengembalian = Pengembalian::findOrFail($id_pengembalian);
        $pengembalian->update($validatedData);

        $currentUser = User::current();
        LogAktifitas::create([
            'id_user'   => $currentUser->id ?? null,
            'aktifitas' => 'Admin memperbarui data pengembalian (ID: ' . $id_pengembalian . ').'
        ]);

        return redirect(route('pengembalian.index'))->with('success', 'Data pengembalian berhasil diubah.');
    }

    public function delete(Request $request, $id_pengembalian)
    {
        $pengembalian = Pengembalian::findOrFail($id_pengembalian);
        $pengembalian->delete();

        $currentUser = User::current();
        LogAktifitas::create([
            'id_user'   => $currentUser->id ?? null,
            'aktifitas' => 'Admin menghapus data pengembalian (ID: ' . $id_pengembalian . ').'
        ]);

        return redirect(route('pengembalian.index'))->with('success', 'Data pengembalian berhasil dihapus.');
    }


    // =========================================================================
    // BAGIAN 2: KHUSUS ROLE PEMINJAM (SISWA)
    // =========================================================================

    public function createPeminjam(Request $request)
    {
        $user = User::current();
        if (!$user) return redirect(route('login'))->with('error', 'Silakan login terlebih dahulu.');

        $id_user = $user->id ?? $user->id_user;
        $peminjamanAktif = Peminjaman::where('id_user', $id_user)
                                   ->whereIn('status', ['Dipinjam', 'Disetujui', 'dipinjam', 'disetujui'])
                                   ->get();

        foreach ($peminjamanAktif as $p) {
            $p->alat = Alat::where('id_alat', $p->id_alat)->first();
        }

        return view('peminjam.pengembalian', compact('user', 'peminjamanAktif'));
    }

    public function storePeminjam(Request $request)
    {
        $currentUser = User::current();
        if (!$currentUser) return redirect(route('login'))->with('error', 'Silakan login terlebih dahulu.');

        $validatedData = $request->validate([
            'id_peminjaman'        => 'required|integer',
            'tanggal_pengembalian' => 'required|date',
            'kondisi_barang'       => 'nullable|string|max:100',
            'catatan'              => 'nullable|string',
        ]);

        $validatedData['kondisi_barang'] = $validatedData['kondisi_barang'] ?? 'Baik';

        // Hitung denda otomatis untuk peminjam
        $peminjaman = Peminjaman::findOrFail($validatedData['id_peminjaman']);
        $tanggalBatas = $peminjaman->tanggal_kembali ?? $peminjaman->created_at;
        
        $terlambatHari = 0;
        if ($tanggalBatas) {
            $tglBatas = strtotime($tanggalBatas);
            $tglKembali = strtotime($validatedData['tanggal_pengembalian']);
            if ($tglKembali > $tglBatas) {
                $selisihDetik = $tglKembali - $tglBatas;
                $terlambatHari = floor($selisihDetik / (60 * 60 * 24));
            }
        }

        $tarifDendaPerHari = 10000;
        $dendaKeterlambatan = $terlambatHari * $tarifDendaPerHari;

        $dendaKerusakan = 0;
        $kondisi = strtolower($validatedData['kondisi_barang']);
        if ($kondisi == 'ringan rusak' || $kondisi == 'rusak ringan') {
            $dendaKerusakan = 50000;
        } elseif ($kondisi == 'rusak' || $kondisi == 'rusak berat' || $kondisi == 'rusak / tidak berfungsi') {
            $dendaKerusakan = 100000;
        }

        $totalDenda = $dendaKeterlambatan + $dendaKerusakan;

        $validatedData['terlambat_hari'] = $terlambatHari;
        $validatedData['denda'] = $totalDenda;

        // Simpan data pengembalian ke tabel pengembalian
        Pengembalian::create($validatedData);

        // Update status dan denda di tabel peminjaman
        if ($peminjaman->status !== 'Dikembalikan') {
            $peminjaman->update([
                'status' => 'Dikembalikan',
                'denda'  => $totalDenda
            ]);
        }

        LogAktifitas::create([
            'id_user'   => $currentUser->id,
            'aktifitas' => 'Peminjam ' . ($currentUser->username ?? 'Siswa') . ' mengajukan pengembalian alat.'
        ]);

        $pesanSukses = 'Pengajuan pengembalian berhasil dikirim.';
        if ($totalDenda > 0) {
            $pesanSukses .= ' Total denda tercatat: Rp ' . number_format($totalDenda, 0, ',', '.');
        }

        return redirect(route('peminjam.riwayat'))->with('success', $pesanSukses);
    }


    // =========================================================================
    // BAGIAN 3: KHUSUS ROLE PETUGAS (PANTAU & CETAK LAPORAN)
    // =========================================================================

    public function indexPetugas(Request $request)
    {
        $user = User::current();
        if (!$user) {
            return redirect(route('login'))->with('error', 'Silakan login terlebih dahulu.');
        }

        $datap = Pengembalian::orderBy('id_pengembalian', 'desc')->paginate(10);
        
        $peminjaman = Peminjaman::all();
        $users = User::all();
        $alats = Alat::all();

        $peminjamanList = [];
        foreach ($peminjaman as $p) {
            $pid = $p->id_peminjaman ?? $p->id;
            $peminjamanList[$pid] = $p;
        }

        $userList = [];
        foreach ($users as $u) {
            $id = $u->id ?? $u->id_user;
            $userList[$id] = $u->username ?? $u->nama ?? "User #{$id}";
        }

        $alatList = [];
        foreach ($alats as $a) {
            $id = $a->id_alat ?? $a->id;
            $alatList[$id] = $a->nama_alat ?? "Alat #{$id}";
        }

        return view('petugas.pantau_pengembalian', compact('datap', 'peminjamanList', 'userList', 'alatList'));
    }

    public function cetakPetugas(Request $request)
    {
        $user = User::current();
        if (!$user) {
            return redirect(route('login'))->with('error', 'Silakan login terlebih dahulu.');
        }

        $datap = Pengembalian::orderBy('id_pengembalian', 'desc')->get();
        
        $peminjaman = Peminjaman::all();
        $users = User::all();
        $alats = Alat::all();

        $peminjamanList = [];
        foreach ($peminjaman as $p) {
            $pid = $p->id_peminjaman ?? $p->id;
            $peminjamanList[$pid] = $p;
        }

        $userList = [];
        foreach ($users as $u) {
            $id = $u->id ?? $u->id_user;
            $userList[$id] = $u->username ?? $u->nama ?? "User #{$id}";
        }

        $alatList = [];
        foreach ($alats as $a) {
            $id = $a->id_alat ?? $a->id;
            $alatList[$id] = $a->nama_alat ?? "Alat #{$id}";
        }

        return view('petugas.cetak_pengembalian', compact('datap', 'peminjamanList', 'userList', 'alatList', 'user'));
    }
}