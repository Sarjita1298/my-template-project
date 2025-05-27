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
        Route::post('/upload-logo', [profileController::class, 'uploadLogo'])->name('upload.logo');
        Route::post('/update-logo-name', [profileController::class, 'updateLogoName'])->name('update.logoName');

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
       
        Route::get('blogs', [BlogController::class, 'index'])->name('blogs.index');
        Route::get('blogs/create', [BlogController::class, 'create'])->name('blogs.create');
        Route::post('blogs', [BlogController::class, 'store'])->name('blogs.store'); 
        Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
        Route::put('/blogs/{id}', [BlogController::class, 'update'])->name('blogs.update'); 
        Route::get('blogs/info/{id}', [BlogController::class, 'info'])->name('blogs.info');
        Route::get('blogs/{blogs:id}/destroy', [BlogController::class, 'destroy'])->name('blogs.destroy');










               
        Route::get('reports', [ReportController::class, 'inde
        
        
        
        
        
        
        
        x'])->name('reports.index');
        Route::get('reports/create', [ReportController::class, 'create'])->name('reports.create');
        Route::post('reports', [ReportController::class, 'store'])->name('reports.store'); 
        Route::get('/reports/{id}/edit', [ReportController::
        
        
        
        
        
        
        
        
        
        class, 'edit'])->name('reports.edit');
        Route::put('/reports/{id}', [ReportController::class, 'update'])->name('reports.update'); 
        Route::get('reports/info/{id}', [ReportController::class, 'info'])->name('reports.info');
        Route::get('reports/{reports:id}/destroy', [ReportController::class, 'destroy'])->name('reports.destroy');


    });
});

# Frontend Section

Route::get('/index', [FrontendController::class, 'index'])->name('index');

Route::get('/home', [FrontendController::class, 'home'])->name('home');
Route::get('contact',[FrontendController::class,'contact'])->name('contact');                                                           












