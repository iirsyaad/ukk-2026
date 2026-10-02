@extends('layouts.app')

@section('title', config('app.name') . ' — Kelola Peminjaman')

@section('content')
@php
    $currentUser = \App\Models\User::current();
@endphp

<div class="container-fluid py-4 px-md-4">

    <!-- Hero Card Banner (Seragam dengan Kelola Kategori) -->
    <div class="card border-0 rounded-4 p-4 p-md-5 mb-4 position-relative overflow-hidden shadow-lg border border-secondary border-opacity-25" 
         style="background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%); color: #ffffff;">

        <div class="row align-items-center position-relative z-1 g-3">
            <div class="col-12 col-md-7 col-lg-8">
                <!-- Badge Admin Panel -->
                <span class="badge bg-primary bg-opacity-20 text-info border border-info border-opacity-30 px-3 py-1.5 rounded-pill uppercase tracking-wider mb-2">
                    Admin Panel
                </span>
                <h2 class="fw-bold text-white mb-1 display-6">Kelola Peminjaman</h2>
                <p class="text-white-50 mb-0">
                    Manajemen daftar peminjaman peralatan sekolah secara terpusat dengan mudah, cepat, dan terorganisir.
                </p>
            </div>

            <!-- Tombol Tambah Peminjaman Baru (Kapsul Modern & Rapat Kanan) -->
            @if($currentUser && $currentUser->role === 'admin')
            <div class="col-12 col-md-5 col-lg-4 text-start text-md-end">
                <a href="{{ route('peminjaman.create') }}" class="btn btn-info text-dark fw-bold rounded-pill px-4 py-2.5 shadow-sm d-inline-flex align-items-center gap-2">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>Tambah Peminjaman Baru</span>
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- Card Wrapper Tabel Data -->
    <div class="card border border-secondary border-opacity-25 shadow-lg rounded-4 overflow-hidden">
        
        <!-- Card Header Subtitle -->
        <div class="card-header bg-transparent border-bottom border-secondary border-opacity-25 py-3 px-4">
            <div class="d-flex align-items-center gap-2">
                <span class="rounded-circle bg-info" style="width: 8px; height: 8px;"></span>
                <h5 class="fw-bold mb-0">Data Peminjaman</h5>
            </div>
            <p class="text-muted small mb-0 mt-1">Daftar peralatan sekolah yang sedang atau telah dipinjam.</p>
        </div>

        <!-- Tabel Data -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr class="text-uppercase fs-8 text-muted border-bottom border-secondary border-opacity-25">
                            <th class="py-3 px-4 text-center" style="width: 5%;">NO</th>
                            <th class="py-3">PEMINJAM</th>
                            <th class="py-3">ALAT</th>
                            <th class="py-3 text-center">TGL PINJAM</th>
                            <th class="py-3 text-center">TGL KEMBALI</th>
                            <th class="py-3 text-center">STATUS</th>
                            <th class="py-3 text-center">DENDA</th>
                            @if($currentUser && $currentUser->role === 'admin')
                                <th class="py-3 text-center" style="width: 15%;">AKSI</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="border-0">
                        @php $no = 1; @endphp
                        @forelse ($datap as $peminjaman)
                        <tr class="border-bottom border-secondary border-opacity-10">
                            <td class="px-4 text-center text-muted fw-medium">{{ $no++ }}</td>
                            
                            <!-- Peminjam -->
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="p-2 rounded-3 bg-info bg-opacity-10 text-info d-inline-flex align-items-center justify-content-center">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                    </div>
                                    <span class="fw-semibold">{{ $peminjaman->user->name ?? $peminjaman->nama_peminjam ?? '-' }}</span>
                                </div>
                            </td>

                            <!-- Alat -->
                            <td>
                                <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-20 px-2.5 py-1.5 font-monospace fw-normal">
                                    {{ $peminjaman->alat->nama_alat ?? '-' }}
                                </span>
                            </td>

                            <!-- Tgl Pinjam -->
                            <td class="text-center text-muted small font-monospace">
                                {{ $peminjaman->tgl_pinjam ?? '-' }}
                            </td>

                            <!-- Tgl Kembali -->
                            <td class="text-center text-muted small font-monospace">
                                {{ $peminjaman->tgl_kembali ?? '-' }}
                            </td>

                            <!-- Status Badge -->
                            <td class="text-center">
                                @php
                                    $status = strtolower($peminjaman->status ?? '');
                                @endphp

                                @if($status === 'dipinjam')
                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-20 px-3 py-1.5 rounded-pill">Dipinjam</span>
                                @elseif($status === 'dikembalikan')
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-20 px-3 py-1.5 rounded-pill">Dikembalikan</span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-20 px-3 py-1.5 rounded-pill">{{ $peminjaman->status ?? '-' }}</span>
                                @endif
                            </td>

                            <!-- Aksi Edit / Hapus (Hanya Admin) -->
                            @if($currentUser && $currentUser->role === 'admin')
                                <td class="text-center">
                                    <div class="d-inline-flex gap-1">
                                        <a href="{{ route('peminjaman.edit', ['peminjaman' => $peminjaman->id_peminjaman]) }}" 
                                           class="btn btn-sm btn-outline-primary border-0 bg-primary bg-opacity-10 text-primary px-3 py-1 rounded-2" 
                                           title="Edit Peminjaman">
                                            Edit
                                        </a>

                                        <form action="{{ route('peminjaman.destroy', ['id' => $peminjaman->id_peminjaman]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-danger border-0 bg-danger bg-opacity-10 text-danger px-3 py-1 rounded-2" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data peminjaman ini?')"
                                                    title="Hapus Peminjaman">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ ($currentUser && $currentUser->role === 'admin') ? '8' : '7' }}" class="text-center py-5 text-muted">
                                <div class="py-3">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="mb-2 text-muted opacity-50">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="9" y1="9" x2="15" y2="15"></line>
                                        <line x1="15" y1="9" x2="9" y2="15"></line>
                                    </svg>
                                    <p class="mb-0">Belum ada data peminjaman yang ditambahkan.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        @if(isset($datap) && method_exists($datap, 'hasPages') && $datap->hasPages())
        <div class="card-footer bg-transparent border-top border-secondary border-opacity-25 py-3 d-flex justify-content-end">
            {!! $datap->links() !!}
        </div>
        @endif
    </div>

</div>
@endsection