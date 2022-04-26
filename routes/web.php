<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DetailController;

use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardTransactionController;
use App\Http\Controllers\DashboardSettingController;


use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Sales\SalesDashboardController;

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


// Route::middleware('guest')->group(function () {
    // Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    // Route::get('/login', [LoginController::class, 'login']);
    // Route::get('/login', [LoginController::class, 'logout'])->name('logout');

    // Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    // Route::get('/register', [RegisterController::class, 'register']);

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

    Route::get('/categories/{id}', [CategoryController::class, 'detail'])->name('categories-detail');

    Route::get('/details/{id?}', [DetailController::class, 'index'])->name('detail');
    Route::post('/details/{id?}', [DetailController::class, 'add'])->name('detail-add');

    

    // Route::post('/checkout/callback', [DetailController::class, 'callback'])->name('midtrans-callback');

    Route::get('/register/success', [RegisterController::class, 'success'])->name('register-success');
// });




Route::group(['middleware' => 'auth'], function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::delete('/cart/{id}', [CartController::class, 'delete'])->name('cart-delete');
    Route::get('/success', [CartController::class, 'success'])->name('success');

    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/products', [DashboardProductController::class, 'index'])->name('dashboard-products');
    Route::get('/dashboard/products/{id}', [DashboardProductController::class, 'details'])->name('dashboard-products-details');
    Route::get('/dashboard/products/create', [DashboardProductController::class, 'create'])->name('dashboard-products-create');

    Route::get('/dashboard/transactions', [DashboardTransactionController::class, 'index'])->name('dashboard-transactions');
    Route::get('/dashboard/transactions/{id}', [DashboardTransactionController::class, 'details'])->name('dashboard-transactions-details');

    Route::get('/dashboard/account', [DashboardSettingController::class, 'account'])->name('dashboard-settings-account');
    Route::post('/dashboard/account/{redirect}', [DashboardSettingController::class, 'update'])->name('dashboard-settings-redirect');
});

Route::prefix('admin')
    ->middleware(['auth','admin'])
    ->group(function() {
        Route::resource('profile', '\App\Http\Controllers\Admin\ProfileController');
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin-dashboard');
	Route::resource('banner', '\App\Http\Controllers\Admin\BannerController');
	Route::resource('category', '\App\Http\Controllers\Admin\CategoryController');
        Route::resource('user', '\App\Http\Controllers\Admin\UserController');
        Route::resource('product', '\App\Http\Controllers\Admin\ProductController');
        Route::resource('product-gallery', '\App\Http\Controllers\Admin\ProductGalleryController');

        Route::resource('transactions', '\App\Http\Controllers\Admin\TransactionsController');
        Route::get('/transactions/pdf/{id}', [App\Http\Controllers\Admin\TransactionsController::class, 'generatePDF'])->name('generate-pdf');
    });

Route::prefix('sales')
    ->middleware(['auth','sales'])
    ->group(function() {
        Route::get('/', [SalesDashboardController::class, 'index'])->name('sales-dashboard');
        Route::resource('transactions-sales', 
'\App\Http\Controllers\Sales\TransactionsController');
        Route::get('/transactions/pdf/{id}', [App\Http\Controllers\Sales\TransactionsController::class, 'generatePDF'])->name('sales-generate-pdf');
    });



// Route::prefix('admin')
//     ->namespace('Admin')
//     ->middleware(['admin'])
//     ->group(function(){
//         Route::get('/', [AdminDashboardController::class, 'index'])->name('admin-dashboard');
//         Route::resource('category', AdminCategoryController::class);
//         Route::resource('user', AdminUserController::class);
//         Route::resource('product', AdminProductController::class);
//         Route::resource('transactions', AdminTransactionsController::class);
        
//         Route::resource('product-gallery', AdminProductGalleryController::class);
//     });

// Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
   
//     Route::name('admin.')->prefix('admin')->group(function () {
//         Route::get('/', [AdminDashboardController::class, 'index'])->name('index');

//         Route::middleware(['admin'])->group(function () {
//             Route::resource('product', AdminProductController::class);
//             Route::resource('category', AdminCategoryController::class);
//             Route::resource('product.gallery', AdminProductGalleryController::class)->shallow()->only([
//                 'index', 'create', 'store', 'destroy'
//             ]);
//             Route::resource('transaction', AdminTransactionsController::class)->only([
//                 'index', 'show', 'edit', 'update'
//             ]);
//             // Route::resource('user', UserController::class)->only([
//             //     'index', 'edit', 'update', 'destroy'
//             // ]);
//         });
//     });
// });

Auth::routes();



