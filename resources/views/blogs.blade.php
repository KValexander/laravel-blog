@extends("layout")

@section("content")
	<div class="head">Последние блоги</div>
	<button onclick="location.href='{{ route('blog_add_page') }}'">Добавить блог</button>
	@if(count($blogs))
		@foreach($blogs as $val)
			<div class="card">
				@if($val->path_to_image)
					<div class="left"><img src="{{ asset($val->path_to_image) }}" alt=""></div>
				@endif
				<div class="right">
					<h2><a href="{{ route('blog_page', ['blog_id' => $val->entry_id]) }}">{{ $val->name }}</a></h2>
					<p>{{ $val->description }}</p>
					<p class="small"><a href="{{ route('blog_update_page', ['blog_id' => $val->entry_id]) }}">Изменить</a> <a href="{{ route('blog_delete', ['blog_id' => $val->entry_id]) }}" onclick="return confirm('Вы действительно хотите удалить этот блог?')">Удалить</a></p>
					<p class="small">{{ $val->created_at }}</p>
				</div>
			</div>
		@endforeach
	@else
		<br><br><h2 class="text-center">Блоги отсутствуют</h2><br>
	@endif
@endsection