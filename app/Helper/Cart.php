<?php
namespace  App\Helper;

use App\Models\CartItem;
use Illuminate\Support\Facades\Cookie;

class Cart
{
    public static function getCount()
    {
        if($user=auth()->user()){
            return CartItem::whereUserId($user->id)->sum('quantity');
        }
    }

    public static function getCartItems()
    {
        if($user=auth()->user()){
            return CartItem::whereUserId($user->id)->get()->map(fn (CartItem $item)=>['product_id'=>$item->product_id, 'quantity'=>$item->quatity]);
        }
    }

    public static function getCookieCartItems()
    {
        return json_decode(request()->cookie('cart_items','[]'), true);
    }

    public static function setCookieCartItems()
    {
        Cookie::queue('cart_items',fn(int $carry, array $item)=> $carry + $item['quantity'],0);
    }

    public static function saveCookieCartItems()
    {
        $user=auth()->user();
        $userCartItems=CartItem::where(['user_id'=>$user->id])->get()->keyBy('product_id');
        $savedCartItems=[];
        foreach (self::getCookieCartItems() as $cartItem)
        {
            if(isset($userCartItems[$cartItem['product_id']])){
                $userCartItems[$cartItem['product_id']]->update(['quantity'=>$cartItem['quantity']]);
                continue;
            }
            $savedCartItems[]=[
                'user_id'=>$user->id,
                'product_id'=> $cartItem['product_id'],
                'quantity'=>$cartItem['quantity'],
            ];

        }
        if(!empty($savedCartItems)){
            CartItem::insert($savedCartItems);
        }
    }
    public static function moveCartItemsIntoDb()
    {
        $request=$request();
        $cartItems=self::getCookieCartItems();
        $newCartItems=[];
//        26:35


    }

}
