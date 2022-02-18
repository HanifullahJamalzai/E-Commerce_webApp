<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCart;
use App\Models\ProductList;
use App\Models\CartOrder;

class ProductCartController extends Controller
{
    public function AddToCart(Request $request){
        $email = $request->input('email');
        $size = $request->input('size');
        $color = $request->input('color');
        $quantity = $request->input('quantity');
        $product_code = $request->input('product_code');

        $productDetails = ProductList::where('product_code', $product_code)->get();
        
        $special_price = $productDetails[0]['special_price'];
        $price = $productDetails[0]['price'];

        if($special_price != "na"){
            $total_price = $special_price*$quantity;
            $unit_price = $special_price;
        }else{
            $total_price = $price*$quantity;
            $unit_price = $price;
        }

        $result  = ProductCart::insert([
            'image' => $productDetails[0]['image'],
            'product_name' => $productDetails[0]['title'],
            'product_code' => $productDetails[0]['product_code'],
            'email' => $email,
            'size' => "Size: ".$size,
            'color' => "Color: ".$color,
            'quantity' => $quantity,
            'unit_price' => $unit_price,
            'total_price' => $total_price,
        ]);

        return $result;
    } // End Method

    public function CartCount(Request $request){
        $product_code = $request->product_code;
        $result = ProductCart::count();
        return $result;
    } // End Method

    public function MyCartCount(){
        $result = ProductCart::count();
        return $result;
    } // End Method

    public function CartList(Request $request){
        $email = $request->email;
        $result = ProductCart::where('email', $email)->get();
        return $result;
    } // End Method
    
    public function CartItemRemove(Request $request){
        $email = $request->email;
        $product_code = $request->product_code;

        $result = ProductCart::where('email', $email)->where('product_code', $product_code)->delete();

        return $result;
    } // End Method

    public function CartItemMinus(Request $request){
        $id = $request->id;
        $quantity = $request->quantity;
        $price = $request->price;
        
        $updated_quantity = $quantity - 1;
        $total = $price*$updated_quantity;

        $result = ProductCart::where('id', $id)->update([
            'quantity' => $updated_quantity,
            'total_price' => $total
        ]);

        return $result;
    }
    public function CartItemPlus(Request $request){
        $id = $request->id;
        $quantity = $request->quantity;
        $price = $request->price;
        
        $updated_quantity = $quantity + 1;
        $total = $price*$updated_quantity;

        $result = ProductCart::where('id', $id)->update([
            'quantity' => $updated_quantity,
            'total_price' => $total
        ]);

        return $result;
    } // End Method

    public function CartOrder(Request $request){
        $city = $request->input('city');
        $paymentMethod = $request->input('payment_method');
        $yourName = $request->input('name');
        $email = $request->input('email');
        $deliveryAddress = $request->input('delivery_address');
        $invoiceNo = $request->input('invoice_no');
        $deliveryCharge = $request->input('delivery_charge');

        date_default_timezone_set("Asia/Kabul");
        $requestTime = date("h:i:sa"); 
        $requestDate = date("d:m:Y"); 

        $cartList = ProductCart::where('email', $email)->get();

        foreach($cartList as $cartListItem){
            $cartInsertDeleteResult = "";
            $resultInsert = CartOrder::insert([
                'invoice_no' => "Easy ".$invoiceNo,
                'product_name' => $cartListItem['product_name'],
                'product_code' => $cartListItem['product_code'],
                'size' => $cartListItem['size'],
                'color' => $cartListItem['color'],
                'quantity' => $cartListItem['quantity'],
                'unit_price' => $cartListItem['unit_price'],
                'total_price' => $cartListItem['total_price'],
                'email' => $email,
                'name' => $yourName,
                'payment_method' => $paymentMethod,
                'delivery_address' => $deliveryAddress,
                'city' => $city,
                'delivery_charge' => $deliveryCharge,
                'order_date' => $requestDate,
                'order_time' => $requestTime,
                'order_status' => "Pending",
            ]);

            if($resultInsert == 1){
                $resultDelete = ProductCart::where('id', $cartListItem['id'])->delete();
                if($resultDelete == 1){
                    $cartInsertDeleteResult = 1;
                }else{
                    $cartInsertDeleteResult = 0;
                }
            }

        }

        return $cartInsertDeleteResult;

    } // End Method
}
