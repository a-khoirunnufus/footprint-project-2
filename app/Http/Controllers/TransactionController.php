<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Transaction;
use DB;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transactions.index');
    }

    public function show($id)
    {
        $transaction = Transaction::find($id);

        return view('transactions.show', ['transaction' => $transaction]);
    }

    public function datatable()
    {
        $query = Transaction::with(['order', 'cashier']);

        $datatable = datatables($query);

        return $datatable->toJson();
    }
}
