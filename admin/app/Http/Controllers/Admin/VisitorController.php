<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visitor;

class VisitorController extends Controller
{
    public function GetVisitorDetails(){
        // $ip_address = $request->ip();
        $ip_address = $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set('Asia/Kabul');
        $visit_time = date("h:i:sa");
        $visit_data = date("d-m-Y");

        $result = Visitor::insert([
            'ip_address' => $ip_address,
            'visit_time' =>$visit_time,
            'visit_date' => $visit_data
        ]);
        return $result;
    }
}
