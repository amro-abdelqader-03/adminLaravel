<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $orders = Order::latest()->paginate(5);
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $users = User::all();

        return view('orders.create', compact('products', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'orderitems' => 'required|array|min:1',
            'orderitems.*.product_id' => 'required|exists:products,id',
        ]);

        DB::transaction(function () use ($request) {

            $order = Order::create([
                'user_id' => $request->user_id,
                'total_price' => 0,
                'revenue' => 0,
            ]);

            $total_price = 0;
            $total_cost = 0;

            $productIds = collect($request->orderitems)
                ->pluck('product_id')
                ->unique();

            $products = Product::whereIn('id', $productIds)
                ->get()
                ->keyBy('id');

            foreach ($request->orderitems as $orderitem) {

                $product = $products[$orderitem['product_id']];

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                ]);

                $total_price += $product->price;
                $total_cost += $product->cost;
            }

            $order->update([
                'total_price' => $total_price,
                'revenue' => $total_price - $total_cost,
            ]);
        });

        return redirect()->route('orders.index')
            ->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
        $orderitems = OrderItem::where('order_id', $order->id)->get();
        return view('orders.show', compact('order','orderitems'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
        $users = User::all();
        $products = Product::all();
        return view('orders.edit', compact('order', 'products', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'orderitems' => 'required|array|min:1',
            'orderitems.*.product_id' => 'required|exists:products,id',
        ]);

        DB::transaction(function () use ($request, $order) {

            // Update order user
            $order->update([
                'user_id' => $request->user_id,
            ]);

            // Delete old order items
            OrderItem::where('order_id', $order->id)->delete();

            $total_price = 0;
            $total_cost = 0;

            // Get all products
            $productIds = collect($request->orderitems)
                ->pluck('product_id')
                ->unique();

            $products = Product::whereIn('id', $productIds)
                ->get()
                ->keyBy('id');

            // Insert new order items
            foreach ($request->orderitems as $orderitem) {

                $product = $products[$orderitem['product_id']];

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                ]);

                $total_price += $product->price;
                $total_cost += $product->cost;
            }

            // Update order totals
            $order->update([
                'total_price' => $total_price,
                'revenue' => $total_price - $total_cost,
            ]);
        });

        return redirect()->route('orders.index')
            ->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        DB::transaction(function () use ($order) {

            // Delete associated order items
            OrderItem::where('order_id', $order->id)->delete();

            // Delete the order
            $order->delete();
        });

        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully.');
    }
}
