@extends('layouts.main')

@section('content')
<section id="hero-slider" class="hero-slider">
    <div class="container-md" data-aos="fade-in">
      <div class="row">
        <div class="col-12">
          <div class="swiper sliderFeaturedPosts">
            <div class="swiper-wrapper">
              @foreach ($threelatest as $item)
              <div class="swiper-slide">
                <a href="{{ url('detail/'.$item->slug) }}" class="img-bg d-flex align-items-end" style="background-image: url('{{ asset('storage/' . $item->image)  }}');">
                  <div class="img-bg-inner">
                    <h2>{{ $item->title }}</h2>
                    <p>{{ strip_tags(Str::limit($item->content, 250)) }}</p>
                  </div>
                </a>
              </div>
              @endforeach
            </div>
            <div class="custom-swiper-button-next">
              <span class="bi-chevron-right"></span>
            </div>
            <div class="custom-swiper-button-prev">
              <span class="bi-chevron-left"></span>
            </div>

            <div class="swiper-pagination"></div>
          </div>
        </div>
      </div>
    </div>
</section>

 
<section id="posts" class="posts">
<div class="container" data-aos="fade-up">
    <div class="row g-5">
    <div class="col-lg-8">
        <div class="post-entry-1 lg">
        <a href="{{ url('detail/'.$latestnews->slug) }}"><img src="{{ asset('storage/' . $latestnews->image) }}" alt="" class="img-fluid"></a>
        <div class="post-meta"><span class="date">{{ $latestnews->category->category_name }}</span> <span class="mx-1">&bullet;</span> <span>{{ $latestnews->post_date }}</span></div>
        <h2><a href="{{ url('detail/'.$latestnews->slug) }}" id="judul">{{ $latestnews->title }}</a></h2>
        <p class="mb-4 d-block">{{ strip_tags(Str::limit($latestnews->content, 250)) }} <br> <br> <a href="{{ url('detail/'.$latestnews->slug) }}" class="btn btn-sm btn-light px-1 border border-dark" id="readMore"> Read More</a> </p>

        <div class="d-flex align-items-center author">
            <div class="photo"><img src="{{ ($item->user->image == null) ? '/img/AdminLTELogo.png' : asset('storage/' . $item->user->image) }}" alt="" class="img-fluid border border-dark"></div>
            <div class="name">
            <h3 class="m-0 p-0">{{ $latestnews->user->name }}</h3>
            </div>
        </div>
        </div>

    </div>

    <div class="col-lg-4">
        <div class="row g-5">
        <div class="col-lg-12 border-start custom-border">
            @foreach ($three as $item)
              <div class="post-entry-1">
                <a href="{{ url('detail/'.$item->slug) }}"><img src="{{ asset('storage/' . $item->image) }}" alt="" class="img-fluid"></a>
                    <div class="post-meta"><span class="date">{{ $item->category->category_name }}</span> <span class="mx-1">&bullet;</span> <span>{{ $item->post_date }}</span>
                    </div>
                    <h2><a href="{{ url('detail/'.$item->slug) }}" id="judul">{{ $item->title }}</a></h2>
              </div>
            @endforeach
        </div>             
        </div>
    </div>
    </div>
</div>
</section>

<section class="category-section">
<div class="container" data-aos="fade-up">

    <div class="section-header d-flex justify-content-between align-items-center mb-5">
    <h2>{{ $category->category_name }}</h2>
    <div><a href="/kategori-berita/{{ $category->category_slug }}" class="more" id="judul">View All</a></div>
    </div>

    <div class="row">
    @if ($catNewsLatest != null)
    <div class="col-md-8">
        <div class="row">
        <div class="col-lg-12">
            <div class="post-entry-1">
            <a href="{{ url('detail/'.$catNewsLatest->slug) }}"><img src="{{ asset('storage/' . $catNewsLatest->image) }}" alt="" class="img-fluid"></a>
            <div class="post-meta"><span class="date">{{ $catNewsLatest->category->category_name }}</span> <span class="mx-1">&bullet;</span> <span>{{ $catNewsLatest->post_date }}</span></div>
            <h2 class="mb-2"><a href="{{ url('detail/'.$catNewsLatest->slug) }}" id="judul">{{ $catNewsLatest->title }}</a></h2>
            <p class="mb-4 d-block">{{ strip_tags(Str::limit($catNewsLatest->content, 250)) }} <br><br> <a href="{{ url('detail/'.$catNewsLatest->slug) }}" class="btn btn-sm btn-light px-1 border border-dark" id="readMore"> Read More</a></p>
            </div>
            <div class="d-flex align-items-center author">
              <div class="photo"><img src="{{ ($catNewsLatest->user->image == null) ? '/img/AdminLTELogo.png' : asset('storage/' . $catNewsLatest->user->image) }}" alt="" class="img-fluid border border-dark"></div>
              <div class="name">
              <h3 class="m-0 p-0">{{ $catNewsLatest->user->name }}</h3>
              </div>
          </div>
        </div>
        </div>
    </div>
    @endif

    <div class="col-md-4">
        @if ($threCatNewsLatest != null)
          @foreach ($threCatNewsLatest as $item)
              <div class="post-entry-1 border-bottom">
              <div class="post-meta"><span class="date">{{ $item->category->category_name }}</span> <span class="mx-1">&bullet;</span> <span>{{ $item->post_date }}</span></div>
              <h2 class="mb-2"><a href="{{ url('detail/'.$item->slug) }}" id="judul">{{ $item->title }}</a></h2>
              <span class="author mb-3 d-block">{{ $item->user->name }}</span>
              </div>
          @endforeach
        @endif
    </div>
    </div>
</div>
</section>
@endsection