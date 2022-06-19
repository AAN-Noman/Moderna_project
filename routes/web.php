<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Frontend\FrontendController;

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

Route::name("frontend.")->group(function(){
    Route::get('/', [FrontendController::class, 'index'])->name('home');
    Route::get('/about', [FrontendController::class, 'about'])->name('about');
    Route::get('/services', [FrontendController::class, 'services'])->name('services');
    Route::get('/portfolio', [FrontendController::class, 'portfolio'])->name('portfolio');
    Route::get('/team', [FrontendController::class, 'team'])->name('team');
    Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
    Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
});

Auth::routes();

Route::name("backend.")->group(function(){
    Route::get('/dashboard', [BackendController::class, 'index'])->name('home');
    Route::resource('/banner', BannerController::class)->except(["show"]);
    
});
