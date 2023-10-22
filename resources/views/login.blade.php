<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('themes/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ url('themes/img/favicon.png') }}">
    <title>
        Login | {{ config('app.name') }}
    </title>
    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ url('themes/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />
</head>

<body class="bg-gray-200">
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-100" style="background-image: url('themes/img/office-dark.jpg');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">{{ config('app.name') }}</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="form-login" action="{{ url('login') }}" method="post" role="form" class="text-start">
                                    @csrf
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Username</label>
                                        <input id="input-username" name="username" type="text" class="form-control" />
                                        @if($errors->default->has('username'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->default->first('username') }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label">Password</label>
                                        <input id="input-password" name="password" type="password" class="form-control" />
                                        @if($errors->default->has('password'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->default->first('password') }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--   Core JS Files   -->
    <script src="{{ url('themes/js/core/popper.min.js') }}"></script>
    <script src="{{ url('themes/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ url('vendor/jquery-3.7.1.js') }}"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ url('themes/js/material-dashboard.min.js?v=3.0.0') }}"></script>
    <script>
        $(function(){
            const oldUsername = "{{ old('username') }}";

            if (oldUsername != 'null' && oldUsername != '') {
                $('#input-username').val(oldUsername).focus();
            }
        })
    </script>
</body>

</html>
