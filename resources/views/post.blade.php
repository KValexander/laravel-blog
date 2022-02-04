@extends("layout")

@section("content")
	<div class="head">{{$post->name}} к <a href="{{ route('blog_page', ['blog_id' => $blog->entry_id]) }}">{{ $blog->name }}</a></div>
	<div class="wrap p4">
		{!! $post->content !!}
		<br><p>Категория: <b>{{ $post->category }}</b></p>
	</div>
@endsection