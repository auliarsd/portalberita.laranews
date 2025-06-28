@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-lg-6">
                        <h1>Daftar Berita</h1>
                    </div>
                    <div class="col-lg-6">
                        <a href="/dashboard/berita/create" class="btn sd-color px-4 float-right"><i class="fas fa-fw fa-plus"></i> Tambah Berita</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-top-border-success">
                        <div class="card-body">
                            <table class="table table-bordered" id="mytabel" width="100%">
                                <thead class="sd-color">
                                    <tr class="text-center">
                                        <th scope="col" width='7%'>No.</th>
                                        <th scope="col" width='45%'>Judul Berita</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Penulis</th>
                                        <th>Tgl. Post</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($news as $row)
                                    <tr>
                                        <td class="text-center align-middle"></td>
                                        <td class="font-italic">{{ $row->title }}</td>
                                        <td class="text-capitalize text-center align-middle">{{ $row->category->category_name }}</td>
                                        <td class="text-center align-middle">{{ $row->user->name }}</td>
                                        <td class="text-center align-middle">{{ $row->post_date }}</td>
                                        <td class="text-center align-middle">
                                            @if (auth()->user()->id == $row->user_id)
                                            <a href="{{ url('dashboard/berita/' . $row->id) }}/edit"
                                                class="btn ds-color btn-sm"><i class="far fa-fw fa-edit"></i></a>
                                            @endif
                                            <form action="{{ url('dashboard/berita/' . $row->id) }}"
                                                method="POST" class="d-inline tombol-hapus">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="far fa-trash-alt"></i>
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
