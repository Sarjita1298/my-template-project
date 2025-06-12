<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CartController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/create-admin', [AdminController::class, 'createAdmin']);

Route::get('/index', [MasterController::class, 'layout']);

#  Backend Section
Route::prefix('admin')->group(function () {
    
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::middleware(['auth:admin'])->group(function () {

        Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change_password');
        Route::put('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change_password');
        Route::post('/upload-logo', [ProfileController::class, 'uploadLogo'])->name('upload.logo');
        Route::post('/update-logo-name', [ProfileController::class, 'updateLogoName'])->name('update.logoName');

        Route::get('profile', [AdminController::class, 'show'])->name('profile.show');
        Route::post('profile/update-picture', [AdminController::class, 'updatePicture'])->name('profile.updatePicture');
        
        Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show'); 
        Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
       
        Route::get('products', [ProductController::class, 'index'])->name('products.index');
        Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('products', [ProductController::class, 'store'])->name('products.store'); 
        Route::get('products/info/{id}', [ProductController::class, 'info'])->name('products.info');
        Route::get('products/{product:id}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
        Route::get('/products/view/{id}', [ProductController::class, 'info'])->name('productview');

       
        Route::get('blogs', [BlogController::class, 'index'])->name('blogs.index');
        Route::get('blogs/create', [BlogController::class, 'create'])->name('blogs.create');
        Route::post('blogs', [BlogController::class, 'store'])->name('blogs.store'); 
        Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
        Route::put('/blogs/{id}', [BlogController::class, 'update'])->name('blogs.update'); 
        Route::get('blogs/info/{id}', [BlogController::class, 'info'])->name('blogs.info');
        Route::get('blogs/{blogs:id}/destroy', [BlogController::class, 'destroy'])->name('blogs.destroy');
      
        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('reports/create', [ReportController::class, 'create'])->name('reports.create');
        Route::post('reports', [ReportController::class, 'store'])->name('reports.store'); 
        Route::get('/reports/{id}/edit', [ReportController::class, 'edit'])->name('reports.edit');
        Route::put('/reports/{id}', [ReportController::class, 'update'])->name('reports.update');
        // Route::get('/reports/info/{id}', [ReportController::class, 'info'])->name('reports.info');
        Route::get('reports/{reports:id}/destroy', [ReportController::class, 'destroy'])->name('reports.destroy');
        Route::get('reports/info/{id}', [ReportController::class, 'info'])->name('reports.info');
      
        // Show the shipping form for a specific order
        Route::get('/orders/{id}/shipping', [ReportController::class, 'showShipping'])->name('order.shipping');

        // Update shipping details for the order
        Route::post('/orders/{id}/shipping', [ReportController::class, 'updateShipping'])->name('order.shipping.update');

        // Toggle order status (shipped <-> pending)
        Route::post('/orders/{id}/toggle-status', [ReportController::class, 'toggleStatus'])->name('order.status.toggle');
              
        Route::post('reports/{id}/approve', [ReportController::class, 'approve'])->name('reports.approve');
        Route::post('reports/{id}/reject', [ReportController::class, 'reject'])->name('reports.reject');
        Route::post('reports/{id}/pickup', [ReportController::class, 'pickup'])->name('reports.pickup');
        Route::post('reports/{id}/refund', [ReportController::class, 'refund'])->name('reports.refund');
        Route::post('reports/{id}/complete', [ReportController::class, 'complete'])->name('reports.complete');



    });
    
});

# Frontend Section

Route::get('/index', [FrontendController::class, 'index'])->name('index');
Route::get('/home', [FrontendController::class, 'home'])->name('home');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact-submit', [FrontendController::class, 'submit'])->name('contact.submit');
Route::get('/register', [FrontendController::class, 'register'])->name('register');
Route::get('/password/request', [FrontendController::class, 'passwordrequest'])->name('password.request');
Route::get('/shop', [FrontendController::class, 'shop'])->name('shop');
Route::get('/shop/product/{id}', [FrontendController::class, 'showSingleProduct'])->name('shop.product');

Route::get('/cart', [FrontendController::class, 'cart'])->name('cart');
Route::get('/your-cart', [FrontendController::class, 'cartpage'])->name('your-cart');
Route::post('/your-cart', [FrontendController::class, 'cartpage'])->name('your-cart');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart-update', [FrontendController::class, 'addToCart'])->name('cart.update');

Route::post('/add-to-cart/{id}', [FrontendController::class, 'addToCart'])->name('cart.add');

// Route::post('/add-to-cart', [FrontendController::class, 'addToCart'])->name('cart.add');
Route::get('/get-districts', [FrontendController::class, 'getDistricts'])->name('get.districts');
Route::get('/get-pincode', [FrontendController::class, 'getPincode'])->name('get.pincode');
Route::get('/product/{id}', [FrontendController::class, 'showSingleProduct'])->name('product.single');
Route::post('/update-shipping', [FrontendController::class, 'updateShipping'])->name('shipping.update');
Route::get('/checkout', [FrontendController::class, 'checkout'])->name('checkout');
Route::get('/account', [FrontendController::class, 'account'])->name('accountpage');
Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
Route::get('/singleblog', [FrontendController::class, 'singleblog'])->name('singleblog');
Route::post('/checkout/submit', [FrontendController::class, 'submitCheckout'])->name('checkout.submit');


Route::post('/subscribe', [FrontendController::class, 'store'])->name('subscribe.store');



// Cart related routes
// Route::get('/cart', [CartController::class, 'index'])->name('cart');                    // Show cart page
// Route::get('/your-cart', [CartController::class, 'cartPage'])->name('your-cart');         // Another cart page (GET)
// Route::post('/your-cart', [CartController::class, 'cartPage'])->name('your-cart');        // Update cart (POST)

// Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');      // Add product to cart

// Route::get('/get-districts', [CartController::class, 'getDistricts'])->name('get.districts');   // Get districts (AJAX)
// Route::get('/get-pincode', [CartController::class, 'getPincode'])->name('get.pincode');          // Get pincode (AJAX)

// Route::post('/update-shipping', [CartController::class, 'updateShipping'])->name('shipping.update'); // Update shipping details


Route::get('/customer/logout', [CustomerController::class, 'logout'])->name('customer.logout');
Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');

Route::get('/customer/profile', [CustomerController::class, 'profileIndex'])->name('customerprofile.index');
Route::put('/customer/profile/update', [CustomerController::class, 'profileUpdate'])->name('customerprofile.update');

Route::get('/customer/change-password', [CustomerController::class, 'changePasswordForm'])->name('customerpassword.password');
Route::post('/customer/change-password', [CustomerController::class, 'changePassword'])->name('customerpassword.update');











