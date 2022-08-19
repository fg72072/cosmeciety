<?php

namespace App\Http\Controllers;

use App\Media;
use App\Common;
use App\Product;
use App\Category;
use App\Inventory;
use Illuminate\Http\Request;
use App\Container\CommonContainer;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    protected $media;

    public function __construct(CommonContainer $media){
        return $this->media = $media;
    }
    
    public function index()
    {
        $products = Product::with('media')->orderBy('id','ASC');
        if(Common::userRole()[0] == 'seller'){
            $products = $products->where('user_id',Auth::user()->id);
        }
        $products = $products->get();
        foreach($products as $product){
            $product->stock = Product::stock($product->id);
            // $product->purchase_price = Product::getPurchasePrice($product->id);
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
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1000',
            'title' => 'required|max:100',
            'category' => 'required',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|digits_between:1,6',
            'purchase_price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|digits_between:1,6',
            'description' => 'required|string|max:500',
        ]);
        $product = new Product;
        $product->user_id = Auth::user()->id;
        $product->cat_id = $req->category;
        $product->title = $req->title;
        $product->price = $req->price;
        $product->purchase_price = $req->purchase_price;
        $product->description = $req->description;
        $product->status = $req->status;
        $product->save();

        for ($i = 0; $i < count($req->file('image')); $i++) {
            # code...
            if ($req->hasFile('image')) {
                $image = $req->file('image')[$i];
                $name  = $this->media->getFileName($image);
                $path  = $this->media->getProfilePicPath('product');
                $image->move($path, $name);
                $uploadmedia = new Media;
                $uploadmedia->user_id = Auth::user()->id;
                $uploadmedia->media_against = $product->id;
                $uploadmedia->file = $name;
                $uploadmedia->type = '6';
                if($uploadmedia->save()){

                }
            }
        }
        
        return redirect('product');
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
            'title' => 'required|max:100',
            'category' => 'required',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|digits_between:1,6',
            'purchase_price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|digits_between:1,6',
            'description' => 'required|string|max:500',
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
        $product->purchase_price = $req->purchase_price;
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

    public function deleteMedia($id)
    {
        $media = Media::where('user_id',Auth::user()->id)->where('id',$id)->first();
        $this->media->unlinkProfilePic($media->file,'product');
        $media->delete();
        return 'Image successfully deleted';
    }

    public function uploadMedia($id,Request $req)
    {
        if ($req->hasFile('image')) {
                $image = $req->file('image');
                $name  = $this->media->getFileName($image);
                $path  = $this->media->getProfilePicPath('product');
                $image->move($path, $name);
                $uploadmedia = new Media;
                $uploadmedia->user_id = Auth::user()->id;
                $uploadmedia->media_against = $id;
                $uploadmedia->file = $name;
                $uploadmedia->type = '6';
                if($uploadmedia->save()){

                }
        }
        return back();
    }
}
