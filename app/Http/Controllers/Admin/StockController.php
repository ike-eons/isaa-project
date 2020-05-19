<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Stock;
use App\Models\Counter;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::all();
        return view('admin.stocks.index',compact('stocks'));
    }

    public function allstocks()
    {
        $results = Stock::with(['distributor'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return response()
            ->json(['results' => $results]);
    }

    public function loadStockForm()
    {
        $counter = Counter::where('key', 'stock')->first();

        $form = [
            'number' => $counter->prefix . $counter->value,
            'distributor_id' => null,
            'distributor' => null,
            'date' => date('Y-m-d'),
            'total'=> 0,
            'reference' => null,
            'stock_items' => [
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

    public function create()
    {
        $counter = Counter::where('key', 'stock')->first();

        $form = [
            'number' => $counter->prefix . $counter->value,
            'distributor_id' => null,
            'distributor' => null,
            'date' => date('Y-m-d'),
            'reference' => null,
            'total' => 0.00,
            'stock_items' => [
                [
                    'product_id' => null,
                    'product' => null,
                    'unit_price' => 0,
                    'quantity' => 1
                ]
            ]
        ];

        return view('admin.stocks.create',['counter' => $counter,'form'=> $form]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'distributor_id' => 'required|integer|exists:distributors,id',
            'date' => 'required|date_format:Y-m-d',
            'reference' => 'required|nullable|max:100',
            'total'     => 'required',
            'stock_items' => 'required|array|min:1',
            'stock_items.*.product_id' => 'required|integer|exists:products,id',
            'stock_items.*.unit_price' => 'required|numeric|min:0',
            'stock_items.*.quantity' => 'required|integer|min:1'
        ]);

        $stock = new Stock;
        $stock->fill($request->except('stock_items'));

        // $stock->total = collect($request->stock_items)->sum(function($stock_item) {
        //     return $stock_item['quantity'] * $stock_item['unit_price'];
        // });

        
        $stock = DB::transaction(function() use ($stock, $request) {
            $counter = Counter::where('key', 'stock')->first();
            $stock->number = $counter->prefix . $counter->value;

            // custom method from app/Helper/HasManyRelation
            $stock->storeHasMany([
                'stock_items' => $request->stock_items
            ]);

            $counter->increment('value');

            return $stock;
        });

        foreach( $stock->stock_items as $item)
        {
            DB::table('inventories')->where('product_id',$item['product_id'])->update([
                'available_quantity' => DB::raw('available_quantity + ' . $item["quantity"]),
                'available_amount' => DB::raw('available_amount + ' . $item["unit_price"]),
            ]);
            
        }

        $created_at = Carbon::now();

        DB::table('transactions')->insert([
            'invoice_or_stock' => 'stock',
            'number'    =>  $stock['number'],
            'amount'    => $stock['total']
        ]);

        return response()
            ->json(['saved' => true, 'id' => $stock->id],200);
            // ->json(['message'=>'ok']);
           
    }

    public function show($id)
    {
        $stock = Stock::findOrFail($id);

        return view('admin.stocks.show',['stock'=>$stock]);
    }
    public function show_stocks($id)
    {
        $model = Stock::with(['distributor', 'stock_items.product'])
            ->findOrFail($id);

        return response()
            ->json(['model' => $model]);
    }

    public function edit($id)
    {
        $form = Stock::with(['distributor', 'stock_items.product'])
            ->findOrFail($id);

        return response()
            ->json(['form' => $form]);
    }

    public function update($id, Request $request)
    {
        $stock = Stock::findOrFail($id);

        $request->validate([
            'distributor_id' => 'required|integer|exists:distributors,id',
            'date' => 'required|date',
            'reference' => 'nullable|max:100',
            'total' =>  'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'stock_items' => 'required|array|min:1',
            'stock_items.*.id' => 'sometimes|required|integer|exists:stock_stock_items,id,stock_id,'.$stock->id,
            'stock_items.*.product_id' => 'required|integer|exists:products,id',
            'stock_items.*.unit_price' => 'required|numeric|min:0',
            'stock_items.*.quantity' => 'required|integer|min:1'
        ]);

        $stock->fill($request->except('stock_items'));

        // $stock->sub_total = collect($request->stock_items)->sum(function($stock_item) {
        //     return $stock_item['quantity'] * $stock_item['unit_price'];
        // });

        $stock = DB::transaction(function() use ($stock, $request) {
            // custom method from app/Helper/HasManyRelation
            $stock->updateHasMany([
                'stock_items' => $request->stock_items
            ]);

            return $stock;
        });

        return response()
            ->json(['saved' => true, 'id' => $stock->id]);
    }

    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);

        $stock->stock_items()->delete();

        $stock->delete();

        return response()
            ->json(['deleted' => true]);
    }

    

    
}
