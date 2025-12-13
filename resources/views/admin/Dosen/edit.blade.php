@extends('layout.app')

@section('title', 'Edit Dosen')

@section('content')
<div class="container">
    <h1 class="fw-bold mb-4">Edit Dosen</h1>

    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.dosen.update', $dosen->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $dosen->nama) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">NIDN</label>
                    <input type="text" name="nidn" class="form-control" value="{{ old('nidn', $dosen->nidn) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Bidang Keahlian</label>
                    <input type="text" name="bidang_keahlian" class="form-control" value="{{ old('bidang_keahlian', $dosen->bidang_keahlian) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $dosen->email) }}">
                </div>

                @if ($dosen->foto)
                    <div class="mb-3">
                        <label class="form-label d-block">Foto Saat Ini</label>
                        <img src="{{ asset($dosen->foto) }}" alt="{{ $dosen->nama }}" class="img-fluid" style="max-height: 150px;">
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label">Ganti Foto (opsional)</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.dosen.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
