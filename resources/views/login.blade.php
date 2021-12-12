<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <title>{{ $title }}</title>

    <style>
        * {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        .row {
            margin: 0 !important;
        }

        .background-login {
            background: url('/image/background-login.jpeg') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            height: 100%;
        }

    </style>
</head>

<body class="vh-100 vw-100">
    <div class="background-login px-0 row text-white">
        <div class="col-12 col-lg-6 h-100 ms-auto p-3 p-lg-5">
            <div class="card cerita-kopi-color h-100" style="border-radius: 24px;">
                <div class="align-items-center card-body justify-content-center row">
                    <div class="text-center p-3 p-lg-5 text-dark">
                        <img src="/image/Logo.png" alt="logo"><img src="/image/Title.png" alt="title">
                        <form action="{{route('post-login')}}" method="POST">
                            @csrf
                            <div class="card my-5" style="border-radius: 24px;">
                                <h1 class="col-form-label fs-2 fw-bold pt-4 pt-lg-5 px-4 px-lg-5">Masuk</h1>
                                <div class="card-body pb-4 pb-lg-5 px-4 px-lg-5">
                                    <div class="input-group py-1 py-lg-2">
                                        <label for="username"
                                            class="bg-white col-form-label input-group-text p-lg-3 text-secondary"
                                            style="border-radius: 24px 0px 0px 24px;"><i
                                                class="fas fa-user text-dark"></i></label>
                                        <input type="text" id="username" name="username" class="form-control"
                                            style="border-radius: 0px 24px 24px 0px;" placeholder="Username"
                                            maxlength="50" required>
                                    </div>
                                    {{-- <div class="input-group py-1 py-lg-2">
                                        <label for="email"
                                            class="bg-white col-form-label input-group-text p-lg-3 text-secondary"
                                            style="border-radius: 24px 0px 0px 24px;"><i
                                                class="fas fa-envelope text-dark"></i></label>
                                        <input type="email" id="email" name="email" class="form-control"
                                            style="border-radius: 0px 24px 24px 0px;" placeholder="Email"
                                            maxlength="100" required>
                                    </div> --}}
                                    <div class="input-group py-1 py-lg-2">
                                        <label for="password"
                                            class="bg-white col-form-label input-group-text p-lg-3 text-secondary"
                                            style="border-radius: 24px 0px 0px 24px;"><i
                                                class="fas fa-key text-dark"></i></label>
                                        <input type="password" id="password" name="password" class="form-control"
                                            style="border-radius: 0px 24px 24px 0px;" placeholder="Password"
                                            maxlength="20" required>
                                    </div>
                                    <button type="submit" class="btn cerita-kopi-color fw-bold mt-2 mt-lg-4 p-lg-3 text-white w-100"
                                        style="border-radius: 32px;">Masuk</button>
                                    {{-- <input class="btn bg-white cerita-kopi-text-color fw-bold mt-2 p-lg-3 w-100"
                                        style="border-radius: 32px" value="Daftar" onclick="register();"> --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
</body>

<script>
    function register() {
        $.ajax({
            url: '/register/store',
            type: 'POST',
            data: {
                name: $('#username').val(),
                // email: $('#email').val(),
                password: $('#password').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.code == 200) {
                    location.reload();
                } else if (response.code == 406) {
                    alert("Pendaftaran gagal");
                } else if (response.code == 407) {
                    alert("Akun sudah terdaftar")
                }
            }
        })
    }
</script>

</html>
