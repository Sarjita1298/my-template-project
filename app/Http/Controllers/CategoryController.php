<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_ids')) {
            $query->whereIn('id', $request->category_ids);
        }

        $categories = $query->latest()->get();
        $allCategories = Category::select('id', 'name')->orderBy('name')->get();

        return view('categories.index', compact('categories', 'allCategories'));
    }

    public function create()
    {
        return view('categories.create');
    }
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        return view('categories.view', compact('category'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255|unique:categories,name',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $request->image->extension();
            $request->image->storeAs('public/category_images', $imageName);
        }

        Category::create([
            'name'  => $request->name,
            'slug'  => Str::slug($request->name),
            'image' => $imageName,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
    
        $category->name = $request->name;
        $category->slug = $request->slug ?? \Str::slug($request->name);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/category_images', $imageName);
            $category->image = $imageName;
        }
    
        $category->save();
    
        return redirect()->route('categories.show', $category->slug)
                         ->with('success', 'Category updated successfully!');
    }
    
    public function destroy($id)
{
    $category = Category::findOrFail($id);

    if ($category->image && file_exists(storage_path('app/public/category_images/' . $category->image))) {
        unlink(storage_path('app/public/category_images/' . $category->image));
    }

    $category->delete();

    return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
}


}

