@extends('layout.admin')

@section('title', 'Data Dosen - Admin')

@section('pageTitle', 'Data Dosen')
@section('pageSubtitle', 'Kelola daftar dosen jurusan Sistem Informasi.')
@section('breadcrumb', 'Pages/Data Dosen')

@section('adminContent')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold mb-0">Kelola Dosen</h1>
        <a href="{{ route('admin.dosen.create') }}" class="btn btn-primary">+ Tambah Dosen</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($dosens->count())
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIDN</th>
                        <th>Bidang Keahlian</th>
                        <th>Email</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dosens as $index => $dosen)
                        <tr>
                            <td>{{ $dosens->firstItem() + $index }}</td>
                            <td>{{ $dosen->nama }}</td>
                            <td>{{ $dosen->nidn }}</td>
                            <td>{{ $dosen->bidang_keahlian }}</td>
                            <td>{{ $dosen->email }}</td>
                            <td>
                                <a href="{{ route('admin.dosen.edit', $dosen->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.dosen.destroy', $dosen->id) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus dosen ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $dosens->links() }}
    @else
        <p class="text-muted">Belum ada data dosen.</p>
    @endif
</div>
@endsection
