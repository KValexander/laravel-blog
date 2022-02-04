<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BlogController extends Controller {

	// Добавление блога
	public function blog_add(Request $request) {
		$name = strip_tags($request->input("name"));
		$description = strip_tags($request->input("description"));

		if($request->has("image")) {
	        $image_name = "1_". time() ."_". rand() .".". $request->file("image")->extension();
	        $request->file("image")->move(public_path("assets/images/"), $image_name);
	        $path = "assets/images/". $image_name;
		} else $path = NULL;

		DB::table("entries")->insert([
			"name" => $name,
			"entity" => "blog",
			"description" => $description,
			"path_to_image" => $path,
			"parent_id" => 0
		]);

		return redirect()->route("blogs_page")->withErrors("Блог добавлен", "message");
	}

	// Изменение блога
	public function blog_update(Request $request) {
		$name = strip_tags($request->input("name"));
		$description = strip_tags($request->input("description"));

		$blog_id = $request->route("blog_id");
		$blog = DB::table("entries")->where("entry_id", $blog_id)->first();

		if($request->has("image")) {
	        $image_name = "1_". time() ."_". rand() .".". $request->file("image")->extension();
	        $request->file("image")->move(public_path("assets/images/"), $image_name);
	        $path = "assets/images/". $image_name;
		} else $path = $blog->path_to_image;

		DB::table("entries")->where("entry_id", $blog_id)->update([
			"name" => $name,
			"description" => $description,
			"path_to_image" => $path,
			"parent_id" => 0
		]);

		return redirect()->route("blogs_page")->withErrors("Блог изменён", "message");
	}

	// Удаление блога
	public function blog_delete($blog_id) {
		$posts = DB::table("entries")->where("parent_id", $blog_id)->select("entry_id")->get();
		foreach($posts as $val)
			DB::table("entries")->where("parent_id", $val->entry_id)->delete();
		DB::table("entries")->where("parent_id", $blog_id)->delete();
		DB::table("entries")->where("entry_id", $blog_id)->delete();
		return redirect()->route("blogs_page")->withErrors("Блог с прилегающими к нему постами удалён", "message");
	}

}