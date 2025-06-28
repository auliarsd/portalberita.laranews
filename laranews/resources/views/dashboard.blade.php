@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-lg-6">
                        <h1>Dashboard</h1>
                    </div>
                    <div class="col-lg-6">
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12 col-sm-6 col-md-4">
                  <div class="info-box">
                    <span class="info-box-icon ds-color elevation-1"><i class="fas fa-fw fa-th-list"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Kategori Berita</span>
                      <span class="info-box-number">
                        @if ($category < 10)
                            0{{ $category }}
                        @else
                            {{ $category }}
                        @endif
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                  <div class="info-box mb-3">
                    <span class="info-box-icon ds-color elevation-1"><i class="far fa-fw fa-newspaper"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Berita</span>
                      <span class="info-box-number">
                        @if ($news < 10)
                            0{{ $news }}
                        @else
                            {{ $news }}
                        @endif
                      </span>
                    </div>
                  </div>
                </div>
                <div class="clearfix hidden-md-up"></div>
                @if (auth()->user()->role == 1)
                <div class="col-12 col-sm-6 col-md-4">
                  <div class="info-box mb-3">
                    <span class="info-box-icon ds-color elevation-1"><i class="fas fas fa-fw fa-user-edit"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Penulis</span>
                      <span class="info-box-number">
                        @if ($user < 10)
                            0{{ $user }}
                        @else
                            {{ $user }}
                        @endif
                      </span>
                    </div>
                  </div>
                </div>
                @endif
              </div>
            </div>
          </section>
    </div>

@endsection
