<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         
        $this->validate($request, [
            'name' => 'required|unique:categories|max:255',
            'color' => 'required|max:7',
        ]);
        $category =  new Category();
        $category->name = $request->name;
        $category->color= $request->color;
        if($category->save()){
            return redirect()->route('categories.index')->with('success', 'Categoria creada correctamente');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $category)
    {
        $category = Category::find($category);
        return view('categories.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $category)
    {
        $category = Category::find($category);
        $category->name = $request->name;
        $category->color=$request->color;
        if ($category->save()){
            return redirect()->route('categories.index')->with('success', 'Categoria actualizada correctamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $category)
    {
        $category = Category::find($category);
        $category->todos()->each(function($todo) {
            $todo->delete(); 
         });
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Categoria eliminada correctamente');
    }
}
