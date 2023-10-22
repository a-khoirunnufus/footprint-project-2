@extends('layout', [
    'breadcrumb_items' => [
        ['text' => 'Kasir', 'is_active' => false],
        ['text' => 'Keranjang Pesanan', 'is_active' => true],
    ]
])

@section('title', 'Keranjang Pesanan')

@section('styles')
<style>
    .form-select {
        background-position: right 1rem center !important;
        height: 100% !important;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header pb-0 text-left d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Keranjang Pesanan</h5>
        <div class="input-group" style="width: 400px">
            <select id="select-add-item" class="form-select border px-3" aria-label="Default select example">
                <option selected>Pilih Item</option>
                @foreach($items as $item)
                    <option value="{{ $item->id }}" data-name="{{ $item->name }}" data-price="{{ $item->sell_price }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <button class="btn btn-success mb-0" onclick="addItem()">
                <i class="material-icons me-2">add</i>
                Tambah Item
            </button>
        </div>
    </div>
    <div class="card-body">
        <form id="form-shopping-cart" action="{{ url('orders') }}" method="post">
            @csrf
            <table id="table-shopping-cart" class="table">
                <thead>
                    <tr>
                        <th class="ps-2">Barang</th>
                        <th class="ps-2">Harga</th>
                        <th class="ps-2">Jumlah</th>
                        <th class="ps-2">Diskon</th>
                        <th class="ps-2">Subtotal</th>
                        <th class="ps-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Total Pembelian</th>
                        <th id="total-discount">Rp 0.00</th>
                        <th id="grand-total">Rp 0.00</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
            <div class="d-flex mt-3 justify-content-end">
                <button type="submit" class="btn btn-primary">
                    Simpan Transaksi
                </button>
            </div>
        </form>

    </div>
</div>

@endsection

@section('scripts')
<script>
    function addItem() {
        const selectedOption = $('#select-add-item').find(":selected");
        const itemId = selectedOption.val();
        const itemName = selectedOption.attr('data-name');
        const itemPrice = selectedOption.attr('data-price');

        $('#table-shopping-cart tbody').append(`
            <tr style="vertical-align: middle">
                <td>${itemName}</td>
                <td data-price="${itemPrice}">${Rupiah.format(itemPrice)}</td>
                <td>
                    <input type="hidden" name="item_id[]" value="${itemId}" />
                    <input type="hidden" name="item_price[]" value="${itemPrice}" />
                    <div class="input-group input-group-outline">
                        <input value="1" type="number" name="item_quantity[]" class="form-control" min="1" step="1" onchange="changeItemData(event)" />
                    </div>
                </td>
                <td>
                    <div class="input-group input-group-outline">
                        <input value="0" type="number" name="item_discount[]" class="form-control" min="0" step="0.01" onchange="changeItemData(event)" />
                    </div>
                </td>
                <td>${Rupiah.format(itemPrice)}</td>
                <td>
                    <button class="btn btn-icon btn-danger text-white d-inline-block" onclick="deleteItem(event)">
                        <i class="material-icons">delete</i>
                    </button>
                </td>
            </tr>
        `);

        refreshTotal();
    }

    function deleteItem(event) {
        $(event.currentTarget).parents('tr').remove();

        refreshTotal();
    }

    function changeItemData(event) {
        const parentTr = $(event.currentTarget).parents('tr');
        const itemPrice = parseFloat(parentTr.children().get(1).dataset.price);
        const itemQty = parseFloat(parentTr.find('input[name="item_quantity[]"').val());
        const itemDiscount = parseFloat(parentTr.find('input[name="item_discount[]"').val());

        const subTotal = (itemPrice * itemQty) - itemDiscount;

        parentTr.children().get(4).innerText = Rupiah.format(subTotal);

        refreshTotal();
    }

    function refreshTotal() {
        const data = $("#form-shopping-cart").serializeArray();

        const itemIdArr = data.filter(item => {
            return item.name == 'item_id[]';
        });
        const itemPriceArr = data.filter(item => {
            return item.name == 'item_price[]';
        });
        const itemQtyArr = data.filter(item => {
            return item.name == 'item_quantity[]';
        });
        const itemDiscountArr = data.filter(item => {
            return item.name == 'item_discount[]';
        });

        let grandTotal = 0;

        itemPriceArr.forEach((item, idx) => {
            const price = parseFloat(item.value);
            const qty = parseInt(itemQtyArr[idx].value);
            const discount = parseFloat(itemDiscountArr[idx].value);

            grandTotal += (price * qty) - discount;
        });

        let totalDiscount = itemDiscountArr.reduce((acc, curr) => {
            return acc + parseFloat(curr.value);
        }, 0);

        // console.log('total discount', totalDiscount);

        $('#total-discount').text(Rupiah.format(totalDiscount));
        $('#grand-total').text(Rupiah.format(grandTotal));
    }
</script>
@endsection
