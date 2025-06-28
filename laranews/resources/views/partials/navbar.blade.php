<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="/" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{ asset('img/logo-ldii.png') }}" alt="">
        <h1 class="mt-2">LDII Samarinda</h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="/" id="nav-link">Beranda</a></li>
          <li class="dropdown"><a href="#" id="nav-link"><span>Berita</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul id="berita-dropdown">
              @foreach ($categories as $row)
                <li><a href="/kategori-berita/{{ $row->category_slug }}">{{ $row->category_name }}</a></li>
              @endforeach
              <li><a href="/kategori-berita/lainnya">Lainnya</a></li>
            </ul>
          </li>

          <li><a href="/tentang-kami" id="nav-link">Tentang Kami</a></li>
          <li><a href="/hubungi-kami" id="nav-link">Hubungi Kami</a></li>
        </ul>
      </nav><!-- .navbar -->

      <div class="position-relative" id="medSos">
        <a href=" https://www.instagram.com/ldii.smr?igsh=MXd3NG9uMGdscHpzNA==" class="mx-2"><span class="bi-instagram"></span></a>
        <a href="https://youtube.com/@ldiitvsamarinda5462?si=36eFB92_i_hvN1Qv" class="mx-2"><span class="bi-youtube"></span></a>
        <a href="https://www.tiktok.com/@ldii.smr?_t=8nU763Rc27u&_r=1" class="mx-2"><span class="bi-tiktok"></span></a>

        <a href="#" class="mx-2 js-search-open"><b><i class="fas fa-search"></i></b></a>
        <i class="bi bi-list mobile-nav-toggle"></i>

        <!-- ======= Search Form ======= -->
        <div class="search-form-wrap js-search-form-wrap">
          <form action="/berita/search" class="search-form" id="search-form" method="post">
            @csrf
            <span class="icon bi-search"></span>
            <input type="text" placeholder="Search" class="form-control" name="keyword" autocomplete="off" autofocus>
            <button class="btn js-search-close"><span class="bi-x"></span></button>
          </form>
        </div><!-- End Search Form -->

      </div>

    </div>

  </header><!-- End Header -->

  <script>
    document.getElementById('search-form').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            this.submit();
        }
    });

    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>