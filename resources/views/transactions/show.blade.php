@extends('layout', [
    'breadcrumb_items' => [
        ['text' => 'Kasir', 'is_active' => false],
        ['text' => 'Riwayat Transaksi', 'is_active' => false],
        ['text' => 'Detail Transaksi', 'is_active' => true]
    ]
])

@section('title', 'Detail Transaksi')

@section('styles')
<style>
    .unstyled-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header pb-0">
        <div class="d-flex align-transactions-center">
            <h6 class="opacity-8 mb-0 flex-grow-1">Detail Transaksi</h6>
        </div>
    </div>
    <div class="card-body">
        <ul class="unstyled-list mb-3">
            <li><strong>Id Transaksi :</strong> {{ $transaction->id }}</li>
            <li><strong>Nama Kasir :</strong> {{ $transaction->cashier->nama_pegawai }}</li>
            <li><strong>Waktu Transaksi :</strong> {{ (new Carbon\Carbon($transaction->created_at))->utcOffset(60*7)->format('d/m/Y H:i:s') }}</li>
        </ul>
        <table class="table">
            <thead>
                <tr>
                    <th class="ps-2">Barang</th>
                    <th class="ps-2">Harga</th>
                    <th class="ps-2">Jumlah</th>
                    <th class="ps-2">Diskon</th>
                    <th class="ps-2">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaction->order->orderItem as $item)
                    <tr>
                        <td>{{ $item->item->name }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->discount }}</td>
                        <td>{{ ($item->price * $item->quantity) - $item->discount }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Harga</th>
                    <th id="total-discount">{{ $transaction->order->item_discount }}</th>
                    <th id="grand-total">{{ $transaction->order->grand_total }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
</script>
@endsection
