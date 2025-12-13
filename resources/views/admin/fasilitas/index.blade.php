@extends('layout.admin')

@section('pageTitle', 'Kelola Fasilitas')

@section('adminContent')

<div class="container mt-4">
    <h3 class="mb-3">Kelola Fasilitas Jurusan</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.fasilitas.create') }}" class="btn btn-primary mb-3">
        + Tambah Fasilitas
    </a>

    <table class="table table-bordered table-striped align-middle">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Fasilitas</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th style="width: 140px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($fasilitas as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_fasilitas ?? '-' }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($item->deskripsi ?? '-', 60) }}</td>
                    <td>
                        @if(!empty($item->gambar))
                            <img src="{{ asset($item->gambar) }}"
                                 alt="{{ $item->nama_fasilitas }}"
                                 style="max-width: 100px;">
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.fasilitas.edit', $item->id) }}"
                           class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('admin.fasilitas.destroy', $item->id) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus fasilitas ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data fasilitas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if(method_exists($fasilitas, 'links'))
        {{ $fasilitas->links() }}
    @endif
</div>
@endsection
