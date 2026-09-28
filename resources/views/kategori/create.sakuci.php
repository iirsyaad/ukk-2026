@extends('layouts.app')

@section('title', config('app.name') . ' -- Tambah Kategori')

@section('content')
<div class="container-fluid py-4">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="mb-4">
                <h2 class="fw-bold mb-1">Tambah Kategori Alat</h2>
                <p class="text-muted small mb-0">
                    Tambahkan kategori alat baru ke dalam sistem.
                </p>
            </div>

            <div class="card border shadow-sm rounded-4">
                <div class="card-body p-4">

                    <form action="{{ route('kategori.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label fw-semibold">
                                Nama Kategori
                            </label>

                            <input
                                type="text"
                                name="nama_kategori"
                                id="nama_kategori"
                                class="form-control"
                                value="{{ old('nama_kategori') }}"
                                placeholder="Contoh: Peralatan Listrik"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="kode_kategori" class="form-label fw-semibold">
                                Kode Kategori
                            </label>

                            <input
                                type="text"
                                name="kode_kategori"
                                id="kode_kategori"
                                class="form-control"
                                value="{{ old('kode_kategori') }}"
                                placeholder="Contoh: KAT-01"
                                required
                            >
                        </div>

                        <div class="mb-4">
                            <label for="keterangan" class="form-label fw-semibold">
                                Keterangan
                            </label>

                            <textarea
                                name="keterangan"
                                id="keterangan"
                                class="form-control"
                                rows="4"
                                placeholder="Isi keterangan kategori"
                                required
                            >{{ old('keterangan') }}</textarea>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a
                                href="{{ route('kategori.index') }}"
                                class="btn btn-outline-secondary px-4"
                            >
                                Kembali
                            </a>

                            <button
                                type="submit"
                                class="btn btn-primary px-4 shadow-sm"
                            >
                                Simpan Kategori
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
