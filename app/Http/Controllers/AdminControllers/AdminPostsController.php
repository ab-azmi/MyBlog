<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class AdminPostsController extends Controller
{
    private $rules = [
        'title' => 'required|max:200',
        'slug' => 'required|max:200',
        'excerpt' => 'required|max:300',
        'category_id' => 'required|numeric',
        'thumbnail' => 'required|file|mimes:jpg,png,svg,webp,jpeg',
        'body' => 'required|min:50',
    ];

    public function index()
    {
        return view('admin_dashboard.posts.index', [
            'posts' => Post::with('category')->paginate(50),
        ]);
    }

    public function create()
    {
        return view('admin_dashboard.posts.create', [
            'categories' => Category::pluck('name', 'id'),
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);
        $validated['user_id'] = auth()->id();
        $post = Post::create($validated);

        if (request()->has('thumbnail')) {
            $thumbnail = request()->file('thumbnail');
            $filename = $thumbnail->getClientOriginalName();
            $file_extension = $thumbnail->getClientOriginalExtension();
            $path = $thumbnail->store('images', 'public');

            $post->image()->create([
                'name' => $filename,
                'extension' => $file_extension,
                'path' => $path,
            ]);
        }

        $tags = explode(',', $request->input('tags'));
        $tags_ids = [];
        foreach ($tags as $tag) {
            $tag_ob = Tag::create(['name' => $tag]);
            $tags_ids[] = $tag_ob->id;
        }

        if (count($tags_ids) > 0)
            $post->tags()->sync($tags_ids);

        return redirect()->route('admin.posts.create')->with('success', 'Post has been created');
    }

    public function show($id)
    {
        //
    }

    public function edit(Post $post)
    {
        $tags = '';
        foreach ($post->tags as $tag) {
            $tags .= $tag->name . ',';
        }
        return view('admin_dashboard.posts.edit', [
            'tags' => $tags,
            'post' => $post,
            'categories' => Category::pluck('name', 'id'),
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $this->rules['thumbnail'] = 'nullable|file|mimes:jpg,png,svg,webp,jpeg';
        $validated = $request->validate($this->rules);

        $post->update($validated);

        if (request()->has('thumbnail')) {
            $thumbnail = request()->file('thumbnail');
            $filename = $thumbnail->getClientOriginalName();
            $file_extension = $thumbnail->getClientOriginalExtension();
            $path = $thumbnail->store('images', 'public');

            $post->image()->update([
                'name' => $filename,
                'extension' => $file_extension,
                'path' => $path,
            ]);
        }

        $tags = explode(',', $request->input('tags'));
        $tags_ids = [];
        foreach ($tags as $tag) {
            $tag_exist = $post->tags()->where('name', trim($tag))->count();
            if ($tag_exist == 0) {
                $tag_ob = Tag::create(['name' => $tag]);
                $tags_ids[] = $tag_ob->id;
            }
        }

        if (count($tags_ids) > 0) {
            $post->tags()->syncWithoutDetaching($tags_ids);
        }

        return redirect()->route('admin.posts.edit', $post)->with('success', 'Post has been updated');
    }


    public function destroy(Post $post)
    {
        $post->tags()->delete();
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post has been deleted');
    }
}
