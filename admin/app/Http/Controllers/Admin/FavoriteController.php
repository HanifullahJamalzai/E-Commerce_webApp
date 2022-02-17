<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorites;
use App\Models\ProductList;

class FavoriteController extends Controller
{
    public function AddToFavorite(Request $request){
        $product_code = $request->product_code;
        $email = $request->email;
        $productDetails = ProductList::where('product_code', $product_code)->get();
        
        $result = Favorites::insert([
            'product_name' =>$productDetails[0]['title'],
            'image' =>$productDetails[0]['image'],
            'product_code' =>$product_code,
            'email' =>$email,
        ]);
        return $result;
    } // End Method

    public function FavoriteList(Request $request){
        $email = $request->email;
        $result = Favorites::where('email',$email)->get();
        return $result;

    } // End Method

    
}
