@extends("layout")

@section("content")
	<div class="main">
		<h1>Добро пожаловать!</h1>
		<h3>Желали создать свой блог? Тогда вам к нам!</h3>
		<p>Делитесь своим мнение со всем миром в пару кликов!</p>
		<button onclick="location.href='{{ route('blogs_page') }}'">Посмотреть блоги</button>
	</div>
@endsection