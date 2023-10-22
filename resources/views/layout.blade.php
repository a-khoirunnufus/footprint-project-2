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
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
        <div class="sidenav-header">
            <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
                <h4 class="ms-1 font-weight-bold text-white">{{ config('app.name') }}</h4>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse w-auto h-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Kasir</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('orders.create') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">shopping_cart</i>
                        </div>
                        <span class="nav-link-text ms-1">Keranjang Pesanan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('transactions.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">bar_chart</i>
                        </div>
                        <span class="nav-link-text ms-1">Riwayat Transaksi</span>
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Inventori</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('items.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">inventory_2</i>
                        </div>
                        <span class="nav-link-text ms-1">Data Barang</span>
                    </a>
                </li>

                @if(auth()->guard('admin')->check())
                    <li class="nav-item mt-3">
                        <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Karyawan</h6>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('employees.index') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">groups</i>
                            </div>
                            <span class="nav-link-text ms-1">Data Karyawan</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </aside>
    <div class="px-5 main-content position-relative">
        <div style="margin: 1rem 0">
            <div class="d-flex justify-content-between align-items-top mb-4">
                @include('_breadcrumb', ['breadcrumb_items' => $breadcrumb_items])
                <div class="d-flex">
                    <a href="{{ route('profile') }}" role="button" class="btn btn-link text-dark opacity-10 mb-0">
                        <span class="text-center me-1">
                            <i class="material-icons">person</i>
                        </span>
                        {{ auth()->user()->nama_pegawai }}
                    </a>
                    <a href="{{ route('logout') }}" role="button" class="btn btn-link text-dark opacity-10 mb-0">
                        <span class="text-center me-1">
                            <i class="material-icons">logout</i>
                        </span>
                        Logout
                    </a>
                </div>
            </div>

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
    <script src="https://cdn.jsdelivr.net/npm/form-data-json-convert/dist/form-data-json.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
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

        /**
         * Localization
         */
        let Rupiah = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
        });

    </script>
    @yield('scripts')
</body>

</html>
