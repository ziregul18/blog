<?php


use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Category\CreateController;
use App\Http\Controllers\Admin\Category\DeleteController;
use App\Http\Controllers\Admin\Category\EditController;
use App\Http\Controllers\Admin\Category\ShowController;
use App\Http\Controllers\Admin\Category\StoreController;
use App\Http\Controllers\Admin\Category\UpdateController;

use App\Http\Controllers\Admin\Main\MainController;

use App\Http\Controllers\Admin\Tag\TagController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Post\PostController;

use App\Http\Controllers\Main\IndexController;
use App\Http\Controllers\Personal\Comment\CommentController;
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

Route::group(['namespace' => 'Main'], function () {
    Route::get('/', [IndexController::class, '__invoke']);
});
Route::group(['namespace' => 'Personal', 'prefix' => 'personal', 'middleware' => ['auth','admin']], function () {
    Route::group(['namespace' => 'Main', 'prefix' => 'main'], function () {
        Route::get('/', [App\Http\Controllers\Personal\Main\MainController::class, '__invoke'])->name('personal.main.index');
    });
    Route::group(['namespace' => 'Liked', 'prefix' => 'liked'], function () {
        Route::get('/', [App\Http\Controllers\Personal\Liked\LikedController::class, '__invoke'])->name('personal.liked.index');
        Route::delete('/{post}', [App\Http\Controllers\Personal\Liked\DeleteController::class, '__invoke'])->name('personal.liked.delete');
    });
    Route::group(['namespace' => 'Comment', 'prefix' => 'comment'], function () {
        Route::get('/', [CommentController::class, 'index'])->name('personal.comment.index');
        Route::get('/{comment}/edit', [CommentController::class, 'edit'])->name('personal.comment.edit');
        Route::patch('/{comment}', [CommentController::class, 'update'])->name('personal.comment.update');
        Route::delete('/{comment}', [CommentController::class, 'delete'])->name('personal.comment.delete');
    });
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin','middleware' => ['auth','admin']], function () {
    Route::group(['namespace' => 'Main'], function () {
         Route::get('/', [MainController::class, '__invoke'])->name('admin.main.index');
    });

    Route::group(['namespace' => 'Post', 'prefix' => 'posts'], function () {
        Route::get('/', [App\Http\Controllers\Admin\Post\PostController::class, '__invoke'])->name('admin.post.index');
        Route::get('/create', [App\Http\Controllers\Admin\Post\CreateController::class, '__invoke'])->name('admin.post.create');
        Route::post('/',[App\Http\Controllers\Admin\Post\StoreController::class, '__invoke'])->name('admin.post.store');
        Route::get('/{post}',[App\Http\Controllers\Admin\Post\ShowController::class, '__invoke'])->name('admin.post.show');
        Route::get('/{post}/edit',[App\Http\Controllers\Admin\Post\EditController::class, '__invoke'])->name('admin.post.edit');
        Route::patch('/{post}',[App\Http\Controllers\Admin\Post\UpdateController::class, '__invoke'])->name('admin.post.update');
        Route::delete('/{post}',[App\Http\Controllers\Admin\Post\DeleteController::class, '__invoke'])->name('admin.post.delete');
    });

    Route::group(['namespace' => 'Comment', 'prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, '__invoke'])->name('admin.category.index');
        Route::get('/create', [CreateController::class, '__invoke'])->name('admin.category.create');
        Route::post('/',[StoreController::class, '__invoke'])->name('admin.category.store');
        Route::get('/{category}',[ShowController::class, '__invoke'])->name('admin.category.show');
        Route::get('/{category}/edit',[EditController::class, '__invoke'])->name('admin.category.edit');
        Route::patch('/{category}',[UpdateController::class, '__invoke'])->name('admin.category.update');
        Route::delete('/{category}',[DeleteController::class, '__invoke'])->name('admin.category.delete');
    });

    Route::group(['namespace' => 'Tag', 'prefix' => 'tags'], function () {
        Route::get('/', [TagController::class, '__invoke'])->name('admin.tag.index');
        Route::get('/create', [App\Http\Controllers\Admin\Tag\CreateController::class, '__invoke'])->name('admin.tag.create');
        Route::post('/',[App\Http\Controllers\Admin\Tag\StoreController::class, '__invoke'])->name('admin.tag.store');
        Route::get('/{tag}',[App\Http\Controllers\Admin\Tag\ShowController::class, '__invoke'])->name('admin.tag.show');
        Route::get('/{tag}/edit',[App\Http\Controllers\Admin\Tag\EditController::class, '__invoke'])->name('admin.tag.edit');
        Route::patch('/{tag}',[App\Http\Controllers\Admin\Tag\UpdateController::class, '__invoke'])->name('admin.tag.update');
        Route::delete('/{tag}',[App\Http\Controllers\Admin\Tag\DeleteController::class, '__invoke'])->name('admin.tag.delete');
    });


    Route::group(['namespace' => 'User', 'prefix' => 'users'], function () {
        Route::get('/', [UserController::class, '__invoke'])->name('admin.user.index');
        Route::get('/create', [App\Http\Controllers\Admin\User\CreateController::class, '__invoke'])->name('admin.user.create');
        Route::post('/',[App\Http\Controllers\Admin\User\StoreController::class, '__invoke'])->name('admin.user.store');
        Route::get('/{user}',[App\Http\Controllers\Admin\User\ShowController::class, '__invoke'])->name('admin.user.show');
        Route::get('/{user}/edit',[App\Http\Controllers\Admin\User\EditController::class, '__invoke'])->name('admin.user.edit');
        Route::patch('/{user}',[App\Http\Controllers\Admin\User\UpdateController::class, '__invoke'])->name('admin.user.update');
        Route::delete('/{user}',[App\Http\Controllers\Admin\User\DeleteController::class, '__invoke'])->name('admin.user.delete');
    });
});


Auth::routes(['verify' => true]);
