@extends ('layouts.app')

@section ('content')

<div class="container">
    <h1>Alat</h1>
    <a href="{{ route('alat.create') }}" class="btn btn-primary mb-3 btn-sm">tambah alat</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>nama alat</th>
                <th>kode alat</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            @endphp
            @foreach ($data as $d)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $d->nama_alat }}</td>
                <td> {{ $d->kode_alat }} </td>
                   <td> <a href="{{ route('alat.edit', ['id'=> $d->id_alat]) }}" class="btn btn-success btn-sm">edit</a>
                    <form action="{{ route('alat.destroy', ['id'=>$d->id_alat]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">hapus</button>
                
                </form>
</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection