<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\User\Home\HomeController;
use App\Http\Controllers\Admin\Program\ProgramController;
use App\Http\Controllers\User\Subscribe\SubscribeController;
use App\Http\Controllers\Admin\Nutrition\NutritionController;
use App\Http\Controllers\User\Subscribe\CurrentSubscribeController;
use App\Http\Controllers\User\Subscribe\SubscribeHistroyController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', function () {
//     return view('front.home.home');
// })->name('home');
Route::get('/',HomeController::class)->name('home');
// Route::post('/subscribe/{program}',[SubscribeController::class,'store'])->name('subscribe.store');
Route::post('/subscribe/{program}',SubscribeController::class)->name('subscribe.store');
// Route::post('/subscribe/history',[SubscribeController::class,'history'])->name('subscribe.history');
Route::get('/subscribe/history',SubscribeHistroyController::class)->name('subscribe.history');
Route::get('/subscribe/currentPlan',CurrentSubscribeController::class)->name('subscribe.currentPlan');
Route::view('/payment','front.subscribe.payment.payment');

Route::middleware(['auth'])->group(function () {
    Route::get('/pay', [PaymentController::class, 'pay'])->name('pay');
    Route::get('/billing', [PaymentController::class, 'showBilling'])->name('billing');
    Route::post('/billing', [PaymentController::class, 'addPaymentMethod']);
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
// Route::prefix('facebook')->name('socialite.')->controller(SocialiteController::class)->group(function(){
//     Route::get('/facebookLogin', 'facebookLogin')->name('facebookLogin');
//     Route::get('/redirect', 'redirect')->name('redirect');
// });
    Route::get('auth/facebook', [SocialiteController::class,'facebookLogin'])->name('facebookLogin');
    Route::get('auth/facebook/callback', [SocialiteController::class,'redirectToFacebook'])->name('facebookCallback');
    // Route::get('/redirect', 'redirect')->name('redirect');
    Route::name('admin.')->prefix( '/admin')->middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])->group(function () {
        Route::view('/', 'admin.index')->name('index');
        // Route::view('/services', 'admin.services.index')->name('services');
        // Route::view('/services/create', 'admin.services.create')->name('create');
        Route::resource('/programs', ProgramController::class);
        Route::resource('/nutritions', NutritionController::class)->except(['create','store']);
        Route::get('/nutritions/create/{nutrition}', [NutritionController::class,'create'])->name('nutritions.create');
        Route::post('/nutritions/create/{nutrition}', [NutritionController::class,'store'])->name('nutritions.store');
        // Route::resource('/nutritions', NutritionController::class);
Route::get('subscriber',App\Http\Controllers\Admin\Subscriber\SubscriberController::class)->name('subscriber');
        // Route::view('/login','admin.auth.login')->name('login');
        // require __DIR__ . '/auth.php';
    });
