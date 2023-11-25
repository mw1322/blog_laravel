<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

use function League\Flysystem\get;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\PostFormRequest;
use Illuminate\Support\Str;

class PostController extends Controller
{
    //
    public function index()
    {
        $posts = Post::all();
        return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        $category = Category::where('status', '0')->get();
        return view('admin.post.create', compact('category'));
    }
    public function store(PostFormRequest $request)
    {
        $data = $request->validated();

        $post = new Post;
        $post->category_id = $data['category_id'];
        $post->name = $data['name'];
        $post->slug = Str::slug($data['slug']); // Fill in the slug
        $post->description = $data['description']; // Fill in the description
        $post->yt_iframe = $data['yt_iframe']; // Fill in the YouTube iframe link

        // Fill in SEO tags
        $post->meta_title = $data['meta_title'];
        $post->meta_description = $data['meta_description'];
        $post->meta_keyword = $data['meta_keyword'];

        // Fill in Status
        $post->status = $request->status == true ? '1' : '0';
        $post->created_by = Auth::user()->id;

        $post->save(); // Save the post to the database

        return redirect('admin/posts')->with('message', 'Post added successfully');
    }
    public function edit($post_id)
    {
        $category = Category::where('status', '0')->get();
        $post = Post::find($post_id);
        return view("admin/post/edit", compact('post', 'category'));
    }
    public function update(PostFormRequest $request, $post_id)
    {
        $data = $request->validated();

        $post = Post::find($post_id);
        $post->category_id = $data['category_id'];
        $post->name = $data['name'];
        $post->slug = Str::slug($data['slug']); // Fill in the slug
        $post->description = $data['description']; // Fill in the description
        $post->yt_iframe = $data['yt_iframe']; // Fill in the YouTube iframe link

        // Fill in SEO tags
        $post->meta_title = $data['meta_title'];
        $post->meta_description = $data['meta_description'];
        $post->meta_keyword = $data['meta_keyword'];

        // Fill in Status
        $post->status = $request->status == true ? '1' : '0';
        $post->created_by = Auth::user()->id;

        $post->update(); // Save the post to the database

        return redirect('admin/posts')->with('message', 'Post updated successfully');
    }
    public function delete($post_id)
    {
        $post = Post::find($post_id);
        if ($post) {
            $post->delete();
            return redirect('admin/posts')->with('message', 'Post updated successfully');
        }
        return redirect('admin/posts')->with('message', 'Post denied');
    }
}
