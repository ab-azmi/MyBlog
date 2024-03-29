<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminCategoriesController extends Controller
{
    private $rules = [
        'name' => 'required|min:3,max:50',
        'slug' => 'required|unique:categories,slug',
    ];
    
    public function index()
    {
        return view('admin_dashboard.categories.index', [
            'categories' => Category::with('user')->paginate(50),
        ]);
    }

    
    public function create()
    {
        return view('admin_dashboard.categories.create');
    }

    public function store(Request $request)
    {
       $validated = $request->validate($this->rules);
       $validated['user_id'] = auth()->id();
       Category::create($validated);

       return redirect()->route('admin.categories.create')->with('success', 'Category has been created');
    }

    public function show(Category $category)
    {
        return view('admin_dashboard.categories.show', [
            'category' => $category,
        ]);
    }

    
    public function edit(Category $category)
    {
        return view('admin_dashboard.categories.edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $this->rules['slug'] = ['required', Rule::unique('categories')->ignore($category)];
        $validated = $request->validate($this->rules);
        $category->update($validated);

        return redirect()->route('admin.categories.edit', $category)->with('success', 'Category has been edited');
    }

   
    public function destroy(Category $category)
    {
        if($category->name === 'uncategorize'){
            abort(404);
        }
        $default_uncategorized_id = Category::where('name', 'uncategorized')->first()->id; //kategori default
        $category->posts()->update(['category_id' => $default_uncategorized_id]); //post dari kategori yg dihapus akan memiliki kategori default
        $category->delete(); //menghapus kategori
        return redirect()->route('admin.categories.index')->with('success', 'Category has been deleted');
    }
}
