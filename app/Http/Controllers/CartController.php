<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Http\Requests\CheckRequest;
use App\Product;
use Illuminate\Http\Request;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartProducts = Cart::with('product')->get();
        return response($cartProducts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckRequest $request, Cart $cart)
    {
        $data = (object)[
            'quantity' => null,
            'product' => null
        ];

        $productSelected = Product::findOrFail($request->product_id);
        $basketProducts = Cart::where('product_id','=',$request->product_id)->first();
        if ($basketProducts){
            Cart::where('product_id','=',$request->product_id)->increment('quantity');
            $productExisting = Cart::where('product_id','=',$request->product_id)->first();

            $data->quantity = $productExisting->quantity;
            $data->product = $productExisting;
           return response()->json($data);
        }
        else{
            $cart->product_id = $productSelected->id;
            $cart->quantity = 1;
            $cart->save();
            $data->quantity = 1;
            $data->product = $productSelected;
            return response()->json($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy()
    {
        Cart::truncate();
    }

    public function delete(Request $request)
    {
        $selected = Cart::where('product_id', '=', $request->product_id)->firstOrFail();
        if ($selected) {
            Cart::where('product_id', '=', $request->product_id)->delete();
        }
    }
}
