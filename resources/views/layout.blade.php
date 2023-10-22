<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('themes/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ url('themes/img/favicon.png') }}">
    <title>
        @yield('title') | {{ config('app.name') }}
    </title>
    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ url('themes/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ url('themes/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-material-ui@5/material-ui.css" />
    <link id="pagestyle" href="{{ url('themes/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('vendor/css/dataTables.bootstrap5.min.css') }}" />
    @yield('styles')
</head>

<body class="bg-gray-200">
  <div class="px-5 main-content position-relative">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg blur border-radius-xl z-index-sticky shadow position-sticky start-0 end-0" style="top: 1rem">
        <div class="container-fluid ps-2 pe-0">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3" href="#">
                <h5 class="opacity-8 m-0">{{ config('app.name') }}</h5>
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
                <ul class="navbar-nav w-100 ms-4">
                    @if(auth()->guard('admin')->check())
                        <li class="nav-item">
                            <a class="nav-link me-2" href="{{ route('employees.index') }}">
                                <i class="fa fa-users opacity-6 text-dark me-2"></i>
                                Data Pegawai
                            </a>
                        </li>
                    @endif
                    <li class="nav-item flex-grow-1">
                        <a class="nav-link me-2" href="{{ route('profile') }}">
                            <i class="fa fa-id-card opacity-6 text-dark me-2"></i>
                            Profil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="{{ route('logout') }}">
                            Logout
                            <i class="fa fa-arrow-right opacity-6 text-dark ms-2"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div style="margin: 3rem 0">

        @if(session()->has('message'))
            @php
                $message = session()->get('message');
            @endphp
            <div class="alert alert-{{ $message['type'] }} text-white alert-dismissible fade show" role="alert">
                <span class="alert-text">{{ $message['text'] }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="vertical-align: middle; line-height: 1rem">
                    <i class="fa fa-close text-white"></i>
                </button>
            </div>
        @endif

        @include('_breadcrumb', ['breadcrumb_items' => $breadcrumb_items])

        @yield('content')
    </div>

    <form id="form-delete-global" action="" method="post" data-form-type="delete">
        @csrf
    </form>
  </div>
  <!--   Core JS Files   -->
  <script src="{{ url('themes/js/core/popper.min.js') }}"></script>
  <script src="{{ url('themes/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ url('vendor/js/jquery-3.7.1.js') }}"></script>
  <script src="{{ url('vendor/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ url('vendor/js/dataTables.bootstrap5.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ url('themes/js/material-dashboard.min.js?v=3.0.0') }}"></script>

  <script>
    const baseUrl = "{{ url('/') }}";

    const swalDelete = Swal.mixin({
        title: 'Apakah anda yakin?',
        text: "Data yang dihapus tidak dapat kembali!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal',
        customClass: {
            confirmButton: 'btn btn-danger',
            cancelButton: 'ms-3 btn btn-secondary'
        },
        buttonsStyling: false
    });

    const swalEdit = Swal.mixin({
        title: 'Apakah anda yakin?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Edit',
        cancelButtonText: 'Batal',
        customClass: {
            confirmButton: 'btn btn-warning',
            cancelButton: 'ms-3 btn btn-secondary'
        },
        buttonsStyling: false
    });

    $(function(){
        $('form[data-form-type="edit"]').on('submit', function(e) {
            e.preventDefault();
            swalEdit
                .fire()
                .then((result) => {
                    if(result.isConfirmed) {
                        $(this).unbind('submit');
                        $(this).submit();
                    }
                });
        });

        $('form[data-form-type="delete"]').on('submit', function(e) {
            e.preventDefault();
            swalDelete
                .fire()
                .then((result) => {
                    if(result.isConfirmed) {
                        $(this).unbind('submit');
                        $(this).submit();
                    }
                });
        });
    });

    function doDelete(url)
    {
        $('#form-delete-global').attr('action', url);
        $('#form-delete-global').submit();
    }

  </script>
  @yield('scripts')
</body>

</html>
