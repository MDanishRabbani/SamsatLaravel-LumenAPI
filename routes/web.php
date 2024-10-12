<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
    return view('welcome');
});

Auth::routes();

// Ensure you have the 'auth' middleware where necessary
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('dashboard');
    
    Route::get('/admin/products', [HomeController::class, 'adminIndexProducts'])->name('admin.products');
    Route::get('/admin/products/create', [HomeController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [HomeController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{product}/edit', [HomeController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{product}', [HomeController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [HomeController::class, 'destroy'])->name('admin.products.destroy');

    Route::get('/admin/categories', [HomeController::class, 'adminIndexCategories'])->name('admin.categories');
    Route::get('/admin/categories/create', [HomeController::class, 'createCategories'])->name('admin.categories.create');
    Route::post('/admin/categories', [HomeController::class, 'storeCategory'])->name('admin.categories.store');
    Route::get('/admin/categories/{category}/edit', [HomeController::class, 'editCategory'])->name('admin.categories.edit');
    Route::put('/admin/categories/{category}', [HomeController::class, 'updateCategory'])->name('admin.categories.update');
    Route::delete('/admin/categories/{category}', [HomeController::class, 'destroyCategory'])->name('admin.categories.destroy');

    Route::post('/admin/categories/update-order', [HomeController::class, 'updateOrder'])->name('admin.categories.updateOrder');

    Route::group(['prefix' => 'api'], function () {
        require __DIR__.'/../lumen-api/routes/web.php'; // Pastikan ini mengarah ke file yang benar
    });

});
