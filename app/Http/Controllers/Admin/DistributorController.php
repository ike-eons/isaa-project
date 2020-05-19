<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Distributor;

class DistributorController extends Controller
{
    public function index()
    {
        $distributors = Distributor::all();

        return view('admin.distributors.index', compact('distributors'));
    }

    public function loaddistributors()
    {
        $distributors = Distributor::all();
        return response()->json([
            'distributors'=>$distributors
        ],200);
    }
    
    public function create()
    {
        return view('admin.distributors.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
                'company_name' => 'required',
                'address'   => 'required',
                'phone'     => 'required|regex:/(0)[0-9]{9}/',
                'email'     => 'required|email'
        ]);

        $distributor = new Distributor();

        $distributor->company_name = $request['company_name'];
        $distributor->address  = $request['address'];
        $distributor->phone = $request['phone'];
        $distributor->email = $request['email'];

        $distributor->save();
        return redirect()->back()->with('success', ['Distributor added successfully']);   
    }
    public function edit($id)
    {
        $targetDistributor = Distributor::findOrFail($id);
        return view('admin.distributors.edit',['targetDistributor' => $targetDistributor]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'company_name' => 'required',
            'address'   => 'required',
            'phone'     => 'required|regex:/(0)[0-9]{9}/',
            'email'     => 'required|email'
        ]);

        $input = $request->all();
        $targetDistributor->update($input);

        return redirect()->back()->with('success',['distributor updated']);
    }
    public function delete($id)
    {
        $distributor = Distributor::findOrFail($id);
        $distributor->delete();

        return redirect()->back()->with('success', ['Customer delete successfully']); 
    }
}
