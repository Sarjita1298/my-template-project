<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        $query = Category::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_ids')) {
            $query->whereIn('id', $request->category_ids);
        }

        $query->orderBy($sortBy, $sortOrder);

        $categories = $query->paginate($perPage)->withQueryString();
        $allCategories = Category::select('id', 'name')->orderBy('name')->get();

        return view('categories.index', compact('categories', 'allCategories', 'perPage'));
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
        // Normalize the name (trim, remove extra spaces)
        $name = trim(preg_replace('/\s+/', ' ', $request->name));
        $request->merge(['name' => $name]);

        // Check if normalized name exists (case-insensitive)
        $exists = Category::whereRaw('LOWER(name) = ?', [strtolower($name)])->exists();
        if ($exists) {
            return redirect()->back()->withErrors(['name' => 'This category already exists.'])->withInput();
        }

        $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . Str::slug($name) . '.' . $request->image->extension();
            $request->image->storeAs('public/category_images', $imageName);
        }

        Category::create([
            'name'  => $name,
            'slug'  => Str::slug($name),
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
        // Normalize the name
        $name = trim(preg_replace('/\s+/', ' ', $request->name));
        $request->merge(['name' => $name]);

        // Check if same name exists in another category
        $exists = Category::whereRaw('LOWER(name) = ?', [strtolower($name)])
            ->where('id', '!=', $category->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors(['name' => 'Another category with this name already exists.'])->withInput();
        }

        $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category->name = $name;
        $category->slug = Str::slug($name);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . Str::slug($name) . '.' . $request->image->extension();
            $request->image->storeAs('public/category_images', $imageName);
            $category->image = $imageName;
        }

        $category->save();

        return redirect()->route('categories.show', $category->slug)->with('success', 'Category updated successfully!');
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
