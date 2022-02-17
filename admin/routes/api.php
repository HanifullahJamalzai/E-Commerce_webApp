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
use App\Http\Controllers\Admin\ProductCartController;
use App\Http\Controllers\Admin\FavoriteController;

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ForgetController;
use App\Http\Controllers\User\ResetController;
use App\Http\Controllers\User\UserController;

use App\Http\Controllers\Admin\ReviewController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// ------------Start: User Login API ----------------------------------

// Register route
Route::post('/login', [AuthController::class, 'Login']);
// Register password route
Route::post('/register', [AuthController::class, 'Register']);
// forget password route
Route::post('/forgetpassword', [ForgetController::class, 'ForgetPassword']);
// reset password route
Route::post('/resetpassword', [ResetController::class, 'ResetPassword']);
// current user route
Route::get('/user', [UserController::class, 'user'])->middleware('auth:api');

// ------------End: User Login API -------------------------------------

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
// ProductDetails Route
Route::get('/productdetails/{id}', [ProductDetailsController::class, 'ProductDetails']);
// Notification Route
Route::get('/notification', [NotificationController::class, 'NotificationHistory']);

// Search Route
Route::get('/search/{key}', [ProductListController::class, 'ProductBySearch']);

// Similar product list Route
Route::get('/similarproduct/{subcategory}', [ProductListController::class, 'SimilarProduct']);

// Product Review Route
Route::get('/reviewlist/{id}', [ReviewController::class, 'ReviewList']);

// Product Cart Route 
Route::post('/addtocart', [ProductCartController::class, 'AddToCart']);

// Product CartCount Route 
// Route::get('/cartcount/{product_code}', [ProductCartController::class, 'CartCount']);

Route::get('/cartcount', [ProductCartController::class, 'MyCartCount']);

// Favorite Routes
Route::post('/addtofavorite/{email}/{product_code}', [FavoriteController::class, 'AddToFavorite']);
// FavoriteList Routes
Route::get('/favoritelist/{email}', [FavoriteController::class, 'FavoriteList']);
// Favorite Remove Routes
Route::post('/favoriteremove/{email}/{product_code}', [FavoriteController::class, 'FavoriteRemove']);
