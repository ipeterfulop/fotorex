@extends('layouts.minton.app')
@section('content')
    <input type="text" oninput="showValue(event)" id="id1">
    <div id="id2"></div>
    <script>
        function showValue(event) {
            let e = document.getElementById(event.target.id);
            console.log({e: e, ev: e.value});
            document.getElementById('id2').innerText = e.value;
        }
    </script>
@endsection
