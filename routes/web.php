<?php

use App\Models\Dealership;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

/*
|--------------------------------------------------------------------------
| One to Many Relationships
|--------------------------------------------------------------------------
*/

Route::get('/postsByUser/{user_id}', function ($user_id) {
   $user = User::find($user_id);
   foreach($user->posts as $post) {
       echo $post->title . "<br>";
   }
});

/*
|--------------------------------------------------------------------------
| Many to Many Relationships
|--------------------------------------------------------------------------
*/

Route::get('user/{id}/role', function ($id) {
   $user = User::find($id)->roles()->orderBy('id', 'desc')->get();
   ddd($user);
//    foreach ($user->roles as $role) {
//        echo $role->name."<br>";
//    }
});

Route::get('/updatePost/{id}', function ($id) {
    if(Post::find($id)) {
        Post::where('id', $id)->update([
            'title' => 'NEW PHP TITLESs',
            'content' => 'I love my instructorsfdsa ',
        ]);
    }
});

Route::get('/create', function () {
   Post::create([
      'title' => 'the create method',
      'content' => 'WOW I am learning a lot with Edwin in PHP!',
   ]);
});

Route::get('/basicinsert', function () {
   $post = new Post;
   $post->title = "new ORM title2";
   $post->content = "Wow!  Eloquent2 is really cool, look at this content!";
   var_dump($post);
   $post->save();
});

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

Route::get('/find/{id}', function ($id) {
   $posts = Post::onlyTrashed()->get();
   echo "<pre>";
   foreach ($posts as $post)
   {
       echo "<h3>Post Object</h3><hr/>";
       print_r($post);
   }
   echo "</pre>";
});

Route::get('/user/{id}/posts', function ($id) {
    $user = User::find($id);
    $posts = User::find($id)->posts;
    foreach ($posts as $post) {
        echo "<h3>".$post->title."</h3>";
        echo "<p>".$post->content."</p>";
        printf("<p><small>Created at %s by %s %s</small></p>",
            $post->created_at,
            $user->first_name,
            $user->last_name
        );
        echo "<hr/>";
    }
});

Route::get('/post/{id}/user', function($id) {
   return Post::find($id)->user->first_name;
});

Route::get('/restore', function () {
   $posts = Post::onlyTrashed()->restore();
});


Route::get('/delete', function () {
    $post = Post::find(1);
    $post->delete();
    return $post;
});

Route::get('/delete/{id}', function ($id) {
   Post::find($id)->delete();
});

Route::get('/forcedelete/{id}', function ($id) {
    Post::withTrashed()->find($id)->forceDelete();
});

Route::get('/createDealer', function () {
    Dealership::create();
});

Route::get('/createUser', function () {
    User::create([
        'dealership_id' => '1',
        'first_name' => 'Jason',
        'last_name' => 'James',
        'email' => 'jjames@obrienauto.com',
        'user_name' => 'jccjames422',
        'password' => 'password',
        'cell_phone' => '3176904440',
    ]);
});

//Route::get('/update', function () {
//   $updated = DB::update('update posts set title = "Updated title" where id = ?', [1]);
//   return $updated;
//});

Route::get('/read', function () {
   $results = DB::select('select * from posts where id = ?', [1]);

    foreach ($results as $post) {
        echo $post->title. "<br>";
        echo $post->content. "<br>";
    }
});

Route::get('/insert', function () {
   Post::create([
       'title' => 'PHP2 with Laravel',
       'content' => 'Laravel2 is the best that has happened to PHP'
   ]);
});

Route::get('/softdelete/{id}', function ($id) {
    Post::find($id)->delete();
});

//Route::resource('posts', PostsController::class);
//Route::get('post/{id}/{name}/{password}', [PostsController::class, 'show_post']);
//Route::get('/contact', [PostsController::class, 'contact']);
