<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Aplikasi</title>

    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/auth.css') }}">

</head>

<body  style="background-color: #0c5c31">
    <div class="container">
        <div class="row mt-5 d-flex justify-content-center">
            <div class="login-box mt-5">
                <div class="card">
                    <div class="pt-5 pb-3 px-4">
                        <div class=" card-body p-0">
                            <div class="text-center">
                                <h2 class="font-weight-bolder">  <span class="fas fa-fw fa-user"></span>MASUK</h2>
                                <hr class="garis">
                            </div>
                            <form method="POST" action="{{ route('authenticate') }}" class="mt-5">
                                @csrf
                                <div class="mb-3">
                                    <div class="input-group @error('username') is-invalid @enderror">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-light"  style="background-color: #0c5c31">
                                                <span class="fas fa-fw fa-user"></span>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                            placeholder="Username" value="{{ old('username') }}" name="username"
                                            autocomplete="off" autofocus>
                                    </div>
                                    @error('username')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <div class="input-group @error('password') is-invalid @enderror">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-light"  style="background-color: #0c5c31">
                                                <span class="fas fa-fw fa-lock"></span>
                                            </span>
                                        </div>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Password" name="password" autocomplete="off">
                                    </div>
                                    @error('password')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button class="btn btn-block text-light"  style="background-color: #0c5c31"type="submit">SIGN IN</button>
                                <hr>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    @if (Session::has('error'))
        <script>
            var message = '{{ Session::get('error') }}';
            Swal.fire({
                title: 'Error!',
                text:  message,
                icon: 'error'
            });
        </script>
    @endif

    @if (Session::has('success'))
        <script>
            var message = '{{ Session::get('success') }}';
            Swal.fire({
                title: 'Success!',
                text:  message,
                icon: 'success'
            });
        </script>
    @endif
</body>

</html>
