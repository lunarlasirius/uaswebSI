@extends('layout.admin')

@section('pageTitle', 'Kelola Mahasiswa')

@section('adminContent')

<div class="container py-4">
    <h1 class="mb-4">Kelola Mahasiswa</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Daftar Mahasiswa</h5>
        <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-primary btn-sm">
            + Tambah Mahasiswa
        </a>
    </div>

    @if ($mahasiswa->count())
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 60px">No</th>
                        <th>NPM</th>
                        <th>Nama</th>
                        <th>Angkatan</th>
                        <th>Dosen Pembimbing</th>
                        <th>No HP</th>
                        <th style="width: 150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswa as $mhs)
                        <tr>
                            <td>{{ $loop->iteration + ($mahasiswa->currentPage() - 1) * $mahasiswa->perPage() }}</td>
                            <td>{{ $mhs->npm }}</td>
                            <td>{{ $mhs->nama }}</td>
                            <td>{{ $mhs->angkatan }}</td>
                            <td>{{ $mhs->dosen_pembimbing }}</td>
                            <td>{{ $mhs->no_hp }}</td>
                            <td>
                                <a href="{{ route('admin.mahasiswa.edit', $mhs->id) }}" class="btn btn-sm btn-warning">
                                    Edit
                                </a>
                                <form action="{{ route('admin.mahasiswa.destroy', $mhs->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus mahasiswa ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $mahasiswa->links() }}
        </div>
    @else
        <p class="text-muted">Belum ada data mahasiswa.</p>
    @endif
</div>
@endsection
