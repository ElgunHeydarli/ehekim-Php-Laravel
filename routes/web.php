<?php

use App\Http\Controllers\AccountController as ControllersAccountController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\PostController as FrontPostController;
use App\Http\Controllers\NavbarController;
use App\Http\Controllers\ProfessionController;
use App\Models\Category;
use App\Models\Profession;
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

Route::get('/admin/login', fn () => view('admin.account.login'))->name('admin.login');
Route::post('/admin/login', [AccountController::class, 'login']);
Route::get('/admin/logout', [AccountController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->middleware('role:admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [AccountController::class, 'profile'])->name('admin.profile');

    Route::get('/setting', [SettingController::class, 'index'])->name('setting');
    Route::post('/setting', [SettingController::class, 'submit']);

    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/create', [CategoryController::class, 'store']);
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/edit/{id}', [CategoryController::class, 'update']);
        Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
    });

    Route::prefix('tag')->group(function () {
        Route::get('/', [TagController::class, 'index'])->name('tags');
        Route::get('/create', [TagController::class, 'create'])->name('tag.create');
        Route::post('/create', [TagController::class, 'store']);
        Route::get('/edit/{id}', [TagController::class, 'edit'])->name('tag.edit');
        Route::post('/edit/{id}', [TagController::class, 'update']);
        Route::get('/delete/{id}', [TagController::class, 'destroy'])->name('tag.delete');
    });

    Route::prefix('profession')->group(function () {
        Route::get('/', [ProfessionController::class, 'index'])->name('professions');
        Route::get('/create', [ProfessionController::class, 'create'])->name('profession.create');
        Route::post('/create', [ProfessionController::class, 'store']);
        Route::get('/edit/{id}', [ProfessionController::class, 'edit'])->name('profession.edit');
        Route::post('/edit/{id}', [ProfessionController::class, 'update']);
        Route::get('/delete/{id}', [ProfessionController::class, 'destroy'])->name('profession.delete');
    });

    Route::prefix('banner')->group(function () {
        Route::get('/', [BannerController::class, 'index'])->name('banners');
        Route::get('/create', [BannerController::class, 'create'])->name('banner.create');
        Route::post('/create', [BannerController::class, 'store']);
        Route::get('/edit/{id}', [BannerController::class, 'edit'])->name('banner.edit');
        Route::post('/edit/{id}', [BannerController::class, 'update']);
        Route::get('/delete/{id}', [BannerController::class, 'destroy'])->name('banner.delete');
    });

    Route::prefix('navbar')->group(function () {
        Route::get('/', [NavbarController::class, 'index'])->name('admin.navbars');
        Route::get('/create', [NavbarController::class, 'create'])->name('navbar.create');
        Route::post('/create', [NavbarController::class, 'store']);
        Route::get('/edit/{id}', [NavbarController::class, 'edit'])->name('navbar.edit');
        Route::post('/edit/{id}', [NavbarController::class, 'update']);
        Route::get('/delete/{id}', [NavbarController::class, 'destroy'])->name('navbar.delete');
    });

    Route::prefix('post')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('posts');
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
        Route::post('/edit/{id}', [PostController::class, 'update']);
        Route::get('/delete/{id}', [PostController::class, 'destroy'])->name('post.delete');
    });

    Route::prefix('comment')->group(function () {
        Route::get('/', [CommentController::class, 'index'])->name('comments');
        Route::get('/edit/{id}', [CommentController::class, 'edit'])->name('comment.edit');
        Route::post('/edit/{id}', [CommentController::class, 'update']);
        Route::get('/delete/{id}', [CommentController::class, 'destroy'])->name('comment.delete');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.users');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.user-edit');
        Route::post('/edit/{id}', [UserController::class, 'update']);
        Route::get('/comment/{id}', [UserController::class, 'comments'])->name('user.comments');
        Route::get('/post/{id}', [UserController::class, 'posts'])->name('user.posts');
        Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('admin.user-delete');
    });
});
Route::get('/login', fn () => view('front.pages.login'))->name('login');
Route::post('/login', [ControllersAccountController::class, 'login']);
Route::get('/register/{role}', function ($role) {
    $professions = Profession::get();
    return view('front.pages.register', compact('role', 'professions'));
})->name('register');
Route::get('/profile', [ControllersAccountController::class, 'profile'])->name('profile');
Route::post('/profile', [ControllersAccountController::class, 'update_profile']);
Route::post('/register/{role}', [ControllersAccountController::class, 'register']);
Route::get('/logout', [ControllersAccountController::class, 'logout'])->name('logout');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/suallar', [FrontPostController::class, 'index']);
Route::get('/movzu/{slug?}', [HomeController::class, 'posts'])->name('category-posts');
Route::get('/hekimler/{slug?}', [HomeController::class, 'doctors'])->name('doctors');
Route::post('/add-post', [HomeController::class, 'add_post'])->name('add-post');
Route::post('/send-comment/{id}', [HomeController::class, 'send_comment'])->name('send-comment');
Route::post('/edit-comment/{id}', [HomeController::class, 'edit_comment'])->name('edit-comment');
Route::get('/tesekkur', [HomeController::class, 'thank_you'])->name('thank-you');
// search

Route::get('/like-comment/{id}', [HomeController::class, 'like_comment']);
Route::get('/search', [HomeController::class, 'search']);
Route::get('/acar-sozler/{slug?}', [HomeController::class, 'tag_posts'])->name('tag-post');
Route::get('/{slug?}', [HomeController::class, 'post'])->name('post-single');
Route::get('/{profession?}/{slug?}', [HomeController::class, 'doctor_detail'])->name('doctor-detail');
