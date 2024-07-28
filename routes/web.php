<?php

use App\Models\Category;
use App\Http\Controllers\Backend;
use App\Http\Controllers\Fontend;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['prefix' => 'auth' ], function ($router) {
    Route::get('',[Auth\AuthController::class,'index'])->name('auth.index');
    Route::post('login',[Auth\AuthController::class,'login'])->name('login');
    Route::post('logout',[Auth\AuthController::class,'logout'])->name('logout');
    Route::post('register',[Auth\AuthController::class,'register'])->name('register');

    Route::get('/google', [Auth\LoginGoogleController::class,'redirectToGoogle'])->name('auth.google');
    Route::get('/google/callback', [Auth\LoginGoogleController::class,'handleGoogleCallback']);

    Route::get('/fb', [Auth\LoginFBController::class,'redirectToFB'])->name('auth.fb');
    Route::get('/fb/callback', [Auth\LoginFBController::class,'handleFBCallback']);

    Route::get('forgot-password', [Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('forgot-password', [Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('reset-password/{token}', [Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [Auth\ResetPasswordController::class, 'reset'])->name('password.update');

});

Route::group(['namespace' => 'Fontend', 'prefix' => '', 'middleware' => 'authJWT'], function () {
    Route::get('',[Fontend\HomeController::class,'index'])->name('client.home');
    Route::post('search',[Fontend\SearchController::class,'getSearch'])->name('client.search');
    Route::get('profile',[Fontend\ProfileController::class,'index'])->name('client.profile');
    Route::get('/category/{slug}',[Fontend\CategoryController::class,'index'])->name('client.category');
    Route::get('/product/{slug}',[Fontend\ProductController::class,'index'])->name('client.product_detail');
    Route::get('/sendMail/{id}',[Fontend\SendMailController::class,'sendMailActivate'])->name('client.user.Mailactivate');  
    Route::get('activate/{token}',[Fontend\SendMailController::class,'activate'])->name('client.user.activate');
    
    Route::group(['prefix' => 'cart' ] , function () {
        Route::get('index/{id}',[Fontend\CartController::class,'index']) ->name('client.cart');

        // Route::get('/create',[Fontend\CartController::class,'create']) ->name('client.cart.create');
        Route::post('/store/{id}',[Fontend\CartController::class,'store']) ->name('client.cart.store');

        Route::get('update/{id}',[Fontend\CartController::class,'edit']) ->name('client.cart.update');
        Route::post('update/{id}',[Fontend\CartController::class,'update']);

        Route::get('delete/{id}',[Fontend\CartController::class,'delete']) ->name('client.cart.delete');    
    });

    Route::group(['prefix' => 'booth' ] , function () {
        Route::get('index/{id}',[Fontend\BoothController::class,'index']) ->name('client.booth');

        Route::get('/create',[Fontend\BoothController::class,'create']) ->name('client.booth.create');
        Route::post('/store',[Fontend\BoothController::class,'store']) ->name('client.booth.store');

        Route::get('update/{id}',[Fontend\BoothController::class,'edit']) ->name('client.booth.update');
        Route::post('update/{id}',[Fontend\BoothController::class,'update']);

        Route::get('delete/{id}',[Fontend\BoothController::class,'delete']) ->name('client.booth.delete');    
    });

    Route::group(['prefix' => 'profile' ] , function () {
        Route::get('',[Fontend\ProfileController::class,'index']) ->name('client.profile.index');

        Route::get('/update/{id}',[Fontend\ProfileController::class,'edit']) ->name('client.profile.update');
        Route::post('/update/{id}',[Fontend\ProfileController::class,'update']);

        Route::get('/updatePass/{id}',[Fontend\ProfileController::class,'viewUpdatePass']) ->name('client.profile.updatePass');
        Route::post('/updatePass/{id}',[Fontend\ProfileController::class,'updatePass']);
    });

});

// Route::get('test/123', function(){
//     return view('Fontend.product.index');
// });



Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'middleware' => ['authJWT','authAdmin', 'role:Admin']], function () {
    // Route::get('',[Backend\HomeController::class,'index']) ->name('admin.home.index');
    Route::get('',[Backend\HomeController::class,'index']) ->name('admin.home.index');


    Route::group(['prefix' => 'category' ] , function () {
        Route::get('',[Backend\CategoryController::class,'index']) ->name('admin.category.index');
        Route::get('create',[Backend\CategoryController::class,'create']) ->name('admin.category.create');
        Route::post('store',[Backend\CategoryController::class,'store']) ->name('admin.category.store');

        Route::get('edit/{id}',[Backend\CategoryController::class,'edit']) ->name('admin.category.edit');
        Route::post('update/{id}',[Backend\CategoryController::class,'update']) ->name('admin.category.update');

        Route::get('delete/{id}',[Backend\CategoryController::class,'delete']) ->name('admin.category.delete');      
    });

    Route::group(['prefix' => 'product' ] , function () {
        Route::get('',[Backend\ProductController::class,'index']) ->name('admin.product.index');

        Route::get('create',[Backend\ProductController::class,'create']) ->name('admin.product.create');
        Route::post('store',[Backend\ProductController::class,'store']) ->name('admin.product.store');

        Route::get('edit/{id}',[Backend\ProductController::class,'edit']) ->name('admin.product.edit');
        Route::post('update/{id}',[Backend\ProductController::class,'update']) ->name('admin.product.update');

        Route::get('delete/{id}',[Backend\ProductController::class,'delete']) ->name('admin.product.delete');      
    });

    Route::group(['prefix' => 'user' ] , function () {
        Route::get('',[Backend\UserController::class,'index']) ->name('admin.user.index');

        
        Route::get('create',[Backend\UserController::class,'create']) ->name('admin.user.create');
        Route::post('store',[Backend\UserController::class,'store']) ->name('admin.user.store');

        Route::get('edit/{id}',[Backend\UserController::class,'edit']) ->name('admin.user.edit');
        Route::post('update/{id}',[Backend\UserController::class,'update']) ->name('admin.user.update');

        Route::get('delete/{id}',[Backend\UserController::class,'delete']) ->name('admin.user.delete');      
    });

    Route::group(['prefix' => 'profile' ] , function () {
        Route::get('/{id}',[Backend\ProfileController::class,'show']) ->name('admin.profile.show');
        Route::get('/updatePass/{id}',[Backend\ProfileController::class,'updatePass']) ->name('admin.profile.updatePass');
        Route::post('/updatePass/{id}',[Backend\ProfileController::class,'update']);
    });

    Route::group(['prefix' => 'role','middleware' => ['role:System'] ] , function () {
        Route::get('',[Backend\RoleController::class,'index']) ->name('admin.role.index');

        
        Route::get('create',[Backend\RoleController::class,'create']) ->name('admin.role.create');
        Route::post('store',[Backend\RoleController::class,'store']) ->name('admin.role.store');

        Route::get('edit/{id}',[Backend\RoleController::class,'edit']) ->name('admin.role.edit');
        Route::post('update/{id}',[Backend\RoleController::class,'update']) ->name('admin.role.update');

        Route::get('delete/{id}',[Backend\RoleController::class,'delete']) ->name('admin.role.delete');      
    });
});