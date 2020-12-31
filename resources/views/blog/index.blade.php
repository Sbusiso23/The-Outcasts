@extends('layouts.main')

@section('page-name', "Blog | ".config('app.name', 'The Outcasts'))

@section('page-includes')
	<link rel="stylesheet" href={{asset("css/blog/index.css") }}>
	<link rel="stylesheet" href={{asset("css/inc/_subscribe.css") }}>
@endsection

@section('content')
	<div class="content-container">
		<div class="latest-article-container">
			<a class="article-link" href="/blog/articles/{{$articles->first()->link}}"><div class="latest-article-title">
				{{$articles->first()->title}} 
			</div></a>
			<div class="latest-article-cover">
				<a href="/blog/articles/{{$articles->first()->link}}"><img src={{asset('storage/covers/'.$articles->first()->cover_image)}}></a>
			</div>
			<div class="latest-article-attributes">
				<div class="article-aside-1">
					<div class="latest-article-details">
						<span class="latest-article-description">
							{{$articles->first()->description}}
						</span>
						<div class="article-author-details">
							<img src={{asset("images/users/profile/".$articles->first()->user->profile_pic)}}>
							<div class="article-details">
								<span class="article-author">
									<a href={{url("/authors/".$articles->first()->user->name)}}>
										{{ $articles->first()->user->name }}
									</a>
								</span>
								<span class="article-createdat">
									@if ($articles->first()->updated_at == $articles->first()->created_at)
										{{$articles->first()->created_at->format('d M Y, H\hi') }}
									@else
										Updated at {{$articles->first()->updated_at->format('d M Y, H\hi') }}
									@endif
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="article-tags">
					@if(!empty($articles->first()->tags()->get()))
						@foreach ($articles->first()->tags()->get() as $tag)
							<a href={{"/blog/tags/".$tag->tag}}>
								<span class="article-tag">
									{{$tag->tag}}
								</span>
							</a>
						@endforeach
					@endif
				</div>
			</div>
		</div>
		
		<div class="articles-container">
			@for($x = 1; $x < count($articles); $x++)
				<div class="article-container">
					<a class="article-link" href="/blog/articles/{{$articles[$x]->link}}">
						<div class="article-cover">
							<img src={{asset('storage/covers/'.$articles[$x]->cover_image)}}>
						</div>
					</a>
					<div class="article-attributes">
						<a class="article-link" href="/blog/articles/{{$articles[$x]->link}}">
							<div class="article-title">
								{{$articles[$x]->title}}
							</div>
						</a>
						<div class="article-description">
							{{$articles[$x]->description}}
						</div>
						<div class="article-author-details">
							<img src={{asset("images/users/profile/".$articles[$x]->user->profile_pic)}}>
							<div class="article-details">
								<span class="article-author">
									<a href={{url("/authors/".$articles[$x]->user->name)}}>
										{{$articles[$x]->user->name }}
									</a>
								</span>
								<span class="article-createdat">
									@if ($articles[$x]->updated_at == $articles[$x]->created_at)
										{{$articles[$x]->created_at->format('d M Y, H\hi') }}
									@else
										Updated at {{$articles[$x]->updated_at->format('d M Y, H\hi') }}
									@endif
								</span>
							</div>
						</div>
						<div class="article-tags">
							@if(!empty($articles[$x]->tags()->get()))
								@foreach ($articles[$x]->tags()->get() as $tag)
									<a href={{"/blog/tags/".$tag->link}}>
										<span class="article-tag">
											{{$tag->tag}}
										</span>
									</a>
								@endforeach
							@endif
						</div>
					</div>
				</div>
			@endfor
		</div> 
		@include('inc._subscribe')
	</div>
@endsection

@section('js-code')
    <script>
        let links = document.querySelector(".links");
		links.children[2].firstElementChild.id = "active-link";
		
		let dropdown_links = document.querySelector('.dropdown-links');
        dropdown_links.children[2].firstElementChild.id = "active-link-dropdown";
    </script>
@endsection