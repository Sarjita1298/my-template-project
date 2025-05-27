<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog; 
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class BlogController extends Controller
{
public function index(Request $request)
{
    $blogs = Blog::orderBy('created_at', 'desc')->paginate(10);
    return view('blogs.index', compact('blogs'));
}
public function create(Request $request)
{
    return view('blogs.create');
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:blogs,slug',
        'content' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $data = $request->only('title', 'slug', 'content');

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('uploads/blogs'), $imageName);
        $data['image'] = 'uploads/blogs/' . $imageName;
    }

    Blog::create($data);

    return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
}


    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.edit', compact('blog'));
    }

 public function update(Request $request, $id)
{
    $blog = Blog::findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:blogs,slug,' . $blog->id,
        'content' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $data = $request->only('title', 'slug', 'content');

    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($blog->image && file_exists(public_path($blog->image))) {
            unlink(public_path($blog->image));
        }

        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('uploads/blogs'), $imageName);
        $data['image'] = 'uploads/blogs/' . $imageName;
    }

    $blog->update($data);

    return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
}

        public function info($id)
        {
            $bloginfo = Blog::findOrFail($id);
            return view('blogs.show', compact('bloginfo'));
        }

        public function destroy($id)
        {
            $blog = Blog::findOrFail($id);

            $imagePath = public_path('uploads/blogs/' . $blog->blog_image);

            if ($blog->blog_image && file_exists($imagePath)) {
                unlink($imagePath);
            }

            $blog->delete();

            return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
        }


}
