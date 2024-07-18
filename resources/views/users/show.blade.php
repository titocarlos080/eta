@extends('adminlte::page')

@section('title', 'Usuario')

@section('content_header')
    <h1>Detalle de Usuario</h1>
@stop

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <strong>{{ $user->name }}</strong>
                    <a class="btn" href="{{ route('usuarios.index') }}">
                        <i class="fas fa-sync fa-md fa-fw"></i>
                    </a>
                </h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Nombre:</dt>
                    <dd class="col-sm-8">{{ $user->name }}</dd>
                    <dt class="col-sm-4">Email:</dt>
                    <dd class="col-sm-8">{{ $user->email }}</dd>
                    <dt class="col-sm-4">Rol:</dt>
                    <dd class="col-sm-8">{{ $user->rol->nombre ?? 'N/A' }}</dd> 
                
                </dl>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Volver a la Lista</a>
            </div>
        </div>
    </div>
</section>
@stop
@push('scripts')
<script src="{{ asset('js/theme.js') }}"></script>
@endpush

@push('css')
<link rel="stylesheet" href="{{ asset('css/theme.css') }}">
@endpush
