<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog; 
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;


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
        'blog_title' => 'required|string|max:255',
        'blog_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    if ($request->hasFile('blog_image')) {
        $image = $request->file('blog_image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('storage/blogs'), $imageName);
    } else {
        $imageName = 'default.jpg';
    }

    Blog::create([
        'blog_title' => $request->input('blog_title'),
        'blog_image' => $imageName,
    ]);

    return redirect()->route('blogs.index')->with('success', 'Blog created successfully!');
}
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'blog_title' => 'required|string|max:255',
            'blog_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $blog = Blog::findOrFail($id);
        $blog->blog_title = $request->blog_title;

        if ($request->hasFile('blog_image')) {
            $image = $request->file('blog_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('storage/blogs'), $imageName);
            $blog->blog_image = $imageName;
        }

        $blog->save();

        return redirect()->route('blogs.show', $blog->id)->with('success', 'Blog updated successfully!');
    }
    public function show($id)
{
    $blog = Blog::findOrFail($id);
    return view('blogs.show', compact('blog'));
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
