<?php
namespace App\Http\Controllers;

use App\Models\genre;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //postCretePage
    public function postCreatePage()
    {
        $genre = genre::get();
        $book  = Post::get();
        return view('post.postCreate', compact('book', 'genre'));
    }

    //postCreate
    public function postCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'genre'       => 'required',
            'price'       => 'required',
            'bookName'    => 'required',
            'writerName'  => 'required',
            'number'      => 'required',
            'bookImage'   => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = $this->getPostData($request);

        if ($request->hasFile('bookImage')) {
            $imageName = uniqid() . '_' . $request->file('bookImage')->getClientOriginalName();
            $request->file('bookImage')->move(public_path('books'), $imageName);
            $data['bookImage'] = $imageName;
        }
        Post::create($data);
        $genre = genre::get();
        $book  = Post::get();
        return view('post.postCreate', compact('book', 'genre'));
    }

    //postDelete
    public function postDelete($id)
    {
        Post::where('id', $id)->delete();
        return back();
    }

    //postEdit-page
    public function postEditPage($id)
    {
        $genre = genre::get();
        $data  = Post::where('id', $id)->first();
        return view('post.editPage', compact('data', 'genre'));
    }

    //postEdit
    public function postUpdate(Request $request)
    {
        $id        = $request->id;
        $validator = Validator::make($request->all(), [
            'genre'       => 'required',
            'price'       => 'required',
            'bookName'    => 'required',
            'writerName'  => 'required',
            'number'      => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $this->updatePostData($request);
        if ($request->hasFile('bookImage')) {
            $dbImage = Post::where('id', $id)->first();

            if ($dbImage && $dbImage->bookImage) {
                $oldImagePath = public_path('books/' . $dbImage->bookImage);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // delete the old file
                }
            }

            $imageName = uniqid() . '_' . $request->file('bookImage')->getClientOriginalName();
            $request->file('bookImage')->move(public_path('books'), $imageName);
            $data['bookImage'] = $imageName;
        }

        Post::where('id', $id)->update($data);
        return redirect()->route('post#createPage');
    }

    private function getPostData($request)
    {
        return [
            'genre'       => $request->genre,
            'price'       => $request->price,
            'bookName'    => $request->bookName,
            'writerName'  => $request->writerName,
            'number'      => $request->number,
            'bookImage'   => $request->bookImage,
            'description' => $request->description,
        ];
    }
    private function updatePostData($request)
    {
        return [
            'genre'       => $request->genre,
            'price'       => $request->price,
            'bookName'    => $request->bookName,
            'writerName'  => $request->writerName,
            'number'      => $request->number,
            'description' => $request->description,
        ];
    }

}
