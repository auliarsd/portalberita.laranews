@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-lg-6">
                        <h1>Daftar Penulis Berita</h1>
                    </div>
                    <div class="col-lg-6">
                        <a href="/dashboard/penulis/create" class="btn sd-color px-4 float-right"><i class="fas fa-fw fa-plus"></i> Tambah Penulis</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-11">
                    <div class="card card-top-border-success">
                        <div class="card-body">
                            <table class="table table-bordered" id="mytabel" width="100%">
                                <thead class="ds-color">
                                    <tr class="text-center">
                                        <th scope="col">No.</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Nama Penulis</th>
                                        <th scope="col">Tgl. Buat</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr class="text-center">
                                            <td></td>
                                            <td class="text-capitalize">{{ $user->username }}</td>
                                            <td class="text-capitalize">{{ $user->name }}</td>
                                            <td>{{ $user->created_at->toDateString() }}</td>
                                            <td>
                                                <form action="{{ url('dashboard/penulis/' . $user->id) }}" method="POST" class="d-inline tombol-hapus">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="far fa-fw fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>

@endsection
