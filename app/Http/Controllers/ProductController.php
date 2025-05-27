<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Display all products with filtering, sorting and pagination
    public function index(Request $request)
    {
        $perPage   = $request->get('per_page', 10);
        $sortBy    = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $search    = $request->input('search');

        $products = Product::with('category')
            ->when($search, function ($query) use ($search) {
                $query->where('product_name', 'LIKE', "%$search%")
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'LIKE', "%$search%");
                    });
            })
            ->orderBy($sortBy, $sortOrder)
            ->paginate($perPage)
            ->appends($request->only(['search', 'sort_by', 'sort_order', 'per_page']));

        return view('products.index', compact('products', 'perPage', 'sortBy', 'sortOrder'));
    }

    // Show single product
   public function info($id)
    {
        $productInfo = Product::with('category')->findOrFail($id);
        return view('products.show', compact('productInfo'));
    }


    // Show create form
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // Store new product
    public function store(Request $request)
    {
        $request->validate([
            'category_id'               => 'required|exists:categories,id',
            'product_name'              => 'required|string|max:255',
            'product_short_description' => 'required|string',
            'product_long_description'  => 'required|string',
            'product_price'             => 'required|numeric|min:0',
            'product_review_star'       => 'required|numeric|between:1,5',
            'product_image'             => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time() . '-' . Str::slug($request->product_name) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('products', $imageName, 'public');
        }

        Product::create([
            'category_id'               => $request->category_id,
            'product_name'              => $request->product_name,
            'discount_percentage'       => $request->discount_percentage ?? 0,
            'product_short_description' => $request->product_short_description,
            'product_long_description'  => $request->product_long_description,
            'product_price'             => $request->product_price,
            'product_review_star'       => $request->product_review_star,
            'product_image'             => $imageName,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    // Show edit form
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    // Update product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'category_id'               => 'required|exists:categories,id',
            'product_name'              => 'required|string|max:255',
            'discount_percentage'       => 'nullable|numeric|min:0|max:100',
            'product_short_description' => 'required|string',
            'product_long_description'  => 'required|string',
            'product_price'             => 'required|numeric|min:0',
            'product_review_star'       => 'required|numeric|min:1|max:5',
            'product_image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imageName = $product->product_image;

        if ($request->hasFile('product_image')) {
            if ($imageName && Storage::disk('public')->exists('products/' . $imageName)) {
                Storage::disk('public')->delete('products/' . $imageName);
            }

            $image = $request->file('product_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('products', $imageName, 'public');
        }

        $product->update([
            'category_id'               => $request->category_id,
            'product_name'              => $request->product_name,
            'discount_percentage'       => $request->discount_percentage ?? 0,
            'product_short_description' => $request->product_short_description,
            'product_long_description'  => $request->product_long_description,
            'product_price'             => $request->product_price,
            'product_review_star'       => $request->product_review_star,
            'product_image'             => $imageName,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // Delete product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->product_image && Storage::disk('public')->exists('products/' . $product->product_image)) {
            Storage::disk('public')->delete('products/' . $product->product_image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
