@extends('layouts.app')

@section('content')
<a href="{{route('article.create')}}" style="padding:5px;border:1px dashed gray;">
	+ New Article
</a>
@foreach ($articleList as $key=>$value)
<div style="border:1px solid gray;margin-top:20px;padding:20px;">
    <h2>{{ $value->title }}</h2>
    <p title="{{$value->content}}">{{ $value->contentShort }}</p>
    <a href="{{route('article.edit', $value->id)}}">Edit</a>
    <form action="{{route('article.destroy', $value->id)}}" method="post" style="display:inline-block;">
    	{{csrf_field()}}
    	{{method_field('DELETE')}}
    	<button type="submit" style="color:#F08080;background-color:transparent;border:none;">Delete</button>
    </form>
</div>
@endforeach
@endsection