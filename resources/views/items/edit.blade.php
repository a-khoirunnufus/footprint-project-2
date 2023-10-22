@extends('layout', [
    'breadcrumb_items' => [
        ['text' => 'Data Barang', 'is_active' => false],
        ['text' => 'Edit Data Barang', 'is_active' => true]
    ]
])
@section('title', 'Edit Data Barang')

@section('styles')
<style>
</style>
@endsection

@section('content')
<div class="card" style="width: 400px">
    <div class="card-header pb-0 text-left">
        <h5 class="mb-0">Edit Barang</h5>
    </div>
    <div class="card-body">
        <form id="form-edit-item" action="{{ url('items/'.$item->id) }}" method="post" data-form-type="edit" role="form" class="text-left">
            @csrf
            <div class="input-group input-group-outline mb-3 {{ $item->name ? 'is-filled' : '' }}">
                <label class="form-label">Nama Barang</label>
                <input type="text" name="name" class="form-control" value="{{ $item->name }}">
                @if($errors->default->has('name'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->default->first('name') }}
                    </div>
                @enderror
            </div>
            <div class="input-group input-group-outline my-3 {{ $item->sell_price ? 'is-filled' : '' }}">
                <label class="form-label">Harga Jual Barang</label>
                <input name="sell_price" class="form-control" type="number" min="1" step="0.01" value="{{ $item->sell_price }}">
                @if($errors->default->has('sell_price'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->default->first('sell_price') }}
                    </div>
                @enderror
            </div>
            <div class="input-group input-group-outline my-3 {{ $item->available ? 'is-filled' : '' }}">
                <label class="form-label">Jumlah Barang Tersedia</label>
                <input name="available" class="form-control" type="number" min="1" step="0.01" value="{{ $item->available }}">
                @if($errors->default->has('available'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->default->first('available') }}
                    </div>
                @enderror
            </div>
            <div class="text-left mt-3">
                <button type="submit" class="btn btn-warning">Edit Data</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
</script>
@endsection
