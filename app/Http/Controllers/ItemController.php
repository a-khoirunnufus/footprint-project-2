<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Item;
use DB;

class ItemController extends Controller
{
    public function index()
    {
        return view('items.index');
    }

    public function create()
    {
        return view('items.create');
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

            Item::create($data);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            throw $th;
        }

        return redirect()->route('items.index')->with('message', [
            'type' => 'success',
            'text' => 'Berhasil menambahkan data barang baru.'
        ]);
    }

    public function edit($id)
    {
        $item = Item::find($id);

        if (!$item) {
            abort(404);
        }

        return view('items.edit', ['item' => $item]);
    }

    public function update(Request $request, $id)
    {
        $item = Item::find($id);

        if (!$item) {
            abort(404);
        }

        $validated = $request->validate([
            'name' => 'required|min:3',
            'price' => 'required',
        ]);

        $data = $validated;

        try {
            DB::beginTransaction();

            Item::where('id', $id)->update($data);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            throw $th;
        }

        return redirect()->route('items.index')->with('message', [
            'type' => 'success',
            'text' => 'Berhasil mengedit data barang.'
        ]);
    }

    public function destroy($id)
    {
        $item = Item::find($id);

        if (!$item) {
            abort(404);
        }

        try {
            DB::beginTransaction();

            Item::destroy($id);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            throw $th;
        }

        return redirect()->route('items.index')->with('message', [
            'type' => 'success',
            'text' => 'Berhasil menghapus data barang.'
        ]);
    }

    public function datatable()
    {
        $query = Item::all();

        $datatable = datatables($query);

        return $datatable->toJson();
    }
}
