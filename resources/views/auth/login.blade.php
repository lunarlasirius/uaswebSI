@extends('layout.app')

@section('title', 'Login - Jurusan Sistem Informasi')

@push('styles')
<style>
    .login-page{
        --blue: #0d6efd;
        --blue-600: #0b5ed7;
        --ink: #0f172a;
        --muted: #6c757d;
        --line: rgba(15,23,42,.10);

        padding: 3rem 0;
        min-height: calc(100vh - 140px); 
        display: flex;
        align-items: center;
    }

    .login-page::before{
        content:"";
        position: fixed;
        inset: 0;
        z-index: -1;
        background:
            radial-gradient(800px 400px at 20% 10%, rgba(13,110,253,.12), transparent 60%),
            radial-gradient(700px 380px at 80% 15%, rgba(13,110,253,.10), transparent 60%),
            linear-gradient(180deg, rgba(248,250,252,1), rgba(255,255,255,1));
    }

    .login-page .card{
        border: 1px solid var(--line);
        border-radius: 1.25rem;
        overflow: hidden;
        box-shadow: 0 1rem 2.5rem rgba(15,23,42,.12);
        background: #fff;
    }

    .login-page .card-body{
        position: relative;
    }

    .login-page .card-body::before{
        content:"";
        position:absolute;
        top:0; left:0; right:0;
        height: 10px;
        background: linear-gradient(90deg, rgba(13,110,253,1), rgba(0,180,255,1));
    }

    .login-page h4{
        font-weight: 900;
        letter-spacing: -.02em;
        color: var(--ink);
        margin-top: .75rem;
    }

    .login-page .text-muted{
        color: var(--muted) !important;
        font-size: .95rem;
    }

    .login-page .form-label{
        font-weight: 700;
        color: rgba(15,23,42,.85);
        margin-bottom: .35rem;
    }

    .login-page .form-control{
        border-radius: .9rem;
        border: 1px solid rgba(15,23,42,.12);
        padding: .65rem .85rem;
        transition: box-shadow .2s ease, border-color .2s ease, transform .2s ease;
        background: rgba(248,250,252,.75);
    }

    .login-page .form-control:focus{
        border-color: rgba(13,110,253,.55);
        box-shadow: 0 0 0 .25rem rgba(13,110,253,.15);
        background: #fff;
    }

    .login-page .btn.btn-primary{
        border-radius: .95rem;
        padding: .65rem 1rem;
        font-weight: 800;
        letter-spacing: .01em;
        background: linear-gradient(180deg, rgba(13,110,253,1), rgba(11,94,215,1));
        border: none;
        box-shadow: 0 .8rem 1.6rem rgba(13,110,253,.25);
        transition: transform .15s ease, box-shadow .15s ease, filter .15s ease;
    }

    .login-page .btn.btn-primary:hover{
        transform: translateY(-1px);
        box-shadow: 0 1.1rem 2.2rem rgba(13,110,253,.28);
        filter: brightness(1.02);
    }

    .login-page .btn.btn-primary:active{
        transform: translateY(0);
        box-shadow: 0 .6rem 1.2rem rgba(13,110,253,.22);
    }

    .login-page .alert{
        border-radius: .9rem;
        border: 1px solid rgba(220,53,69,.25);
        box-shadow: 0 .5rem 1.1rem rgba(220,53,69,.08);
    }
    .login-page .alert ul{
        padding-left: 1.1rem;
        margin-bottom: 0;
    }

    .login-page .form-control.is-invalid:focus{
        box-shadow: 0 0 0 .25rem rgba(220,53,69,.15);
    }

    @media (max-width: 575.98px){
        .login-page{
            padding: 2rem 0;
        }
        .login-page .card-body{
            padding: 1.25rem !important;
        }
    }
</style>
@endpush

@section('content')
<div class="container login-page">
    <div class="row justify-content-center w-100">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h4 class="mb-3 text-center">Login</h4>
                    <p class="text-muted text-center mb-4">
                        Masuk sebagai Admin, Mahasiswa, atau Dosen.
                    </p>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('login.process') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text"
                                   name="username"
                                   id="username"
                                   class="form-control @error('username') is-invalid @enderror"
                                   value="{{ old('username') }}"
                                   required
                                   autofocus>
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password"
                                   name="password"
                                   id="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   required>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Login
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
