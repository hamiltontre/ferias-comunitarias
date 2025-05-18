@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-white">
            <h2 class="mb-0">Editar Feria: {{ $feria->nombre }}</h2>
        </div>

        <div class="card-body">
            <form action="{{ route('ferias.update', $feria->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre" class="font-weight-bold">Nombre</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                                   id="nombre" name="nombre" value="{{ old('nombre', $feria->nombre) }}" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fecha" class="font-weight-bold">Fecha</label>
                            <input type="date" class="form-control @error('fecha') is-invalid @enderror" 
                                   id="fecha" name="fecha" value="{{ old('fecha', $feria->fecha->format('Y-m-d')) }}" required>
                            @error('fecha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="lugar" class="font-weight-bold">Lugar</label>
                    <input type="text" class="form-control @error('lugar') is-invalid @enderror" 
                           id="lugar" name="lugar" value="{{ old('lugar', $feria->lugar) }}" required>
                    @error('lugar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="descripcion" class="font-weight-bold">Descripción</label>
                    <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                              id="descripcion" name="descripcion" rows="3" required>{{ old('descripcion', $feria->descripcion) }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">Emprendedores Participantes</label>
                    @if($emprendedores->count() > 0)
                        <div class="row">
                            @foreach($emprendedores as $emprendedor)
                            <div class="col-md-4 mb-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" 
                                           id="emp_{{ $emprendedor->id }}" 
                                           name="emprendedores[]" 
                                           value="{{ $emprendedor->id }}"
                                           {{ $feria->emprendedores->contains($emprendedor->id) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="emp_{{ $emprendedor->id }}">
                                        {{ $emprendedor->nombre }} ({{ $emprendedor->rubro }})
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info">No hay emprendedores registrados</div>
                    @endif
                </div>

                <div class="text-right mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-save"></i> Guardar Cambios
                    </button>
                    <a href="{{ route('ferias.show', $feria->id) }}" 
                       class="btn btn-outline-secondary btn-lg ml-2">
                       <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection