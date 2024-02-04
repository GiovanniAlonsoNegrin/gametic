<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    const COLORS = [
        'red' => 'Rojo',
        'yellow' => 'Amarillo',
        'green' => 'Verde',
        'blue' => 'Azul',
        'indigo' => 'Indigo',
        'purple' => 'Púrpura',
        'pink' => 'Rosa'
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();

        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $colors = self::COLORS;
        return view('admin.tags.create', compact('colors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:tags',
            'slug' => 'required|string|unique:tags',
            'color' => 'required|string|in:red,yellow,green,blue,indigo,purple,pink'
        ]);

        Tag::create($request->all());

        return redirect()->route('admin.tags.index')->with('success', 'La etiqueta se creó con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return view('admin.tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        $colors = self::COLORS;
        return view('admin.tags.edit', compact('tag', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => "required|string|unique:tags,name,$tag->id",
            'slug' => "required|string|unique:tags,slug,$tag->id",
            'color' => 'required|string|in:red,yellow,green,blue,indigo,purple,pink'
        ]);

        $tag->update($request->all());

        return redirect()->route('admin.tags.index')->with('success', 'La etiqueta se actualizó con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('admin.tags.index')->with('success', 'La etiqueta se eliminó con exito');
    }
}
