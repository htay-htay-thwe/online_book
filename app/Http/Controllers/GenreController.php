<?php

namespace App\Http\Controllers;

use App\Models\genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    public function createGenre(Request $request){
        $validator =Validator::make($request->all(), [
         'genre'=> 'required'
        ]);
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        genre::create(['genre' => $request->genre,]);
        return back();
    }
}
