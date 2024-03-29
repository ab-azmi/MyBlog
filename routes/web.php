<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminControllers\AdminAboutsController;
use App\Http\Controllers\AdminControllers\AdminCategoriesController;
use App\Http\Controllers\AdminControllers\AdminCommentsController;
use App\Http\Controllers\AdminControllers\AdminContactsController;
use App\Http\Controllers\AdminControllers\AdminPostsController;
use App\Http\Controllers\AdminControllers\AdminRolesController;
use App\Http\Controllers\AdminControllers\AdminTagsController;
use App\Http\Controllers\AdminControllers\AdminUsersController;
use App\Http\Controllers\AdminControllers\DashboardController;
use App\Http\Controllers\AdminControllers\TinyMCEController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

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

// Front User Routes

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/post/{post:slug}', [PostController::class, 'show'])->name('post.show');
Route::post('/post/{post:slug}', [PostController::class, 'addComment'])->name('post.add_comment');

Route::get('/about', AboutController::class)->name('about');

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

Route::get('/tags/{tag:name}', [TagController::class, 'show'])->name('tags.show');
Route::get('/tags', [TagController::class, 'index'])->name('tags.index');

require __DIR__.'/auth.php';


//Admin Dashboard Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'check_permission', 'IsAdmin'])->group(function(){

    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::resource('posts', AdminPostsController::class);
    Route::resource('categories', AdminCategoriesController::class);
    Route::resource('tags', AdminTagsController::class)->only(['index', 'show', 'destroy']);
    Route::resource('comments', AdminCommentsController::class);
    Route::resource('roles', AdminRolesController::class);
    Route::resource('users', AdminUsersController::class);
    Route::post('tinymce_image', [TinyMCEController::class, 'upload_tinymce_image'])->name('tinymce_image');
    Route::get('contacts', [AdminContactsController::class, 'index'])->name('contacts.index');
    Route::delete('contacts/{contact}', [AdminContactsController::class, 'destroy'])->name('contacts.destroy');
    Route::get('abouts', [AdminAboutsController::class, 'edit'])->name('abouts.edit');
    Route::post('abouts', [AdminAboutsController::class, 'update'])->name('abouts.update');
    //Route::post('upload_tinymce_image', [TinyMCEController::class, 'upload_tinymce_image'])->name('upload_tinymce_image');
});
