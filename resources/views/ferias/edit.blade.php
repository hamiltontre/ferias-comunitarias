@extends('layouts.app')

@section('content')
    <h1>Editar Feria: {{ $feria->nombre }}</h1>
    
    <form action="{{ route('ferias.update', $feria->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $feria->nombre }}" required>
        </div>
        
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" id="fecha" name="fecha" value="{{ $feria->fecha->format('Y-m-d') }}" required>
        </div>
        
        <div class="mb-3">
            <label for="lugar" class="form-label">Lugar</label>
            <input type="text" class="form-control" id="lugar" name="lugar" value="{{ $feria->lugar }}" required>
        </div>
        
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{ $feria->descripcion }}</textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('ferias.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection