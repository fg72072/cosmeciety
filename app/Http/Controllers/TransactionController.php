<?php

namespace App\Http\Controllers;

use App\Order;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::get();
        foreach($transactions as $t){
           $t->user = Order::with('user:id,name,img')->first()->user->name;
        }
        return view('transactions.list',compact('transactions'));
    }
}
