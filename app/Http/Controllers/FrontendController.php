<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Subscriber;
use App\Models\Order;
use App\Models\Category; 
use App\Models\State;
use App\Models\District;
use App\Models\Pincode;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    // Homepage with products and user
    public function index()
    {
        $user = Auth::user();
        $products = Product::latest()->paginate(12);
        return view("frontend.index", compact('user', 'products'));
    }

    // Static home page
    public function home()
    {
        return view("frontend.home");
    }

    // Contact form page
    public function contact()
    {
        return view("frontend.contact");
    }

    // Contact form submission
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        // Handle sending email or saving contact info here if needed

        return redirect()->route('contact')->with('success', 'Your message has been sent successfully!');
    }


public function shop(Request $request)
{
    $sort = $request->get('sort');
    $categoryId = $request->get('category_id');

    $query = Product::query();

    // Category filter
    if ($categoryId) {
        $query->where('category_id', $categoryId);
    }

    // Sorting
    switch ($sort) {
        case 'popularity':
            $query->orderBy('popularity', 'desc');
            break;
        case 'rating':
            $query->orderBy('rating', 'desc');
            break;
        case 'date':
            $query->latest();
            break;
        case 'price':
            $query->orderBy('price', 'asc');
            break;
        case 'price-desc':
            $query->orderBy('price', 'desc');
            break;
        default:
            $query->latest();
    }

    $products = $query->paginate(12);
    $categories = Category::all(); // ✅ Define the categories

    return view('frontend.shop.shop', compact('products', 'categories'));
}


    // Show all products (could be used to list products without sorting)
    public function showProducts()
    {
        $products = Product::latest()->paginate(12);
        return view('frontend.shop.shop', compact('products'));
    }

    // Show single product by ID (you must pass $id)
    public function showSingleProduct($id)
    {
        $product = Product::findOrFail($id); // fetch product or throw 404
        return view('frontend.shop.single', compact('product'));
    }

    // Customer account page
    public function account()
    {
        return view('frontend.customer.account');
    }

    // Blog listing page
    public function blog()
    {
        return view('frontend.blog.blog');
    }

    // Single blog post page
    public function singleblog()
    {
        return view('frontend.blog.singleblog');
    }


public function cart()
{
    $cart = session()->get('cart', []);

    return view('frontend.shop.cart', compact('cart'));
}


public function addToCart(Request $request, $id)
{
    $product = Product::findOrFail($id);
    $quantity = $request->input('quantity', 1);

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['quantity'] += $quantity;
    } else {
        $cart[$id] = [
            "name" => $product->name,
            "price" => $product->price,
            "quantity" => $quantity,
            "image" => $product->image ?? null,
        ];
    }

    session()->put('cart', $cart);

    return redirect()->route('shop')->with('success', 'Product added to cart!');
}

public function remove($id)
{
    $cart = session()->get('cart', []);
    if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }
    return redirect()->back()->with('success', 'Item removed from cart.');
}

// Alias method — can be removed if 'showCart()' is used instead
public function cartpage()
{
    return $this->showCart(); // reuse showCart logic
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

    $states = State::orderBy('name')->get(); // ← Fix: Include states

    return view('frontend.cartadded', compact('cartItems', 'subtotal', 'shipping', 'total', 'states'));
}


public function getDistricts(Request $request)
{
    $districts = District::where('state_id', $request->state_id)->get();
    return response()->json($districts);
}

public function getPincode(Request $request)
{
    $pincode = Pincode::where('district_id', $request->district_id)->first();
    return response()->json($pincode);
}


// Add product to cart using AJAX
// 


    // Checkout page
   public function checkout()
{
    // Cart items from session
    $products = session()->get('cart', []);

    // Calculate subtotal dynamically
    $cartSubtotal = 0;
    foreach ($products as $product) {
        // Assume each product has 'price' and 'quantity'
        $cartSubtotal += $product['price'] * $product['quantity'];
    }

    // Shipping charge logic — aap apne hisaab se change kar sakte hain
    $shippingCharge = $cartSubtotal > 50 ? 0 : 15;

    // Total order amount
    $orderTotal = $cartSubtotal + $shippingCharge;

    // Payment methods (optional, agar chahiye)
    $paymentMethods = [
        'credit_card' => 'Credit Card',
        'paypal' => 'PayPal',
        'merchant_card' => 'Merchant Credit Card',
        'pickup' => 'Payment Upon Pickup',
    ];

    // Pass sab data checkout view ko
    return view('frontend.shop.checkout', compact('products', 'cartSubtotal', 'shippingCharge', 'orderTotal', 'paymentMethods'));
}

public function submitcheckout(Request $request)
{
    // Validation
    $request->validate([
        'payment_method' => 'required|string',
        'shipping_address' => 'required|array|min:7',
        'shipping_address.*' => 'required|string',
        'billing_details' => 'required|array|min:7',
        'billing_details.*' => 'required|string',
    ]);

    // Example: Save data in DB (aapko apne table aur model banaane honge)
    // Yahan main ek example "Order" model use kar raha hoon
    $order = new Order();
    $order->user_id = auth()->id();  // Agar user logged in hai
    $order->payment_method = $request->payment_method;
    $order->shipping_address = json_encode($request->shipping_address);
    $order->billing_details = json_encode($request->billing_details);

    // Optional: total price, order status etc. add kar sakte hain

    $order->save();

    // Redirect with success message
    return redirect()->route('shop')->with('success', 'Order placed successfully!');
}

    // Store subscriber email
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        Subscriber::create([
            'email' => $request->email,
        ]);

        return redirect()->route("home")->with('success', 'Thank you for subscribing!');
    }
}
