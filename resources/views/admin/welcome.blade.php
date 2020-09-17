@extends('layouts.minton.app')
@section('content')
    <related-printers-list
            operations-url="{{ route('related_printer_endpoint') }}"
            printer-id="26"
            :value="[]"
    ></related-printers-list>
@endsection