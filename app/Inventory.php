<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    public static function addInventory($req,$stock_type){
        $stock = new Inventory;
        $stock->p_id = $req->product;
        $stock->qty = $req->stock;
        $stock->purchase_price = $req->purchase_price;
        $stock->total_purchase_price = $req->purchase_price * $req->stock;
        $stock->stock_type = $stock_type;
        $stock->save();
    }
}
