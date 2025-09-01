<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\realOrder;
use Illuminate\Http\Request;

class BoughtController extends Controller
{
    public function order(){
        $order= realOrder::orderBy('created_at','desc')->get();
        return view('order.order', compact('order'))->with('order', $order);
    }

    public function ajaxStatus(Request $request){
        $order= realOrder::orderBy('created_at','desc');
             if($request->status == null){
              $order = $order->get();
             }else{
                $order = $order->where('selected',$request->status)->get();
             }
        return response()->json($order,200);
    }

     public function search(Request $request){
       $order = realOrder::orWhere('bookName','LIKE','%'.$request->search.'%')
                        ->orWhere('price','LIKE','%'.$request->search.'%')
                        ->orWhere('orderId','LIKE','%'.$request->search.'%')
                        ->orWhere('quantity','LIKE','%'.$request->search.'%')
                        ->orWhere('created_at','LIKE','%'.$request->search.'%')->get();

     return view('order.order', compact('order'))->with('order', $order);
    }

    //change status
    public function changeStatus(Request $request){
        logger($request->all());
        realOrder::where('order_id',$request->orderId)->update([
            'selected' => $request->status
        ]);
        $order=realOrder::where('order_id',$request->orderId)->get();
        logger($order);
    }
}
