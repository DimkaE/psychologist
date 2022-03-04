<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front;
use App\Http\Controllers\Back;

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

Route::get('/', [Front\PageController::class, 'index'])->name('home');
Route::get('/work', [Front\PageController::class, 'work'])->name('work');

Route::get('/search', [Front\SearchController::class, 'index'])->name('search');
Route::get('/blog', [Front\BlogController::class, 'index'])->name('blog');
Route::get('/blog_more', [Front\BlogController::class, 'more'])->name('blog_more');
Route::get('/blog/{url}', [Front\BlogController::class, 'article'])->name('article');

Route::group(['prefix' => 'customers', 'as' => 'customers.'], function () {
    Route::post('store', [Front\CustomerController::class, 'store'])->name('store');
    Route::group(['middleware' => ['auth', 'enabled']], function () {
        Route::post('update', [Front\CustomerController::class, 'update'])->name('update');
        Route::delete('destroy', [Front\CustomerController::class, 'destroy'])->name('destroy');
    });
});

Route::group(['prefix' => 'psychologists', 'as' => 'psychologists.'], function () {
    Route::get('register', [Front\PsychologistController::class, 'register'])->name('register');
    Route::post('store', [Front\PsychologistController::class, 'store'])->name('store');
    Route::group(['middleware' => ['auth', 'enabled']], function () {
        Route::post('update', [Front\PsychologistController::class, 'update'])->name('update');
        Route::delete('destroy', [Front\PsychologistController::class, 'destroy'])->name('destroy');
        Route::get('filtered', [Front\SearchController::class, 'filtered'])->name('filtered');
        Route::post('enable', [Front\PsychologistController::class, 'enable'])->name('enable');
    });
});


Route::group(['middleware' => ['auth', 'enabled']], function () {
    Route::group(['prefix' => 'consultations', 'as' => 'consultations.'], function () {
        Route::get('available_dates', [Front\ConsultationController::class, 'availableDates'])->name('available_dates');
        Route::get('available_times', [Front\ConsultationController::class, 'availableTimes'])->name('available_times');
        Route::get('price', [Front\ConsultationController::class, 'price'])->name('price');
        Route::get('list', [Front\ConsultationController::class, 'list'])->name('list');
        Route::post('cancel', [Front\ConsultationController::class, 'cancel'])->name('cancel');
    });
    Route::resource('consultations', Front\ConsultationController::class)->only(['store', 'destroy', 'update']);
    Route::group(['prefix' => 'payments', 'as' => 'payments.'], function () {
        Route::get('/confirm', [Front\PaymentController::class, 'confirm'])->name('confirm');
        Route::get('/unused', [Front\PaymentController::class, 'unused'])->name('unused');
    });
    Route::resource('payments', Front\PaymentController::class)->only(['store', 'create']);

    Route::group(['prefix' => 'account', 'as' => 'account.'], function () {
        Route::get('/', [Front\AccountController::class, 'index'])->name('index');
        Route::get('/data', [Front\AccountController::class, 'data'])->name('data');
        Route::get('/messages', [Front\AccountController::class, 'messages'])->name('messages');
        Route::post('/message', [Front\AccountController::class, 'sendMessage'])->name('message');
    });
});


Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin', 'as' => 'back.'], function () {
    Route::get('/', [Back\SettingController::class, 'dashboard'])->name('dashboard');
    Route::get('/settings', [Back\SettingController::class, 'edit'])->name('settings.edit');
    Route::post('/settings', [Back\SettingController::class, 'update'])->name('settings.update');
    Route::resource('pages', Back\PageController::class)->only(['index', 'update', 'edit']);
    Route::resource('users', Back\UserController::class)->except('show');
    Route::get('user_autocomplete', [Back\UserController::class, 'autocomplete'])->name('user_autocomplete');
    Route::resource('directions', Back\DirectionController::class)->except('show');
    Route::post('messages_clear', [Back\MessageController::class, 'clear'])->name('messages.clear');
    Route::resource('messages', Back\MessageController::class)->only(['index', 'create', 'store']);
    Route::resource('promocodes', Back\PromocodeController::class)->except(['show']);
    Route::resource('questions', Back\QuestionController::class)->except(['show']);
    Route::resource('reviews', Back\ReviewController::class)->except(['show']);
    Route::resource('articles', Back\ArticleController::class)->except(['show']);
    Route::resource('consultations', Back\ConsultationController::class)->only(['index', 'show']);
    Route::resource('payments', Back\PaymentController::class)->only(['index', 'show', 'update']);
    Route::post('payment_add', [Back\PaymentController::class, 'add'])->name('payments.add');
    Route::post('payment_remove', [Back\PaymentController::class, 'remove'])->name('payments.remove');
});


require __DIR__ . '/auth.php';

Route::get('/clean_records', [Front\ConsultationController::class, 'clean'])->name('clean_records');
Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Кэш очищен.";
})->name('cache_clear');

/*Route::get('/db_migrate', function () {
    Artisan::call('migrate');
    return "Done";
});*/

/*Route::get('/db_new', function () {
    Artisan::call('migrate:fresh');
    Artisan::call('db:seed');
    return "Done";
});*/
