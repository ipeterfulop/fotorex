@extends('layouts.minton.app')
@section('content')
    <printer-attributes-popup-button operations-url="{{ route('printer_attribute_endpoints') }}"
                               printer-id="52"
    ></printer-attributes-popup-button>
@endsection
