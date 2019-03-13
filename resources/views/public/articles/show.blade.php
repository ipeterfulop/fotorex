@extends('layouts.unishop.app')
@section('content')
    <h2>{!! $article->title !!}</h2>
    <div>
        {!! $article->content !!}
    </div>
    <a href="{{ $backUrl }}">Vissza</a>
@endsection