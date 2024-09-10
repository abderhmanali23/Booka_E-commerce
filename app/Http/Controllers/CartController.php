<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $products = User::find($id)->prodcuts()->paginate(9);
        return view('auth.user.cart', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Cart::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = DB::table('users')
            ->join('carts', 'users.id', '=', 'carts.user_id')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('products.*')
            ->where('carts.user_id','=',$id)
            ->orderBy('products.id')
            ->paginate(9);

        // $products = cart::find($id)->products()->paginate(9);
        $cnt = 1;
        return view('auth.user.cart', compact(['products','cnt']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = Cart::where('user_id','=',$id)->delete();
        return redirect()->back();
    }

    public function removeproduct(string $id){
        $product = DB::table('carts')->select('*')->where('product_id','=',$id);
        $product->delete();
        return redirect()->back();
    } 
}
