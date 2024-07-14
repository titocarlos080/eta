@extends('adminlte::page')

@section('title', 'ETA')

@section('content_header')
    <h1>ETA HANS ROTH</h1>
@stop

@section('content')
    <p>BIENVENIDOS A ETA HANS ROTH FE Y ALEGRIA</p>
@stop

@push('scripts')
<script src="{{ asset('js/theme.js') }}"></script>
@endpush

@push('css')
<link rel="stylesheet" href="{{ asset('css/theme.css') }}">
@endpush