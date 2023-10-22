@extends('layout', [
    'breadcrumb_items' => [
        ['text' => 'Data Pegawai', 'is_active' => false],
        ['text' => 'Edit Data Pegawai', 'is_active' => true]
    ]
])
@section('title', 'Edit Data Pegawai')

@section('styles')
<style>
</style>
@endsection

@section('content')
<div class="card" style="width: 400px">
    <div class="card-header pb-0 text-left">
        <h5 class="mb-0">Edit Pegawai</h5>
    </div>
    <div class="card-body">
        <form id="form-edit-employee" action="{{ url('employees/'.$employee->id_pegawai) }}" method="post" data-form-type="edit" role="form" class="text-left">
            @csrf
            <div class="input-group input-group-outline mb-3 {{ $employee->nama_pegawai ? 'is-filled' : '' }}">
                <label class="form-label">Nama Pegawai *</label>
                <input type="text" name="nama_pegawai" class="form-control" value="{{ $employee->nama_pegawai }}">
                @if($errors->default->has('nama_pegawai'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->default->first('nama_pegawai') }}
                    </div>
                @enderror
            </div>
            <div class="input-group input-group-outline my-3 {{ $employee->email ? 'is-filled' : '' }}">
                <label class="form-label">Email *</label>
                <input type="text" name="email" class="form-control" value="{{ $employee->email }}">
                @if($errors->default->has('email'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->default->first('email') }}
                    </div>
                @enderror
            </div>
            <div class="input-group input-group-outline my-3 {{ $employee->username ? 'is-filled' : '' }}">
                <label class="form-label">Username *</label>
                <input type="text" name="username" class="form-control" value="{{ $employee->username }}">
                @if($errors->default->has('username'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->default->first('username') }}
                    </div>
                @enderror
            </div>
            <div class="input-group input-group-outline my-3 {{ $employee->nohp ? 'is-filled' : '' }}">
                <label class="form-label">No HP</label>
                <input type="text" name="nohp" class="form-control" value="{{ $employee->nohp }}">
                @if($errors->default->has('nohp'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->default->first('nohp') }}
                    </div>
                @enderror
            </div>
            <div class="input-group input-group-outline my-3">
                <label class="form-label">Password Baru</label>
                <input type="text" name="password" class="form-control">
                @if($errors->default->has('password'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->default->first('password') }}
                    </div>
                @enderror
            </div>
            <div class="text-left my-3">
                <button type="submit" class="btn btn-warning">Edit Data</button>
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
