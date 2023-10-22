<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use DB;

class OrderController extends Controller
{
    public function create()
    {
        $items = Item::all();
        return view('orders.create', ['items' => $items]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|array',
            'item_price' => 'required|array',
            'item_quantity' => 'required|array',
            'item_discount' => 'required|array',
        ]);

        try {
            DB::beginTransaction();

            $sub_total = 0;
            $item_discount = 0;
            foreach ($validated['item_id'] as $idx => $item_id) {
                $sub_total += (float)$validated['item_price'][$idx] * (int)$validated['item_quantity'][$idx];
                $item_discount += (float)$validated['item_discount'][$idx];
            }
            $grand_total = $sub_total - $item_discount;

            $order = Order::create([
                'customer_name' =>  null,
                'status' => 'paid',
                'sub_total' => $sub_total,
                'item_discount' => $item_discount,
                'grand_total' => $grand_total,
            ]);

            foreach ($validated['item_id'] as $idx => $item_id) {
                OrderItem::create([
                    'item_id' => $item_id,
                    'order_id' => $order->id,
                    'price' => (float)$validated['item_price'][$idx],
                    'discount' => (float)$validated['item_discount'][$idx],
                    'quantity' => (int)$validated['item_quantity'][$idx],
                ]);
            }

            $user = auth()->guard('employee')->user();
            if(!$user) {
                $user = auth()->guard('admin')->user();
            }

            Transaction::create([
                'order_id' => $order->id,
                'cashier_id' => $user->id_pegawai,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            throw $th;
        }

        return redirect()->route('orders.create')->with('message', [
            'type' => 'success',
            'text' => 'Berhasil menyimpan transaksi.'
        ]);
    }
}
