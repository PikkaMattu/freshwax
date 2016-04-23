<nav> 
	
@if(!Auth::check())
	{!!link_to_route('users.create', 'Register')!!}
	{!!link_to_route('login', 'Login')!!}
@else 

	@if(Auth::user()->isadmin)
		@include('layouts.partials.nav.admin')
	@endif

	{!!link_to_route('shoppingcarts.show', 'Cart' , Auth::user()->cart->id) !!}
	{!!link_to_route('wishlists.show', 'Wishlist' , Auth::user()->wishlist->id) !!}
	{!!link_to_route('logout', 'Logout')!!}

@endif

@if($albums->count() != 0)
	{!!link_to_route('albums.index', 'Discography')!!}
@endif

@if($lyrics->count() != 0)
	{!!link_to_route('lyrics.index', 'Lyrics')!!}
@endif

@if($tracks->count() != 0)
	{!!link_to_route('tracks.index', 'Listen')!!}
@endif

@if($videos->count() != 0)
	{!!link_to_route('videos.index', 'Videos')!!}
@endif

@if($events->count() != 0)
	{!!link_to_route('events.index', 'Events')!!}
@endif

@if($posts->count() != 0)
	{!!link_to_route('posts.index', 'News')!!}
@endif

@if($items->count() != 0)
	{!!link_to_route('items.index', 'Merch')!!}
@endif
</nav> 
