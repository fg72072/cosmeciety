<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return view('category.list',compact('categories'));
    }

    public function create()
    {
   
        return view('category.add');
    }

    public function store(Request $req)
    {
        $validate = Request()->validate([
            'title'=>'required|unique:categories',
        ]);

        $category = new Category;
        $category->title = $req->title;
        $category->status = $req->status;
        $category->save();
        return back()->with(['msg_success'=>'Category has been added.']);
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit',compact('category'));
    }

    public function update($id,Request $req)
    {
        $category = Category::find($id);
        $valida = 'required|unique:categories';
        if($req->title == $category->title){
            $valida = 'required';
        }
        $validate = Request()->validate([
            'title'=>$valida,
        ]);
        $category->title = $req->title;
        $category->status = $req->status;
        $category->save();
        return back()->with(['msg_success'=>'Category has been updated.']);
    }

    public function destroy($id)
    {
        Category::find($id)->delete();
        return back();
    }
}
