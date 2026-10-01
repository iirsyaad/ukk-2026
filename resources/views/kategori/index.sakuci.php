@extends('layouts.app')

@section('title', config('app.name') . ' -- Daftar Kategori')

@section('content')

<div class="container-fluid py-4">
<!-- Header Halaman & Tombol Tambah -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Daftar Kategori</h2>
        <p class="text-muted small mb-0">
            Kelola data kategori alat peminjaman dengan mudah.
        </p>
    </div>

    <a href="{{ route('kategori.create') }}" class="btn btn-primary shadow-sm">
        <i class="bi bi-plus-lg me-1"></i> Tambah Kategori Baru
    </a>
</div>

<!-- Card Pembungkus Tabel -->
<div class="card border shadow-sm rounded-4 overflow-hidden">
    <div class="card-body p-0">

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">

                <thead class="table-secondary text-uppercase fs-7">
                    <tr>
                        <th class="py-3 px-4" style="width: 5%;">No</th>
                        <th class="py-3">Nama Kategori</th>
                        <th class="py-3">Kode Kategori</th>
                        <th class="py-3">Keterangan</th>
                        <th class="py-3 text-center" style="width: 15%;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $no = ($data->currentPage() - 1) * $data->perPage() + 1;
                    @endphp

                    @forelse ($data as $kategori)
                    <tr>

                        <!-- No -->
                        <td class="px-4 text-muted fw-semibold">
                            {{ $no++ }}
                        </td>

                        <!-- Nama Kategori -->
                        <td>
                            <span class="fw-bold">
                                {{ $kategori->nama_kategori }}
                            </span>
                        </td>

                        <!-- Kode Kategori -->
                        <td>
                            <span class="badge bg-secondary bg-opacity-20 border px-2 py-1 font-monospace">
                                {{ $kategori->kode_kategori }}
                            </span>
                        </td>

                        <!-- Keterangan -->
                        <td>
                            <span class="text-muted">
                                {{ $kategori->keterangan ?? '-' }}
                            </span>
                        </td>

                        <!-- Aksi -->
                        <td class="text-center">
                            <div class="btn-group" role="group">

                                <a href="{{ route('kategori.edit', ['id' => $kategori->id_kategori]) }}"
                                   class="btn btn-outline-warning btn-sm px-3">
                                    Edit
                                </a>

                                <form action="{{ route('kategori.destroy', ['id' => $kategori->id_kategori]) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-outline-danger btn-sm px-3 rounded-end"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                        Hapus
                                    </button>

                                </form>

                            </div>
                        </td>

                    </tr>

                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="text-muted">
                                <i class="bi bi-folder-x fs-1 d-block mb-2"></i>
                                <span>Belum ada data kategori.</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($data->hasPages())
    <div class="card-footer py-3 border-top d-flex justify-content-end">
        {!! $data->links() !!}
    </div>
    @endif

</div>

</div> @endsection