@extends('layouts.unishop.app')
@section('content')
    @if($dataproviderResult->results->isNotEmpty())
        @foreach($dataproviderResult->results as $article)
            @include('public.articles.summary-block', ['article' => $article])
        @endforeach
        @include('layouts.pagination', [
            'dataproviderResult' => $dataproviderResult,
            'compact' => true
        ])
    @else
        Nem találhatók cikkek
    @endif

@endsection