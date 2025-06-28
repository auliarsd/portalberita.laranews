@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-lg-6">
                        <h1>Kategori Berita</h1>
                    </div>
                    <div class="col-lg-6">
                        <button type="button" class="btn sd-color float-right" data-toggle="modal" data-target="#tambahKategori">
                            Tambah Kategori
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-10">
                    <div class="card card-top-border-success">
                        <div class="card-body">
                            <table class="table table-bordered" id="mytabel" width="100%">
                                <thead class="sd-color">
                                    <tr class="text-center">
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama Kategori</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr class="text-center">
                                            <td></td>
                                            <td class="text-capitalize">{{ $category->category_name }}</td>
                                            <td>
                                                <a href="#" data-id="{{ $category->id }}" data-name="{{ $category->category_name }}" data-toggle="modal" data-target="#updateKategori" class="btn btn-sm ds-color text-light modal_update"><i class="far fa-fw fa-edit"></i></a>
                                                    
                                                <form action="{{ url('dashboard/kategori/' . $category->id) }}"
                                                    method="POST" class="d-inline tombol-hapus">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="far fa-trash-alt"></i>
                                                </form>
                                                </button>
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

    <div class="modal fade mt-5" id="updateKategori" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Kategori Berita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" id="formUpdate">
                    @method('PATCH')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category_name">Nama Kategori</label>
                            <input type="text" class="form-control" id="update_name" name="category_name" autocomplete="off" required autofocus>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark">Simpan Kategori</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahKategori" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Tambah Kategori Berita</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="/dashboard/kategori" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="category_name">Nama Kategori</label>
                        <input type="text" class="form-control" id="category_name" name="category_name" autocomplete="off" required autofocus>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark">Simpan Kategori</button>
                </div>
            </form>
          </div>
        </div>
      </div>


    <script>

    $(document).on("click", ".modal_update", function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        $("#formUpdate").attr('action', '/dashboard/kategori/'+id);
        $(".modal-body #update_name").val(name);
    });
    </script>
@endsection
