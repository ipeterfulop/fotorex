@extends('layouts.unishop.app')
@section('content')
    @forelse($articles as $article)
        @include('public.articles.summary-block', ['article' => $article])
    @empty
    @endforelse
@endsection