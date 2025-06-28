@extends('layouts.main')

@section('content')

<section>
    <div class="container pb-5">
      <div class="row pb-5">

        <div class="col-md-9" data-aos="fade-up">
          @if ($news->isEmpty())
            <div class="alert alert-danger batal" role="alert">
              <b>Berita Tidak Ditemukan</b>
            </div>
          @else
            @if ($category != 'search')
            <h3 class="category-title">Kategori Berita: {{ $category }}</h3>
            @endif

            @foreach ($news as $item)
              <div class="d-md-flex post-entry-2 half">
                <a href="{{ url('detail/'.$item->slug) }}" class="me-4 thumbnail">
                  <img src="{{ asset('storage/' . $item->image) }}" alt="" class="img-fluid">
                </a>
                <div>
                  <div class="post-meta"><span class="date">{{ $item->category->category_name }}</span> <span class="mx-1">&bullet;</span> <span>{{ $item->post_date }}</span></div>
                  <h3><a href="{{ url('detail/'.$item->slug) }}" id="judul">{{ $item->title }}</a></h3>
                  <p>{{ strip_tags(Str::limit($item->content, 150)) }} <br> <a href="{{ url('detail/'.$item->slug) }}" class="btn btn-sm btn-light px-1 border border-dark mt-3" id="readMore"> Read More</a> </p>
                  <div class="d-flex align-items-center author">
                    <div class="photo"><img src="{{ ($item->user->image == null) ? '/img/AdminLTELogo.png' : asset('storage/' . $item->user->image) }}" alt="" class="img-fluid"></div>
                    <div class="name">
                      <h3 class="m-0 p-0">{{  $item->user->name }}</h3>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach

            {{ $news->links('partials.pagination') }}
          @endif
        </div>

        <div class="col-md-3">
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
@endsection
