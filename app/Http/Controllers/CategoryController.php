<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('auth.admin.categories.index', compact('categories'));
    }

    public function create(){
        return view('auth.admin.categories.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' =>'required|unique:categories,name'
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return redirect()->route('categories');
    }

    public function destroy($id){
        $category = Category::find($id);
        $category->delete();
        return redirect()->back();
    }

    public function edit($id){
        $category = Category::find($id);
        return view('auth.admin.categories.edit', compact('category'));
    }
    
    public function update(Request $request, $id){
        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->save();
        return redirect()->route('categories');
    }
}
