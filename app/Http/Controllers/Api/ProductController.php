<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;

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
            return new ProductResource(500, 'bad request', []);
        }
    }

    public function store()
    {
        dd("hallo");
    }
}
