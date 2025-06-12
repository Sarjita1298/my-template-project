<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\District;

class CartController extends Controller
{
    public function cart()
    {
        $cartItems = session()->get('cart', []);
        $subtotal = 0;

        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shipping = 50; // fixed shipping cost

        $total = $subtotal + $shipping;

        // Load Indian states for dropdown
        $states = State::where('country_code', 'IN')->get();

        return view('frontend.shop.cart', compact('cartItems', 'subtotal', 'shipping', 'total', 'states'));
    }

    public function cartpage()
    {
        return $this->showCart();
    }

    public function showCart()
    {
        $cartItems = session()->get('cart', []);
        $subtotal = 0;

        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shipping = 50;
        $total = $subtotal + $shipping;

        $states = State::orderBy('name')->get();

        // Related products
        $products = \App\Models\Product::latest()->take(8)->get();

        return view('frontend.cartadded', compact('cartItems', 'subtotal', 'shipping', 'total', 'states', 'products'));
    }

    public function getDistricts(Request $request)
    {
        $districts = District::where('state_id', $request->state_id)->get();
        return response()->json($districts);
    }

    public function getPincode(Request $request)
    {
        $pincode = \App\Models\Pincode::where('district_id', $request->district_id)->first();
        return response()->json($pincode);
    }

    public function addToCart(Request $request)
    {
        $productId = $request->product_id;
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'name'     => $request->name,
                'price'    => $request->price,
                'image'    => $request->image,
                'rating'   => $request->rating ?? null,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'status'    => true,
            'message'   => 'Product added to cart!',
            'cartCount' => collect($cart)->sum('quantity')
        ]);
    }

    public function updateShipping(Request $request)
    {
        $request->validate([
            'state' => 'required|exists:states,id',
            'district' => 'required|exists:districts,id',
            'pincode' => 'required|string',
        ]);

        session([
            'shipping_state' => $request->state,
            'shipping_district' => $request->district,
            'shipping_pincode' => $request->pincode,
        ]);

        $cartItems = session()->get('cart', []);
        $subtotal = 0;

        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shipping = 50; // Or dynamic calculation

        $total = $subtotal + $shipping;

        return redirect()->route('home')
            ->with('success', 'Shipping info updated')
            ->with(compact('subtotal', 'shipping', 'total'));
    }

    public function checkout()
    {
        $products = session()->get('cart', []);
        $cartSubtotal = 0;

        foreach ($products as $product) {
            $cartSubtotal += $product['price'] * $product['quantity'];
        }

        $shippingCharge = $cartSubtotal > 50 ? 0 : 15;

        $orderTotal = $cartSubtotal + $shippingCharge;

        $paymentMethods = [
            'credit_card' => 'Credit Card',
            'paypal' => 'PayPal',
            'merchant_card' => 'Merchant Credit Card',
            'pickup' => 'Payment Upon Pickup',
        ];

        return view('frontend.shop.checkout', compact('products', 'cartSubtotal', 'shippingCharge', 'orderTotal', 'paymentMethods'));
    }

    public function submitcheckout(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string',
            'shipping_address' => 'required|array|min:7',
            'shipping_address.*' => 'required|string',
            'billing_details' => 'required|array|min:7',
            'billing_details.*' => 'required|string',
        ]);

        $order = new \App\Models\Order();
        $order->user_id = auth()->id();
        $order->payment_method = $request->payment_method;
        $order->shipping_address = json_encode($request->shipping_address);
        $order->billing_details = json_encode($request->billing_details);

        $order->save();

        return redirect()->route('shop')->with('success', 'Order placed successfully!');
    }
}
