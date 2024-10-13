<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SamsatController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\InformationController;

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

    Route::get('/information', [InformationController::class, 'adminIndexinformation'])->name('admin.information');
    Route::get('/information/create', [InformationController::class, 'create'])->name('admin.information.create');
    Route::post('/information', [InformationController::class, 'store'])->name('admin.information.store');
    Route::get('/information/{information}/edit', [InformationController::class, 'edit'])->name('admin.information.edit');
    Route::put('/information/{information}', [InformationController::class, 'update'])->name('admin.information.update');
    Route::delete('/information/{information}', [InformationController::class, 'destroy'])->name('admin.information.destroy');

    Route::get('/samsat', [SamsatController::class, 'adminIndexsamsat'])->name('admin.samsat');
    Route::get('/samsat/create', [SamsatController::class, 'create'])->name('admin.samsat.create');
    Route::post('/samsat', [SamsatController::class, 'store'])->name('admin.samsat.store');
    Route::get('/samsat/{samsat}/edit', [SamsatController::class, 'edit'])->name('admin.samsat.edit');
    Route::put('/samsat/{samsat}', [SamsatController::class, 'update'])->name('admin.samsat.update');
    Route::delete('/samsat/{samsat}', [SamsatController::class, 'destroy'])->name('admin.samsat.destroy');

    Route::get('/faq', [FaqController::class, 'adminIndexfaq'])->name('admin.faq');
    Route::get('/faq/create', [FaqController::class, 'create'])->name('admin.faq.create');
    Route::post('/faq', [FaqController::class, 'store'])->name('admin.faq.store');
    Route::get('/faq/{faq}/edit', [FaqController::class, 'edit'])->name('admin.faq.edit');
    Route::put('/faq/{faq}', [FaqController::class, 'update'])->name('admin.faq.update');
    Route::delete('/faq/{faq}', [FaqController::class, 'destroy'])->name('admin.faq.destroy');

    Route::get('/categories', [HomeController::class, 'adminIndexCategories'])->name('admin.categories');
    Route::get('/categories/create', [HomeController::class, 'createCategories'])->name('admin.categories.create');
    Route::post('/categories', [HomeController::class, 'storeCategory'])->name('admin.categories.store');
    Route::get('/categories/{category}/edit', [HomeController::class, 'editCategory'])->name('admin.categories.edit');
    Route::put('/categories/{category}', [HomeController::class, 'updateCategory'])->name('admin.categories.update');
    Route::delete('/categories/{category}', [HomeController::class, 'destroyCategory'])->name('admin.categories.destroy');

    Route::post('/categories/update-order', [HomeController::class, 'updateOrder'])->name('admin.categories.updateOrder');

    Route::group(['prefix' => 'api'], function () {
        require __DIR__.'/../lumen-api/routes/web.php'; 
    });

});
