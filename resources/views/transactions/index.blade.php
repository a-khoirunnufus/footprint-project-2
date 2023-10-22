@extends('layout', [
    'breadcrumb_transactions' => [
        ['text' => 'Data Transaksi', 'is_active' => true]
    ]
])

@section('title', 'Data Transaksi')

@section('styles')
<style>
    .dataTables_length select {
        border: 1px solid gainsboro !important;
        width: 70px !important;
        border-radius: 6px !important;
        background-position: right .5rem center !important;
    }

    .dataTables_filter input {
        border: 1px solid gainsboro !important;
        border-radius: 6px !important;
    }

    .dataTables_info {
        font-size: 0.875rem !important;
    }

    .dataTables_paginate .page-link {
        width: 30px !important;
        height: 30px !important;
        vertical-align: middle;
        line-height: 30px;
    }

    .dropdown-menu {
        display: none !important;
    }
    .dropdown-menu.show {
        display: block !important;
    }
    .dropdown-menu::before {
        content: unset !important;
    }

</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header border-bottom">
        <div class="d-flex align-transactions-center">
            <h6 class="opacity-8 mb-0 flex-grow-1">Data Transaksi</h6>
        </div>
    </div>
    <table id="table-transaction" class="table">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary text-xs font-weight-bolder ps-2 text-center">Id Transaksi</th>
                <th class="text-uppercase text-secondary text-xs font-weight-bolder ps-2">Nama Kasir</th>
                <th class="text-uppercase text-secondary text-xs font-weight-bolder ps-2">Waktu Transaksi</th>
                <th class="text-uppercase text-secondary text-xs font-weight-bolder ps-2">Total Harga</th>
                <th class="text-uppercase text-secondary text-xs font-weight-bolder ps-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
    $(function(){
        $('#table-transaction').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: baseUrl + '/transactions/datatable',
            },
            order: [[0, 'asc']],
            columns: [
                { data: 'id', className: 'text-center' },
                { data: 'name'},
                {
                    data: 'price',
                    render: (data) => {
                        return Rupiah.format(data);
                    }
                },
                { data: 'quantity'},
                { data: 'sold'},
                { data: 'available'},
                {
                    data: 'id',
                    orderable: false,
                    className: 'text-center',
                    render: (data) => {
                        return `
                            <div class="dropdown">
                                <a href="#" role="button" class="" data-bs-toggle="dropdown">
                                    <i class="fa fa-ellipsis-v opacity-6 text-dark"></i>
                                </a>
                                <ul class="dropdown-menu border">
                                    <li>
                                        <a class="dropdown-item" href="${baseUrl}/transactions/${data}/edit">
                                            <i class="fa fa-edit opacity-6 text-dark me-2"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" onclick="doDelete('${baseUrl}/transactions/${data}/destroy')">
                                            <i class="fa fa-trash opacity-6 text-dark me-2"></i> Hapus
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        `;
                    }
                }
            ],
            language: {
                search: '_INPUT_',
                searchPlaceholder: "Cari Data",
                lengthMenu: '_MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': '<i class="fa fa-chevron-right opacity-6 text-dark text-xs"></i>', 'previous': '<i class="fa fa-chevron-left opacity-6 text-dark text-xs"></i>' },
                processing: "Loading...",
                emptyTable: "Tidak ada data",
                infoEmpty:  "Menampilkan 0",
                lengthMenu: "_MENU_",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                infoFiltered: "(difilter dari _MAX_ entri)",
                zeroRecords: "Tidak ditemukan data yang cocok"
            },
            dom: `
                <"d-flex justify-content-between align-transactions-center px-3 pt-3 pb-2" <l> <f> >
                tr
                <"d-flex justify-content-between px-3 pt-2 pb-3" <i> <p> >
            `,
        });
    })
</script>
@endsection
