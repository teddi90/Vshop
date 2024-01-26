<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function view()
    {

    }

    public function store(Request $request, Product $product)
    {
        $quantity=$request->post('quantity',1);
        $user=$request->user();
        if($user){
            $cartItem= CartItem::where(['user_id'=>$user->id, 'product_id'=>$product->id])->first();
            if($cartItem){
                $cartItem->increment('quantity');
            }
            else{
                CartItem::create([
                   'user_id'=>$user->id,
                   'product_id'=>$product->id,
                   'quantity'=>1,
                ]);
            }
        }else{


        }
    }

    public function update(Request $request)
    {

    }

    public function delete()
    {

    }
}
