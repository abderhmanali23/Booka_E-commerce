<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tmpcat = Category::all();
        $categories = [];
        foreach($tmpcat as $category){
            $categories[$category->id] = $category;
        }
        $products= Product::paginate(8);
        $cnt=1;
        return view('auth.admin.products.index', compact(['categories','products','cnt']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('auth.admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
            'description' => 'required|min:20',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'image' => 'someTimes|mimes:png,jpg,jpeg'
        ]);

        $extension = $request->image->extension();
        $image_name = time().'.'.$extension;

        Storage::put("/public/products/$image_name", file_get_contents("$request->image"));

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'image' => $image_name
        ]);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        return view('auth.admin.products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tmp = Category::all();
        $categories = [];
        foreach($tmp as $category){
            $categories[$category->id] = $category;
        }
        $product = Product::find($id);
        $cnt=1;
        return view('auth.admin.products.edit', compact(['product','categories','cnt']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=> 'required',
            'description' => 'required|min:20',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'image' => 'someTimes|mimes:png,jpg,jpeg'
        ]);

        $product = Product::find($id);
        
        if ($request->image != ''){
            $extension = $request->file('image')->extension();
            $image_name = time().'.'.$extension;
            Storage::delete("public/products/$product->image");
            Storage::put("/public/products/$image_name", file_get_contents($request->file('image')));
            $product->image = $image_name;
        }
        
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->save();
        $products = Product::paginate(8);
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        Storage::delete("public/products/$product->image");
        $product->delete();
        return redirect()->route('products.index');
    }

    public function getProductsByCategory(string $id){
        $cnt=1;
        $categories = Category::all();
        $products = Category::find($id)->products()->paginate(8);
        return view("auth.admin.products.index" ,compact(['products','categories','cnt']));
    }

    public function search(Request $request){
        $products = Product::where('name','like',"%$request->search%")->paginate(8);
        // dd($products->all());
        $cnt=1;
        $categories = Category::all();
        return view("auth.admin.products.index" ,compact(['products','categories','cnt']));
    }
}
