<!-- Véase la directiva yield en la plantilla base -->
@extends('layouts.base')

@section('styles')
<link href="{{ asset('css/manage_post/categories/css/article_category.css') }}" rel="stylesheet">
@endsection 

@section('title')
    {{ $category->name }}
@endsection 

@section('content') 

@include('layouts.navbar')

<div class="text-primary">
    <!-- strtoupper es para convertir todo texto en mayúscula --> 
    <h2 class="fw-bold fs-1">{{ strtoupper($category->name)}}</h2>
</div>

<div class="article-container">
    @foreach($articles as $article)

    <article class="article">
        <img src="{{ asset('storage/', $article->image) }}" class="img">
        <div class="card-body">
            <a href="{{ route('articles.show', $article->slug) }}">
                <h2 class="title">{{ Str::limit($article->title, 60, '...')}}</h2>
            </a>
            <p class="introduction">{{ Str::limit($article->introduction, 100, '...') }}</p>
        </div>
    </article>

    @endforeach

</div>

<div class="links-paginate">
    {{ $articles->links() }}
</div>
@endsection 