<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'product' => "required",
                'is_checkout' => 'required|boolean',
                'quantity' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }


            $create_product = Cart::create([
                'product_name' => $request->product_name,
                'stock' => $request->stock,
                'price' => $request->price,
                'weight' => $request->weight,
                'description'     => $request->description,
                'image'     => $request->image
            ]);

            return new CartResource(200, 'Create product success!', $create_product);
        } catch (\Throwable $th) {
            return response()->json('bad request', 500);
        }
    }
}
