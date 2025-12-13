@extends('layout.admin')

@section('pageTitle', 'Kelola Mata Kuliah')

@section('adminContent')

    <div class="container mt-4">
        <h3 class="mb-3">Kelola Mata Kuliah</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('admin.mata_kuliah.create') }}" class="btn btn-primary mb-3">
            + Tambah Mata Kuliah
        </a>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode MK</th>
                    <th>Nama Mata Kuliah</th>
                    <th>Semester</th>
                    <th>SKS</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mataKuliah as $mk)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $mk->kode_mk ?? '-' }}</td>
                        <td>{{ $mk->nama_mk ?? '-' }}</td>
                        <td>{{ $mk->semester ?? '-' }}</td>
                        <td>{{ $mk->sks ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.mata_kuliah.edit', $mk->id) }}"
                            class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('admin.mata_kuliah.destroy', $mk->id) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus mata kuliah ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data mata kuliah.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
