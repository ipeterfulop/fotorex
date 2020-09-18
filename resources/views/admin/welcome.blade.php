@extends('layouts.minton.app')
@section('content')
    <related-printers-popup-button
            operations-url="{{ route('related_printer_endpoint') }}"
            printer-id="26"
            relation-type="{{ \App\Printer::RELATIONTYPE_SIMILAR }}"
    ></related-printers-popup-button>
@endsection