<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostCategory;
use App\Models\Post;

class AdminPostCategoryController extends Controller
{
    public function index()
    {
        $post_categories = PostCategory::all();
        return view('admin.post_category.index', compact('post_categories'));
    }

    public function create()
    {
        return view('admin.post_category.create');
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:post_categories'],
            'slug' => ['required', 'alpha_dash', 'unique:post_categories']
        ]);

        $obj = new PostCategory();
        $obj->name = $request->name;
        $obj->slug = strtolower($request->slug);
        $obj->save();

        return redirect()->route('admin_post_category_index')->with('success','Post Category created successfully');
    }

    public function edit($id)
    {
        $post_category = PostCategory::findOrFail($id);
        return view('admin.post_category.edit', compact('post_category'));
    }

    public function edit_submit(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'unique:post_categories,name,'.$id],
            'slug' => ['required', 'alpha_dash', 'unique:post_categories,slug,'.$id]
        ]);

        $obj = PostCategory::findOrFail($id);
        $obj->name = $request->name;
        $obj->slug = strtolower($request->slug);
        $obj->update();

        return redirect()->route('admin_post_category_index')->with('success','Post Category updated successfully');
    }

    public function delete($id)
    {
        $posts = Post::where('post_category_id', $id)->get();
        foreach($posts as $post) {
            unlink(public_path('uploads/'.$post->photo));
        }

        Post::where('post_category_id',$id)->delete();
        PostCategory::where('id',$id)->delete();

        return redirect()->back()->with('success','Post Category deleted successfully');
    }
}
