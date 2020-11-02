@extends('mail.layout')
@section('title')
    {{ $messageSubject }}
@endsection
@section('content')
    {!! $messageContent !!}
@endsection
