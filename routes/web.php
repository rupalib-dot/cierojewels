<?php
use Illuminate\Support\Facades\Route;


/*admin and vendor login routes*/
Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@login');
/*user login routes*/
Auth::routes(['verify' => true]);


/*Accees Denied routes*/
Route::view('access-denied', 'access-denied')->name('access-denied');

/*index page routes*/
Route::get('/', function(){
    return view('pages.index');
})->name('frontindex');
/*Vendor register rouets*/
Route::get('vendor-registration','VendorRegistrationController@showform')->name('vendor-registration');
Route::post('submit-vendor-registration','VendorRegistrationController@RegisterVendor')->name('submit-vendor-registration');
//------------ product filter route ----------------
Route::post('/sortby','FilterController@SortBy')->name('sortby');
Route::post('/sortbycategory','FilterController@SortByCategory')->name('sortbycategory');
Route::post('/sortbyprice','FilterController@SortByPrice')->name('sortbyprice');
/*cart routes*/
Route::post('insert/into/cart/','CartController@InsertCart')->name('insert.into.cart');
Route::get('products/cart','CartController@showCart')->name('show.cart');   //--nav--
Route::get('remove/cart/{rowId}','CartController@removeCart');
Route::post('update/cart/item','CartController@UpdateCart')->name('update.cartitem');
Route::get('cart/product/view/{id}','CartController@ViewProduct');
Route::post('apply-coupen','CartController@ApplyCoupen')->name('apply-coupen');
        //------------blog routes-------------------
/*Route::get('blog/post','BlogController@blog')->name('blog.post');   //--nav--
Route::get('language/bangla','BlogController@Bangla')->name('language.bangla');
Route::get('language/english','BlogController@English')->name('language.english');
Route::get('blog/description/{id}','BlogController@description');*/

/*user checkout*/


        //---------payment methods----------------
Route::post('user/payment/process/','PaymentController@payment')->name('payment.process');
Route::post('user/stripe/charge/','PaymentController@STripeCharge')->name('stripe.charge');
//  Category Routes 
$categoryRoutes = App\Model\Admin\Category::where('status','1')->get();
if(count($categoryRoutes) > 0){
    foreach ($categoryRoutes as $categoryRoute) {
        Route::get($categoryRoute->category_slug,'FrontController@CategoryWiseData');

    }
}


/* front end slug route always must be at the bottom for restrict from conflicts*/
/*Product routes*/
Route::get('/{product_slug}', 'ProductController@ProductView');
Route::group(['middleware' => ['auth','verified']],function(){
    Route::get('user/profile', 'HomeController@index')->name('user.profile');
    Route::get('user/order-list', 'HomeController@index')->name('user.order-list');
    Route::get('add/wishlist/{id}','WishlistController@AddWishlist');
    Route::get('user/wishlist/','CartController@Wishlist')->name('user.wishlist');
    Route::get('user/wishlist/remove/{id}','CartController@Remove');
    Route::get('user/checkout/','CartController@Checkout')->name('user.checkout');
    Route::get('/password/change', 'HomeController@changePassword')->name('password.change');
    Route::post('/password/update', 'HomeController@updatePassword')->name('update.password');
});

Route::get('admin/verify/email','Admin\VerificationController@showModel')->name('admin.verification.notice');
Route::post('admin/email/resend','Admin\VerificationController@resend')->name('admin.verification.resend');
Route::get('admin/email/verify/{id}/{hash}','Admin\VerificationController@verify')->name('verification.adminverify');


Route::group(['middleware' => ['auth:admin','VerifyAdmin']],function()
{          
        Route::get('admin/home', 'AdminController@index');
        //---------------- slider banner ------------//
        
        Route::get('admin/banner-slider', 'Admin\BannerSliderController@bannerSlider')->name('banner-slider');
        Route::post('admin/store/banner-slider', 'Admin\BannerSliderController@StorebannerSlider')->name('store.slider-banner');
        Route::get('edit/banner-slider/{id}', 'Admin\BannerSliderController@editbannerSlider');
        Route::post('update/banner-slider/{id}', 'Admin\BannerSliderController@updatebannerSlider');
        Route::get('delete/banner-slider/{id}', 'Admin\BannerSliderController@deletebannerSlider');

        //---------------- Mid banner ------------//
        Route::get('admin/mid-banner', 'Admin\MidSliderController@midSlider')->name('mid-banner');

        Route::get('admin/mid-banner/create', 'Admin\MidSliderController@create')->name('mid-banner.create');
        Route::post('admin/store/mid-banner', 'Admin\MidSliderController@StoremidSlider')->name('store.mid-banner');
        Route::get('edit/mid-banner/{id}', 'Admin\MidSliderController@edit')->name('mid-banner.edit');
        Route::post('update/mid-banner/{id}', 'Admin\MidSliderController@update')->name('mid-banner.update');
        Route::get('delete/mid-banner/{id}', 'Admin\MidSliderController@destroy')->name('mid-banner.delete');


        /*---------------- Promotional Banner ----------------------------*/
        Route::get('admin/promoional-slider', 'Admin\PromotionalController@index')->name('promotional-slider');

        Route::get('admin/promoional-slider/create', 'Admin\PromotionalController@create')->name('promotional-slider.create');
        Route::post('admin/store/promoional-slider', 'Admin\PromotionalController@Store')->name('store.promotional-slider');
        Route::get('edit/promoional-slider/{id}', 'Admin\PromotionalController@edit')->name('promotional-slider.edit');
        Route::post('update/promoional-slider/{id}', 'Admin\PromotionalController@update')->name('promotional-slider.update');
        Route::get('delete/promoional-slider/{id}', 'Admin\PromotionalController@destroy')->name('promotional-slider.delete');

        //-----categories------------
        Route::get('admin/categories', 'Admin\Category\CategoryController@category')->name('categories');
        Route::post('admin/store/category', 'Admin\Category\CategoryController@Storecategory')->name('store.category');
        Route::get('delete/category/{id}', 'Admin\Category\CategoryController@deleteCategory');
        Route::get('edit/category/{id}', 'Admin\Category\CategoryController@editCategory');
        Route::post('update/category/{id}', 'Admin\Category\CategoryController@updatecategory');
                //------subcategories-------------
        Route::get('admin/sub/categories','Admin\Category\SubcategoryController@subcategory')->name('subcategories');
        Route::post('admin/store/subcategory','Admin\Category\SubcategoryController@Storesubcategory')->name('store.subcategory');
        Route::get('delete/subcategory/{id}', 'Admin\Category\SubcategoryController@deletesubcategory');
        Route::get('edit/subcategory/{id}', 'Admin\Category\SubcategoryController@editsubcategory');
        Route::post('update/subcategory/{id}', 'Admin\Category\SubcategoryController@updatesubcategory');
                //------------- Child Category Routes ------------//
        Route::get('admin/child/categories','Admin\Category\ChildCategoryController@childcategory')->name('childcategories');
        Route::post('admin/store/childcategory','Admin\Category\ChildCategoryController@store')->name('store.childcategory');
        Route::get('delete/childcategory/{id}', 'Admin\Category\ChildCategoryController@destroy');
        Route::get('edit/childcategory/{id}', 'Admin\Category\ChildCategoryController@edit');
        Route::post('update/childcategory/{id}', 'Admin\Category\ChildCategoryController@update');

        //----------product-----------
        Route::get('admin/product/pending', 'Admin\ProductController@pendingProducts')->name('product.pending');
        Route::get('admin/product/all', 'Admin\ProductController@index')->name('all.product');
        Route::get('admin/product/add', 'Admin\ProductController@create')->name('add.product');
        Route::post('admin/store/product', 'Admin\ProductController@store')->name('store.product');
        Route::get('inactive/product/{id}','Admin\ProductController@Inactive');
        Route::get('active/product/{id}','Admin\ProductController@Active');
        Route::get('delete/product/{id}','Admin\ProductController@DeleteProduct');
        Route::get('view/product/{id}','Admin\ProductController@ViewProduct');
        Route::get('edit/product/{id}','Admin\ProductController@EditProduct');
        Route::post('update/product/withoutphoto/{id}','Admin\ProductController@UpdateProductWithoutPhoto');

        //---------coupon-------------
        Route::get('admin/coupon','Admin\CouponController@coupon')->name('coupons');
        Route::post('admin/store/coupon', 'Admin\CouponController@storeCoupon')->name('store.coupon');
        Route::get('delete/coupon/{id}', 'Admin\CouponController@deleteCoupon');
        Route::get('edit/coupon/{id}', 'Admin\CouponController@editCoupon');
        Route::post('update/coupon/{id}', 'Admin\CouponController@updateCoupon');
        Route::post('update/product/photo/{id}','Admin\ProductController@UpdateProductPhoto');
            //-------get sub cate by ajax---------
        Route::get('get/subcategory/{category_id}','Admin\ProductController@GetSubcat');
                
                //--------newsletter--------
        Route::get('admin/newsletter','Admin\CouponController@newsletter')->name('admin.newsletter');
        Route::get('delete/newsletter/{id}', 'Admin\CouponController@deletenewsletter');
            //--------seo------
        Route::get('admin/seo', 'Admin\CouponController@Seo')->name('admin.seo');
        Route::post('admin/update/seo', 'Admin\CouponController@UpdateSeo')->name('update.seo');

            //--------blog routes(en/bn)---------------
        Route::get('admin/post/categoryName','Admin\PostController@postCategory')->name('postCategory.name');   //--nav-
        Route::get('admin/post/add/categoryName','Admin\PostController@addCategory')->name('add.categoryName');
        Route::post('admin/post/store/categoryName','Admin\PostController@storeCategory')->name('store.categoryName');
        Route::get('delete/category/name/{id}','Admin\PostController@deleteCat');
        Route::get('edit/category/name/{id}','Admin\PostController@editCat');
        Route::post('update/categoryName/{id}','Admin\PostController@updateCat');
        //----------------------
        Route::get('admin/add/post', 'Admin\PostController@create')->name('add.blogpost');   //--nav-
        Route::post('admin/store/post', 'Admin\PostController@store')->name('store.post');
        Route::get('admin/all/post', 'Admin\PostController@index')->name('all.blogpost');   //--nav-
        Route::get('delete/post/{id}','Admin\PostController@destroy');
        Route::get('edit/post/{id}','Admin\PostController@edit');
        Route::post('update/post/{id}','Admin\PostController@update');
                //-----------site setting----------------
        Route::get('admin/site/setting', 'Admin\SettingController@SiteSetting')->name('admin.site.setting'); //--nav
        Route::post('admin/update/sitesetting', 'Admin\SettingController@UpdateSetting')->name('update.sitesetting');

                //-----------database backup---------------
        Route::get('admin/database/backup', 'Admin\SettingController@DatabaseBackup')->name('admin.database.backup'); //--nav
        Route::get('admin/database/backup/now', 'Admin\SettingController@BackupNow')->name('admin.backup.now');
        Route::get('delete/database/{getFilename}', 'Admin\SettingController@DeleteDatabase');
        Route::get('{getFilename}','Admin\SettingController@DownloadDatabase');

        //---------Reports routes-------------
        Route::get('admin/today/order', 'Admin\ReportController@TodayOrder')->name('today.order');  //--nav--
        Route::get('admin/today/deleverd', 'Admin\ReportController@TodayDelevered')->name('today.delevered');  //--nav--
        Route::get('admin/this/month', 'Admin\ReportController@ThisMonth')->name('this.month');  //--nav--
        Route::get('admin/search/report', 'Admin\ReportController@search')->name('search.report');  //--nav--
        Route::post('admin/search/byyear', 'Admin\ReportController@searchByYear')->name('search.by.year');
        Route::post('admin/search/bymonth', 'Admin\ReportController@searchByMonth')->name('search.by.month');
        Route::post('admin/search/bydate', 'Admin\ReportController@searchByDate')->name('search.by.date');
                //----------user role(add_admin_(child))----------------
        Route::get('admin/create/role', 'Admin\ReportController@UserRole')->name('create.user.role');
        Route::get('admin/create/admin', 'Admin\ReportController@UserCreate')->name('create.admin');
        Route::post('admin/store/admin', 'Admin\ReportController@UserStore')->name('store.admin');
        Route::get('delete/admin/{id}', 'Admin\ReportController@UserDelete');
        Route::get('edit/admin/{id}', 'Admin\ReportController@UserEdit');
        Route::post('admin/update/admin', 'Admin\ReportController@UserUpdate')->name('update.admin');
                //---------return products admin panel----------
        Route::get('admin/return/request', 'Admin\ReturnController@request')->name('admin.return.request');
        Route::get('/admin/approve/return/{id}', 'Admin\ReturnController@ApproveReturn');
        Route::get('admin/all/return', 'Admin\ReturnController@AllReturn')->name('admin.all.return');
                //--------------stock--------------------
        Route::get('admin/product/stock', 'Admin\ReturnController@Stock')->name('admin.product.stock');
        Route::get('admin/product/stockOut', 'Admin\ReturnController@StockOut')->name('admin.product.stockOut');

        

        /*Review Management*/
        Route::get('admin/all-comment', 'Admin\ReviewController@index')->name('comment.index');
        Route::get('admin/new-comment', 'Admin\ReviewController@newReview')->name('comment.newReview');
        Route::get('admin/update-review/{id}', 'Admin\ReviewController@update')->name('comment.update');
        Route::get('delete/comment/{id}', 'Admin\ReviewController@destroy')->name('comment.delete');

        //-----------admin Order routes------------
        Route::get('admin/pending/order', 'Admin\OrderController@NewOrder')->name('admin.neworder');  //--nav--
        Route::get('admin/view/order/{id}', 'Admin\OrderController@ViewOrder');
        Route::get('admin/payment/accept/{id}', 'Admin\OrderController@PaymentAccept');
        Route::get('admin/payment/cancel/{id}', 'Admin\OrderController@PaymentCancel');
        Route::get('admin/accept/payment', 'Admin\OrderController@AcceptPaymentOrder')->name('admin.accept.payment');   //--nav--
        Route::get('admin/progress/payment', 'Admin\OrderController@ProgressPaymentOrder')->name('admin.progress.payment'); //--nav--
        Route::get('admin/success/payment', 'Admin\OrderController@SuccessPaymentOrder')->name('admin.success.payment');  //--nav--
        Route::get('admin/cancel/payment', 'Admin\OrderController@CancelPaymentOrder')->name('admin.cancel.order');  //--nav--
        Route::get('admin/delevery/progress/{id}', 'Admin\OrderController@DeleveryProgress');
        Route::get('admin/delevery/done/{id}', 'Admin\OrderController@DeleveryDone');


        //Common Routes
        Route::post('admin/get-sub-categories','Admin\CommonController@getSubCategory')->name('get-sub-categories');
        Route::post('admin/get-child-categories','Admin\CommonController@getChildCategory')->name('get-child-categories');
        Route::post('admin/get-category-by-serach','Admin\CommonController@getCategoryBySearch')->name('get-category-by-serach');

        /*Seller  Business Prodfie Routes*/
        Route::get('admin/complete-business-profile','Admin\SellerBusinesController@SellerBusinessProfileView')->name('complete-business-profile');
        Route::post('admin/store-business-profile','Admin\SellerBusinesController@StoreBusinessProfile')->name('store-seller-business-profile');
        Route::get('admin/show-business-profile/','Admin\SellerBusinesController@showBusinessProfile')->name('show-seller-business-profile');

        /*Admin Seller Routes*/
        Route::get('admin/seller-list','Admin\SellerController@SellerList')->name('seller-list');
        Route::get('edit/seller/{id}','Admin\SellerController@EditSeller')->name('edit-seller');
        Route::post('update/seller/{id}','Admin\SellerController@UpdateSeller')->name('update-seller');
        Route::get('view/business-profile/{id}','Admin\SellerController@ViewBusinessProfile')->name('view-seller-business-prfile');
        Route::post('update/seller-business-profile/{id}','Admin\SellerController@UpdateSellerBusinessProfile')->name('update-seller-business');
        
        
});



/* admin password reset routes*/
Route::group(['middleware' => ['verified']],function(){
Route::get('admin/password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email'); //--d--
Route::get('admin/reset/password/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('admin/update/reset', 'Admin\ResetPasswordController@reset')->name('admin.reset.update');   //--d--
Route::get('/admin/Change/Password','AdminController@ChangePassword')->name('admin.password.change');
Route::post('/admin/password/update','AdminController@Update_pass')->name('admin.password.update');
});
Route::get('admin/logout', 'AdminController@logout')->name('admin.logout');

/*userlogout path*/
Route::get('/user/logout', 'HomeController@Logout')->name('user.logout');
