<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;

class PaymentController extends Controller
{
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,successful,failed',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return new OrderResource($order);
    }
}
