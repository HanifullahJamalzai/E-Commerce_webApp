<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
class CategoryController extends Controller
{
    public function AllCategory(){
        $categories = Category::all();
        $categoryDetailArray = [];
        foreach($categories as $value){
            $subcategory = SubCategory::where('category_name', $value['category_name'])->get();
            $item = [
                'category_name' => $value['category_name'],
                'category_image' => $value['category_image'],
                'subcategory_name' => $subcategory
            ];
            array_push($categoryDetailArray, $item);
        }
        return $categoryDetailArray;
    } //End Method
}
