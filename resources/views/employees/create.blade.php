@extends('layout', [
    'breadcrumb_items' => [
        ['text' => 'Data Pegawai', 'is_active' => false],
        ['text' => 'Tambah Data Pegawai', 'is_active' => true]
    ]
])
@section('title', 'Tambah Data Pegawai')

@section('styles')
<style>
</style>
@endsection

@section('content')
<div class="card" style="width: 400px">
    <div class="card-header pb-0 text-left">
        <h5 class="mb-0">Tambah Pegawai</h5>
    </div>
    <div class="card-body">
        <form id="form-add-employee" action="{{ url('employees') }}" method="post" role="form" class="text-left">
            @csrf
            <div class="input-group input-group-outline mb-3 {{ old('nama_pegawai') ? 'is-filled' : '' }}">
                <label class="form-label">Nama Pegawai *</label>
                <input type="text" name="nama_pegawai" class="form-control" value="{{ old('nama_pegawai') }}">
                @if($errors->default->has('nama_pegawai'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->default->first('nama_pegawai') }}
                    </div>
                @enderror
            </div>
            <div class="input-group input-group-outline my-3 {{ old('email') ? 'is-filled' : '' }}">
                <label class="form-label">Email *</label>
                <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                @if($errors->default->has('email'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->default->first('email') }}
                    </div>
                @enderror
            </div>
            <div class="input-group input-group-outline my-3 {{ old('username') ? 'is-filled' : '' }}">
                <label class="form-label">Username *</label>
                <input type="text" name="username" class="form-control" value="{{ old('username') }}">
                @if($errors->default->has('username'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->default->first('username') }}
                    </div>
                @enderror
            </div>
            <div class="input-group input-group-outline my-3 {{ old('password') ? 'is-filled' : '' }}">
                <label class="form-label">Password *</label>
                <input type="text" name="password" class="form-control" value="{{ old('password') }}">
                @if($errors->default->has('password'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->default->first('password') }}
                    </div>
                @enderror
            </div>
            <div class="input-group input-group-outline my-3 {{ old('nohp') ? 'is-filled' : '' }}">
                <label class="form-label">No HP</label>
                <input type="text" name="nohp" class="form-control" value="{{ old('nohp') }}">
                @if($errors->default->has('nohp'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->default->first('nohp') }}
                    </div>
                @enderror
            </div>
            <div class="text-left my-3">
                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </div>
            <div>
                <small>* Wajib diisi</small>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
</script>
@endsection
