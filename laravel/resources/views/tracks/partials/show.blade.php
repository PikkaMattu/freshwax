<section class="four columns">
	<header>
		<h1>{!!link_to_route('tracks.show', $track->name, $track->id)!!}</h1>

		<h2>
			@if($track->lyric != null)
				{!!link_to_route('lyrics.show', 'Lyrics', $track->lyric->id)!!}
			@endif
		</h2>
	</header>

	@if(isset($track->soundcloud_embed))
		<h6>{!!$track->soundcloud_embed!!}</h6>
    @endif

    @if(isset($track->path))
        {!! $track->path !!}
    @endif

	<h4>
		@if($track->tags->count())
			@foreach($track->tags as $tag)
				{{$tag->tag}}
			@endforeach
		@endif
	</h4>
    @include('tracks.partials.adminnav')
</section>
