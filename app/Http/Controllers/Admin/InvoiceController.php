<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Counter;
use DB;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();
        return view('admin.invoices.index',['invoices'=>$invoices]);
    }

    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);

        return view('admin.invoices.show',['invoice'=>$invoice]);
    }

    public function loadInvoice()
    {
        $invoices = Invoice::with(['customer'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return response()
            ->json(['invoices' => $invoices]);
    }

    public function create()
    {
        return view('admin.invoices.create');
    }
    public function loadInvoiceForm()
    {
        $counter = Counter::where('key', 'invoice')->first();
        
        $form = [
            'number' => $counter->prefix. $counter->value,
            'customer_id' => null,
            'customer' => null,
            'date' => date('Y-m-d'),
            'due_date' => date('Y-m-d'),
            'total' => 0.00,
            'reference' => '#EMJ19-2020',
            'invoice_items' => [
                [
                    'product_id' => null,
                    'product' => null,
                    'unit_price' => 0,
                    'quantity' => 1
                ]
            ]
        ];

        return response()
            ->json(['form' => $form]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|integer|exists:customers,id',
            'date' => 'required|date_format:Y-m-d',
            'due_date' => 'required|date_format:Y-m-d',
            'reference' => 'nullable|max:100',
            'total'     => 'required',
            'invoice_items' => 'required|array|min:1',
            'invoice_items.*.product_id' => 'required|integer',
            'invoice_items.*.unit_price' => 'required|numeric|min:0',
            'invoice_items.*.quantity' => 'required|integer|min:1'
        ]);

        $invoice = new Invoice;
        $invoice->fill($request->except('invoice_items'));

        $invoice = DB::transaction(function() use ($invoice, $request) {
            $counter = Counter::where('key', 'invoice')->first();
            $invoice->number = $counter->prefix . $counter->value;

            // custom method from app/Helper/HasManyRelation
            $invoice->storeHasMany([
                'invoice_items' => $request->invoice_items
            ]);

            $counter->increment('value');

            return $invoice;
        });

        foreach( $invoice->invoice_items as $item)
        {
            DB::table('inventories')->where('product_id',$item['product_id'])->update([
                'available_quantity' => DB::raw('available_quantity - ' . $item["quantity"]),
                'available_amount' => DB::raw('available_amount - ' . $item["unit_price"]),
            ]);
            
        }
        // $created_at = Carbon::now();

        DB::table('transactions')->insert([
            'invoice_or_stock' => 'invoice',
            'number' => $invoice['number'],
            'amount' => $invoice['total'],
            // 'create_at' => Carbon::now()
        ]);


        return response()
            ->json(['saved' => true, 'id' => $invoice->id],200);
            // ->json(['message'=>'ok']);
           
    }

}

