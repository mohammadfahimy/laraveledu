<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\CheckOuteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TestController;
use App\Models\Image;
use App\Services\Basket\Basket;
use App\Services\Wishlist\Wishlist;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\FuncCall;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('',[IndexController::class,'index'])->name('firstpage.index');


Route::get('ab',function(){

    echo Basket::getTotalBasket();
    
});

Route::get('/product/{product}',[ProductController::class,'index'])->name('product.index');

Route::get('basket',[BasketController::class,'index'])->name('basket.index');

Route::post('/product/{productId}/basket',[BasketController::class,'addToBasket'])->name('product.addToBasket');
Route::get('/product/{productId}/basket',[BasketController::class,'addToBasket'])->name('product.addToBasket.get');

Route::get('basket/{basket_id}/remove',[BasketController::class,'remove'])->name('basket.remove');

Route::post('basket/coupon',[CouponController::class,'store'])->name('coupon.store');

Route::get('checkout',[CheckOuteController::class,'index'])->name('checkout.index');

Route::post('checkout',[CheckOuteController::class,'store'])->name('checkout.store');

Route::post('callback',[CheckOuteController::class,'callback'])->name('checkout.callback');

Route::post('product/{product}/comment',[CommentController::class,'store'])->name('comment.store');

Route::get('shop',[ShopController::class,'index'])->name('shop.index');
// Route::get('/test', [TestController::class, 'index']);
Route::post('ajaxUrl',[Wishlist::class,'ajaxGetProdcut'])->name('ajaxRequest.Post');
Route::post('compare',[Compare::class,'ajaxGetProduct'])->name('ajaxcompare.post');