<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|alpha_num|unique:categories|min:3',
            'description' => 'required'
        ]);

        $category = new Category();

        $category->name = $request['name'];
        $category->description = $request['description'];


        $category->save();

        return redirect()->back()->with('success', ['Category added successfully']);   
    }

    public function edit($id)
    {
        $targetCategory = Category::findOrFail($id);

        return view('admin.Categories.edit', compact( 'targetCategory'));
    }

    public function update(Request $request,$id)
    {
        $targetCategory = Category::findOrFail($id);

        $this->validate($request, [
            'name'      =>  'required|unique:categories|alpha_num|max:191',
            'description' => 'required'
        ]);

        $input = $request->all();
        $targetCategory->update($input);

        return redirect()->back()->with('success', ['Category added successfully']);   

    }

public function delete($id)
    {
        $Category = Category::findOrFail($id);
        $Category->delete();

        return redirect()->back()->with('success', ['Category delete successfully']);   

    }
}
