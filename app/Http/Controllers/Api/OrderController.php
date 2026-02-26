<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::where('user_id', $request->user()->id)
            ->with(['items.product'])
            ->latest()
            ->get();

        return response()->json($orders);
    }

    public function show(Request $request, string $id)
    {
        $order = Order::where('user_id', $request->user()->id)
            ->with(['items.product'])
            ->find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json($order);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
            'shipping_address' => 'required|string',
            'payment_status' => 'sometimes|string|in:pending,paid,failed',
            'session_id' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => $request->user()->id,
                'total_price' => $request->total_price,
                'shipping_address' => $request->shipping_address,
                'status' => ($request->payment_status === 'paid') ? 'paid' : 'pending',
                'payment_status' => $request->payment_status ?? 'pending',
                'session_id' => $request->session_id,
            ]);

            foreach ($request->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'product_name' => $item['product_name'] ?? null,
                    'product_image' => $item['product_image'] ?? null,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            Cart::where('user_id', $request->user()->id)->delete();

            DB::commit();

            $order->load(['items.product']);

            return response()->json([
                'message' => 'Order placed successfully',
                'order' => $order
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to place order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateStatus(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'sometimes|string|in:pending,processing,shipped,delivered,cancelled',
            'payment_status' => 'sometimes|string|in:pending,paid,failed,confirmed,declined,refunded',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->update($request->only(['status', 'payment_status']));

        return response()->json([
            'message' => 'Order updated successfully',
            'order' => $order
        ]);
    }

    public function cancel(Request $request, string $id)
    {
        $order = Order::where('user_id', $request->user()->id)->find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        if ($order->status === 'pending' || $order->payment_status === 'pending') {
            $order->status = 'declined';
            $order->payment_status = 'declined';
            $order->save();
            return response()->json(['message' => 'Order cancelled', 'order' => $order]);
        }

        return response()->json(['message' => 'Order cannot be cancelled'], 400);
    }

    public function updatePaymentStatus(Request $request, string $id)
    {
        $request->validate([
            'payment_status' => 'required|string',
        ]);

        $order = Order::where('user_id', $request->user()->id)->find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->update([
            'payment_status' => $request->payment_status,
            'status' => $request->payment_status === 'paid' ? 'paid' : $order->status,
        ]);

        return response()->json([
            'message' => 'Payment status updated successfully',
            'order' => $order
        ]);
    }
}

