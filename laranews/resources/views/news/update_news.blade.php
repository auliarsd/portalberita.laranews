@extends('layouts.dashboard')

@section('content')
<div class="content-wrapper pb-5">
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
                        <b>Edit Berita</b>
                    </div>
                    <div class="card-body px-4">
                        <form action="/dashboard/berita/{{ $news->id }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="title">Judul Berita</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" autocomplete="off"
                                    value="{{ old('title', $news->title) }}" autofocus>
                                @error('title')
                                    <div class=" invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="hidden" name="slug" value="{{ $news->slug }}">
                            <div class="form-group">
                                <label for="image" class="text-dark font-weight-bold">Foto Berita</label>
                                <input type="file" class="input-file" id="image" name="image" onchange="previewImage()" >
                            </div>
                           
                            <img src="{{ asset('storage/'. $news->image) }}" class="tengah img-preview img-fluid mb-3 tengah" style="max-width: 280px; max-height: 280px;">
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label for="category_id">Kategori Berita</label>
                                    <select class="form-control border border-secondary selectpicker" id="category_id" name="category_id" data-size="4" data-live-search="true" title="Pilih Kategori Berita" required>
                                        @foreach ($categories as $row)
                                        @if ($news->category_id == $row->id)
                                            <option value="{{ $row->id }}" selected>{{ $row->category_name }}</option>
                                        @else
                                            <option value="{{ $row->id }}">{{ $row->category_name }}</option>    
                                        @endif
                                        @endforeach 
                                    </select>
                                </div>
                                <div class="form-group col-md-7">
                                    <label for="caption">Caption Foto</label>
                                    <input type="text" class="form-control @error('caption') is-invalid @enderror"
                                    id="caption" name="caption" autocomplete="off"
                                    value="{{ old('caption', $news->caption) }}" autofocus>
                                    @error('caption')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                        
                            <input id="content" type="hidden" name="content" value="{{ old('content') }}">
                            <trix-editor input="content" class="@error('description') border border-danger @enderror">{!! $news->content !!}</trix-editor>
                            <div class="row mt-3">
                                <div class="col-lg-6"></div>
                                <div class="col-lg-6">
                                    <div class="row mb-3">
                                        <label for="inputPassword" class="col-sm-3 col-form-label">Tgl Posting</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" id="date" name="post_date" value="{{ $news->post_date }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-dark float-right mt-3">Simpan Berita</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
     // Matiin input file di Trix Editor
    $('trix-editor').css("min-height", "200px");
    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    })

      // buat preview Image
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0])

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection