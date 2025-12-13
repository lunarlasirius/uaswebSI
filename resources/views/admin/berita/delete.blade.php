@extends('admin.layout')

@section('title', 'Hapus Berita')

@section('content')

<div class="container mt-4">
    <div class="card shadow-sm border-danger">
        <div class="card-body">

            <h4 class="text-danger">
                Konfirmasi Hapus Berita
            </h4>

            <p class="text-muted">
                Apakah Anda yakin ingin menghapus berita berikut?
            </p>

            <div class="mt-3">
                <h5>{{ $berita->judul }}</h5>
                <p><strong>Tanggal Publish:</strong> {{ $berita->tanggal_publish }}</p>

                @if ($berita->gambar)
                    <img src="{{ asset($berita->gambar) }}" 
                         class="img-fluid rounded mb-3"
                         style="max-width: 300px;">
                @endif

                <p class="text-muted">
                    {{ Str::limit(strip_tags($berita->isi), 150, '...') }}
                </p>
            </div>

            <div class="mt-4">
                <form action="{{ route('admin.berita.destroy', $berita->id) }}"
                      method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" 
                            class="btn btn-danger">
                        Ya, Hapus Sekarang
                    </button>

                    <a href="{{ route('admin.berita.index') }}" 
                       class="btn btn-secondary">
                        Batal
                    </a>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
