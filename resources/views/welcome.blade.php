@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 80vh;">
        <div class="col-md-8 text-center">
            <h1 class="display-4 mb-5">Sistema de Ferias Comunitarias</h1>
            
            <div class="d-flex justify-content-center gap-4">
                <a href="{{ route('ferias.index') }}" class="btn btn-primary btn-lg px-5 py-3">
                    <i class="fas fa-store-alt fa-2x mb-2"></i><br>
                    Administrar Ferias
                </a>
                
                <a href="{{ route('emprendedores.index') }}" class="btn btn-success btn-lg px-5 py-3">
                    <i class="fas fa-users fa-2x mb-2"></i><br>
                    Administrar Emprendedores
                </a>
            </div>
        </div>
    </div>
</div>
@endsection