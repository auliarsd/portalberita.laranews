@extends('layouts.main')

@section('content')
<section id="contact" class="contact mb-5">
    <div class="container" data-aos="fade-up">

      <div class="row">
        <div class="col-lg-12 text-center">
          <h1 class="page-title">HUBUNGI KAMI</h1>
        </div>
      </div>

      <div class="row gy-4">
        <img src="{{ 'img/logo-ldii.png' }}" alt="" class="d-block mx-auto mt-n5" style="max-width: 500px !important">
        
      </div>
      <div class="row">
        <p class="text-capitalize text-center mt-n5" style="font-size: 18px !important;"><b>Dewan Pimpinan Daerah</b></p>
        <p class="text-capitalize text-center mt-n5" style="font-size: 18px !important;"><b>Lembaga Dakwah Islam Indonesia</b></p>
        <p class="text-capitalize text-center mt-n5" style="font-size: 18px !important;"><b>Kota Samarinda</b></p>
      </div>

      <div class="row d-flex justify-content-center">
        <div class="col-lg-9">
          <div class="map container mb-5 d-block mx-auto map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!3m2!1sid!2sid!4v1719393913516!5m2!1sid!2sid!6m8!1m7!1sy9YDSDLrJ2WZ0LYx8Ezsww!2m2!1d-0.4653621910954418!2d117.1858976860982!3f252.97286443179115!4f6.067710831293823!5f2.299968626952992" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="map-inside text-center">
                <i class="icon_pin"></i>
                <div class="inside-widget mt-3">
                  
                </div>
          </div>
        </div>
      </div>
      <div class="row text-center">
        <h6>Jl. Bugis Mugirejo, RT.02/RW.03, Mugirejo, Kec. Sungai Pinang, Kota Samarinda, Kalimantan Timur 75243
        </h6>
        <p>Notelp: +62 856-5146-1064 (Aqib Ibnu Wicaksono) | +62 812-5436-0560 ( H. Sumardi)</p>
      </div>

      <div class="row">
        <div class="col-lg-8">
                
      <div class="comments">
        <h5 class="comment-title py-4">{{ $count }} Komentar</h5>
        @foreach ($comment as $item)
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
        </div>
      </div>
      
      <div class="form mt-5 bg-l">
        <div class="row mb-4">
          <div class="col-lg-10">
            <h5 class="comment-title mt-2 d-inline" id="judulComment">Tinggalkan Komentar</h5>
            <button class="badge badge-danger rounded-pill border border-danger mt-2 pull-right px-3" id="batal" onclick="batal()">Batal</button>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-8">
            <form action="/komentar/kontak/0" method="post" class="php-email-form bg-light">
              @csrf
              <div class="row">
                <input type="hidden" name="reply_id" id="reply_id" value="0">
                <div class="form-group col-md-6">
                  <input type="text" name="cm_name" class="form-control" id="cm_name" placeholder="Nama Lengkap" required autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                  <input type="email" class="form-control" name="cm_email" id="cm_email" placeholder="Email Anda" required autocomplete="off">
                </div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="cm_message" rows="5" placeholder="Komentar" required autocomplete="off"></textarea>
              </div>
              <div class="text-center"><button type="submit" class="tombol">Kirim Komentar</button></div>
            </form>
          </div>
        </div>
      </div><!-- End Contact Form -->
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