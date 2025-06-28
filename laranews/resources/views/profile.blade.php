@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-11">
                    <div class="card">
                        <div class="card-header text-light" style="background-color: #0c5c31;">
                            <b>Profil</b>
                        </div>
                        <div class="card-body">
                        <form action="{{ url('/dashboard/profile') }}" method="POST" enctype="multipart/form-data">
                           <div class="row">
                                <div class="col-lg-4">
                                    <img src="{{ ($user->image == null) ? '/img/AdminLTELogo.png' : asset('storage/' . $user->image) }}" class="tengah ml-4 mt-5 border border-dark" alt="User Image" width="100%">
                                   
                                </div>
                                <div class="col-lg-8 px-5">
                                        @csrf
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control bg-secondary" id="username" name="username" value="{{ $user->username }}" readonly>
                                        </div>
                                        <div class="form-group mt-3 ">
                                            <label for="Foto Profil">Foto Profil</label>
                                            <input type="file" class="form-control center px-3" id="image" name="image" onchange="previewImage()" >
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control bg-light @error('password') border border-danger @enderror" id="password" name="password" autocomplete="off">
                                            @error('password')
                                              <small class="text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password2">Konfirmasi Password</label>
                                            <input type="password" class="form-control bg-light @error('password2') border border-danger @enderror" id="password2" name="password2" autocomplete="off">
                                            @error('password2')
                                              <small class="text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <button class="btn ds-color mb-2 float-right" type="submit">Simpan Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
