<?php

namespace App\Http\Controllers;

use App\Common;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Container\CommonContainer;
use Illuminate\Support\Facades\Auth;
use App\Inventory;

class ProductController extends Controller
{
    protected $media;

    public function __construct(CommonContainer $media){
        return $this->media = $media;
    }
    
    public function index()
    {
        $products = Product::orderBy('id','ASC');
        if(Common::userRole()[0] == 'seller'){
            $products = $products->where('user_id',Auth::user()->id);
        }
        $products = $products->get();
        foreach($products as $product){
            $product->stock = Product::stock($product->id);
            $product->purchase_price = Product::getPurchasePrice($product->id);
        }   
        return view('product.list',compact('products'));
    }

    public function create()
    {
        $categories = Category::get();
        return view('product.add',compact('categories'));
    }

    public function store(Request $req)
    {
        $validate = Request()->validate([
            'image' => 'required',
            'title' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);
        $product = new Product;
        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $name  = $this->media->getFileName($image);
            $path  = $this->media->getProfilePicPath('product');
            $image->move($path, $name);
            $product->img = $name;
        }
        $product->user_id = Auth::user()->id;
        $product->cat_id = $req->category;
        $product->title = $req->title;
        $product->price = $req->price;
        $product->description = $req->description;
        $product->status = $req->status;
        $product->save();
        return back();
    }

    public function edit($id)
    {
        $product = Product::with('category','seller')->where('id',$id);
        if(Common::userRole() == 'seller'){
            $product = $product->where('user_id',Auth::user()->id);
        }
        $product = $product->first();
        $categories = Category::get();
        return view('product.edit',compact('product','categories'));
    }

    public function update($id,Request $req)
    {
        $validate = Request()->validate([
            'title' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);
        $product = Product::with('category','seller')->where('id',$id);
        if(Common::userRole() == 'seller'){
            $product = $product->where('user_id',Auth::user()->id);
        }
        $product = $product->first();
        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $this->media->unlinkProfilePic($product->img,'product');
            $name  = $this->media->getFileName($image);
            $path  = $this->media->getProfilePicPath('product');
            $image->move($path, $name);
            $product->img = $name;
        }
        $product->user_id = Auth::user()->id;
        $product->cat_id = $req->category;
        $product->title = $req->title;
        $product->price = $req->price;
        $product->description = $req->description;
        $product->status = $req->status;
        $product->save();

        return back();
    }

    public function destroy($id)
    {
        $product = Product::where('id',$id);
        if(Common::userRole() == 'seller'){
            $product = $product->where('user_id',Auth::user()->id);
        }
        $product->delete();
        return back();
    }
}
