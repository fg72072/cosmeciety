<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    function category()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'id');
    }

    function seller()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function stock($id){
        // SELECT SUM(CASE WHEN stock_type='in' THEN qty END) AS intsq,SUM(CASE WHEN stock_type='out' THEN qty END) out1 FROM inventories
        $total = 0;
        $product = Inventory::where('p_id',$id)->get();
        foreach($product as $stock){
            if($stock->stock_type == 'in'){
                $total+= $stock->qty;
            }
            elseif($stock->stock_type == 'out'){
                $total-= $stock->qty;
            }
        }
        if($total < 0){
            $total = 0;
        }
        return $total;
    }

    public static function getPurchasePrice($id){
        $product_purchase_price = Inventory::where('stock_type','in')->where('p_id',$id)->orderBy('id','Desc')->pluck('purchase_price')->first();
        return $product_purchase_price;
    }
}
