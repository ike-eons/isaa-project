<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();

        return view('admin.brands.index', compact('brands'));
    
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required',
        ]);

        $brand = new Brand();
        $brand->name = $request['name'];

        $brand->save();

        return redirect()->back()->with('success', ['Brand added successfully']);   
        
    }
    public function edit($id)
    {
        $targetBrand = Brand::findOrFail($id);

        return view('admin.brands.edit', compact( 'targetBrand'));
    }

    public function update(Request $request,$id)
    {
        $targetBrand = Brand::findOrFail($id);

        $this->validate($request, [
            'name'      =>  'required|alpha_num|unique:brands|max:191',
        ]);

        $input = $request->all();
        $targetBrand->fill($input)->save();

        return redirect()->back()->with('success', ['Brand added successfully']);   

    }


     public function delete($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return redirect()->back()->with('success', ['Brand delete successfully']);   

    }
}
