<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductReview;


class ReviewController extends Controller
{
    public function ReviewList(Request $request){
        $product_id = $request->id;
        $result = ProductReview::where('product_id', $product_id)
                            ->orderBy('id', 'desc')
                            ->limit(4)
                            ->get();
        return $result;
    } //End Method
}
