@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Detalles del Emprendedor</h2>
                <div>
                    <a href="{{ route('emprendedores.edit', $emprendedor->id) }}" 
                       class="btn btn-warning btn-sm">
                       <i class="fas fa-edit"></i> Editar
                    </a>
                    <form action="{{ route('emprendedores.destroy', $emprendedor->id) }}" 
                          method="POST" 
                          class="d-inline"
                          onsubmit="return confirm('¿Eliminar permanentemente a {{ addslashes($emprendedor->nombre) }}?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <h5 class="font-weight-bold">Información Básica</h5>
                        <hr>
                        <p><strong>Nombre:</strong> {{ $emprendedor->nombre }}</p>
                        <p><strong>Teléfono:</strong> {{ $emprendedor->telefono }}</p>
                        <p><strong>Rubro:</strong> {{ $emprendedor->rubro }}</p> 
                    </div>

                    @if($emprendedor->ferias->count() > 0)
                    <div class="mb-4">
                        <h5 class="font-weight-bold">Ferias Participantes</h5>
                        <hr>
                        <ul class="list-group">
                            @foreach($emprendedor->ferias as $feria)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $feria->nombre }}
                                <span class="badge badge-secondary">{{ $feria->fecha->format('d/m/Y') }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="card-footer text-right">
            <a href="{{ route('emprendedores.index') }}" 
               class="btn btn-outline-secondary">
               <i class="fas fa-arrow-left"></i> Volver al listado
            </a>
        </div>
    </div>
</div>
@endsection