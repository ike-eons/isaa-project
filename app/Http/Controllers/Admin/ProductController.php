<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\contracts\ProductContract;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;

use Illumintate\Support\Facades\DB;

class ProductController extends BaseController
{
    protected $productRepository;

    public function __construct(ProductContract $productRepository)
    {
        $this->productRepository = $productRepository;
    }

     public function index()
    {
        $products= $this->productRepository->listproducts();

        $this->setPageTitle('Products', 'List of all Products');
        return view('admin.products.index', compact('products'));
    }

    public function loadproducts()
    {
        $products = Product::all();

        return response()->json(
            ['products' => $products]
            ,200);
    }

    public function search()
    {
        $results = Product::orderBy('name')
            ->when(request('q'), function($query) {
                $query->where('name', 'like', '%'.request('q').'%')
                ->orWhere('description', 'like', '%'.request('q').'%');
            })
            ->limit(6)
            ->get();

        return response()
            ->json(['results' => $results]);
    }

    public function create()
    {
        $product = $this->productRepository->listproducts('id', 'asc');
        $brands = Brand::all();
        $categories = Category::all();

        $this->setPageTitle('product', 'Create product');

        return view('admin.products.create', ['product'=>$product,'brands'=>$brands,'categories'=>$categories]);
    }

     public function store(Request $request)
    {
        $this->validate($request, [
            'category_id'               =>  'required|integer',
            'brand_id'                  =>  'required|integer',
            'name'                      =>  'required|unique:products',
            'weight'                    =>  'required|numeric',
            'price'                     =>  'required|numeric',
            'carton_quantity'           =>  'numeric'
        ]);

        $params = $request->except('_token');

        $product = $this->productRepository->createProduct($params);

        //add product to inventory
        DB::table('inventories')->insert([
            'product_id'    =>  $product['id'],
            'available_quantity'    => 0,
            'available_amount'      =>  0.00,
        ]);

        if (!$product) {
            return $this->responseRedirectBack('Error occurred while creating product.', 'error', true, true);
        }
        return $this->responseRedirect('admin.products.index', 'product added successfully' ,'success',false, false);
    }

     public function edit($id)
    {
        $targetProduct = $this->productRepository->findProductById($id);
        
        $product = $this->productRepository->listProducts();

        $this->setPageTitle('Product', 'Edit product : '.$targetProduct->product_name);
        return view('admin.products.edit', compact('product', 'targetProduct'));
    }

    public function update(Request $request)
    {
         $this->validate($request, [
            'category_id'               =>  'required|integer',
            'brand_id'                  =>  'required|integer',
            'name'                      =>  'required|unique:products',
            'weight'                    =>  'required',
            'price'                     =>  'required',
            'carton_quantity'           =>  'required|numeric'
        ]);

        $params = $request->except('_token');

        $product = $this->productRepository->updateProduct($params);

        if (!$product) {
            return $this->responseRedirectBack('Error occurred while updating product.', 'error', true, true);
        }
        return $this->responseRedirectBack('Product updated successfully' ,'success',false, false);
    }


     public function delete($id)
    {
        $product = $this->productRepository->deleteProduct($id);

        if (!$product) {
            return $this->responseRedirectBack('Error occurred while deleting product.', 'error', true, true);
        }
        return $this->responseRedirect('admin.products.index', 'product deleted successfully' ,'success',false, false);
    }
}
