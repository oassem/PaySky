<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $totalAmount = 0;
        $order = Order::create(['total_amount' => 0, 'status' => 'pending']);

        foreach ($request->products as $item) {
            $product = Product::find($item['id']);
            $price = $product->price * $item['quantity'];
            $totalAmount += $price;

            $order->products()->attach($product->id, [
                'quantity' => $item['quantity'],
                'price' => $product->price,
            ]);
        }

        $order->update(['total_amount' => $totalAmount * 1.10]); // Add 10% tax

        return new OrderResource($order->load('products'));
    }

    public function show($id)
    {
        $order = Order::with('products')->findOrFail($id);
        return new OrderResource($order);
    }
}
