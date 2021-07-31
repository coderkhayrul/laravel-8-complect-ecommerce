<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\AdminUserController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ReturnController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryControlle;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomeBlogController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\User\CashController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\WishListController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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


// =======================================
// %%%%%%%  FRONTEND ROUTE LIST  %%%%%%%%%
// =======================================


Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $id = Auth::user()->id;
    $user = User::find($id);
    return view('dashboard', compact('user'));
})->name('dashboard');

// USER PROFILE ROUTES
Route::get('/', [IndexController::class, 'index']);

Route::get('/user/logout', [IndexController::class, 'userLogout'])->name('user.logout');
Route::get('/user/profile', [IndexController::class, 'userProfile'])->name('user.profile');
Route::post('/user/profile/store', [IndexController::class, 'userProfileStore'])->name('user.profile.store');
Route::get('/user/change/password', [IndexController::class, 'userChangePassword'])->name('user.change.password');
Route::post('/user/password/update', [IndexController::class, 'userPasswordUpdate'])->name('user.password.update');


// Multi Language Route List
Route::get('/language/english/', [LanguageController::class, 'English'])->name('english.language');
Route::get('/language/hindi/', [LanguageController::class, 'Hindi'])->name('hindi.language');

// Product Routes List
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'productDetails']);

// Product Tags
Route::get('/product/tag/{tag}', [IndexController::class, 'tagWiseProduct']);

// Get SubCategory Wise Data
Route::get('/subcategory/product/{id}/{slug}', [IndexController::class, 'subcatWiseProduct']);

// Get Sub SubCategory Wise Data
Route::get('/subsubcategory/product/{id}/{slug}', [IndexController::class, 'subSubcatWiseProduct']);

// Cart Route List
// Product View Models With Ajex
Route::get('/product/view/modal/{id}', [IndexController::class, 'productViewAjex']);

// Add To Cart Store Data
Route::post('/cart/data/store/{id}', [CartController::class, 'addToCart']);

// Get Data From Mini Cart
Route::get('/product/mini/cart', [CartController::class, 'AddMiniCart']);

Route::get('/minicart/product-remove/{rowId}', [CartController::class, 'removeMiniCart']);


////////////////////////////////  <!-- USER LOGIN  SYSTEM ROUTES --> /////////////////////////////
Route::group(['prefix' => 'user', 'middleware' => ['user', 'auth'], 'namespace' => 'User'], function () {

    // Add To Wishlist
    Route::post('/add-to-wishlist/{product_id}', [CartController::class, 'addToWishlist']);
    // view wishlist page
    Route::get('/wishlist', [WishListController::class, 'viewWishlish'])->name('wishlist');
    // Get Wishlist
    Route::get('/get-wishlist/product', [WishListController::class, 'getWishlishProduct']);
    // Wishlist Remove
    Route::get('/wishlist/remove/{id}', [WishListController::class, 'removeWishlishProduct']);

    // Stripe Route
    Route::post('/stripe/order', [StripeController::class, 'stripOrder'])->name('stripe.order');

    // Cash Route
    Route::post('/cash/order', [CashController::class, 'cashOrder'])->name('cash.order');


    // Order Route List
    Route::get('/my/orders', [AllUserController::class, 'myOrders'])->name('my.orders');

    Route::get('/order_details/{order_id}', [AllUserController::class, 'orderDetails']);

    Route::get('/invoice_download/{order_id}', [AllUserController::class, 'invoiceDownload']);

    // Return Order Route
    Route::get('/return/order/list', [AllUserController::class, 'returnOrderList'])->name('return.orders.list');
    Route::post('/return/order/{order_id}', [AllUserController::class, 'returnOrder'])->name('return.order');

    Route::get('/cancel/orders', [AllUserController::class, 'cancelOrder'])->name('cancel.orders');

    // <!-- Order Tracking Route -->
    Route::post('/orders/tracking', [AllUserController::class, 'orderTracking'])->name('order.tracking');
});


// MY CART
Route::get('/user/mycart', [CartPageController::class, 'myCart'])->name('mycart');

Route::get('/user/get-cart-product', [CartPageController::class, 'getCartProduct']);
Route::get('/user/cart/remove/{id}', [CartPageController::class, 'removeCartProduct']);

Route::get('/cart/increment/{rowId}', [CartPageController::class, 'cartIncrement']);
Route::get('/cart/decrement/{rowId}', [CartPageController::class, 'cartDecrement']);


// Frontend Coupon Option
Route::post('/coupon-apply', [CartController::class, 'couponApply']);
Route::get('/coupon/calculation', [CartController::class, 'couponCalculation']);
Route::get('/coupon/remove', [CartController::class, 'couponRemove']);

// Check Out Route List
Route::get('/checkout', [CartController::class, 'checkoutCreate'])->name('checkout');
Route::post('/checkout/store', [CheckoutController::class, 'checkoutStore'])->name('checkout.store');

Route::get('/checkout/district/ajax/{division_id}', [CheckoutController::class, 'getCheckoutDristrictData']);
Route::get('/checkout/state/ajax/{district_id}', [CheckoutController::class, 'getCheckoutStateData']);

// BLOG
Route::get('/blog', [HomeBlogController::class, 'addBlogPost'])->name('home.blog');

Route::get('/blog/details/{id}', [HomeBlogController::class, 'blogPostDetails'])->name('post.details');

Route::get('/blog/category/post/{id}', [HomeBlogController::class, 'homeBlogCategoryPost'])->name('blog.category.post');

// Product Review Route List
Route::post('/review/store', [ReviewController::class, 'reviewStore'])->name('review.store');

// Product Search Route
Route::post('/search', [IndexController::class, 'productSearch'])->name('product.search');

// Advance Search Route
Route::post('/search-product', [IndexController::class, 'searchProduct']);









// =======================================
// %%%%%%%%  BACKEND ROUTE LIST  %%%%%%%%%
// =======================================

Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function () {
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});
Route::middleware(['auth:admin'])->group(function () {

    Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('admin.dashboard')->middleware('auth:admin');


    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');


    // ADMIN PROFILE ROUTES
    Route::get('admin/profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');
    Route::get('admin/profile/edit', [AdminProfileController::class, 'adminProfileEdit'])->name('admin.profile.edit');
    Route::post('admin/profile/store', [AdminProfileController::class, 'adminProfileStore'])->name('admin.profile.store');
    Route::get('admin/profile/password', [AdminProfileController::class, 'adminProfilePassword'])->name('admin.profile.password');
    Route::post('update/profile/password', [AdminProfileController::class, 'updateProfilePassword'])->name('update.profile.password');

    // ADMIN BRAND ROUTES
    Route::prefix('brand')->group(function () {
        Route::get('/view', [BrandController::class, 'brandView'])->name('all.brand');
        Route::post('/store', [BrandController::class, 'brandStore'])->name('brand.store');
        Route::get('/edit/{id}', [BrandController::class, 'brandEdit'])->name('brand.edit');
        Route::post('/update/{id}', [BrandController::class, 'brandUpdate'])->name('brand.update');
        Route::get('/delete/{id}', [BrandController::class, 'brandDelete'])->name('brand.delete');
    });

    // ADMIN CATEGORY ROUTES
    Route::prefix('category')->group(function () {

        // ADMIN CATEGORY ROUTES
        Route::get('/view', [CategoryController::class, 'categoryView'])->name('all.category');
        Route::post('/store', [CategoryController::class, 'categoryStore'])->name('category.store');
        Route::get('/edit/{id}', [CategoryController::class, 'categoryEdit'])->name('category.edit');
        Route::post('/update/{id}', [CategoryController::class, 'categoryUpdate'])->name('category.update');
        Route::get('/delete/{id}', [CategoryController::class, 'categoryDelete'])->name('category.delete');

        // ADMIN SUB-CATEGORY ROUTES
        Route::get('/sub/view', [SubCategoryControlle::class, 'subcategoryView'])->name('all.subcategory');
        Route::post('/sub/store', [SubCategoryControlle::class, 'subcategoryStore'])->name('subcategory.store');
        Route::get('/sub/edit/{id}', [SubCategoryControlle::class, 'subcategoryEdit'])->name('subcategory.edit');
        Route::post('/sub/update/{id}', [SubCategoryControlle::class, 'subcategoryUpdate'])->name('subcategory.update');
        Route::get('/sub/delete/{id}', [SubCategoryControlle::class, 'subcategoryDelete'])->name('subcategory.delete');

        // ADMIN SUB->SUB-CATEGORY ROUTES
        Route::get('/sub/sub/view', [SubCategoryControlle::class, 'subsubcategoryView'])->name('all.subsubcategory');
        Route::get('/subcategory/ajax/{category_id}', [SubCategoryControlle::class, 'GetSubCategory']);
        Route::get('/sub-subcategory/ajax/{subcategory_id}', [SubCategoryControlle::class, 'GetSubSubCategory']);

        Route::post('/sub/sub/store', [SubCategoryControlle::class, 'subsubcategoryStore'])->name('subsubcategory.store');
        Route::get('/sub/sub/edit/{id}', [SubCategoryControlle::class, 'subsubcategoryEdit'])->name('subsubcategory.edit');
        Route::post('/sub/sub/update/{id}', [SubCategoryControlle::class, 'sububcategoryUpdate'])->name('subsubcategory.update');
        Route::get('/sub/sub/delete/{id}', [SubCategoryControlle::class, 'subsubcategoryDelete'])->name('subsubcategory.delete');
    });

    // ADMIN PRODUCT ROUTES
    Route::prefix('product')->group(function () {

        Route::get('/add', [ProductController::class, 'allProduct'])->name('add-product');
        Route::post('/store', [ProductController::class, 'storeProduct'])->name('product-store');
        Route::get('/manage', [ProductController::class, 'manageProduct'])->name('manage-product');
        Route::get('/edit/{id}', [ProductController::class, 'editProduct'])->name('product.edit');
        Route::post('/update/{id}', [ProductController::class, 'updateProduct'])->name('product-update');
        Route::post('/multi/image/update', [ProductController::class, 'multiImageUpdate'])->name('update.multi.image');
        Route::post('/image/update', [ProductController::class, 'productImageUpdate'])->name('update.product.image');
        Route::get('/delete/{id}', [ProductController::class, 'productDelete'])->name('product.delete');

        Route::get('/multiimg/delete/{id}', [ProductController::class, 'multiImageDelete'])->name('product.multiimage.delete');

        // PRODUCT STATUS ROUTE
        Route::get('/active/{id}', [ProductController::class, 'productActive'])->name('product.active');
        Route::get('/inactive/{id}', [ProductController::class, 'productInActive'])->name('product.inactive');
    });

    // ADMIN Slider ROUTES
    Route::prefix('slider')->group(function () {

        Route::get('/view', [SliderController::class, 'manageSlider'])->name('manage-slider');
        Route::post('/store', [SliderController::class, 'storeSlider'])->name('slider.store');
        Route::get('/edit/{id}', [SliderController::class, 'editSlider'])->name('slider.edit');
        Route::post('/update/{id}', [SliderController::class, 'updateSlider'])->name('slider.update');
        Route::get('/delete/{id}', [SliderController::class, 'deleteSlider'])->name('slider.delete');

        // PRODUCT STATUS ROUTE
        Route::get('/active/{id}', [SliderController::class, 'sliderActive'])->name('slider.active');
        Route::get('/inactive/{id}', [SliderController::class, 'sliderInActive'])->name('slider.inactive');
    });

    // ADMIN COUPONS ROUTES
    Route::prefix('coupons')->group(function () {

        Route::get('/view', [CouponController::class, 'couponView'])->name('manage-coupon');
        Route::post('/store', [CouponController::class, 'couponStore'])->name('coupon.store');
        Route::get('/edit/{id}', [CouponController::class, 'couponEdit'])->name('coupon.edit');
        Route::post('/update/{id}', [CouponController::class, 'couponUpdate'])->name('coupon.update');
        Route::get('/delete/{id}', [CouponController::class, 'couponDelete'])->name('coupon.delete');
    });

    // ADMIN SHIPPING ROUTES
    Route::prefix('shipping')->group(function () {

        // Ship Division
        Route::get('/division/view', [ShippingAreaController::class, 'divisionView'])->name('manage-division');
        Route::post('/division/store', [ShippingAreaController::class, 'divisionStore'])->name('division.store');
        Route::get('/division/edit/{id}', [ShippingAreaController::class, 'divisionEdit'])->name('division.edit');
        Route::post('/division/update/{id}', [ShippingAreaController::class, 'divisionUpdate'])->name('division.update');
        Route::get('/division/delete/{id}', [ShippingAreaController::class, 'divisionDelete'])->name('division.delete');

        // Ship District
        Route::get('/district/view', [ShippingAreaController::class, 'districtView'])->name('manage-district');
        Route::post('/district/store', [ShippingAreaController::class, 'districtStore'])->name('district.store');
        Route::get('/district/edit/{id}', [ShippingAreaController::class, 'districtEdit'])->name('district.edit');
        Route::post('/district/update/{id}', [ShippingAreaController::class, 'districtUpdate'])->name('district.update');
        Route::get('/district/delete/{id}', [ShippingAreaController::class, 'districtDelete'])->name('district.delete');

        Route::get('/district/ajax/{division_id}', [ShippingAreaController::class, 'GetStateData']);
        // State District
        Route::get('/state/view', [ShippingAreaController::class, 'stateView'])->name('manage-state');
        Route::post('/state/store', [ShippingAreaController::class, 'stateStore'])->name('state.store');
        Route::get('/state/edit/{id}', [ShippingAreaController::class, 'stateEdit'])->name('state.edit');
        Route::post('/state/update/{id}', [ShippingAreaController::class, 'stateUpdate'])->name('state.update');
        Route::get('/state/delete/{id}', [ShippingAreaController::class, 'stateDelete'])->name('state.delete');
    });

    // ADMIN ORDER ROUTES
    Route::prefix('orders')->group(function () {

        // Pending Order Route
        Route::get('/pending/orders', [OrderController::class, 'pendingOrders'])->name('pending-orders');
        Route::get('/pending/details/{order_id}', [OrderController::class, 'pendingOrdersDetails'])->name('pending.order.details');
        Route::get('/pending/confirm/{order_id}', [OrderController::class, 'pendingToConfirm'])->name('pending-confirm');


        // Confirmed Order Route
        Route::get('/confirmed/orders', [OrderController::class, 'confirmedOrder'])->name('confirmed.order');
        Route::get('/confirmed/processing/{order_id}', [OrderController::class, 'confirmedToProcessing'])->name('confirmed-processing');

        Route::get('/invoice/download/{order_id}', [OrderController::class, 'adminInvoiceDownload'])->name('invoice.download');


        // Processing Order Route
        Route::get('/processing/orders', [OrderController::class, 'processingOrder'])->name('processing.order');
        Route::get('/processing/picked/{order_id}', [OrderController::class, 'processingToPicked'])->name('processing-picked');

        // Picked Order Route
        Route::get('/picked/orders', [OrderController::class, 'pickedOrder'])->name('picked.order');
        Route::get('/picked/shipped/{order_id}', [OrderController::class, 'pickedToShipped'])->name('picked-shipped');

        // Shipped Order Route
        Route::get('/shipped/orders', [OrderController::class, 'shippedOrder'])->name('shipped.order');
        Route::get('/shipped/delivered/{order_id}', [OrderController::class, 'ShippedToDelivered'])->name('shipped-delivered');

        // Delivered Order Route
        Route::get('/delivered/orders', [OrderController::class, 'deliveredOrder'])->name('delivered.order');
        Route::get('/delivered/cancel/{order_id}', [OrderController::class, 'DeliveredToCancel'])->name('delivered-cancel');


        // Cancel Order Route
        Route::get('/cancel/orders', [OrderController::class, 'cancelOrder'])->name('cancel.order');
    });

    // ALL REPORTS ROUTES
    Route::prefix('reports')->group(function () {

        // All Reports
        Route::get('/view', [ReportController::class, 'reportView'])->name('all-reports');
        Route::post('/search-by-date', [ReportController::class, 'reportByDate'])->name('search-by-date');
        Route::post('/search-by-month', [ReportController::class, 'reportByMonth'])->name('search-by-month');
        Route::post('/search-by-year', [ReportController::class, 'reportByYear'])->name('search-by-year');
    });

    // ALL Users ROUTES
    Route::prefix('alluser')->group(function () {

        // All Reports
        Route::get('/view', [AdminProfileController::class, 'Allusers'])->name('all-users');
    });

    // All Blog ROUTES
    Route::prefix('blog')->group(function () {

        Route::get('/category', [BlogController::class, 'BlogCategory'])->name('blog.category');
        Route::post('/category/store', [BlogController::class, 'BlogCategoryStore'])->name('blog.category.store');
        Route::get('/category/edit/{id}', [BlogController::class, 'BlogCategoryEdit'])->name('blog.category.edit');
        Route::post('/category/update/{id}', [BlogController::class, 'BlogCategoryUpdate'])->name('blog.category.update');
        Route::get('/category/delete/{id}', [BlogController::class, 'BlogCategoryDelete'])->name('blog.category.delete');

        // Blog Post
        Route::get('/view/post', [BlogController::class, 'viewBlogPost'])->name('view.blog.post');
        Route::get('/post/add', [BlogController::class, 'blogPostAdd'])->name('blog.post.add');
        Route::post('/post/store', [BlogController::class, 'blogPostStore'])->name('blog.post.store');
        Route::get('/post/edit/{id}', [BlogController::class, 'blogPostEdit'])->name('blog.post.edit');
        Route::post('/post/update/{id}', [BlogController::class, 'blogPostUpdate'])->name('blog.post.update');
        Route::get('/post/delete/{id}', [BlogController::class, 'blogPostDelete'])->name('blog.post.delete');

        Route::post('/image/update', [BlogController::class, 'blogPostImageUpdate'])->name('post.image.update');
    });

    // ALL Setting ROUTES
    Route::prefix('setting')->group(function () {

        // All Site Setting
        Route::get('/site', [SiteSettingController::class, 'siteSetting'])->name('site.setting');
        Route::post('/site/update', [SiteSettingController::class, 'updateSiteSetting'])->name('update.site.setting');

        Route::get('/seo', [SiteSettingController::class, 'seoSetting'])->name('seo.setting');
        Route::post('/seo/update', [SiteSettingController::class, 'updateSeoSetting'])->name('update.seo.setting');
    });

    // ALL Return Request ROUTES
    Route::prefix('return')->group(function () {

        Route::get('/admin/request', [ReturnController::class, 'returnRequest'])->name('return.request');
        Route::get('/admin/approve/{id}', [ReturnController::class, 'returnApprove'])->name('return.approve');
        Route::get('/admin/all/request', [ReturnController::class, 'returnAllRequest'])->name('all.request');
    });

    // ALL Review ROUTES
    Route::prefix('review')->group(function () {

        Route::get('/pending', [ReviewController::class, 'pendingReview'])->name('pending.review');
        Route::get('/admin/approve/{id}', [ReviewController::class, 'reviewApprove'])->name('review.approve');
        Route::get('/admin/published/', [ReviewController::class, 'publishedReview'])->name('published.review');
        Route::get('/admin/delete/{id}', [ReviewController::class, 'deleteReview'])->name('delete.review');
    });

    // ALL Review ROUTES
    Route::prefix('stock')->group(function () {

        Route::get('/product', [ProductController::class, 'productStock'])->name('product.stock');
    });

    // ALL Admin User ROUTES
    Route::prefix('adminuserrole')->group(function () {

        Route::get('/all', [AdminUserController::class, 'allAdminRole'])->name('all.admin.user');
        Route::get('/add', [AdminUserController::class, 'addAdminRole'])->name('add.admin');
        Route::post('/store', [AdminUserController::class, 'storeAdminRole'])->name('admin.user.store');
        Route::get('/edit/{id}', [AdminUserController::class, 'editAdminRole'])->name('edit.admin.user');
        Route::post('/update', [AdminUserController::class, 'updateAdminRole'])->name('admin.user.update');
        Route::get('/delete/{id}', [AdminUserController::class, 'deleteAdminRole'])->name('admin.user.delete');
    });
});
