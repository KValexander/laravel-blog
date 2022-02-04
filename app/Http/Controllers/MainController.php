<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MainController extends Controller {

    // Вывод главной страницы
    public function main_page() {
        return view("index");
    }

    // Вывод страницы о нас
    public function about_page() {
        return view("about");
    }

    // Вывод страницы контактов
    public function contacts_page() {
        return view("contacts");
    }

    // Вывод страницы блогов
    public function blogs_page() {
        $blogs = DB::table("entries")->where("entity", "blog")->orderby("updated_at", "DESC")->get();
        return view("blogs", ["blogs" => $blogs]);
    }

    // Вывод страницы добавления блога
    public function blog_add_page() {
        return view("forms.blog_form");
    }

    // Вывод страницы изменения блога
    public function blog_update_page($blog_id) {
        $blog = DB::table("entries")->where("entry_id", $blog_id)->first();
        return view("forms.blog_form", ["blog" => $blog]);
    }

    // Вывод страницы блога с прилегающими постами
    public function blog_page($blog_id) {
        $blog = DB::table("entries")->where("entry_id", $blog_id)->orderby("updated_at", "DESC")->first();
        $posts = DB::table("entries")->where("parent_id", $blog->entry_id)->orderby("updated_at", "DESC")->get();
        return view("blog", [
            "blog" => $blog,
            "posts" => $posts
        ]);
    }

    // Вывод страницы добавления поста блога
    public function post_add_page($blog_id) {
        $select = ["Пост", "Новость", "Событие"];
        $blog = DB::table("entries")->where("entry_id", $blog_id)->first();
        return view("forms.post_form", ["blog" => $blog, "select" => $select]);
    }

    // Вывод страницы изменения поста блога
    public function post_update_page($blog_id, $post_id) {
        $select = ["Пост", "Новость", "Событие"];
        $blog = DB::table("entries")->where("entry_id", $blog_id)->first();
        $post = DB::table("entries")->where("entry_id", $post_id)->first();
        $images = DB::table("entries")->where("parent_id", $post_id)->get();
        return view("forms.post_form", [
            "blog" => $blog,
            "post" => $post,
            "images" => $images,
            "select" => $select
        ]);

    }

    // Вывод страницы поста блога
    public function post_page($blog_id, $post_id) {
        $blog = DB::table("entries")->where("entry_id", $blog_id)->first();
        $post = DB::table("entries")->where("entry_id", $post_id)->first();

        preg_match_all("#\(\(.*?\)\)#", $post->content, $images, PREG_PATTERN_ORDER);
        foreach($images[0] as $val) {
            $img_name = preg_replace("#\(|\)#", "", $val);
            if($image = DB::table("entries")->where("name", trim($img_name))->where("parent_id", $post_id)->select("path_to_image")->first())
                $post->content = str_replace($val, sprintf('<div class="image"><img src="%s" alt="" /></div>', asset($image->path_to_image)), $post->content);
            else $post->content = str_replace($val, "", $post->content);
        }


        return view("post", ["blog" => $blog, "post" => $post]);
    }

}