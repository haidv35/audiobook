<?php

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


// Route::get('/', 'HomeController@index')->name('homepage')->middleware('verified');
Route::get('/', 'HomeController@index')->name('homepage');
Route::any('/search', 'HomeController@search')->name('search');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/tutorial', 'HomeController@tutorial')->name('tutorial');
Route::get('/contact', 'HomeController@contact')->name('contact');

// Route::post('/search', 'HomeController@search')->name('search');

Route::group(['middleware' => 'auth'], function () {
    Route::get('cart', 'HomeController@displayCart')->name('cart');
    Route::get('checkout/{user_id?}/{user?}', 'HomeController@getCheckout');
    Route::post('checkout', 'HomeController@postCheckout')->name('cart.checkout');
    Route::get('pay/{order_code?}', 'HomeController@getPay');
});

Route::group(['prefix' => 'momo_payment_automatic'], function () {
    Route::get('/','Admin\MomoPaymentController@index')->name('momo');
    Route::get('/spamToInbox','Admin\MomoPaymentController@spamToInbox')->name('momo.spamtoinbox');
});


//Product
// Route::get('all-product/{sort?}', 'HomeController@display_all_product');
Route::get('all-product', 'HomeController@displayAllProduct');
Route::get('product-details/{id?}/{path?}', 'HomeController@productDetail')->name('product-details');


#user

// Auth::routes(['verify' => true]);
Auth::routes();
Route::get('auth/redirect/{provider}', 'SocialController@redirect');
Route::get('callback/{provider}', 'SocialController@callback');
Route::post('facebook', 'SocialController@facebookLogin')->name('facebook.login');

Route::get('logout',function(){
    Auth::logout();
    return redirect()->route('homepage');
});


Route::group(['middleware'=>'auth','prefix' => 'user'], function () {
    Route::get('/','UserController@index')->name('user.homepage');
    Route::get('profile','UserController@getProfile');
    Route::post('profile','UserController@postProfile');
    Route::get('orders/{order_code?}','UserController@getOrder')->name('user.orders');
    Route::get('purchased/{product_id?}','UserController@getListItemPurchased');
    Route::get('getItemPurchasedJson','UserController@getItemPurchasedJson');
    Route::get('qr-code', function () {
        return QrCode::size(500)->generate('Welcome to kerneldev.com!');
    });
});

//admin
Route::group(['middleware' => ['guest'],'prefix' => 'admin'], function () {
    Route::get('login','Admin\LoginController@getLogin')->name('admin.login');
    Route::post('login','Admin\LoginController@postLogin');
});
Route::group(['middleware' => ['is.admin','web']], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/','Admin\DashBoardController@index')->name('admin.dashboard');
        Route::get('logout', 'Admin\LoginController@logout');
        Route::group(['prefix' => 'product'], function () {
            Route::get('/','Admin\ProductController@index');
            Route::post('status','Admin\ProductController@setStatus')->name('admin.product.status');
            Route::get('create','Admin\ProductController@create')->name('admin.product.create');
            //Import excel
            Route::get('import_export','Admin\ProductController@importExportView')->name('admin.product.import_export');
            Route::post('import','Admin\ProductController@import')->name('admin.product.import');
            Route::any('export','Admin\ProductController@export')->name('admin.product.export');
            // Route::get('export_product_view','Admin\ProductController@export_product_view');

            Route::post('store','Admin\ProductController@store')->name('admin.product.store');
            Route::get('edit/{id}','Admin\ProductController@edit')->name('admin.product.edit');
            Route::post('update/{id}','Admin\ProductController@update')->name('admin.product.update');
            Route::any('delete/{id}','Admin\ProductController@destroy')->name('admin.product.destroy');
        });
        Route::group(['prefix' => 'category'], function () {
            Route::get('/','Admin\CategoryController@index')->name('admin.category');
            Route::get('/getJson','Admin\CategoryController@getJson');

            Route::post('store','Admin\CategoryController@store')->name('admin.category.store');
            //Import excel
            Route::get('import_export','Admin\CategoryController@importExportView')->name('admin.category.import_export');
            Route::post('import','Admin\CategoryController@import')->name('admin.category.import');

            Route::get('edit/{id}','Admin\CategoryController@edit')->name('admin.category.edit');
            Route::post('update/{id}','Admin\CategoryController@update')->name('admin.category.update');
            Route::any('delete/{id}','Admin\CategoryController@destroy')->name('admin.category.destroy');
        });
        Route::group(['prefix' => 'order_list'],function(){
            Route::get('orderListJson','Admin\OrderListController@orderListJson');
            Route::get('/','Admin\OrderListController@index');
            Route::get('/{order_id?}','Admin\OrderListController@index');
            Route::post('/edit','Admin\OrderListController@edit')->name('order_list.edit');
        });

        Route::group(['prefix' => 'page'],function(){
            Route::group(['prefix' => 'slider'], function () {
                Route::get('/','Admin\PageController@sliderIndex');
                Route::post('/store','Admin\PageController@sliderStore');
                Route::any('/delete/{id?}','Admin\PageController@sliderDestroy');
            });

            Route::group(['prefix' => 'footer'], function () {
                Route::get('/','Admin\PageController@footerIndex');
                Route::post('/','Admin\PageController@footerStore');
            });

            Route::group(['prefix' => 'about'], function () {
                Route::get('/','Admin\PageController@aboutIndex');
                Route::post('/','Admin\PageController@aboutStore');
            });
            Route::group(['prefix' => 'tutorial'], function () {
                Route::get('/','Admin\PageController@tutorialIndex');
                Route::post('/','Admin\PageController@tutorialStore');
            });
            Route::group(['prefix' => 'contact'], function () {
                Route::get('/','Admin\PageController@contactIndex');
                Route::post('/','Admin\PageController@contactStore');
            });

        });
        Route::group(['prefix' => 'settings'],function(){
            Route::get('payments','Admin\SettingController@getPayment');
            Route::post('payments/{type?}','Admin\SettingController@postPayment')->name('settings.payments');

            Route::get('logo','Admin\SettingController@getLogo');
            Route::post('logo','Admin\SettingController@setLogo')->name('settings.logo');
        });

    });

});
