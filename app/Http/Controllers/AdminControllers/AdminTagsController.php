<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class AdminTagsController extends Controller
{
    public function index(){
        $tags = Tag::with('posts')->paginate(50);
        return view('admin_dashboard.tags.index',[
            'tags' => $tags,
        ]);
    }

    public function show(Tag $tag){
        return view('admin_dashboard.tags.show', [
            'posts' => $tag->posts()->paginate(50),
            'tag' => $tag,
        ]);
    }

    public function destroy(Tag $tag){
        $tag->posts()->detach();
        $tag->delete();
        return redirect()->route('admin.tags.index')->with('success', 'Tag has been deleted');
    }
}
