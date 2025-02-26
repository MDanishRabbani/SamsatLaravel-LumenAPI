<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SamsatController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthAppController;
use App\Http\Controllers\UserAppController;

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
    Route::post('/faq/reorder', [FaqController::class, 'reorder'])->name('admin.faq.reorder');


    Route::get('/admin', [AdminController::class, 'adminIndexadmin'])->name('admin.admin');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.admin.create');
    Route::post('/admin', [AdminController::class, 'store'])->name('admin.admin.store');
    Route::get('/admin/{admin}/edit', [AdminController::class, 'edit'])->name('admin.admin.edit');
    Route::put('/admin/{admin}', [AdminController::class, 'update'])->name('admin.admin.update');
    Route::delete('/admin/{admin}', [AdminController::class, 'destroy'])->name('admin.admin.destroy');

    Route::get('/userapp', [UserAppController::class, 'adminIndexuserapp'])->name('admin.userapp');
    Route::get('/userapp/create', [UserAppController::class, 'create'])->name('admin.userapp.create');
    Route::post('/userapp', [UserAppController::class, 'store'])->name('admin.userapp.store');
    Route::get('/userapp/{userapp}/edit', [UserAppController::class, 'edit'])->name('admin.userapp.edit');
    Route::put('/userapp/{userapp}', [UserAppController::class, 'update'])->name('admin.userapp.update');
    Route::delete('/userapp/{userapp}', [UserAppController::class, 'destroy'])->name('admin.userapp.destroy');


});

$router->post('/app/login', [AuthAppController::class, 'login']);
    $router->post('/app/verify-pin', [AuthAppController::class, 'verifyPin']);
    $router->post('/app/register', [AuthAppController::class, 'register']);

    
    $router->get('/test-mail', function () {
        try {
            \Illuminate\Support\Facades\Mail::raw('This is a test email', function ($message) {
                $message->to('danishrabbani1806@gmail.com')
                        ->subject('Test Email');
            });
            return 'Mail sent successfully!';
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    });