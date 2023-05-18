<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $page = !empty($request->query('page')) ? $request->query('page') : 1;

        $cache_products = Redis::get('list_products:page:' . $page);
        $products = [];
        try {
            if ($cache_products) {
                $products = json_decode($cache_products, FALSE);
            } else {
                $products = Product::latest()->paginate(10);

                Redis::set('list_products:page:' . $page, json_encode($products));
            }

            return new ProductResource(200, 'success', $products);
        } catch (\Throwable $th) {
            return response()->json('bad request', 500);
        }
    }

    public function show($id)
    {
        $cache_product = Redis::get('list_products:id:' . $id);
        $product = [];

        try {
            if ($cache_product) {
                $product = json_decode($cache_product, FALSE);
            } else {
                $product = Product::find($id);
                Redis::set('list_products:id:' . $id, json_encode($product));
            }

            return new ProductResource(200, 'success', $product);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'product_name' => "required|min:3",
                'image' => 'required|string',
                'description' => 'nullable|string',
                'stock' => 'required|integer',
                'price' => 'required|integer',
                'category' => 'required|array',
                'weight' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }


            $create_product = Product::create([
                'product_name' => $request->product_name,
                'stock' => $request->stock,
                'price' => $request->price,
                'weight' => $request->weight,
                'description'     => $request->description,
                'image'     => $request->image
            ]);

            return new ProductResource(200, 'Create product success!', $create_product);
        } catch (\Throwable $th) {
            return response()->json('bad request', 500);
        }
    }
}
