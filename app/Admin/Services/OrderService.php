<?php

namespace App\Services;

use Auth;
use App\Models\Order;

class CartService
{
//    public function get()
//    {
//        return Auth::user()->cartItems()->with(['productSku.product'])->get();
//    }

    public function import($skuId, $amount)
    {
//        // 从数据库中查询该商品是否已经在购物车中
//        if ($item = $user->cartItems()->where('product_sku_id', $skuId)->first()) {
//            // 如果存在则直接叠加商品数量
//            $item->update([
//                'amount' => $item->amount + $amount,
//            ]);
//        } else {
//            // 否则创建一个新的购物车记录
//            $item = new CartItem(['amount' => $amount]);
//            $item->user()->associate($user);
//            $item->productSku()->associate($skuId);
//            $item->save();
//        }

//        return $item;
    }


}
