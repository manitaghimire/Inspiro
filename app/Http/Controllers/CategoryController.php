<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories=Category::all();
        return view('Categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validatedData=$request->validated();
        if($request->hasfile('icon'))
        {
            $iconPath=$request->file('icon')->store('icons','public');
            $validatedData['icon']=$iconPath;
        }
        Category::create($validatedData);
        return redirect()->route('categories.index')->with('success', 'Category added successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
       
        $category->load([
            'uploads' => function ($query) {
                $query->latest('created_at'); 
            },
            'uploads.tags',
            'uploads.user'
        ]);
        
        return view('categories.show', compact('category'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, Category $category)
    {
        //
        
        $validatedData=$request->validated();
        if($request->hasfile('icon'))
        {
            $imgfile=$request->file('icon');
            $iconPath=$imgfile->store('icons','public');

            // if ($category->icon) {
            //     Storage::delete('public/icons/' . $category->icon);
            // }

            $validatedData['icon']=$iconPath;
        }
        else
        {
            $validatedData['icon']=$category->icon;
        }

        $category->update($validatedData);
        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category successfully deleted!');
    }
}
