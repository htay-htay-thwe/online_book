<?php

namespace App\Http\Controllers\Api;

use App\Models\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function viewCount(Request $request){
        $data =[
           'user_id'=> $request->user_id,
           'post_id' => $request->post_id
          ];
          View::create($data);
          $view = View::where('post_id',$request->post_id)->get();

          return response()->json([
            'view' => $view
          ]);

    }
}
