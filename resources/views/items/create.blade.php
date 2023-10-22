@extends('layout', [
    'breadcrumb_items' => [
        ['text' => 'Data Barang', 'is_active' => false],
        ['text' => 'Tambah Data Barang', 'is_active' => true]
    ]
])
@section('title', 'Tambah Data Barang')

@section('styles')
<style>
</style>
@endsection

@section('content')
<div class="card" style="width: 400px">
    <div class="card-header pb-0 text-left">
        <h5 class="mb-0">Tambah Barang</h5>
    </div>
    <div class="card-body">
        <form id="form-add-item" action="{{ url('items') }}" method="post" role="form" class="text-left">
            @csrf
            <div class="input-group input-group-outline mb-3 {{ old('name') ? 'is-filled' : '' }}">
                <label class="form-label">Nama Barang</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                @if($errors->default->has('name'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->default->first('name') }}
                    </div>
                @enderror
            </div>
            <div class="input-group input-group-outline my-3 {{ old('price') ? 'is-filled' : '' }}">
                <label class="form-label">Harga Barang</label>
                <input type="number" name="price" class="form-control" value="{{ old('price') }}" min="1" step="0.01" />
                @if($errors->default->has('price'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->default->first('price') }}
                    </div>
                @enderror
            </div>
            <div class="input-group input-group-outline my-3 {{ old('quantity') ? 'is-filled' : '' }}">
                <label class="form-label">Jumlah Barang</label>
                <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}">
                @if($errors->default->has('quantity'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->default->first('quantity') }}
                    </div>
                @enderror
            </div>
            <div class="text-left mt-3">
                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
</script>
@endsection
