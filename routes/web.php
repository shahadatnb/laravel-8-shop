<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomerLoginController;
use App\Http\Controllers\Auth\CustomerRegisterController;
use App\Http\Controllers\Auth\CustomerForgotPasswordController;
use App\Http\Controllers\Auth\CustomerResetPasswordController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\TaxRateController;
use App\Http\Controllers\ShippingRoleController;
use App\Http\Controllers\TaxonomyController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProductReviewController;
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
Route::get('/', [FrontController::class,'index'])->name('/');

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('payment', [App\Http\Controllers\PayPalController::class, 'payment'])->name('payment');
Route::get('cancel', [App\Http\Controllers\PayPalController::class, 'cancel'])->name('payment.cancel');
Route::get('payment/success', [App\Http\Controllers\PayPalController::class, 'success'])->name('payment.success');


//Route::get('/welcome', [StripeController::class, 'index']);
//Route::post('/transaction', [StripeController::class, 'makePayment'])->name('make-payment');



Route::get('/page/{slug}', [FrontController::class, 'page'])->name('page');
Route::get('/post/{slug}', [FrontController::class, 'page'])->name('post');

Route::get('/shop', [FrontController::class,'shop'])->name('shop');

Route::get('/product/{id}/{slug?}', [FrontController::class,'productSingle'])->name('singleProduct');
Route::get('/category/{slug}', [FrontController::class,'productByCat'])->name('productByCat');

//Route::post('/loginNext', [LoginController::class,'loginStep2'])->name('loginNext');
//Route::match(['GET', 'POST'],'/loginNext', [LoginController::class,'loginStep2'])->name('loginNext');

Route::match(['GET', 'POST'],'/confirm', [UsersController::class,'confirm'])->name('confirm');

Route::get('/home', function(){ return redirect()->route('dashboard'); });

//Route::get('/home', [HomeController::class,'index'])->name('home');

Route::prefix(config('app.admin_prefix','admin'))->group(function() {
    //Auth::routes(['register' => false]);//['verify'=> false]
    Auth::routes(['register' => false]);
});

Route::get('/stateApi', [LocationController::class, 'stateApi'])->name('stateApi');

Route::get('/cart',[CheckoutController::class, 'cart'])->name('cart');
Route::group(['middleware'=>'auth:customer'], function(){
    Route::post('/product-review',[ProductReviewController::class, 'store'])->name('product-review');
    Route::get('/checkout',[CheckoutController::class, 'index'])->name('checkout');
    Route::post('/placeOrder',[CheckoutController::class, 'checkout'])->name('placeOrder');
});

Route::get('social-auth/{provider}/callback',[SocialLoginController::class,'providerCallback']);
Route::get('social-auth/{provider}',[SocialLoginController::class,'redirectToProvider'])->name('social.redirect');

Route::get('login', [CustomerLoginController::class, 'showLoginForm'])->name('customer.login');
Route::post('login', [CustomerLoginController::class, 'login'])->name('customer.loginPost');
Route::post('logout', [CustomerLoginController::class, 'logout'])->name('customer.logout');
Route::get('register', [CustomerRegisterController::class, 'showRegisterForm'])->name('customer.register');
Route::post('register', [CustomerRegisterController::class, 'register'])->name('customer.registerPost');

//Customer Password Reset routes 
Route::post('/password/email',[CustomerForgotPasswordController::class, 'sendResetLinkEmail'])->name('customer.password.email');
Route::post('/password/reset', [CustomerResetPasswordController::class, 'reset'])->name('customer.password.update');
Route::get('/password/reset', [CustomerForgotPasswordController::class, 'showLinkRequestForm'])->name('customer.password.request');                                     
Route::get('/password/reset/{token}', [CustomerResetPasswordController::class, 'showResetForm'])->name('customer.password.reset');

    //Route::match(['GET', 'POST'],'/confirm', [CustomerRegisterController::class,'confirm'])->name('customer.confirm');

Route::prefix('customer')->as('customer.')->group(function() {
    Route::group(['middleware'=>'auth:customer'], function(){
        Route::get('/', [CustomerController::class,'index'])->name('/');
        Route::get('/wishlist', [CustomerController::class,'wishlist'])->name('wishlist');
        Route::get('/removeWishlist/{id}', [WishlistController::class,'removeWishlist'])->name('removeWishlist');

        Route::post('/order/itemRefund/{id}', [CustomerController::class,'orderItemRefund'])->name('order.item.refund');
        Route::get('/order/refund/{id}', [CustomerController::class,'orderRefund'])->name('order.refund');
        Route::get('/order/{id}', [CustomerController::class,'orderShow'])->name('order.show');
        Route::get('/orders', [CustomerController::class,'orders'])->name('orders');

        Route::get('/profile', [CustomerController::class,'profile'])->name('profile');
        Route::post('/profile/{customer}', [CustomerController::class,'profileUpdate'])->name('profile.update');
    });

});


Route::group(['prefix'=>config('app.admin_prefix','admin'),'middleware'=>'auth'], function(){
    Route::get('/', [HomeController::class,'index'])->name('dashboard');
    Route::get('/profile', [UsersController::class,'profile'])->name('profile');
    Route::get('/editProfile', [UsersController::class,'editProfile'])->name('editProfile');
    Route::post('/updateProfile', [UsersController::class,'updateProfile'])->name('updateProfile');
    Route::post('/chengePassword', [UsersController::class,'chengePassword'])->name('chengePassword');
});

//Route::get('admin', [App\http\controllers\AdminController::class,'index']);

Route::resource('users', UsersController::class)->middleware(['auth','role:admin,staff']);
Route::resource('roles', RolesController::class)->middleware(['auth','role:admin']);//->middleware('can:isAdmin');


Route::group(['prefix'=>config('app.admin_prefix','admin'),'middleware'=> ['auth','role:admin,staff']], function(){
    Route::match(['GET', 'POST'],'/createUser/{role}', [UsersController::class, 'createUser'])->name('createUser');
    Route::match(['GET', 'POST'],'/editUser/{role}/{id}', [UsersController::class, 'editUser'])->name('editUser');
    Route::get('/userList/{role}', [UsersController::class, 'userList'])->name('userList');

    Route::get('/customer', [HomeController::class, 'customer'])->name('admin.customer');
    Route::get('/customer/edit/{id}', [HomeController::class, 'customerEdit'])->name('admin.customer.edit');
    Route::post('/customer/update/{id}', [CustomerRegisterController::class, 'update'])->name('admin.customer.update');
    Route::delete('/customer/destroy/{id}', [CustomerRegisterController::class, 'destroy'])->name('admin.customer.destroy');

    Route::resource('review', ProductReviewController::class);
    Route::resource('shippingRole', ShippingRoleController::class);

    Route::post('attribute/option/add', [AttributeController::class, 'optionAdd'])->name('attribute.option.add');
    Route::get('attribute/option/delete/{id}', [AttributeController::class, 'optionDelete'])->name('attribute.option.delete');
    Route::resource('attribute', AttributeController::class);

    Route::resource('category', CategoryController::class);
    Route::get('product/inventory', [ProductController::class, 'productInventory'])->name('product.inventory');
    Route::post('product/productInventoryUpdate', [ProductController::class, 'productInventoryUpdate'])->name('product.inventoryUpdate');
    Route::get('product/restore/{id}', [ProductController::class, 'restoreProduct'])->name('product.restore');
    Route::get('product/permanentdelete/{id}', [ProductController::class, 'permanentdelete'])->name('product.permanentdelete');
    Route::get('product/trashed', [ProductController::class, 'trashedProduct'])->name('product.trashed');
    Route::resource('product', ProductController::class);

    Route::get('/productSize', [ProductController::class, 'productSize'])->name('productSize');
    Route::get('/productColor', [ProductController::class, 'productColor'])->name('productColor');

    Route::get('order/invoicePDF/{order}', [OrderController::class, 'invoicePDF'])->name('order.invoice.pdf');
    Route::match(['GET', 'POST'],'order/product-sell-view', [OrderController::class, 'productSellView'])->name('order.product.view');
    Route::resource('order', OrderController::class);

    Route::resource('coupon', CouponController::class);
    Route::resource('homepage', HomepageController::class);

    Route::post('/user-ban', [UsersController::class, 'ban'])->name('user-ban');
    Route::get('/user-unban/{id}', [UsersController::class, 'unban'])->name('user-unban');
});


Route::group(['prefix'=>config('app.admin_prefix','admin'),'middleware'=> ['auth','role:admin']], function(){

    Route::get('/ac_config', function()
    {
        $exitCode = Artisan::call('config:cache');
        return 'OK';
    })->name('ac_config');

    Route::resource('taxrate', TaxRateController::class);

    Route::get('/basic-settings', [AdminController::class, 'settings'])->name('settings');
    Route::put('/saveSetting/{id}', [AdminController::class,'saveSetting'])->name('saveSetting');

    Route::resource('menus', MenuController::class);
    Route::post('/menuItemStore', [MenuController::class, 'menuItemStore'])->name('menuItem.store');
    Route::post('/menuItemUpdate/{id}', [MenuController::class, 'menuItemUpdate'])->name('menuItem.update');
    Route::get('/menuItemEdit/{id}', [MenuController::class, 'menuItemEdit'])->name('menuItem.edit');
    Route::get('/menuItemDelete/{id}', [MenuController::class, 'menuItemDelete'])->name('menuItem.delete');

    Route::resource('posts', PostsController::class);
//    Route::get('PostDelete/{id}',[PostsController::class, 'PostDelete')->name('PostDelete');
    Route::get('postOrder', [PostsController::class, 'postOrder'])->name('postOrder');

    Route::resource('taxonomy', TaxonomyController::class);
	Route::get('taxonomy/hide{id}', [TaxonomyController::class, 'hide'])->name('taxonomy.hide');
});
