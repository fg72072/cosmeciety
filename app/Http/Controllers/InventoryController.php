<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function create()
    {
        $products =Product::get();
        return view('inventory.add',compact('products'));
    }

    public function store(Request $req)
    {
        Inventory::addInventory($req,'in');
        return back();
    }
}
