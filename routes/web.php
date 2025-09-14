<?php

use App\Http\Controllers\staff\InvoiceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/auth/register', function () {
    return view('auth.register');
})->name('auth.register');

Auth::routes();

Route::post('/getfill', [InvoiceController::class, 'getFill']);
Route::post('/getdata', [InvoiceController::class, 'getData']);

Route::prefix('staff')->group(function () {

    Route::get('dashboard', [App\Http\Controllers\staff\DashboardController::class, 'index']);

    //profile
    Route::controller(App\Http\Controllers\staff\ProfileController::class)->group(function () {
        Route::get('profile', 'profile');
        Route::post('profile/{id}/update', 'update');
    });

    //invoices
    Route::controller(App\Http\Controllers\staff\InvoiceController::class)->group(function () {
        Route::get('invoice', 'index');
        Route::get('invoice/show', 'show');
        Route::get('invoice/{id}/detail', 'detail');
    });

    //invoices
    Route::controller(App\Http\Controllers\staff\StockController::class)->group(function () {
        Route::get('stock', 'index');
        Route::get('stock/{id}/detail', 'detail');
    });
});

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    //profile
    Route::controller(App\Http\Controllers\Admin\ProfileController::class)->group(function () {
        Route::get('profile', 'profile');
        Route::post('profile/{id}/update', 'update');
    });

    //staff
    Route::controller(App\Http\Controllers\Admin\StaffController::class)->group(function () {
        Route::get('staff', 'index');
        Route::get('staff/add', 'add');
        Route::post('staff/store', 'store');
        Route::get('staff/{id}/edit', 'edit');
        Route::post('staff/{id}/update', 'update');
        Route::get('staff/{id}/delete', 'delete');
        Route::get('product/{id}/toggle', 'toggle');
    });

    //report's
    Route::controller(App\Http\Controllers\Admin\ReportController::class)->group(function () {
        Route::get('report', 'index');
        Route::get('report/{id}', 'detail');
    });

    //product
    Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function () {
        Route::get('product', 'index');
        Route::get('product/add', 'add');
        Route::get('product/{id}/detail', 'detail');
        Route::post('product/store', 'store');
        Route::get('product/{id}/edit', 'edit');
        Route::post('product/{id}/update', 'update');
        Route::get('product/{id}/delete', 'delete');
        Route::get('product/{id}/toggle', 'toggle');
    });

    //stock
    Route::controller(App\Http\Controllers\Admin\StockController::class)->group(function () {
        Route::get('stock', 'index');
        Route::get('stock/add', 'add');
        Route::post('stock/store', 'store');
        Route::get('stock/{id}/edit', 'edit');
        Route::post('stock/{id}/update', 'update');
        Route::get('stock/{id}/delete', 'delete');
    });

    //brand
    Route::controller(App\Http\Controllers\Admin\BrandController::class)->group(function () {
        Route::get('brand', 'index');
        Route::get('brand/add', 'add');
        Route::post('brand/store', 'store');
        Route::get('brand/{id}/edit', 'edit');
        Route::post('brand/{id}/update', 'update');
        Route::get('brand/{id}/delete', 'delete');
        Route::get('brand/{id}/toggle', 'toggle');
    });

    //category
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
        Route::get('category', 'index');
        Route::get('category/add', 'add');
        Route::post('category/store', 'store');
        Route::get('category/{id}/edit', 'edit');
        Route::post('category/{id}/update', 'update');
        Route::get('category/{id}/delete', 'delete');
        Route::get('category/{id}/toggle', 'toggle');
    });

    //wharehouse
    Route::controller(App\Http\Controllers\Admin\WharehouseController::class)->group(function () {
        Route::get('wharehouse', 'index');
        Route::get('wharehouse/add', 'add');
        Route::post('wharehouse/store', 'store');
        Route::get('wharehouse/{id}/edit', 'edit');
        Route::post('wharehouse/{id}/update', 'update');
        Route::get('wharehouse/{id}/delete', 'delete');
        Route::get('wharehouse/{id}/toggle', 'toggle');
    });
});
