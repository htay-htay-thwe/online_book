<?php

namespace App\Http\Controllers\Api;

use App\Models\Reply;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReplyController extends Controller
{
    public function reply(Request $request){

        $data =[
            'replied_user_id' => $request->replied_user_id,
            'replied_username' => $request->replied_user_name,
            'reply' => $request->reply,
          ];

         Reply::create($data);
        //  $replyData = Reply::select('replies.*', 'comments.id','comments.comment_image')
        //  ->join('comments','replies.parent_id', '=', 'comments.id')
        //  ->get();
        //  logger($replyData);
        $replyData=Reply::get();

          logger($replyData);
          return response()->json([
            'reply' => $replyData,
            'message' => 'success'
         ]);

    }
    public function getReply(){
        $replyData=Reply::get();
        logger($replyData);
        return response()->json([
          'reply' => $replyData,
          'message' => 'success'
       ]);
    }
}
