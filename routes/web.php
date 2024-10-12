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



Auth::routes();

// Ensure you have the 'auth' middleware where necessary
Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    
    Route::get('/products', [HomeController::class, 'adminIndexProducts'])->name('admin.products');
    Route::get('/products/create', [HomeController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [HomeController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{product}/edit', [HomeController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}', [HomeController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}', [HomeController::class, 'destroy'])->name('admin.products.destroy');

    Route::get('/categories', [HomeController::class, 'adminIndexCategories'])->name('admin.categories');
    Route::get('/categories/create', [HomeController::class, 'createCategories'])->name('admin.categories.create');
    Route::post('/categories', [HomeController::class, 'storeCategory'])->name('admin.categories.store');
    Route::get('/categories/{category}/edit', [HomeController::class, 'editCategory'])->name('admin.categories.edit');
    Route::put('/categories/{category}', [HomeController::class, 'updateCategory'])->name('admin.categories.update');
    Route::delete('/categories/{category}', [HomeController::class, 'destroyCategory'])->name('admin.categories.destroy');

    Route::post('/categories/update-order', [HomeController::class, 'updateOrder'])->name('admin.categories.updateOrder');

    Route::group(['prefix' => 'api'], function () {
        require __DIR__.'/../lumen-api/routes/web.php'; // Pastikan ini mengarah ke file yang benar
    });

});
