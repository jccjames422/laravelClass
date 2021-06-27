<?php

use App\Models\Post;
use Illuminate\Support\Facades\DB;
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

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Eloquent ORM
|--------------------------------------------------------------------------
*/

Route::get('/update/{id}', function ($id) {
   Post::where('id', $id)->where('is_admin', '0')->update([
       'title' => 'NEW PHP TITLES',
       'content' => 'I love my instructors',
   ]);
});

//Route::get('/create', function () {
//   Post::create([
//      'title' => 'the create method',
//      'content' => 'WOW I am learning a lot with Edwin in PHP!',
//   ]);
//});

//Route::get('/basicinsert', function () {
//   $post = new Post;
//   $post->title = "new ORM title";
//   $post->content = "Wow!  Eloquent is really cool, look at this content!";
//   var_dump($post);
//   $post->save();
//});

//Route::get('/basicinsert', function () {
//    $post = Post::find(2);
//    $post->title = "new ORM2 title";
//    $post->content = "Wow!  Eloquent2 is really cool, look at this content!";
//    var_dump($post);
//    $post->save();
//});
//
//Route::get('/findwhere', function (){
//   $posts = Post::where('is_admin', 0)->orderBy('id', 'desc')->take(2)->get();
//   return $posts;
//});
//
//Route::get('/findmore', function () {
//   $posts = Post::findOrFail(2);
//   return $posts;
//});

//Route::get('/find', function (){
//    $posts = Post::all();
//    foreach ($posts as $post) {
//        return $post->title;
//    }
//});

//Route::get('/find/{id}', function ($id) {
//   return $post = Post::find($id);
//});


//Route::get('/delete', function () {
//   $deleted = DB::delete('delete from posts where id = ?', [1]);
//   return $deleted;
//});

//Route::get('/update', function () {
//   $updated = DB::update('update posts set title = "Updated title" where id = ?', [1]);
//   return $updated;
//});

//Route::get('/read', function () {
//   $results = DB::select('select * from posts where id = ?', [1]);
//
//    foreach ($results as $post) {
//        echo $post->title;
//    }
//});

Route::get('/insert', function () {
   DB::insert('insert into posts(title, content) values(?, ?)',
       [
           'PHP2 with Laravel',
           'Laravel2 is the best that has happened to PHP'
       ]);
});

//Route::resource('posts', PostsController::class);
//Route::get('post/{id}/{name}/{password}', [PostsController::class, 'show_post']);
//Route::get('/contact', [PostsController::class, 'contact']);
