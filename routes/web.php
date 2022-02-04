<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;

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

// Вывод страниц
// ------------------------------------

// Главная страница
Route::get("/", [MainController::class, "main_page"])->name("main_page");
// Страница о нас
Route::get("/about", [MainController::class, "about_page"])->name("about_page");
// Страница контакты
Route::get("/contacts", [MainController::class, "contacts_page"])->name("contacts_page");
// Страница блогов
Route::get("/blogs", [MainController::class, "blogs_page"])->name("blogs_page");

// Страница блога
Route::get("/blog/{blog_id}", [MainController::class, "blog_page"])->name("blog_page");
// Страница поста блога
Route::get("/blog/{blog_id}/post/{post_id}", [MainController::class, "post_page"])->name("post_page");

// Страница добавления блога
Route::get("/blog-add", [MainController::class, "blog_add_page"])->name("blog_add_page");
// Страница изменения блога
Route::get("/blog/{blog_id}/update", [MainController::class, "blog_update_page"])->name("blog_update_page");

// Страница добавления поста блога
Route::get("/blog/{blog_id}/post-add", [MainController::class, "post_add_page"])->name("post_add_page");
// Страница изменения поста блога
Route::get("/blog/{blog_id}/post/{post_id}/update", [MainController::class, "post_update_page"])->name("post_update_page");

// ------------------------------------


// Логика
// ------------------------------------

// Добавление блога
Route::post("/blog-add", [BlogController::class, "blog_add"])->name("blog_add");
// Изменение блога
Route::post("/blog/{blog_id}/update", [BlogController::class, "blog_update"])->name("blog_update");
// Удаление блога
Route::get("/blog/{blog_id}/delete", [BlogController::class, "blog_delete"])->name("blog_delete");

// Добавление поста блога
Route::post("/blog/{blog_id}/post-add", [PostController::class, "post_add"])->name("post_add");
// Изменение поста блога
Route::post("/blog/{blog_id}/post/{post_id}/update", [PostController::class, "post_update"])->name("post_update");
// Удаление поста блога
Route::get("/blog/{blog_id}/post/{post_id}/delete", [PostController::class, "post_delete"])->name("post_delete");

// Добавление изображения к посту блога
Route::post("/blog/{blog_id}/post/{post_id}/image-add", [PostController::class, "image_add"])->name("image_add");

// Удаления изображения к посту блога
Route::get("/blog/{blog_id}/post/{post_id}/image/{image_id}/delete", [PostController::class, "image_delete"])->name("image_delete");

// ------------------------------------
