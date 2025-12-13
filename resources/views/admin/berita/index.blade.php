@extends('layout.admin')
@section('pageTitle', 'Kelola Berita - Admin')
@section('adminContent')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-thin mb-0">Kelola Berita</h2>
        </div>
        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
            + Tambah Berita
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($berita->count())
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Judul</th>
                        <th style="width: 140px;">Tanggal Publish</th>
                        <th style="width: 180px;">Penulis</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($berita as $index => $item)
                        <tr>
                            <td>{{ $berita->firstItem() + $index }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($item->judul, 60) }}</td>
                            <td>
                                {{ $item->tanggal_publish ? $item->tanggal_publish->format('d M Y') : '-' }}
                            </td>
                            <td>{{ $item->penulis->name ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.berita.edit', $item->id) }}" 
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>
                                <form action="{{ route('admin.berita.destroy', $item->id) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
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
            {{ $berita->links() }}
        </div>
    @else
        <p class="text-muted">Belum ada berita. Silakan tambahkan berita baru.</p>
    @endif
</div>
@endsection