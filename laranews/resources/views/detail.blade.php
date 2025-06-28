@extends('layouts.main')

@section('content')
<section class="single-post-content">
    <div class="container">
      <div class="row">
        <div class="col-md-9 post-content" data-aos="fade-up">
          <div class="single-post">
            <div class="post-meta"><span class="date">{{ $news->category->category_name }}</span> <span class="mx-1">&bullet;</span> <span>{{ $news->post_date }}</span></div>
            <h1 class="mb-5">{{ $news->title }}</h1>
            <figure class="my-4">
                <img src="{{ asset('storage/' . $news->image) }}" alt="" class="d-block mx-auto img-fluid" id="detail-image">
                <figcaption class="text-center"><small class="text-secondary font-italic">{{ $news->caption }}</small> </figcaption>
            </figure>
                {!! $news->content !!}
          </div>

          <div class="comments">
            <h5 class="comment-title py-4">{{ $count }} Komentar</h5>
            @foreach ($comments as $item)
            <div class="comment d-flex mb-4 bg-light py-4 px-2">
              <div class="flex-shrink-0">
                <div class="avatar avatar-sm rounded-circle">
                  <img class="avatar-img" src="{{ asset('/img/AdminLTELogo.png') }}" alt="" class="img-fluid">
                </div>
              </div>
              <div class="flex-grow-1 ms-2 ms-sm-3">
                <div class="comment-meta d-flex align-items-baseline">
                  <h6 class="me-2">{{ $item->cm_name }}</h6>
                  <button class="badge badge-light border border-dark text-dark px-3 rounded-pill mt-2 float-right tombol" onclick="reply({{ $item->id }}, '{{ $item->cm_name }}')">Balas</button>
                </div>
                <div class="comment-body">
                 {{ $item->cm_message }}
                </div>
                <div class="comment-replies bg-light p-3 mt-3 rounded">
                  @foreach ($item->replies as $reply)
                    <div class="reply d-flex mb-4">
                        <div class="flex-shrink-0">
                          <div class="avatar avatar-sm rounded-circle">
                            <img class="avatar-img" src="{{ asset('/img/AdminLTELogo.png') }}" alt="" class="img-fluid">
                          </div>
                        </div>
                        <div class="flex-grow-1 ms-2 ms-sm-3">
                          <div class="reply-meta d-flex align-items-baseline">
                            <h6 class="mb-0 me-2">{{ $reply->cm_name }}</h6>
                          </div>
                          <div class="reply-body">
                          {{ $reply->cm_message }}
                          </div>
                        </div>
                    </div>
                    @endforeach
                </div>
              </div>
            </div>
            @endforeach
          </div>

          <div class="row justify-content-center mt-5">
            <div class="col-lg-12">
              <div class="row mb-2">
                <div class="col-lg-10">
                  <h5 class="comment-title mt-2 d-inline" id="judulComment">Tinggalkan Komentar</h5>
                  <button class="badge badge-danger rounded-pill border border-danger mt-2 pull-right px-3" id="batal" onclick="batal()">Batal</button>
                </div>
              </div>
              
              <form action="/komentar/berita/{{ $news->id }}" method="POST">
              <div class="row">
                  @csrf
                  <input type="hidden" name="reply_id" id="reply_id" value="0">
                  <div class="col-lg-6 mb-3">
                    <label for="cm_name">Nama</label>
                    <input type="text" class="form-control" id="cm_name" name="cm_name"  placeholder="Nama Lengkap" required autocomplete="off">
                  </div>
                  <div class="col-lg-6 mb-3">
                    <label for="cm_email">Email</label>
                    <input type="email" class="form-control" id="cm_email" name="cm_email" placeholder="Email" autocomplete="off" required>
                  </div>
                  <div class="col-12 mb-3">
                    <label for="cm_message">Pesan Komentar</label>
  
                    <textarea class="form-control" id="cm_message" placeholder="Komentar..." name="cm_message" cols="30" rows="5" required autocomplete="off"></textarea>
                  </div>
                  <div class="col-12">
                    <button class="btn btn-primary tombol" type="submit">Kirim Komentar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

        </div>
        <div class="col-md-3">
          <div class="aside-block">

            <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-popular-tab" data-bs-toggle="pill" data-bs-target="#pills-popular" type="button" role="tab" aria-controls="pills-popular" aria-selected="true">Trending</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-latest-tab" data-bs-toggle="pill" data-bs-target="#pills-latest" type="button" role="tab" aria-controls="pills-latest" aria-selected="false">Terbaru</button>
              </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-popular" role="tabpanel" aria-labelledby="pills-popular-tab">
               @foreach ($trending as $item)
                <div class="post-entry-1 border-bottom">
                    <div class="post-meta"><span class="date">{{ $item->category->category_name }}</span> <span class="mx-1">&bullet;</span> <span>{{ $item->post_date }}</span></div>
                    <h2 class="mb-2"><a href="{{ url('detail/'. $item->slug) }}" id="judul">{{ $item->title }}</a></h2>
                    <span class="author mb-3 d-block">{{ $item->user->name }}</span>
                </div>
               @endforeach

              </div>


              <div class="tab-pane fade" id="pills-latest" role="tabpanel" aria-labelledby="pills-latest-tab">
                @foreach ($latest as $item)
                <div class="post-entry-1 border-bottom">
                    <div class="post-meta"><span class="date">{{ $item->category->category_name }}</span> <span class="mx-1">&bullet;</span> <span>{{ $item->post_date }}</span></div>
                    <h2 class="mb-2"><a href="{{ url('detail/'. $item->slug) }}" id="judul">{{ $item->title }}</a></h2>
                    <span class="author mb-3 d-block">{{ $item->user->name }}</span>
                </div>
               @endforeach
              </div>

            </div>
          </div>

          <div class="aside-block" id="category">
            <h3 class="aside-title">Kategori Berita</h3>
            <ul class="aside-links list-unstyled">
                @foreach ($listcat as $row)
                  <li><a href="/kategori-berita/{{ $row->category_slug }}"><i class="bi bi-chevron-right"></i> {{ $row->category_name }}</a></li>
                @endforeach
            </ul>
          </div>

        </div>
      </div>
    </div>
  </section>

  <script>
      $(document).ready(function() {
            $('#batal').hide(); // Hide the button on page load
      });
      function reply(id, name){
        var text = 'Balas Komentar ' + name;
        $("#reply_id").val(id);
        $("#judulComment").text(text);
        $('#batal').show();
      }

      function batal(){
        var text = 'Tinggalkan Komentar';
        $("#reply_id").val(0);
        $("#judulComment").text(text);
        $('#batal').hide();
      }
  </script>
@endsection