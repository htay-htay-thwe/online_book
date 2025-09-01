<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\realOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class realOrderController extends Controller
{
    public function realOrder($user_id){
        $orders = Order::select('orders.*','posts.genre','posts.bookName','posts.writerName','posts.price','posts.bookImage')
        ->where('user_id', $user_id)
        ->LeftJoin('posts','posts.id','orders.book_id')->get();

        foreach ($orders as $order) {
               realOrder::create([
                'order_id'=> $order->id,
                'bookName' => $order->bookName,
                'orderId' => $order->order_id,
                'price' => $order->price,
                'quantity'=> $order->quantity,
                'bookImage' => $order->bookImage,
                'user_id' => $order-> user_id,
                'selected' => $order->selected
                ]);
                Order::orWhere('user_id', $user_id)
                       ->orWhere('order_id',$order->order_id)->delete();
        }
        $realOrder = realOrder::get();
        logger($realOrder);
        return response()->json([
        'realOrderData' => $realOrder,
        'message' => 'success'
       ]);
    }


    //get data of bought
    public function realOrderHistory($user_id){
          $realOrder = realOrder::where('user_id',$user_id)->get();
          return response()->json([
            'orderHistory' => $realOrder,
            'message' => 'success'
           ]);
    }
}
