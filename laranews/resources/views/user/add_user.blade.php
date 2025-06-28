@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-lg-6">
                        {{-- <h1>Daftar Penulis Berita</h1> --}}
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header text-light" style="background-color: #0c5c31;">
                            <b>Tambah Penulis Berita</b>
                        </div>
                        <div class="card-body">
                           <form action="/dashboard/penulis" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control text-lowercase @error('username') is-invalid @enderror"
                                        id="username" name="username" autocomplete="off"
                                        value="{{ old('username') }}" autofocus>
                                    @error('username')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" autocomplete="off"
                                        value="{{ old('name') }}" autofocus>
                                    @error('name')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" autocomplete="off"
                                        value="{{ old('password') }}" autofocus>
                                    @error('password')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                    @enderror
                            </div>
                            <button class="btn ds-color float-right" type="submit">Simpan Penulis</button>
                           </form>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>

@endsection
