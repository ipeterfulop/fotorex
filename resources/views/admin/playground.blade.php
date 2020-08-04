@extends('layouts.minton.app')
@section('content')
    <printer-picker operations-url="{{ route('printer_picker_endpoint') }}"></printer-picker>
@endsection
