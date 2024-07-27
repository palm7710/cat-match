<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\CatAuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatchingController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\CatController;

// 人間側のルート
Route::group(['prefix' => 'users', 'middleware' => 'auth'], function () {
    Route::get('show/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('update/{id}', [UserController::class, 'update'])->name('users.update');
});

// Catのルート
Route::group(['prefix' => 'cats', 'middleware' => 'auth:cat'], function () {
    Route::get('show/{id}', [CatController::class, 'show'])->name('cats.show');
    Route::get('edit/{id}', [CatController::class, 'edit'])->name('cats.edit');
    Route::post('update/{id}', [CatController::class, 'update'])->name('cats.update');
});

Route::middleware(['guest:cat'])->group(function () {
    Route::get('/cat-login', [CatAuthController::class, 'showLoginForm'])->name('cat.login');
    Route::post('/cat-login', [CatAuthController::class, 'login'])->name('cat.login.submit');
});

Route::post('/cat-logout', [CatAuthController::class, 'logout'])->name('cat.logout');

// Cat用のホームルート
Route::get('/cat-home', [HomeController::class, 'catIndex'])->middleware('auth:cat')->name('cat.home');

Auth::routes();

Route::get('/user-home', [HomeController::class, 'index'])->name('user.home');
Route::get('/user-login', [LoginController::class, 'showLoginForm'])->name('user.login');
Route::post('/user-login', [LoginController::class, 'login'])->name('user.login.submit');

// Reactionルート
Route::post('/reactions', [ReactionController::class, 'store'])->name('reactions.store');

// Matchingルート
Route::get('/user-matching', [MatchingController::class, 'index'])->name('user.matching');

// 保護猫側のマッチングページ
Route::get('/cat-matching', [MatchingController::class, 'catIndex'])->name('cat.matching');

Route::post('/api/like', [ReactionController::class, 'create']);