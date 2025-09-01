<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function orderCart($user_id){
        $orders = Order::select('orders.*','posts.genre','posts.bookName','posts.writerName','posts.price','posts.bookImage')
                  ->where('user_id', $user_id)
                  ->LeftJoin('posts','posts.id','orders.book_id')
                  ->get();
       return response()->json([
        'orderData' => $orders,
        'message' => 'success'
     ]);
    }

    //orderRemove
    public function removeOrder(Request $request){
                    Order::where('id',$request->book_id)
                                ->where('user_id',$request->user_id)
                                ->delete();
            $orderTotal = Order::where('user_id',$request->user_id)->get();
            return response()->json([
                'updateOrderTotal' =>$orderTotal,
                'message' => 'success'
             ]);
    }
  //orderCount
    public function orderCount(Request $request){
        $orderCount = Order::where('user_id',$request->user_id)->get();
        return response()->json([
            'orderCount' => $orderCount,
            'message' => 'success'
         ]);

    }
}
