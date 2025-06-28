
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('/img/android-chrome-512x512.png') }}" rel="icon">
    <title>{{ $title }} | Dashboard LDII SAMARINDA</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-select/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/trix.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/mycss.css') }}">
    <script src="{{ asset('/js/trix.js') }}"></script>
    <script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('partials.dashboard_navbar')
        @include('partials.dashboard_sidebar')

        @yield('content')
        
        <footer class="main-footer">
            <strong>Copyright &copy; {{ date('Y') }} LDII SAMARINDA </strong> All rights
            reserved.
        </footer>

        <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah anda yakin untuk keluar dari aplikasi?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="/keluar" method="POST">
                        @csrf
                        <button class="btn btn-danger" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('/js/select/defaults-id_ID.js') }}"></script>
    <script src="{{ asset('/js/bootstrap-filestyle/bootstrap-filestyle.min.js') }}"> </script>
    <script src="{{ asset('/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('/js/myjs.js') }}"></script>

    @if (Session::has('success'))
        <script>
            var message = '{{ Session::get('success') }}';
            Swal.fire({
                title: 'Success',
                text:  message,
                icon: 'success'
            });
        </script>   
    @endif

    @if (Session::has('error'))
        <script>
            var message = '{{ Session::get('error') }}';
            Swal.fire({
                title: 'Error',
                text:  message,
                icon: 'error'
            });
        </script>   
    @endif
</body>

</html>
