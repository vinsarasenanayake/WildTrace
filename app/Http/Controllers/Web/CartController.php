<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Display Cart Page
    public function index()
    {
        return view('pages.cart');
    }

    // Display Checkout Page
    public function checkout()
    {
        return view('pages.checkout');
    }

    // Process Checkout & Payment
    public function process(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'city' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
            'contact_number' => 'required',
            'postal_code' => 'required',
            'country' => 'required|in:SL',
        ]);

        // Sync shipping info to profile
        if (auth()->check()) {
            auth()->user()->update([
                'address' => $request->address,
                'city' => $request->city,
                'contact_number' => $request->contact_number,
                'postal_code' => $request->postal_code,
                'country' => 'Sri Lanka',
            ]);
        }


        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $lineItems = [];
        $totalPrice = 0;

        foreach ($cart as $id => $details) {
            $totalPrice += $details['price'] * $details['quantity'];
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $details['title'] ?? ($details['name'] ?? 'Product'),
                        'images' => [$details['image']],
                    ],
                    'unit_amount' => $details['price'] * 100,
                ],
                'quantity' => $details['quantity'],
            ];
        }

        // Create Order Record
        $order = \App\Models\Order::create([
            'user_id' => auth()->id(),
            'status' => 'pending',
            'payment_status' => 'pending',
            'total_price' => $totalPrice,
            'shipping_address' => json_encode($request->only(['full_name', 'email', 'address', 'city', 'contact_number', 'postal_code', 'country'])),
        ]);

        foreach ($cart as $id => $details) {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $details['product_id'] ?? (is_numeric($id) ? $id : explode('-', (string) $id)[0]),
                'product_name' => $details['title'] ?? ($details['name'] ?? 'Product'),
                'product_image' => $details['image'] ?? null,
                'price' => $details['price'],
                'quantity' => $details['quantity'],
            ]);
        }

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel') . '?order_id=' . $order->id,
            'customer_email' => $request->email,
        ]);

        $order->session_id = $session->id;
        $order->save();

        return redirect($session->url);
    }

    // Repay Pending/Declined Order
    public function repay(\App\Models\Order $order)
    {
        if (($order->payment_status !== 'pending' && $order->payment_status !== 'declined') || $order->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Unable to process this payment.');
        }

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $lineItems = [];
        foreach ($order->items as $item) {
            $imagePath = $item->product_image ?? ($item->product->image_url ?? null);
            $images = [];
            if ($imagePath && trim($imagePath) !== '') {
                $images[] = asset($imagePath);
            }

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item->product_name,
                        'images' => $images,
                    ],
                    'unit_amount' => $item->price * 100,
                ],
                'quantity' => $item->quantity,
            ];
        }

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel') . '?order_id=' . $order->id,
            'customer_email' => auth()->user()->email,
        ]);

        $order->session_id = $session->id;
        $order->payment_status = 'pending';
        $order->save();

        return redirect($session->url);
    }

    // Payment Success
    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');
        $order = \App\Models\Order::where('session_id', $sessionId)->firstOrFail();

        if ($order->payment_status === 'pending' || $order->payment_status === 'declined') {
            $order->payment_status = 'confirmed';
            $order->status = 'paid';
            $order->save();
            session()->forget('cart');
        }

        return redirect()->route('home')->with('success', 'Thank you for your order! Payment successful.');
    }

    // Payment Cancellation
    public function cancel(Request $request)
    {
        if ($request->has('order_id')) {
            $order = \App\Models\Order::find($request->order_id);
            if ($order && ($order->payment_status === 'pending')) {
                $order->payment_status = 'declined';
                $order->save();
            }
        }
        return redirect()->route('cart.index')->with('error', 'Order declined/cancelled.');
    }
}
