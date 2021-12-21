<?php

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
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

Route::get('/createpost', function(){
    $post = Post::create([
        'title' => 'This is title',
        'slug' => 'this is slug',
        'excerpt' => 'bla bla bla',
        'body' => 'lorem ipsum dolor sit amet',
        'user_id' => 1,
        'category_id' => Category::find(1)->id
    ]);
    $post->image()->create(['name' => 'random file', 'extension'=>'jpg', 'path'=>'/image/random_file.jpg']);
});


Route::get('/comments', function () {
    $user = User::find(1);
    return $user->comments;
});

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/post', function () {
    return view('post');
})->name('post');

Route::get('/about', function(){
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

require __DIR__.'/auth.php';
