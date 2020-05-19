<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();

        return view('admin.customers.index', compact('customers'));
    }
    public function loadcustomers()
    {
        $customers = Customer::all();
        return response()->json([
            'customers'=>$customers
        ],200);
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname'     =>  'required|alpha_num',
            'lastname'      => 'required|alpha_num',
            'phone'         =>  'required|regex:/(0)[0-9]{9}/',
            'shop_name'     =>  'required',
            'shop_address'  =>  'required'
        ]);

        $customer = new Customer();

        $customer->firstname = $request['firstname'];
        $customer->lastname = $request['lastname'];
        $customer->phone = $request['phone'];
        $customer->shop_name = $request['shop_name'];
        $customer->shop_address = $request['shop_address'];


        $customer->save();

        return redirect()->back()->with('success', ['Customer added successfully']);   
    }

    public function edit($id)
    {
        $targetedCustomer = Customer::findOrFail($id);

        return view('admin.customers.edit', compact( 'targetedCustomer'));
    }

    public function update(Request $request,$id)
    {
        $targetCustomer = Customer::findOrFail($id);

        $this->validate($request, [
            'firstname'     =>  'required|alpha_num|min:2',
            'lastname'      => 'required|alpha_num|min:2',
            'phone'         =>  'required|regex:/(0)[0-9]{9}/',
            'shop_name'     =>  'required',
            'shop_address'  =>  'required'
        ]);

        $input = $request->all();
        $targetCustomer->update($input);

        return redirect()->back()->with('success', ['Customer updated successfully']);   

    }

    public function show($id)
    {
        $targetedCustomer = Customer::findOrFail($id);
        // $invoices = $targetedCustomer->invoices;
        $invoices = Invoice::where('customer_id', $targetedCustomer['id'])->get();
        $products = Product::all();

        $target_products = [];
        

        foreach($invoices as $invoice)
        {
            foreach($invoice->invoice_items as $item)
            {
                $id = $item['product_id'];
                $quantity = $item['quantity'];
                if(array_key_exists($id,$target_products))
                {
                    $old_quantity = $target_products[$id];
                    $quantity += $old_quantity;
                }else{
                    $quantity = $item['quantity'];
                }
                $target_products[$id] = $quantity;
            }
            
        }
        
        return view('admin.customers.show',['targetedCustomer'=>$targetedCustomer,
                                        'invoices'=>$invoices,'target_products'=>$target_products,
                                        'products'=>$products]);
    }

    

    public function search()
    {
        $results = Customer::orderBy('firstname')
            ->when(request('q'), function($query) {
                $query->where('firstname', 'like', '%'.request('q').'%')
                    ->orWhere('lastname', 'like', '%'.request('q').'%')
                    ->orWhere('shop_name', 'like', '%'.request('q').'%')
                    ->orWhere('shop_address', 'like', '%'.request('q').'%')
                    ;
            })
            ->limit(6)
            ->get();

        return response()
            ->json(['results' => $results]);
    }

    public function delete($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->back()->with('success', ['Customer delete successfully']);   

    }
}
