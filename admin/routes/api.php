<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SiteInfoController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductListController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductDetailsController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\User\AuthController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Login
Route::post('/login', [AuthController::class, 'Login']);
// Register
Route::post('/register', [AuthController::class, 'Register']);

// Get Visitor
Route::get('/getvisitor', [VisitorController::class, 'GetVisitorDetails']);
// Contact Page Route
Route::post('/postcontact', [ContactController::class, 'PostContactDetails']);
// Site Info Route
Route::get('/allsiteinfo', [SiteInfoController::class, 'AllSiteInfo']);
// All Category Route
Route::get('/allcategory', [CategoryController::class, 'AllCategory']);
// ProductList Route
Route::get('/productlistbyremark/{remark}', [ProductListController::class, 'ProductListByRemark']);
Route::get('/productlistbycategory/{category}', [ProductListController::class, 'ProductListByCategory']);
Route::get('/productlistbysubcategory/{category}/{subcategory}', [ProductListController::class, 'ProductListBySubCategory']);
// Slider Route
Route::get('/allslider', [SliderController::class, 'AllSliders']);
//ProductDetails Route
Route::get('/productdetails/{id}', [ProductDetailsController::class, 'ProductDetails']);
//Notification Route
Route::get('/notification', [NotificationController::class, 'NotificationHistory']);

//Search Route
Route::get('/search/{key}', [ProductListController::class, 'ProductBySearch']);

