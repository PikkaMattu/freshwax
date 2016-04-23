@extends('layouts.master')

@section('content')
	<article class="forms"> 
		<header> 
			<h1>Create Post</h1>
		</header> 
		{!!Form::open(['route'=>'posts.store'])!!}
			@include('posts.partials.form')
			{!!Form::submit('create')!!}
		{!!Form::close()!!}

	</article> 
@stop
