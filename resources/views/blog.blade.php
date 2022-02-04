@extends("layout")

@section("content")
	<div class="head">{{ $blog->name }}</div>
	<div class="wrap">
		<p class="text-center"><i>{{$blog->description}}</i></p>
	</div>

	<div class="head">Последние Посты</div>
	<button onclick="location.href='{{ route('post_add_page', ['blog_id' => $blog->entry_id]) }}'">Добавить пост</button>
	@if(count($posts))
		@foreach($posts as $val)
			<div class="card">
				@if($val->path_to_image)
					<div class="left"><img src="{{ asset($val->path_to_image) }}" alt=""></div>
				@endif
				<div class="right">
					<h2><a href="{{ route('post_page', ['blog_id' => $val->parent_id, 'post_id' => $val->entry_id]) }}">{{ $val->name }}</a></h2>
					<p>{{ $val->description }}</p>
					<p>Категория: <b>{{ $val->category }}</b></p>
					<p class="small"><a href="{{ route('post_update_page', ['blog_id' => $val->parent_id, 'post_id' => $val->entry_id]) }}">Изменить</a> <a href="{{ route('post_delete', ['blog_id' => $val->parent_id, 'post_id' => $val->entry_id]) }}" onclick="return confirm('Вы действительно хотите удалить этот пост?')">Удалить</a></p>
				</div>
			</div>
		@endforeach
	@else
		<br><br><h2 class="text-center">Посты отсутствуют</h2><br>
	@endif
@endsection