<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Blogs</title>
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>

	<header>
		<div class="top">
			<h1>Блог</h1>
			<h3>Создайте свой блог</h3>
		</div>
		<div class="content">
			<nav>
				<p><a href="{{ route('main_page') }}">Главная</a></p>
				<p><a href="{{ route('blogs_page') }}">Блоги</a></p>
				<p><img src="{{ asset('assets/logo.png') }}" alt="logo"></p>
				<p><a href="{{ route('about_page') }}">О нас</a></p>
				<p><a href="{{ route('contacts_page') }}">Контакты</a></p>
			</nav>
		</div>
	</header>

	<div class="message">{{ $errors->message->first() }}</div>

	<main>
		<div class="content">
			@yield("content")
		</div><br>
	</main>

	<footer>
		<div class="content">
			<h2>Здесь могла бы быть ваша реклама</h2>
			<nav>
				<a href="">Главная</a>
				<a href="">Блоги</a>
				<a href="">О нас</a>
				<a href="">Контакты</a>
			</nav>
		</div>
	</footer>
	
</body>
</html>