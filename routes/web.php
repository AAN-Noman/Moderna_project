<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backend\OlaController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\PriceController;
use App\Http\Controllers\Backend\SkillController;
use App\Http\Controllers\Backend\AntmanController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\BatmanController;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\IronmanController;
use App\Http\Controllers\Backend\MessageController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\LanguageController;
use App\Http\Controllers\Backend\PortfolioController;
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
    Route::get('/Portfolios', [FrontendController::class, 'portfolio'])->name('Portfolios');
    Route::get('/teams', [FrontendController::class, 'teams'])->name('teams');
    Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
    Route::get('/contacts', [FrontendController::class, 'contacts'])->name('contacts');
});

Auth::routes();

Route::name("backend.")->group(function(){
    Route::group(['middleware' => ['role_or_permission:Super Admin|Admin']], function () {

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
        Route::resource('/ola', OlaController::class)->except(["show"]);
        Route::get('/ola/status/{ola}', [OlaController::class, 'status'])->name('ola.status');
        Route::get('/ola/restore/{id}', [OlaController::class, 'restore'])->name('ola.restore');
        Route::get('/ola/hard/Delete/{id}', [OlaController::class, 'hardDelete'])->name('ola.hardDelete');

        //Portfolio Section
        Route::resource('/portfolios', PortfolioController::class)->except(["show"]);
        Route::get('/portfolios/status/{portfolio}', [PortfolioController::class, 'status'])->name('portfolios.status');
        Route::get('/portfolios/restore/{id}', [PortfolioController::class, 'restore'])->name('portfolios.restore');
        Route::get('/portfolios/hard/Delete/{id}', [PortfolioController::class, 'hardDelete'])->name('portfolios.hardDelete');

        //Team Section
        Route::resource('/team', TeamController::class)->except(["show"]);
        Route::get('/team/status/{team}', [TeamController::class, 'status'])->name('team.status');
        Route::get('/team/restore/{id}', [TeamController::class, 'restore'])->name('team.restore');
        Route::get('/team/hard/Delete/{id}', [TeamController::class, 'hardDelete'])->name('team.hardDelete');

        //Contact Adress Section
        Route::resource('/contact', ContactController::class)->except(["show"]);
        Route::get('/contact/status/{contact}', [ContactController::class, 'status'])->name('contact.status');
        Route::get('/contact/restore/{id}', [ContactController::class, 'restore'])->name('contact.restore');
        Route::get('/contact/hard/Delete/{id}', [ContactController::class, 'hardDelete'])->name('contact.hardDelete');

        //Contact claint message Section
        Route::resource('/message', MessageController::class)->except(["show", "edit", "update"]);
        Route::get('/message/hard/Delete/{id}', [MessageController::class, 'hardDelete'])->name('message.hardDelete');
    });

});

    Route::get('/test', [HomeController::class, 'testroute']);
