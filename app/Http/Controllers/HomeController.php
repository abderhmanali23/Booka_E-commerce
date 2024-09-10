<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        if(Auth::id()){
            $user = Auth::user()->id;
            return redirect()->route('carts.show',[$user]);
        }
        $products = Product::paginate(8);
        $categories = Category::all();
        $cnt = 1;
        return view('auth.admin.products.index', compact('products', 'categories', 'cnt'));
    } 

    public function dashboard(){
        $users = User::all();
        return view('auth.admin.adminDash', compact('users'));
    }

}
