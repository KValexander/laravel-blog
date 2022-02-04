@extends("layout")

@section("content")
	
	@if(isset($post))
		
		<div class="head">Изменение поста к <a href="{{ route('blog_page', ['blog_id' => $blog->entry_id]) }}">{{ $blog->name }}</a></div>
		
		<form enctype="multipart/form-data" action="{{ route('post_update', ['blog_id' => $blog->entry_id, 'post_id' => $post->entry_id]) }}" method="POST">
			@csrf

			<input type="text" placeholder="Название (не более 64 символов)" pattern=".{1,64}" name="name" value="{{ $post->name }}" required>
			<select name="category" required>
				<option value>Категория</option>
				@foreach($select as $val)
					<option value="{{ $val }}" @if($post->category == $val) selected @endif>{{ $val }}</option>
				@endforeach
			</select>
			<textarea class="last" placeholder="Описание (не более 256 символов)" pattern=".{1,256}" name="description" required>{{ $post->description }}</textarea>
			<textarea placeholder="Контент" name="content" required>{{ $post->content }}</textarea>
		
			<p class="text-left">Изменение изображения</p>
			<input type="file" name="image">
		
			<button>Изменить</button>
		
		</form>

		<div class="head">Доступные шорткоды</div>
		<div class="wrap">
			@if(count($images))
				@foreach($images as $val)
					<p>{{ "(( ". $val->name ." ))" }} - <a href="{{ route('image_add', ['blog_id' => $blog->entry_id, 'post_id' => $post->entry_id, 'image_id' => $val->entry_id]) }}" onclick="return confirm('Вы действительно хотите удалить шорткод?')">Удалить</a></p>
				@endforeach
			@else
				<p>Шорткоды отсутствуют</p>
			@endif
		</div>

		<div class="head">Добавление шорткодов изображений к посту</div>
		<form enctype="multipart/form-data" action="{{ route('image_add', ['blog_id' => $blog->entry_id, 'post_id' => $post->entry_id]) }}" method="POST">
			@csrf
			<input type="file" name="image" required>
			<button>Добавить</button>
		</form>

	@else
		
		<div class="head">Добавление поста к <a href="{{ route('blog_page', ['blog_id' => $blog->entry_id]) }}">{{ $blog->name }}</a></div>
		
		<form enctype="multipart/form-data" action="{{ route('post_add', ['blog_id' => $blog->entry_id]) }}" method="POST">
			@csrf
			
			<input type="text" placeholder="Название (не более 64 символов)" pattern=".{1,64}" name="name" required>
			<select name="category" required>
				<option value>Категория</option>
				@foreach($select as $val)
					<option value="{{ $val }}">{{ $val }}</option>
				@endforeach
			</select>
			<textarea class="last" placeholder="Описание (не более 256 символов)" pattern=".{1,256}" name="description" required></textarea>
			<textarea placeholder="Контент" name="content" required></textarea>

			
			<p class="text-left">Изображение поста</p>
			<input type="file" name="image">
			
			<button>Добавить</button>
		
		</form>

	@endif

@endsection