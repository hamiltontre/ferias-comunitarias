@extends('layouts.app')

@section('title', 'Inicio')
@section('content')
<div class="text-center py-5">
    <h1 class="mb-4">Sistema de Ferias Comunitarias</h1>
    
    <div class="d-grid gap-3 d-md-flex justify-content-md-center">
        <a href="{{ route('ferias.index') }}" class="btn btn-primary btn-lg px-4">
            Ver Ferias
        </a>
        <a href="{{ route('emprendedores.index') }}" class="btn btn-success btn-lg px-4 ms-md-3">
            Ver Emprendedores
        </a>
    </div>
</div>
@endsection