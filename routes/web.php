<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\BatmanController;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\IronmanController;
use App\Http\Controllers\Backend\PricingController;
use App\Http\Controllers\Backend\ServiceController;
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

    //banner
    Route::resource('/banner', BannerController::class)->except(["show"]);
    Route::get('/banner/status/{banner}', [BannerController::class, 'status'])->name('banner.status');
    Route::get('/banner/restore/{id}', [BannerController::class, 'restore'])->name('banner.restore');
    Route::get('/banner/hard/Delete/{id}', [BannerController::class, 'hardDelete'])->name('banner.hardDelete');

    //services
    Route::resource('/service', ServiceController::class)->except(["show"]);
    Route::get('/service/status/{service}', [ServiceController::class, 'status'])->name('service.status');
    Route::get('/service/restore/{id}', [ServiceController::class, 'restore'])->name('service.restore');
    Route::get('/service/hard/Delete/{id}', [ServiceController::class, 'hardDelete'])->name('service.hardDelete');

    //Why Us
    Route::resource('/ironman', IronmanController::class)->except(["show"]);
    Route::get('/ironman/status/{ironman}', [IronmanController::class, 'status'])->name('ironman.status');
    Route::get('/ironman/restore/{id}', [IronmanController::class, 'restore'])->name('ironman.restore');
    Route::get('/ironman/hard/Delete/{id}', [IronmanController::class, 'hardDelete'])->name('ironman.hardDelete');

    //Service Details
    Route::resource('/batman', BatmanController::class)->except(["show"]);
    Route::get('/batman/status/{batman}', [BatmanController::class, 'status'])->name('batman.status');
    Route::get('/batman/restore/{id}', [BatmanController::class, 'restore'])->name('batman.restore');
    Route::get('/batman/hard/Delete/{id}', [BatmanController::class, 'hardDelete'])->name('batman.hardDelete');

    //Pricing
    Route::resource('/price', PricingController::class)->except(["show"]);
    Route::get('/price/status/{pricing}', [PricingController::class, 'status'])->name('price.status');
    Route::get('/price/restore/{id}', [PricingController::class, 'restore'])->name('price.restore');
    Route::get('/price/hard/Delete/{id}', [PricingController::class, 'hardDelete'])->name('price.hardDelete');


});
