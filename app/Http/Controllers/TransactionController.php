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

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        $data = $validated;

        try {
            DB::beginTransaction();

            Transaction::create($data);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            throw $th;
        }

        return redirect()->route('transactions.index')->with('message', [
            'type' => 'success',
            'text' => 'Berhasil menambahkan transaksi baru.'
        ]);
    }

    public function datatable()
    {
        $query = Transaction::all();

        $datatable = datatables($query);

        return $datatable->toJson();
    }
}
