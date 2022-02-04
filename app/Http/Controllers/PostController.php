<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PostController extends Controller {

	// Добавление поста блога
	public function post_add(Request $request) {
		$name = strip_tags($request->input("name"));
		$category = strip_tags($request->input("category"));
		$description = strip_tags($request->input("description"));
		$content = $request->input("content");

		$blog_id = $request->route("blog_id");

		if($request->has("image")) {
	        $image_name = "1_". time() ."_". rand() .".". $request->file("image")->extension();
	        $request->file("image")->move(public_path("assets/images/"), $image_name);
	        $path = "assets/images/". $image_name;
		} else $path = NULL;

		DB::table("entries")->insert([
			"name" => $name,
			"entity" => "post",
			"category" => $category,
			"description" => $description,
			"content" => $content,
			"path_to_image" => $path,
			"parent_id" => $blog_id
		]);

		return redirect()->route("blog_page", ["blog_id" => $blog_id])->withErrors("Пост добавлен", "message");
	}

	// Изменение поста блога
	public function post_update(Request $request) {
		$name = strip_tags($request->input("name"));
		$category = strip_tags($request->input("category"));
		$description = strip_tags($request->input("description"));
		$content = $request->input("content");

		$blog_id = $request->route("blog_id");
		$post_id = $request->route("post_id");

		$post = DB::table("entries")->where("entry_id", $post_id)->first();

		if($request->has("image")) {
	        $image_name = "1_". time() ."_". rand() .".". $request->file("image")->extension();
	        $request->file("image")->move(public_path("assets/images/"), $image_name);
	        $path = "assets/images/". $image_name;
		} else $path = $post->path_to_image;

		DB::table("entries")->where("entry_id", $post_id)->update([
			"name" => $name,
			"entity" => "post",
			"category" => $category,
			"description" => $description,
			"content" => $content,
			"path_to_image" => $path,
			"parent_id" => $blog_id
		]);

		return redirect()->route("blog_page", ["blog_id" => $blog_id])->withErrors("Пост изменён", "message");
	}

	// Удаление поста блога
	public function post_delete($blog_id, $post_id) {
		DB::table("entries")->where("parent_id", $post_id)->delete();
		DB::table("entries")->where("entry_id", $post_id)->delete();
		return redirect()->route("blog_page", ["blog_id" => $blog_id])->withErrors("Пост Удалён", "message");
	}

	// Добавление изображений к посту блога
	public function image_add(Request $request) {
        $image_name = "1_". time() ."_". rand() .".". $request->file("image")->extension();
        $request->file("image")->move(public_path("assets/images/"), $image_name);
        $path = "assets/images/". $image_name;

        $blog_id = $request->route("blog_id");
        $post_id = $request->route("post_id");

        DB::table("entries")->insert([
        	"name" => $image_name,
        	"entity" => "image",
        	"path_to_image" => $path,
        	"parent_id" => $post_id
        ]);

		return redirect()->route("post_update_page", ["blog_id" => $blog_id, "post_id" => $post_id])->withErrors("Изображение к посту добавлено, шорткоды обновлены", "message");
	}

	// Удаление изображения к посту блога
	public function image_delete($blog_id, $post_id, $image_id) {
		DB::table("entries")->where("entry_id", $image_id)->delete();
		return redirect()->route("post_update_page", ["blog_id" => $blog_id, "post_id" => $post_id])->withErrors("Изображение к посту удалено, шорткоды обновлены", "message");
	}

}