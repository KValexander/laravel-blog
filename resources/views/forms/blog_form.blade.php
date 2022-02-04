@extends("layout")

@section("content")
	
	@if(isset($blog))
		
		<div class="head">Изменение блога</div>
		
		<form enctype="multipart/form-data" action="{{ route('blog_update', ['blog_id'=>$blog->entry_id]) }}" method="POST">
			@csrf

			<input type="text" placeholder="Название (не более 64 символов)" pattern=".{1,64}" name="name" value="{{ $blog->name }}" required>
			<textarea placeholder="Описание (не более 256 символов)" pattern=".{1,256}" name="description" required>{{ $blog->description }}</textarea>
		
			<p class="text-left">Изменение изображения</p>
			<input type="file" name="image">
		
			<button>Изменить</button>
		
		</form>

	@else
		
		<div class="head">Добавление блога</div>
		
		<form enctype="multipart/form-data" action="{{ route('blog_add') }}" method="POST">
			@csrf
			
			<input type="text" placeholder="Название (не более 64 символов)" pattern=".{1,64}" name="name" required>
			<textarea placeholder="Описание (не более 256 символов)" pattern=".{1,256}" name="description" required></textarea>
			
			<p class="text-left">Изображение блога</p>
			<input type="file" name="image">
			
			<button>Добавить</button>
		
		</form>

	@endif

@endsection