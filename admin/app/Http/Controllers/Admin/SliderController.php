<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlider;

class SliderController extends Controller
{
    public function AllSliders(){
        $result = HomeSlider::all();
        return $result;
    }
}
