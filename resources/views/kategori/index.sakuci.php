@extends ('layouts.app')

@section ('content')

<div class="container">
    <h1>data kategori</h1>
    <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3 btn-sm">tambah kategori</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>nama kategori</th>
                <th>kode kategori</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            @endphp
            @foreach ($data as $d)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $d->nama_kategori }}</td>
                <td> {{ $d->kode_kategori }} </td>
                <td>{{ $d->keterangan }}</td>
                <td>
                    <a href="" class="btn btn-success btn-sm">edit</a>
                    <a href="" class="btn btn-success btn-sm">hapus</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection