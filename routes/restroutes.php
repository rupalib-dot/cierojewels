<?php

//Route::get('register-view','FrontController@RegisterView')->name('register-view');



        //---------Socialite----------
Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');

       




Route::post('user/apply/coupon/','CartController@Coupon')->name('apply.coupon');
Route::get('coupon/remove/','CartController@CouponRemove')->name('coupon.remove');
Route::get('payment/page/','CartController@PymentPage')->name('payment.step');



// //2checkout approved payment return callback
// Route::get('/callback','PaymentController@Checkout2callback');  //--------------no idea--------------

        //--------return order-------------
Route::get('success/list/','PaymentController@SuccessList')->name('success.orderlist');    //---return order----
Route::get('request/return/{id}','PaymentController@RequestReturn');

            /*Front end category routes*/









            //-------admin---------------
->middleware('verified');
Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
    //--d--

            //-------Password Reset Routes------------
     //--d--




//=============================================================================
//=============================================================================


        //---------Frontend All Routes are here:---------------
Route::post('store/newsletters','FrontController@storeNewsletter')->name('store.newsletters');
Route::post('/cart/product/add/{id}', 'ProductController@AddCart');

        //---------Order Tracking----------
Route::post('order/tracking', 'FrontController@OrderTracking')->name('order.tracking');
        //---------UserOrderView-----------
Route::get('user/view/order/{id}', 'FrontController@UserOrderView');
        //----------Search-----------
Route::post('product/search', 'FrontController@ProductSearch')->name('product.search');




//------------Customer profile related routes-----------




   //--------admin section-------------





      

