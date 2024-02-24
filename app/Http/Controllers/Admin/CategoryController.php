<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.categories.index')->only('index');
        $this->middleware('can:admin.categories.create')->only('create', 'store');
        $this->middleware('can:admin.categories.edit')->only('edit','update');
        $this->middleware('can:admin.categories.delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // * validations
        $request->validate([
            'name' => 'required|string|max:30|unique:categories',
            'slug' => 'required|lowercase|unique:categories'
        ]);

        Category::create($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'La categoría se creó con exito');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => "required|string|max:30|unique:categories,name,$category->id",
            'slug' => "required|lowercase|unique:categories,slug,$category->id"
        ]);

        $category->update($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'La categoría se actualizó con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'La categoría se eliminó con exito');
    }
}
