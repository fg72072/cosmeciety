<?php

namespace App\Http\Controllers;

use App\Product;
use App\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function create()
    {
        $products =Product::where('user_id',Auth::user()->id)->get();
        return view('inventory.add',compact('products'));
    }

    public function store(Request $req)
    {
        Inventory::addInventory($req,'in');
        return back();
    }
}
