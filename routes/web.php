<?php

use Illuminate\Support\Facades\Route;

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
//     return view('home2');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/nav', [App\Http\Controllers\HomeController::class, 'nav'])->name('home');

Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'index']);
Route::get('blog/{category_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'viewCategoryPost']);
Route::get('blog/{category_slug}/{post_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'viewPost']);

//Comment System
Route::post('/comments', [App\Http\Controllers\Frontend\CommentController::class, 'store']);
Route::post('/delete-comment', [App\Http\Controllers\Frontend\CommentController::class, 'destroy']);
Route::put('/edit-comment', [App\Http\Controllers\Frontend\CommentController::class, 'update']);

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    Route::get('category', [App\Http\Controllers\Admin\CategoryController::class, 'index']);
    Route::get('add-category', [App\Http\Controllers\Admin\CategoryController::class, 'create']);
    Route::post('add-category', [App\Http\Controllers\Admin\CategoryController::class, 'store']);
    Route::get('edit-category/{category_id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit']);
    Route::put('update-category/{category_id}', [App\Http\Controllers\Admin\CategoryController::class, 'update']);
    Route::get('delete-category/{category_id}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy']);

    Route::get('posts', [App\Http\Controllers\Admin\PostController::class, 'index']);
    Route::get('add-post', [App\Http\Controllers\Admin\PostController::class, 'create']);
    Route::post('add-post', [App\Http\Controllers\Admin\PostController::class, 'store']);
    Route::get('edit-post/{post_id}', [App\Http\Controllers\Admin\PostController::class, 'edit']);
    Route::put('update-post/{post_id}', [App\Http\Controllers\Admin\PostController::class, 'update']);
    Route::get('delete-post/{post_id}', [App\Http\Controllers\Admin\PostController::class, 'delete']);

    Route::get('users', [App\Http\Controllers\Admin\UserController::class, 'index']);
    Route::get('edit-user/{user_id}', [App\Http\Controllers\Admin\UserController::class, 'edit']);
    Route::put('update-user/{user_id}', [App\Http\Controllers\Admin\UserController::class, 'update']);
});

Route::prefix('user')->middleware(['auth', 'isUser'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\User\DashboardController::class, 'index']);

    // Route::get('category', [App\Http\Controllers\User\CategoryController::class, 'index']);
    // Route::get('add-category', [App\Http\Controllers\User\CategoryController::class, 'create']);
    // Route::post('add-category', [App\Http\Controllers\User\CategoryController::class, 'store']);
    // Route::get('edit-category/{category_id}', [App\Http\Controllers\User\CategoryController::class, 'edit']);
    // Route::put('update-category/{category_id}', [App\Http\Controllers\User\CategoryController::class, 'update']);
    // Route::get('delete-category/{category_id}', [App\Http\Controllers\User\CategoryController::class, 'destroy']);

    Route::get('posts', [App\Http\Controllers\User\PostController::class, 'index']);
    Route::get('add-post', [App\Http\Controllers\User\PostController::class, 'create']);
    Route::post('add-post', [App\Http\Controllers\User\PostController::class, 'store']);
    Route::get('edit-post/{post_id}', [App\Http\Controllers\User\PostController::class, 'edit']);
    Route::put('update-post/{post_id}', [App\Http\Controllers\User\PostController::class, 'update']);
    Route::get('delete-post/{post_id}', [App\Http\Controllers\User\PostController::class, 'delete']);
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
