@extends('layout', [
    'breadcrumb_items' => [
        ['text' => 'Profil', 'is_active' => true]
    ]
])

@section('title', 'Profil Karyawan')

@section('styles')
@endsection

@section('content')
<div class="card card-body" style="width: 350px">
    <div class="row gx-4 mb-2">
        <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
                <img src="{{ url('themes/img/bruce-mars.jpg') }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
        </div>
        <div class="col-auto my-auto">
            <div class="h-100">
                <h5 class="mb-0">
                    {{ $employee?->nama_pegawai ?? 'N/A' }}
                </h5>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-plain h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">Informasi Profil</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nama:</strong> &nbsp; {{ $employee?->nama_pegawai ?? 'N/A' }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Nomor HP:</strong> &nbsp; {{ $employee?->nohp ?? 'N/A' }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; {{ $employee?->email ?? 'N/A' }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection
