<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function create()
    {
        $products =Product::where('user_id',Auth::user()->id)->where('cat_id','1')->get();
        $categories = Category::get();
        return view('inventory.add',compact('products','categories'));
    }

    public function store(Request $req)
    {
        $validate = Request()->validate([
            'product' => 'required',
            'stock' => 'required|regex:/^\d+(\.\d{1,2})?$/|max:10',
        ]);
        Inventory::addInventory($req,$req->type);
        return back()->with(['msg_success'=>'Stock has been saved successfully.']);
    }

    public function getProductByCategory($id)
    {
        $products = Product::where('cat_id',$id)->where('user_id',Auth::user()->id)->get();
        return response()->json([
            'success'=>true,
            'products'=>$products,
        ]);
    }

    public function getProductStock($id)
    {
        $stock = Product::stock($id);
        return response()->json([
            'success' => true,
            'stock' => $stock
        ]);
    }
}
