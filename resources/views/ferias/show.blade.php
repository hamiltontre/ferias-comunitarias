@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Detalles de la Feria: {{ $feria->nombre }}</h2>
                <div>
                    <a href="{{ route('ferias.edit', $feria->id) }}" 
                       class="btn btn-warning btn-lg">
                       <i class="fas fa-edit"></i> Editar
                    </a>
                    <form action="{{ route('ferias.destroy', $feria->id) }}"
                          method="POST" 
                          class="d-inline"
                          onsubmit="return confirm('¿Eliminar permanentemente esta feria?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-lg ml-2">
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
                        <p><strong>Nombre:</strong> {{ $feria->nombre }}</p>
                        <p><strong>Fecha:</strong> {{ $feria->fecha->format('d/m/Y') }}</p>
                        <p><strong>Lugar:</strong> {{ $feria->lugar }}</p>
                        <p><strong>Descripción:</strong> {{ $feria->descripcion }}</p>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-4">
                        <h5 class="font-weight-bold">Emprendedores Participantes</h5>
                        <hr>
                        @if($feria->emprendedores->count() > 0)
                            <ul class="list-group">
                                @foreach($feria->emprendedores as $emprendedor)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $emprendedor->nombre }}
                                    <span class="badge badge-info">{{ $emprendedor->rubro }}</span>
                                </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="alert alert-info">No hay emprendedores registrados</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer text-right">
            <a href="{{ route('ferias.index') }}" class="btn btn-outline-secondary btn-lg">
                <i class="fas fa-arrow-left"></i> Volver al listado
            </a>
        </div>
    </div>
</div>
@endsection