<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
 public function index(Request $request)
{
    $perPage = $request->get('per_page', 10);
    $sortBy = $request->get('sort_by', 'created_at');
    $sortOrder = $request->get('sort_order', 'desc');
    $search = $request->input('search');

    $products = Product::with('category')
        ->when($search, function ($query) use ($search) {
            $query->where('name', 'LIKE', "%$search%")
                  ->orWhereHas('category', function ($q) use ($search) {
                      $q->where('name', 'LIKE', "%$search%");
                  });
        })
        ->orderBy($sortBy, $sortOrder)
        ->paginate($perPage)
        ->appends($request->only(['search', 'sort_by', 'sort_order', 'per_page']));

    return view('products.index', compact('products', 'perPage', 'sortBy', 'sortOrder'));
}


    //     public function index(Request $request)
    // {
    //     $query = Product::with('category'); 

    //     if ($request->has('search') && $request->search != '') {
    //         $query->where('name', 'like', '%' . $request->search . '%');
    //     }

    //     $products = $query->orderBy('created_at', 'desc')->paginate(10);

    //     return view('products.index', compact('products'));
    // }
 // public function create()
    // {
    //     $categories = Category::all(); 
    //     return view('products.create', compact('categories')); 
    // }
    
//    public function store(Request $request)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'category_id' => 'required|exists:categories,id',
//             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//         ]);
    
//         $imageName = null;
    
//         if ($request->hasFile('image')) {
//             $imageName = time() . '_' . Str::slug($request->name) . '.' . $request->image->extension();
//             $request->image->storeAs('product_image', $imageName, 'public');
//         }
    
//         Product::create([
//             'name' => $request->name,
//             'category_id' => $request->category_id,
//             'image' => $imageName,
//         ]);
    
//         return redirect()->route('products.index')->with('success', 'Product created successfully.');
//     }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    // Create method to display the product creation form
    public function create()
    {
        $categories = Category::all(); 
        return view('products.create', compact('categories')); 
    }

    // Store method to handle the product creation and file upload
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
        ]);
  

        $imageName = null;
    
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $request->image->extension();
            $request->image->storeAs('product_image', $imageName, 'public');
        }
    
        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'image' => $imageName,
        ]);
    
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

        public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

        public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);
        
        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
        ]);
    
        // Redirect to the product's details page
        return redirect()->route('products.show', $product->id)->with('success', 'Product updated successfully!');
    }
    

    // Destroy method to handle product deletion
 public function destroy($id)
{
    $product = Product::findOrFail($id);

    // Delete the product's image if it exists
    $imagePath = public_path('storage/product_image/' . $product->image);
    if ($product->image && file_exists($imagePath)) {
        unlink($imagePath);
    }

    $product->delete();

    return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
}

 
}
