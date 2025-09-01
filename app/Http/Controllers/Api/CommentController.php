<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function comment(Request $request){
        $request->validate([
            'comment_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rule as needed
            'comment' => 'required|string',
            'book_id' => 'required|integer',
            'user_id' => 'required|integer',
            'user_name' => 'required|string',
        ]);

        // Create a new Comment instance
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->book_id = $request->book_id;
        $comment->user_id = $request->user_id;
        $comment->user_name = $request->user_name;
        logger($request->file);

        // If a file is uploaded, store it
        if ($request->hasFile('comment_image')) {
            $file = $request->file('comment_image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public', $imageName);
            $storagePath = str_replace('public/', '', $path);
            $comment->comment_image = $storagePath;

        }else{
            logger('error');
        }

        // Save the comment
        $comment->save();

        // Return a response
        return response()->json([
            'commentData' => $comment,
            'message' => 'Comment saved successfully'
        ]);
    }
    public function getComment(){
        $commentData = Comment::get();
        return response()->json([
            'getCommentData' => $commentData,
            'message' => 'success'
         ]);
    }
}
