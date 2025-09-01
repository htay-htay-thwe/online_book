<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class BookCollectionController extends Controller
{
    public function getBook(){
        $book = Post::get();
        $bookGenre = Post::distinct()->pluck('genre');
        $bookWriter =Post::distinct()->pluck('writerName');
        $priceRanges = [
            ['min' => 10000, 'max' => 20000],
            ['min' => 20000, 'max' => 30000],
            ['min' => 30000, 'max' => 40000],

        ];

        // Initialize an array to store products for each price range
        $productsByPriceRange = [];

        // Loop through each price range and retrieve products
        foreach ($priceRanges as $range) {
            $minPrice = $range['min'];
            $maxPrice = $range['max'];

            // Retrieve products within the current price range
            $products = Post::whereBetween('price', [$minPrice, $maxPrice])->get();

            // Store products in the array indexed by the price range
            $productsByPriceRange["$minPrice-$maxPrice"] = $products;
        }
         return response()->json([
           'productsByPriceRange' => $productsByPriceRange,
           'book' => $book,
           'bookGenre' => $bookGenre,
           'bookWriter' => $bookWriter,
           'message' => 'success'
        ]);
    }

    public function bookDetail(Request $request){
        $id= $request->bookDetailId;
        $oneBookData= Post::where('id',$id)->first();
        return response()->json([
            'bookData' => $oneBookData,
            'message' => 'success'
         ]);
    }
    public function filter(Request $request){
        // $selectedGenres = $request->all();
        // logger($selectedGenres);
        $allData = collect();
        $allGenres= collect();
        $writerFilter = collect();

        $selectedGenres = $request->genres; // Assuming 'genres' is the parameter name for selected genres
        $selectedPrices = $request->prices;
        $selectedWriter = $request->writer;

        // Genre
         if (!empty($selectedGenres)) {
            foreach ($selectedGenres as $range) {
            $genre = Post::where('genre', $range)->get();
            $allGenres = $allGenres->merge($genre)->unique('id');
            }
         }

        //  Writer
         if (!empty($selectedWriter)) {
            foreach ($selectedWriter as $range) {
            $writer = Post::where('writerName', $range)->get();
            $writerFilter = $writerFilter->merge($writer)->unique('id');
            }
         }

        //  Price
            if(!empty($selectedPrices)) {

                foreach ($selectedPrices as $range) {
                    $values = explode('-', $range);
                    $min = intval($values[0]);
                    $max = intval($values[1]);

                        $price = Post::whereBetween('price', [$min, $max])->get();
                        $allData = $allData->merge($price)->unique('id');

                }
            }

            if (!empty($selectedPrices) && !empty($selectedGenres)) {
                $filteredWithPriceRange = collect();
                foreach ($selectedGenres as $genre) {
                    $filteredWithPriceRange = $filteredWithPriceRange->merge($allData->where('genre', $genre));
                }
            }
            if (!empty($selectedPrices) && !empty($selectedWriter)) {
                $filteredWithPriceWriter = collect();
                foreach ($selectedWriter as $writer) {
                    $filteredWithPriceWriter = $filteredWithPriceWriter->merge($allData->where('writerName', $writer));
                }
            }
            if (!empty($selectedGenres) && !empty($selectedWriter)) {
                $filteredWithGenreWriter = collect();
                foreach ($selectedWriter as $writer) {
                    $filteredWithGenreWriter = $filteredWithGenreWriter->merge( $allGenres->where('writerName', $writer));
                }
            }
            if (!empty($selectedGenres) && !empty($selectedWriter) && !empty($selectedPrices)) {
                $filteredWithGenreWriterPrice = collect();
                    foreach($selectedWriter as $range){
                    $filteredWithGenreWriterPrice = $filteredWithGenreWriterPrice->merge($filteredWithPriceRange->where('writerName', $range));
                     }
                     logger($filteredWithGenreWriterPrice);
            }
            return response()->json([
                'filterByThree' => $filteredWithGenreWriterPrice ?? [],
            'filterByGenreWriter' => $filteredWithGenreWriter ?? [],
            'filterByPriceWriter' => $filteredWithPriceWriter ?? [],
            'filterByPriceGenre' => $filteredWithPriceRange ?? [],
             'filterByWriter' => $writerFilter,
            'filterByGenre'=> $allGenres,
            'filterByPrice' => $allData,
            'message' => 'success'
              ]);
        }

    public function addToCart(Request $request){
     $orderData =[
        'book_id'=>$request->book_id,
        'user_id' => $request->user_id,
        'order_id'=>Str::random(8),
     ];
        logger($orderData);
        $addToCart = Order::create($orderData);
        $orderTotal = Order::where('user_id',$request->user_id)->get();
        return response()->json([
            'orderTotal' =>$orderTotal,
            'addToCart' => $addToCart,
            'message' => 'success'
         ]);
    }


    public function search(Request $request){
        logger($request->all());
        $search = Post::orWhere('genre','LIKE','%'.$request->key.'%')
                    ->orWhere('bookName','LIKE','%'.$request->key.'%')
                    ->orWhere('writerName','LIKE','%'.$request->key.'%')
                    ->orWhere('price','LIKE','%'.$request->key.'%')
                    ->orWhere('description','LIKE','%'.$request->key.'%')->get();

        return response()->json([
           'search' => $search,
            'message' => 'success'
         ]);
    }


}
