<?php

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Admin\AdminMenu\AdminMenuController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\Admin\Subject\SubjectController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Dialog\DialogController;
use App\Http\Controllers\Admin\Example\ExampleController;
use App\Http\Controllers\Admin\Subcategory\SubcategoryController;
use App\Http\Controllers\DialogMessageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware' => 'auth:api', 'prefix' => 'admin'], function () {
    
    Route::post('logout', [LoginController::class, 'logout']);

    Route::get('user', [UserController::class, 'current']);

    Route::patch('settings/profile', [ProfileController::class, 'update']);
    Route::patch('settings/password', [PasswordController::class, 'update']);
    Route::get('menu', [AdminMenuController::class, 'index']);
    
    // Темы
    Route::apiResource('subjects', SubjectController::class)->except(['show']);
    Route::get('subjects/search', [SubjectController::class, 'search']);
    // Категории
    Route::apiResource('categories', CategoryController::class)->except(['show']);
    Route::get('categories/search', [CategoryController::class, 'search']);
    // Категории
    Route::apiResource('subcategories', SubcategoryController::class)->except(['show']);
    Route::get('subcategories/search', [SubcategoryController::class, 'search']);
    // Примеры
    Route::resource('examples', ExampleController::class);
    Route::get('examples/search', [ExampleController::class, 'search']);
    // Диалоги
    Route::resource('dialogs', DialogController::class)->only(['show']);
    Route::resource('dialog-messages', DialogMessageController::class)->only(['show']);
});
Route::group(['middleware' => 'guest:api', 'prefix' => 'admin'], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register']);

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    Route::post('email/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend']);

    Route::post('oauth/{driver}', [OAuthController::class, 'redirect']);
    Route::get('oauth/{driver}/callback', [OAuthController::class, 'handleCallback'])->name('oauth.callback');
    
    
    
});
