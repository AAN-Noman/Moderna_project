<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\WorkController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\PriceController;
use App\Http\Controllers\Backend\SkillController;
use App\Http\Controllers\Backend\AntmanController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\BatmanController;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\IronmanController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\LanguageController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Backend\TetstimonialController;

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
    Route::get('/abouts', [FrontendController::class, 'abouts'])->name('abouts');
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
    Route::resource('/antman', AntmanController::class)->except(["show"]);
    Route::get('/antman/status/{antman}', [AntmanController::class, 'status'])->name('antman.status');
    Route::get('/antman/restore/{id}', [AntmanController::class, 'restore'])->name('antman.restore');
    Route::get('/antman/hard/Delete/{id}', [AntmanController::class, 'hardDelete'])->name('antman.hardDelete');

    // priceing hadeline
    Route::resource('/price', PriceController::class)->except(["show"]);
    Route::get('/price/status/{price}', [PriceController::class, 'status'])->name('price.status');
    Route::get('/price/restore/{id}', [PriceController::class, 'restore'])->name('price.restore');
    Route::get('/price/hard/Delete/{id}', [PriceController::class, 'hardDelete'])->name('price.hardDelete');

    // About wiht Facts Section
    Route::resource('/about', AboutController::class)->except(["show"]);
    Route::get('/about/status/{about}', [AboutController::class, 'status'])->name('about.status');
    Route::get('/about/restore/{id}', [AboutController::class, 'restore'])->name('about.restore');
    Route::get('/about/hard/Delete/{id}', [AboutController::class, 'hardDelete'])->name('about.hardDelete');

    //About Skills Section
    Route::resource('/skill', SkillController::class)->except(["show", "edit", "update"]);
    Route::get('/skill/status/{skill}', [SkillController::class, 'status'])->name('skill.status');
    Route::get('/skill/restore/{id}', [SkillController::class, 'restore'])->name('skill.restore');
    Route::get('/skill/hard/Delete/{id}', [SkillController::class, 'hardDelete'])->name('skill.hardDelete');

    //About Skills Language Section
    Route::resource('/language', LanguageController::class)->except(["show"]);
    Route::get('/language/status/{language}', [LanguageController::class, 'status'])->name('language.status');
    Route::get('/language/restore/{id}', [LanguageController::class, 'restore'])->name('language.restore');
    Route::get('/language/hard/Delete/{id}', [LanguageController::class, 'hardDelete'])->name('language.hardDelete');

    //About Tetstimonial Section
    Route::resource('/tetstimonial', TetstimonialController::class)->except(["show", "edit", "update"]);
    Route::get('/tetstimonial/status/{tetstimonial}', [TetstimonialController::class, 'status'])->name('tetstimonial.status');
    Route::get('/tetstimonial/restore/{id}', [TetstimonialController::class, 'restore'])->name('tetstimonial.restore');
    Route::get('/tetstimonial/hard/Delete/{id}', [TetstimonialController::class, 'hardDelete'])->name('tetstimonial.hardDelete');


    //About Tetstimonial Section
    Route::resource('/work', WorkController::class)->except(["show"]);
    Route::get('/work/status/{work}', [WorkController::class, 'status'])->name('work.status');
    Route::get('/work/restore/{id}', [WorkController::class, 'restore'])->name('work.restore');
    Route::get('/work/hard/Delete/{id}', [WorkController::class, 'hardDelete'])->name('work.hardDelete');


});
