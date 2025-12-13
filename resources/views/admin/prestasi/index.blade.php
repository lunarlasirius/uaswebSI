@extends('layout.admin')

@section('pageTitle', 'Kelola Prestasi')

@section('adminContent')
<div class="container mt-4">
    <h3 class="mb-3">Kelola Prestasi Mahasiswa/Dosen</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.prestasi.create') }}" class="btn btn-primary mb-3">
        + Tambah Prestasi
    </a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width:70px;">No</th>
                    <th>Nama Prestasi</th>
                    <th style="width:120px;">Foto</th>
                    <th style="width:140px;">Tingkat</th>
                    <th style="width:100px;">Tahun</th>
                    <th>Keterangan</th>
                    <th style="width: 160px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($prestasi as $item)
                    @php
                        $nama = $item->judul ?? $item->nama_prestasi ?? '-';
                        $foto = $item->foto ?? null;

                        if ($foto && !\Illuminate\Support\Str::startsWith($foto, ['http://', 'https://', 'storage/'])) {
                            $foto = 'storage/' . ltrim($foto, '/');
                        }
                    @endphp

                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td class="fw-semibold">
                            {{ $nama }}
                        </td>

                        <td>
                            @if ($foto)
                                <img src="{{ asset($foto) }}"
                                     alt="Foto Prestasi"
                                     class="img-thumbnail"
                                     style="height:55px; width:90px; object-fit:cover;">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        <td>{{ $item->tingkat ?? '-' }}</td>

                        <td class="text-center">{{ $item->tahun ?? '-' }}</td>

                        <td>{{ \Illuminate\Support\Str::limit($item->keterangan ?? '-', 60) }}</td>

                        <td>
                            <a href="{{ route('admin.prestasi.edit', $item->id) }}"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('admin.prestasi.destroy', $item->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus prestasi ini?');">
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
                        <td colspan="7" class="text-center text-muted">Belum ada data prestasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if (method_exists($prestasi, 'links'))
        {{ $prestasi->links() }}
    @endif
</div>
@endsection
